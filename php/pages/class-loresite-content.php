<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite_Content
{
   public function __construct()
   {

   }

   public static function show_page()
   {
      //get the article
      include_once dirname(__DIR__) . '\queries\class-loresite-queries-articles.php';
      $queries = new loresite_Queries_Articles;
      $article = $queries->get_article_by_slug($_GET['page']);

      //fill in the article
      echo'<div class="container">
         <div class="card shadow user-card">
            <div class="card-body">
            <div class="row">
               <div class="col-md-8">
                  <h2 class="card-title"> ' . $article[0]['title'];
                  
                  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                     echo ' ' . '<a href="index.php?page=article&id='.$article[0]['id'].'"><button class="btn btn-warning">Edit</button></a>';
                  }

                  echo '</h2>
                  <hr> ' . contentStyler($article[0]['content']) . '
               </div>
               <div class="col-md-4">
                  <div class="p-3 h-100 bg-light border-start rounded-end">
                  <p class="mb-2 fw-semibold"> <h5> Related Articles: </h5> </p>
                  ' . contentStyler($article[0]['side_content']) . '
                  </div>
               </div>
            </div>
            </div>
         </div>
      </div>';
   }
}