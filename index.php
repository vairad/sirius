<?php
/**
 * Created by PhpStorm.
 * User: Radek
 * Date: 10. 8. 2015
 * Time: 14:52
 */

//spustí session
session_start();

//load libraries prepared by composer
require_once 'vendor/autoload.php';

/** ========================================================================= */
/** @var array[] storage for data to show by twig*/
$data = array();

//preparation of arrays
$data["data"] = array();
$data["error"] = array();
$data["success"] = array();

/** ========================================================================= */
// load configuration
require 'conf/config.inc.php';
require 'conf/functions.inc.php'; //helpful functions
require 'conf/style.inc.php';
//require 'conf/const.inc.php';



/** ========================================================================= */
// nacist objekty - soubory .class.php
require 'core/app.class.php';	                     // drzi hlavni funkcionalitu cele aplikace, obsahuje routing = navigovani po webu
require 'db/db.class.php';		                	// zajisti pristup k db a spolecne metody pro dalsi pouziti
//require 'application/db/mistaDB.class.php';		// zajisti pristup ke konkretnim db tabulkam - objekt vetsinou zajisti pristup k cele sade souvisejicich tabulek
//require 'application/db/osobyDB.class.php';
//require 'application/db/hryDB.class.php';
//require 'application/db/uvedeniDB.class.php';
//require 'application/db/prihlaskyDB.class.php';

/** ========================================================================= */
//datove struktury
//require 'application/core/data/hrac.class.php';
//require 'application/core/data/misto.class.php';
//require 'application/core/data/hra.class.php';
//require 'application/core/data/uvedeni.class.php';

/** ========================================================================= */

Logger::configure("./conf/logger.config.xml");
$logger = Logger::getLogger("main");
$logger->debug("Pouze jedna zpráva");

// start the application
$app = new app();
$app->connectDB();


// process login or logout
if(@$_REQUEST["do"] == "login"){
    $app->login();
}
if(@$_REQUEST["do"] == "logout"){
    $app->logout();
}

/** debug part */
// printr($data);
/** debug part */

//setup twig
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('templates'); // path to folder with templates
$twig = new Twig_Environment($loader); // no cache

// load chosen template (see style.inc.php)
$template = $twig->loadTemplate(TEMPLATE);

//compute output
echo $template->render($data);