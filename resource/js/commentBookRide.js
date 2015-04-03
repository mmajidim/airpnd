/**
 * @file       commentBookRide.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for book ride.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added book ride page functionality and
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added book ride page functionality and
 *             done with minor formatting
 * @revDate    07/1/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting 
 */ 
$(function(){

    // get the ride title
    headerLabel = $( "#title" ).html();
    liftSeats = $.session.get('seatsFindRide');
    headerLabel += '- Requested Seats : ' + liftSeats;        
    $( "#title" ).html(headerLabel);
    
    //get rides
    getRides();
     // sort order
    $('#filterOrder').on('change',function(){
        loadMatchedRides($('#filterPrice option:selected').val(),
            $('option:selected',this).val());
    });
    //sort type
    $('#filterPrice').on('change',function(){
        loadMatchedRides($('option:selected',this).val(),
            $('#filterOrder option:selected').val());
    }); 

    //store lift id on lift selection,
    // mmajidi 08/24/2014 
    // this function should not get called because of the autoLift    
    $(document).on('click','.selectRider',function(e){
        $.session.set('liftId', $(this).attr('liftId'));
        $('#modalFade').addClass('hide');
        $('#panelMyRide').addClass('hide');
        $.session.set('hasLift',true)
        e.preventDefault();
    });
      //close model popup
    $(document).on('click','.close',function(){
        $('#modalFade').addClass('hide');
        $('#panelMyRide').addClass('hide');
    });
      
      // select ride   
    $(document).on('click','.select', function (e)
    {
        $.session.set('rideId',$(this).attr('rideId'));
        $.session.set('seats',$(this).attr('seats'));
        $.session.set('ownerId',$(this).attr('ownerId'));
        $.session.set('contribution',$(this).attr('contribution'));
        var customerId = sessionManager('getSession','customerId');
        if(customerId)
        {
            /*
                * if user has not selected any ride from right
                * screen on search drivers page
            */ 
            if(!$.session.get('hasLift'))
            {
                // @mmajidi - 08/24/2014 load customer lifts if no lift 
                // has selected however because of the autoLift this call 
                // is commented out
//                    loadCustomerLifts();
                liftId = -1;
                startType = $.session.get('startType') ; 
                if (startType == AIRPORT_START)
                {
                    startAddress = $.session.get('locationFindRide');
                    toAddress    = $.session.get('addressFindRide');
                }                                            
                else
                {
                    toAddress    = $.session.get('locationFindRide');
                    startAddress = $.session.get('addressFindRide');
                }

                contribution  = $.session.get('contribution');   
                date          = $.session.get('dateFindRide');   
                time          = $.session.get('timeFindRide');
                seats         = $.session.get('seatsFindRide');  
                smoker        = $.session.get('smokerFindRide');
                bags          = $.session.get('bagsFindRide');
                bagSize       = $.session.get('bagSizeFindRide');                        
                        
                // create a lift if there is no lift        
                liftId = autoLift(liftId, customerId, contribution, date, 
                                  time, startAddress, toAddress, 
                                  startType, seats, smoker, bags, 
                                  bagSize);        
/*                if (liftId != -1)
                {
                    $.session.set('hasLift',true)
                    $.session.set('liftId', liftId);
                    $(this).popover('show');
                    $('.select').not(this).popover('hide');
                }   
*/
                $.session.set('hasLift',true)
                $.session.set('liftId', liftId);

                var rideId       = $.session.get('rideId');
                var res          = getARide(rideId);
                var ride         = res.ride;

                // processRequest 
                processRequest(ride);
            }
            // create a lift if no lift is selected but at least one exists.
            else
            {
                 liftId = $.session.get('liftId');
                 startType = $.session.get('startType') ; 
                 if (startType = 0)
                 {
                     startAddress = $.session.get('locationFindRide');
                     toAddress    = $.session.get('addressFindRide');
                 }                                            
                 else
                 {
                     toAddress    = $.session.get('locationFindRide');
                     startAddress = $.session.get('addressFindRide');
                 }
/*
                 contribution  = $.session.get('contribution');   
                 date          = $.session.get('dateFindRide');   
                 time          = $.session.get('timeFindRide');
                 seats         = $.session.get('seatsFindRide');  
                 smoker        = $.session.get('smokerFindRide');
                 bags          = $.session.get('bagsFindRide');
                 bagSize       = $.session.get('bagSizeFindRide');                        
                        
                 liftId = autoLift(liftId, customerId, contribution,
                                   date, time, startAddress, toAddress, 
                                   startType, seats, smoker, bags, 
                                   bagSize);        
                $.session.set('liftId', liftId);
*/
                var rideId       = $.session.get('rideId');
                var res          = getARide(rideId);
                var ride         = res.ride;

                // processRequest 
                processRequest(ride);

/*
                if (ride.textYes)
                {
                    $(this).popover('show');
                    $('.select').not(this).popover('hide');
                } 
                else
                {
                    processRequest(ride);
                }
*/                  
            }
        }
        else
        {
            loadSignInModal();
        }
        return false;
    });

    // remove error pop up
    $(document).on('click','.closePopUp', function (e) {
        $(this).closest('.popover').removeClass('in');
        return false;
    });
    
    //send sms to driver
    $(document).on('click','#sendSMS', function (e)
    {
        $("#sendSmsLoader").removeClass('hide');
        $('#sendSMS').attr('disabled','disabled');
        var rideId       = $.session.get('rideId');
        var res          = getARide(rideId);
        var ride         = res.ride;

        processRequest(ride);
    });    
});

function processRequest(ride)
{
    window.setTimeout(function() 
    {
        var rideId = ride.id;
        var liftId = $.session.get('liftId');    
         // get the driver ame and  contact number,  email    
        var owner = getOwnerByOwnerId($.session.get('ownerId'),true);
        
        var phoneNumber =  $('response returnVal phone1',owner).text();   
        var emailId     =  $('response returnVal email',owner).text();  
        var name        =  $('response returnVal firstName',owner).text()
                           +' '+  $('response returnVal lastName'
                                                            ,owner).text();                       
        phoneNumber     =  phoneNumber.split('-').join('');
                    
        var data        =  $.session.get('liftId')+';'+
                           $.session.get('rideId')+';'+   
                           $.session.get('seats');   
        var res         =  getLiftById(liftId);
        var lift        =  res.lift;                    
                                 
        var link        =  getLink(data);          
        var hasSent     =  true;
//    if (lift.textYes)
//    {
//        var msg     =  $('#messageContent').val() +'\n'+' '+ SITE_URL+
                         'confirmRider.php' + link;
//        hasSent     =  sendTextMessage(phoneNumber, msg);        
//    }
            
        var emailBody   =  getDriverEmailBody(name, lift, link);        
        var riderId     =  sessionManager('getSession','customerId');
        
        // get the rider firstName and lastName, rider email
        var riderDetails = getCustomerByCustomerId(riderId,true);
            
        var riderName    = $('response firstName',riderDetails).text()+' '+
                           $('response lastName',riderDetails).text();
                           
        var driver       = {'name':name,'email':emailId}; 
    
//    var rideId       = $.session.get('rideId');
//    var res          = getARide(rideId);
//    var ride         = res.ride;
     
//        var riderEmailBody = getRiderEmailBody(riderName, lift, ride);
        var riderEmailBody = getRiderEmailBody(riderName, lift);
         
        var subject     = 'Airpnd - Ride request received - ' + 
                          'Pending confirmation'; 
        var hasMailSent = sendEmail(emailId,
                                    subject,emailBody);
                                             
        hasMailSent = sendEmail($('response email',
                                riderDetails).text(),
                                'Airpnd - Acknowledge for Requesting a Ride',
                                riderEmailBody);      
        if(hasSent || hasMailSent)
        {
            hasSent = bookARide(rideId,
                                $.session.get('liftId'),
                                $.session.get('seats'));
            if(hasSent)
            {
                hasSent = pendingConfirmLift($.session.get('liftId')); 
                if(hasSent)
                {
                    var mesg = 'Your ride request has been sent to the ' + 
                               'driver. We will notify you when ' + 
                               'driver accepts your request. '; 
                    $.session.clear('hasLift');
                    $.session.clear('liftId');
                    showAlertBox('Request Alert',mesg,
                                    SITE_URL+'findRide.php');
                }
            }      
            else
            {
                showAlertBox('Error',ERROR_MSG);
            } 
        }  
        return false;
    },100) ; 
};       


//function get rides.
function getRides
(
)
{         
    if($.session.get('dateFindRide'))
    {
        $('#bookRideContainer').removeClass('hide');
        $('#errorContainer').addClass('hide');
        var dataToSend =
        {
            'action'   : GET_RIDES,
            'location' : JSON.stringify($.session.get('locationFindRide')),
            'startType': JSON.stringify($.session.get('startType')),
            'address'  : JSON.stringify($.session.get('addressFindRide')),
            'date'     : JSON.stringify($.session.get('dateFindRide')),
            'time'     : JSON.stringify($.getDateTime.time(
                                        $.session.get('timeFindRide'),true)),
            'seats'    : JSON.stringify($.session.get('seatsFindRide')),
            'bags'     : JSON.stringify($.session.get('bagsFindRide')),
            'bagSize'  : JSON.stringify($.session.get('bagSizeFindRide')),
            'smoker'   : JSON.stringify($.session.get('smokerFindRide'))
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
                $.session.set('ridesData',JSON.stringify(jsonResult));
                loadRidesContainer();
            }
        });
    }
    else
    {
        var htmlBody='<table class="table table-bordered"><tr>';
        htmlBody+='<th>First Name</th><th>Last Name</th><th>Pick Up</th>';
        htmlBody+='<th>Drop Off</th><th>Via</th><th>Smoker</th>';
        htmlBody+='<th>Within</th><th>Contribution</th></tr>';
        htmlBody+='<tr><td colspan="99"><center><b>No Records Found !';
        htmlBody+='</b></center></td></tr></table>';
        $('#riderResult').append(htmlBody);
    }
}

//function load rides container
function loadRidesContainer
(
)
{     
    loadMatchedRides('contribution',1);
}

// autoLift - create lift automatically
function autoLift
(
    liftId,
    customerId,
    contribution,
    date,
    time,
    startAddress,
    toAddress,
    startType,
    seats,
    smoker,
    bags,
    bagSize
)
{                      
//    var customerId = sessionManager('getSession','customerId');
    if(customerId)
    {
        var liftData = 
        {
            'id'           : liftId,
            'customerId'   : customerId,
            'contribution' : contribution,
            'date'         : date,
            'time'         : time,
            'start'        : startAddress,
            'to'           : toAddress,
            'startType'    : startType,
            'via'          : '',
            'maxMiles'     : '',
            'seats'        : seats,
            'smoker'       : smoker,
            'bags'         : bags,
            'bagSize'      : bagSize,
            'note'         : ''
        }  
        var dataToSend =
        {
            'action'   : POST_AUTO_LIFT,
            'lift'     : JSON.stringify(liftData)            
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
                if(jsonResult.retCode)
                {    
                    liftId = jsonResult.liftId;
                }
            }
        });
    }
    return (liftId);
}

//function book a ride
function bookARide
(
    rideId,
    liftId,
    seats
)
{
    var res = -1;
    var dataToSend =
    {
        'action' : BOOK_A_RIDE,
        'rideId' : JSON.stringify(rideId),
        'liftId' : JSON.stringify(liftId),
        'seats'  : JSON.stringify(seats)
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

//function get driver email body
function getDriverEmailBody
(
    name,
    lift,
    activationLink
)
{    
    var start = lift.start;
    var to    = lift.to;
    if (lift.startType == AIRPORT_START)
    {
        to = hideAddress(to);
    }
    else
    {
        start = hideAddress(start);
    }
    
    var date = $.getDateTime.formatDate(lift.dt);
    var time = $.getDateTime.formatTime(lift.dt);
   
    var smoker = lift.smoker == true? 'yes': 'No';    
    var emailBody;
    var link = '<a class="btnEmail" href="{0}confirmRider.php{1}">';
        link+= 'Click Here </a>';
    var activationBody = String.format(link,SITE_URL,activationLink);
        
    var emailBody  = '<div><p><strong>Dear '+ name +'</strong>,</p><br />';

    var bags = lift.bags ? lift.bags : "";
    emailBody += '<p>You have a booking request from a rider.</p> ';
    emailBody += '<p>Please click on the link to confirm the rider request.';
    emailBody += '</p><p>'+activationBody+'<br><br></p>';   
    emailBody += '<p><strong>Ride Request Detail</strong></p>';
    emailBody += '<table border="1px">';
    emailBody += '<tr><td>Date</td><td>'+
                 date+'</td></tr>';
    emailBody += '<tr><td>time</td><td>'+
                 time+'</td></tr>';
    emailBody += '<tr><td>Pick Up</td><td>'+
                 start+'</td></tr>';
    emailBody += '<tr><td>Drop Off</td><td>'+
                 to+'</td></tr>';
    emailBody += '<tr><td>Seats</td><td>'+
                 lift.seats+'</td></tr>';
    emailBody += '<tr><td>Smoker</td><td>'+
                 smoker+'</td></tr>';
    emailBody += '<tr><td>Bags</td><td>'+
                 bags+'</td></tr>';
    emailBody += '<tr><td>Bag Size</td><td>'+
                 lift.bagSize+'</td></tr>';
    emailBody += '</table>';
    emailBody += '<br /><p>Regards:-</p>';
    emailBody += '<p>Airpnd Team.</p>';
    emailBody += '<p><sub><i>This is a system generated';
    emailBody += '&nbsp;mail. Please do not reply to it.';
    emailBody += '</i><sub></p></div>';

    return emailBody;  
} 

//function get rider email body
function getRiderEmailBody
(
    name,
    lift
//    ride
)
{ 
    var date = $.getDateTime.formatDate(lift.dt);
    var time = $.getDateTime.formatTime(lift.dt);

    var emailBody  = '<div><p><strong>Dear '+ name +'</strong>,</p><br />';
    var smoker = lift.smoker == true? 'yes': 'No';
    var bags = lift.bags ? lift.bags : "";

    emailBody +='<p>Your request has been sent to the driver.</p>';
    emailBody +='<p><strong>Ride Detail</strong></p>';
    emailBody +='<table border="1px">';
    emailBody +='<tr><td>Date</td><td>'+
                date+'</td></tr>';
    emailBody +='<tr><td>Time</td><td>'+
                time+'</td></tr>';
    emailBody +='<tr><td>Pick Up</td><td>'+
                lift.start+'</td></tr>';
    emailBody +='<tr><td>Drop Off</td><td>'+
                lift.to+'</td></tr>';
    emailBody +='<tr><td>Seats</td><td>'+
                lift.seats+'</td></tr>';
    emailBody +='<tr><td>Smoker</td><td>'+
                smoker+'</td></tr>';
    emailBody +='<tr><td>Bags</td><td>'+
                bags+'</td></tr>';
    emailBody +='<tr><td>Bag Size</td><td>'+
                lift.bagSize+'</td></tr>';
    emailBody +='</table>';
    emailBody +='<br /><p>Regards:-</p>';
    emailBody +='<p>Airpnd Team.</p>';
    emailBody +='<p><sub><i>This is a system generated';
    emailBody +='&nbsp;mail. Please do not reply to it.';
    emailBody +='</i><sub></p></div>'; 
    return emailBody;  
}  

//function load macthed rides
function loadMatchedRides
(
    filterType,
    sortOrder
)
{
    $('#riderResult').empty();
    $('#riderResult').fadeOut('slow');
    var htmlBody='';
    var result =  JSON.parse($.session.get('ridesData'));
    if(result && 
       result.retCode && result.rides.length > 0)
    {  
        result = sortByKey(result.rides,filterType,sortOrder);
        var from = result[0].startType == AIRPORT_START ? "Airport" : "Address"
        var to   = result[0].startType == ADDRESS_START ? "Airport" : "Address"
        htmlBody+='<table class="table table-bordered"><tr>';
        htmlBody+='<th>First Name</th><th>Last Name</th><th>'+from+'</th>';
        htmlBody+='<th>'+to+'</th><th>Via</th><th>Smoker</th>';
        htmlBody+='<th>Available Seats</th>';
        htmlBody+='<th>Date</th>';
        htmlBody+='<th>Within</th>';
        htmlBody+='<th>Contribution</th><th>&nbsp;</th></tr>';

        $.each(result,function(i,item)
        {
            var smoker = item.smoker ? 'Yes' : 'No';
            var via = item.via == null ? 'NA' : item.via;
            var dateTime = $.getDateTime.datePickerDateTime(item.datetime);
            var seats = $.session.get('seatsFindRide') >= item.seats ? 
                          item.seats : $.session.get('seatsFindRide') ;
            var contribution = item.contribution.toFixed(2);                              

            htmlBody+='<tr><td>'+item.firstName+'</td>';
            htmlBody+='<td>'+item.lastName.substring(0,1)+'...'+'</td>';
            htmlBody+='<td>'+item.start+'</td>';
            htmlBody+='<td>'+item.to+'</td>';
            htmlBody+='<td>'+via+'</td>';
            htmlBody+='<td>'+smoker+'</td>';
            htmlBody+='<td>'+item.seats+'</td>';
            htmlBody+='<td>'+dateTime+'</td>';
            htmlBody+='<td>'+item.maxMiles+' Miles</td>';
            htmlBody+='<td>$'+contribution  +'</td>';
            htmlBody+='<td><a href="#" ownerId="'+item.ownerId+'" rideId="';
            htmlBody+=item.rId + '" entityId ="'+item.entityId;
            htmlBody+='" class="select btn btn-default" seats="'
            htmlBody+=seats+'" contribution="' + contribution + '"> ';
            htmlBody+='Request </a></td></tr>';
        });
        htmlBody+='</table>';
    }
    else
    {
        $('#filterBy').hide();
        $('#sortBy').hide();
        htmlBody+='<table class="table table-bordered"><tr>';
        htmlBody+='<th>First Name</th><th>Last Name</th><th>Pick Up</th>';
        htmlBody+='<th>Drop Off</th><th>Via</th><th>Smoker</th>';
        htmlBody+='<th>Within</th><th>Contribution</th></tr>';
        htmlBody+='<tr><td colspan="99"><center>No Records Found !';
        htmlBody+='</center></td></tr></table>';
    }
    $('#riderResult').append(htmlBody);
    $('#riderResult').fadeIn('slow');
    setTimeout(function(){
        getPopUp('.select', '#popUpContainer','right');
        },100);
}


$(window).on('load',function(){
        $('#filterOrder').select2();
        $('#filterPrice').select2();
       loadMatchedRides($('#filterPrice option:selected').val(),
            $('option:selected','#filterOrder').val());
})

// function load lifts
function loadCustomerLifts
(
    
)
{  
   var isFirstLoad = $('#myFindRideContainer').children().length == 0;
    if(isFirstLoad)
    {
        var customerId = sessionManager('getSession','customerId'); 
        var result = liftsByCustomer(customerId);
        var htmlBody = '';
        var hasArrow = result.lifts == null || result.lifts.length == 1;
        if(result.retCode && result.lifts.length > 0)
        { 
            result = sortByKey(result.lifts,'dt','0'); 
            $.each(result,function(i,item)
            {
                var canSelect = item.status != 3;
                var dateTime = $.getDateTime.formatDateTime(item.dt);
                var date = $.getDateTime.formatDate(item.dt);

                htmlBody+='<div><h2 class="title greenLabel">'+
                            date+'</h2>';
                htmlBody+='<table class="table table-striped">';
                if(canSelect)
                {
                    htmlBody+='<tr><td width="105">';
                    htmlBody+='<a href="#" class="selectRider"';
                    htmlBody+=' liftId="'+item.id+'" date="'+item.dt+'"';
                    htmlBody+=' customerId="'+item.customerId+
                                '"><i class="icon-th"></i>';
                    htmlBody+=' Select Lift</a></td></tr>';
                }
                htmlBody+='<tr><td>Date</td><td class="date">'+
                            dateTime+'</td></tr>';
                htmlBody+='</td></tr>';
                htmlBody+='<tr><td>Pick Up</td><td class="start">'+
                            item.start+'</td></tr>';
                htmlBody+='<tr><td>Drop Off</td><td class="to">'+
                            item.to+'</td></tr>';
                htmlBody+='<tr><td>Seats</td><td class="seat">'+
                            (item.seats || '-')+'</td></tr>';
                htmlBody+='<tr><td>Status</td><td>'+
                            getLiftStatusName(item.status)+'</td></tr>';
                htmlBody+='<tr><td>Note</td>';
                htmlBody+='<td class="textBreak">'+
                            (item.note || '-');
                htmlBody+='</td></tr>';
                htmlBody+='</table></div>';
            });
        }
        else
        {
            htmlBody+='<div><h2 class="greenLabel">';
            htmlBody+='No lift is found.</h2></div>';
        }    
        $('#myFindRideContainer').append(htmlBody); 
    }
    $('#modalFade').removeClass('hide');
    $('#panelMyRide').removeClass('hide');
    if(isFirstLoad)
    {
        $('#myFindRideContainer').contentSlider('My Lifts',hasArrow,
        $.session.get('selectedTabBookRide'));
    }    
}

//function get lift status name
function getLiftStatusName
(
    status
)
{
    var statusName='';

    switch(status)
    {
        case '0':
            statusName = 'New Lift';
            break;
        case '1':
            statusName = 'Confirmation Pending';
            break;
        case '2':
            statusName = 'Pending Payment';
            break;
        case '3':
            statusName = 'Fulfilled';
            break;
    }

    return statusName;
}

$(window).bind('beforeunload',function(){
    if($('#myFindRideContainer-nav-select').is(':visible'))
    {
        var tabId = $('#myFindRideContainer-nav-select option:selected').val().
                    split('tab')[1];
        $.session.set('selectedTabBookRide',tabId);    
    }
    else
    {
        $('#myFindRideContainer-nav-ul li').each(function(i,item){
            if($('a',this).hasClass('current'))
            {
                var tabId = $('a',this).attr('href').split('#')[1];
                $.session.set('selectedTabBookRide',tabId);
            }
        });
    } 
});
/* End of file commentBookRide.js */
/* Location: ./js/commentBookRide.js */  