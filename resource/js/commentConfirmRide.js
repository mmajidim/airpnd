/**
 * @file       commentConfirmRide.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for confirm ride.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added confirm ride page functionality and
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    fixed issue and done with minor formatting
 * @revDate    06/02/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    updated functionality for SMS.
 * @revDate    06/20/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting.
 */ 
$(function(){
    $('.closeIcon').hide();
    $(document).on('click','#confirmRidebtn', function (e) { 
        $('.confirmRideLoader').removeClass('hide');  
        $(this).prop('disabled',true);             
        var retCode = pendingPaymentLift($.session.get('liftId'));
        if(retCode)
        {      
            var res  =  getARide(rideId);
            var ride =  res.ride;                    
            var driverEmailBody = getAcceptedDriverMailBody(name, ride);             
            var hasMailSent     = sendEmail(ride.email,'Accept a Ride Offer',
                                            driverEmailBody);              
             
            if(hasMailSent)
            {               
                hasSentMsg = true;  
                if (ride.textYes)
                {
                    var msg =  "Your offer was accepted by the rider. " + 
                               "Please login into airpnd to see the status " + 
                               "of the ride. " + SITE_URL;                                     
                    var hasSentMsg = sendDriverMsg(ride, msg);
                }  
                if (hasSentMsg)
                {
                    $('.confirmRideLoader').addClass('hide');              
                    showAlertBox('Alert',
                                 'The ride is confirmed now. ' + 
                                 'Please login into airpnd and use the ' + 
                                 'manage lift to pay for the ride.',
                                 SITE_URL+'findRide.php');
                                 moveTotop(); 
                }
            }
        }                        
    }); 
    
    $(document).on('click','#rejectRideBtn', function(e){ 
        $('.confirmRiderLoader').removeClass('hide');  
        $(this).prop('disabled',true);
        
        liftId = $.session.get('liftId');
        rideId = $.session.get('rideId');
        
        // liftId is needed to find the ride for it, otherwise
        // a ride may have multiple lifts
        var retCode = rejectARide(liftId);        
        if (retCode)
        {
            var res  =  getARide(rideId);
            var ride =  res.ride;                    
            var driverEmailBody = getDriverMailBody(name, ride);             
            var hasMailSent     = sendEmail(ride.email,'Reject a Ride Offer',
                                            driverEmailBody);              
            
            if(hasMailSent)
            {               
                hasSentMsg = true;  
                if (ride.textYes)
                {
                    var msg =  "Your offer was rejected by the rider. " + 
                               "Please login into airpnd to find another rider. " + 
                               SITE_URL;                                     
                    var hasSentMsg = sendDriverMsg(ride, msg);
                }
                if (hasSentMsg)
                {
                    $('.confirmRideLoader').addClass('hide');              
                    showAlertBox('Alert',
                    'Ride offer was rejected and an email was sent out to ' + 
                    'the driver. ',
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
            var decodedData =  getDecodeLink(link,iv);

            $.session.set('liftId',decodedData.data1);
            $.session.set('rideId',decodedData.data2);
            $.session.set('seats',decodedData.data3);
             
            var resRide = getARide( $.session.get('rideId')); 
            if (resRide.ride.status !=0 &&
                resRide.ride.status != 1)
            {
                showAlertBox('Expired',
                'Link has been expired',
                SITE_URL+'findRider.php');
                moveTotop();                    
            } 
           
            var htmlBody='';
            if(resRide.retCode)
            {  
                resRide = resRide.ride;
                
                // get the driver firstName and lastName, driver email
                var driver = getOwnerByOwnerId(resRide.ownerId,true);
                if($('response id',driver).text() != -1)
                { 
                    var smoker = resRide.smoker == 1 ? 'Yes' : 'No';
                    var date = $.getDateTime.formatDate(resRide.dt);
                    var time = $.getDateTime.formatTime(resRide.dt);
//                    var dateTime = $.getDateTime.formatDateTime(resRide.dt);

                    var name = $('response firstName',driver).text()
                                +' '+$('response lastName',driver).text();     

                    var start = resRide.start;
                    var to    = resRide.to;
                    if (resRide.startType == AIRPORT_START)
                    {
                        to = hideAddress(to);
                    }
                    else
                    {
                        start  = hideAddress(start);
                    }

                    htmlBody+='<table class="table table-hover '; 
                    htmlBody+='table-bordered"> <tr> <td colspan="99">';
                    htmlBody+=' <h6>The driver information is as follow:' ;
/*
                    htmlBody+='</h6></td></tr><tr> <td> Driver Name' ;
                    htmlBody+='</td><td>'+name+'</td></tr>' ;
                    htmlBody+='<tr> <td> Driver Phone</td><td>'+
                                $('response phone1',driver).text()+
                                '</td></tr>';
                    htmlBody+='<tr> <td> Driver Email</td><td>'+
                                $('response email',driver).text()+
                                '</td></tr>';
*/

                    htmlBody+='<tr><td>Pick Up</td><td>'+
                               start+'</td></tr>';             
                    htmlBody+='<tr><td>Drop Off</td><td>'+
                              to+'</td></tr>';   
                    htmlBody+='<tr><td>Date</td><td>'+
                              date +'</td></tr>';                       
                    htmlBody+='<tr><td>Time</td><td>'+
                              time+'</td></tr>'; 
                    htmlBody+='<tr><td>Seats</td><td>'+
                              decodedData.data3+'</td></tr>';
                    htmlBody+='<tr><td>Contribution</td><td> $' +
                               resRide.contribution+'</td></tr>'; 
                    htmlBody+='<tr> <td> Smoker </td><td>'+
                               smoker+'</td></tr>'; 
                    htmlBody+='<tr> <td> Note </td>'; 
/*
                    htmlBody+='<td  colspan="2" class="textBreak"> '+
                                resRide.note+'</td></tr>'
*/
                    htmlBody+='<tr> <td colspan="2">';
                    htmlBody+=' <button type="submit" ';
                    htmlBody+='name="confirm" class="btn btn-success';
                    htmlBody+=' span4" id="confirmRidebtn" >';
                    htmlBody+='Confirm Ride</button> ';
                    htmlBody+=' <button type="submit" ';
                    htmlBody+='name="reject" class="btn btn-success';
                    htmlBody+=' span4" id="rejectRideBtn" >';
                    htmlBody+='Reject Ride</button> ';
                    htmlBody+='<div class="confirmRideLoader hide';
                    htmlBody+=' span2">';
                    htmlBody+='<img src="resource/images/searchLoader.GIF"';
                    htmlBody+=' alt=".."/></div></td></tr>'; 
             }     
          }     
               $('#confirmRide').append(htmlBody);   
         }  
        else
        {
             showAlertBox('Error',
                            'link is not valid',
                            SITE_URL+'findRide.php');
        }  
    }
    else
    {
        loadSignInModal();
    } 
});


//function get driver mail body
function getDriverMailBody
(
    name,
    ride
)
{
    var smoker = ride.smoker == true ? 'yes' : 'No';
    var date = $.getDateTime.formatDate(ride.dt);
    var time = $.getDateTime.formatTime(ride.dt);

    var emailBody = '<div><p><strong>Dear '+ 
                    name +'</strong>,</p><br />';
    emailBody +='<p>You offer for the drive has been rejected by the rider.</p>';
    emailBody +='<p>Please find another rider for your ride.</p>';
    emailBody +='<p><strong>Drive Offer Detail</strong></p>';
    emailBody +='<table border="1px">';
    emailBody +='<tr><td>Date</td><td>'+
                date+'</td></tr>';
    emailBody +='<tr><td>Time</td><td>'+
                time+'</td></tr>';
    emailBody +='<tr><td> From </td><td>'+
                ride.start+'</td></tr>';
    emailBody +='<tr><td> To </td><td>'+
                ride.to+'</td></tr>';
    emailBody +='<tr><td> Seats </td><td>'+
                ride.seats+'</td></tr>';
    emailBody +='<tr><td> Smoker </td><td>'+
                smoker+'</td></tr>';
    emailBody +='<tr><td>Bags</td><td>'+
                ride.bags+'</td></tr>';
    emailBody +='<tr><td>Bag Size</td><td>'+
                ride.bagSize+'</td></tr>';
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


//function get driver mail body
function getAcceptedDriverMailBody
(
    name,
    ride
)
{
    var date = $.getDateTime.formatDate(ride.dt);
    var time = $.getDateTime.formatTime(ride.dt);
    var smoker = ride.smoker == true ? 'yes' : 'No';
    var emailBody = '<div><p><strong>Dear '+ 
                    name +'</strong>,</p><br />';
    emailBody +='<p>You offer for the drive has been accepted by the rider.</p>';
    emailBody +='<p>The rider was inform to pay for the ride.</p>';
    emailBody +='<p><strong>Ride Offer Detail</strong></p>';
    emailBody +='<table border="1px">';
    emailBody +='<tr><td>Date</td><td>'+
                date+'</td></tr>';
    emailBody +='<tr><td>Time</td><td>'+
                time+'</td></tr>';
    emailBody +='<tr><td> From </td><td>'+
                ride.start+'</td></tr>';
    emailBody +='<tr><td> To </td><td>'+
                ride.to+'</td></tr>';
    emailBody +='<tr><td> Seats </td><td>'+
                ride.seats+'</td></tr>';
    emailBody +='<tr><td> Smoker </td><td>'+
                smoker+'</td></tr>';
    emailBody +='<tr><td> Bags </td><td>'+
                ride.bags+'</td></tr>';
    emailBody +='<tr><td> Bag Size </td><td>'+
                ride.bagSize+'</td></tr>';
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


// send text message to the driver
function sendDriverMsg
(
    ride,
    msg
)
{
    var ownerId = ride.ownerId;
    
     // get the driver name and  contact number,  email    
    var owner = getOwnerByOwnerId(ownerId, true);

    var phoneNumber =  $('response returnVal phone1',owner).text();   
    var name        =  $('response returnVal firstName',owner).text()
                       +' '+  $('response returnVal lastName'
                                                        ,owner).text();                       
    phoneNumber     =  phoneNumber.split('-').join('');
  
//    msg             =  "Your offer was accepted by the rider. Please login " +
//                       "into airppnd to see the status of the ride. " + 
//                       SITE_URL;                     
//    var msg         =  $('#messageContent').val() +'\n'+' '+ SITE_URL+
//                        'confirmRider.php' + link;
    var hasSent     =  sendTextMessage(phoneNumber, msg);
    return hasSent;        
}

 
/* End of file commentConfirmRide.js */
/* Location: ./js/commentConfirmRide.js */  
