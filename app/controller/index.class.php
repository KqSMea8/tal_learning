<?php

class controller_index extends fw_controller_base
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $cat = app("vendor_examples_cat");
        $cat->Say();
    }
}