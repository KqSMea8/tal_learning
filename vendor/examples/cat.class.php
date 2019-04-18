<?php

class vendor_examples_cat
{
    protected $handle;

    public function __construct(vendor_examples_animal $animal)
    {
        $this->handle = $animal;
    }

    public function Say()
    {
        $this->handle->Say("喵喵喵");
    }
}