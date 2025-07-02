<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

interface I_loresite_Form 
{
    public function showForm(int $id = null);
    public function submit(array $data);
    public function sanitize(array $data);
}