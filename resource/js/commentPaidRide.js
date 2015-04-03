/**
 * @file       commentPaidRide.js
 * @version    1.0.0
 * @author     Mehran Majidi
 * @desc       javascript for paid ride.
 * @date       06/29/2014
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    
 * @revAuthor  
 * @revDesc    
 *             
 */ 
$(function(){       
    var userDetails = sessionManager('getSession','user');
      
    if(userDetails)
    {
        var link = typeof(getUrlVars()['link']) == 'undefined' ||
                    getUrlVars()['link'] == null ? false : true;
        if(link)
        {
            var link = decodeURIComponent(getUrlVars()['link']);
            var iv = decodeURIComponent(getUrlVars()['iv']);       
            var decodedData =  getDecodeLink(link,iv);

            $.session.set('liftid',decodedData.data1);
            $.session.set('rideId',decodedData.data2);
            $.session.set('seats',decodedData.data3);
             
            var resRide = getARide( $.session.get('rideId')); 
            if (resRide.ride.status !=0 &&
                resRide.ride.status !=1 &&
                resRide.ride.status !=2)
            {
                showAlertBox('Expired',
                'Link has been expired',
                SITE_URL+'findRider.php');
                moveTotop();                    
            } 
           
            var htmlBody='';
            if (resRide.retCode)
            {  
                resRide = resRide.ride;
                var driver = getOwnerByOwnerId(resRide.ownerId,true);
                if ($('response id',driver).text() != -1)
                { 
                    var smoker = resRide.smoker == 1 ? 'Yes' : 'No';
                    var date = $.getDateTime.formatDate(resRide.dt);
                    var time = $.getDateTime.formatTime(resRide.dt);
                    var name = $('response firstName',driver).text()
                                +' '+$('response lastName',driver).text();     
                    htmlBody+='<table class="table table-hover '; 
                    htmlBody+='table-bordered"> <tr> <td colspan="99">';
                    htmlBody+=' <h6>The driver information is as follow:' ;
                    htmlBody+='</h6></td></tr><tr> <td> Driver Name' ;
                    htmlBody+='</td><td>'+name+'</td></tr>' ;
                    htmlBody+='<tr> <td> Driver Phone</td><td>'+
                                $('response phone1',driver).text()+
                                '</td></tr>';
                    htmlBody+='<tr> <td> Driver Email</td><td>'+
                                $('response email',driver).text()+
                                '</td></tr>';
                    htmlBody+='<tr> <td> Pick Up</td><td>'+
                                resRide.start+'</td></tr>';             
                    htmlBody+='<tr> <td> Drop Off</td><td>'+
                                resRide.to+'</td></tr>';   
                    htmlBody+='<tr> <td> Date</td><td>'+
                                date+'</td></tr>';                       
                    htmlBody+='<tr> <td> Time </td><td>'+
                                time+'</td></tr>'; 
                    htmlBody+='<tr> <td> Seats </td><td>'+
                                decodedData.data3+'</td></tr>';
                    htmlBody+='<tr> <td> Contribution </td><td> $' +
                                resRide.contribution+'</td></tr>'; 
                    htmlBody+='<tr> <td> Smoker </td><td>'+
                                smoker+'</td></tr>'; 
                    htmlBody+='<tr> <td> Note </td>'; 
                    htmlBody+='<td  colspan="2" class="textBreak"> '+
                                resRide.note+'</td></tr>';
                    htmlBody+='</table>';
                }     
            }     
            $('#paidRide').append(htmlBody);   
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
 
/* End of file commentPaidRide.js */
/* Location: ./js/commentPaidRide.js */  
