<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite_PageTitle
{
    public function __construct()
    {
        
    }
    
    /**
     * Give the title of the page
     * @param $data The data from $_GET 
     */
    public static function page_title($data)
    {
        $pages = [ 
            'home' => 'Home',
            'articles' => 'Articles',
            'login' => 'Login',
            'article' => 'Article Builder'
            ];

        include_once dirname(__DIR__) . '\php\queries\class-loresite-queries.php';
        $queries = new loresite_Queries;
        $articles = $queries->select('articles', []);

        foreach($articles as $article)
        {
            $pages[$article['slug']] = $article['slug'];
        }

        
        if($data['page'] === 'logout' )
        {
            include_once dirname(__DIR__) . '\includes\class-loresite-logout.php';
            exit;
        }

        if(!isset($pages[$data['page']]))
        {
            header("location: index.php?page=home"); 
            exit;
        }

        return $pages[$data['page']];
    }
}