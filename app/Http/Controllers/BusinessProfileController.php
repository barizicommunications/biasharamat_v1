<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Business;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use App\Services\PesapalService;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BusinessSellerSignup;
use App\Notifications\ApplicationUnderReview;
use App\Http\Requests\BusinessProfileRegistrationRequest;

class BusinessProfileController extends Controller
{
    public function create()
    {
        if (!\Auth::check()) {
            return redirect()->route('login');
        }

        return view('seller.business-profile-registration');
    }


    public function inbox()
{
    $conversations = Conversation::where('user_one_id', auth()->id())
        ->orWhere('user_two_id', auth()->id())
        ->with(['messages', 'userOne', 'userTwo'])
        ->get();

    return view('messages.inbox', compact('conversations'));
}



public function showPaymentPage()
{
    $paymentData = session('payment_data');

    if (!$paymentData) {
        // Handle the case where there's no payment data in the session
        return redirect()->route('business.profile.create')->withErrors('No payment data found.');
    }

    return view('filament.resources.payment.register-pay', [
        // 'amount' => $paymentData['amount'],
        'amount' => 1,
        'description' => $paymentData['description'],
        'callback' => $paymentData['callback'],
    ]);
}



// public function processPayment(Request $request, PesapalService $pesapalService)
// {


//     $OrderTrackingId = $request->query('pesapal_transaction_tracking_id');
//     $OrderMerchantReference = $request->query('pesapal_merchant_reference');

//     if (!$OrderTrackingId || !$OrderMerchantReference) {
//         return redirect()->route('businessVerificationCallPage')->withErrors('Missing required payment parameters.');
//     }

//     // Fetch the token
//     $token = $pesapalService->getToken();

//     if (!$token) {
//         return redirect()->route('businessVerificationCallPage')->withErrors('Failed to retrieve token.');
//     }

//     // Fetch transaction status from Pesapal
//     $getTransactionStatusUrl = "https://pay.pesapal.com/v3/api/Transactions/GetTransactionStatus?orderTrackingId=$OrderTrackingId";

//     $response = \Http::withHeaders([
//         'Accept' => 'application/json',
//         'Content-Type' => 'application/json',
//         'Authorization' => "Bearer $token",
//     ])->get($getTransactionStatusUrl);


//     $data = $response->json();

//     \Log::info('Pesapal Transaction Response:', ['response' => $data]);
//     \Log::info('Payment Status Description:', ['status' => $data['payment_status_description']]);




//     if ($response->failed()) {
//         return redirect()->route('businessVerificationCallPage')->withErrors('Failed to fetch transaction status.');
//     }

//     $data = $response->json();

//     try {
//         // Save the order
//         $order = Order::create([
//             'paid_by' => Auth::user()->id,
//             'payment_method' => 'MpesaKE',
//             'amount' => $data['amount'] ?? 0,
//             'confirmation_code' => $data['confirmation_code'] ?? null,
//             'order_tracking_id' => $OrderTrackingId,
//             'payment_status_description' => $data['payment_status_description'] ?? 'N/A',
//             'description' => $data['description'] ?? null,
//             'message' => $data['message'] ?? 'Transaction processed',
//             'payment_account' => $data['payment_account'] ?? 'Mpesa',
//             'call_back_url' => $data['call_back_url'] ?? null,
//             'status_code' => $data['status_code'] ?? 200,
//             'merchant_reference' => $OrderMerchantReference,
//             'payment_status_code' => $data['payment_status_code'] ?? null,
//             'currency' => $data['currency'] ?? 'KES',
//             'status' => $data['status'] ?? '200',
//         ]);

//         // Update the business profile status
//         $businessProfile = BusinessProfile::where('user_id', Auth::user()->id)->latest()->first();


//         \Log::info('Business Profile Retrieved:', ['businessProfile' => $businessProfile]);

//         if ($businessProfile) {
//             if ($data['payment_status_description'] === 'Completed') {
//                 $businessProfile->verification_status = 'approved';
//                 $businessProfile->save();

//                 return redirect()->route('businessVerificationCallPage')->with('success', 'Payment was successful and your profile has been approved.');
//             } else {
//                 $businessProfile->verification_status = 'rejected';
//                 $businessProfile->save();

//                 return redirect()->route('businessVerificationCallPage')->withErrors('Payment failed. Please try again.');
//             }
//         }

//     } catch (\Exception $e) {
//         \Log::error('Failed to save order: ' . $e->getMessage());
//         return redirect()->route('businessVerificationCallPage')->withErrors('An error occurred while processing your payment. Please try again.');
//     }
// }



public function processPayment(Request $request, PesapalService $pesapalService)
{
    \Log::info('Starting payment processing...');

    $OrderTrackingId = $request->query('pesapal_transaction_tracking_id');
    $OrderMerchantReference = $request->query('pesapal_merchant_reference');

    \Log::info('Received Request Parameters:', [
        'OrderTrackingId' => $OrderTrackingId,
        'OrderMerchantReference' => $OrderMerchantReference,
    ]);

    if (!$OrderTrackingId || !$OrderMerchantReference) {
        \Log::error('Missing required payment parameters.');
        return view('seller.verification-call-page')->withErrors('Missing required payment parameters.');
    }

    // Fetch the token
    $token = $pesapalService->getToken();

    if (!$token) {
        \Log::error('Failed to retrieve token from Pesapal.');
        return view('seller.verification-call-page')->withErrors('Failed to retrieve token.');
    }

    \Log::info('Pesapal Token Retrieved:', ['token' => $token]);

    // Fetch transaction status from Pesapal
    $getTransactionStatusUrl = "https://pay.pesapal.com/v3/api/Transactions/GetTransactionStatus?orderTrackingId=$OrderTrackingId";

    \Log::info('Requesting Transaction Status from Pesapal:', ['url' => $getTransactionStatusUrl]);

    $response = \Http::withHeaders([
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'Authorization' => "Bearer $token",
    ])->get($getTransactionStatusUrl);

    if ($response->failed()) {
        \Log::error('Failed to fetch transaction status from Pesapal.');
        return view('seller.verification-call-page')->withErrors('Failed to fetch transaction status.');
    }

    $data = $response->json();

    \Log::info('Pesapal Transaction Response:', ['response' => $data]);

    try {
        // Save the order
        \Log::info('Attempting to save order...');

        $order = Order::create([
            'paid_by' => Auth::user()->id,
            'payment_method' => 'MpesaKE',
            'amount' => $data['amount'] ?? 0,
            'confirmation_code' => $data['confirmation_code'] ?? null,
            'order_tracking_id' => $OrderTrackingId,
            'payment_status_description' => $data['payment_status_description'] ?? 'N/A',
            'description' => $data['description'] ?? null,
            'message' => $data['message'] ?? 'Transaction processed',
            'payment_account' => $data['payment_account'] ?? 'Mpesa',
            'call_back_url' => $data['call_back_url'] ?? null,
            'status_code' => $data['status_code'] ?? 200,
            'merchant_reference' => $OrderMerchantReference,
            'payment_status_code' => $data['payment_status_code'] ?? null,
            'currency' => $data['currency'] ?? 'KES',
            'status' => $data['status'] ?? '200',
        ]);

        \Log::info('Order Saved Successfully:', ['order' => $order]);

        // Update the business profile status
        \Log::info('Fetching Business Profile for User ID:', ['user_id' => Auth::user()->id]);

        $businessProfile = BusinessProfile::where('user_id', Auth::user()->id)->latest()->first();

        if ($businessProfile) {
            \Log::info('Business Profile Retrieved:', ['businessProfile' => $businessProfile]);

            if (strtolower($data['payment_status_description']) === 'completed') {
                $businessProfile->verification_status = 'approved';
                $businessProfile->save();
                \Log::info('Business Profile Status Updated to Approved');
                return view('seller.verification-call-page')->with('success', 'Payment was successful and your profile has been approved.');
            } else {
                $businessProfile->verification_status = 'rejected';
                $businessProfile->save();
                \Log::info('Business Profile Status Updated to Rejected');
                return view('seller.verification-call-page')->withErrors('Payment failed. Please try again.');
            }
        }

        \Log::error('Business Profile Not Found for User ID:', ['user_id' => Auth::user()->id]);
        return view('seller.verification-call-page')->withErrors('Business profile not found.');

    } catch (\Exception $e) {
        \Log::error('Failed to save order or update business profile:', ['error' => $e->getMessage()]);
        return view('seller.verification-call-page')->withErrors('An error occurred while processing your payment. Please try again.');
    }
}





public function show(string $id)
{
    $sellerProfile = BusinessProfile::where('id', $id)->firstOrFail();

    // Decode JSON fields with fallbacks
    $applicationData = $sellerProfile->application_data ?? [];
    $documents = $sellerProfile->documents ?? [];

    // Add default fallbacks for missing keys
    $applicationData['business_industry'] = $applicationData['business_industry'] ?? 'Industry not specified';
    $applicationData['company_name'] = $applicationData['company_name'] ?? 'Company name not provided';
    $applicationData['business_description'] = $applicationData['business_description'] ?? 'Description not available';
    $applicationData['number_employees'] = $applicationData['number_employees'] ?? 'Not specified';
    $applicationData['business_highlights'] = $applicationData['business_highlights'] ?? 'No highlights available';
    $applicationData['product_services'] = $applicationData['product_services'] ?? 'No product services available';

    return view('seller.profile-overview', compact('sellerProfile', 'applicationData', 'documents'));
}



    public function store(BusinessProfileRegistrationRequest $request)
{
    try {
        // Validate the request data
        $validatedData = $request->validated();



        $businessPhoto = $request->file('business_photo');


        if ($businessPhoto) {
            // Generate a unique name for the file before saving it
            $fileName = time() . '-' . $businessPhoto->getClientOriginalName();

            // Store the file in the specified directory (e.g., storage/app/public/information_memorandums)
            $photofilePath = $businessPhoto->storeAs('public/business_photos', $fileName);
        }




        $informationMemorandum = $request->file('information_memorandum');

        if ($informationMemorandum) {
            // Generate a unique name for the file before saving it
            $fileName = time() . '-' . $informationMemorandum->getClientOriginalName();

            // Store the file in the specified directory (e.g., storage/app/public/information_memorandums)
            $memorandumfilePath = $informationMemorandum->storeAs('public/information_memorandums', $fileName);
        }


        // Handle the financial report file
        $financialReport = $request->file('financial_report');

        if ($financialReport) {
            // Generate a unique name for the file before saving it
            $fileName = time() . '-' . $financialReport->getClientOriginalName();

            // Store the file in the specified directory (e.g., storage/app/public/financial_reports)
            $financialfilePath = $financialReport->storeAs('public/financial_reports', $fileName);
        }


        // Handle the valuation worksheet file
        $valuationWorksheet = $request->file('valuation_worksheets');

        if ($valuationWorksheet) {
            // Generate a unique name for the file before saving it
            $fileName = time() . '-' . $valuationWorksheet->getClientOriginalName();

            // Store the file in the specified directory (e.g., storage/app/public/valuation_worksheets)
            $valuationfilePath = $valuationWorksheet->storeAs('public/valuation_worksheets', $fileName);
        }




        // Get the authenticated user
        $user = Auth::user();


        // Create the business profile
        $businessProfile = new BusinessProfile($validatedData);
        $businessProfile->user_id = $user->id;
        $businessProfile->business_photos = $photofilePath;
        $businessProfile->information_memorandum = $memorandumfilePath;
        $businessProfile->financial_report = $financialfilePath;
        $businessProfile->valuation_worksheets = $valuationfilePath;
        $businessProfile->save();


        // Notify the user that their application is under review
        $user->notify(new ApplicationUnderReview($user));


        // Notify the admin about the new signup
        $admin = User::where('registration_type', 'Admin')->first();
        $admin->notify(new BusinessSellerSignup($user));



        return redirect()->route('businessVerificationCallPage');

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Redirect back with input and error messages
        return redirect()->back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        // Handle any other exceptions
        return redirect()->back()->with('error', 'An error occurred while creating the business profile.'.$e->getMessage() )->withInput();
    }
}


}
