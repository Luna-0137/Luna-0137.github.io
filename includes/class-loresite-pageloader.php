<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite_PageLoader
{
    public function __construct()
    { 
      echo '<div class="col-md-10 offset-md-2 py-4">';
      
        //page finder
        require_once dirname(__DIR__) . '/includes/class-loresite-pagefinder.php';
        new loresite_PageFinder;

        echo'<footer class="footer mt-5">
        <div class="container">
          <div class="d-flex justify-content-between small text-muted">
            <div> <a href="#">&copy; Luna 2025</a> </div>
            <div>
              <a href="#">Privacy Policy</a> ·
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>

    </div>
    </body> 
    </html>';
    }
}