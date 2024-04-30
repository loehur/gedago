<?php

require '../app/Config/PC.php';

class Controller extends PC
{

    public $v_viewer, $v_content, $v_load;

    //admin

    public function view_layout($con, $data = [])
    {
        require_once "../app_admin/Views/Layout/main.php";
    }

    public function view($con, $file, $data = [])
    {
        require_once "../app_admin/Views/Pages/" . $file . ".php";
    }

    public function load($dir, $file)
    {
        require_once "../app_admin/Views/Load/" . $dir . "/" . $file . ".php";
    }

    // user

    public function model($file)
    {
        require_once "../app/Models/" . $file . ".php";
        return new $file();
    }

    public function db($db = 0)
    {
        $file = "M_DB";
        require_once "../app/Models/" . $file . ".php";
        return new $file($db);
    }

    public function func($file)
    {
        require_once "../app/Functions/" . $file . ".php";
        return new $file();
    }
}
