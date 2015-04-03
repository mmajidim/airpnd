<?php
/**
 * @file       paidRide.php
 * @version    1.0.0
 * @author     Mehran Majidi
 * @desc       show rider information after payment
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2014. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    
 * @revAuthor  
 * @revDesc    
 *             
 */
    include 'commonFunction.php';
    $airpnd = new CommonFunction();
    $airpnd->loadHeader();
    $cssFiles = array("jquery", "bootstrap","layout");
    $airpnd->loadCss($cssFiles);
    $scriptFiles = array("site","common","paidRide");
    $airpnd->loadScripts($scriptFiles);
    $airpnd->loadMenu();
    $airpnd->loadContent('paidRide');
    $airpnd->loadFooter();
/* End of file confirmation.php */
/* Location: confirmation.php */
?>
