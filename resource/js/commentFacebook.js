/**
 * @file       commentFacebook.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for facebook api.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added facebook functionality and
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    06/02/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDesc    updated functionality for SMS.
 * @revDate    06/20/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    update the fb login functionality
 * @revDate    06/30/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    fix minor alingment issues
 */ 
window.fbAsyncInit = function() {
    FB.init({
        appId      : FACEBOOK_APP_ID, // App ID
        channelUrl : SITE_URL +'index.php', // Channel File
        status     : true, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true  // parse XFBML
    });
}

//function fbSignUp
function fbSignUp
(
)
{
    FB.getLoginStatus(function(response) {
        switch(response.status.toLowerCase())
        {
            case 'connected': 
                  signUpAPI(); 
                  $('#fbcSuccess').removeClass('hide');
                  $('#passwordDiv').addClass('hide');
                  $('#confirmPasswordDiv').addClass('hide');       
                  break;
            case 'not_authorized':
            default:
                  $('#signUpModal').modal('hide'); 
                  $.session.clear('isFbLoggedIn');
                  clearFBDetails();
                  facebookLogin();
                  break;
        }
    });
}
//function fbLogin
function fbLogin
(
)
{             
    FB.getLoginStatus(function(response)
        { 
            switch(response.status.toLowerCase())
            {
                case 'connected' :                
                    $('#signInModal').modal('hide'); 
                    $('#modalFade').removeClass('hide');
                    $('#fbOverlay').removeClass('hide');
                    logInAPI();
                    break;
                case 'not_authorized':
                default:
                    $('#signInModal').modal('hide'); 
                    $.session.clear('isFbLoggedIn');
                    clearFBDetails();
                    facebookLogin();
                    break;
            }
    });
}

// Load the SDK asynchronously
(function(d){
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement('script');
    js.id = id;
    js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
    }(document));

//Function signUp api.
function signUpAPI() 
{   
    $.session.set('isFBVerified',true);  
    $('#modalFade').removeClass('hide');
    $('#fbOverlay').removeClass('hide');
    FB.api('/me', function(response) 
    {
        fillDetails(response);
    });
};

//function logInApi
function logInAPI
(
) 
{
    FB.api('/me', function(response) 
        {
            var jsonResult = getByUserName(response.email);  
            $('#modalFade').addClass('hide');
            $('#fbOverlay').addClass('hide');
            if(jsonResult == -1)
            {
                showAlertBox('Error',ERROR_MSG);
            }
            else if(jsonResult.retCode  == 0)
            {  
                $('#fbcSuccess').removeClass('hide');
                $('#passwordDiv').addClass('hide');
                $('#confirmPasswordDiv').addClass('hide');
                signUpAPI();
            }
            else if(jsonResult.retCode  == 1)
            {
                if(jsonResult.user.status == 1)
                {
                    validateRole(jsonResult.user);
                    window.location.reload(true);
                }
                else
                {
                    showAlertBox('Inactive User',
                        loadActivationMessage(jsonResult.user.email));
                }
            }
    });
};

// fill sign up form as response from facebook
function fillDetails
(
    response
)
{
    if(!$("#signUpModal").data('modal').isShown)
    {       
      loadSignUpModal();
    }
    if(response.email == undefined )
    {
        $('#fbcSuccess').addClass('hide');
        $('#firstNameSignUp').removeAttr( "disabled" );
        $('#lastNameSignUp').removeAttr( "disabled" );
        $('#middleNameSignUp').removeAttr( "disabled" );
        $('#emailSignUp').removeAttr( "disabled" );
        $('#passwordDiv').removeClass('hide');
        $('#confirmPasswordDiv').removeClass('hide');
        $('#signUpButton').removeClass('fbSignUp');
        $('#simpleCreate').addClass('hide');
        $('#fbsignUpLink').removeClass('hide');
     } 
        $('#signUpModal').modal('show');
        $('#firstNameSignUp').val(response.first_name);
        $('#middleNameSignUp').val(response.middle_name || '');
        $('#lastNameSignUp').val(response.last_name);
        $('#emailSignUp').val(response.email);
        $('#modalFade').addClass('hide');
        $('#fbOverlay').addClass('hide'); 
}

//function fbLogOut
function fbLogOut
(
)
{
    FB.getLoginStatus(function(response){
            if(response.status.toLowerCase() == 'connected')
            {
                FB.logout(function(response){});
                $.session.clear('fbLoggedIn');
                clearFBDetails();
                $.session.clearAll();
            }
    });
}

// facebook login window pop up.
function facebookLogin
(
)
{
    FB.login(function(response) {  
            if(response.status == 'connected')
            {
                $('#signInModal').modal('hide'); 
                $('#modalFade').removeClass('hide');
                $('#fbOverlay').removeClass('hide');
                logInAPI();
            } 
            else
            {
                if($.session.get('modalPopUp') == 'signInModal')
                {
                    $('#signInModal').modal('show'); 
                }
                else if($.session.get('modalPopUp') == 'signUpModal')
                {
                     clearFBDetails();
                    $('#signUpModal').modal('show'); 
                }
            }     
        }
        ,{
            scope:'user_address, user_mobile_phone, email'
    });  
}

/* End of file commentFacebook.js */
/* Location: ./js/commentFacebook.js */  