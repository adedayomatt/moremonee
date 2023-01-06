<?php

namespace App\Http\Controllers;

use App\Classes\Roles;
use App\User;
use Domain\Branches\Models\Branch;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return Authenticatable|User
     */
    public function user()
    {
        return Auth::user();
    }

    public function getTempUser()
    {
        return session()->get("temp-user");
    }

    public function setTempUser($user = null) {
        session()->put("temp-user", $user ? $user : (object) request()->only(["email"]));
        return $this->getTempUser();
    }

    public function getAuthBranches()
    {
        if ($this->user()->hasRole(Roles::ROLE_SUPER_ADMIN)) {
            return Branch::all();
        }

        return $this->user()->userBranches;
    }

    /**
     * @param $model
     * @return Builder
     */
    protected function scopeAuthQuery($model): Builder
    {
        return $model->query()
            ->when($this->user()->isAnEmployeeWithBranchScope(), function (Builder $query) {
                $query->whereIn('branch_id', $this->getAuthBranches()->pluck('id')->toArray());
            })
            ->when($this->user()->isAnEmployeeWithCustomerScope(), function (Builder $query) {
                $query->where('account_officer_id', $this->user()->getKey());
            });
    }

}
