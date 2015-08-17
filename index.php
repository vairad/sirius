<?php

session_start();

//load libraries prepared by composer
require_once 'vendor/autoload.php';

//prepare logger
Logger::configure("./conf/logger.config.xml");
$logger = Logger::getLogger("main");


$logger->debug("Before loading of modules");
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

$logger->debug("After all modules loaded");

// start the application
$logger->debug("Create application");
$app = new app();

$logger->debug("Database connect");
$app->connectDB();

/*
// process login or logout
if(@$_REQUEST["do"] == "login"){
    $app->login();
}
if(@$_REQUEST["do"] == "logout"){
    $app->logout();
}
*/

/** debug part */
// printr($data);
/** debug part */

$logger->debug("Prepare twig template");
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('templates'); // path to folder with templates
$twig = new Twig_Environment($loader); // no cache

$logger->debug("Load chosen template (see style.inc.php)");
$template = $twig->loadTemplate(TEMPLATE);

$logger->debug("Show result");
echo $template->render($data);

$logger->debug("End of index.php");