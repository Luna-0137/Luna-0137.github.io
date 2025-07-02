<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite_Sidebar
{
    public function __construct()
    {
        $html ='<div class="container-fluid">
        <div class="row">
        
        <div class="col-md-2 sidebar">
            <h6 class="text-uppercase px-3">Pages</h6>
            <a href="index.php?page=home"><i class="fas fa-home"></i> Home</a>
            <a href="index.php?page=articles"><i class="far fa-newspaper"></i> Articles</a>';

            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                $html .= '<a href="index.php?page=article"><i class="fas fa-pencil-alt"></i> Make new Article</a>
                <a href="index.php?page=logout"><i class="fas fa-door-open"></i> Logout</a>';
            }
            else {
                $html .= '<a href="index.php?page=login"><i class="fas fa-pen-nib"></i> Writer Login</a>';
            }

            $html .= '</div>';
        echo $html;
    }
}