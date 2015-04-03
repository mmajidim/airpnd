/**
 * @file       commentIndex.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for index page.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added home page functionality and
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    fixed issue and done with minor formatting
 * @revDate    06/02/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    updated video functionality and done with minor formatting
 * @revDate    06/30/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    fix minor alingment issues
 */ 

$(function(){        
        $.session.clear('pageLocation');
        initializeCoursel('myCarousel',3000);        
        getLocation('airportLocation',true);
        $('#news').innerfade({
            animationtype: 'fade',
            speed: 3000,
            timeout:1,
            type: 'random',
            containerheight: '110px'
        }); 
        //navigation on social button click
        $('.socialConnect img').on('click',function(){
            var pageURL = '#';
            switch($(this).attr('alt'))
            {
                case "facebook":
                    pageURL = FACEBOOK;
                    break;
                case 'twitter':
                    pageURL = TWITTER;
                    break;
                case 'flicker' :
                    pageURL = FLICKR;
                case 'vimeo'  :
                    pageURL = VIMEO;
            }
            window.location.href = pageURL;
        }); 
  
        // on video end load
        $( "video" ).on( "ended", function() {
            this.load()
        });

        $('#go_btn').on('click',function()
            {
                if($('#airportLocation option:gt(0)').is(':selected'))
                {             
                    $.session.set('pageLocation', 
                            $('#airportLocation option:selected').val());  
                    window.location = $('#airspndPage .active').
                                        attr('data-for');
                }
                return false;
        });
        
        $('.airspndPage').on('click',function()
        {
            $('.airspndPage').toggleClass('active'); 
        });
    });
/* End of file commentIndex.js */
/* Location: ./js/commentIndex.js */ 
