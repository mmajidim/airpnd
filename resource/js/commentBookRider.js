/**
 * @file       commentBookRider.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for book rider.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added book rider page functionality
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    07/1/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting 
 */ 
$(function(){ 
    // get lifts
    getLifts();
    initializeModal('panelMyLift');
      // sort order
    $('#filterOrder').on('change',function(){
        loadMatchedRiders($('#filterPrice option:selected').val(),
            $('option:selected',this).val());
    });
      //sort type
    $('#filterPrice').on('change',function(){
        loadMatchedRiders($('option:selected',this).val(),
            $('#filterOrder option:selected').val());
    });
      //close model pop up
    $(document).on('click','.close',function(){
       $('#modalFade').addClass('hide');
       $('#panelMyLift').addClass('hide');
    });

//    getPopUp('.select', '#popUpContainer','right');
    
    //store ride id on ride selection    
    $(document).on('click','.selectRide',function(e){
        $.session.set('rideId', $(this).attr('rideId'));
        $('#modalFade').addClass('hide');
        $('#panelMyLift').addClass('hide');
        $.session.set('hasRide',true)

        var liftId       = $.session.get('liftId');
        var contribution = $.session.get('contribution');
        updateContribution(liftId, contribution);
        
        e.preventDefault();
    });
    
    // select ride
    $(document).on('click','.select', function (e){
        $.session.set('liftId',$(this).attr('liftId'));
        $.session.set('seats',$(this).attr('seats'));
        $.session.set('riderId',$(this).attr('customerId'));
        $.session.set('contribution',$(this).attr('contribution'));
        var customerId = sessionManager('getSession','customerId');
        if(customerId)
        {        
            /*
             * if user has not selected any lift from right
             * screen on search drivers page
            */ 
            if(!$.session.get('hasRide'))
            {
                var res = rideByCustomer(customerId);
                getMyRides();
            }
            // show the message pop up.   
            else
            { 
                var liftId       = $.session.get('liftId');
                var contribution = $.session.get('contribution');
                updateContribution(liftId, contribution);

//                var rideId      =  $.session.get('rideId');                     
//                var res         =  getARide(rideId);
//                var ride        =  res.ride;                    
//                $.session.set('ride',ride);
                var liftId      =  $.session.get('liftId');                     
                var res         =  getLiftById(liftId);
                var lift        =  res.lift;                    

                processOffer(lift);
/*
                if (lift.textYes)
                {
                    $(this).popover('show');
                    $('.select').not(this).popover('hide');
                }
                else
                {
                    processOffer(lift);
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
    $(document).on('click','#sendSMS', function (e){
        $("#sendSmsLoader").removeClass('hide');
        $('#sendSMS').attr('disabled','disabled');

        var liftId      =  $.session.get('liftId');                     
        var res         =  getLiftById(liftId);
        var lift        =  res.lift;                    

//        var rideId      =  $.session.get('rideId');                     
//        var res         =  getARide(rideId);
//        var ride        =  res.ride;                    
        processOffer(lift);
    });
    

    //show lifts
    $(document).on('click','.showLift',function()
    {
        var seats = $(this).closest('table').children('.seats').html()
        $.session.set('rideId',$(this).attr('rideId'));
        $.session.set('seats',seats);
        getLiftsByRide($(this).attr('rideId'));
    });

    //book a ride
    $(document).on('click','.confirmRide',function(){
            $('#paymentModal').modal('show');
    });    
});

function processOffer
(
    lift
)
{
//    ride = $.session.get('ride');
//    ride = sessionManager('getSession','ride');
    window.setTimeout(function(){
            
        // get the rider firstName and lastName, rider email
        var customer    =  getCustomerByCustomerId($.session.get(
                                                    'riderId'), true);
        var phoneNumber =  $('response returnVal phone1',
                                                    customer).text();     
        phoneNumber     =  phoneNumber.split('-').join(''); 
        
        var name        =  $('response returnVal firstName',
                                                    customer).text(); 
                              +' '+  $('response returnVal lastName',
                                                    customer). text();     
        var email       =  $('response returnVal email',
                                                    customer).text(); 
                             
        var rideId      =  $.session.get('rideId');                     
        var res         =  getARide(rideId);
        var ride        =  res.ride;                    
        var liftId      =  lift.id;
        
        var data        =  liftId+';'+
                           ride.id+';'+
                           $.session.get('seats');
                                    
        var link        =  getLink(data);
        
        var msg         =  $('#messageContent').val() + '\n'
                            + ' '+  SITE_URL+'confirmRide.php' + link;
   
        var hasSent     =  true;
        if (ride.textYes)
        {
            hasSent =  sendTextMessage(phoneNumber, msg);
        }
        
        var riderEmailBody = getRiderEmailBody(name, lift, link);             
        var hasMailSent    = sendEmail(email,'Inquire a Ride ',
                                    riderEmailBody);
        //var driver details
        var driverDetails  = sessionManager('getSession','user');
        
        // get the driver firstName and lastName, driver email
        var driver         = getOwnerByOwnerId(driverDetails.userInfoId,
                                                                true);
        
        var driverName     =  $('response firstName',driver).text()
                               +' '+$('response lastName',driver).text();
        var rider = {'name': name,
                     'email': email}
        var driverEmailBody = getDriverMailBody(driverName, lift);
        //send acknowledgment to driver
        hasMailSent = sendEmail($('response email',
                                driver).text(),
                                'Acknowledgment For Booking a Rider',
                                driverEmailBody);
        if(hasSent || hasMailSent )
        {              
            hasSent =  bookALift($.session.get('rideId'),
                                 $.session.get('liftId'),
                                 $.session.get('seats'));    
            hasSent = pendingConfirmLift($.session.get('liftId'));
            if(hasSent)
            {
                $.session.clear('hasRide');
                $.session.clear('rideId');
                showAlertBox('Inquire Alert',
                    'The ride offer email was sent to the rider.',
                    SITE_URL+'bookRider.php')
                $("#sendSmsLoader").hide();                                 
            }
            else
            {
                showAlertBox('Error',ERROR_MSG);
            }
        }  
        return false;
    },100); 
};



//function get rides.
function getLifts
(
)   
{       
    rideId = JSON.stringify($.session.get('rideId')); 
    if (rideId == "null")
    {
        rideId = NO_ID    
    }   
    
    if($.session.get('dateFindRider'))
    {
        $('#bookRideContainer').removeClass('hide');
        $('#errorContainer').addClass('hide');
        var dataToSend =
        {
            'action'   : GET_LIFTS,
            'rideId'   : rideId,
            'startType': JSON.stringify($.session.get('addressType')),
            'location' : JSON.stringify($.session.get('locationFindRider')),
            'address'  : JSON.stringify($.session.get('addressFindRider')),
            'date'     : JSON.stringify($.session.get('dateFindRider')),
            'time'     : JSON.stringify($.getDateTime.time(
                                        $.session.get('timeFindRider'),true)),
            'seats'    : JSON.stringify($.session.get('seatsFindRider')),
            'bags'     : JSON.stringify($.session.get('bagsFindRider')),
            'bagSize'  : JSON.stringify($.session.get('bagSizeFindRider')), 
            'smoker'   : JSON.stringify($.session.get('smokerFindRider'))
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
                $.session.set('ridersData',JSON.stringify(jsonResult));
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
        $('#rideContainer').append(htmlBody);
    }
}

//function load rides container
function loadRidesContainer
(  
)
{     
    loadMatchedRiders('maxMiles',1);  
}

//function load matched riders
function loadMatchedRiders
(
    filterType,
    sortOrder
)
{
    $('#rideContainer').empty();
    $('#rideContainer').fadeOut('slow');
    var htmlBody='';
    var result =  JSON.parse($.session.get('ridersData'));
    if(result.retCode && result.lifts.length > 0)
    {  
        result = sortByKey(result.lifts,filterType,sortOrder); 
        var from = result[0].startType == AIRPORT_START ? "Airport" : "Address"
        var to   = result[0].startType == ADDRESS_START ? "Airport" : "Address"
        htmlBody+='<table class="table table-bordered"><tr>';
        htmlBody+='<th>First Name</th><th>Last Name</th><th>'+from+'</th>';
        htmlBody+='<th>'+to+'</th><th>Smoker</th>';
        htmlBody+='<th>Seats</th>';
        htmlBody+='<th>Within</th>';
        htmlBody+='<th>Contribution</th>' ;
        htmlBody+='<th>Datetime</th><th>&nbsp;</th></tr>';            
        $.each(result,function(i,item){                                        
            var smoker = item.smoker ? 'YES' : 'NO';
            var dateTime = $.getDateTime.datePickerDateTime(item.datetime);
            var seats = $.session.get('seatsFindRider') >= item.seats ? 
                        item.seats : $.session.get('seatsFindRider') ;
            var contribution = item.contribution.toFixed(2);                              

            htmlBody+='<tr><td>'+item.firstName+'</td>';
            htmlBody+='<td>'+item.lastName.substring(0,1)+"..."+'</td>';
            htmlBody+='<td>'+item.start+'</td>';
            htmlBody+='<td>'+item.to+'</td>';
            htmlBody+='<td>'+smoker+'</td>';
            htmlBody+='<td>'+item.seats+'</td>';
            htmlBody+='<td>'+item.maxMiles+' Miles</td>';
            htmlBody+='<td>'+contribution +' $</td>';
            htmlBody+='<td>'+dateTime+' </td>';
            htmlBody+='<td><a href="#" liftId="'+item.lId+'" customerId="'
                        +item.customerId+'" rideId="';
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
        htmlBody+='<th>Drop Off</th><th>Smoker</th>';
        htmlBody+='<th>Within</th><th>Contribution</th></tr>';
        htmlBody+='<tr><td colspan="99"><center>';
        htmlBody+='No Records Found !</center></td></tr></table>';
    }
    $('#rideContainer').append(htmlBody); 
    $('#rideContainer').fadeIn('slow');
//    setTimeout(function(){
//        getPopUp('.select', '#popUpContainer','right');
//        },100);
}

//function load other features
function loadOtherFeatures
(
    entityId
)
{
    $('#priceDetailsPopUp').empty();
    var features = getEntityFeaturesById(entityId);
    var htmlBody = '<div class="container-fluid"><div class="row-fluid">';
    htmlBody+='<div class="row padLeft"><div class="row-fluid">';
    htmlBody+='<div class="span10"><div><b>Car Details</b></div>';
    htmlBody+='</div><div class="span2"><button  class="close popup"';
    htmlBody+='type="button">×</button></div></div>';
    htmlBody+='<div class="row-fluid"><div class="row-fluid ">';
    htmlBody+='<ul><h4>Features</h4>';

    if(features.retCode && features.features.length > 0)
    {
        features = features.features;
        $.each(features,function(i,item){
                if(i>5)
                    return false;
                htmlBody+='<li class="priceList">'+item.name +' : '  + 
                item.description + '</li>';
        });     
        htmlBody+='<li>&nbsp;</li>'
        htmlBody+='</ul></div></div></div></div></div>' ;
    }
    else
    {
        htmlBody+='<li class="priceList">No features forund !</li>';
    }
    $('#priceDetailsPopUp').append(htmlBody);
    getPopUp('#priceDetail','#priceDetailsPopUp','left');
}

//function book a lift
function bookALift
(
    rideId,
    liftId,
    seats
)
{
    var res = -1;
    var dataToSend =
    {
        'action' : BOOK_A_LIFT,
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

//function get a lift
function getLiftsByRide
(
    rideId
)
{
    var dataToSend =
    {
        'action' : GET_A_RIDE,
        'rideId' : JSON.stringify(rideId)
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
            loadLifts(jsonResult);
        }
    });
}

//function update contribution
function updateContribution
(
    liftId,
    contribution
)
{
    var dataToSend =
    {
        'action'       : UPDATE_CONTRIBUTION,
        'liftId'       : JSON.stringify(liftId),
        'contribution' : JSON.stringify(contribution)
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
    return res
}

//function load lifts
function loadLifts
(
    result
)
{
    var htmlBody='';
    if(result.liftsStream.length > 0)
    {
        var lifts = result.liftsStream;
        $.each(lifts,function(i,item)
        {
            var name = item.firstName + ' ' + item.lastName;
            var canConfirm = item.status == NEW_LIFT ? '':'hide';

            htmlBody+='<table class="table table-bordered"><tr ';
            htmlBody+='class="confirmRideRow'+canConfirm+'">';
            htmlBody+='<td colspan="99" class="pull-left">';
            htmlBody+='<button type="button"';
            htmlBody+=' class="btn btn-success confirmRide"';
            htmlBody+=' liftId="'+item.liftId+'">Get My Ride';
            htmlBody+='</button></td></tr>';
            htmlBody+='<tr><td>Name</td><td>'+name+'</td></tr>';
            htmlBody+='<tr><td>Email Id</td><td>'+item.email+'</td></tr>';
            htmlBody+='<tr><td>Phone</td><td>'+item.phone+'</td></tr>';
            htmlBody+='<tr><td>Address</td><td>'+item.address+'</td></tr>';
            htmlBody+='<tr><td>Time</td><td>'+item.time+'</td></tr>';
            htmlBody+='<tr><td>Note</td><td >' + (item.time || '') +
                      '</td>';
            htmlBody+='</tr></table>' ;       
        });
    }
    else
    {
        htmlBody = '<div><h2 class="greenLabel">No Lift is assigned with';
        htmlBody +=' this ride.</h2></div>';
    }
    $('#lifts').append(htmlBody);
    $('#liftsContainer').removeClass('hide');

    setTimeout(function(){
        $('#lifts').liquidSlider({
            autoHeight:false,
            mobileNavDefaultText: 'Lifts',
            slideEaseFunction:'animate.css',
            slideEaseDuration:50,
            heightEaseDuration:50,
            animateIn:"bounceInDown",
            animateOut:"bounceInUP",
            preloader: false,
            responsive: true,
            mobileNavigation: true,
            swipe: true
        });
    },100);
} 

// load the filters
$(window).on('load',function(){
    $('#filterOrder').select2();
    $('#filterPrice').select2();
    loadMatchedRiders($('#filterPrice option:selected').val(),
                      $('option:selected','#filterOrder').val());
});

//function get rider email body
function getRiderEmailBody
(
    name,
    lift,
    activationLink
)
{
        var emailBody;
        var date = $.getDateTime.formatDate(lift.dt);
        var time = $.getDateTime.formatTime(lift.dt);        
        var smoker = lift.smoker == true? 'yes': 'No';

        var link = '<a class="btnEmail" href="{0}';
            link+='confirmRide.php{1}">Click Here </a>'
        var activationBody = String.format(link,SITE_URL,activationLink); 
        var emailBody  = '<div><p><strong>Dear '+ name +'</strong>,</p><br />';
        emailBody +='<p>A rider has offered you a ride.</p>';
        emailBody +='<p>Please click on the link to confirm the ride offer.';
        emailBody +='</p><p>'+activationBody+'<br><br></p>';   
        emailBody +='<p>Ride Detail:</p>';
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
                    lift.bags+'</td></tr>';
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

//function get driver mail body
function getDriverMailBody
(
    name,
    lift
)
{
    var smoker = lift.smoker == true? 'yes': 'No';
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
    
    var emailBody = '<div><p><strong>Dear '+ 
                    name +'</strong>,</p><br />';
    emailBody +='<p>Your request has been sent to the rider.</p>';
    emailBody +='<p><strong>Ride Request Detail</strong></p>';
    emailBody +='<table border="1px">';
    emailBody +='<tr><td>Date</td><td>'+
                date+'</td></tr>';
    emailBody +='<tr><td>Time</td><td>'+
                time+'</td></tr>';
    emailBody +='<tr><td>Pick Up</td><td>'+
                start+'</td></tr>';
    emailBody +='<tr><td>Drop off</td><td>'+
                to+'</td></tr>';
    emailBody +='<tr><td>Seats</td><td>'+
                lift.seats+'</td></tr>';
    emailBody +='<tr><td>Smoker</td><td>'+
                smoker+'</td></tr>';
    emailBody +='<tr><td>Bags</td><td>'+
                lift.bagss+'</td></tr>';
    emailBody +='<tr><td>Bag Size</td><td>'+
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


//function get my rides
function getMyRides
(
)
{
    var isFirstLoad = $('#myLiftsContainer').children().length == 0;
    if(isFirstLoad)
    {
        var customerId = sessionManager('getSession','customerId');   
        var res = rideByCustomer(customerId);
        var htmlBody = '';
        var hasArrow = res.lifts == null || res.lifts.length == 1;
        if(res.retCode && res.rides.length > 0)
        {
        var rides =sortByKey(res.rides,'dt','0'); 
        $.each(rides,function(i,item) {
            var canSelect = item.status != 2;
            var date = $.getDateTime.formatDate(item.dt);
            var dateTime = $.getDateTime.formatDateTime(item.dt);

            htmlBody+='<div><h2 class="title greenLabel">'+date+'</h2>';
            htmlBody+='<table class="table table-striped">';
            if(canSelect)
            {
                htmlBody+='<tr><td colspan="99">';
                htmlBody+='<a href="#" class="selectRide '+canSelect+'"';
                htmlBody+=' rideId="'+item.id +'" date="'+item.dt+'"';
                htmlBody+=' customerId="'+item.customerId+'">';
                htmlBody+='<i class="icon-th"></i>';
                htmlBody+=' Select Ride</a></td></tr>';
            }
            htmlBody+='<tr><td>Date</td><td class="dateTime">'+
                        dateTime+'</td></tr>';
            htmlBody+='<tr><td>Pick Up</td><td class="start">'+
                        item.start+'</td></tr>';
            htmlBody+='<tr><td>Via</td><td class="via">'+
                        item.via+'</td></tr>';
            htmlBody+='<tr><td>Drop Off</td><td class="to">'+
                        item.to+'</td></tr>';
            htmlBody+='<tr><td>Seats</td><td>'+
                        item.seats+'</td></tr>';
            htmlBody+='<tr><td>Status</td><td>'+
                        getStatusName(item.status)+'</td></tr>';
            htmlBody+='<tr><td>Note</td><td  class="textBreak">  '+
                        (item.note || '-')+'</td></tr>';
            htmlBody+='</table></div>';
        });
    }
    else
    {
    htmlBody+='<div><h2 class="greenLabel">No ride is found</h2>';
    htmlBody+='</div>';
    } 
    $('#myLiftsContainer').append(htmlBody); 
    }   

    $('#modalFade').removeClass('hide');
    $('#panelMyLift').removeClass('hide');
    if(isFirstLoad)
    {
        $('#myLiftsContainer').contentSlider('My Rides',hasArrow,
        $.session.get('selectedTabBookRider'));
    }
}


//function get status name
function getStatusName
(
    statusId
)
{
    var status = '';
    switch(parseInt(statusId))
    {
        case 0:
            status = 'New Ride';
            break;
        case 1:
            status = 'Pending';
            break;
        case 2:
            status = 'Full';
            break;
    }
    return status;
}

 // store seleted lift 
$(window).bind('beforeunload',function(){
    if($('#myLiftsContainer-nav-select').is(':visible'))
    {
        var tabId = $('#myLiftsContainer-nav-select option:selected').val().
                    split('tab')[1];
        $.session.set('selectedTabBookRider',tabId);    
    }
    else
    {
        $('#myLiftsContainer-nav-ul li').each(function(i,item){
            if($('a',this).hasClass('current'))
            {
                var tabId = $('a',this).attr('href').split('#')[1];
                $.session.set('selectedTabBookRider',tabId);
            }
        });
    } 
});

/* End of file commentBookRider.js */
/* Location: ./js/commentBookRider.js */  
