<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite_PageFinder
{
    public function __construct()
    {
        $this->page_finder($_GET);
    }

    private function page_finder($data)
    {
        if($data['page'] === 'home') {
            require_once dirname(__DIR__) . '/php/pages/class-loresite-homepage.php';
            loresite_Homepage::show_page();
        }
        elseif($data['page'] === 'articles') {
            require_once dirname(__DIR__) . '/php/pages/class-loresite-articles.php';
            loresite_Articles::show_page();
        }
        elseif($data['page'] === 'login') {
            require_once dirname(__DIR__) . '/php/forms/class-loresite-form.php';
            loresite_Form::setFormType(FormType::LOGIN);
            loresite_Form::getInstance()->showForm( ( empty( $_GET['id'] )  ) ? null : $_GET['id'] );
        }
        elseif($data['page'] === 'article') {
            require_once dirname(__DIR__) . '/php/forms/class-loresite-form.php';
            loresite_Form::setFormType(FormType::ARTICLE);
            loresite_Form::getInstance()->showForm( ( empty( $_GET['id'] )  ) ? null : $_GET['id'] );
        }
        else{
            require_once dirname(__DIR__) . '/php/pages/class-loresite-content.php';
            loresite_Content::show_page();
        }
    }
}