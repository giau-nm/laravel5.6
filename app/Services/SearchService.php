<?php
/**
 * ContactService
 * @category  Service
 * @package   Contact
 * @author    minhkq <minh.kq@altplus.com.vn>
 * @license   Altplus
 * @version   1
 * @link      url
 */
namespace App\Services;

use App\Models\Search;
use Carbon\Carbon;

class SearchService
{
    protected $fieldSearchable = [
        'id',
        'search_str',
        'ip',
        'user_agent',
        'created_at',
        'user_id',
    ];

    public function createSearch($request)
    {
        $search = new Search();
        $search->user_id = '';
        $search->search_str = '';

        if ($request->user_id) $search->user_id = $request->user_id;
        if ($request->search_str) $search->search_str = $request->search_str;
        $search->created_at = Carbon::now()->toDateTimeString();
        $search->ip = $request->ip();
        $search->user_agent = $request->header('user-agent');

        return $search->save();
    }

    public function list($request) {
        $searchsModel = new Search();
        if (!is_null($request->q)) {
            $searchs = $searchsModel->where('searrch_str', 'like', '%' . $request->q . '%')
                                   ->orWhere('ip', 'like', '%' . $request->q . '%')
                                   ->orWhere('user_agent', 'like', '%' . $request->q . '%')
                                   ->orWhere('created_at', 'like', '%' . $request->q . '%');
        } else {
            $searchs = $searchsModel;
        }
        $acceptSortColumn = [
            'search_str'  => 'search_str',
            'ip'          => 'ip',
            'user_agent'  => 'user_agent',
            'created_at'  => 'created_at',
            'user_id'     => 'user_id',
            'id'          => 'id'
        ];
        $acceptSortOrder = ['asc', 'desc'];
        $sortColumn = $request->sort;
        $sortOrder = $request->order;
        if (isset($sortColumn) && isset($sortOrder) && array_key_exists($sortColumn, $acceptSortColumn) && in_array($sortOrder, $acceptSortOrder)) {
            $searchs = $searchs->orderBy($sortColumn, $sortOrder);
        } else {
            $searchs->orderBy('id', 'ASC');
        }
        if (!is_null($request->export) && $request->export == 1) {
            $searchs = $searchs->get();
        } else {
            $searchs = $searchs->paginate(PAGGING_NUMBER_DEFAULT);
            $searchs->appends([
                'q'     => $request->q,
                'sort'  => $request->sort,
                'order' => $request->order
            ]);
        }
        return $searchs;

    }

    public function getSortData($request)
    {
        $sortData = [
            'id' => [
                'url' => $request->fullUrlWithQuery(['sort' => 'id', 'order' => 'asc']),
                'class' => 'sort-by'
            ],
            'search_str' => [
                'url' => $request->fullUrlWithQuery(['sort' => 'search_str', 'order' => 'asc']),
                'class' => 'sort-by'
            ],
            'ip' => [
                'url' => $request->fullUrlWithQuery(['sort' => 'ip', 'order' => 'asc']),
                'class' => 'sort-by'
            ],
            'user_agent' => [
                'url' => $request->fullUrlWithQuery(['sort' => 'user_agent', 'order' => 'asc']),
                'class' => 'sort-by'
            ],
            'created_at' => [
                'url' => $request->fullUrlWithQuery(['sort' => 'created_at', 'order' => 'asc']),
                'class' => 'sort-by'
            ],
            'user_id' => [
                'url' => $request->fullUrlWithQuery(['sort' => 'user_id', 'order' => 'asc']),
                'class' => 'sort-by'
            ],
        ];
        $sort = $request->sort;
        $order = $request->order;
        $acceptSortColumn = $this->fieldSearchable;
        $acceptSortOrder = ['asc', 'desc'];
        if (in_array($sort, $acceptSortColumn) && in_array($order, $acceptSortOrder)) {
            $newOrder = $order == 'asc' ? 'desc' : 'asc';
            $sortData[$sort]['url'] = $request->fullUrlWithQuery(['sort' => $sort, 'order' => $newOrder]);
            $sortData[$sort]['class'] = 'sort-by-' . $order;
        }
        return $sortData;
    }

    public function generateNotification($config)
    {
        if ($config->is_show_nf) return ['isShowNotification' => false];

        if ($config->style_notification === CONFIG_STYLE_NOTIFICATION_BASIC) {
            return [
                'isShowNotification' => false,
                'notificationData' => [
                    'type' => 'basic',
                    'iconUrl' => url('/images/icons/icon_test.jpg'),
                    'title' => 'Test Title',
                    'message' => 'Test message',
                    'eventTime' => 5000,
                    'imageUrl' => url('/images/pictures/picture1.jpg'),
                ]
            ];
        }

        if ($config->style_notification === CONFIG_STYLE_NOTIFICATION_IMAGE) {
            return [
                'isShowNotification' => true,
                'notificationData' => [
                    'type' => 'image',
                    'iconUrl' => url('/images/icons/icon_test.jpg'),
                    'title' => 'Test Title',
                    'message' => 'Test message',
                    'eventTime' => 5000,
                    'imageUrl' => url('/images/pictures/picture1.jpg'),
                ]
            ];
        }

        if ($config->style_notification === CONFIG_STYLE_NOTIFICATION_LIST) {
            return [
                'isShowNotification' => true,
                'notificationData' => [
                    'type' => 'list',
                    'iconUrl' => url('/images/icons/icon_test.jpg'),
                    'title' => 'Test Title',
                    'message' => 'Test message',
                    'eventTime' => 5000,
                    'items' => [
                        [ 'title'   => 'title', 'message' => 'message' ],
                        [ 'title'   => 'title2', 'message' => 'message2' ],
                        [ 'title'   => 'title3', 'message' => 'message3' ],
                        
                    ]
                ]
            ];
        }

        if ($config->style_notification === CONFIG_STYLE_NOTIFICATION_PROGRESS) {
            return [
                'isShowNotification' => true,
                'notificationData' => [
                    'type' => 'progress',
                    'iconUrl' => url('/images/icons/icon_test.jpg'),
                    'title' => 'Test Title',
                    'message' => 'Test message',
                    'eventTime' => 5000,
                    'progress' => 70,
                ]
            ];
        }
    }


}
