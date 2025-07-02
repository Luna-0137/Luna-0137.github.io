<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

if(!interface_exists('I-loresite-Form')) {
    require_once dirname(__DIR__) . '/forms/class-loresite-I-form.php';
}

class loresite_Form_Login implements I_loresite_Form 
{
    public function __construct()
    {
        
    }

    public function showForm(int $id = null)
    {
      echo'<div class="container">
         <div class="card shadow user-card">
            <div class="card-body">
            <div class="row">
               <div class="col-md-8">
                  <h2 class="card-title"> Login for Lore-Writers </h2>
                  <hr> ' . inputField('username','Username:','text', true, null) .
                  inputField('password','Password:','password', true, null) .
                  '<br> <input type="submit" value="Submit" name="submit" class="btn btn-warning">
                </div>
               <div class="col-md-4">
                  <div class="p-3 h-100 bg-light border-start rounded-end">
                  <p class="mb-2 fw-semibold"> <h5> Reminder: </h5> </p>
                    '.contentStyler(' Are you not a lorewriter? [br] Head to [ref]articles|Articles[/ref] to read the lore! [br][br] Ask Luna for the login credentials if you need them.').'
                  </div>
               </div>
            </div>
            </div>
         </div>
      </div>';
    }

    public function submit(array $data)
    {
        if($data['username'] === 'Luna' && $data['password'] === 'banglue')
        {
            $_SESSION["loggedin"] = true;

            header("location: index.php?page=home");
            exit();
        }
    }

    public function sanitize(array $data)
    {
        
    }
}