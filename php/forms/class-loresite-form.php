<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

if(!interface_exists('I-loresite-Form')) {
    require_once dirname(__DIR__) . '/forms/class-loresite-I-Form.php';
}

if(!class_exists('loresite-Form-Login')) {
    require_once dirname(__DIR__) . '/forms/class-loresite-form-login.php';
}

if(!class_exists('loresite-Form-Login')) {
    require_once dirname(__DIR__) . '/forms/class-loresite-form-article.php';
}

enum FormType{

    case LOGIN;
    case ARTICLE;

    public function enum_to_string($formType) 
    {
        $result = "";

        $result = ($formType === FormType::LOGIN) ? "FormType::LOGIN" : $result;
        $result = ($formType === FormType::ARTICLE) ? "FormType::ARTICLE" : $result;

        return $result;
    }
}

class loresite_Form 
{
    private static ? FormType $formType = null;
    private static $f;
    private static I_loresite_Form $formObj;

    private function __construct() 
    {
        if(self::$formType === FormType::LOGIN) {
            self::$formObj = new loresite_Form_Login();
        }
        if(self::$formType === FormType::ARTICLE) {
            self::$formObj = new loresite_Form_Article();
        }
    }

    /**
    * Enqueue's and includes the javascript file for form validation based on the form type
    */
    public static function getFormJS() 
    {
        $DateTime = date( 'Y-m-d H:i:s' );

        if(self::$formType === FormType::ARTICLE) {
            echo '<script src="js/form-validation-article.js?v=' . $DateTime. '"></script>';
        }
    }

    public static function getInstance() 
    {
        if(null === static::$f)
        {
            static::$f = new static();
        }
        return static::$f;
    }

    public static function setFormType(FormType $ft) 
    {
        self::$formType = $ft;
    }

    public static function getFormType() 
    {
        return self::$formType;
    }

    public function showForm(int $id = null) 
    {
        if (isset($_POST['submit'])) 
        {
            self::$formObj->submit($_POST);
        }

        echo '<form id="'. self::$formType->enum_to_string(self::$formType) .'"  action="" method="post">';
        self::$formObj->showForm($id);
        self::getFormJS();
        echo'</form>';
    }

}