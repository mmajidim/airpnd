<?php
/**
* @desc Provides XML services
* 
* @copyright    MindShare HDV LLC. 2012. All rights reseverd.
*               Property of MindShare HDV. This file can not be used, altered, in any way
*               without expressed written permission from MindShare HDV, LLC.
* @version      1.2.1
* @author       Stuti Manandhar
* @file         customService.php
* @date         11/15/2012
*
* @todo            
*/

require_once("nexusPath.inc");
require_once("config/config.php");


// check_login();

$customWeb = new CustomWebService();
$customWeb ->readRequest();

$result = $customWeb->processRequest();



header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
//  added header to allow cross domain request
header('Access-Control-Allow-Origin: *');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');

if ($customWeb->isJSONDecode())
{
    print_r($result);
}
else
{
    echo $result;
}