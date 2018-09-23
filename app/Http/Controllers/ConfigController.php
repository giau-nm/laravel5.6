<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Manh GIAU
 * Date: 9/13/2018
 * Time: 2:00 PM
 */

namespace App\Http\Controllers;

#use App\Repositories\ConfigRepository;
#use App\Repositories\UserRepository;
use App\Services\SearchService;
use App\Services\ConfigService;
use App\Services\UserService;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Response;

class ConfigController extends AppBaseController
{
    public function __construct()
    {
		$this->searchService = new SearchService();
		$this->configService = new ConfigService();
		$this->userService = new UserService();
    }

    public function index()
    {
        $pageTitle = trans('label.configs.lbl_config_heading');
        $config = $this->configService->getConfig();
        $listNormalUser = $this->userService->listNormalUser();
        $listAdminlUser = $this->userService->listAdminUser();

        return view('configs.index', compact('pageTitle', 'config', 'listNormalUser', 'listAdminlUser'));
    }

    public function update($_id, Request $request)
    {
        $this->configService->updateConfig($request->all());

        return redirect(route('configs.index'));
    }
}