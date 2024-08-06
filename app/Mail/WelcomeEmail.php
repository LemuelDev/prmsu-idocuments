<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $mailmessage;
     public $name;
     public $username;
     public $email;

     public $age;

     public $sex;

     public $birthday;

     public $phone_number;

     public $address;
     public $course;
     public $year;

    public function __construct($message, $name, $username, $email, $age, $course ,$year, $sex, $address, $birthday, $phone_number)
    {
        $this->mailmessage = $message;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->age = $age;
        $this->course = $course;
        $this->year = $year;
        $this->sex = $sex;
        $this->address = $address;
        $this->birthday = $birthday;
        $this->phone_number = $phone_number;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Good day!Thanks for signing up to PRMSU CANDELARIA iDOCUMENTS!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'shared.welcome-email',
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
}
