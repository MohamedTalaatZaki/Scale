<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Roles\MainMenu;
use App\Models\Roles\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Zizaco\Entrust\EntrustRole;

class RolesController extends Controller
{
    public function index() {
        $roles  =   Role::query()->with('perms' , 'users')->paginate('10');
        return view('master-data.roles.index' , ['roles' => $roles]);
    }

    public function create() {
        $main_menus =   MainMenu::query()->with('menuGroups' , 'menuGroups.subMenus')->get();
        return view('master-data.roles.create' , ['main_menus' => $main_menus]);
    }

    public function store(Request $request) {
        $this->validate($request  , [
            'name'      =>  'required|unique:roles,name',
            'permissions'   =>  'required|array'
        ]);

        $role   =   Role::query()->create([
            'name'     =>   $request->get('name'),
        ]);

        $role->attachPermissions($request->get('permissions'));

        return redirect()->action('MasterData\RolesController@index')->with('success' , trans('global.role_created'));
    }

    public function edit($id) {
        $role   =   Role::query()->with('perms')->where('id' , $id)->first();
        $main_menus =   MainMenu::query()->with('menuGroups' , 'menuGroups.subMenus')->get();
        return view('master-data.roles.edit' , ['main_menus' => $main_menus , 'role' => $role]);
    }

    public function update(Request $request , $id) {
        $this->validate($request  , [
            'name'      =>  'required|unique:roles,name,'.$id,
            'permissions'   =>  'required|array'
        ]);

        $role   =   Role::query()->findOrFail($id);
        $role->update(['name' => $request->get('name')]);
        $role->perms()->sync([]);
        $role->attachPermissions($request->get('permissions'));

        return redirect()->action('MasterData\RolesController@index')->with('success' , trans('global.role_updated'));
    }
}
