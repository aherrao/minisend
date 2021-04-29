<?php

namespace App\Mail;

use App\Models\Email\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SenderEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $objEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Email $objEmail)
    {
        $this->objEmail = $objEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject($this->objEmail->subject)
            ->from($this->objEmail->from_email)
            ->view('emails.sender_email')
            ->with('objEmail', $this->objEmail);

        $arrObjAttachments = $this->objEmail->attachments;

        foreach($arrObjAttachments as $objAttachment) {
            $email->attach(storage_path('app/public') . $objAttachment->path);
        }

        return $email;
    }
}
