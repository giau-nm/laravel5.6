<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Util
{

    /**
     * Validator params data from request.
     *
     * @param array $data  ex: ['id'=>1, 'content'=>'Good job.']
     * @param array $rules ex: ['id' => 'required|integer|exists:notifications,id']
     * @return boolean Return true if sussess, else return message error string.
     */
    public static function validatorParamsData($data, $rules)
    {
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return implode(' ', $validator->errors()->all());
        }

        return true;
    }

    /**
     * store image to server
     *
     * @param file   $image input image
     * @param string $path  where to store image
     * @return string           the path of stored image
     */
    public static function updateImage($image, $path)
    {
        if (isset($image) && $image) {
            $imageName = str_replace(' ', '', $image->getClientOriginalName());
            $path = Storage::disk('public')
            ->putFileAs($path, $image, time().$imageName);

            return 'storage/'.$path;
        }

        return null;
    }

    /**
     * store image when creating or updating post to server
     *
     * @param string $imagePath path of image
     * @return boolean          status of deletion
     */
    public static function deleteImage($imagePath)
    {
        $path = substr($imagePath, strlen('storage/'));
        $del = Storage::delete($path);

        return $del;
    }

    /**
     * Check diffrent between created time and current time
     *
     * @param string $createdAt create time
     * @param integer $textType type of text: default is 0: feed, 1: notification
     * @return boolean          status of deletion
     */
    public static function convertCreatedAt($createdAt, $textType = 0) {
        $textTime = [
            0 => [
                'years' => ' years ago',
                'year' => ' year ago',
                'months' => ' months ago',
                'month' => ' month ago',
                'days' => ' days ago',
                'day' => ' day ago',
                'hours' => ' hours ago',
                'hour' => ' hour ago',
                'minutes' => ' minutes ago',
                'minute' => ' minute ago',
                'seconds' => ' seconds ago',
                'second' => 'few seconds ago'
            ],
            1 => [
                'years' => 'y',
                'year' => 'y',
                'months' => 'mo',
                'month' => 'mo',
                'days' => 'd',
                'day' => 'd',
                'hours' => 'h',
                'hour' => 'h',
                'minutes' => 'm',
                'minute' => 'm',
                'seconds' => 's',
                'second' => 's'
            ]
        ];
        $text = $textTime[0];
        if (isset($textTime[$textType])) {
            $text = $textTime[$textType];
        }

        $str   = strtotime($createdAt);
        $today = strtotime(date('Y-m-d H:i:s'));

        // It returns the time difference in Seconds...
        $time_differnce = $today - $str;

        // To Calculate the time difference in Years...
        $years   = 60 * 60 * 24 * 365;

        // To Calculate the time difference in Months...
        $months  = 60 * 60 * 24 * 30;

        // To Calculate the time difference in Days...
        $days    = 60 * 60 * 24;

        // To Calculate the time difference in Hours...
        $hours   = 60 * 60;

        // To Calculate the time difference in Minutes...
        $minutes = 60;

        if (intval($time_differnce/$years) > 1) {
            return intval($time_differnce/$years).$text['years'];
        }

        if (intval($time_differnce/$years) > 0) {
            return intval($time_differnce/$years).$text['year'];
        }

        if (intval($time_differnce/$months) > 1) {
            return intval($time_differnce/$months).$text['months'];
        }

        if (intval(($time_differnce/$months)) > 0) {
            return intval(($time_differnce/$months)).$text['month'];
        }

        if (intval(($time_differnce/$days)) > 1) {
            return intval(($time_differnce/$days)).$text['days'];
        }

        if (intval(($time_differnce/$days)) > 0) {
            return intval(($time_differnce/$days)).$text['day'];
        }

        if (intval(($time_differnce/$hours)) > 1) {
            return intval(($time_differnce/$hours)).$text['hours'];
        }

        if (intval(($time_differnce/$hours)) > 0) {
            return intval(($time_differnce/$hours)).$text['hour'];
        }

        if (intval(($time_differnce/$minutes)) > 1) {
            return intval(($time_differnce/$minutes)).$text['minutes'];
        }

        if (intval(($time_differnce/$minutes)) > 0) {
            return intval(($time_differnce/$minutes)).$text['minute'];
        }

        if (intval(($time_differnce)) > 1) {
            return intval(($time_differnce)).$text['seconds'];
        }

        return $text['second'];
    }

   /**
   * Multibyte trim
   *
   * Strip whitespace from the beginning and end of a string.
   *
   * @param  string|array $input The input that will be trimmed.
   * @return string
   */
    public static function mbTrim($input)
    {
        if (is_array($input)) {
            foreach ($input as $key => $value) {
                if (is_array($input[$key])) {
                    $input[$key] = mb_trim_recursive($input[$key]);
                } else {
                    $input[$key] = preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $input[$key]);
                }
            }
        } else {
            $input = preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $input);
        }

        return $input;
    }
}
