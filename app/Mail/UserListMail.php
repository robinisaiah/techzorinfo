<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserListMail extends Mailable
{
    use Queueable, SerializesModels;

    public $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function build()
    {
        // dd($this->filePath);

        if (!file_exists($this->filePath)) {
            throw new \Exception("Attachment file does not exist: " . $this->filePath);
        }

        return $this->subject('User List Report')
                    ->view('emails.user_list')
                    ->attach($this->filePath, [
                        'as' => 'user_list.xlsx',
                        'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    ]);
    }
}
