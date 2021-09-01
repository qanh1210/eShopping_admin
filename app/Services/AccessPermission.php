<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;

class AccessPermission
{
    public function setPermission(){
        $this->defineGateCategory();
    }

    public function defineGateCategory(){
        Gate::define('list-category','App\Policies\CategoryPolicy@view');
        Gate::define('edit-category','App\Policies\CategoryPolicy@update');
        Gate::define('add-category','App\Policies\CategoryPolicy@create');
        Gate::define('delete-category','App\Policies\CategoryPolicy@delete');
    }
}
