<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite_Homepage
{
    public function __construct()
    {

    }

    public static function show_page()
    {
        include_once dirname(__DIR__) . '\queries\class-loresite-queries-articles.php';
        $options = new loresite_Queries_Articles;
        $options = $options->get_articles();

        echo '<div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h2 class="text-center">Home:</h2> <hr>
                    <h5>Welcome to the lore website of The Empire of Neptune and Gremigunk!</h5> 
                </div>
            </div>
        </div>';
    }
}