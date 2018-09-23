<?php

namespace App\Utils;

class Common
{
    const STATUS_PENDING_REQUEST = 0;
    const STATUS_CONNECTED_USER = 1;
    const STATUS_REJECTED_USER = 2;
    const NOTIFICATION_TYPE_POST = 'post';
    const NOTIFICATION_TYPE_COMMENT = 'comment';
    const CONTACT_IN_DB = 0;
    const CONTACT_NOT_IN_DB = 1;
    const ARR_MONTH = array(
        1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 
        7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
    );
}
