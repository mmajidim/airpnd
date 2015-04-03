<?php
/**
 * @file       commonFunction.php
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       class common functions
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added common function class
 *             done with minor formatting
 * @revDate    07/1/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 */
    class CommonFunction 
    {
        //________________________ C O N S T R U C T O R _________________________

        /**
        * @desc   - Constructor
        * @access - public
        * @param  -
        * @return -
        */
        function __construct() 
        {

        }

        //_______________ S C R E E N   L O G I C   U T I L I T Y ________________

        /**
        * @desc   - helper function to setup common validation rules for new ticket
        *           creation
        * @access - private
        * @param  - string $fileName : header file name
        * @param  - array $script    : array of script files
        * @param  - array $css       : array of css files 
        * @return - string  $header  : content for header
        */
        function loadHeader() 
        {
            include 'views/layout/header.php';
        }

        /**
        *
        * @param type $scriptFiles 
        */
        function loadScripts($scriptFiles) 
        {
            foreach ($scriptFiles as $scriptFile) 
            {            
                include 'resource/htmlIncludes/' .$scriptFile .'.php';
            }        
        }
        function loadCss($cssFiles) 
        {
            foreach ($cssFiles as $cssFile) 
            {  
                include 'resource/htmlIncludes/' .$cssFile .'.php';
            }   
        }   

        function loadFooter() 
        {
            include 'views/layout/footer.php';
        }
        function loadMenu() 
        {
            include 'views/layout/menu.php';
        }

        /**
        *
        * @param type $fileName 
        */
        function loadContent($ContentFileName) 
        {
            include 'pages/' . $ContentFileName . '.php';
        } 
    }

/* End of file commonFunction.php */
/* Location: commonFunction.php */
?>