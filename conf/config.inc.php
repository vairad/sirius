<?php

/**
 * Main configuration file
 *
 * !!modify before release!!
 *
 * contains
 *      PHP setup modifying
 *      DB login
 *      global project constants
 */

//=====================================================================================================================
/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/** constant defines debug mode */
define('DEBUG', true);

/**
 * Prints message only in debug mode. (defines by DEBUG constant)
 * @param $message - message to show
 */
function debugPrint($message){
    if(DEBUG){
        printr($message);
    }
}

//=====================================================================================================================
/**
 * Constant contains name of session.
 */
define('MY_SES', "sirius_session_AfxDGl");

/**
 * Shortcut for base of web
 */
//local
    define('WEB_DOMAIN', 'http://localhost/sirius');
//online
    //define('WEB_DOMAIN', 'deplyoywebsirius'); todo

//=====================================================================================================================
/**
 * Connection to database.
 */
// local
    define('DB_TYPE', 'mysql');
    define('DB_HOST', '127.0.0.1');
    define('DB_DATABASE_NAME', 'sirius');
    define('DB_USER_LOGIN', 'sirius');
    define('DB_USER_PASSWORD', '');

// online
//    define('DB_TYPE', '');
//    define('DB_HOST', '');
//    define('DB_DATABASE_NAME', '');
//    define('DB_USER_LOGIN', '');
//    define('DB_USER_PASSWORD', '');


/**
 * Basic database constants.
 */
// prefix of all tables
define('TABLE_PREFIX', '');

// aliases for table names
//define('TABLE_MISTA', TABLE_PREFIX.'mista');


