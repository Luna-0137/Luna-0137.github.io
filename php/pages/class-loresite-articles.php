<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite_Articles
{
    public function __construct()
    {

    }

    public static function show_page()
    {
        //load the classes required for making the table
        require_once dirname(__DIR__) . '/tables/class-loresite-table-articles.php';
        require_once dirname(__DIR__) . '/queries/class-loresite-queries-articles.php';

        $tables = new loresite_Table_Articles;
        $queries = new loresite_Queries_Articles;

        $data = $queries->get_short_articles();
        $columns = ['Title', 'Slug', 'Updated', 'Created'];
       
        //show the table
        echo '<br>';
        echo $tables->generate_table('Articles', $columns, $data);
    }
}