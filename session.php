<?php
/**
 * @file       session.php
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       session manager page
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    updated session manager
 *             done with minor formatting
 * @revDate    04/07/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    change include_once to require_once  
 *              done with minor formatting
 */
    if(!class_exists('sessionManager'))
    {       
         require_once 'sessionManager.php';
         $sessionManager = new SessionManager();
    }

    if (isset($_POST['functionName'])) 
    {
        $value = isset($_POST['value']) ? $_POST['value'] :'';   
        $sessionManager->loadFunction($_POST['functionName'],$_POST['key'],
                                      $value);
    }
/* End of file session.php */
/* Location: session.php */
?>
