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

/**
 * Push job to queue
 * @category  Queue
 * @package   Jobs
 * @author    Si.nd <si.nd@altplus.com.vn>
 * @license   Altplus https://altplus.com.vn/
 * @version   1
 * @link      https://altplus.com.vn/
 */
class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $listEmail;

    public $timeout = 30;

    /**
     * Create a new job instance.
     * @param array $listEmail Array Email
     *
     * @return void
     */
    public function __construct($listEmail)
    {
        $this->listEmail = $listEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = new \App\Mail\InviteNetwork();
        Mail::to($this->listEmail)->send($message);
    }
}
