/**
 * @file       commentCommon.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for common functionality.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added common functionality for airspnd and
 *             done with minor formatting
 * @revDate    04/11/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added sorting functionality for location
 * @revDate    05/06/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    modified functionality for sign up and
 *             done with minor formatting
 * @revDate    05/07/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    modified functionality for sign up and
 *             done with minor formatting
 * @revDate    05/09/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    modified functionality for sign up and
 *             done with minor formatting
 * @revDate    05/12/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    modified functionality for bag size and
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    05/28/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added bagsize, seats functionality
 * @revDate    06/03/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    add the decode password functionality
 * @revDate    06/17/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    update the date timepicker plugins
 * @revDate    06/20/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    update forgot password functionality
 * @revDate    06/30/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    fix the minor alingment issues
 */ 

$(function()
{ 
    // declare time and date instance
    var _timeInst;
    var _dateInst;
    // set social plugin
    $('#socialConnect').share({
        networks: ['facebook','pinterest','googleplus','twitter',
                    'linkedin'],
        theme: 'square'
    });

    $('#phoneMessage').on('click',function(){
            $('#phoneNumber').toggleClass('ignore');
            if(!$(this).is(':checked'))
            {
            $('#phoneNumber').next('.popover').remove();
            }
    });
    //This function is used to set page title.
    getPageTitle();  
    
    //restrict user input type for payment page
    $('#cvv,#ccNumber,#zipCode,.numeric').filterType('numeric');
    $('#firstNamePayment,#middleNamePayment,#lastNamePayment,#city,.alpha').
            filterType('alpha');
    $('.specific').filterType('special');
    $('.alphaNumeric').filterType('alphanumeric');

    //This function is used to make menu active.
    makeActive();

        // This rule will validate phone number on focus out
    $.validator.addMethod("usPhoneFormat", function (value, element){
            return this.optional(element) || 
                /(\(\d{3}\) )?(\d{3}-){1,2}(\d{4})/.test(value);
        }, "Please enter phone number");

    // to hide the validation message on click/focus in.
    $('input[type!="checkbox"]').on('click',function(){
            $('input[type!="checkbox"]').removeClass('error');
            var formId = $(this).closest('form').attr('id');
            if(formId)
            {
                $('.popover','#'+ formId).remove();
            }
    });   

    //hide error message if select box is valid.
    $('select').not('.ignore').on('change',function(){
            if($(this).valid())
            {
                $(this).next().remove();
            }
    });

    //sign in modal initialization
    initializeModal('signInModal');

    //sign up modal initialization
    initializeModal('signUpModal');
    //restrict user input
    $('#firstNameSignUp').filterType('alpha');
    $('#middleNameSignUp').filterType('alpha');
    $('#lastNameSignUp').filterType('alpha');
    $('#licenseNumber').filterType('alphanumeric');
    $('#licenseState').filterType('alpha');
    $('#id_qty_1').filterType('numeric');
    $('#id_qty_2').filterType('numeric');
    $('#id_qty_3').filterType('numeric');
    $('#id_qty_4').filterType('numeric');
    //forgot password modal initialization
    initializeModal('forgotPasswordModal');

    $('.nav .navList .menuLink').on('click',function(){
            var menuItem = $(this).attr('for');
            $.session.set('menuItem', menuItem);
            window.location = SITE_URL + menuItem + '.php';
    });

    //close alert box modal pop up.
    $(document).on('click','.close,.closeAlertBox',function(){
            $('#alertBoxModal').modal('hide'); 
    });

    //logout from application
    $(document).on('click','#logOut',function(){   
            if(Boolean($.session.get('fbLoggedIn')))
            {            
                fbLogOut();
            }
            $.session.clearAll();
            sessionManager('destroySession');
            window.location = SITE_URL + 'index.php'; 
    });

    //to open datepicker on click of icon
    $(document).on('click','.add-on .icon-calendar',function(){
        $(this).closest('div').children('input[type="text"]').
        datetimepicker('show');
    });

    $(document).on('click','.closeIcon',function(){
            var pageName = window.location.pathname.toLowerCase();
            var protectedPage = ['postride','requestride','bookrider',
                                'bookride','mybookings',
                                 'mylifts'];
            $(this).clearForm();
            $.each(protectedPage, function(i,item){
                    if (pageName.indexOf(item) > -1)
                    {
                        window.location = SITE_URL + 'index.php';
                    } 
            });          
    });

    $('.dropdown-menu a').not('#logOut').on('click',function(){
        $.session.set('airspndPage',$(this).attr('for'))
        window.location = $(this).attr('href');
    });
    //functionality for drop down menu
    $('.dropdown,.dropdown-toggle').dropdown();

    //click on user name -drop down menu
    $('.dropdown-menu li a').on('click',function(){
            $.session.set('userPage',$(this).attr('for'));
    });
      // phone no masking
    $(document).on('focus','#phoneNumber',function(){           
            $(this).mask(maskUSFormat); 
    });

    //open fb for sign up
    $('#fbsignUpLink').off('click').on('click',function(){ 
            $.session.set('modalPopUp','signUpModal')
            fbSignUp(); 
            isFbisLoggedin();
            return false;
    });
    //open fb for sign in
    $('#fbLoginLink').off('click').on('click',function(){ 
            $.session.set('fbLoggedIn',true); 
            $.session.set('modalPopUp','signInModal');
            fbLogin(); 
            isFbisLoggedin();
            return false;
    });
    // function for open forgot password modal popup
    $(document).on('click','#forgotPassword',function(){ 
            $('#forgotPasswordModal').modal('show'); 
            $('#signInModal').modal('hide');
            forgotPasswordValidation();
    });
    // function for open sign in modal popup with togggle effect agianst sign up
    $(document).on('click','#signInTop,#signInLink',function(){  
            $('#signInModal').modal('show');
            $('#signUpModal').modal('hide');
            $('#forgotPasswordModal').modal('hide');
            signInValidation();
            return false;
    });
    // function for open sign in modal popup with togggle effect agianst sign up
    $(document).on('click','#createAccount ,#createAccountHome #simpleCreate',function(){
            $.session.clear('isFBVerified');
            $('#signUpModal').resetForm();  
            $('#signUpButton').removeAttr( "disabled" );
            $('#signUpLoader').hide();
            $('#fbcSuccess').addClass('hide');
            $('#signUpButton').removeClass('fbSignUp');
            $('#simpleCreate').addClass('hide');
            $('#fbsignUpLink').removeClass('hide');
            $('#simpleCreate').addClass('hide');
            $('#passwordDiv').removeClass('hide');
            $('#confirmPasswordDiv').removeClass('hide');
            $('#firstNameSignUp').removeAttr( "disabled" );
            $('#lastNameSignUp').removeAttr( "disabled" );
            $('#middleNameSignUp').removeAttr( "disabled" );
            $('#emailSignUp').removeAttr( "disabled" );
            $('#signUpModal').modal('show') ;
            $('#signInModal').modal('hide') ;
            signUpValidation(); 
            if(window.location.pathname.indexOf('result') > -1)
            {
                $('#findACar').attr('checked','checked');                
            }
            return false;
    });

    //hide  modal with reset validation function
    $(document).on('click','.closeIcon',function(){
            var formId ='';
            var modalId = ''
            if($('img',this).attr('alt').indexOf('signIn') > 0)
            {
                formId = '#signInForm';
                modalId = '#signInModal';
            }        
            else if($('img',this).attr('alt').indexOf('signUp') > 0)
            {
                formId = '#signUpForm';
                modalId = '#signUpModal';
            }        
            else if($('img',this).attr('alt').indexOf('forgotPassword') > 0)
            {
                formId = '#forgotPasswordForm';
                modalId = '#forgotPasswordModal';
            }       
            $(modalId).modal('hide');
    });

        //close error message on click
    $(document).on('click','.popover-inner',function(){
            $(this).closest('.popover').remove();
    });

    //check validation on blur
    $(document).on('blur','input[name="check"],#phoneNumber',function(){
            $(this).valid() ;
    });

        //social connect
    $('.socialConnect img').on('click',function(){
        var socialSiteName = $(this).attr('alt');
        switch(socialSiteName)
        {
            case 'facebook':
                socialSiteName = FACEBOOK;
                break;
            case 'twitter':
                socialSiteName = TWITTER;
                break;
            case 'vimeo':
                socialSiteName = VIMEO;
                break;
            case 'flickr':
                socialSiteName = FLICKR;
                break;
        }
        window.location = socialSiteName;
    });

        //This section is for resend link.
    $(document).on('click','.activationButton',function(){
            var email = $(this).attr('for');
            if(resendActivation(email))
            {
                $('#alertBoxModal').modal('hide');
                showAlertBox('Activation Email Alert',
                    EMAIL_SUCCESS.replace('emailID', email));
            }
            else
            {
                showAlertBox('Error',ERROR_MSG);
            }
    });

    //to prevent from manual input in date field;
    $('.time,.date').on('keydown',function(){
        return false; 
    });

        //prevent from editing or pasting value
    $('.date,.time,#passwordSignUp,#confirmPasswordSignUp,#accountNumber').
        bind('cut copy paste',function(){
        return false; 
    });
});

//function clear fb datails
function clearFBDetails
(
)
{
        $('#fbcSuccess').addClass('hide');
        $('#signUpModal').clearForm();  
        $('#firstNameSignUp').removeAttr( "disabled" );
        $('#lastNameSignUp').removeAttr( "disabled" );
        $('#middleNameSignUp').removeAttr( "disabled" );
        $('#emailSignUp').removeAttr( "disabled" );
        $('#passwordDiv').removeClass('hide');
        $('#confirmPasswordDiv').removeClass('hide');
}

//function sign in validation.
function signInValidation
(
)
{
    $("#signInForm").validate({
        ignore: ":hidden .ignore",
        focusInvalid: false,
        focusCleanup: true,
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
            emailAddress : 
            {
                required:true,
                email:true
            },
            password : 
            {
                required:true
            }
        },
        messages:
        {
            emailAddress:
            {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'email address'),
                email:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'valid email address')
            },
            password:
            {
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
            $('#signInLoader').show();       
            $('#signInLoader').removeClass('hide');      
            validateActiveLogin();
        }
    });
}

//function sign up validation.
function signUpValidation
(
)
{   
    $("#signUpForm").validate({
        ignore: ".ignore, :hidden",
        focusInvalid: false,
        focusCleanup: true,
        onfocusout: function(element)
        {
            if (!$(element).is('select') && element.value === '' && 
                element.defaultValue === '') 
            {                
                $(element).valid();
            }
            if(!$(element).hasClass("ignore"))
            {
                if($(element).valid())
                {
                    $(element).removeClass('error').addClass('success'); 
                }
                else
                {
                    $(element).removeClass('success').addClass('error'); 
                }
            }
        },
        showErrors: function(errorMap, errorList)
        {
            $.each(this.successList, function(index, value) {
                return $(value).popover("hide");
            });
            return $.each(errorList, function(index, value) {
                getErrorPopupTemplate(value);
            });
        },
        rules:
        {
            firstName : {
                required:true
            },
            lastName : {
                required:true
            },
            emailSignUp : {
                required:true,
                email:true
            },
            phoneNumber : {
                required:true
            },
            password : {
                required:true
            },
            confirmPassword : {
                required:true,
                equalTo: "#passwordSignUp"
            },
            check : {
                required:true
            },
           
            termsCondition:
            {
                required:true
            }
        },
        messages: {
            firstName: 
            {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'first name')
            },
            lastName: {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'last name')
            },
            phoneNumber:{
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'phone number')
            },
            emailSignUp:{
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'email address'),
                email:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'valid email address')
            },
            password:{
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'password')
            },
            confirmPassword:{
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'confirm password') ,
                equalTo : 'password does not match'
            },
           
            check:{
                required:VALIDATION_ERROR_MSG_CHECK
            },
            termsCondition:
            {
                required:'Please accept terms and conditions.'
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
            $('#signUpButton').attr('disabled','disabled');
            $('#signUpLoader').show();
            $("#signUpModal .closeIcon").addClass('hide');
            getUserByUserName($('#emailSignUp').val());
        }
    });
}

//function forgot password validation.
function forgotPasswordValidation
(
)
{
    $("#forgotPasswordForm").validate({
        ignore: ":hidden .ignore",
        focusInvalid: false,
        focusCleanup: true,
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
                getErrorPopupTemplate(value,'top');
            });
        },
        rules:
        {
            emailAddress : {
                required:true,
                email:true
            }
        },
        messages: {
            emailAddress:{
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'email address'),
                email:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'valid email address')
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
            $('#loaderForgotPassword').show();
            $('#forgotPasswordButton').attr('disabled','disabled');
            resetPassword();
        }
    });    
}

//function validate login
function validateActiveLogin
(  
)
{      
    var isValid = false;
    var emailID = $('#emailAddress').val();
               
    var username  = getEncode(emailID);    
    var iv = username.iv;    
    username = username.activate;
    var password = getEncode($('#password').val(), iv);
    password = password.activate;

    var dataToSend = 
    {
        "action"         : VALIDATE_USER,
        "iv"             : JSON.stringify(iv),
        "encodeUN"       : JSON.stringify(username),	  		
        "encodePass"     : JSON.stringify(password),
        "activate"       : false
    }
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        async    : true,           
        headers  : HEADER,
        error    : function (e) 
        {      
            $('#signInLoader').addClass('hide');
            $('#messageContent').html(ERROR_MSG);
            $('#message').slideDown();
            setTimeout(function(){
                $('#message').slideUp();
                }, 2000);
            return false;
        },
        success  : function(result)
        { 
            if(result.retCode == 0)
            {  
                $('#signInLoader').addClass('hide');
                var userDetails = getByUserName(emailID);
                if(userDetails.retCode  && userDetails.user.status == 0)
                {
                    $('#signInModal').modal('hide');
                    showAlertBox('Inactive User',
                        loadActivationMessage(userDetails.user.email));
                }
                else
                {
                    $('#messageContent').html(LOGIN_ERROR_MSG);
                    $('#message').slideDown();
                    setTimeout(function()
                        {
                            $('#message').slideUp();
                        }, 2000);
                }
            }
            else if(result.retCode == 1)
            {                         
                if($.session.get('featureCarId'))
                {                            
                    $.session.set('featureCarRent',true);
                }

                //validate role.
                if( validateRole(result.user))
                {
                    $('#signInLoader').hide();
                    $('#signInModal').modal('hide'); 
                    if(window.location.pathname.indexOf('activation') > -1)
                    {
                        window.location = SITE_URL + 'index.php';
                    }
                    else
                    {
                       window.location.reload(true); 
                    }
                }    
            }
            else
            {  
                $('#signInLoader').hide();
                $('#messageContent').html(ERROR_MSG);
                $('#message').slideDown();
                setTimeout(function(){
                    $('#message').slideUp();
                    },2000);
            }
        }
    });

    return isValid;
}

// function forgot password detials
function forgotPasswordDetails
(
    emailID
)
{
    var data;
    var username  = getEncode(emailID);    
    var iv = username.iv;    
    username = username.activate;
                                 
    var dataToSend = 
    {
        "action"         : VALIDATE_USER,
        "iv"             : JSON.stringify(iv),
        "encodeUN"       : JSON.stringify(username),              
        "activate"       : false
    }
    
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                                            
        dataType : "json",
        async    : false,           
        headers  : HEADER,
        error    : function (e) 
        {      
            
            return false;
        },
        success  : function(result)
        { 
            data =  result;   
        }
         
    });
    return data;
}

//function session manager.
function sessionManager
(
    actionName,
    key,
    value
)
{
    var res; 
    $.ajax({
        type     : 'POST',
        url      : 'session.php',
        async    : false,
        dataType : "json",
        data     : 
        {
            key         : key,
            value       : value,
            functionName : actionName
        },                
        error: function (e) 
        {
            return false;
        },
        success: function(result)
        {
            if(result != null || typeof(result) != undefined)
            {
                res = result ;
            }
        }
    });

    return res;
}

//function reset password.
function resetPassword
(
)
{
    var res = forgotPasswordDetails($('#emailAddressForgotPassword').val());
    var dataToSend = 
    {
        "action"       : FORGOT_PASSWORD,
        "username"     : JSON.stringify(res.user.email),
        "iv"           : JSON.stringify(res.user.iv),
        "verification" : JSON.stringify(res.user.verification)
    }
    $.ajax({
        type: "POST",
        url: API_URL,
        data: dataToSend,                    	                    
        dataType: "json",      
        headers: HEADER,
        error: function (e) {  
            $('#forgotPasswordButton').removeAttr('disabled');
            $('#loaderForgotPassword').hide();   
            $('#messageContentForgotPassword').html(ERROR_MSG);
            $('#messageForgotPassword').slideDown();
            setTimeout(function(){
                $('#messageForgotPassword').slideUp();
                }, 1500)
            return false;
        },
        success: function(result)
        {  
            if(result.retCode == -1)
            {
                $('#messageContentForgotPassword').html(INVALID_USER);
                $('#messageForgotPassword').slideDown();
                setTimeout(function(){
                    $('#messageForgotPassword').slideUp();
                    }, 2000)
            }
            else if(result.retCode == 1)
            {
             var resetPass =  getDecodePassword(result.pass,res.user.iv)   
             var emailBody = getEmailBody('forgot_password',
                                res.user.firstName +' '+res.user.lastName, 
                                res.user.email,
                                resetPass.password);     
             var emailSubject = 'AirPnd - Password Reset '; 
             var hasSent = sendEmail(res.user.email,emailSubject,emailBody);  
              if(hasSent)
              {
                $('#messageContentForgotPassword').removeClass('alert-error').
                addClass('alert-warning');
                $('#messageContentForgotPassword').html(FORGOTPASSWORD_MSG.
                    replace('emailAddress',
                            $('#emailAddressForgotPassword').val()));
                $('#messageForgotPassword').slideDown();
                setTimeout(function(){
                $('#forgotPasswordModal').clearForm();
                    window.location.href = SITE_URL + 'index.php';
                    }, 1500);
              }
              else
              {
                  showAlertBox('Email failure ','Email sending failed',
                   SITE_URL+'index.php');
              }
            }
            else
            {                
                $('#messageContentForgotPassword').html(ERROR_MSG);
                $('#messageForgotPassword').slideDown();
                setTimeout(function(){
                    $('#messageForgotPassword').slideUp();}, 1500)
            }
                $('#forgotPasswordButton').removeAttr('disabled');
                $('#loaderForgotPassword').hide(); 
        }
    });
}

//Session management functionality
$.session =
{
    get: function
    (
        key
    )
    {
        return window.sessionStorage.getItem(key);
    },
    set : function
    (
        key,
        value
    )
    {
        window.sessionStorage.setItem(key,value);
    },
    clear:function
    (
        key
    )
    {
        window.sessionStorage.removeItem(key);
    },
    clearAll:function
    (
    )
    {
        window.sessionStorage.clear();
    }
}

//function bind custom select box.
function bindCustomSelectBox
(
    selectBoxId,
    dataList,
    isFirstOptionSelected,
    isClassSelector
)
{   
    var $elementId = $('#' + selectBoxId); 
    if(isClassSelector)
    {
        $elementId = $('.' + selectBoxId)
    }                 
    $elementId.select2();
    if(!dataList || dataList.length <= 0)
        return;
    $.each(dataList,function(i,item)
        {
            var name = item.name || item; 
            if(item.region != null)
            {
                $elementId.append('<option value="' + name + '">'+
                    name + ' - ' + item.region + '</option>');
            }
            else
            {                      
                $elementId.append('<option value="' + name + '">'+
                    name + '</option>') ;
            }   
            //customize select box           
            if(isFirstOptionSelected)
            {
                $elementId.select2('val',
                    $('.select2 option:eq(1)').val());
            }
    });

}

//function get location.
function getLocation
(
    selectBoxId,
    isFirstOptionSelected,
    isClassSelector
)
{      
   var locations =  getAirports(); $.session.set('location',locations)
    //bind select box.
    bindCustomSelectBox(selectBoxId, locations,isFirstOptionSelected,
                        isClassSelector);
}

//function get airports
function getAirports
(
)
{          
    var locations;
    var locationDetails = sessionManager('getSession','location');
                     
    //if session has airport location then loads it otherwise call service.
    if(window.location.pathname.indexOf('index') > -1 ||
        locationDetails == null)
    {                        
        var dataToSend = 
        {
            "action"    : GET_LOCATIONS
        }
        $.ajax({
            type       : "GET",
            url        : CUSTOM_API_URL,
            data       : dataToSend,                                                  
            dataType   : "json",
            headers    : HEADER,
            async      : false,
            error      : function (e) 
            {              
                showAlertBox('Error',ERROR_MSG); 
            },
            success    : function(jsonResult)
            { 
                if(jsonResult.retCode)
                {
                    locations = jsonResult.locations; 
                    sessionManager('setSession','location',
                        JSON.stringify(locations));
                }
            }        
        });
    }
    else if(locationDetails)
    {
        locations = JSON.parse(locationDetails);
        locations = locations.sort(sortLocation);
    }
    return locations;
}

//function get bag types
function getBagTypes
(
    selectBoxId
)
{
    var bags =  getBagSize();
    //bind select box.
    $.each(bags,function(item){
        $('#'+selectBoxId).append('<option value="'+item+'">'+bags[item]+
                                '</option>');
    });
    $('#'+selectBoxId).select2('val', $('.select2 option:eq(1)').val());
}
   
// function get bag size
function getBagSize
(
)
{          
    var bags;
            
        var dataToSend = 
        {
            "action"    : GET_BAG_SIZES
        }
        $.ajax({
            type       : "GET",
            url        : CUSTOM_API_URL,
            data       : dataToSend,                                                  
            dataType   : "json",
            headers    : HEADER,
            async      : false,
            error      : function (e) 
            {              
                showAlertBox('Error',ERROR_MSG);  
            },
            success    : function(jsonResult)
            { 
                if(jsonResult.retCode)
                {   bags = jsonResult.bagSizes; 
                }
            }        
        });
    return bags;
}

// function get getSeats
function getSeats
(
    selectBoxId
)
{          
    var seats;
            
        var dataToSend = 
        {
            "action"    : GET_SEAT
        }
        $.ajax({
            type       : "GET",
            url        : CUSTOM_API_URL,
            data       : dataToSend,                                                  
            dataType   : "json",
            headers    : HEADER,
            async      : false,
            error      : function (e) 
            {              
                showAlertBox('Error',ERROR_MSG);  
            },
            success    : function(jsonResult)
            { 
                if(jsonResult.retCode)
                {   seats = jsonResult.seats; 
                }
            }        
        });
    //bind select box.
    $.each(seats,function(item){
        $('#'+selectBoxId).append('<option value="'+item+'">'+seats[item]+
                                '</option>');
    });
    $('#'+selectBoxId).select2('val', $('.select2 option:eq(1)').val())
    return seats;
}


 // function for get bag size name
function getBagSizeName
(
 size
)
{
       var sizeName = '';
       switch(size)
       {
          case  'S' :
          sizeName = 'Small';
          break; 
          case  'M' :
          sizeName = 'Medium';
          break; 
          case  'L' :
          sizeName = 'Large';
          break; 
       }
        return  sizeName;
}

//function for get bag code
function getBagCode
(
  sizeName
)
{
   var bagCode = '';
       switch(sizeName)
       {
          case  'small' :
          bagCode = 'S';
          break; 
          case  'medium' :
          bagCode = 'M';
          break; 
          case  'large' :
          bagCode = 'L';
          break; 
       }
        return  bagCode; 
}


//function move to top
function moveTotop
(
)
{
    $("html, body").animate({
        scrollTop:0
        },"slow"); 
    //scroll on top   
    $(window).scroll(function () {
    $(window).scrollTop();
    }); 
}

//function get error pop up template.
function getErrorPopupTemplate
(
    value,
    position
)
{
    var _popover;
    var _template = "<div class=\"popover\"><div class=\"arrow\"></div>";
        _template+="<div class=\"popover-inner\">";
        _template+="<div class=\"popover-content\"><p></p></div></div></div>";
    position = typeof(position) == undefined || position == null ? "top" : 
    position; 
    _popover = $(value.element).popover({
        trigger: "manual",
        placement: position,
        content: value.message,
        template:  _template
    });
    _popover.data("popover").options.content = value.message;
    return $(value.element).popover("show");
}

//function send email.
function sendEmail
(
    recipient,
    subject,
    emailMsg
)
{
    var retCode = -1;
    var dataToSend =
    {
        "action"     : SEND_MESSAGE,
        "recipients" : JSON.stringify(recipient),	  		
        "subject"    : JSON.stringify(subject),
        "msg"        : JSON.stringify(emailMsg)
    };
    $.ajax({
        type      : "POST",
        url       : API_URL,
        data      : dataToSend,                    	                    
        dataType  : "json",      
        async     : false,
        headers   : HEADER,
        error     : function (e)
        { 
            showAlertBox('Error',ERROR_MSG);
        },
        success: function(jsonResult)
        {
            retCode = jsonResult.retCode;
        }
    });

    return retCode;
}

//function get email body
function getEmailBody
(
    messageType,
    name,
    userName,
    password,
    activationLink,
    rideDate,
    rideTime,
    lift
)
{
    var emailBody; 
    var activationBody = 
    String.format('<a href="{0}activation.php{1}">Click Here </a>',
        SITE_URL,activationLink); 
    switch(messageType)
    {
        case 'owner_registration' :
        case 'renter_registration':
            emailBody  = '<div><p><strong>Dear '+ name +'</strong>,</p><br />';
            emailBody +='<p>You have successfully registered with AIRPND.</p>';
            emailBody +='<p>Please click on the link to activate your account.';
            emailBody +='</p><p>'+activationBody+'<br><br></p>';
            emailBody +='<p><strong>Your Credentials:-</strong>:-</p><br />';
            emailBody +='<p>User Name:<b> '+ userName +'</b></p>';
            emailBody +='<p>Password:<b> '+ password +'</b></p>';
            emailBody +='<br /><p>Regards:-</p>';
            emailBody +='<p>Airpnd Team.</p>';
            emailBody +='<p><sub><i>This is a system generated';
            emailBody +='&nbsp;mail. Please do not reply to it.';
            emailBody +='</i><sub></p></div>';
            break;
         case 'fb_registration':
            emailBody  = '<div><p><strong>Dear '+ name +'</strong>,</p><br />';
            emailBody +='<p>Please click on the link to complete  your ';
            emailBody +='registration.</p><p>'+activationBody+'<br><br></p>';
            emailBody +='<p><strong>Your Credentials:-</strong>:-</p><br />';
            emailBody +='<p>User Name:<b> '+ userName +'</b></p>';
            emailBody +='<p>Password:<b> '+ password +'</b></p>';
            emailBody +='<br /><p>Regards:-</p>';
            emailBody +='<p>Airpnd Team.</p>';
            emailBody +='<p><sub><i>This is a system generated';
            emailBody +='&nbsp;mail. Please do not reply to it.';
            emailBody +='</i><sub></p></div>';  
            break; 
          case 'forgot_password':
            emailBody  = '<div><p><strong>Dear '+ name +'</strong>,</p><br />';
            emailBody +='<p>Please click on the link to sign in ';
            emailBody +='AirPnd.</p><p>'+'<a href='+SITE_URL+'>Click here</a>';
            emailBody +='<br><br></p><p><strong>Your login details:-</strong>';
            emailBody +='</p><br /><p>User Name:<b> '+ userName +'</b></p>';
            emailBody +='<p>Password:<b> '+ password +'</b></p>';
            emailBody +='<br /><p>Regards:-</p>';
            emailBody +='<p>Airpnd Team.</p>';
            emailBody +='<p><sub><i>This is a system generated';
            emailBody +='&nbsp;mail. Please do not reply to it.';
            emailBody +='</i><sub></p></div>';  
            break; 
          case 'payment':
            var date = $.getDateTime.formatDate(lift.dt);
            var time = $.getDateTime.formatTime(lift.dt);
            
            emailBody  = '<div><p><strong>Dear '+ name +'</strong>,</p><br />';
            emailBody +='<p><strong>Your Confirmation code is:-</strong></p><br />';
            emailBody +='<p>Confirmation code :<b> '+ $.session.get('confirmationNo') +'</b></p>';
            emailBody +='<p><strong>The ride information as follow:</p><br />';
            emailBody +='<p>Paid Amount: '+ lift.contribution +'</b></p>';
            emailBody +='<p>Pick Up: '+ lift.start +'</b></p>';
            emailBody +='<p>Drop Off: '+ lift.to +'</b></p>';
            emailBody +='<p>Date: '+ date +'</b></p>';
            emailBody +='<p>Time: '+ time +'</b></p>';
            emailBody +='<br /><p>Regards:-</p>';
            emailBody +='<p>Airpnd Team.</p>';
            emailBody +='<p><sub><i>This is a system generated';
            emailBody +='&nbsp;mail. Please do not reply to it.';
            emailBody +='</i><sub></p></div>';  
            break;
          case 'paymentForDriver':
            var date = $.getDateTime.formatDate(lift.dt);
            var time = $.getDateTime.formatTime(lift.dt);
            
            emailBody  = '<div><p><strong>Dear '+ name +'</strong>,</p><br />';
            emailBody +='<p><strong>The rider has paid for the following ride</p><br />';
            emailBody +='<p>Pick Up: '+ lift.start +'</b></p>';
            emailBody +='<p>Drop Off: '+ lift.to +'</b></p>';
            emailBody +='<p>Date: '+ date +'</b></p>';
            emailBody +='<p>Time: '+ time +'</b></p>';
            emailBody +='<p>Please login into your accout for detailed information. '+'</b></p>';
            emailBody +='<br /><p>Regards:-</p>';
            emailBody +='<p>Airpnd Team.</p>';
            emailBody +='<p><sub><i>This is a system generated';
            emailBody +='&nbsp;mail. Please do not reply to it.';
            emailBody +='</i><sub></p></div>';  
            break;
    }
    return emailBody;  
}

//function for getting pop up.
function getPopUp
(
    elementId,
    contentId,
    position,
    title
)
{
    title = typeof(title) == undefined || title == null ? "" : title;
    $(elementId).popover({
        html: true,
        placement: position,
        title: title, 
        trigger: 'manual',
        content: function () 
        {
            return $(contentId).html() || contentId;
        }
    });
}

//function isloggedIn
function isLoggedIn
(
)
{
    var userDetails = sessionManager('getSession','user');
    if(userDetails)
    {
        return true;
    }
    else
    {
        return false;
    }    
}

//function show alert box.
function showAlertBox
(
    title,
    content,
    link
)
{      
    $('#alertBoxModal').modal('hide');
    $('#alertBox').html(loadContent(title,content,link));
    $('#alertBoxModal').modal({
        keyboard:true,
        backdrop: 'static',
        show:true
    });
    $('#alertBoxModal').css({'z-index':'99999',
                             'cursor':'pointer',
                             'marginTop' :  '15%'});
}

//function load content
function loadContent
(
    title,
    content,
    link
)
{
    link = link || '#';
    var htmlContent = '<div class="modal fade" id="alertBoxModal">';
    htmlContent +='<div class="modal-dialog"><div class="modal-content">';
    htmlContent +='<div class="modal-header"><a href="'+link+'"';
    htmlContent +=' class="close closeAlertBox">';
    htmlContent +='&times;</a><h4 class="modal-title" >' + title + '</h4>';
    htmlContent +='</div><div class="modal-body">' + content + '</div>';
    htmlContent +='<div class="modal-footer"><a href="'+link+'"';
    htmlContent +='class="btn btn-default closeAlertBox">OK</a>';
    htmlContent +='</div></div></div></div>';

    return htmlContent;
} 

$(window).on('load',function(){
    $('#pageLoaderModal').fadeOut('slow',function(){
        $(this).remove();
    });
});

//function for setting the web page title.
function getPageTitle
(
)
{
    var title = 'AirPnD - carpool for travelers going From and To AirPorts .';
    var editListingTitle = $.session.get('entityNameEditList') != null ?'Edit ' 
    + $.session.get('entityNameEditList') : 'Edit';

    var pageTitles = 
    {       
        'trustandsafety' : 'Trust and Safety',
        'policy'         : 'Privacy Policy',
        'terms'          : 'Terms of Service',
        'ourlocation'    : 'Our Locations',
        'faq'            : 'FAQ',
        'howitworks'     : 'How It Works',
        'support'        : 'Support',
        'contactus'      : 'Contact Us',
        'insurance'      : 'Insurance',
        'blog'           : 'Blog',
        'postride'       : 'Offer Ride',
        'requestride'    : 'Request Ride',
        'bookride'       : 'Book Ride',
        'bookrider'      : 'Book Rider',
        'findride'       : 'Search Driver',
        'findrider'      : 'Search Rider',
        'activation'     : 'Activation',
        'reviews'        : 'Reviews',
        'profile'        : 'My Profile',
	    'mybookings'     : 'My Bookings',
	    'mylifts'        : 'My Lifts'
    }
    var pageURL = window.location.pathname;
    var pageName = pageURL.substring((pageURL.lastIndexOf('/') + 1 )
        ,pageURL.length);
    var splittedPageName = (pageName.substring(0, 
        pageName.lastIndexOf('.'))).toLowerCase();
    pageName = splittedPageName != "" ? splittedPageName : pageName;                    
    if(pageName != "")
    {
        title = pageTitles[pageName] || title;
    }
    document.title = title;
}

// this function is used to add active class
function makeActive
(
)
{
    var menuItem = $.session.get('menuItem');   
    var pageName = window.location.pathname;
    pageName = pageName.slice(pageName.lastIndexOf('/') + 1);
    var attr = $.session.get('menuItem');   
    if(pageName.indexOf(attr) > -1)
    {
        $('.'+menuItem).addClass('active');      
    }
    else
    {
        $('.navList').not( $('.'+menuItem)).removeClass('active');
    }
}
//function fbloging
function isFbisLoggedin
(
)
{
    if($.session.get('isFBVerified'))
    {
        $('#firstNameSignUp').attr('disabled','disabled');
        $('#lastNameSignUp').attr('disabled','disabled');
        $('#emailSignUp').attr('disabled','disabled');
        $('#signUpButton').addClass('fbSignUp');
        $('#fbsignUpLink').addClass('hide');
        $('#simpleCreate').removeClass('hide');
    }
    else
    {  
        $('#firstNameSignUp').removeAttr( "disabled" );
        $('#lastNameSignUp').removeAttr( "disabled" ); 
        $('#emailSignUp').removeAttr( "disabled" );
        $('#signUpButton').removeClass('fbSignUp');
        $('#fbsignUpLink').removeClass('hide');
        $('#simpleCreate').addClass('hide');
    }
} 


//function isloggedIn
function isLoggedIn
(
)
{
    var userDetails = sessionManager('getSession','user');
    if(userDetails)
    {
        return true;
    }
    else
    {
        return false;
    }
}


//function load sign in modal.
function loadSignInModal
(
)
{ 
    $('#signInModal').clearForm();
    $('#signInModal').modal('show');
    signInValidation();
}

//function load sign up modal.
function loadSignUpModal
(
)
{
    $('#signUpModal').clearForm();
    isFbisLoggedin();
    $('#signUpModal').modal('show');
    signUpValidation();
}

//function get encode
function getEncode
(
    data,
    iv
)
{
    var encodedData;
    $.ajax({
        type     : 'POST',
        url      : 'activationFunction.php',
        async    : false,
        dataType : "json",
        data     : 
        {
            activationLinkParam : data,
            iv                  : typeof(iv) != undefined ? iv : '',
            encode              : true
        },                
        error: function (e) 
        {
            return false;
        },
        success: function(result)
        {
            encodedData = result; 
        }
    });

    return encodedData;
}

//function get decode
function getDecode
(
    encodedData,
    iv
)
{
    var decodedData;
    $.ajax({
        type     : 'POST',
        url      : 'activationFunction.php',
        async    : false,
        dataType : "json",
        data     : 
        {
            activationLink : encodedData,
            iv             : iv
        },                
        error: function (e) 
        {
            return false;
        },
        success: function(result)
        {
            decodedData = result; 
        }
    });
    return decodedData;
}

//function for decode password
 function getDecodePassword
(
    encodedData,
    iv
)
{
    var decodedData;
    $.ajax({
        type     : 'POST',
        url      : 'activationFunction.php',
        async    : false,
        dataType : "json",
        data     : 
        {
            password : encodedData,
            iv             : iv
        },                
        error: function (e) 
        {
            return false;
        },
        success: function(result)
        {
            decodedData = result; 
        }
    });
    return decodedData;
}


//function get decode
function getDecodeLink
(
    encodedData,
    iv
)
{
    var decodedData;
    $.ajax({
        type     : 'POST',
        url      : 'activationFunction.php',
        async    : false,
        dataType : "json",
        data     : 
        {
            link : encodedData,
            iv   : iv
        },                
        error: function (e) 
        {
            return false;
        },
        success: function(result)
        {
            decodedData = result; 
        }
    });
    return decodedData;
}

//function get rentals
function getRentals
(
    customerId
)
{
    var res;
    var dataToSend = {
        "action"      : GET_RENTAL,
        "customerId"  : customerId
    }
    $.ajax({
        type     : "POST",
        url      : CUSTOM_API_URL,
        data     : dataToSend,                      	                    
        dataType : "json",
        headers  : HEADER,
        async    : false,
        error    : function (e) 
        { 
             showAlertBox('Error',ERROR_MSG);
        },
        success: function(jsonResult)
        {
            res = jsonResult;
        }
    });
    return res;
}

//function get activation link
function getActivationLink
(
    userName,
    password
)
{
    var activationLink;
    var activationData = password != null ? userName +';'+ password :
    userName;
    $.ajax({
        type: 'POST',
        url: 'activationFunction.php',
        async:false,
        dataType: "json",
        data: 
        {
            activationLinkParam : activationData,
            encode         : true
        },                
        error: function (e) 
        {
            return false;
        },
        success: function(result)
        {
            activationLink = '?activate=' + encodeURIComponent(result.activate)
                              +'&iv=' + encodeURIComponent(result.iv);
        }
    });

    return activationLink;
}

//function get activation link
function getLink
(
    data
)
{
    var link;
    $.ajax({
        type: 'POST',
        url: 'activationFunction.php',
        async:false,
        dataType: "json",
        data: 
        {
            link : data,
            encode : true
        },                
        error: function (e) 
        {
            return false;
        },
        success: function(result)
        {
            link = '?link=' + encodeURIComponent(result.link) +'&iv=' +
                    encodeURIComponent(result.iv);
        }
    });

    return link;
}

//function get owner rentals
function getOwnerRentals
(
    ownerId
)
{
    var res;
    var dataToSend = 
    {
        "action"   : GET_OWNER_RENTALS,
        "ownerId"  : JSON.stringify(ownerId)
    }
    $.ajax({
        type     : "POST",
        url      : CUSTOM_API_URL,
        data     : dataToSend,                     	                    
        dataType : "json",
        headers  : HEADER,
        async    : false,
        error    : function (e) 
        {  

            showAlertBox('Error',ERROR_MSG);
        },
        success  : function(jsonResult)
        {
            res =  jsonResult;
        }
    });

    return res;
}

//function get by user name                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
function getByUserName
(
    userName
)
{
    var res;
    var encodedUN = getEncode(userName);
    var dataToSend = 
    {
        "action"         : VALIDATE_USER,
        "iv"             : JSON.stringify(encodedUN.iv),
        "encodeUN"       : JSON.stringify(encodedUN.activate),	  		
        "activate"       : false
    }
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        async    : false,    
        headers  : HEADER,
        error    : function (e) 
        {  
            res = -1;
        },
        success  : function(jsonResult)
        {  
            res = jsonResult;
        }
    }); 

    return res;
}

//process activation
function processActivation
(
    result,
    email,
    password
)
{   
    var hasSent = false;
    /*
    * This code will be executed in the case of new registration.
    * There is no service available which gives the user info.
    */
    if(result == null || result.user == null)
    {
        result = getByUserName(email); 
    }
    if(result.retCode == 1)
    {
        var user = getDecode(result.user.username,
            result.user.iv);
        var activationLink = getActivationLink(user.userName); 
        var message =  REGISTRATION_SUCCESSFUL_MSG.replace('{emailID}',
            email);           
        var emailBody = getEmailBody('renter_registration',
            result.user.firstName +' '+result.user.lastName,
            email,
            password,
            activationLink
        );      
        var emailSubject = 'Activate Your Airpnd Acccount';     
                 
        if($.session.get('isFBVerified') && 
                                $('#signUpButton').hasClass('fbSignUp'))
            {
                 message = "Email with password will be sent to you ";
                 message+= "to complete registration" ;
                 emailSubject = 'AirPnd - Complete your registration';
                 emailBody = getEmailBody('fb_registration',
                 result.user.firstName +' '+result.user.lastName,
                 email,
                 password,
                 activationLink
             );
            }
          hasSent = sendEmail(email,emailSubject,emailBody); 
        if(hasSent)
        { 
            $('#signUpLoader').hide();
            $("#signUpModal .closeIcon").removeClass('hide'); 
            $('#signUpButton').removeAttr('disabled');
            $('#signUpModal').modal('hide');
            $('#signUpModal').clearForm();
            showAlertBox('Registration Alert',message);
        }
        else
        {
             showAlertBox('Email failure ','Email sending failed');  
        }
    }
    else
    {
        $('#signUpLoader').hide();
        $("#signUpModal .closeIcon").removeClass('hide'); 
        $('#signUpButton').removeAttr('disabled');
        $('#signUpModal').modal('hide');
        $('#signUpModal').clearForm();
        showAlertBox('Registration Error Alert',ERROR_MSG);
    }
    return hasSent;
}

//function for initializing modal pop up.
function initializeModal
(
    modalId
)
{
    $('#' + modalId).modal({
        keyboard : false,
        backdrop : 'static',
        show     : false
    });
}

//function initialize coursel
function initializeCoursel
(
    courselId,
    interval
)
{
    $('#'+ courselId).carousel({
        interval : interval,
        cycle    : true,
        pause    : 'hover'
    });
}

//function update entity features
function updateEntityFeatures
(
    features
)
{
    var res;
    var dataToSend = 
    {
        "action"   : UPDATE_ENTITY_FEATURES,
        "features" : JSON.stringify(features)
    }
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        async    : false,      
        headers  : HEADER,
        error    : function (e) 
        {  
            res = -1;
        },
        success  : function(jsonResult)
        {  
            res = jsonResult;
        }
    }); 

    return res;
}

//function get features
function getFeature
(
    id,
    entityId,
    name,
    description
)
{
    var entityFeature = 
    {
        'id'         : id,
        'entityId'   : entityId,
        'name'       : name,
        'description': description,
        'type'       : 1,
        'rank'       : 0
    } 
    return entityFeature;
}

//function get driver license
function getDriverLicense
(
    customerId
)
{
    var res;
    var dataToSend = 
    {
        "action"     : GET_DRIVER_LICENSE,
        "customerId" : JSON.stringify(customerId)
    }
    $.ajax({
        type     : "POST",
        url      : CUSTOM_API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        async    : false,     
        headers  : HEADER,
        error    : function (e) 
        {  
            res = -1;
        },
        success  : function(jsonResult)
        {  
            res = jsonResult;
        }
    }); 

    return res;
} 

//function add customer.
function addCustomer
(
    firstName,
    middleName,
    lastName,
    phoneNumber,
    email,
    note,
    isRegistration
)
{
    note = note != null ? note : '';
    //store customer name to send welcome email
    $.session.set('customerName', firstName + ' ' + 
        middleName);
    var result;
    var billingAddress = {
        "firstName" : firstName,
        "middleName": middleName,
        "lastName"  : lastName,
        "company"   : '',
        "address1"  : '',
        "address2"  : '',
        "city"      : '',
        "state"     : '',
        "zipCode"   : '',
        "country"   : '',
        "phone1"    : phoneNumber,
        "note"      : note,
        "fax"       : '',
        "email"     : email
    }

    var shippingAddress = {
        "firstNameShip" :'',
        "lastNameShip"  :'',
        "companyShip"   :'',
        "address1Ship"  :'',
        "address2Ship"  :'',
        "cityShip"      :'',
        "stateShip"     :'',
        "zipCodeShip"   :'',
        "countryShip"   :'',
        "telephoneShip" :'',
        "faxShip"       :'',
        "emailShip"     :''
    }

    var dataToSend = {
        "action"         : ADD_CUSTOMER,
        "customer"       : JSON.stringify(billingAddress),	  		
        "shippingAddress": JSON.stringify(shippingAddress)
    }
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        headers  : HEADER,    
        async    : false,
        error    : function (e)
        {  
            showAlertBox('Error',ERROR_MSG);
        },
        success: function(jsonResult)
        {
            result = jsonResult;
            if(!isRegistration)
            {                      
                addOwner(jsonResult.customerId,firstName,
                         lastName,email,phoneNumber); 
            }
        }
    });
    return result;
}

//function add user
function addUser
(
    userInfoId,
    userName,
    password,
    firstName,
    lastName,
    status,
    email
)
{
     
    var result;
    status = status == null ? INACTIVE : status;
    var encodeUN       = getEncode(userName);
    var dataToSend;
    if( $.session.get('isFBVerified') && 
                   $('#signUpButton').hasClass('fbSignUp') )
       {   
          dataToSend  = {
        "action"    : REGISTER_USER,
        "userInfoId": JSON.stringify(userInfoId),            
        "role"      : CUSTOMER_OWNER_ROLE,          
        "iv"        : JSON.stringify(encodeUN.iv),          
        "encodeUN"  : JSON.stringify(encodeUN.activate),
        "firstName" : JSON.stringify(firstName),
        "lastName"  : JSON.stringify(lastName),
        "email"     : JSON.stringify(email),
        "status"    : JSON.stringify(status),
        "genPass"   : true
         }
       }
       else
       {
         var encodePassword = getEncode(password, encodeUN.iv);
         dataToSend  = {
        "action"    : REGISTER_USER,
        "userInfoId": JSON.stringify(userInfoId),            
        "role"      : CUSTOMER_OWNER_ROLE,          
        "iv"        : JSON.stringify(encodeUN.iv),          
        "encodeUN"  : JSON.stringify(encodeUN.activate),
        "encodePass": JSON.stringify(encodePassword.activate),
        "firstName" : JSON.stringify(firstName),
        "lastName"  : JSON.stringify(lastName),
        "email"     : JSON.stringify(email),
        "status"    : JSON.stringify(status),
        "genPass"   : false
         }
       }
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        headers  : HEADER,      
        async    : false,
        error: function (e)
        { 
            result = -1;
        },
        success: function(jsonResult)
        {
            result = jsonResult;
        }
    });

    return result;
}


//function add owner
function addOwner
(
    customerId,
    firstName,
    lastName,
    email,
    phoneNumber,
    isRegistration,
    note
)
{   
    var result;
    customerId  = typeof(customerId) != undefined || customerId != null ?
    customerId : ''; 
    var ownerData  = {
        "customerId": customerId,
        "role"      : CUSTOMER_OWNER_ROLE, 
        "firstName" : firstName,
        "lastName"  : lastName,
        "address1"  : '',
        "address2"  : '',
        "city"      : '',
        "state"     : '',
        "zipCode"   : '',
        "country"   : '',
        "email"     : email,
        "phone1"    : phoneNumber,
        "phone2"    : '',
        "fax"       : '',
        "note"      : note || '',
        "subscribed": ''
    }
    var dataToSend  = {
        "action"    : ADD_OWNER,
        "owner"     : JSON.stringify(ownerData)       
    }
    //call to add owner api
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        headers  : HEADER,       
        async    : false,
        error: function (e) 
        {  
            result = -1;
        },
        success: function(jsonResult)
        { 
            result = jsonResult;
            if(!isRegistration)
            {
                addUser(jsonResult.ownerId,$('#emailAddress').val(),
                    $('#password').val(),firstName,lastName,ACTIVE,
                    $('#emailAddress').val());
            }
        }
    });

    return result;
}

//function validate role
function validateRole
(
    userDetails
)
{           
    var customerId;
    switch(userDetails.role)
    {
        case '0':
            showAlertBox('Login Error','Please contact MindShare support.');
            break;
        case '1' :
        case '2':
            getCustomerByCustomerId(userDetails);
        case '3':
            customerId = getOwnerByOwnerId(userDetails.userInfoId);
            if(customerId == -1)
            {
                addCustomer(userDetails.firstName,'',userDetails.lastName,
                    '',userDetails.email,true);
            }
            break;           
    }

    //to manage session need to store update value.
    var result = getByUserName(userDetails.email); 
    sessionManager('setSession','user', result.user);
    sessionManager('setSession','customerId',
        getOwnerByOwnerId(result.user.userInfoId));

    return true;
}

//function get customer by customer id.
function getCustomerByCustomerId
(
    userDetails,
    getOnly
)
{
    var customerId = userDetails.userInfoId || userDetails;
    var customer;
    var dataToSend   = 
    {
        "action"    : GET_CUSTOMER_BY_ID,
        "id"        : customerId       
    }
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                    	                    
        dataType : "xml",
        headers  : HEADER,
        async    : false,
        error: function (e) 
        {
            showAlertBox('Error',ERROR_MSG);
        },
        success: function(xmlResult)
        {
            if(getOnly)
            {
                customer = xmlResult;
            }
            else if(parseInt($('response id',xmlResult).text()) != -1)
            {                                  
                addOwner($('returnVal id',this).text(),userDetails.firstName,
                         userDetails.lastName,userDetails.email,'');
            }
            else
            {
                addCustomer(userDetails.firstName,'',userDetails.lastName,
                            '',userDetails.email);
            }
        }
    });

    return customer;
}
//function get owner by owner id.
function getOwnerByOwnerId
(
    ownerId,
    fullDetails
)
{
    var owner;
    var dataToSend   = 
    {
        "action"    : GET_OWNER_BY_ID,
        "id"        : ownerId      
    }
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                    	                    
        dataType : "xml",
        headers  : HEADER,
        async    : false,
        error: function (e) 
        {
            showAlertBox('Error',ERROR_MSG);
        },
        success: function(xmlResult)
        {
            if(parseInt($('response id',xmlResult).text()) != -1)
            {
                if(fullDetails)
                {
                    owner = xmlResult;
                }
                else
                {
                    owner = $('response customerId',xmlResult).text();
                }
            }
        }
    });

    return owner;
}

//function lifts by cutomer.
function liftsByCustomer
(
    customerId
)
{
    var res;
    var dataToSend   = 
    {
        "action"      : LIFTS_BY_CUSTOMER,
        "customerId" : JSON.stringify(customerId)       
    }
    $.ajax({
        type     : "POST",
        url      : CUSTOM_API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        headers  : HEADER,
        async    : false,
        error: function (e) 
        {
            showAlertBox('Error',ERROR_MSG);
        },
        success: function(jsonResult)
        {
            res = jsonResult;
        }
    });

    return res;
}

$.fn.filterType = function(filterType)
{
    switch(filterType.toLowerCase())
    {
        case 'alpha':
            $(this).alpha();
            break;
        case 'numeric':
            $(this).numeric();
            break;
        case 'alphanumeric':
            $(this).alphanumeric();
            break;
        case 'special':
            $(this).special();
            break;

    }
}

//function sort by year
function sortByYear
(
    array
) 
{
    return array.sort(function(a,b)
        {
            var x = parseInt(a.number.split('-')[1]);
            var y = parseInt(b.number.split('-')[1]);
            return ((x < y) ? -1 : ((x > y) ? 0 : 1));
    }).reverse();
};

//function send text message
function sendTextMessage
(
    phone,
    msg
)
{
    var res;
    var dataToSend  = {
        "action"    : SEND_TEXT_MESSAGE,
        "phone"     : JSON.stringify(phone),      
        "msg"       : JSON.stringify(msg)       
    }
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,
        async    :false,
        dataType : "json",
        headers  : HEADER,
        error    : function (e) 
        {
            res = -1;
        },
        success :function(jsonResult)
        {
            res = jsonResult;
        }
    });

    return res;
}

//get date time
$.getDateTime =
{
    date : function
    (
        dateTime
    )
    {
        return dateTime.split(' ')[0]; 
    },
    time : function
    (
        time,
        isTime
    )
    {
        if(isTime)
        {
            var hours = Number(time.match(/^(\d+)/)[1]);
            var minutes = Number(time.match(/:(\d+)/)[1]);
            var AMPM = time.match(/\s(.*)$/)[1];
            if(AMPM == "PM" && hours<12) hours = hours+12;
            if(AMPM == "AM" && hours==12) hours = hours-12;
            var sHours = hours.toString();
            var sMinutes = minutes.toString();
            if(hours<10) sHours = "0" + sHours;
            if(minutes<10) sMinutes = "0" + sMinutes;
            return(sHours + ":" + sMinutes);
        }
        else
        {
            time =  time.replace(' ','_');
            time = time.split('_')[1];
        }

        return time;
    },
    dateTime:function
    (
        dateTime
    )
    {
        dateTime = new Date(dateTime)
        dateTime = (dateTime.getMonth() + 1) + '/' + dateTime.getDate() + '/' +
        dateTime.getFullYear() + ' ' + dateTime.getHours() +':'+
        dateTime.getMinutes();
        return dateTime; 
    },
    formatDateTime:function
    (
        dateTime
    )
    {
        dateTime = dateTime.split(' ');
        var date = new Date (dateTime[0]);
        var time =dateTime[1].split(':');
        var hours = time[0];      
        var minutes = time[1];
        //it is pm if hours from 12 onwards
        var suffix = (hours >= 12)? 'PM' : 'AM';

        //only -12 from hours if it is greater than 12 (if not back at mid night)
        hours = (hours > 12)? hours -12 : hours;

        //if 00 then it is 12 am
        hours = (hours == '00')? 12 : hours;
        time = (hours +" : "+minutes +" "+ suffix); 
        dateTime = months[(date.getMonth() + 1)] + ' ' + date.getDate() +', ' + 
        date.getFullYear() + ' '+ time;
        return dateTime;       
    },
    datePickerDateTime:function
    (
        dateTime
    )
    {
        dateTime = dateTime.split(' ');
        var date = new Date (dateTime[0]);
        var time = dateTime[1];
        var hours = time.split(':')[0];
        var minutes = time.split(':')[1];
        //it is pm if hours from 12 onwards
        var suffix = (hours >= 12)? 'PM' : 'AM';

        //only -12 from hours if it is greater than 12 (if not back at mid night)
        hours = (hours > 12)? hours -12 : hours;

        //if 00 then it is 12 am
        hours = (hours == '00')? 12 : hours;
        time = (hours +":"+minutes +" "+ suffix); 
        dateTime = (date.getMonth() + 1) + '/' + date.getDate() +'/' + 
        date.getFullYear() + ' '+ time;
        return dateTime;       
    },
    formatDate:function
    (
        dateTime
    )
    {
        dateTime = dateTime.split(' ');
        var date = new Date(dateTime[0]);
        dateTime = months[(date.getMonth() + 1)] + ' ' + date.getDate() +', ' + 
        date.getFullYear() ;
        return dateTime;       
    },
    formatTime:function
    (
        dateTime
    )
    {
        dateTime = new Date(dateTime);
        var hours = dateTime.getHours();
        var minutes = dateTime.getMinutes();
        //it is pm if hours from 12 onwards
        var suffix = (hours >= 12)? 'PM' : 'AM';

        //only -12 from hours if it is greater than 12 (if not back at mid night)
        hours = (hours > 12)? hours -12 : hours;

        //if 00 then it is 12 am
        hours = (hours == '00')? 12 : hours;
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        return (hours +":"+minutes +" "+ suffix);       
    },
    convertToSQL:function(dateTime)
    {
        var date = new Date(dateTime);
        var month = date.getMonth()+1;
        month = month < 10 ? '0' + month : month;
        var hours = date.getHours();
        hours = hours < 10 ? '0'+ hours : hours;
        var minutes = date.getMinutes();
        minutes = minutes < 10 ? '0'+ minutes : minutes;
        var day = date.getDate();
        day = day<10 ? '0'+ day : day;
        var seconds = date.getSeconds();
        seconds = seconds< 10 ? '0'+seconds : seconds;
        dateTime = date.getFullYear()+'-'+(month)+'-'+day +' '+
        hours +':'+ minutes+':'+seconds;
        return dateTime;    
    }
}

// function get date time picker
$.fn.dateTimePicker = function
(
)
{
     var date = new Date();
     $(this).datetimepicker(
     {
            autoSize   : true,
            minDate    : 'today',
            dateFormat : DATE_FORMAT,
            timeFormat: 'hh:mm TT',
            hour       : date.getHours(),
            minute     : date.getMinutes(),
            onSelect : function(dateTime,inst){
                // compare for the dates
                var selectedDate  = $.datepicker.formatDate('mm-dd-yy',
                                                         new Date(dateTime))
                var todayDate = $.datepicker.formatDate('mm-dd-yy', new Date());
                if(selectedDate == todayDate)
                {     
                    if(new Date(dateTime).getTime()< new Date().getTime())
                      {
                        // add the validation method and rules  
                        $.validator.addMethod('minStrict',
                                                    function(value, el, param) {
                           value = new Date(dateTime).getTime();
                           return value > param;
                       }); 
                       $(this).rules( "add", {
                            required: true,
                            minStrict: new Date().getTime(),
                            messages: {
                            required: "please enter time",
                            minStrict: jQuery.format("Time should"+  
                                             ' '+"be greater than current time")
                            }
                         }); 
                         $(this).next('.popover').show();
                         $(this).popover('show');
                      }
                      else
                      {
                       //  removing the rules
                         $(this).rules("remove", "minStrict"); 
                         $(this).next('.popover').remove();
                         $(this).addClass('ignore');
                         $(this).removeClass('error'); 
                      }
                }
               else
                  {
                     $(this).rules("remove", "minStrict"); 
                     $(this).next('.popover').remove();
                     $(this).addClass('ignore');
                     $(this).removeClass('error'); 
                  } 
            },
            onClose : function(dateTime,inst){
                // validate again on closing of datetimepicker
                var selectedDate  = $.datepicker.formatDate('mm-dd-yy', 
                                                            new Date(dateTime))
                var todayDate = $.datepicker.formatDate('mm-dd-yy', new Date());
                
                if(selectedDate == todayDate)
                {         
                    if(new Date(dateTime).getTime()< new Date().getTime())
                    {
                    // add the validation method and rules     
                    $.validator.addMethod('minStrict',
                                                function(value, el, param) {
                       value = new Date(dateTime).getTime();
                       return value > param;
                    }); 
                    $(this).rules( "add", {
                        required: true,
                        minStrict: new Date().getTime(),
                        messages: {
                        required: "please enter time",
                        minStrict: jQuery.format("Time should  be greater"+ 
                                                    ' '+"than current time")
                        }
                     }); 
                      $(this).popover('show');
                    }
                    else
                    {
                     $(this).rules("remove", "minStrict"); 
                     $(this).next('.popover').remove();
                     $(this).addClass('ignore');
                     $(this).removeClass('error'); 
                    }
                }
                else
                {
                    $(this).rules("remove", "minStrict"); 
                    $(this).next('.popover').remove();
                    $(this).addClass('ignore');
                    $(this).removeClass('error'); 
                } 
            } 

    }).val('');
    $(this).datetimepicker( "option", "defaultDate", 0 );
}

// function get date  picker
$.fn.datePicker = function
(
    newDate
)
{ 
     _dateInst = $(this);
     if(!$(this).data('datePicker'))
     {
        var date = new Date();
        $(this).datepicker(
        {
            autoSize   : true,
            minDate    : 'today',
            dateFormat : DATE_FORMAT ,
            onSelect:function(dateText, inst) {
       // compare for dates
        var selectedDate  = $.datepicker.formatDate('mm-dd-yy',
                                                            new Date(dateText))
        var todayDate = $.datepicker.formatDate('mm-dd-yy', new Date());
               if(selectedDate == todayDate)
                { 
                  var newDateTime = dateText+' '+ $(_timeInst).val();
                      if(new Date(newDateTime).getTime()< new Date().getTime())
                      {  
                      // add the validation method and rules   
                        $.validator.addMethod('minStrict', 
                                                function (value, el, param) {
                           value = new Date(newDateTime).getTime();
                           return value > param;
                       }); 
                       $(_timeInst).rules( "add", {
                            required: true,
                            minStrict: new Date().getTime(),
                            messages: {
                            required: "please enter time",
                            minStrict: jQuery.format("Time should  be greater"+ 
                                                    ' '+"than current time")
                            }
                         }); 
                          $(_timeInst).popover('show');
                      }
                      else
                      {
                         $(_timeInst).rules("remove", "minStrict"); 
                         $(_timeInst).next('.popover').remove();
                         $(_timeInst).addClass('ignore');
                         $(_timeInst).removeClass('error'); 
                      }
                }
                else
                {
                     $(_timeInst).rules("remove", "minStrict"); 
                         $(_timeInst).next('.popover').remove();
                         $(_timeInst).addClass('ignore');
                         $(_timeInst).removeClass('error'); 
                }   
             }
        }).val('');
        $(this).data("datePicker", true);
        $(this).datepicker( "option", "defaultDate", 0 );
     }
     if(newDate)
     {
         $(this).datetimepicker( "setDate", newDate);
     } 
}

//function timepicker
$.fn.timePicker = function(time)
{  
     _timeInst = $(this);
    if(!$(this).data('timePicker'))
     {
        $(this).timepicker({
        timeFormat: 'hh:mm TT' ,
        onSelect : function(time,inst){
        var selectedDate  = $.datepicker.formatDate('mm-dd-yy', 
                                                  new Date($(_dateInst).val()))
        var todayDate = $.datepicker.formatDate('mm-dd-yy', new Date());
               if(selectedDate == todayDate)
                { 
                  var newDateTime = $(_dateInst).val()+' '+time;
                      if(new Date(newDateTime).getTime()< new Date().getTime())
                      { 
                      // add the validation method and rules      
                        $.validator.addMethod('minStrict',
                                                    function(value, el, param) {
                           value = new Date(newDateTime).getTime();
                           return value > param;
                       }); 
                       $(this).rules( "add", {
                            required: true,
                            minStrict: new Date().getTime(),
                            messages: {
                            required: "Please enter time",
                            minStrict: jQuery.format("Time should  be greater"+ 
                                                ' '+"than current time")
                            }
                         }); 
                          $(this).popover('show');
                      }
                      else
                      {
                         $(this).rules("remove", "minStrict"); 
                         $(this).next('.popover').remove();
                         $(this).addClass('ignore');
                         $(this).removeClass('error'); 
                      }
                }
                else
                {
                     $(this).rules("remove", "minStrict"); 
                     $(this).next('.popover').remove();
                     $(this).addClass('ignore');
                     $(this).removeClass('error'); 
                } 
        }
        });
        $(this).data("timePicker", true);
     }
     if(time)
     {
         $(this).timepicker('setTime',time);
     }  
}

//function get slider
$.fn.getSlider = function
(
    contentId,
    suffix,
    prefix,
    value,
    step
)
{
    prefix = prefix == null ? '' : prefix;
    suffix = suffix == null ? '' : suffix;
    $(this).slider({
        range: "max",
        min: 1,
        max: 50,
        step : step || 1,
        value: value || 30,
        slide: function( event, ui ) 
        {
            $("#" + contentId ).html(prefix + ui.value + suffix);
        }
    });   
}

//function get memeber order.
function getMemberOrder
(
    customerId 
)
{
    var res = 0;
    customerId = customerId || sessionManager('getSession','customerId');
    var dataToSend = 
    {
        "action"     : GET_MEM_ORDER,
        "customerId" : JSON.stringify(customerId)
    }
    $.ajax({
        type     : "POST",
        url      : CUSTOM_API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        headers  : HEADER,
        async    : false,
        error    : function (e)
        {
            res = -1;
        },
        success  : function(jsonResult)
        {
            res = jsonResult;         
        }
    });

    return res;
}

//function resend activation.
function resendActivation
(
    email
)
{
    var activationLink = getActivationLink(email);
    var hasSent = sendEmail(email,'AirPnd - Activate Your AIRPND Acccount',
        getActivationBody(activationLink));
    return hasSent;                          
}

//function get activation body
function getActivationBody
(
    activationLink
)
{
    activationLink = 'activation.php' + activationLink;
    var htmlBody = '<div><p>Please click on below link to ';
    htmlBody+='activate your account.</p>';
    htmlBody+='<p><a href="'+SITE_URL + activationLink + '"> Activate</a>';
    htmlBody+=' to activate your account.</p>';
    htmlBody +='<br /><p>Regards:-</p>';
    htmlBody +='<p>AIRPND Team.</p>';
    htmlBody +='<p><sub><i>This is a system generated';
    htmlBody +='&nbsp;mail. Please do not reply to it.';
    htmlBody +='</i><sub></p></div>';
    return htmlBody;
}

//function for loading activation message
function loadActivationMessage
(
    email
)
{
    var message = 'This user <b>' + email + '</b> is inactive. ';
    message+= 'Please activate your account';
    message+= ' to login into AIRPND. <a class="activationButton"';
    message+=' for="'+email+'"';
    message+= 'href="#">Resend Link ?</a>';
    return message;  
}

//function get category name.
function getCategoryName
(
    name
)
{
    var res;
    var dataToSend = 
    {
        "action"     : CATEGORY_BY_NAME,
        "name"       : name
    }
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                    	                    
        dataType : "xml",
        headers  : HEADER,
        async    : false,
        error    : function (e)
        { 
            showAlertBox("Error",ERROR_MSG);
        },
        success  : function(xmlResult)
        { 
            res = $('response returnVal id',xmlResult).text();
        }
    });

    return res;
}

//function get entities by category
function getEntitiesByCategory
(
    categoryId
)
{
    var res;
    var dataToSend = 
    {
        "action"     : GET_ENTITIES_BY_CATEGORY,
        "categoryId" : categoryId
    }
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        headers  : HEADER,
        async    : false,
        error    : function (e)
        { 
            showAlertBox("Error",ERROR_MSG);
        },
        success  : function(jsonResult)
        {            
            res = jsonResult;
        }
    });

    return res;
}

//function ride by customer
function rideByCustomer
(
    customerId
)
{  
    var res;
    var dataToSend = 
    {
        "action"     : RIDES_BY_CUSTOMER,
        "customerId" : customerId
    }
    $.ajax({
        type       : "POST",
        url        : CUSTOM_API_URL,
        data       : dataToSend,                          	                    
        dataType   : "json",
        headers    : HEADER,
        async      : false,
        error      : function (e) 
        {              
            showAlertBox('Error',ERROR_MSG);  
        },
        success    : function(jsonResult)
        { 
            res = jsonResult;
        }        
    });

    return res;
}

//function toggle section
function toggleSection
(
    dataToHide
)
{
    var userDetails = sessionManager('getSession','user');
    if(userDetails)
    { 
        $.each(dataToHide,function(i,item)
            {
                $('#' + item.id).removeClass('hide');
        });
    }
    else
    {
        loadSignInModal();
    }
}

//function getInvoiceType
function getInvoiceType
(
    invoiceType
)
{
    var invoiceTypeId;
    invoiceType  =  	invoiceType || INVOICE_TYPE;
    var dataToSend = 
    {
        "action" : GET_INVOICE_TYPE,
        "name"   : invoiceType
    }
    $.ajax({
        type: "POST",
        url: API_URL,
        data: dataToSend,                    	                    
        dataType: "xml",
        headers: HEADER,
        async:false,
        error: function (e) { 
            showAlertBox("Error",ERROR_MSG);
        },
        success: function(xmlResult){ 
            $(xmlResult).find("response").each(function()
                { 
                    var invoiceType = $(this).find("id").text(); 
                    if( invoiceTypeId != '')
                    {
                        invoiceTypeId = invoiceType;
                    }    
            });    
        }
    });

    return invoiceTypeId;
}

//function getPrice
function getPrice
( 
    entityId
)
{
    var price = 0;
    var dataToSend =
    {
        "action"    : GET_PRICE,
        "entityId"  : entityId
    };
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        async    : false,
        headers  : HEADER,
        error    : function (e)
        { 
            return false;
        },
        success  : function(jsonResult)
        {     
            price = jsonResult.priceList;
        }
    });

    return price;
}

// getting system userid
function getSystemUser
(
)
{
    var userId;
    var dataToSend = 
    {
        "action" : GET_SYSTEM_USER
    }
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                    	                    
        dataType : "xml",
        headers  : HEADER,
        async    : false,
        error    : function (e)
        { 
            return false;
        },
        success: function(xmlResult)
        {
            $(xmlResult).find("response").each(function()
                { 
                    if( $(this).find("id").text() != '')
                    {                   
                        userId = $(this).find("id").text();
                    }    
            });  
        }
    });

    return userId;
}

//function get lift by Id
function getLiftById
(
    liftId
)
{

    var res;
    var dataToSend = 
    {
        "action" : GET_A_LIFT,
        "liftId" : liftId
    }
    $.ajax({
        type     : "POST",
        url      : CUSTOM_API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        headers  : HEADER,
        async    : false,
        error    : function (e)
        { 
            res = -1
        },
        success: function(jsonResult)
        {
            res = jsonResult;
        }
    });

    return res;
}

//function get ride by Id
function getARide
(
    rideId
)
{
    var res;
    var dataToSend = 
    {
        "action" : GET_A_RIDE,
        "rideId" : JSON.stringify(rideId)
    }
    $.ajax({
        type     : "POST",
        url      : CUSTOM_API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        headers  : HEADER,
        async    : false,
        error    : function (e)
        { 
            res = -1
        },
        success: function(jsonResult)
        {
            res = jsonResult;
        }
    });

    return res;
}


// hide the address
function hideAddress
(
    address
)
{
    var addressList = address.split(',');
    var addressCNT  = addressList.length;   
    var address     = addressList[addressCNT-3] + "," + 
                      addressList[addressCNT-2] + "," + 
                      addressList[addressCNT-1];    
    return address;
}   

                                   
//function sort array by date time.
function sortByDateTime
(
    arr
)
{
    return arr.sort(function(a,b)
        {
            var secondDate = new Date(b.dt);
            var currentDate = new Date();
            return currentDate - secondDate ; 
    });
}

//function string format
String.format = 
function(){
    var theString = arguments[0];
    for (var i = 1; i < arguments.length; i++)
    {
        var regEx = new RegExp("\\{" + (i - 1) + "\\}", "gm");
        theString = theString.replace(regEx, arguments[i]);
    }	
    return theString;
}

//function clear form
$.fn.clearForm = function(){
    var parentDiv = $(this).closest('.modal').attr('id');
    var formId = $(this).closest('.modal').find('form').attr('id');       
    $('.popover','#' + formId).remove();
    $('#' + formId).find('input').removeClass('error');
    $('#' + formId).find('input').removeClass('success');
    $('#' + formId).find('input').val('');
    $('textarea').val('');
    $('textarea').removeClass('success');
    $('#' + parentDiv).modal('hide');
}
//function reset form
$.fn.resetForm = function()
{      
    $('.popover',this).remove();
    $(this).find('input').removeClass('error');
    $(this).find('input').removeClass('success');
    $(this).find('input').val('');
    $(this).find('textarea').removeClass('error');
    $(this).find('textarea').removeClass('success');
    $(this).find('textarea').val('');
}
// Read a page's GET URL variables and return them as an associative array.
function getUrlVars
(
)
{
    var vars = [], hash;
    var uri = window.location.href;
    var hashes = uri.slice(uri.indexOf('?') +1).split('&');              
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

//function slider
$.fn.contentSlider = function(defaultText,hideSideArrows,firstPanelToLoad)
{
    $(this).liquidSlider({
        autoHeight            : false,
        mobileNavDefaultText  : defaultText,
        slideEaseFunction     : 'animate.css',
        slideEaseDuration     : 100,
        heightEaseDuration    : 100,
        animateIn             : "bounceInDown",
        animateOut            : "bounceInUP",
        firstPanelToLoad      : firstPanelToLoad || 1,
        hideSideArrows        : hideSideArrows,
        hoverArrows           : !hideSideArrows
    });
}

function sortByKey
(  
    result,
    filterType,
    sortOrder
)
{
    sortOrder= sortOrder == 1 ? 1 : -1;
    var sortedData = result.sort(function(a, b){    
            x = a[filterType];
            y = b[filterType];
         if(Date.parse(x))
         {
            var dateA = new Date(x).getTime();
            var dateB = new Date(y).getTime(); 
            if(sortOrder == 1)
            {
               return dateA > dateB ? 1 : -1;  
            }
            else
            {
               return dateA < dateB ? 1 : -1;  
            }
         }
         else
         {
            if(sortOrder == 1)
            {
                return parseFloat(y) < parseFloat(x) ? 1 : -1;
            }
            else
            {
                return parseFloat(y) > parseFloat(x) ?  1 : -1;
            } 
         }
            return 0;
    });
    return sortedData;
}


//function get ride status name
function getRideStatusName
(
    status
)
{
    var statusName='';

    switch(status)
    {
        case '0':
            statusName = 'New';
            break;
        case '1':
            statusName = 'Available';
            break;
        case '2':
            statusName = 'Full';
            break;
        case '3':
            statusName = 'FulFilled';
            break;
    }

    return statusName;
}


//function get lift status name
function isLiftPaid
(
    status
)
{
    var paid = false;
    var statusInt = parseInt(status);
    
    
    if (statusInt > PENDING_PAYMENT)
    {
        return true;
    }
    else
    {
        return false;
    }
}


//function get lift status name
function getLiftStatusName
(
    status
)
{
    var statusName = '-';
    var statusInt = parseInt(status);
    switch(statusInt)
    {
        case NEW_LIFT:
            statusName = 'New Request';
            break;
        case PENDING_CONFIRM:
            statusName = 'Confirmation Pending';
            break;
        case PENDING_PAYMENT:
            statusName = 'Pending Payment';
            break;
        case PENDING_FULFILLED:
            statusName = 'Paid';
            break;
        case LIFT_FULFILLED:
            statusName = 'Fulfilled';
            break;
        case PENDING_CONFIRM_DRIVER:
            statusName = 'Confirmation Pending - Driver';
            break;
    }

    return statusName;
}


function rejectALift
(
    liftId
)
{
    var res = -1;
    var dataToSend =
    {
        'action'   : REJECT_A_LIFT,
        'liftId'   : JSON.stringify(liftId)            
    }
    $.ajax({
        type     : "POST",
        url      : CUSTOM_API_URL,
        data     : dataToSend,                                            
        dataType : "json",
        headers  : HEADER,
        async    : false,
        error    : function (e) 
        {  
            showAlertBox('Error',ERROR_MSG);
        },
        success  : function(jsonResult)
        {
            res = jsonResult.retCode;
        }
    });
    return res;
} 

// need to pass the lift id instead if ride id because
// ride may have multiple lifts.
function rejectARide
(
    liftId
)
{
    var res = -1;
    var dataToSend =
    {
        'action'   : REJECT_A_LIFT,
        'liftId'   : JSON.stringify(liftId)            
    }
    $.ajax({
        type     : "POST",
        url      : CUSTOM_API_URL,
        data     : dataToSend,                                            
        dataType : "json",
        headers  : HEADER,
        async    : false,
        error    : function (e) 
        {  
            showAlertBox('Error',ERROR_MSG);
        },
        success  : function(jsonResult)
        {
            res = jsonResult.retCode;
        }
    });
    return res;
} 

//function pending payment lift                                    
function pendingPaymentLift
(
    liftId
)
{
    var res = -1;
    var dataToSend =
    {
        'action'   : PENDING_PAYMENT_A_LIFT,
        'liftId'   : JSON.stringify(liftId)            
    }
    $.ajax({
        type     : "POST",
        url      : CUSTOM_API_URL,
        data     : dataToSend,                                            
        dataType : "json",
        headers  : HEADER,
        async    : false,
        error    : function (e) 
        {  
            showAlertBox('Error',ERROR_MSG);
        },
        success  : function(jsonResult)
        {
            res = jsonResult.retCode;
        }
    });
    return res;
} 


//function pending confirm lift
function pendingConfirmLift
(
    liftId
)
{
    var res = -1;
    var dataToSend =
    {
        'action'   : PENDING_CONFIRM_A_LIFT,
        'liftId'   : JSON.stringify(liftId)            
    }
    $.ajax({
        type     : "POST",
        url      : CUSTOM_API_URL,
        data     : dataToSend,                                            
        dataType : "json",
        headers  : HEADER,
        async    : false,
        error    : function (e) 
        {  
            showAlertBox('Error',ERROR_MSG);
        },
        success  : function(jsonResult)
        {
            res = jsonResult.retCode;
        }
    });

    return res;
}


//function pending fulfilled lift
function pendingFulFilledALift
(
    liftId
)
{
    var res = -1;
    var dataToSend =
    {
        'action'   : PENDING_FULFILLED_A_LIFT,
        'liftId'   : JSON.stringify(liftId)            
    }
    $.ajax({
        type     : "POST",
        url      : CUSTOM_API_URL,
        data     : dataToSend,                                            
        dataType : "json",
        headers  : HEADER,
        async    : false,
        error    : function (e) 
        {  
            showAlertBox('Error',ERROR_MSG);
        },
        success  : function(jsonResult)
        {
            res = jsonResult.retCode;
        }
    });

    return res;
}


//function confirm a lift
function confirmALift
(
    liftId
)
{
    var res = -1;
    var dataToSend =
    {
        'action'   : CONFIRM_A_LIFT,
        'liftId'   : JSON.stringify(liftId)            
    }
    $.ajax({
        type     : "POST",
        url      : CUSTOM_API_URL,
        data     : dataToSend,                                            
        dataType : "json",
        headers  : HEADER,
        async    : false,
        error    : function (e) 
        {  
            showAlertBox('Error',ERROR_MSG);
        },
        success  : function(jsonResult)
        {
            res = jsonResult.retCode;
        }
    });

    return res;
}
/********************* FOR AIRSPND PART ****************************/


//function process payment
//returns true if payment is processed
function processPayment
(
    amount
)
{
    var customerId = sessionManager('getSession','customerId');
    var res = getARide($.session.get('rideId'));
    var payRetCode = true;
    
    if(res.retCode && 
       res.ride != null && 
       res.ride.id > 0)
    {
        var entityId = res.ride.entityId;
        $.session.set('liftBalance', amount);
        
        var orderId = getOrderByEntity(entityId);
        
        if (orderId == NO_ID)
        {
            orderId = createAirspndOrder(entityId, customerId);
        }
        if(parseInt(orderId) <= 0)
        {
            payRetCode = false;
             $('.modal').modal('hide');
             showAlertBox('Error Alert',ERROR_MSG);
        }
        else
        {       
            payRetCode = makePayment(customerId, orderId, 
                                     amount);
                                     
            if (payRetCode)
            {
                addOrderToLift($.session.get('liftId'), orderId);
                                
                driverFirstName = res.ride.firstName;
                driverLastName  = res.ride.lastName;
                driverName      = driverFirstName + " " + driverLastName; 
                driverPhone     = res.ride.phone;
                driverEmail     = res.ride.email;
                rideDate        = res.ride.dt;
                rideTime        = res.ride.dt;   
                
                phoneNumber     =  driverPhone.split('-').join('');                 
                if (res.ride.textYes)
                {
                    var hasSent =  sendTextMessage(phoneNumber,
                                    "The rider has paid for the ride. Please " + 
                                    "login into AirPnd to see the detail of the " +
                                    "ride " + SITE_URL);
                }

                var result = getLiftById($.session.get('liftId')); 
                    lift = result.lift;

                var emailBody = getEmailBody('paymentForDriver',
                                             driverName, "", "", "",
                                             "", "", lift);     
            
                var emailSubject = 'AirPnd - Payment Confirmation'; 
                var hasMailSent  = sendEmail(driverEmail,
                                            emailSubject,emailBody); 
                
            }                          
        }
    }
    return payRetCode;
}

//function add order to Lift
//return none
function addOrderToLift(liftId, orderId)
{
    var ret = -1;
/*

    //order line
    var orderLine = [];
    var arrSubs = 
    {
        "facilityId"   : NO_ID,
        "binId"        : NO_ID,
        "entityTypeId" : categoryId,
        "entityId"     : entityId,
        "price"        : $.session.get('liftBalance'),
        "cost"         : $.session.get('liftBalance'),
        "quantity"     : 1
    };    
    orderLine.push(arrSubs);
*/    
    var dataToSend = 
    {
        "action"        : ADD_ORDER_TO_LIFT,
        "orderId"       : orderId,
        "liftId"        : liftId
    };

    $.ajax({
        type     : "POST",
        url      : CUSTOM_API_URL,
        data     : dataToSend,                                            
        dataType : "json",
        async    : false,
        headers  : HEADER,
        error    : function (e)
        { 
            ret = -1;
        },
        success  : function(jsonResult)
        { 
            if(parseInt(jsonResult.retCode) == 1)
            {                
                retCode = 1;
            }
            else
            {      
                retCode = 0;
            }
        }
    });    
    return ret;    
}

//function make payment
//returns success on making the payment
function makePayment
(
    customerId,
    orderId,
    balance
)
{
    var makePayRet = true;
    var payerId = NO_ID;
    var arrCustomer = getCustomerByCustomerId(customerId, true);
    if(($('firstName',arrCustomer).text().toLowerCase() == 
        $('#firstNamePayment').val().toLowerCase()) ||
        ($('lastName',arrCustomer).text().toLowerCase() == 
        $('#lastNamePayment').val().toLowerCase()) )
    {
        payerId = customerId;
    }
    var expMonth = $('#ccExpMonth option:selected').val();

    if($('#ccExpMonth option:selected').val().length == 1)
    {
        expMonth= '0' + $('#ccExpMonth option:selected').val();
    }
   
    var payer = {
        "id"          : $('id',arrCustomer).text(),
        "parentID"    : $('parentId',arrCustomer).text(),
        "typeId"      : $('typeId',arrCustomer).text(),
        "status"      : $('status',arrCustomer).text(),
        "number"      : $('number',arrCustomer).text(),
        "firstName"   : $('#firstNamePayment').val(),
        "lastName"    : $('#lastNamePayment').val(),
        "middleName"  : $('#middleNamePayment').val(),
        "companyName" : $('companyName',arrCustomer).text(),
        "address1"    : $('#steetAddress').val(),
        "address2"    : '',
        "city"        : $('#city').val(),
        "state"       : $('#state option:selected').val(),
        "zipCode"     : $('#zipCode').val(),
        "country"     : COUNTRY_NAME,
        "email"       : $('email',arrCustomer).text(),
        "phone1"      : $('phone1',arrCustomer).text(),
        "phone2"      : $('phone2',arrCustomer).text(),
        "fax"         : $('fax',arrCustomer).text(),
        "balance"     : balance,
        "note"        : $('note',arrCustomer).text(),
        "taxRate"     : $('taxRate',arrCustomer).text(),
        "subscribed"  : $('subscribed',arrCustomer).text()
    };
    var payment = {
        "id"        : NO_ID,
        "orderId"   : orderId,
        "payerId"   : payerId,
        "ccType"    : $('#ccType option:selected').val(),
        "ccNum"     : $('#ccNumber').val(),
        "ccCode"    : $('#cvv').val(),
        "ccExpMonth": expMonth,
        "ccExpYear" : $('#ccExpYear option:selected').val(),
        "amount"    : balance
    };
    var dataToSend = {
        'action'    : MAKE_PAYMENT,
        'payer'     : JSON.stringify(payer),
        'payment'   : JSON.stringify(payment)
    };
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                                            
        dataType : "json",
        async    : false,        
        headers  : HEADER,
        error    : function (e)
        { 
            $('.modal').modal('hide');
        },
        success  : function(jsonResult)
        {                           
            var location =  window.location.pathname;       
            if(jsonResult.returnCode == -1)
            {
                makePayRet = false;
                showAlertBox('Payment Failure Alert',jsonResult.errorMsg,
                SITE_URL + location.split('/')[1]);
            }
            else if(jsonResult.returnCode == 1)
            {
                var liftId = $.session.get('liftId');
                var hasConfirm = pendingFulFilledALift(liftId);
                if(hasConfirm == 1)
                {                                  
                    var result = getLiftById($.session.get('liftId')); 
                    lift = result.lift;
                    var hasSent = true;   
                    if (lift.textYes)
                    {
                        hasSent =  sendTextMessage($('phone1',
                                                   arrCustomer).text(),
                                                   "Your payment was processed."+"\n" +
                                                   "Your Confirmation no :"+"\n" +
                                                   $.session.get('confirmationNo') + 
                                                   ' Please check your email to see the detailed information ' + 
                                                   'on the confirmation.');
                    }           
                                    
                    var emailBody = getEmailBody('payment',
                                  $('firstName',arrCustomer).text() +' '+
                                  $('lastName',arrCustomer).text(),
                                  '', '', '', '', '', lift);     

                    var emailSubject = 'AirPnd - Payment confirmation '; 
                    var hasMailSent = sendEmail($('email',arrCustomer).text(),
                                               emailSubject,emailBody); 
                                               
                    if (hasMailSent)
                    {
                        $('.modal').modal('hide');
                        $.session.clear('confirmationNo');
                        showAlertBox('Payment Confirmation',
                                     'Your payment was processed. Please ' + 
                                     'check your email or text message for ' + 
                                     'the confirmation number and please ' +
                                     'provide the confirmation number to ' + 
                                     'your driver at the end of the ride.',
                                     SITE_URL + location.split('/')[1]);
                    } 
                    else
                    {
                        $.session.clear('confirmationNo');
                        showAlertBox('Mail failure',
                                     'Email Sending Failed',
                                     SITE_URL + location.split('/')[1]);
                    }                      
                }
            }
            else
            {
                makePayRet = false;
                showAlertBox('Payment Failure Alert','Failed to set lift to confirm',
                SITE_URL + location.split('/')[1]);
            }
        }
    });
    return makePayRet;
}


//function get order for entity
function getOrderByEntity
(
    entityId
)
{
    var res = -1;

    var dataToSend = 
    {
        "action"     : GET_ORDER_BY_ENTITY,
        "entityId"   : entityId
    };

    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                                            
        dataType : "json",
        async    : false,
        headers  : HEADER,
        error    : function (e)
        { 
            res = NO_ID;
        },
        success  : function(jsonResult)
        { 
            if(jsonResult.orderId != NO_ID)
            {                
                res =  jsonResult.orderId;
                $.session.set('confirmationNo', 
                              jsonResult.number);
            }
            else
            {      
                res = NO_ID;
            }
        }
    });
    return res;
}


//function create order
function createAirspndOrder
(
    entityId,
    customerId
)
{
    var res = -1;
    var invoiceTypeId = getInvoiceType(RENTAL_INVOICE_TYPE);    
    //category
    var categoryId    = getCategoryName(DRIVE);

    //order line
    var orderLine = [];
    var arrSubs = 
    {
        "facilityId"   : NO_ID,
        "binId"        : NO_ID,
        "entityTypeId" : categoryId,
        "entityId"     : entityId,
        "price"        : $.session.get('liftBalance'),
        "cost"         : $.session.get('liftBalance'),
        "quantity"     : 1
    };    
    orderLine.push(arrSubs);
    var dataToSend = 
    {
        "action"       : CREATE_ORDER,
        "customerId"   : customerId,
        "userId"       : getSystemUser(),
        "invoiceTypeId" : invoiceTypeId,
        'tax'           : TAX,
        'fee'           : FEE,
        "status"        : PAID_STATUS,
        "ols"           : JSON.stringify(orderLine)
    };

    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                                            
        dataType : "json",
        async    : false,
        headers  : HEADER,
        error    : function (e)
        { 
            res = -1;
        },
        success  : function(jsonResult)
        { 
            if(parseInt(jsonResult.retCode) == 1)
            {                
                res =  jsonResult.orderNumber.split('-')[1];
                $.session.set('confirmationNo', 
                              jsonResult.orderNumber);
             }
            else
            {      
                res = 0;
                $.session.clear('confirmationNo'); 
            }
        }
    });
    return res;
}

//auto complete
$.fn.autoComplete = function(option){ 
    var locations =  getAirports();
    $(this).autocomplete({
           minLength: 2,
          source: function( request, response ) {   
          var matcher = new RegExp(request.term, 'i');
          var name =  $.grep(locations, function(item)
           { 
               item = item.name;   
               return matcher.test( item );
           });
           // to return only name
          response( $.map(name, function(el, i){
                return el.name;
           }));
          },
        change: function(event,ui)
        {
            if (ui.item==null)
            {
                $(this).val('');
                $(this).focus();
            }
        }
    });
} 

//function get price for ride
function getPriceForRide
(   
    airportName,
    driverAddress,
    miles
)
{
    var price = -1;
    var dataToSend = {
        'action'       : GET_PRICE_FOR_RIDE,
        'airportName'  : JSON.stringify(airportName),
        'driverAddress': JSON.stringify(driverAddress), 
        'miles'        : JSON.stringify(miles)
    };
    $.ajax({
        type     : "POST",
        url      : CUSTOM_API_URL,
        data     : dataToSend,                                            
        dataType : "json",
        headers  : HEADER,
        async    : false,
        error    : function (e)
        { 
            price = -1;
        },
        success  : function(jsonResult)
        {
            if(jsonResult.retCode)
                price = jsonResult.maxPerRider;
        }
    });
       
    return price;
}

//function sort location
function sortLocation(a,b)
{
    return a.name.toLowerCase() > b.name.toLowerCase() ? 1 : -1;
}
/* End of file commentCommon.js */
/* Location: ./js/commentCommon.js */  
