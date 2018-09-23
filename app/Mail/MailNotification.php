<?php
/**
 * mailable
 * @category  mail
 * @package   mailable
 * @author    Si.nd <si.nd@altplus.com.vn>
 * @license   Altplus
 * @version   1
 * @link      url
 */
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * mailable
 * @category  mail
 * @package   mailable
 * @author    Si.nd <si.nd@altplus.com.vn>
 * @license   Altplus
 * @version   1
 * @link      url
 */
class MailNotification extends Mailable
{
    use Queueable, SerializesModels;
    private $noti;
    private $userMakeAction;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($noti, $userMakeAction)
    {
        $this->noti = $noti;
        $this->userMakeAction = $userMakeAction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = 'Your has been received notification from Your friend';
        if ($this->noti->notificationable_type == 'likepost') {
            $message = $this->userMakeAction->name . ' like your post';
        }
        if ($this->noti->notificationable_type == 'likecomment') {
            $message = $this->userMakeAction->name . ' like your comment';
        }
        if ($this->noti->notificationable_type == 'repliedcomment') {
            $message = $this->userMakeAction->name . ' reply your comment';
        }
        if ($this->noti->notificationable_type == 'viewprofile') {
            $message = $this->userMakeAction->name . ' view your profile';
        }
        if ($this->noti->notificationable_type == 'comment') {
            $message = $this->userMakeAction->name . ' comment your post';
        }
        return $this->from('linkedindev@example.com', 'Linkedin Dev')
                    ->view('emails.notification')->with(['content' => $message]);
    }
}
