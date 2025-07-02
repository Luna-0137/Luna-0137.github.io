<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite
{
    public function __construct()
    {
        session_start();
        $this->load_dependencies();
    }

    private function load_dependencies()
    {
        //start output buffering
        ob_start();

        //load error handling
        require_once dirname(__DIR__) . '/includes/class-loresite-errorhandler.php';
        new loresite_ErrorHandling;

        //load db connection
        require_once dirname(__DIR__) . '/includes/class-loresite-dbconnect.php';
        new loresite_Dbh;

        //load functions
        require_once dirname(__DIR__) . '/includes/class-loresite-functions.php';

        //load key files and begin including requested content
        require_once dirname(__DIR__) . '/includes/class-loresite-loader.php';
        new loresite_Loader;

        //end the output buffer
        ob_end_flush();
    }
}