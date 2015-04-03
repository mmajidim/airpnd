<?php
/**
 * @file       paidRider.php
 * @version    1.0.0
 * @author     Mehran Majidi
 * @desc       paid rider page
 * @date       06/23/2014
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
    $scriptFiles = array("site","common","paidRider");
    $airpnd->loadScripts($scriptFiles);
    $airpnd->loadMenu();
    $airpnd->loadContent('paidRider');
    $airpnd->loadFooter();
/* End of file paidRider.php */
/* Location: paidRider.php */
?>
