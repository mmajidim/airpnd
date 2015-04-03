/**
 * @file       commentContactUs.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for contact us page.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added contact us page functionality and
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    06/02/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 */ 
$(function(){    
    $('#contactUsForm').validate({
        onfocusout: function(element){
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
                getErrorPopupTemplate(value,'right');
            });
        },
        rules:
        {
            nameContactUs : {
                required:true
            },
            emailContactUs : {
                required:true,
                email:true
            },
            contactNumber : {
                required:true,
                usPhoneFormat:true
            },
            supportCommentContactUs : {
                required:true
            }
        },
        messages: {
            nameContactUs: 
            {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'name')
            },
            emailContactUs: {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'email address'),
                email:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'valid email address')
            },
            contactNumber:
            {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'contact number')
            },
            supportCommentContactUs:
            {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'query')
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
            $('#supportButton').attr('disabled',true);
            $('#contactUsLoader').removeClass('hide');
            var message = getFeedbackEmailBody($('#nameContactUs').val(),
                                               $('#emailContactUs').val(),
                                               $('#phoneNumber').val(),
                                               $('#supportCommentContactUs').
                                               val());
            var hasSent = sendEmail(CARRBO_SUPPORT,'Feedback',message);
            if(hasSent)
            {
                 var mesg = 'We have received your request and ';
                 mesg+='we will be get in touch with you at the earliest.'
                 showAlertBox('Alert',mesg,SITE_URL+'contactUs.php')
            }               
        }
    });
});

//funtion for getting email body for feedback form
function getFeedbackEmailBody
(
    name,
    emailID,
    contactNumber,
    message
)
{
    var emailBody = '<p>User Details:-</p>';
    emailBody += '<p>Name:-' + name + '</p>';
    emailBody += '<p>Email ID:-' + emailID + '</p>';
    emailBody += '<p>Conatct:-' + contactNumber + '</p>';
    emailBody += '<p><strong>queries/feedback</strong><br>' + message + '</p>';
    return emailBody;
}
/* End of file commentContactUs.js */
/* Location: ./js/commentContactUs.js */  
