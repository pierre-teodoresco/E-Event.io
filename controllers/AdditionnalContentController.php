<?php

final class AdditionnalContentController
{
    private $model;

    public function __construct()
    {
        $this->model = new AdditionnalContentModel;
    }

}