/**
 * @file       commentError.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for error page.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added error page functionality and
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    06/30/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    fix minor alingment issue
 */ 
$(function(){
        var userDetails = sessionManager('getSession');
        if(userDetails)
        {
            $('#errorMessage').slideDown();
            setInterval(function(){
                    var timeLeft    = $("#timeLeft").html().split(' ')[0];                                
                    if(eval(timeLeft) == 0)
                    {
                        window.location = 'index.php';                 
                    }
                    else
                    {  
                        $("#timeLeft").html(eval(timeLeft)- eval(1)+' Sec');
                    }
                }, 1000);
        }
});
/* End of file commentError.js */
/* Location: ./js/commentError.js */ 
