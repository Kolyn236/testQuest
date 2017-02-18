<?php
/**
 * Created by PhpStorm.
 * User: usver
 * Date: 13.02.2017
 * Time: 12:50
 */

namespace app;


class App
{
    public function showView($view)
    {
        include_once 'view/' . $view . '.php';
    }
}