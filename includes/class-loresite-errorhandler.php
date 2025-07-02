<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite_ErrorHandling
{
    public $errorlog_filepath;

    public function __construct()
    {
        // Set custom error and exception handlers
        set_error_handler(array($this, 'loresite_errorhandler'));
        set_exception_handler(array($this, 'loresite_exceptionhandler'));
        register_shutdown_function(array($this, 'loresite_shutdownhandler'));

        // Define the error log file path
        $this->errorlog_filepath = dirname(__DIR__) . '/documentation/error_log.txt';

        // Prevent PHP from displaying errors on screen
        ini_set('display_errors', 'Off');
        ini_set('log_errors', 'On');
        ini_set('error_log', $this->errorlog_filepath);
    }

    // Custom error handler
    public function loresite_errorhandler($errno, $errstr, $errfile, $errline)
    {
        $errorMessage = date('Y-m-d H:i:s') . " - Error [$errno]: $errstr in $errfile on line $errline\n";
        file_put_contents($this->errorlog_filepath, $errorMessage, FILE_APPEND);

        // Decide whether to stop script execution based on the error type
        if (!(error_reporting() & $errno)) {
            return false; // This error code is not included in error_reporting
        }

        switch ($errno) {
            case E_USER_ERROR:
            case E_ERROR:
                exit(1);
                break;
            case E_USER_WARNING:
            case E_WARNING:
                // Do not exit on warnings
                break;
            case E_USER_NOTICE:
            case E_NOTICE:
            case E_STRICT:
                // Do not exit on notices and strict standards
                break;
            default:
                // Handle other error types if necessary
                break;
        }

        /* Don't execute PHP internal error handler */
        return true;
    }

    // Custom exception handler
    public function loresite_exceptionhandler($exception)
    {
        $errorMessage = date('Y-m-d H:i:s') . " - Uncaught Exception: " . $exception->getMessage() . " in " . $exception->getFile() . " on line " . $exception->getLine() . "\n";
        file_put_contents($this->errorlog_filepath, $errorMessage, FILE_APPEND);
        exit(1); // Exit the script
    }

    // Shutdown handler to catch fatal errors
    public function loresite_shutdownhandler()
    {
        $error = error_get_last();
        if ($error !== null) {
            $errorMessage = date('Y-m-d H:i:s') . " - Fatal Error: " . $error['message'] . " in " . $error['file'] . " on line " . $error['line'] . "\n";
            file_put_contents($this->errorlog_filepath, $errorMessage, FILE_APPEND);
        }
    }
}
