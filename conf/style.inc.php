<?php
global $data;
//název použité šablony
define("NAME", "link");

// nastavení konkrétní šablony dle názvu
define('TEMPLATE', NAME.".html");

/** pozice části view v adresářové struktuře*/
define('VIEW_TEMPLATES', "./templates");


$data["my_css"]=VIEW_TEMPLATES."/".NAME.".css";
$data["favico"]=VIEW_TEMPLATES."/picture/".NAME."_favicon.png";

$data["template_home"]=VIEW_TEMPLATES."/".NAME."/";


// nastavení cest k bootstrapu
$data["bootstrap_css"]="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css";
$data["bootstrap_theme"]="./vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css";
$data["bootstrap_js"]="./vendor/twbs/bootstrap/dist/js/bootstrap.min.js";

//nastavení cest k tinyMCE
$data["tinymce_js"]="./vendor/tinymce/tinymce/tinymce.min.js";

//nastavení cest k tinyMCE
$data["jquery_js"]="./vendor/jquery/jquery/jquery-1.10.2.min.js";

// nastavení metadat
$data ["meta_description"] = "Stránky skautského oddílu Sirius z Plzně Doubravky.";
$data["meta_keywords"] = "skauting, junák, Sirius, děti, skauti, skautky, Plzeň, Doubravka";


$data["title"] =  ODDIL ." - ". CISLO ."skautský oddíl z Plzně Doubravky";
?>