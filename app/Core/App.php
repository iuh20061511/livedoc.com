<?php

class App
{

    private $controller, $action, $params;
    function __construct()
    {

        $this->controller = 'home';
        $this->action = 'index';
        $this->params = [];
        $this->handleUrl();
    }



    public function handleUrl()
    {

        $urlArray = $this->UrlProcess();

        // Controller    
        if (!empty($urlArray[0])) {
            $this->controller = ucfirst($urlArray[0]);
        } else {
            $this->controller = ucfirst($this->controller);
        }

        if (file_exists("./app/Controllers/" . $this->controller . ".php")) {
            require_once "./app/Controllers/" . $this->controller . ".php";

            //Kiểm tra class $this->controller tồn tại
            if (class_exists($this->controller)) {
                $this->controller = new $this->controller();
                unset($urlArray[0]);
            } else {
                $this->loadError();
            }
        } else {
            $this->loadError();
        }



        //  Xử lý action

        if (!empty($urlArray[1])) {
            if (method_exists($this->controller, $urlArray[1])) {
                $this->action = $urlArray[1];
            } 
            // else {
            //     //Nếu url có action không khớp với phương thức trong class thì cho rỗng
            //     $this->action ='';
            // }

            unset($urlArray[1]);
        }

        $this->params = $urlArray ? array_values($urlArray) : [];


        if (method_exists($this->controller, $this->action)) {
            // Tên controler, tên hàm muốn chạy là ai, tham số dùng để chạy
            call_user_func_array([$this->controller, $this->action], $this->params);
        } 
    }



    public function UrlProcess()
    {
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
    }


    public function loadError($name = '404')
    {
        require './app/errors/' . $name . '.php';
    }
}
