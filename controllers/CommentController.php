<?php

final class CommentController
{
    private $model;

    public function __construct()
    {
        $this->model = new CommentModel;
    }

}