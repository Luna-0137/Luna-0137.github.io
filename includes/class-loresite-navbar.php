<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite_Navbar
{
    public function __construct()
    {
        $html = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
          <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="index.php?page='.$_GET['page'].'">Lore Website</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
              <span class="navbar-toggler-icon"></span>
            </button>
          </div>
        </nav>';
        echo $html;
    }
}