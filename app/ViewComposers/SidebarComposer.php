<?php


namespace App\ViewComposers;


use App\Models\Roles\MainMenu;
use Illuminate\View\View;

class SidebarComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $main_menus =   MainMenu::query()->with('menuGroups' , 'menuGroups.subMenus')->get();
//        dd($main_menus);
        $view->with('main_menus', end($main_menus));
    }

}
