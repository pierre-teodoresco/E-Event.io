<?php

class DefaultController{

    public function __construct()
    {
    }

    public function index(){
        View::montrer('main/index');
    }

}