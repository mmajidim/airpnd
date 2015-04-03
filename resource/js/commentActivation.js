/**
 * @file       commentActivation.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for user activation.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added activation page functionality
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    07/1/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting 
 */ 
$(function(){    
    if(isLoggedIn())
    {
        $("#verifyAccountForm").hide();
        showAlertBox('Verified',
                'Your email address is already verified.',
                SITE_URL + 'index.php');
                return false;
    }
    var activationKey = typeof(getUrlVars()['activate']) == 'undefined' ||
    getUrlVars()['activate'] == null ? false : true;
    if(activationKey)
    {
        $("#verifyAccountForm").show();
        var link = decodeURIComponent(getUrlVars()['activate']);
        var iv = decodeURIComponent(getUrlVars()['iv']);
        var decodedData =  getDecode(link,iv);
        $.session.set('userName',decodedData.userName);
        $.session.set('password', decodedData.password);
        $('#userNameLabel').html(decodedData.userName);
    }
    else
    {
        $('#activationActivationLinkError').slideDown('slow');
        $("#verifyAccountForm").hide();
    }   

    //This validation is for verify account form.
    $("#verifyAccountForm").validate({
        ignore: ":hidden .ignore",
        onfocusout: function(element)
        {
            if (!$(element).is('select') && element.value === '' && 
                element.defaultValue === '') 
            {                
                $(element).valid();
            }
            if($(element).valid())
            {
                $(element).removeClass('error').addClass('success'); 
            }
            else
            {
                $(element).removeClass('success').addClass('error');  
            }
        },
        showErrors: function(errorMap, errorList) {
            $.each(this.successList, function(index, value) {
                return $(value).popover("hide");
            });
            return $.each(errorList, function(index, value) {
                getErrorPopupTemplate(value);
            });
        },
        rules:
        {
            passwordActivationPage : 
            {
                required:true
            }
        },
        messages: {
            passwordActivationPage:{
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'password')
            }
        },
        invalidHandler: function(event, validator)
        {
            if (validator.numberOfInvalids()) 
            {
                return false;
            } 
        },
        submitHandler: function(form) 
        {
            $('#loaderVerifyPassword').show();
            if($.session.get($.session.get('userName')) == '1')
            { 
                $('#activationSuccess').empty();
                var htmlBody ='<p><center><strong><p><h1>&#9786;</h1>';
                htmlBody+='</p></strong></center><p><center><strong>';
                htmlBody+='<p>Your email address is already verified.';
                htmlBody+=' Please continue to Sign In using';
                htmlBody+=' your username and your  password.</p>';
                htmlBody+='</strong></center>';
                $('#activationSuccess').append(htmlBody);
                $('#loaderVerifyPassword').hide(); 
                $('#activationSuccess').slideDown();
                $('#verifyAccountForm').hide();
            }
            else
            {                  
                validateLogin();
            }
        }
    });

    //Click to initialize sign up modal pop up.
    $(document).on('click','#needAccount',function(){
            $('#signUpModal').modal('show');
    })
});


//function validate login
function validateLogin
(    
)
{
    var encodeUN   = getEncode($.session.get('userName'),
                     getUrlVars()['iv'])
    var encodePass = getEncode($('#passwordActivationPage').val(),
                               getUrlVars()['iv'])
    var dataToSend = 
    {
        "action"         : VALIDATE_USER,
        "encodeUN"       : JSON.stringify(encodeUN.activate),
        "encodePass"     : JSON.stringify(encodePass.activate),
        "iv"             : JSON.stringify(getUrlVars()['iv']),
        "activate"       : true
    }
    $.ajax({
        type: "POST",
        url: API_URL,
        data: dataToSend,                    	                    
        dataType: "json",
        headers: HEADER,
        error: function (e) 
        {  
            $('#loaderVerifyPassword').hide();   
            showAlertBox('Error',ERROR_MSG);
        },
        success: function(result)
        { 
            if(result.retCode == 1)
            {
                $('#loaderVerifyPassword').hide(); 
                //$('#activationSuccess').slideDown();
                $('#verifyAccountForm').hide();
                $.session.set(result.user.email,result.user.status);
                //code for login
                if( validateRole(result.user))
                {
                    $('#signInLoader').hide();
                    $('#signInModal').modal('hide'); 
                    if(window.location.pathname.indexOf('activation') > -1)
                    {
                        var msg = 'Your email address has been verified.';
                             msg+=' You are being logged in.'
                         showAlertBox('Verified',msg);
                        setTimeout(function(){
                            window.location =  SITE_URL + 'index.php';
                        },1500)
                    }
                    else
                    {
                       window.location.reload(true); 
                    }
                }
                
                
            }
            else if(result.retCode == 0)
            {
                $('#loaderVerifyPassword').hide();   
                $('#activationSuccess').addClass('hide');
                $('#activationError').slideDown();
                setTimeout(function(){
                    $('#activationError').slideUp();   
                    },2000);
            }
        }
    });
}
/* End of file commentActivation.js */
/* Location: ./js/commentActivation.js */  
