<?php

namespace App\Http\View\Composers;
use App\Service\MenuService;
use Illuminate\View\View;

class menuComposer
{
    public function compose(View $view)
    {
        $menu = (new MenuService)->getMenu();
        $view->with('admin_menu', $menu['admin_menu']);
        $view->with('menu', $menu['user_menu']);
    }
}
