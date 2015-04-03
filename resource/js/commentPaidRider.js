/**
 * @file       commentPaidRider.js
 * @version    1.0.0
 * @author     Mehran Majidi
 * @desc       javascript for paid rider.
 * @date       06/30/2014
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 */ 
$(function(){
    $('.closeIcon').hide();
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
            var result = getLiftById( $.session.get('liftid'));
            if(result.lift.status != 2 &&
               result.lift.status != 3)
            {
                $('#paidRiderContainer').addClass('hide');
                $('.paidRiderLoader').addClass('hide');                                      
                showAlertBox('Expired',
                'Link has been expired',
                SITE_URL+'findRider.php');
                moveTotop(); 
            }
            if(result.retCode)
            {  
                result = result.lift;
                seats  = result.seats; 
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
                    var name = $('response firstName',rider).text()+
                                ' '+$('response lastName',rider).text();
                    var price = result.contribution != null ? 
                                '$' + result.contribution : '-'; 
                    htmlBody+='<tr> <td> Rider Name</td><td>'+
                                name+'</td></tr>' ;
                    htmlBody+='<tr> <td> Rider Phone</td><td>'+
                                $('response phone1',rider).text()+
                                '</td></tr>';   
                    htmlBody+='<tr> <td> Rider Email</td><td>'+
                                $('response email',rider).text()+
                                '</td></tr>';
                    htmlBody+='<tr> <td> Pick Up</td><td>'+
                                result.start+'</td></tr>';             
                    htmlBody+='<tr> <td> Drop Off</td><td>'+
                                result.to+'</td></tr>';   
                    htmlBody+='<tr> <td> Date</td><td>'+date+
                                '</td></tr>';                       
                    htmlBody+='<tr> <td> Time </td><td>'+time+
                                '</td></tr>'; 
                    htmlBody+='<tr> <td> Seats </td><td>'+seats+
                                '</td></tr>';
                    htmlBody+='<tr> <td> Contribution </td><td> '+
                                price+'</td></tr>'; 
                    htmlBody+='<tr> <td> Smoker </td><td>'+smoker+
                                '</td></tr>'; 
                    htmlBody+='<tr> <td> Note </td><td  colspan="2"';
                    htmlBody+=' class="textBreak"> '+note+'</td></tr>'; 
                    htmlBody+='</table>';
                
                    $('#paidRider').append(htmlBody); 
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
/* End of file commentPaidRider.js */
/* Location: ./js/commentPaidRider.js */  
