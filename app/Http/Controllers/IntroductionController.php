<?php

namespace App\Http\Controllers;

use App\Models\BusinessProfile;
use App\Models\InvestorProfile;
use App\Models\IntroductionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Notifications\IntroductionRequestReceived;
use App\Notifications\IntroductionApproved;

class IntroductionController extends Controller
{
    /**
     * Show the introduction request form
     */
    public function show(Request $request, $type = null, $id = null)
    {
        $profile = null;
        $businessProfiles = [];
        $investorProfiles = [];

        // Get all available profiles for the dropdowns
        $businessProfiles = BusinessProfile::with('user')
            ->where('status', 'approved')
            ->where('verification_status', 'Approved')
            ->get()
            ->map(function ($profile) {
                return [
                    'id' => $profile->id,
                    'application_data' => $profile->application_data,
                ];
            });

        $investorProfiles = InvestorProfile::with('user')
            ->where('status', 'approved')
            ->where('verification_status', 'Approved')
            ->get()
            ->map(function ($profile) {
                return [
                    'id' => $profile->id,
                    'company_name' => $profile->company_name,
                    'buyer_interest' => $profile->buyer_interest,
                ];
            });

        // If type and id are provided, get the specific profile
        if ($type && $id) {
            if ($type === 'business') {
                $profile = BusinessProfile::findOrFail($id);
            } elseif ($type === 'investor') {
                $profile = InvestorProfile::findOrFail($id);
            }
        }

        return view('introduction.request', compact(
            'profile',
            'type',
            'businessProfiles',
            'investorProfiles'
        ));
    }

    /**
     * Store the introduction request
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'introduction_type' => 'required|in:business,investor',
            'target_id' => 'required|integer',
            'requester_name' => 'required|string|max:255',
            'requester_email' => 'required|email|max:255',
            'requester_phone' => 'required|string|max:20',
            'requester_company' => 'nullable|string|max:255',
            'introduction_purpose' => 'required|in:investment_opportunity,business_acquisition,partnership,financing,asset_purchase,other',
            'message' => 'required|string|min:50|max:2000',
            'budget_range' => 'nullable|in:under_1m,1m_5m,5m_10m,10m_50m,50m_100m,over_100m',
            'agree_to_terms' => 'required|accepted',
        ]);

        try {
            // Validate that the target exists
            if ($validatedData['introduction_type'] === 'business') {
                $target = BusinessProfile::findOrFail($validatedData['target_id']);
                $targetUser = $target->user;
                $targetName = $target->application_data['company_name'] ?? 'Business';
            } else {
                $target = InvestorProfile::findOrFail($validatedData['target_id']);
                $targetUser = $target->user;
                $targetName = $target->company_name;
            }

            // Prevent users from requesting introduction to themselves
            if ($targetUser->id === Auth::id()) {
                return back()->withErrors(['target_id' => 'You cannot request an introduction to yourself.']);
            }

            // Create the introduction request
            $introductionRequest = IntroductionRequest::create([
                'requester_id' => Auth::id(),
                'target_type' => $validatedData['introduction_type'],
                'target_id' => $validatedData['target_id'],
                'target_user_id' => $targetUser->id,
                'requester_name' => $validatedData['requester_name'],
                'requester_email' => $validatedData['requester_email'],
                'requester_phone' => $validatedData['requester_phone'],
                'requester_company' => $validatedData['requester_company'],
                'introduction_purpose' => $validatedData['introduction_purpose'],
                'message' => $validatedData['message'],
                'budget_range' => $validatedData['budget_range'],
                'status' => 'pending',
                'service_fee' => 2500, // KES 2,500
            ]);

            // Log the request creation
            Log::info('Introduction request created', [
                'request_id' => $introductionRequest->id,
                'requester_id' => Auth::id(),
                'target_type' => $validatedData['introduction_type'],
                'target_id' => $validatedData['target_id'],
            ]);

            // Notify the target user about the introduction request
            $targetUser->notify(new IntroductionRequestReceived($introductionRequest));

            // Notify admin about new introduction request
            $admin = \App\Models\User::where('registration_type', 'Admin')->first();
            if ($admin) {
                $admin->notify(new IntroductionRequestReceived($introductionRequest));
            }

            return redirect()->back()->with('success', 'Your introduction request has been submitted successfully. You will be notified once it is reviewed and approved.');

        } catch (\Exception $e) {
            Log::error('Failed to create introduction request', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'request_data' => $validatedData,
            ]);

            return back()->withErrors(['error' => 'An error occurred while submitting your request. Please try again.'])->withInput();
        }
    }

    /**
     * Display introduction requests for admin
     */
    public function index()
    {
        $introductionRequests = IntroductionRequest::with([
            'requester',
            'targetUser',
            'businessTarget',
            'investorTarget'
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(20);

        return view('admin.introduction-requests.index', compact('introductionRequests'));
    }

    /**
     * Approve an introduction request
     */
    public function approve($id)
    {
        try {
            $introductionRequest = IntroductionRequest::findOrFail($id);

            $introductionRequest->update([
                'status' => 'approved',
                'reviewed_by' => Auth::id(),
                'reviewed_at' => now(),
            ]);

            // Notify both parties about the approval
            $introductionRequest->requester->notify(new IntroductionApproved($introductionRequest));
            $introductionRequest->targetUser->notify(new IntroductionApproved($introductionRequest));

            // Send introduction email (you can implement this separately)
            $this->sendIntroductionEmail($introductionRequest);

            Log::info('Introduction request approved', [
                'request_id' => $introductionRequest->id,
                'approved_by' => Auth::id(),
            ]);

            return redirect()->back()->with('success', 'Introduction request approved and parties have been notified.');

        } catch (\Exception $e) {
            Log::error('Failed to approve introduction request', [
                'request_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return back()->withErrors(['error' => 'Failed to approve introduction request.']);
        }
    }

    /**
     * Reject an introduction request
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        try {
            $introductionRequest = IntroductionRequest::findOrFail($id);

            $introductionRequest->update([
                'status' => 'rejected',
                'rejection_reason' => $request->rejection_reason,
                'reviewed_by' => Auth::id(),
                'reviewed_at' => now(),
            ]);

            // Notify requester about rejection
            $introductionRequest->requester->notify(new IntroductionRejected($introductionRequest));

            Log::info('Introduction request rejected', [
                'request_id' => $introductionRequest->id,
                'rejected_by' => Auth::id(),
                'reason' => $request->rejection_reason,
            ]);

            return redirect()->back()->with('success', 'Introduction request rejected and requester has been notified.');

        } catch (\Exception $e) {
            Log::error('Failed to reject introduction request', [
                'request_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return back()->withErrors(['error' => 'Failed to reject introduction request.']);
        }
    }

    /**
     * Send introduction email to both parties
     */
    private function sendIntroductionEmail($introductionRequest)
    {
        try {
            // Get target details
            if ($introductionRequest->target_type === 'business') {
                $target = $introductionRequest->businessTarget;
                $targetName = $target->application_data['company_name'] ?? 'Business';
                $targetDetails = [
                    'type' => 'Business',
                    'name' => $targetName,
                    'industry' => $target->application_data['business_industry'] ?? 'N/A',
                    'location' => $target->application_data['city'] ?? 'N/A',
                ];
            } else {
                $target = $introductionRequest->investorTarget;
                $targetName = $target->company_name;
                $targetDetails = [
                    'type' => 'Investor',
                    'name' => $targetName,
                    'focus' => $target->buyer_interest ?? 'N/A',
                    'location' => $target->current_location ?? 'N/A',
                ];
            }

            // Here you would implement your email sending logic
            // This could be done using Laravel's Mail facade with Mailable classes
            // For now, just log that the email would be sent
            Log::info('Introduction email would be sent', [
                'request_id' => $introductionRequest->id,
                'requester_email' => $introductionRequest->requester_email,
                'target_email' => $introductionRequest->targetUser->email,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send introduction email', [
                'request_id' => $introductionRequest->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}