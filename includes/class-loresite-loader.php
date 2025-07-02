<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite_Loader
{
    public function __construct()
    {
        if(!isset($_GET['page']))
        {
            header("location: index.php?page=home"); 
            exit;
        }

        //load title
        require_once dirname(__DIR__) . '/includes/class-loresite-pagetitle.php';

        //load header
        require_once dirname(__DIR__) . '/includes/class-loresite-header.php';
        new loresite_Header;

        //load navbar
        require_once dirname(__DIR__) . '/includes/class-loresite-navbar.php';
        new loresite_Navbar;

        //load sidebar
        require_once dirname(__DIR__) . '/includes/class-loresite-sidebar.php';
        new loresite_Sidebar;

        //load js
        require_once dirname(__DIR__) . '/includes/class-loresite-js.php';
        new loresite_JS;

        //query & table loader
        require_once dirname(__DIR__) . '/php/queries/class-loresite-queries.php';
        require_once dirname(__DIR__) . '/php/tables/class-loresite-table.php';

        //page loader
        require_once dirname(__DIR__) . '/includes/class-loresite-pageloader.php';
        new loresite_PageLoader;
    }
}