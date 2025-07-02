<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

if(!interface_exists('I-loresite-Form')) {
    require_once dirname(__DIR__) . '/forms/class-loresite-I-form.php';
}

class loresite_Form_Article implements I_loresite_Form 
{
    public function __construct()
    {
        if(!isset($_SESSION['loggedin']))
        {
            header("location: index.php?page=home");
            exit(); 
        }
    }

    public function showForm(int $id = null)
    {
        if($id != null) {
            if(!class_exists('loresite_Queries_Articles')) {
                require_once dirname( __DIR__) . '/queries/class-loresite-queries-articles.php';
            }

            $queries = new loresite_Queries_Articles;

            $formArr = $queries->get_article_by_id($_GET['id']);
            $formArr = $formArr[0];

            if (isset($_GET['delete']) && $_GET['delete'] === 'true') {
                $queries->delete_article($id);    
                echo '<script>
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.delete("page");
                currentUrl.searchParams.delete("id");
                currentUrl.searchParams.delete("delete");
                currentUrl.searchParams.set("page", "player_form");
                window.location.href = currentUrl.href;
            </script>';
            exit;
            }     
        }

      echo'<div class="container">
         <div class="card shadow user-card">
            <div class="card-body">
            <div class="row">
               <div class="col-md-8">
                  <h2 class="card-title"> Make/Edit a Article! </h2>
                  <hr>'.
                  inputField('title','Title','text', false , ((empty($formArr))) ? '' : $formArr['title']).
                  inputField('slug','Slug','text', false , ((empty($formArr))) ? '' : $formArr['slug']).
                  inputTextArea('content','Main Content', false , ((empty($formArr))) ? '' : $formArr['content']).
                  inputTextArea('side_content','Side Content', false , ((empty($formArr))) ? '' : $formArr['side_content']).
                '<br> <input type="submit" value="Submit" name="submit" class="btn btn-warning">';
                
                if($id != null) {
                    echo inputButton('Delete_Article', 'Delete Article', 'class="btn btn-danger"');
                }
                
                echo'</div>
               <div class="col-md-4">
                  <div class="p-3 h-100 bg-light border-start rounded-end">
                  <p class="mb-2 fw-semibold"> <h5> Reminder: </h5> </p>
                  You can use to following commands: <br>
                  <br> [b] & [/b] Opens and closes <b> Bold </b>
                  <br> [i] & [/i] Opens and closes <i> Italic </i>
                  <br> [u] & [/u] Opens and closes <u> Underline </u>
                  <br> [s] & [/s] Opens and closes <s> Striketrough </s>
                  <br>[br] Makes a newline <br> (Though double enter does also work) <br>
                  <br> [h1] & [/h1] up to [h6] & [/h6] Makes <h5> differently sized emphasized text </h5>
                  <br> [ref]articlename|Filler Title[/ref] makes '.contentStyler('[ref]articles | a link[/ref]').'
                  <br> [img]filename[/img] makes a image appear '.contentStyler('[img]luna.png[/img]').'
                 </div>
               </div>
            </div>
            </div>
         </div>
      </div>';

        //hidden input to pass along the id
        if(isset($formArr['id']))
        {
            echo '<input type="hidden" name="id" value="' . $formArr['id'] . '"/>';
        }
    }

    public function submit(array $data)
    {
        unset($data['submit']);
        unset($data['Delete_Article']);

        require_once dirname(__DIR__) . '/queries/class-loresite-queries-articles.php';
        $queries = new loresite_Queries_Articles;

        if(!isset($data['id'])) {
            $queries->insert_article($data);
            header("location: index.php?page=" . $data['slug']);
            exit();
        }
        else {
            $queries->update_article($data);
            header("location: index.php?page=" . $data['slug']);
            exit();
        }
    }

    public function sanitize(array $data)
    {
        
    }
}