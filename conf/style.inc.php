<?php
global $data;
//název použité šablony
define("NAME", "default");

// nastavení cest k bootstrapu
$data["bootstrap_css"]="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css";
$data["bootstrap_theme"]="./vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css";
$data["bootstrap_js"]="./vendor/twbs/bootstrap/dist/js/bootstrap.min.js";

//nastavení cest k tinyMCE
$data["tinymce_js"]="./vendor/tinymce/tinymce/tinymce.min.js";

//nastevení cest k bootstrap datepicker todo datepicker zvážit použití
//$data["bootstrap_datepicker"]=VIEW_CORE."/twbs/bootstrap-datepicker/bootstrap-datepicker.js";
//$data["bootstrap_dp_css"]=VIEW_CORE."/twbs/bootstrap-datepicker/css/datepicker3.css";
//$data["bootstrap_dp_locale"]=VIEW_CORE."/twbs/bootstrap-datepicker/locales/bootstrap-datepicker.cs.js";


/** pozice části view v adresářové struktuře*/
define('VIEW_TEMPLATES', "./templates");

// nastavení konkrétní šablony dle názvu
define('TEMPLATE', NAME.".html");

$data["my_css"]=VIEW_TEMPLATES."/".NAME.".css";
$data["header_img"]=VIEW_TEMPLATES."/picture/".NAME."_header.png";
$data["favico"]=VIEW_TEMPLATES."/picture/".NAME."_favicon.png";

?>