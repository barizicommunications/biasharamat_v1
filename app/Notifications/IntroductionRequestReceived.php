<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\IntroductionRequest;

class IntroductionRequestReceived extends Notification implements ShouldQueue
{
    use Queueable;

    protected $introductionRequest;

    public function __construct(IntroductionRequest $introductionRequest)
    {
        $this->introductionRequest = $introductionRequest;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $targetName = $this->introductionRequest->target_name;
        $requesterName = $this->introductionRequest->requester_name;

        return (new MailMessage)
            ->subject('New Introduction Request Received')
            ->greeting('Hello!')
            ->line("You have received a new introduction request from {$requesterName}.")
            ->line("They are interested in connecting with: {$targetName}")
            ->line("Purpose: {$this->introductionRequest->formatted_purpose}")
            ->line("Message: {$this->introductionRequest->message}")
            ->action('View Request', url('/admin/introduction-requests'))
            ->line('This request will be reviewed and processed by our team.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'introduction_request_id' => $this->introductionRequest->id,
            'requester_name' => $this->introductionRequest->requester_name,
            'target_name' => $this->introductionRequest->target_name,
            'purpose' => $this->introductionRequest->formatted_purpose,
            'message' => 'New introduction request received'
        ];
    }
}

class IntroductionApproved extends Notification implements ShouldQueue
{
    use Queueable;

    protected $introductionRequest;

    public function __construct(IntroductionRequest $introductionRequest)
    {
        $this->introductionRequest = $introductionRequest;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $isRequester = $notifiable->id === $this->introductionRequest->requester_id;
        $otherPartyName = $isRequester
            ? $this->introductionRequest->target_name
            : $this->introductionRequest->requester_name;

        return (new MailMessage)
            ->subject('Introduction Request Approved')
            ->greeting('Great news!')
            ->line('Your introduction request has been approved.')
            ->line("You will now be connected with: {$otherPartyName}")
            ->line('Our team will facilitate the introduction shortly.')
            ->line('You will receive contact details and next steps within 24 hours.')
            ->action('View Dashboard', url('/active-introductions'))
            ->line('Thank you for using our professional introduction service!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'introduction_request_id' => $this->introductionRequest->id,
            'target_name' => $this->introductionRequest->target_name,
            'message' => 'Your introduction request has been approved'
        ];
    }
}

class IntroductionRejected extends Notification implements ShouldQueue
{
    use Queueable;

    protected $introductionRequest;

    public function __construct(IntroductionRequest $introductionRequest)
    {
        $this->introductionRequest = $introductionRequest;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Introduction Request Update')
            ->greeting('Hello,')
            ->line('We have reviewed your introduction request.')
            ->line('Unfortunately, we are unable to process this request at this time.')
            ->line("Reason: {$this->introductionRequest->rejection_reason}")
            ->line('You may submit a new request with additional information if you wish.')
            ->action('Browse Opportunities', url('/investment-opportunities'))
            ->line('Thank you for your understanding.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'introduction_request_id' => $this->introductionRequest->id,
            'rejection_reason' => $this->introductionRequest->rejection_reason,
            'message' => 'Your introduction request was not approved'
        ];
    }
}