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
class InviteNetwork extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('linkedindev@example.com', 'Linkedin Dev')
                    ->view('emails.invited');
    }
}
