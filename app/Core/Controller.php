<?php

require 'app/Config/PC.php';

class Controller extends PC
{
    public $v_viewer, $v_content, $v_load;
    public function __construct()
    {
        if (!isset($_SESSION['config'])) {
            $_SESSION['config']['setting'] = $this->get_json("setting");
            $_SESSION['config']['api_key'] = $this->get_json("api_key");
            $_SESSION['config']['level'] = $this->get_json("level");
            $_SESSION['config']['notif'] = $this->get_json("notif");
            $_SESSION['config']['dep_rek'] = $this->get_json("dep_rek");
            $_SESSION['config']['user_admin'] = $this->get_json("user_admin");
            $_SESSION['config']['access'] = $this->get_json("access");
            $_SESSION['config']['privilege'] = $this->get_json("privilege");
            $_SESSION['config']['bank'] = $this->get_json("bank");
        }
    }

    public function view_layout($con, $data = [])
    {
        require_once "app/Views/Layout/main.php";
    }

    public function view_layout_admin($con, $data = [])
    {
        require_once "app/Views/Layout_Admin/main.php";
    }

    public function view($con, $file, $data = [])
    {
        require_once "app/Views/Pages/" . $file . ".php";
    }

    public function view_info($file)
    {
        require_once "app/Views/InfoPage/" . $file . ".php";
    }

    public function load($dir, $file)
    {
        require_once "app/Views/Load/" . $dir . "/" . $file . ".php";
    }

    public function model($file)
    {
        require_once "app/Models/" . $file . ".php";
        return new $file();
    }

    public function db($db = 0)
    {
        $file = "M_DB";
        require_once "app/Models/" . $file . ".php";
        return new $file($db);
    }

    public function func($file)
    {
        require_once "app/Functions/" . $file . ".php";
        return new $file();
    }

    function get_json($file)
    {
        $get = file_get_contents("app/Config/JSON/" . $file . ".json");
        $data = json_decode($get, true);
        return ($data);
    }
}
