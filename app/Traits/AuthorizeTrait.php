<?php
/**
 * Created by PhpStorm.
 * User: Sanatechnology
 * Date: 2019-09-10
 * Time: 9:01 AM
 */

namespace App\Traits;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

trait AuthorizeTrait
{
    public function authorized($permission){
        $user = Auth::user();
        if(!$user->can($permission)){
            App::abort(403);
        };
    }
}