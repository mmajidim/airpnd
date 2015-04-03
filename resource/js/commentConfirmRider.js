/**
 * @file       commentConfirmRider.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for confirm rider.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added confirm rider page functionality and
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    06/02/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    updated functionality for SMS.
 * @revDate    06/20/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    06/30/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 */ 
$(function(){
    $('.closeIcon').hide();
    $(document).on('click','.confirmRiderbtn', function(e){ 
        $('.confirmRiderLoader').removeClass('hide');  
        $(this).prop('disabled',true);
        var retCode = pendingPaymentLift($.session.get('liftId'));
        if(retCode)
        {   

            var res     =  getLiftById($.session.get('liftId'));
            var lift    =  res.lift;                    
            var riderEmailBody = getAcceptedRiderMailBody(name, lift);             
            var hasMailSent    = sendEmail(lift.email,'Accept a Ride Request',
                                           riderEmailBody);              

            if (hasMailSent)
            {
                hasSentMsg = true;  
                if (lift.textYes)
                {
                    var msg = "Your ride request was accepted by the driver. " + 
                              "Please login into airpnd to process the payment " + 
                              "for the ride. " + SITE_URL;                     
                    
                    var textMsgSent = sendRiderMsg(lift, msg);
                }                
                if (hasSentMsg)
                {
                    $('.confirmRiderLoader').addClass('hide');                                      
                    showAlertBox('Alert',
                    'Lift status is set to pending payment and an email ' + 
                    'was sent to the rider.',
                    SITE_URL+'findRider.php');
                    moveTotop(); 
                }
            }                                           
        }
    });  
    $(document).on('click','.rejectRiderBtn', function(e){ 
        $('.confirmRiderLoader').removeClass('hide');  
        $(this).prop('disabled',true);

        var liftId  =  $.session.get('liftId');                     
        var retCode = rejectALift(liftId);

        if (retCode)
        {
            var res     =  getLiftById(liftId);
            var lift    =  res.lift;                    
            var riderEmailBody = getRiderMailBody(name, lift);             
            var hasMailSent    = sendEmail(lift.email,'Reject a Ride Request',
                                           riderEmailBody);              
            
            if (hasMailSent)
            {
                hasSentMsg = true;  
                if (lift.textYes)
                {
                    var msg = "Your ride request was rejected by the driver. " + 
                              "Please login into airpnd to find another ride." + 
                              SITE_URL;                     
                    
                    var textMsgSent = sendRiderMsg(lift, msg);
                }                
                if (hasSentMsg)
                {
                    $('.confirmRiderLoader').addClass('hide');                                      
                    showAlertBox('Alert',
                    'Ride Request was rejected and an email was sent out to the rider.',
                    SITE_URL+'findRider.php');
                     moveTotop(); 
                }
            }                                           
        }           
    });  
    var userDetails = sessionManager('getSession','user');
    if(userDetails)
    {
        var link = typeof(getUrlVars()['link']) == 'undefined' ||
        getUrlVars()['link'] == null ? false : true;
        if(link)
        {
            var link        = decodeURIComponent(getUrlVars()['link']);
            var iv          = decodeURIComponent(getUrlVars()['iv']);       
            var decodedData = getDecodeLink(link,iv);

            $.session.set('liftId',decodedData.data1);
            $.session.set('rideId',decodedData.data2);
            $.session.set('seats',decodedData.data3);
             
             // get lift by if 
            var result = getLiftById( $.session.get('liftId'));
            if(result.lift.status != 1)
            {
                $('#confirmRiderContainer').addClass('hide');
                $('.confirmRiderLoader').addClass('hide');                                      
                showAlertBox('Expired',
                'Link has been expired',
                SITE_URL+'findRider.php');
                moveTotop(); 
            }
            if(result.retCode)
            {  
                result = result.lift; 
                
                // get the rider firstName and lastName, rider email
                var rider = getCustomerByCustomerId(result.customerId,true);
                if($('response id',rider).text() != -1)
                {  
                    var htmlBody ='<table class="table table-hover table-bordered">';
                    htmlBody+='<tr><td colspan="99">';
                    htmlBody+='<h6>The rider information is';
                    htmlBody+=' as follow:</h6></td></tr>' ; 
                    var note = result.note || '-';
                    var seats = decodedData.data3 || '-';
                    var smoker = result.smoker == 1 ? 'Y' : 'N';
                    var date = $.getDateTime.formatDate(result.dt);
                    var time = $.getDateTime.formatTime(result.dt);
//                    var dateTime = $.getDateTime.formatDateTime(result.dt);
                    var name = $('response firstName',rider).text()+
                                ' '+$('response lastName',rider).text();
                    var price = result.contribution != null ? 
                                '$' + result.contribution : '-'; 
/*
                    htmlBody+='<tr> <td> Rider Name</td><td>'+
                                name+'</td></tr>' ;
                    htmlBody+='<tr> <td> Rider Phone</td><td>'+
                                $('response phone1',rider).text()+
                                '</td></tr>';   
                    htmlBody+='<tr> <td> Rider Email</td><td>'+
                                $('response email',rider).text()+
                                '</td></tr>';
*/
                    
                    var start = result.start;
                    var to    = result.to;
                    if (result.startType == AIRPORT_START)
                    {
                        to = hideAddress(to);
                    }
                    else
                    {
                        start       = hideAddress(start);
                    }
                
                    htmlBody+='<tr><td>Pick Up</td><td>'+
                               start+'</td></tr>';             
                    htmlBody+='<tr><td>Drop Off</td><td>'+
                               to+'</td></tr>';   
                    htmlBody+='<tr><td>Date</td><td>'+date+
                              '</td></tr>';                       
                    htmlBody+='<tr><td>Time</td><td>'+time+
                              '</td></tr>'; 
                    htmlBody+='<tr><td>Seats</td><td>'+seats+
                              '</td></tr>';
                    htmlBody+='<tr><td>Contribution</td><td> '+
                                price+'</td></tr>'; 
                    htmlBody+='<tr><td>Smoker</td><td>'+smoker+
                              '</td></tr>'; 
                    htmlBody+='<tr><td>Note</td><td  colspan="2"';
                    htmlBody+=' class="textBreak"> '+note+'</td></tr>'; 
                    htmlBody+='<tr><td colspan="2"> ';
                    htmlBody+='<button type="submit" name="confirm"';
                    htmlBody+=' class="btn btn-success';
                    htmlBody+=' confirmRiderbtn span4">';
                    htmlBody+='Confirm Rider</button>';
                    htmlBody+='<button type="submit" name="reject"';
                    htmlBody+=' class="btn btn-success';
                    htmlBody+=' rejectRiderBtn span4">';
                    htmlBody+='Reject Rider</button>';
                    htmlBody+='<div class="confirmRiderLoader';
                    htmlBody+=' hide span2">';
                    htmlBody+='<img src="resource/';
                    htmlBody+='images/searchLoader.GIF" alt=".."/>';
                    htmlBody+='</div></td></tr>';
                    htmlBody+='</table>';
                
                    $('#confirmRider').append(htmlBody); 
                }
            }  
            else
            {
                showAlertBox('Error',
                    'link is not valid',
                    SITE_URL+'findRider.php');
            }
        }
    }
    else
    {
        loadSignInModal();
    }   
});


//function get rider mail body
function getRiderMailBody
(
    name,
    lift
)
{
    var smoker = lift.smoker == true? 'yes': 'No';
    var date = $.getDateTime.formatDate(lift.dt);
    var time = $.getDateTime.formatTime(lift.dt);
    
    var emailBody = '<div><p><strong>Dear '+ 
                    name +'</strong>,</p><br />';
    emailBody +='<p>You request for the ride has been rejected by the driver.</p>';
    emailBody +='<p>Please find another driver.</p>';
    emailBody +='<p><strong>Ride Request Detail</strong></p>';
    emailBody +='<table border="1px">';
    emailBody +='<tr><td>Date</td><td>'+
                date+'</td></tr>';
    emailBody +='<tr><td>Time</td><td>'+
                time+'</td></tr>';
    emailBody +='<tr><td>Pick Up</td><td>'+
                lift.start+'</td></tr>';
    emailBody +='<tr><td>Drop Off</td><td>'+
                lift.to+'</td></tr>';
    emailBody +='<tr><td> Seats </td><td>'+
                lift.seats+'</td></tr>';
    emailBody +='<tr><td> Smoker </td><td>'+
                smoker+'</td></tr>';
    emailBody +='<tr><td> Bags </td><td>'+
                lift.bags+'</td></tr>';
    emailBody +='<tr><td> Bag Size </td><td>'+
                lift.bagSize+'</td></tr>';
    emailBody +='</table>';
    /*                        
    emailBody +='<tr><td> Rider Email </td><td>'+
                rider.email+'</td></tr></table>';  
    */
    emailBody +='<br /><p>Regards:-</p>';
    emailBody +='<p>Airpnd Team.</p>';
    emailBody +='<p><sub><i>This is a system generated';
    emailBody +='&nbsp;mail. Please do not reply to it.';
    emailBody +='</i><sub></p></div>';
    return emailBody;
}


//function get rider mail body
function getAcceptedRiderMailBody
(
    name,
    lift
)
{
    var date = $.getDateTime.formatDate(lift.dt);
    var time = $.getDateTime.formatTime(lift.dt);
    var smoker = lift.smoker == true? 'yes': 'No';
    var emailBody = '<div><p><strong>Dear '+ 
                    name +'</strong>,</p><br />';
    emailBody +='<p>You request for the ride has been accepted by the driver.</p>';
    emailBody +='<p>Please login into your account and pay for the ride.</p>';
    emailBody +='<p><strong>Ride Request Detail</strong></p>';
    emailBody +='<table border="1px">';
    emailBody +='<tr><td>Date</td><td>'+
                date+'</td></tr>';
    emailBody +='<tr><td>Time</td><td>'+
                time+'</td></tr>';
    emailBody +='<tr><td>Pick Up</td><td>'+
                lift.start+'</td></tr>';
    emailBody +='<tr><td>Drop Off</td><td>'+
                lift.to+'</td></tr>';
    emailBody +='<tr><td> Seats </td><td>'+
                lift.seats+'</td></tr>';
    emailBody +='<tr><td> Smoker </td><td>'+
                smoker+'</td></tr>';
    emailBody +='<tr><td> Bags </td><td>'+
                lift.bags+'</td></tr>';
    emailBody +='<tr><td> Bag Size </td><td>'+
                lift.bagSize+'</td></tr>';
    emailBody +='</table>';
    /*                        
    emailBody +='<tr><td> Rider Email </td><td>'+
                rider.email+'</td></tr></table>';  
    */
    emailBody +='<br /><p>Regards:-</p>';
    emailBody +='<p>Airpnd Team.</p>';
    emailBody +='<p><sub><i>This is a system generated';
    emailBody +='&nbsp;mail. Please do not reply to it.';
    emailBody +='</i><sub></p></div>';
    return emailBody;
}

// send text message to the rider
function sendRiderMsg
(
    lift,
    msg
)
{
    var phoneNumber =  lift.phone;   
//    var name        =  $('response returnVal firstName',owner).text()
//                       +' '+  $('response returnVal lastName'
//                                                        ,owner).text();                       
    phoneNumber     =  phoneNumber.split('-').join('');
  
//    var msg         =  $('#messageContent').val() +'\n'+' '+ SITE_URL+
//                        'confirmRider.php' + link;
    var hasSent     =  sendTextMessage(phoneNumber, msg);
    return hasSent;        
}


/* End of file commentConfirmRider.js */
/* Location: ./js/commentConfirmRider.js */  
