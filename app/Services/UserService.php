<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Utils\Common;
use App\Models\Like;
use App\Models\User;

class UserService
{

    public function listNormalUser()
    {
        return User::where('type', User::TYPE_NORMAL)->pluck('name', 'id');
    }

    public function listAdminUser()
    {
        return User::where('type', User::TYPE_ADMIN)
            #->where('id', '!=', \Auth::user()->id)
            ->pluck('name', 'id');
    }

    public function changeUserPermission($request)
    {
        $listBecomeAdmin  = $request->listBecomeAdmin;
        $listBecomeNormal = $request->listBecomeNormal;

        if (is_null($listBecomeNormal) && is_null($listBecomeAdmin)) {
            return [
                'success' => false,
                'message' => ''
            ];
        }
        $validated = $this->validateChangeUserPermission(['listBecomeAdmin' => $listBecomeAdmin, 'listBecomeNormal' => $listBecomeNormal]);
        if ($validated['status'] == STATUS_ERROR) {
            return [
                'success' => false,
                'message' => $validated['errors']
            ];
        }

        if (!is_null($listBecomeAdmin)) {
            $this->model->whereIn('id', $listBecomeAdmin)->update(['type' => User::TYPE_ADMIN]);
        }

        if (!is_null($listBecomeNormal)) {
            $this->model->whereIn('id', $listBecomeNormal)->update(['type' => User::TYPE_NORMAL]);
        }

        return [
            'success' => true,
            'message' => ''
        ];
    }
}