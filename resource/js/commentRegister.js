/**
 * @file       commentRegister.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for registration functionality.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added registartion functionality functionality and
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    05/29/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    remove ach & paypal account information 
 * @revDate    06/02/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    06/20/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    06/30/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    fix minor alingment issues
 */ 
                              
//function add customer.
function registerCustomer
(
)
{     
    var res = addCustomer($('#firstNameSignUp').val(),
                          $('#middleNameSignUp').val(),
                          $('#lastNameSignUp').val(),
                          $('#phoneNumber').val(),
                          $('#emailSignUp').val(),
                          getNoteSection(),
                           true);
    switch(res.retCode)
    {
        case 1:
            $.session.set('customerId',res.customerId);
            //After adding customer , check for owner existance.
            getOwnerByFLName($('#firstNameSignUp').val(),
                             $('#lastNameSignUp').val(),
                             $('#emailSignUp').val());
            break;
        default:
            $('#signUpLoader').hide();
            $("#signUpModal .closeIcon").removeClass('hide');
            $('#signUpButton').removeAttr('disabled');
            showAlertBox('Error',ERROR_MSG);
            break;
    }
}

//function add user
function registerUser
(   
)
{
     var password =  $('#passwordSignUp').val();
     if( $.session.get('isFBVerified') && 
         $('#signUpButton').hasClass('fbSignUp') )
     {   
           password = ''; 
     }
    var res = addUser($.session.get('ownerId'),
                      $('#emailSignUp').val(),
                      password , 
                      $('#firstNameSignUp').val(), 
                      $('#lastNameSignUp').val(),
                      INACTIVE,
                      $('#emailSignUp').val());   
    var userPassword =  getDecodePassword(res.encodePass,res.iv); 
    switch(res.retCode)
    {
        case 1:
            processActivation(res,$('#emailSignUp').val(),userPassword.password) ;
            break;
        default:
            $("#signUpModal .closeIcon").removeClass('hide');
            showAlertBox('Error',ERROR_MSG);
            break;
    }
}

//function add owner
function registerOwner
(
)
{ 
    var res = addOwner($.session.get('customerId'),
                       $("#firstNameSignUp").val(),
                       $("#lastNameSignUp").val(),
                       $("#emailSignUp").val(),
                       $("#phoneNumber").val(),
                       true,
                       getNoteSection());
    if(res.retCode)
    {
        $.session.set('ownerId',res.ownerId);
        registerUser();
    }
    else
    {
        $('#signUpLoader').hide();
        $("#signUpModal .closeIcon").removeClass('hide');
        $('#signUpButton').removeAttr('disabled');
        showAlertBox('Error',ERROR_MSG);
    }
}

//function get customer by first last name.
function getCustomerByFLName
(
    firstName,
    lastName,
    email
)
{
    var customerName = firstName + ' ' + lastName;
    var dataToSend   = {
        "action"    : GET_CUSTOMER_BY_FL_NAME,
        "exact"     : MATCH_EMAIL,       
        "name"      : JSON.stringify(customerName),
        "email"     : JSON.stringify(email)
    }
    $.ajax({
        type    : "POST",
        url     : API_URL,
        data    : dataToSend,                    	                    
        dataType: "json",
        headers : HEADER,
        error: function (e) 
        {
            $('#signUpLoader').hide();
            $('.modal').modal('hide');
            $("#signUpModal .closeIcon").removeClass('hide');
            $('#signUpButton').removeAttr('disabled');
            showAlertBox('Error',ERROR_MSG);
        },
        success: function(jsonResult)
        {
            if(jsonResult.retCode)
            {                
                $.session.set('customerId',
                    jsonResult.customers[0].id);
                getOwnerByFLName($('#firstNameSignUp').val(),
                                 $('#lastNameSignUp').val(),
                                 $('#emailSignUp').val());
            }
            else if(!jsonResult.retCode)
            {
                registerCustomer();
            }
            else
            {
                $('#signUpLoader').hide();
                $('.modal').modal('hide');
                $("#signUpModal .closeIcon").removeClass('hide');
                $('#signUpButton').removeAttr('disabled');
                showAlertBox('Error',ERROR_MSG);
            }
        }
    });
}

//get owner by first last name.
function getOwnerByFLName
(
    firstName,
    lastName,
    email
)
{
    var ownerName = firstName + ' ' +  lastName;
    var dataToSend  = {
        "action"    :GET_OWNERS_BY_FL_NAME,
        "exact"     : MATCH_EMAIL,       
        "name"      : JSON.stringify(ownerName),
        'email'     : JSON.stringify(email)  
    }
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        headers  : HEADER,
        error    : function (e) 
        {
            $('#signUpLoader').hide();
            $('.modal').modal('hide');
            $("#signUpModal .closeIcon").removeClass('hide');
            $('#signUpButton').removeAttr('disabled');
            showAlertBox('Error',ERROR_MSG);
        },
        success: function(jsonResult)
        {                     
            if(jsonResult.retCode)
            {
                $.session.set('ownerId',jsonResult.owners[0].id);    
                registerUser();
            }
            else if(!jsonResult.retCode)
            {
                registerOwner($.session.get('customerId'));
            }
            else
            {
                $('#signUpLoader').hide();
                $('.modal').modal('hide');
                $("#signUpModal .closeIcon").removeClass('hide');
                $('#signUpButton').removeAttr('disabled');
                showAlertBox('Error',ERROR_MSG);
            }
        }
    });
}

//function get user by user name.
function getUserByUserName
(
    userName
)
{
    var res = getByUserName(userName);
    switch (res.retCode) 
    {
        case 0:
            getCustomerByFLName($('#firstNameSignUp').val(),
                                $('#lastNameSignUp').val(),
                                $('#emailSignUp').val());
            break;
        case 1:
            $('#signUpLoader').hide();
            $("#signUpModal .closeIcon").removeClass('hide');
            $('#signUpButton').removeAttr('disabled');
            $("#signUpModal").scrollTop(0);
            $('#messageContentSignUp').html('This email <b>' + 
                $('#emailSignUp').val() + '</b> is already exists.');
            $('#messageSignUp').slideDown('slow');
            setTimeout(function(){
                $('#messageSignUp').slideUp('slow');
                },5000);
            break;
        default:
            $('#signUpLoader').hide(); 
            $("#signUpModal .closeIcon").removeClass('hide');
            $('#signUpButton').removeAttr('disabled');
            $('#signUpModal').modal('hide');   
            showAlertBox('Error',ERROR_MSG);
            break;
    }
}

//function get note section
function getNoteSection()
{
    var smsAlert = $('#phoneMessage').is(':checked') ? 'Y' : 'N';
   // var accountName = $('.account:checked').attr('data-for');
//    var note = String.format("SMS:{0};{1}:{2}",smsAlert,accountName,
//                            $('#accountNumber').val());
    var note = String.format("SMS:{0}",smsAlert);
    return note;
}
/* End of file commentRegister.js */
/* Location: ./js/commentRegister.js */  

