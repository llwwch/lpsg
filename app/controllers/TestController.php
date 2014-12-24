<?php

class TestController extends BaseController
{
    public function testForm()
    {
        return View::make('test');
    }

    public function testSubmit($id)
    {
        var_dump($id);
    }
}