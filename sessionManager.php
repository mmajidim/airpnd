<?php

/**
 * @file       sessionManager.php
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       class sessionManager functions
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc     done with minor formatting
 * @revDate    07/1/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 */
    class SessionManager {
        //________________________ C O N S T R U C T O R _________________________

        /**
        * @desc   - Constructor
        * @access - public
        * @param  - none
        * @return - none
        */
        function __construct() 
        {
            //intialize session
            if (!isset($_SESSION))
            {
                session_start();
            }
        }

        //_______________ S E S S I O N  M A N A G E R   U T I L I T Y ________________

        /**
        * @desc   - set session
        * @access - public
        * @param  - none
        * @return - set session object
        */
        function setSession($key,$value) 
        {
            $_SESSION[$key] = $value;
            if($key == 'user')
            {        
                $_SESSION['isLoggedIn'] = TRUE;
            }
        }

        /**
        * @desc   - get session
        * @access - public
        * @param  - none
        * @return - the user session object
        */
        function getSession($key) 
        {
            print json_encode(isset($_SESSION[$key]) ? $_SESSION[$key] : null);
        }

        /**
        * @desc   - is logged in
        * @access - public
        * @param  - none
        * @return - whether user is logged in.
        */
        function isLoggedIn()
        {
            return (isset($_SESSION['isLoggedIn']) ? $_SESSION['isLoggedIn'] : FALSE);
        }

        /**
        * @desc   - sestroy session
        * @access - public
        * @param  - none
        * @return - sestroy the session
        */
        function destroySession() 
        { 
            session_destroy();
        }

        /**
        * @desc   - load function load the function as per requirements come out
        * @access - public
        * @param  - string $functionName : function name.
        * @return - load the requested function.
        */
        function loadFunction($functionName, $key = null , $value = null) 
        {
            switch ($functionName) 
            {
                case "setSession":
                    $this->setSession($key, $value);
                    break;
                case "getSession":
                    $this->getSession($key);
                    break;
                case "destroySession":
                    $this->destroySession();
                    break;
            }
        }   
    }

/* End of file commonFunction.php */
/* Location: commonFunction.php */
?>