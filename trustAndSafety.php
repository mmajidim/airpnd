<?php
/**
 * @file       trustAndSafety.php
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       trust and safety page
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    updated trust and safety page
 *             done with minor formatting
 * @revDate    04/07/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    updated trust and safety page
 *             done with minor formatting
 * @revDate    07/1/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 */
    if(!class_exists('commonFunction'))
    {       
        include_once 'commonFunction.php';
        $airpnd = new CommonFunction();
    }
    $airpnd->loadHeader();
    $cssFiles = array("jquery", "bootstrap","layout");
    $airpnd->loadCss($cssFiles);
    $scriptFiles = array("site","common");
    $airpnd->loadScripts($scriptFiles);
    $airpnd->loadMenu();
    $airpnd->loadContent('trustAndSafety');
    $airpnd->loadFooter();
/* End of file trustAndSafety.php */
/* Location: trustAndSafety.php */
?>
