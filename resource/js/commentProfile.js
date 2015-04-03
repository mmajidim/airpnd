/**
 * @file       commentProfile.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for profile(manage profile) page.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added facebook functionality and
 *             done with minor formatting
 * @revDate    05/06/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    modified functionality and
 *             done with minor formatting
 * @revDate    05/12/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    modified functionality for optional field and
 *             done with minor formatting
 * @revDate    05/19/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    remove  ach paypal account information 
 * @revDate    06/16/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    update for phone no validation  and persist password
 * @revDate    06/30/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    fix minor alingment issues
 *             
 */
var _selectedAct = NO_ACCT;   // no selection 

$.validator.addMethod("achValid", 
    function(value, element) 
    {
        return this.optional(element) ||
               value.match(/^[a-z0-9]+$/);
    }, "Please enter number and letters for ACH, need a dash to separate ");
/*
        return this.optional(element) ||
               value.match(/^[a-z0-9]+(-[a-z0-9]+)$/);
    }, "Please enter number and letters for ACH, need a dash to separate ");
*/

    
$(function (){ 
    var userDetails = sessionManager('getSession','user');
    if(userDetails)
    {
        //update user entry on edit button click
        $(document).on('click','#editMyProfile,#cancelBtn',function(){ 
               $('.popover','#userProfile').remove();
               $('input').removeClass('error');
               $('#success').addClass('hide');
               $('#confirmMessage').css('display','none');
               toggleProfile();
        });
        //update user entry on edit button click
        $('.closeMessage').on('click',function() {
                $('#confirmMessage').slideUp('slow');
        });
        
          //update account setting
        $('.account').on('click',function() {
            achChecked = $('#' + 'ach').is(":checked");
            paypalChecked = $('#' + 'paypal').is(":checked");

            $('#accountNumber').popover('hide');
            $('#accountNumber').removeClass('error');
                        
            if (achChecked)
            {
                if (_selectedAct == ACH_ACCT)
                {
                    $("#ach").attr("checked", false);
                }
                else
                {
                    paypalChecked = false;
                    _selectedAct = ACH_ACCT;
                    $("#paypal").attr("checked", false);
                    $("#accountNumber").prop('type', 'text');                    
                    $("#accountNumber").rules("remove", "email");                    
                }
            }

            if (paypalChecked)
            {
                if (_selectedAct == PAY_PAL_ACCT)
                {
                    $("#paypal").attr("checked", false);
                }
                else
                {
                    _selectedAct = PAY_PAL_ACCT;
                    $("#paypal").attr("checked", true);
                    $("#accountNumber").prop('type', 'email');
                    $("#accountNumber").rules("remove", "achValid");
                }
            }

            if (!achChecked && !paypalChecked)
            {
                _selectedAct = NO_ACCT;
            }
            if (_selectedAct == NO_ACCT)
            {
                $('#accocuntName').text('');
                $("#accountNumber").val('');
            }
            else
            {
                $('#accocuntName').text($('.account:checked').attr('data-for'));
            }
        });
    }
    else
    {
        loadSignInModal();
    }                        
}); 


 // validate phone no
$(document).on('click','#sms',function(){    
    $('#phoneNumber').toggleClass('ignore');
    if(!$(this).is(':checked'))
    {   
        $('#phoneNumber').next('.popover').remove();
        validatePhone  = false;
    }
    else
    {
        validatePhone  = true;
    }
});


// update profile
$(document).on('click','#updateProfile',function(e)
{
    validatePhone =  $('#sms').prop('checked') ? true : false; 
    if ($('#passwordProfilePage').val() == '')
    {
        passVal = true;
    }
    if (validatePhone) 
    {
        $( '#phoneNumber' ).rules( "add", {
            required: true,
            messages: {
                       required: "please enter phone number"
            }
        });
    } 
            
    if (!validatePhone)
    {
        $('#phoneNumber' ).rules( "add", {required: false,});
    }

    if (_selectedAct == PAY_PAL_ACCT)
    {
        $( '#accountNumber' ).rules( "add", 
        {
            email: true,
            messages: 
            {
                   required: "please enter valid email"
            }
        });        
    }     
    else
    {
        $( '#accountNumber' ).rules( "add",
        {
            achValid: true,
            messages:
            {
                required: "please enter valid ACH account"
            }
        });
    }    
});


window.onload = function()
{    
    loadProfile();
    var  passVal = false;
    var validatePhone = false; 
    $('#userProfile').validate({
        ignore: ":hidden .ignore",
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
        showErrors: function(errorMap, errorList) {
            $.each(this.successList, function(index, value) {
                return $(value).popover("hide");
            });
            return $.each(errorList, function(index, value) {
                getErrorPopupTemplate(value,'right');
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
            confirmPassword : {
                required:passVal,
                equalTo: "#passwordProfilePage"
            },
            phoneNumber : {
                required:validatePhone
            },
            account:{
                required:true
            }                        
        },
        messages: {
            firstName: 
            {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'first name')
            },
            lastName: 
            {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'last name')
            },
           confirmPassword:{
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'confirm password') ,
                equalTo : 'password does not match'
            },
            phoneNumber:{
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'phone number')
            },
            account:{
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'account type')
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
            $('#loaderUpdateProfile').removeClass('hide');
            updateUserProfile();
        }
    });
}

//function load profile.
function loadProfile
(
)
{      
    var userDetails = sessionManager('getSession','user');
    var customerId  = sessionManager('getSession','customerId');
    var detail      = getCustomerByCustomerId(customerId,true);
    var noteText    = $('returnVal note',detail).text();
    noteText        = noteText.replace(/(\r\n|\n|\r)/gm,"");
    
    var note        = noteText.split(';');
    var smsSub      = note[0].split(':')[1];  
    var status      = smsSub === ('Y' || 'y') ? true : false;
    if (typeof(userDetails) == undefined || userDetails == null)
    {
        return;
    }
    
    if (note[1] != undefined || null)
    {  
        $("#paypal").attr("checked", false);
        $("#ach").attr("checked", false);
                 
        var bankAccountInfo  = note[1].split(':');   
        var currentAc = bankAccountInfo[0] === PAY_PAL_ACCT_LABEL ?
                        PAY_PAL_TAG : ACH_TAG;
        $("#accocuntName").html(bankAccountInfo[0]);
        $("#accountNumber").val(bankAccountInfo[1]); 
        $("#"+currentAc).prop("checked", true);
        
        if (currentAc == PAY_PAL_TAG)
        {
            _selectedAct = PAY_PAL_ACCT;
        }
        else
        {
            _selectedAct = ACH_ACCT;
        }           
    }
    else
    {
       // $("#accocuntName").html('Account Number');
    }   
    var name = userDetails.name != null ? userDetails.name :
              (userDetails.firstName+' ' +(userDetails.middleName || '') +' ' + 
               userDetails.lastName);
    $('#userFullNameProfilePage').html(name);
    $('#firstProfilePage').val(userDetails.firstName || userDetails.first_name);
    $('#middleProfilePage').val(userDetails.middleName);
    $('#lastProfilePage').val(userDetails.lastName || userDetails.last_name);
    $('#emailIdProfilePage').html(userDetails.email);
    $('#emailProfilePage').val(userDetails.email);
    $('#contact').html(userDetails.phone);
    $('#phoneNumber').val(userDetails.phone);
    $('#smsAlert').html(!status? "No":"Yes");
    $('#sms').prop('checked', status);  
    $('#notification').addClass('hide');
}


//function add user
function updateUser
(
    ownerId,
    firstName,
    lastName,
    userName,
    password
)
{
    var dataToSend;
    var genPass = $('#passwordProfilePage').val().trim() != ''? true : false;
    var encodeUN = getEncode(userName);
    if($('#passwordProfilePage').val().trim() != '')
    {
        var encodePass = getEncode(password,encodeUN.iv)
         dataToSend  = {
        "action"     : REGISTER_USER,
        "userInfoId" : ownerId,            
        "role"       : CUSTOMER_OWNER_ROLE,          
        "iv"         : JSON.stringify(encodeUN.iv),          
        "encodeUN"   : JSON.stringify(encodeUN.activate),
        "encodePass" : JSON.stringify(encodePass.activate),
        "firstName"  : JSON.stringify(firstName),
        "lastName"   : JSON.stringify(lastName),
        "email"      : JSON.stringify(userName),
        "status"     : ACTIVE ,
        "genPass"    : false
                       } 
     }
     else
     {
         dataToSend  = {
            "action"     : REGISTER_USER,
            "userInfoId" : ownerId,            
            "role"       : CUSTOMER_OWNER_ROLE,          
            "iv"         : JSON.stringify(encodeUN.iv),          
            "encodeUN"   : JSON.stringify(encodeUN.activate),
            "firstName"  : JSON.stringify(firstName),
            "lastName"   : JSON.stringify(lastName),
            "email"      : JSON.stringify(userName),
            "status"     : ACTIVE ,
            "genPass"    : false
        }   
    }

    $.ajax({
        type: "POST",
        url: API_URL,
        data: dataToSend,                    	                    
        dataType: "json",
        headers: HEADER,
        error: function (e)
        { 
            $('#loaderUpdateProfile').addClass('hide');   
            showAlertBox('Error',ERROR_MSG);
        },
        success: function(jsonResult)
        {
            if(jsonResult.retCode)
            {  
                 var user = getByUserName(userName);
                if(user.retCode && user.user)
                {
                    sessionManager('setSession','user',user.user);
                }    
                
                $('#loaderUpdateProfile').addClass('hide'); 
                $('.profileEdit,.labelData,.passwordField,.accountField').
                    toggleClass('hide');
                showAlertBox('Success Alert','Your profile has been updated.',
                             SITE_URL+'profile.php'); 
            }
            if(jsonResult.retCode == 0)
            {  
                $('#loaderUpdateProfile').addClass('hide'); 
                $('#success').addClass('hide');
                $('#error').slideDown();               
                $('#editMyProfile').html('Edit');
                $('#confirmMessage').slideDown();
            }
        }
    });
}

//function update user profile.
function updateUserProfile
(
)
{
    var firstName  = $('#firstProfilePage').val();
    var middleName = $('#middleProfilePage').val();
    var lastName   = $('#lastProfilePage').val();
    var email      = $('#emailProfilePage').val();
    var phone      = $('#phoneNumber').val();
    var note       = getNoteSection();
    var res        = updateCustomer(firstName,
                                    middleName,
                                    lastName,
                                    phone,
                                    email,
                                    note);
    if(res)
    {
        var customerId = sessionManager('getSession','customerId');
        res = updateOwner(customerId,firstName,lastName,email,phone,note);
        if(res.retCode)
        {
            var userDetails = sessionManager('getSession','user');
            updateUser(userDetails.userInfoId,firstName,lastName,email,
                $('#passwordProfilePage').val());
        }
        else if(!res.retCode)
        {
            $('#loaderUpdateProfile').addClass('hide');  
            showAlertBox('Error','Owner update is failed.',
                SITE_URL+'profile.php');
        }
    }
    else if(res == 0)
    {
        $('#loaderUpdateProfile').addClass('hide');  
        showAlertBox('Error','Customer update is failed.',
            SITE_URL+'profile.php');
    }
}


//get note section
function getNoteSection
(
)
{
    var smsAlert    = $('#sms').is(':checked') ? 'Y' : 'N';
    var accountName = $('.account:checked').attr('data-for');

    var note = "";
    note  = String.format("SMS:{0}",smsAlert);
    if (accountName != "")
    {
        accNum = $("#accountNumber").val()
        note  += ";\n" + accountName + ":" + accNum;
    }
    return note;
}


//function toggle profile
function toggleProfile
(
)
{
    var text = "Edit";
    if( $('#editMyProfile').text().toLowerCase() === "edit")
    {  
        $('#notification').removeClass('hide');
        $("#userProfile").resetForm();
        loadProfile();
        text = "";
    }
    $("#editMyProfile").html(text);
    $('.profileEdit,.labelData,.passwordField,.accountField').
     toggleClass('hide');
}

//function ride by customer
function updateCustomer
(
    firstName,
    middleName,
    lastName,
    phoneNumber ,
    email,
    note
)
{        
    var customerId = sessionManager('getSession','customerId');
    var detail     = getCustomerByCustomerId(customerId,true);
    var customer   =
    {
        'id'         : customerId,
        'firstName'  : firstName,
        'middleName' : middleName,
        'lastName'   : lastName,
        'phone1'     : phoneNumber,
        'email'      : email,
        'note'       : note   
    }


    var res = -1;
    var dataToSend = 
    {
        "action"     : UPDATE_CUSTOMER,
        "customer"   : JSON.stringify(customer)
    }
    $.ajax({
        type       : "POST",
        url        : API_URL,
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
            res = jsonResult.retCode; 
        }        
    });
    return res;
}

//function update owner
function updateOwner
(
    customerId,
    firstName,
    lastName,
    email,
    phoneNumber,
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
        }
    });
    return result;
}
/* End of file commentProfile.js */
/* Location: ./js/commentProfile.js */
