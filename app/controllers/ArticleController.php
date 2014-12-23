<?php

class ArticleController extends BaseController
{

    public function create()
    {
        return View::make('tinymce');
    }
}