<?php

abstract class BaseModel extends Eloquent
{
    protected $enableOnSearch = [];

    protected function inputSearch($query, $data)
    {
        return (new \CSearch($query, $this->enableOnSearch))->query($data);
    }
}