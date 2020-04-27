<?php

abstract class Model
{
    protected Db $db;

    public function __construct()
    {
        $this->db = new Db();
    }
}