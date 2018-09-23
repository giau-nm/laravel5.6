<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\SearchService;
use App\Services\ConfigService;
use Illuminate\Http\Request;
use App\Helpers\Util;


class SearchController extends Controller
{
    public function __construct()
    {
        $this->searchService = new SearchService();
    }

    public function search(Request $request)
    {
        $config = new ConfigService();
        $this->searchService->createSearch($request);
        $response = $this->searchService->generateNotification($config->getConfig());
        return response()->json($response);

    }

    public function index(Request $request)
    {
        $pageTitle = trans('label.search.lbl_search_list_heading');
        $sortLinks = $this->searchService->getSortData($request);
        $searchs = $this->searchService->list($request);

        return view('searchs.index', compact('pageTitle', 'sortLinks', 'searchs'));
    }
}
