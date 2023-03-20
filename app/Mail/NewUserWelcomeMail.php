<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
class NewUserWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New User Welcome Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build(){

        $subscriber = [
            'email_address' => $this->user->email,
            'status' => 'subscribed',
            'merge_fields' => [
                'FNAME' => $this->user->name,
            ],
        ];

        $data_center = config('services.mailchimp.dc');
        $list_id = config('services.mailchimp.list_id');

        // $response = Mailchimp::post("lists/$list_id/members", $subscriber);

       
        return $this->subject('Welcome to Our TODO LIST App!')
        ->view('emails.email', 
        ['user' => $this->user]);
    }
}
