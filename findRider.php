<?php
/**
 * @file       findRider.php
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       find rider  page
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added search rider page
 *             done with minor formatting
 * @revDate    07/1/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 */
    include 'commonFunction.php';
    $airpnd = new CommonFunction();
    $airpnd->loadHeader();
    $cssFiles = array("jquery", "bootstrap","layout");
    $airpnd->loadCss($cssFiles);
    $scriptFiles = array("site","common","liquidSlider","findRider");
    $airpnd->loadScripts($scriptFiles);
    $airpnd->loadMenu();
    $airpnd->loadContent('findRider');
    $airpnd->loadFooter();
/* End of file findRider.php */
/* Location: findRider.php */
?>
