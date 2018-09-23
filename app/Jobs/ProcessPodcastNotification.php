<?php
/**
 * Push job to queue
 * @category  Queue
 * @package   Jobs
 * @author    Si.nd <si.nd@altplus.com.vn>
 * @license   Altplus https://altplus.com.vn/
 * @version   1
 * @link      https://altplus.com.vn/
 */
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Models\Notification;

/**
 * Push job to queue
 * @category  Queue
 * @package   Jobs
 * @author    Si.nd <si.nd@altplus.com.vn>
 * @license   Altplus https://altplus.com.vn/
 * @version   1
 * @link      https://altplus.com.vn/
 */
class ProcessPodcastNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userMakeAction;
    private $noti;
    private $emailReceived;

    /**
     * Create a new job instance.
     * @param array $noti Object record notification
     * @param $userMakeAction User make some action like, comment ...
     * @param $emailReceived Email will received notification
     * @return void
     */
    public function __construct($noti, $userMakeAction, $emailReceived)
    {
        $this->noti = $noti;
        $this->userMakeAction = $userMakeAction;
        $this->emailReceived = $emailReceived;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $rs = Notification::where('id', $this->noti->id)->first();
        if ($rs->is_readed == 0) {
            $message = new \App\Mail\MailNotification($this->noti, $this->userMakeAction);
            Mail::to($this->emailReceived)->send($message);
        }
    }
}
