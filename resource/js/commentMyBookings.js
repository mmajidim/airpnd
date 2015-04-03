/**
 * @file       commentMyBookings.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for my bookings.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added my booking page functionality and
 *             done with minor formatting
 * @revDate    05/06/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    modified functionality for auto address and
 *             done with minor formatting
 * @revDate    05/07/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    modified functionality for auto address and
 *             done with minor formatting
 * @revDate    05/09/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    modified functionality for auto address and
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    fixed issue and done with minor formatting
 * @revDate     05/28/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    update code of miles
 * @revDate     06/02/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    update code of miles and fixed the mile functionality.
 * @revDate    06/20/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    fixing issue of miles
 * @revDate    06/30/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    fix minor alingment issues
 */ 
$(function()
{
    var airportName;
    var driverAddress;
    //disable submit
    $(window).keydown(function(event){
        if(event.keyCode == 13)
         {
            event.preventDefault();
            return false;
         }
    });
    var autocomplete;
    getLocation('editRideStartLocation',true);
    getLocation('editRideToStartLocation',true);
    $('#editRideBagSizeSelect').select2();
    $('#editRideSeat').select2();
    getSeats('editRideSeat');
    getBagTypes('editRideBagSizeSelect');
    $('#editRideToLocation').filterType('special');
    $('#editRideViaLocation').filterType('special');  
    $('#editRideSeat').filterType('numeric');  
    $('#editRideNote').filterType('special');  
    initializeModal('editRideModal');
     // attach event to slider
    $( "#editRideLocation" ).on( "slidestop", function( event, ui ) {
            getCountribution();
    } );
    loadRideByCustomer();

    $('.closeModal').on('click',function(){
        $('#editRideModal').modal('hide'); 
        $('.popover').remove();
    });
        
    // Create the autocomplete object, restricting the search
    // to geographical location types.   addressFindRider
    autocomplete = new google.maps.places.Autocomplete(   
    (document.getElementById('editRideFromAddress')), 
        { types: ['geocode'] });
    autocomplete = new google.maps.places.Autocomplete(   
    (document.getElementById('editRideToAddress')), 
        { types: ['geocode'] });
     autocomplete = new google.maps.places.Autocomplete(   
    (document.getElementById('editRideViaLocation')), 
        { types: ['geocode'] }); 
    // When the user selects an address from the dropdown,
    // populate the address fields in the form.
    google.maps.event.addListener(autocomplete, 'place_changed',
    function() {
    });    
    
        //get locations from google
     $('#editRideStartToLocation,#editRideToLocation').keyup(function(e){
        geoLocation();
    });

    // show timepicker when click on icon
    $('.add-on').on('click',function(e){
        $('#editRideTime').timepicker('show');          
    });

    //show associated lifts
    $(document).on('click','.showLift',function()
    {
        $.session.set('rideId',   $(this).attr('for'));
        var rideData =  JSON.parse($.session.get('rideData'));        
        loadLiftsAssigned(rideData[$(this).attr('for')]);
        return false;
    });
    
    // confirm the ride
    $(document).on('click', '.confirmBtn', function()
    {
        var liftId  = $(this).attr('id');
        var confNum = $('#confNum-'+liftId).val();
        if (confNum == "")
        {
            showAlertBox('Error',"Please enter a confirmation number");
        }
        else
        {
            var rideId = $.session.get('rideId');
            var rideData =  JSON.parse($.session.get('rideData'));        
 
            // get the rider information
            var res  =  getARide(rideId);
            var ride =  res.ride;       
                         
            retCode = confirmARide(rideId, liftId, confNum);
            if (retCode == 1)
            {
//                var ride  = rideData[rideId];
                var lifts = rideData[rideId].lifts;
                var idx   = -1;
                var i;
                var item;
                $.each(lifts,function(i,item)
                {
                    if (item.id = liftId)
                    {
                        idx = i;
                        return;
                    }
                });

                var lift = lifts[idx];
                var subject = "AirPnd - Confirmation code - " + confNum +
                              " received";
                var confirmEmailBody = getConfirmNumMailBody(ride, lift);
                var hasMailSent      = sendEmail(ride.email,
                                                 subject,
                                                 confirmEmailBody);              

                if (hasMailSent)
                {
                    var msg  = "The rider confirmation was processed. ";
                    msg += "Airpnd will process payment and send the payment ";
                    msg += "to you. Please make sure your payment information ";
                    msg += "is up-to-date in your user profile. ";
                    msg += "This information can be updated using manage "
                    msg += "<a href='http://www.airpnd.com/profile.php'>"
                    msg += "profile</a>";
                    
                    showAlertBox('Confirmed Rider', msg); 
                    beforeLast = $(this).closest('tr').prev();
                    newTR = '<tr><td>Confirmation Number</td>';
                    newTR += '<td>' + confNum + '</td></tr>';
                    beforeLast.replaceWith(newTR);
                    $(this).closest('tr').remove();

                    var rideData =  JSON.parse($.session.get('rideData'));
                    lift.status = LIFT_FULFILLED;
                    lift.confNum = confNum;
                    lifts[idx] = lift;
                    rideData[rideId].lifts = lifts;
                    $.session.set('rideData',JSON.stringify(rideData));
                    
                    var supportEmail = "support@airpnd.com"
                    var hasMailSent  = sendEmail(supportEmail,
                                                 subject,
                                                 confirmEmailBody);                                                                                                          
                }
            }
            else
            {
                showAlertBox('Confirmation Number',"The rider confirmation number does not match.");
            }
        }
        return false;
    });
    

    //confirm ride request
    $(document).on('click','#confirmLift',function()
    {
        var rideId = $.session.get('rideId');
        var liftId    = $(this).attr('for')

        var rideData = JSON.parse($.session.get('rideData'));
        var ride = rideData[rideId];

        var lifts = rideData[rideId].lifts;
        var idx = -1;
        $.each(lifts,function(i,item)
        {
            if (item.id = liftId)
            {
                idx = i;
                return;
            }
        });
        var lift = ride.lifts[idx];
        
//        loadRideInfo(rideData[$(this).attr('for')]);
        loadRideInfo(rideData[rideId]);

        var isPending = pendingPaymentLift(liftId);
        if(isPending)
        {            
//            var res              = getLiftById(liftId);
//            var lift             = res.lift;

//            var lift 
            var confirmEmailBody = getLiftMailBody(1, lift);             
            var hasMailSent      = sendEmail(lift.email,'AirPnd - Your Ride Request has been Confirmed',
                                             confirmEmailBody);              
            
            if (hasMailSent)
            {
                var textMsgSent = true;
                if (lift.textYes == 1)
                {
                    var msg = "Your ride request was accepted by the driver. " + 
                              "Please pay for the ride " + 
                              "using the payment page. " + SITE_URL;                     
                    
                    textMsgSent = sendRiderMsg(lift, msg);                    
                }
                
                if (textMsgSent)
                {
                    var message  = 'Lift status has been changed to pending ';
                        message += 'payment. An email for payment has been sent to ';
                        message += ' the rider.'
                    showAlertBox('Confirmation Alert',
                                 message, 
                                 SITE_URL+'myBookings.php');
                    moveTotop(); 
                }
            }            
        }
        else
        {
            showAlertBox('Error',ERROR_MSG);
        }        
        return false;
    });

    //reject ride request
    $(document).on('click','#rejectLift',function()
    {

        var rideId = $.session.get('rideId');
        var liftId  = $(this).attr('for');
        var rideData = JSON.parse($.session.get('rideData'));
        var ride = rideData[rideId];

        var lifts = rideData[rideId].lifts;
        var idx = -1;
        $.each(lifts,function(i,item)
        {
            if (item.id = liftId)
            {
                idx = i;
                return;
            }
        });
        var lift = ride.lifts[idx];
 
        var retCode = rejectALift(liftId);
        if(retCode)
        {
//            var res             = getLiftById(liftId);
//            var lift            = res.lift;
            var rejectEmailBody = getLiftMailBody(0, lift);             
            var hasMailSent     = sendEmail(lift.email,'AirPnd - Reject Ride Request',
                                            rejectEmailBody);              
            if (hasMailSent)
            {
                var textMsgSent = true;
                if (lift.textYes == 1)
                {
                    var msg = "Your ride request was rejected by the driver. " + 
                              "Please login into airpnd " + 
                              "to find another ride request. " + SITE_URL;                     
                    
                    textMsgSent = sendRiderMsg(lift, msg);                    
                }
                
                if (textMsgSent)
                {
                    showAlertBox('Alert',
                                 'Ride request was rejected and an email ' + 
                                 'was sent out to the rider.',
                                 SITE_URL+'myBookings.php');
                    moveTotop(); 
                }
            }            
        }
        else
        {
            showAlertBox('Error',ERROR_MSG);
        }
        return false;
    });


     // changing of address and location 
    $(document).on('change', 
        '#editRideStartLocation,#editRideFromAddress,#editRideToAddress,#editRideToStartLocation',
          function(){        
            setTimeout(function(){   
               getCountribution();}, 300); 
               return false;
    });
    
    
    $(document).on('change', '#myRidesContainer-nav-select', function(){
            $('#liftAssignedPanel').addClass('hide');
    }); 
    
       
    // remove the  focus when press enter
    $("#editRideToAddress,#editRideFromAddress").on('keyup',function(e){                
        if(e.keyCode == 13)
        {
            $(this).blur();
        }
        if($(this).val().trim() == '')
        {
            $("#editRidePriceSlider").slider( "option", "disabled", true );
            $("#editRidePriceSlider").slider('value',0);
            $("#maxPrice").text("$"); 
            $("#editRidePriceRange").text("$");
        }
    });
      // edit ride
    $(document).on('click','.editRide',function(){
        $.session.set('rideId',   $(this).attr('for'));
        $.session.set('ownerId',  $(this).attr('ownerId'));
        $.session.set('entityId', $(this).attr('entityId'));
        $.session.set('customerId', $(this).attr('customerId'));
        $.session.set('status', $(this).attr('status'));

        var rideData = JSON.parse($.session.get('rideData'));
        loadRideInfo(rideData[$(this).attr('for')]);
        moveTotop();
        $('#editRideModal').modal('show');
        return false;
    });

   // swap  airport address
    $(document).on('click','.exchange',function(){                                
        $("#startEditRideSelect,#startEditRideInput").toggleClass('hide');  
        $("#toEditRideInput,#toEditRideSelect").toggleClass('hide'); 
        $("#editRideStartLocation,#editRideFromAddress"). toggleClass(
                                                                'isShown');
        $("#editRideToAddress,#editRideToStartLocation"). toggleClass(
                                                                'isShown');      
        $('#startEditRideInput #editRideFromAddress').toggleClass('ignore');
        $("#toEditRideInput #editRideToAddress").toggleClass('ignore');
        var fromLocation =  $('#editRideStartLocation option:selected').val();
        var fromAddress  =  $('#editRideFromAddress').val();  
        var toAddress    =  $('#editRideToAddress').val(); 
        var toLocation   =  $('#editRideToStartLocation option:selected').val()

        $('#editRideToStartLocation').select2('val',fromLocation);  
        $('#editRideFromAddress').val(toAddress) ;
        $('#editRideToAddress').val(fromAddress); 
        $('#editRideStartLocation ').select2('val',toLocation);

        //code for label toggling
        if(!$('#editRideFromAddress').hasClass('ignore')) 
        {
            $('#startLabel').html('Address');
            $('#toLabel').html('Airport');
            airportName = $('option:selected','#editRideToStartLocation').val();
            driverAddress = $('#editRideFromAddress').val();
        }
        else
        {
            $('#startLabel').html('Airport');
            $('#toLabel').html('Address');
            airportName = $('option:selected','#editRideStartLocation').val();
            driverAddress = $('#editRideToAddress').val();
        }
        return false;
    }); 

    $('#editRideDateTime').datePicker();
    $('#editRideTime').timePicker(); 
    // remove error popup
    $('#editRideTime').on('click',function(){
        $(this).next('.popover').remove();
        $(this).popover('hide');
    });
    //to open datepicker on click of icon
    $('.icon-calendar').on('click',function(){
        $(this).closest('div').children('input[type="text"]').
        $('#editRideDateTime').datePicker('show');
        return false;
    });

    //delete ride
    $(document).on('click','.deleteRide',function(){              
        var rideId = $(this).attr('for');  
        var entityId = $(this).attr('entityId');  
        bootbox.confirm("Do you want to delete this record ?",
        function(result)
        {
                if(result)
                {
                    var res = deleteItem(entityId)
                    if(res)
                    {
                        deleteRide(rideId);
                    }
                }
        }); 
        return false;
    });

    $('#editRideBags').on('click',function(){
        $('#bagSizeDiv').slideToggle();
        return false;
    });

    var editRide =  $("#editRideForm").validate(
    {
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
                getErrorPopupTemplate(value,'top');
            });
        },
        rules:
        {
            editRideDateTime : 
            {
                required:true,
                date:false
            },
            editRideTime : 
            {
                required:true,
                date:false
            },
            editRideToAddress : 
            {
                required:true
            },
            editRideSeat : 
            {
                required:true
            }, 
            editRideFromAddress:
            {
                required:true
            }
        },
        messages:
        {
            editRideDateTime:
            {
                required:VALIDATION_ERROR_MSG_SELECT.replace('{element}',
                    'date')
            },
            editRideTime : 
            {
               required:VALIDATION_ERROR_MSG_SELECT.replace('{element}',
                    'time')
            },
            editRideToAddress:
            {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'drop off')
            },
                editRideFromAddress:
            {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'pick up')
            }, 
            editRideSeat:
            {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'seat required')
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
            $('#editRideLoader').removeClass('hide');
            $('#updateRide').attr('disabled','disabled');
            updateRide();
        }
    }).settings;
});

// function  geoLocation 
// get locations from google
function geoLocation
(
) 
{
    if (navigator.geolocation) 
    {
        navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
        autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
          geolocation));
        });
    }
}   
//function load ride by customer
function loadRideByCustomer
(    
)
{
    var customerId = sessionManager('getSession','customerId');
    if(customerId)
    {
        var result = rideByCustomer(customerId);
        loadMyRides(result); 
        var hideSideArrows = (result.rides == null || result.rides.length == 1
                             || result.rides.length == 0);
      
        $('#myRidesContainer').contentSlider('My Rides',hideSideArrows,
            $.session.get('selectedTabMyBooking'));
    }
    else
    {
        loadSignInModal();
    }   
}

// function load my rides
function loadMyRides
(
    result
)
{
    var htmlBody='';
    var rideData = {};
    if(result.retCode && result.rides.length > 0)
    {           
        result = sortByKey(result.rides,'dt','0');
        $.each(result,function(i,item)
        {
            var isEditable = item.editable == 1;
            var hasLift = item.lifts.length > 0 ? true : false
            var canDelete = !hasLift && item.status == NEW_RIDE;

            var bags = item.bags == null ? 'NA' : item.bags ;
            var bagSize = getBagSizeName(item.bagSize );
            var smoker = item.smoker == 1 ? 'YES' : 'NO';
            var note = item.note == null ? '-' : item.note;
            var date = $.getDateTime.formatDate(item.dt);
            var time = $.getDateTime.formatTime(item.dt);
            var from = item.startType == AIRPORT_START ?
                        "Airport" : "Address"
            var to   = item.startType == ADDRESS_START ? 
                        "Airport" : "Address"
            var via = (item.via == null || item.via =='') ? "NA" : item.via;

            rideData[item.id] = item;

            htmlBody+='<div><h2 class="title greenLabel">'+
                        date+'</h2>';
            htmlBody+='<table class="table table-striped"><tbody>';
            htmlBody+='<tr class="tdHeader"><td  colspan=3><a href="#"';
            htmlBody+=' for="'+item.id+'"';
            htmlBody+=' forStatus="'+item.status+'"';
            htmlBody+=' class="showLift"><i class="icon-th"></i>&nbsp;';
            htmlBody+='Show Riders</a></td>';
            if(isEditable)
            {
                htmlBody+='<td class="pull-right" colspan=2>'
                htmlBody+='<a href="#" for="'+item.id+
                    '" status="'+item.status+'"';
                htmlBody+=' entityId="'+item.entityId+
                        '" ownerId="'+item.ownerId+'"'
                htmlBody+=' customerId="'+item.customerId+'"';
                htmlBody+=' class="editRide margin-right">';
                htmlBody+='<i class="icon-pencil"></i>&nbsp;Edit</a></td>';
            }
            if(canDelete)
            {
                htmlBody+='<td class="pull-right" colspan=2>'
                htmlBody+='<a href="#" for="'+item.id+'"';
                htmlBody+=' entityId="'+item.entityId+'"';
                htmlBody+=' class="deleteRide">';
                htmlBody+='<i class="icon-trash"></i>&nbsp;Delete</a></td>';
            }
            htmlBody+='</tr>';
            htmlBody+='<tr><td colspan=2>'+from+'</td><td colspan=2>';
            htmlBody+=item.start+'</td></tr><tr>';
            htmlBody+='<td colspan=2>Via</td><td colspan=2>'+
                        via+'</td></tr>';
            htmlBody+='<tr><td colspan=2>'+to+'</td><td colspan=2>'+
                        item.to+'</td></tr>';
            htmlBody+='<tr><td colspan=2>Date</td><td colspan=2>'+
                        date+'</td></tr>';
            htmlBody+='<tr><td colspan=2>Time</td><td colspan=2>'+
                        time+'</td></tr>';
            htmlBody+='<tr><td colspan=2>Available Seats</td>';
            htmlBody+='<td colspan=3>'+item.seats+'</td></tr>';
            htmlBody+='<tr><td colspan=2>Bags</td><td colspan=2>';
            htmlBody+=bags+'</td></tr><tr><td colspan=2>';
            htmlBody+='Bag Size</td><td colspan=2>';
            htmlBody+=bagSize + '</td></tr><tr><td colspan=2>';
            htmlBody+=' Miles</td><td colspan=2>';
            htmlBody+=item.maxMiles + '</td></tr><tr>';
            htmlBody+='<td colspan=2>Contribution</td>';
            htmlBody+='<td colspan=3>'+item.contribution +' $'+'</td></tr>';
            htmlBody+='<td colspan=2>Status</td>';
            htmlBody+='<td colspan=3>'+getRideStatusName(item.status);
            htmlBody+='</td></tr><tr><td colspan=2>Smoker</td>';
            htmlBody+='<td colspan=2>'+smoker+'</td>';
            htmlBody+='</tr><tr><td colspan=2>Note';
            htmlBody+='</td><td class="textBreak" colspan=2>  ';
            htmlBody+=note+'</td>';
            htmlBody+='</tr></tbody></table></div>';
        });
        $.session.set('rideData',JSON.stringify(rideData));
    }
    else
    {
        htmlBody = '<div><h2 class="greenLabel">No ride is found.</h2></div>';
    }

    $('#myRidesContainer').append(htmlBody);
}


//function update ride
function updateRide
(
)
{
    var price = $('#editRidePriceRange').html().split('$')[1];
    var res = updateRidePrice($.session.get('entityId'),price);
    if(res.retCode)
    {
        updateARide();
    }
    else
    {
        $('#editRideLoader').addClass('hide');
        $('#updateRide').removeAttr('disabled');;
        showAlertBox('Error',ERROR_MSG);  
    }
    moveTotop();
}

//function update a ride
function updateARide
(
)
{
    
      var startAddress =  $('#startEditRideSelect').css('display') != 'none' ?  
                          $('option:selected','#editRideStartLocation').val() : 
                          $('#editRideFromAddress').val();
      var toAddress    =  $('#toEditRideInput').is(':visible')?  
                          $('#editRideToAddress').val() : 
                          $('option:selected','#editRideToStartLocation').val(); 
      var startType    =  $('#startEditRideSelect').css('display') != 'none' ?
                          AIRPORT_START : ADDRESS_START;                    
  
      var dateTime = $('#editRideDateTime').val(); 
      var time = $.getDateTime.time($('#editRideTime').val(),true);
      var miles    = $('#editRideRange').html().split(' ')[0];
      var price    = $('#editRidePriceRange').html().split('$')[1];
      var ride = 
      {
        'id'           : $.session.get('rideId'),
        'ownerId'      : $.session.get('ownerId'),
        'entityId'     : $.session.get('entityId'),
        'date'         : dateTime,
        'time'         : time,
        'start'        : startAddress,
        'to'           : toAddress,
        'startType'    : startType,
        'via'          : $('#editRideViaLocation').val(),
        'maxMiles'     : miles,
        'contribution' : price,
        'seats'        : $('#editRideSeat').val(),
        'status'       : $.session.get('status'),
        'smoker'       : $('#smoker').is(':checked'),
        'bags'         : $('#editBags').val(),
        'bagSize'      : $('#editRideBagSizeSelect option:selected').val(),
        'note'         : $('#editRideNote').val()
      };
    var dataToSend = 
    {
        "action"     : UPDATE_A_RIDE,
        "ride"       : JSON.stringify(ride)
    }
    $.ajax({
        type       : "POST",
        url        : CUSTOM_API_URL,
        data       : dataToSend,                          	                    
        dataType   : "json",
        headers    : HEADER,
        async      : false,
        error      : function (e) 
        {
            $('#editRideLoader').addClass('hide');
            $('#updateRide').removeAttr('disabled');
            showAlertBox('Error',ERROR_MSG);  
        },
        success    : function(jsonResult)
        { 
            $('#updateRide').removeAttr('disabled');
            $('#editRideLoader').addClass('hide');
            if(jsonResult.retCode)
            {
                $('#editRideModal').modal('hide'); 
                showAlertBox('Update Alert',
                    'Your changes have been saved.',
                    SITE_URL + 'myBookings.php');
            }
        }        
    });
}


//function delete ride
function deleteRide
(
    rideId
)
{
    var dataToSend = 
    {
        "action"     : DELETE_A_RIDE,
        "rideId"     : rideId
    }
    $.ajax({
        type       : "POST",
        url        : CUSTOM_API_URL,
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
            if(jsonResult.retCode)
            {
                showAlertBox('Delete Alert',
                    'Your record has been deleted successfully.',
                    SITE_URL + 'myBookings.php');   
            }
        }        
    });
    moveTotop();
}


//function confirm a ride
function confirmARide
(
    rideId,
    liftId,
    confNum
)
{
    var dataToSend = 
    {
        "action"   : CONFIRM_A_RIDE,
        "rideId"   : rideId,
        "liftId"   : liftId,
        "confNum"  : confNum
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
            retCode = -1;
        },
        success  : function(jsonResult)
        { 
            retCode = jsonResult.retCode;
        }
    });
    return retCode;
}


//function load lifts assigned
function loadLiftsAssigned
(
    result
)
{
    $('#liftAssignedContainer').empty();
    var hasArrow = result.lifts == null || result.lifts.length == 1 
                                        || result.lifts.length == 0;
    
    hasArrow ?  $("#liftAssignedContainer-wrapper").addClass("noScroll") :
    $("#liftAssignedContainer-wrapper").removeClass("noScroll");
    
    var htmlBody='';
    if(result && result.lifts.length > 0)
    {
        var lifts = result.lifts;
        $.each(lifts,function(i,item)
        {
            var name;
            var email;
            var time = item.time ? item.time :  
                       $.getDateTime.formatTime(item.dt);
            var liftStatus = getLiftStatusName(item.status)
            var contribution = item.contribution ? 
                               "$" + item.contribution :
                               "";
            var smoker = (item.smoker == 1) ? "Y" : "N"           
            
            if (isLiftPaid(item.status))
            {
                name         = item.firstName + ' ' + item.lastName;
                email        = item.email;
                phone        = item.phone;
                startAddress = item.start;
                toAddress    = item.to;
            }
            else
            {
                name         = "-";
                email        = "-";
                phone        = "-";

                if (item.startType == AIRPORT_START)
                {
                    startAddress = "-";
                    toAddress = hideAddress(item.to);
                }
                else
                {
                    toAddress    = "-";
                    startAddress = hideAddress(item.start);
                }
                
//                startAddress = "-";
//                toAddress    = "-";
            }
            
                       
            htmlBody +='<table class="table table-bordered">';
            liftId = item.id;

            canConfirm = false;
            canReject  = false;
            if (item.status == PENDING_CONFIRM)
            {
                canConfirm = true;
                canReject  = true;
            } 

            if (canConfirm || canReject)
            {
                htmlBody+='<tr class="confirmRejectRow">';
            }
            if(canConfirm)
            {
                htmlBody+='<td colspan="99" class="pull-left confirmLift' +  
                          canConfirm + '">';
                htmlBody+='<label class="checkbox">';
                htmlBody+='<input type="checkbox" name="confirm" for="'+liftId+'"';
                htmlBody+=' id="confirmLift" />Confirm</label>';
                htmlBody+='</td>';
            }  
            if(canReject)
            {
                htmlBody+='<td colspan="99" class="pull-left rejectLift' + 
                          canReject + '">';
                htmlBody+='<label class="checkbox">';
                htmlBody+='<input type="checkbox" name="reject" for="'+liftId+'"';
                htmlBody+=' id="rejectLift" />Reject</label>';
                htmlBody+='</td>';
            }  
            if (canConfirm || canReject)
            {
                htmlBody+='</tr>';
            }
        
            htmlBody +='<tr><td>Name</td><td>'+name+'</td></tr>';
            htmlBody +='<tr><td>Email Id</td><td>'+email+'</td></tr>';
            htmlBody +='<tr><td>Phone</td><td>'+
                        phone+'</td></tr>';
            htmlBody +='<tr><td>Pick Up</td><td>'+
                        (startAddress || '-')+'</td></tr>';
            htmlBody +='<tr><td>Drop Off</td><td>'+
                        (toAddress || '-')+'</td></tr>';
            htmlBody +='<tr><td>Time</td><td>'+
                        time+'</td></tr>';
            htmlBody +='<tr><td>Contribution</td><td>'+
                        contribution+'</td></tr>';
            htmlBody +='<tr><td>Seats</td><td>'+
                        item.seats+'</td></tr>';
            htmlBody +='<tr><td>Smoker</td><td>'+
                        smoker+'</td></tr>';
            htmlBody +='<tr><td>Bags</td><td>'+
                        item.bags+'</td></tr>';
            htmlBody +='<tr><td>Bag Size</td><td>'+
                        item.bagSize+'</td></tr>';
            htmlBody +='<tr><td>Note</td><td >' +
                        (item.note || '-') + '</td></tr>';
                        
            if (item.status == PENDING_FULFILLED)
            {
                htmlBody +='<tr><td>Status</td><td>' +
                           (liftStatus || '') + 
                           '</td></tr>';            
                htmlBody +='<tr><td>Confirmation Number</td><td>' +
                            '' + 
                            '<input id="confNum-' + liftId + 
                            '" type="text"/></td></tr>';
                htmlBody +='<tr><td colspan="2"><button id="' + liftId + '" ';
                htmlBody +='class="btn confirmBtn" style="width:150px">';
                htmlBody += 'CONFIRM</button></td></tr>';                                                                
            }            
            else
            {
                htmlBody +='<tr><td>Confirmation Number</td><td>' +
                            (item.confNum || '') + 
                            '</td></tr>';
                htmlBody +='<tr><td>Status</td><td>' +
                           (liftStatus || '') + 
                           '</td></tr>';            
            }            
            htmlBody +='</table>';
        });
    }
    else
    {
        htmlBody = '<div><h2 class="greenLabel">No Lift is assigned with';
        htmlBody +=' this ride.</h2></div>';
    }
    $('#liftAssignedContainer').append(htmlBody);
    $('#liftAssignedPanel').removeClass('hide');

    setTimeout(function()
    {
        $('#liftAssignedContainer').contentSlider('Assigned Lifts',hasArrow);
    },100);
}

//function getCountribution 
function getCountribution
(
)
{
     airportName =   $('#startEditRideSelect').css('display') != 'none' ?
                     $('option:selected','#editRideStartLocation').val() : 
                     $('option:selected','#editRideToStartLocation').val();  
     driverAddress = $('#toEditRideInput').is(':visible')?  
                     $('#editRideToAddress').val() :
                     $('#editRideFromAddress').val();
     if(driverAddress.trim() != '')
      {
          var price = getPriceForRide(airportName,driverAddress,
                                $('#editRideRange').text().split(' ')[0]);
          $('#editRidePriceSlider').slider("option","max",(price <= 1 ? 0 : price));
          $('#editRidePriceSlider').slider("option","disabled",false);
          var nowVal = $( "#editRidePriceSlider" ).slider( "value" ) <= 1 ? '':
                       $( "#editRidePriceSlider" ).slider( "value" );
          $( "#editRidePriceRange" ).html('$'+nowVal); 
          $('#maxPrice').html((price <= 1 ? 0 : price)); 
    }    
}

//function update price
function updateRidePrice
(
    itemId,
    contribution
)
{
    var prices = getPrice(itemId);
    var priceId = prices[0].id;
    var res = -1;

    var priceList =
    [
        [
            priceId,
            contribution,
            contribution
        ]
    ];
    var dataToSend = 
    {
        "action"   : UPDATE_PRICE,
        "entityId" : itemId,
        "type"     : FIXED_TYPE,
        "priceList": JSON.stringify(priceList)
    }
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        headers  : HEADER,
        async    : false,
        error    : function (e)
        { 
            res = -1;
        },
        success  : function(jsonResult)
        { 
            res = jsonResult;
        }
    });

    return res;
}


//function load ride information
function loadRideInfo
(
    res
)
{      
    var date  = $.getDateTime.formatDate(res.dt);
    var time = $.getDateTime.formatTime(res.dt);
    var currentDate =  new Date().getTime();   
    var rideDate =  new Date(res.dt).getTime();
    if(rideDate <  currentDate)
    {
        time = $.getDateTime.formatTime(new Date());
    } 
    
   // remove error class
     $('#editRideForm').find('input').each(function(){
        if($(this).hasClass('error'))
        {
               $(this).removeClass('error');
        }
    });
    $('#editRideDateTime').val(date);
    $('#editRideTime').val(time);
    $("#editRideDateTime").datePicker(date);    
    $("#editRideTime").timePicker(time); 
    $('#editRideViaLocation').val(res.via); 
    $('#editRideSeat').select2('val',res.seats); 
    $('#editRideNote').val(res.note);
    $('#editRideBagSize').val(res.bagSize);
    $('#editRideBagSizeSelect').select2('val',res.bagSize);
    $('#editBags').val(res.bags);
    
    if(res.startType == ADDRESS_START)
     {
          
          if($('#editRideToAddress').hasClass('isShown'))
           {
             $("#startEditRideSelect,#startEditRideInput").toggleClass('hide');
             $("#toEditRideInput,#toEditRideSelect").toggleClass('hide');      
             $('#startEditRideInput #editRideFromAddress').toggleClass('ignore');
             $("#toEditRideInput #editRideToAddress").toggleClass('ignore');     
             $("#editRideStartLocation,#editRideFromAddress").toggleClass(
                                                                    'isShown');
             $("#editRideToAddress,#editRideToStartLocation").toggleClass(
                                                                    'isShown');    
           }
            airportName = res.to;
            driverAddress = res.start;
            $("#editRideFromAddress").val(res.start);
            $("#editRideToStartLocation").select2('val',res.to); 
            $('#startLabel').html('Address');
            $('#toLabel').html('Airport');
     }
     else if(res.startType == AIRPORT_START)
     {                  
          if($('#editRideFromAddress').hasClass('isShown'))
          {
            $("#startEditRideSelect,#startEditRideInput").toggleClass('hide');   
            $("#toEditRideInput,#toEditRideSelect").toggleClass('hide');  
            $("#startEditRideInput #editRideFromAddress").toggleClass('ignore');
            $("#toEditRideInput #editRideToAddress").toggleClass('ignore'); 
            $("#editRideStartLocation,#editRideFromAddress").toggleClass(
                                                                    'isShown');
            $("#editRideToAddress,#editRideToStartLocation").toggleClass(
                                                                    'isShown');   
          }
            airportName = res.start;
            driverAddress = res.to;
            $('#editRideStartLocation').select2('val',res.start); 
            $('#editRideToAddress').val(res.to); 
            $('#startLabel').html('Airport');
            $('#toLabel').html('Address');  
     }
      
    var isSmoker = res.smoker==1 ? 'checked' : ''; 
    $('#smoker').prop('checked',isSmoker);
        
    $( "#editRideLocation" ).getSlider('editRideRange',' Miles');
    $( "#editRidePriceSlider" ).getSlider('editRidePriceRange',null,'$',0.01);
    var price = getPriceForRide(airportName,driverAddress,$('#maxDistance').text());
    $('#editRidePriceSlider').slider("option","max",price);
    $('#editRidePriceSlider').slider("option","disabled",false);
    $('#editRidePriceRange').html(res.contribution);
    $( "#editRidePriceSlider" ).slider( "value",res.contribution );
    $("#editRideLocation").slider( "value",res.maxMiles);
    $( "#editRideRange" ).html( $( "#editRideLocation" ).slider( "value" ) + 
                                                            ' Miles');
    $( "#editRidePriceRange" ).html( '$'+res.contribution ); 
        $('#maxPrice').html(price);
           
     // add the validation method and rules
    $.validator.addMethod('minStrict', function (value, el, param) {
               var newDateTime = $('#editRideDateTime').val()+' '+
                                $('#editRideTime').val();
               value = new Date(newDateTime).getTime();
               return value > param;
           }); 
    $('#editRideTime').rules( "add", {
            required: true,
            minStrict: new Date().getTime(),
            messages: {
            required: "Please enter time",
            minStrict: jQuery.format("Time should  be greater than current time")
            }
         });
}

//function delete item
function deleteItem
(
    itemId
)
{ 
    var res = -1;
    var dataToSend  = {
        "action"    : DELETE_ITEM,
        "itemId"    : itemId
    }
    $.ajax({
        type     : "POST",
        url      : API_URL,
        data     : dataToSend,                    	                    
        dataType : "json",
        headers  : HEADER,
        error    : function (e) 
        {  
            res = -1;
        },
        success  : function(jsonResult)
        { 
            res = jsonResult.retCode;
        }
    });

    return res;
}


//function get driver mail body
function getLiftMailBody
(
    msgType,
    lift
)
{
    var name   = lift.firstName + " " + lift.lastName; 
    var date = $.getDateTime.formatDate(lift.dt);
    var time = $.getDateTime.formatTime(lift.dt);
    var smoker = lift.smoker == true ? 'yes' : 'No';
    var emailBody = '<div><p><strong>Dear '+ 
                    name +'</strong>,</p><br />';

    // confirm the ride request                
    if (msgType == 1)
    {
        emailBody +='<p>Your request for the ride has been accepted by ' + 
                    'the driver.</p>';
        emailBody +='<p>Please login into your acccount and pay for the ' + 
                    'ride. </p>';
    }
    else
    {
        emailBody +='<p>Your request for the ride has been rejected by ' + 
                    'the driver.</p>';
        emailBody +='<p>Please login into your account and find another  ' + 
                    'driver. </p>';
    }

    emailBody +='<p><strong>Request Detail</strong></p>';
    emailBody +='<table border="1px">';
    emailBody +='<tr><td>Date</td><td>'+
                date+'</td></tr>';
    emailBody +='<tr><td>Time</td><td>'+
                time+'</td></tr>';
    emailBody +='<tr><td> From </td><td>'+
                lift.start+'</td></tr>';
    emailBody +='<tr><td> To </td><td>'+
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


//function get driver mail body
function getConfirmNumMailBody
(
    ride,
    lift
)
{    
/*
var amount    = lift.contribution;
var name      = ride.firstName + " " + ride.lastName; 
var date      = $.getDateTime.formatDate(lift.dt);
var time      = $.getDateTime.formatTime(lift.dt);
var emailBody = '<div><p><strong>Dear '+ 
                name +'</strong>,</p><br />';

emailBody    += "This is a confirmation that " + 
                "we have received your " + 
                "confirmation code. Your payment " + 
                "in the amount of $" + amount + 
                " will be issued within 24 hours. " + 
                "It may take additional time for " + 
                "the [L] transaction to " + 
                "occur depending upon the method " + 
                "[L] of payment you have " + 
                "chosen.  Thanks, "
emailBody +='<p>Airpnd Team.</p>';
emailBody +='<p><sub><i>This is a system generated';
emailBody +='&nbsp;mail. Please do not reply to it.';
emailBody +='</i><sub></p></div>';
*/    
    var name   = ride.firstName + " " + ride.lastName; 
    var date = $.getDateTime.formatDate(lift.dt);
    var time = $.getDateTime.formatTime(lift.dt);
    var emailBody = '<div><p><strong>Dear '+ 
                    name +'</strong>,</p><br />';
    var smoker = lift.smoker == true ? 'yes' : 'No';

    emailBody  ='<p>This is a confirmation that we have received your ' + 
                'confirmation code. Your payment ' + 
                'will be issued within 24 hours. It may take additional ' + 
                'time for the transaction to occur depending upon the method ' + 
                'of payment you have chosen.</p>'; 
    emailBody +='<p><strong>Request Detail</strong></p>';
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


// for booking prefrence 
$(window).bind('beforeunload',function()
{  
        if($('#myRidesContainer-nav-select').is(':visible'))
        {
            var tabId = $('#myRidesContainer-nav-select option:selected').val().
            split('tab')[1];
            $.session.set('selectedTabMyBooking',tabId);   
        }
        else
        {
            $('#myRidesContainer-nav-ul li').each(function(i){
                if($('a',this).hasClass('current'))
                {
                    var tabId = $('a',this).attr('href').split('#')[1];
                    $.session.set('selectedTabMyBooking',tabId);
                }
            });
        }
});
/* End of file commentMyBookings.js */
/* Location: ./js/commentMyBookings.js */  
