<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

session_unset();
session_destroy();
header("location: index.php?page=home");
exit;