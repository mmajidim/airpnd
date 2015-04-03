/**
 * @file       commentRequestRide.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for request ride.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added request ride functionality and
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    06/02/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    06/17/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added the datetimepicker restrction validation
 * @revDate    06/20/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    06/30/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 */ 

$(function(){
    //disable submit
    $(window).keydown(function(event){
    if(event.keyCode == 13) 
    {
        event.preventDefault();
        return false;
    }
    });
    // show previous lifts
    showPreviousLifts();
    var autocomplete;
    initializeModal('paymentModal');
    $('#requestRideBagSizeSelect').select2();
    $('#seatsRequestRide').select2();
    getSeats('seatsRequestRide');
    // Create the autocomplete object, restricting the search
    // to geographical location types.   addressFindRider
    if($('#toLocationFrom').css('display') != 'none')
    {
        autocomplete = new google.maps.places.Autocomplete(   
        (document.getElementById('toLocation')), 
        { 
            types: ['geocode'] 
        });
    }

    autocomplete = new google.maps.places.Autocomplete(   
    (document.getElementById('fromLocation')), 
    { 
        types: ['geocode'] });
    // When the user selects an address from the dropdown,
    // populate the address fields in the form.
    google.maps.event.addListener(autocomplete, 'place_changed', 
                                  function() {
    });    

    //get locations from google
    $('#toLocation,#fromLocation').keyup(function(e){
    geoLocation();
    });

    // viaLocation
    $('#viaLocation').attr('disabled','disabled');
    var dataToHide = 
    [
        {'id':'requestRide'},
        {'id':'myLiftsRequestRide'}
    ];

    initializeModal('paymentModal');    
    bindSelectBox('ccExpMonth',months);
    bindCustomSelectBox('ccExpYear',years);
    bindCustomSelectBox('ccType',cardTypes);
    bindStateBox();
    $('[rel="tooltip"]').tooltip();

    toggleSection(dataToHide);  

    getLocation('fromLocationRequestRide',true); 
    getLocation('toLocationRequestRide',true); 
    getBagTypes('requestRideBagSizeSelect');
    
    $('#toLocation').filterType('special');
    $('#viaLocation').filterType('special');  
    $('#seatsRequestRide').filterType('numeric');  
    $('#requestRideDateTime').dateTimePicker();
    $('#requestRideDateTime').on('click',function(){
        $(this).next('.popover').remove();
        $(this).popover('hide');
    }) ;
        
    // toggle right side panel 
    $(".icon-minus-sign, .icon-plus-sign").on('click',function(){
            $(this).toggleClass("icon-minus-sign icon-plus-sign");
            $('#requestRideContainer').slideToggle(200, "linear");
            return false;
    });

    //enable via
     $('#toLocation,#fromLocation').keyup(function(){
        if($("#toLocation").val().length > 0 || 
            $("#fromLocation").val().length > 0 )
        {
            $('#viaLocation').attr('disabled',false);
        }
        else
        {
            $('#viaLocation').attr('disabled','disabled');
        }
    });
        
    // change status to pending payment
    $(document).on('click','.confirmLift',function(){
        var isPending = pendingPaymentLift($(this).attr('liftId'));
        if(isPending)
        {
            var message = 'Lift status has been changed to pending payment.';
            message+= ' Please pay to confirm the lift.';
            showAlertBox('Confirmation Alert',
            message, SITE_URL+'requestRide.php');
        }
        else
        {
            showAlertBox('Error',ERROR_MSG);
        }
        moveTotop();
        return false;
    });

    // swap to and from address
    $(document).on('click','.exchange',function(){              
        $("#startLocationFrom,#startLocationTo").toggleClass('hide');
        $("#toLocationFrom,#toLocationAirport").toggleClass('hide');
        $("#startLocationTo .postRideLocationInput").toggleClass('ignore');  
        $("#toLocationFrom .postRideLocationInput").toggleClass('ignore');  
                               
        var airPortAddress  =  $('#fromLocationRequestRide option:selected')
                                                                    .val();
        var toLocAddress    =  $("#toLocation").val();
        var locationAddress =  $('#toLocationRequestRide option:selected').
                                                                     val();
        var toAirLocation   =  $("#fromLocation").val();
        
        $("#fromLocation").val(toLocAddress);
        $("#toLocationRequestRide").select2('val',airPortAddress);
        $("#fromLocationRequestRide").select2('val',locationAddress);
        $("#toLocation").val(toAirLocation);
        //code for label toggling
        if(!$('#fromLocation').hasClass('ignore')) 
        {
            $('#startLabel').html('Address');
            $('#toLabel').html('Airport');
        }
        else
        {
            $('#startLabel').html('Airport');
            $('#toLabel').html('Address');
        }
        return false;
    });  
        
    // change status to pending payment
    $(document).on('click','.pay',function(){
        $.session.set('liftId',$(this).attr('liftId'));
        var result = getLiftById($.session.get('liftId')); 
        if(!result.retCode || result.lift == null || 
            result.lift.rideId <= 0)
        {     
            $('.closeModal').closest('#paymentModal').modal('hide');
            var msg = 'Please contact the customer support.';
            msg+=' You can not pay untill it has a ride. ';
            showAlertBox('Error',msg);
        }
        else
        {
            $.session.set('rideId',result.lift.rideId);
            $.session.set('amount',result.lift.contribution);    
            amount = $('#amount').html() + result.lift.contribution;
            $('#amount').html(amount);
            $('#paymentModal').clearForm();
            $('#ccType').select2('val','');
            $('#ccExpMonth').select2('val','');
            $('#ccExpYear').select2('val','');
            $('#state').select2('val','');
            $('#processPayment').removeAttr('disabled'); 
            $('#paymentLoader').hide();
            // code for showing address on payment modal
            var customerId = sessionManager('getSession','customerId');
            var customerDetails = getCustomerByCustomerId(customerId,
                                    true);
            var addr = ' <strong>';
            if($('response address1',customerDetails).text())
            {
                addr+=$('response address1',customerDetails).text() +
                        ', ';
            }
            if($('response address2',customerDetails).text())
            {
                addr+=$('response address2',customerDetails).text() +
                        ',';
            }
            if($('response city',customerDetails).text())
            {
                addr+=$('response city',customerDetails).text() + 
                        ', ';
            }
            if($('response state',customerDetails).text())
            {
                addr+=$('response state',customerDetails).text() +
                        ', ';
            }
            if($('response country',customerDetails).text())
            {
                addr+=$('response country',customerDetails).text() +
                        ', ';
            }
            if($('response zipCode',customerDetails).text())
            {
                 addr+=$('response zipCode',customerDetails).text();
            }
            addr+=' <strong>';
            $('#custAddress').html(addr);
            $('#paymentModal').modal('show');
        }
         moveTotop();
         return false;
    });

    $("#requestRideForm").validate({
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
                getErrorPopupTemplate(value,'right');
            });
        },
        rules:
        {
            fromLocation :
            {
               required:true 
            },
          
            toLocation : 
            {
                required:true
            },
            dateRequestRide : 
            {
                required:true,
                date:false
            }
        },
        messages:
        {
             fromLocation:
            {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'Start location')
            },
            toLocation:
            {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'destination location')
            },
         
            dateRequestRide:
            {
                required:VALIDATION_ERROR_MSG_SELECT.replace('{element}',
                    'date')
            }
           
        },
        invalidHandler: function(event, validator)
        {
            if (validator.numberOfInvalids()) 
            {
                return true;
            } 
        },
        submitHandler: function(form) 
        {          
            $('#requestRideLoader').removeClass('hide');
            $('#requestRide').attr('disabled','disabled');
            postALift();
        }
    });

    //to open datepicker on click of icon
    $('.icon-calendar').on('click',function(){
        $(this).closest('div').children('input[type="text"]').
        datetimepicker('show');
        return false;
    });
});

//function  geoLocation
// get locations from google
function geoLocation() 
{
    if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(function(position) 
        {
            var geolocation = new google.maps.LatLng(
            position.coords.latitude, position.coords.longitude);
            if (typeof autocomplete != "undefined")
            {
                autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
                   geolocation));
            }
        });
    }
} 

//function post a lift
function postALift
(
)
{
    var startAddress =  $('#startLocationFrom').css('display') != 'none' ?  
                        $('option:selected','#fromLocationRequestRide').val() : 
                        $('#fromLocation').val();
    var toAddress    =  $('#toLocationFrom').is(':visible')?  
                        $('#toLocation').val() : 
                        $('option:selected','#toLocationRequestRide').val(); 
    var startType    =  $('#startLocationFrom').css('display') != 'none' ? 
                        AIRPORT_START : ADDRESS_START;                    
                      
    var customerId = sessionManager('getSession','customerId');
    if(customerId)
    {
        var date = $.getDateTime.date($('#requestRideDateTime').val());
        var time = $.getDateTime.time($('#requestRideDateTime').val());       
        time = $.getDateTime.time(time,true);
        var liftData = 
        {
            'customerId' : customerId,
            'date'       : date,
            'time'       : time,
            'start'      : startAddress,
            'to'         : toAddress,
            'startType'  : startType,
            'via'        : '',
            'maxMiles'   : '',
            'seats'      : $('#seatsRequestRide option:selected').val(),
            'smoker'     : $('#smoker').is(':checked'),
            'bags'       : $('#bagRequestRide').val(),
            'bagSize'    : $('#requestRideBagSizeSelect option:selected').val(),
            'note'       : $('#liftNote').val()
        }  
        var dataToSend =
        {
            'action'   : POST_A_LIFT,
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
                    var msg ='Your request for a ride';
                    msg +=' has been registered successfully.'
                    showAlertBox('Successful',msg,SITE_URL + 
                                 'requestRide.php');
                }
            }
        });
    }
    moveTotop();
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


//function show previous lifts
function showPreviousLifts
(
)
{
    var customerId = sessionManager('getSession','customerId');
    if(customerId)
    {
        var result = liftsByCustomer(customerId);
        var hasArrow = result.lifts == null || result.lifts.length == 1;
        loadPreviousLifts(result); 
        $('#requestRidePanel').contentSlider('My Offers',hasArrow,
                                             $.session.get('selectedTab'));
    }
}
// function load my lifts
function loadPreviousLifts
(
    result
)
{    
    var htmlBody='';
    if(result.retCode && result.lifts.length > 0)
    {         
        result = sortByKey(result.lifts,'dt','0');  
        $.each(result,function(index,item){
            var date = $.getDateTime.formatDate(item.dt);
            var within = item.maxMiles == null ? '-' : item.maxMiles + 
                        ' Miles';
            var canPay = item.status == PENDING_PAYMENT;
            var canConfirm = item.status == PENDING_CONFIRM;
            var dateTime = $.getDateTime.formatDateTime(item.dt);
            var from = item.startType == AIRPORT_START ?
                        "Airport" : "Address"
            var to   = item.startType == ADDRESS_START ?
                        "Airport" : "Address"
            var smoker = item.smoker ==1 ? "Yes" : "No";
                        
            var bags = "";
            if (typeof item.bags !== 'undefined' &&
                item.bags != null)
            {
                bags = item.bags
            }

            htmlBody+='<div><h2 class="title greenLabel">'+date+'</h2>';
            htmlBody+='<table class="table table-striped"><tr>';
/*
            if(canConfirm)
            {                  
                htmlBody+='<td>';  
                htmlBody+='<a href="#" class="confirmLift"';
                htmlBody+=' liftId="'+ item.id +'">Confirm';
                htmlBody+='</a>';
                htmlBody+='</td>';
            }
*/
            if(canPay)
            {   
                htmlBody+='<td><a href="#"';
                htmlBody+= ' class="pay" liftId="'+item.id+'">Pay Now</a>';
                htmlBody+='</td>';
            } 
            htmlBody+='</tr><tr><td>Date</td><td>'+dateTime+'</td></tr>';
            htmlBody+='<tr><td>'+from+'';
            htmlBody+='</td><td>'+item.start+'</td></tr>';
            htmlBody+='<tr><td>'+to+'</td><td>'+item.to+'</td></tr>';
            htmlBody+='<tr><td>Seats</td><td>'+item.seats+'</td></tr>';
            htmlBody+='<tr><td>Smoker</td><td>'+smoker+'</td></tr>';
            htmlBody+='<tr><td>Bags</td><td>'+bags+'</td></tr>';
            htmlBody+='<tr><td>Status</td><td>'+
                        getLiftStatusName(item.status);
            htmlBody+='<tr><td>Bag Size</td><td>'+
                        getBagSizeName(item.bagSize)+'</td></tr>';
            htmlBody+='<tr><td>Note</td><td>'+item.note+'</td></tr>';            
            htmlBody+='</td></tr></tr></table></div>';
        }); 
    }
    else
    {
        htmlBody = '<div><h2 class="greenLabel">No lift is found.</h2></div>';
    }

    $('#requestRidePanel').append(htmlBody);
}


//load datetime validation rules
$(window).on('load',function(){
    $.validator.addMethod('minStrict', function (value, el, param) {
        value = new Date($('#requestRideDateTime').val()).getTime();
        return value > param;
    }); 
    $('#requestRideDateTime').rules( "add", {
        required: true,
        minStrict: new Date().getTime(),
        messages: {
            required: "please enter time",
            minStrict: jQuery.format("Time should be greater than current time")
        }
    }); 
});


$(function(){
    var paymentForm = $('#paymentForm').validate({
        ignore: ":hidden .ignore",
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
        rules:
        {
            firstName:
            {
                required : true
            },
            lastName:
            {
                required : true
            },
            streetAddress:
            {
                required : true
            },
            city:
            {
                required : true
            },
            state:
            {
                required : true
            },
            zipCode:
            {
                required : true
            },
            ccNumber:
            {
                required : true
            },
            cvv:
            {
                required : true
            }
        },
        messages:
        {
            firstName:
            {
                required : VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'first Name')
            },
            lastName:
            {
                required : VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'last Name')
            },
            streetAddress:
            {
                required : VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'address')
            },
            city:
            {
                required : VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'city')
            },
            state:
            {
                required : VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'state')
            },
            zipCode:
            {
                required : VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'zip code')
            },
            ccNumber:
            {
                required : VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'credit card number')
            },
            cvv:
            {
                required : VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'cvv number')
            }
        },
        showErrors: function(errorMap, errorList) {
            return $.each(errorList, function(index, value) 
                {
                    getErrorPopupTemplate(value);
            });
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
              $('#processPayment').attr('disabled','disabled');
              $('#paymentLoader').show();
              
              paymentRetCode = processPayment($.session.get('amount'));
              if (paymentRetCode)
              {
/*
                  var riderId   = $.session.get('customerId');
                  var driverId  = $.session.get('ownerId');
                  var rideId    = $.session.get('rideId');
                  var liftId    = $.session.get('liftId');

                  // set data with encryption to pass it in the link
                  var data  = $.session.get('liftId')+';'+
                              $.session.get('rideId');   
                  var link = getLink(data);
                  
                  // get the rider firstName and lastName, rider email
                  var riderDetails = getCustomerByCustomerId(riderId,
                                                             true);                      
                  var riderName  = $('response firstName',
                                     riderDetails).text()+' '+
                                   $('response lastName',
                                     riderDetails).text();
                  var riderEmail = $('response email',
                                    riderDetails).text()                   

                  riderPaidEmailBody = getRiderPaidEmailBody(riderName,
                                                             riderEmail,
                                                             link);
                  // send the email for the rider
                  var hasMailSent = sendEmail(riderEmail,
                                              'Paid a Ride ',
                                              riderPaidEmailBody); 
                                                      
                  // get the driver firstName and lastName, driver email
                  var driver      = getOwnerByOwnerId(driverId,
                                                      true);
                  var driverName  =  $('response returnVal firstName',
                                       driver).text()
                                      +' '+  
                                      $('response returnVal lastName',
                                      driver).text();                       
                  var driverEmail =  $('response returnVal email',
                                       driver).text();  
                                                                            
                  // get the email body for the driver
                  driverPaidEmailBody = getDriverMailBody(driverName,
                                                          driverEmail,
                                                          link);
                  
                  // send the email for the driver
                  hasMailSent = sendEmail(driverEmail,
                                          'Paid a Ride ',
                                          driverPaidEmailBody);         
*/                                          
              }
        }
    }).settings;

    paymentForm.rules.ccType =
    {
        required:true
    }
    paymentForm.messages.ccType =
    {
        required:VALIDATION_ERROR_MSG_SELECT.replace('{element}',
            'card type')
    }
    paymentForm.rules.ccExpMonth =
    {
        required:true
    }
    paymentForm.messages.ccExpMonth =
    {
        required:VALIDATION_ERROR_MSG_SELECT.replace('{element}',
            'expiry month')
    }
    paymentForm.rules.ccExpYear =
    {
        required:true
    }
    paymentForm.messages.ccExpYear =
    {
        required:VALIDATION_ERROR_MSG_SELECT.replace('{element}',
            'expiry year')
    }
});


// store seleted tab 
$(window).bind('beforeunload',function(){
    if($('#requestRidePanel-nav-select').is(':visible'))
    {
        var tabId = $('#requestRidePanel-nav-select option:selected').val().
                     split('tab')[1];
        $.session.set('selectedTab',tabId);    
    }
    else
    {
        $('#requestRidePanel-nav-ul li').each(function(i,item){
            if($('a',this).hasClass('current'))
            {
                var tabId = $('a',this).attr('href').split('#')[1];
                $.session.set('selectedTab',tabId);
            }
        });
    }
});


//function get rider email body
function getRiderPaidEmailBody
(
    name,
    email,
    link
)
{
    var emailBody;
    var pLink = '<a class="btnEmail" href="{0}';
        pLink+='paidRide.php{1}">Click Here </a>'
    var paidBody = String.format(pLink,SITE_URL,link); 
    var emailBody  = '<div><p><strong>Dear '+ name +'</strong>,</p><br />';
    emailBody +='<p>You have successfully paid and booked the ride .</p>';
    emailBody +='<p>Please click on the link to view ';
    emailBody +='detailed ride information.';
    emailBody +='</p><p>'+paidBody+'<br><br></p>';    
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
    email,
    link
)
{
    var emailBody;
    var pLink = '<a class="btnEmail" href="{0}';
        pLink+='paidRider.php{1}">Click Here </a>'
    var paidBody = String.format(pLink,SITE_URL,link); 
    var emailBody  = '<div><p><strong>Dear '+ name +'</strong>,</p><br />';
    emailBody +='<p>The driver has successfully paid and booked the ride .</p>';
    emailBody +='<p>Please click on the link to view ';
    emailBody +='detailed ride information.';
    emailBody +='</p><p>'+paidBody+'<br><br></p>';    
    emailBody +='<br /><p>Regards:-</p>';
    emailBody +='<p>Airpnd Team.</p>';
    emailBody +='<p><sub><i>This is a system generated';
    emailBody +='&nbsp;mail. Please do not reply to it.';
    emailBody +='</i><sub></p></div>'; 
    return emailBody;  
}


//function bind select box
function bindSelectBox
(
    elementId,
    data
)
{
    $.each(data, function(i,item)
        {
            $('#' + elementId).append('<option value="' + i + '">'+
                item + '</option>') ;
    });
    $('#' + elementId).select2();
}

//function bind state box
function bindStateBox
(
)
{
    var dataToSend = {
        "action"       : GET_REGIONS_FOR_COUNTRY,
        "countryCode"  : COUNTRY_NAME
    };

    $.ajax({
        type: "POST",
        url: API_URL,
        data: dataToSend,                                            
        dataType: "json",
        headers: HEADER,
        async:false,
        error: function (e) { 
            return false;
        },
        success: function(result){
            if(result.retCode)
            {
                result = result.regions || result.entities;
                $.each(result, function(i,item) {                 
                        $('#state').append('<option value="' + 
                            item.code + '">'+
                            item.name + '</option>') ;
                });
            }
        }
    });

    $('#state').select2();
}
/* End of file commentRequestRide.js */
/* Location: ./js/commentRequestRide.js */  
