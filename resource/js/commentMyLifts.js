/**
 * @file       commentMyLifts.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for my lifts.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added my lifts page functionality and
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    05/28/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    remove the miles 
 * @revDate    06/02/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    remove the miles and update the function.
 * @revDate    06/20/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    fixing issue of bags
 */ 

$(function(){
    // disable submit
    $(window).keydown(function(event){
        if(event.keyCode == 13) 
        {
            event.preventDefault();
            return false;
        }
    });
    //load lifts
    myLifts();
    var autocomplete;
     $('#myLiftbagSizeSelect').select2();
     $('#editLiftSeat').select2();
     getSeats('editLiftSeat');
     getBagTypes('myLiftbagSizeSelect');
    // Create the autocomplete object, restricting the search
    // to geographical location types.   addressFindRider

     //get locations from google
    $('#editLiftToLocation,#editLiftToStartLocation').keyup(function(e){
       geoLocation();  
      
    });
       
    autocomplete = new google.maps.places.Autocomplete(   
    (document.getElementById('editLiftToAddress')), 
        { types: ['geocode'] });
    
    autocomplete = new google.maps.places.Autocomplete(   
    (document.getElementById('editLiftFromAddress')), 
        { types: ['geocode'] });
    // When the user selects an address from the dropdown,
    // populate the address fields in the form.
    google.maps.event.addListener(autocomplete, 'place_changed',
    function() {
    });    
        
    $('[rel="tooltip"]').tooltip();
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
            retCode = processPayment($.session.get('amount'));
        }
    }).settings;

    paymentForm.rules.membershipType =
    {
        required:true
    }

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

        
    $(document).on('change', '#myLiftsContainer-nav-select', function(){
            $('#rideAssignedPanel').addClass('hide');
    }); 
        
    $('.closeModal').on('click',function(){
        $('#editLiftModal').modal('hide'); 
        $('.popover').remove();
      
    });
    
     // swap start and to address
    $(document).on('click','.exchange',function()
    {                                
        $("#startLocation,#toLocationStart").toggleClass('hide');  
        $("#toLocation,#toStartLocation").toggleClass('hide');  
        $("#editLiftStartLocation,#editLiftFromAddress").toggleClass(
                                                                'isShown');  
        $("#editLiftToAddress,#editLiftStartLocationTo").toggleClass(
                                                                'isShown'); 
        $('#toLocationStart .myLiftLocationInput').toggleClass('ignore');
        $('#toLocation .myLiftLocationInput').toggleClass('ignore');
        
        var fromLocation = $('#editLiftStartLocation option:selected').val();
        var fromAddress  = $('#editLiftFromAddress').val();  
        var toAddress    = $('#editLiftToAddress').val(); 
        var toLocation   = $('#editLiftStartLocationTo option:selected').val();
        
        $('#editLiftStartLocationTo').select2('val',fromLocation);  
        $('#editLiftFromAddress').val(toAddress) ;
        $('#editLiftToAddress').val(fromAddress); 
        $('#editLiftStartLocation ').select2('val',toLocation);
        
        //code for label toggling
        if(!$('#editLiftFromAddress').hasClass('ignore')) 
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
   
    
    //confirm ride
    $(document).on('click','#confirmLift',function()
    {
        var liftId    = $(this).attr('for')
        var isPending = pendingPaymentLift(liftId);
        if(isPending)
        {
            var liftData  = JSON.parse($.session.get('liftData'));
            var ride      = liftData[liftId].ride;

//            var res     =  getARide(rideData.rideId);
//            var ride    =  res.ride;                    
            var msg ='<p>You offer for the drive has been accepted ' + 
                     'by the rider.</p>';
            var driverEmailBody = getDriverMailBody(ride, msg);             
            var hasMailSent     = sendEmail(ride.email,'AirPnd - Accept the Ride Offer',
                                            driverEmailBody);              
            
            if(hasMailSent)
            {   
                var textMsgSent = true;
                if (ride.textYes == 1)
                {
                    var msg = "Your ride request was accepted by the rider. " + 
                              "Once the rider pays for the ride, you will  " + 
                              "receive another notice. " + SITE_URL;                     
                    
                    textMsgSent = sendDriverMsg(ride, msg);                    
                }
                
                if (textMsgSent)
                {
                    var message = 'Lift status has been changed to pending ';
                        message+= 'payment. Please pay to confirm the lift.';
                    showAlertBox('Confirmation Alert',
                                message, 
                                SITE_URL+'myLifts.php');
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

    //reject ride offer
    $(document).on('click','#rejectLift',function()
    {
        var liftId = $(this).attr('for'); 
        var retCode = rejectARide(liftId);
        if(retCode)
        {
            var liftData  = JSON.parse($.session.get('liftData'));
            var ride      = liftData[liftId].ride;

//            var res     =  getARide(rideData.rideId);
//            var ride    =  res.ride;                    
            var msg ='<p>You offer for the drive has been rejected ' + 
                     'by the rider.</p>';
            msg +='<p>Please find another rider for your ride.</p>';
            var driverEmailBody = getDriverMailBody(ride, msg);             
            var hasMailSent     = sendEmail(ride.email,'AirPnd - Reject the Ride Offer',
                                            driverEmailBody);              
            
            if(hasMailSent)
            {   
                var textMsgSent = true;
                if (ride.textYes == 1)
                {
                    var msg = "Your ride request was rejected by the rider. " + 
                              "Please login into airpnd to find another " + 
                              "rider. " + SITE_URL;                     
                    
                    textMsgSent = sendDriverMsg(ride, msg);                    
                }
                
                if (textMsgSent)
                {
                    showAlertBox('Alert',
                    'Ride offer was rejected and an email was sent out to the driver.',
                    SITE_URL+'myLifts.php');
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

    
    // when click on pay
    $(document).on('click','.pay',function()
    {
        $.session.set('liftId',$(this).attr('liftId'));
        var result = getLiftById($.session.get('liftId')); 
        if(!result.retCode || result.lift == null || 
           result.lift.rideId <= 0)
        {     
            $('.closeModal').closest('#paymentModal').modal('hide');
            var msg = 'Please contact the customer support.';
            msg+=' You can not pay untill it has a ride. '
            showAlertBox('Error',msg);
        }
        else
        {
        
            $.session.set('rideId',result.lift.rideId);
            $.session.set('amount',result.lift.contribution);                
            amount = "$" + result.lift.contribution;
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
                addr+=$('response address2',customerDetails).text() + ',';
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
    });

    //edit lift
    $(document).on('click','.editLift',function()
    {
        var liftData = JSON.parse($.session.get('liftData'));
        $.session.set('liftId',$(this).attr('for'));
        loadLiftInfo(liftData[$(this).attr('for')])
        moveTotop();
        $('#editLiftModal').modal('show');
        return false;
    });

    //show associated lifts
    $(document).on('click','.showRide',function()
    {
        $.session.set('liftId',$(this).attr('for'));
        var liftStatus = $(this).attr('forStatus');
        var liftData = JSON.parse($.session.get('liftData'));
        loadAssignedRide(liftData[$(this).attr('for')], liftStatus);            
        return false;
    });

    // datetimepicer initlization
    $('#requestRideDateTime').dateTimePicker();

    //to open datepicker on click of icon
    $('.icon-calendar').on('click',function(){
        $(this).closest('div').children('input[type="text"]').
        datetimepicker('show');
    });
    // open timepicker on click of icon
    $('.add-on').on('click',function(){
        $('#editLiftTime').timepicker('show');
    });
    
    $(document).on('click','.editLift',function()
        {
            $.session.set('customerId',$(this).attr('for'));
            $('#editLiftModal').modal('show');
    });
     // delete lift
    $(document).on('click','.deleteLift',function()
    {       
        var liftId = $(this).attr('for');  
        bootbox.confirm("Do you want to delete this record ?", 
        function(result)
        {        
            if(result)
            {            
                deleteLift(liftId);
            }
        }); 
    });

    var editLift =   $("#editLiftForm").validate(
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
                    getErrorPopupTemplate(value);
                });
            },
            rules:
            {
                editLiftDateTime : 
                {
                    required:true,
                    date:false
                },
                editLiftTime : 
                {
                    required:true,
                    date:false
                },
                editLiftToAddress : 
                {
                    required:true
                },
                  editLiftFromAddress : 
                {
                    required:true
                },
                editLiftViaLocation : 
                {
                    required:true
                },
                editLiftSeat : 
                {
                    required:true
                }
            },
            messages:
            {
                editLiftDateTime:
                {
                    required:VALIDATION_ERROR_MSG_SELECT.replace('{element}',
                        'date')
                },
                editLiftTime:
                {
                    required:VALIDATION_ERROR_MSG_SELECT.replace('{element}',
                        'time')
                },
                editLiftToAddress:
                {
                    required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                        'drop off point')
                },
                
                 editLiftFromAddress:
                {
                    required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                        'pick up point')
                },
                editLiftViaLocation:
                {
                    required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                        'via point')
                },
                editLiftSeat:
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

                $('#editLiftLoader').removeClass('hide');
                $('#updateLift').attr('disabled','disabled');
                updateLift();
            }
    }).settings;

    editLift.rules.editLiftStartLocation ={required:true};
    editLift.messages.editLiftStartLocation =
    {
        required:VALIDATION_ERROR_MSG_SELECT.replace('{element}',
            'pick up point')
    };
});

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

//function my lifts
function myLifts
(
)
{
    var customerId = sessionManager('getSession','customerId');
    if(customerId)
    {
        initializeModal('editLiftModal');
        getLocation('editLiftStartLocation');
        getLocation('editLiftStartLocationTo',true);
        
        $('#editLiftToLocation').filterType('special');
        $('#editLiftViaLocation').filterType('special');  
        $('#editLiftSeat').filterType('numeric');  
       // $('#editLiftNote').filterType('special');  
        $('#editLiftDateTime').datePicker();
        $('#editLiftTime').timePicker();
        $('#zipCode').filterType('numeric');
        $('#ccNumber').filterType('numeric');
        $('#cvv').filterType('numeric');
        $('#city').filterType('alpha');
        $('#firstNamePayment').filterType('alpha');
        $('#middleNamePayment').filterType('alpha');
        $('#lastNamePayment').filterType('alpha');
        
        initializeModal('paymentModal');    
        bindSelectBox('ccExpMonth',months);
        bindCustomSelectBox('ccExpYear',years);
        bindCustomSelectBox('ccType',cardTypes);
        bindStateBox();
        
        var res = liftsByCustomer(customerId);    
        loadMyLifts(res);
        var hideSideArrows = (res.lifts == null || res.lifts.length == 1
                                                || res.lifts.length == 0);
        $('#myLiftsContainer').contentSlider('My Lifts',hideSideArrows,
                                      $.session.get('selectedTabMyLift'));
    }
    else
    {
        loadSignInModal();
    }
}

// function load my lifts
function loadMyLifts
(
    result
)
{
    var htmlBody='';
//    var rideData = {};
    var liftData = {};
    if(result.retCode && result.lifts.length > 0)
    {         
        result = sortByKey(result.lifts,'dt','0'); 
        $.each(result,function(index,item){       
                liftData[item.id] = item;
                var isEditable = item.editable == 1;
                rideId = parseInt(item.ride.rideId);
                var hasRide = (rideId && rideId != NO_ID) 
                              ? true : false;
                var canConfirm = item.status == PENDING_CONFIRM; 
                var canPay = item.status == PENDING_PAYMENT;
                var canDelete = !hasRide && item.status == NEW_LIFT;
                var from = item.startType == AIRPORT_START ? 
                                                    "Airport" : "Address"
                var to   = item.startType == ADDRESS_START ? 
                                                    "Airport" : "Address"
          
                var note = item.note || '-';
                var seats = item.seats || '-';
                var smoker = item.smoker == true? 'yes': 'No';
                var date = $.getDateTime.formatDate(item.dt);
                var time = $.getDateTime.formatTime(item.dt);

                htmlBody+='<div><h2 class="title greenLabel">'+date+'</h2>';
                htmlBody+='<table class="table table-striped"><tbody>';
                htmlBody+='<tr class="tdHeader"><td width="105"><a href="#"';
                htmlBody+=' for="'+item.id+'"';
                htmlBody+=' forStatus="' + item.status+'"'; 
                htmlBody+='class="showRide"><i class="icon-th"></i>&nbsp;';
                htmlBody+='Show Drivers</a></td><td colspan=2>';
/*
                if(canConfirm)
                {                    
                    htmlBody+='<a href="#" class="confirmLift margin-right "';
                    htmlBody+=' liftId="'+ item.id +'">Confirm';
                    htmlBody+='</a>';
                }
*/
                if(canPay)
                {
                    htmlBody+='<a href="#" for="'+item.id+'"';
//                    htmlBody+=' forStatus="' + item.status+'"'; 
//                     htmlBody+='<a href="#"';
                     htmlBody+= ' class="pay" liftId="'+item.id+'">Pay Now</a>';
                }
                htmlBody+='</td><td class="pull" colspan=2>';
                if(isEditable)
                {
                    htmlBody+='<a href="#" for="'+item.id+'"';
//                    htmlBody+=' forStatus="' + item.status+'"'; 
//                    htmlBody+='<a href="#"';
                    htmlBody+=' customerId="'+item.customerId +'"';
                    htmlBody+=' startType='+item.startType;
                    htmlBody+=' class="editLift margin-right '+isEditable+'">';
                    htmlBody+='<i class="icon-pencil"></i>&nbsp;Edit</a>';
                }
                if(canDelete)
                {
//                    htmlBody+='<a href="#" for="'+item.id+'"';
//                    htmlBody+=' forStatus="' + item.status+'"'; 
                    htmlBody+='<a href="#" for="'+item.id+'"';
                    htmlBody+=' customerId="'+item.customerId +'"';
                    htmlBody+=' class="deleteLift pull ">';
                    htmlBody+='<i class="icon-trash"></i>&nbsp;Delete';
                    htmlBody+='</a>';
                }                
                htmlBody+='</td></tr>';
                htmlBody+='<tr><td colspan=2>Date</td><td colspan=2>'+
                            date+'</td colspan=2></tr>';
                htmlBody+='<tr><td colspan=2>Time</td><td colspan=2>'+
                            time+'</td colspan=2></tr>';
                htmlBody+='<tr><td colspan=2>'+from+'</td>';
                htmlBody+='<td colspan=2>'+item.start+'</td></tr><tr>';
                htmlBody+='<tr><td colspan=2>'+to+'</td><td colspan=2>'+
                            item.to+'</td></tr>';
                htmlBody+='<tr><td colspan=2>Seats</td><td colspan=2>'+
                            seats+'</td></tr>';
                htmlBody+='<tr><td colspan=2>Smoker</td><td colspan=2>'+
                            smoker+'</td></tr>';                            
                htmlBody+='<tr><td colspan=2>Status</td><td colspan=2>'+
                          getLiftStatusName(item.status);
                htmlBody+='<tr><td colspan=2>Bags</td><td colspan=2>'+
                            item.bags;            
                htmlBody+='</td></tr>';
                htmlBody+='<tr><td colspan=2>Bag Size</td><td colspan=2>'+
                            (getBagSizeName(item.bagSize) || '-')+
                            '</td ></tr>';
                htmlBody+='<tr><td colspan=2>Note</td>';
                htmlBody+='<td class="textBreak" colspan=2>';
                htmlBody+=note+'</td></tr>';
                htmlBody+='</tbody></table></div>';
        }); 

        $.session.set('liftData',JSON.stringify(liftData));
    }
    else
    {
        htmlBody = '<div><h2 class="greenLabel">No lift is found.</h2></div>';
    }     
    $('#myLiftsContainer').append(htmlBody);
}

//function update a lift
function updateLift
(
)
{
    var startAddress =  $('#startLocation').css('display') != 'none' ?  
                  $('option:selected','#editLiftStartLocation').val() : 
                  $('#editLiftFromAddress').val();
    var toAddress =  $('#toLocation').is(':visible')?  
                  $('#editLiftToAddress').val() : 
                  $('option:selected','#editLiftStartLocationTo').val(); 
    var startType =     $('#startLocation').css('display') != 'none' ?
                        AIRPORT_START : ADDRESS_START;                    

    var dateTime = $('#editLiftDateTime').val();
    var time = $.getDateTime.time($('#editLiftTime').val(),true);
   // var miles    = $('#editLiftRange').html().split(' ')[0];
    var lift = 
    {
        'id'         : $.session.get('liftId'),
        'date'       : dateTime,
        'time'       : time,
        'start'      : startAddress,
        'to'         : toAddress,
        'startType'  : startType,
        'via'        : '',
        'maxMiles'   : '',
        'seats'      : $('#editLiftSeat option:selected').val(),
        'smoker'     : $('#smoker').is(':checked'),
        'bags'       : $('#editLiftBags').val(),
        'bagSize'    : $('#myLiftbagSizeSelect option:selected').val(),
        'note'       : $('#editLiftNote').val()
    };
    var dataToSend = 
    {
        "action"     : UPDATE_A_LIFT,
        "lift"       : JSON.stringify(lift)
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
            $('#editLiftLoader').addClass('hide');
            $('#updateLift').removeAttr('disabled');
            $('#editLiftModal').modal('hide');
            showAlertBox('Error',ERROR_MSG);  
        },
        success    : function(jsonResult)
        { 
            $('#editLiftLoader').addClass('hide');
            $('#updateLift').removeAttr('disabled');
            $('#editLiftModal').modal('hide');
            if(jsonResult.retCode)
            {       
                showAlertBox('Update Alert',
                    'Your changes have been saved.',
                    SITE_URL + 'myLifts.php');
            }
        }        
    });
}

//function delete a lift
function deleteLift
(
    liftId
)
{         
    var dataToSend = 
    {
        "action"     : DELETE_A_LIFT,
        "liftId"     : JSON.stringify(liftId)
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
                    SITE_URL + 'myLifts.php');
            }
        }        
    });
}

//function load assigned rides
function loadAssignedRide
(
    result,
    liftStatus
)
{
    $('#rideAssignedContainer').empty();
    var htmlBody = '';
 
    if(parseInt(result.ride.rideId) > 0)
    {
        var liftId  = $.session.get('liftId');
        var ride    = result.ride;
        var name;
        var email;
        var phone;
        canConfirm = false;
        canReject  = false;
        if (result.status == PENDING_CONFIRM_DRIVER)
        {
            canConfirm = true;
            canReject  = true;
        } 
        
        // if the lift has been paid
        if (isLiftPaid(liftStatus))
        {
            name  = ride.firstName +' '+ride.lastName;    
            phone = ride.phone;
            email = ride.email;
        }
        else
        {
            name      = "-";
            email     = "-";
            phone     = "-";
        }
                
        var date = $.getDateTime.formatDate(ride.dt);
        var time = $.getDateTime.formatTime(ride.dt);
        
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
        
        
        htmlBody+='<tr><td>Name</td><td>'+name+'</td></tr>';
        htmlBody+='<tr><td>Email Id</td><td>'+email+'</td></tr>';
        htmlBody+='<tr><td>Phone</td><td>'+phone+'</td></tr>';
        htmlBody+='<tr><td>Date</td><td>'+date+'</td></tr>';
        htmlBody+='<tr><td>time</td><td>'+time+'</td></tr>';
        htmlBody+='<tr><td>Seats</td><td>'+result.seats+'</td></tr>';
        htmlBody+='<tr><td>Note</td><td >' + (ride.notes || '-') + '</td>';
        htmlBody+='</tr>' ;  
    }
    else
    {
        htmlBody += '<tr><td colspan="99"><h4 class="greenLabel">No ride is ';
        htmlBody +='assigned with this lift.</h4></td></tr>'; 
    }
    $('#rideAssignedContainer').append(htmlBody);
    $('#rideAssignedPanel').removeClass('hide');
}


//function confirm a lift
function pendingConfirmALift
(
    liftId
)
{
    var dataToSend = 
    {
        "action"     : PENDING_CONFIRM_A_LIFT,
        "liftId"      : JSON.stringify(liftId)
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
                var message = 'Lift status has been comfirmed.';
                showAlertBox('Confirmation Alert',message,
                                SITE_URL+'myLifts.php');
            }
        }        
    });
}

//function pending payment a lift
function pendingPaymentALift
(
    liftId
)
{
    var dataToSend = 
    {
        "action"     : PENDING_PAYMENT_A_LIFT,
        "liftId"      : JSON.stringify(liftId)
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
                var message = 'Lift status has been changed to pending confirm.';
                    message+= ' Please pay to confirm the lift.';
                showAlertBox('Confirmation Alert',message, 
                                SITE_URL+'myLifts.php');
            }
        }        
    });
}


//function load lift info
function loadLiftInfo
(
    res
)
{     
    var date = $.getDateTime.formatDate(res.dt);
    var time = $.getDateTime.formatTime(res.dt);
    var bags = res.bags == null ? 0 : res.bags;
    $('#editLiftDateTime').val(date);
    $('#editLiftDateTime').datePicker(date);
    var currentDate =  new Date().getTime();   
    var liftDate =  new Date(res.dt).getTime();
    if(liftDate <  currentDate)
    {
     time = $.getDateTime.formatTime(new Date());
    } 
    
     // remove error class
     $('#editLiftForm').find('input').each(function(){
        if($(this).hasClass('error'))
        {
               $(this).removeClass('error');
        }
    });
    
    $('#editLiftTime').val(time)
    $('#editLiftTime').timePicker(time) 
    $('#editLiftViaLocation').val(res.via);
    $('#editLiftSeat').select2('val',res.seats); 
    $('#editLiftNote').val(res.note);
    $('#editLiftBags').val(bags);
    $('#myLiftbagSizeSelect').select2('val',res.bagSize);
    $('#smoker').prop('checked',res.smoker)
     
     if(res.startType == ADDRESS_START)
     {
          if($('#editLiftToAddress').hasClass('isShown'))
          {
             $("#startLocation,#toLocationStart").toggleClass('hide');
             $("#toLocation,#toStartLocation").toggleClass('hide');                        
             $("#editLiftStartLocation,#editLiftFromAddress").toggleClass(
                                                                    'isShown');   
             $('#editLiftToAddress,#editLiftStartLocationTo').toggleClass(
                                                                    'isShown');   
             $('#toLocationStart .myLiftLocationInput'). toggleClass('ignore');  
             $('#toLocation .myLiftLocationInput'). toggleClass('ignore');      
          }
             $("#editLiftFromAddress").val(res.start);
             $("#editLiftStartLocationTo").select2('val',res.to); 
             $('#startLabel').html('Address');
             $('#toLabel').html('Airport');
      }
     else if(res.startType == AIRPORT_START)
     {
          if($('#editLiftFromAddress').hasClass('isShown'))
          {
              $('#startLocation,#toLocationStart').toggleClass('hide'); 
              $('#toLocation,#toStartLocation').toggleClass('hide');                        
              $("#editLiftStartLocation,#editLiftFromAddress").toggleClass(
                                                                   'isShown');   
              $('#editLiftToAddress,#editLiftStartLocationTo').toggleClass(
                                                                    'isShown');   
              $('#toLocationStart .myLiftLocationInput').toggleClass('ignore');
              $('#toLocation .myLiftLocationInput').toggleClass('ignore');
          }
             $('#editLiftStartLocation').select2('val',res.start); 
             $('#editLiftToAddress').val(res.to); 
             $('#startLabel').html('Airport');
             $('#toLabel').html('Address');  
     }
       
    var isSmoker = res.smoker==1 ? 'checked' : '';
    $('#smoker').prop('checked', isSmoker); 

    var maxMiles = res.maxMiles || 30;
    $( "#editLiftLocation" ).getSlider('editLiftRange',' Miles',null,
        maxMiles);    
    $( "#editLiftRange" ).html( $( "#editLiftLocation" ).slider( "value" ) + 
        ' Miles');
        
     // add the validation method and rules
    $.validator.addMethod('minStrict', function (value, el, param) {
               var newDateTime = $('#editLiftDateTime').val()+' '+
                                 $('#editLiftTime').val();
               value = new Date(newDateTime).getTime();
               return value > param;
           }); 
       $('#editLiftTime').rules( "add", {
         required: true,
         minStrict: new Date().getTime(),
         messages: {
         required: "Please enter time",
         minStrict: jQuery.format("Time should  be greater than current time")
          }
       });
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
                result = result.entities || result.regions;
                $.each(result, function(i,item)
                    {                 
                        $('#state').append('<option value="' + 
                            item.code + '">'+
                            item.name + '</option>') ;
                });
            }
        }
    });

    $('#state').select2();
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

// for lift prefrence
$(window).on('beforeunload',function(){
    if($('#myLiftsContainer-nav-select').is(':visible'))
    {
        var tabId = $('#myLiftsContainer-nav-select option:selected').val().
        split('tab')[1];
        $.session.set('selectedTabMyLift',tabId);    
    }
    else
    {
        $('#myLiftsContainer-nav-ul li').each(function(i,item){
            if($('a',this).hasClass('current'))
            {
                var tabId = $('a',this).attr('href').split('#')[1];
                $.session.set('selectedTabMyLift',tabId);
            }
        });
    }
});

//function get driver mail body
function getDriverMailBody
(
    ride,
    msg
)
{
    var smoker = ride.smoker == true ? 'yes' : 'No';
    var name   = ride.firstName + " " + ride.lastName;
    var date = $.getDateTime.formatDate(ride.dt);
    var time = $.getDateTime.formatTime(ride.dt);
    
    var emailBody = '<div><p><strong>Dear '+ 
                    name +'</strong>,</p><br />';
//    emailBody +='<p>You offer for the drive has been rejected by the rider.</p>';
//    emailBody +='<p>Please find another rider for your ride.</p>';
    emailBody += msg;
    emailBody +='<p><strong>Driver Request Detail</strong></p>';
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


// send text message to the rider
function sendDriverMsg
(
    ride,
    msg
)
{
    var phoneNumber =  ride.phone;   
//    var name        =  $('response returnVal firstName',owner).text()
//                       +' '+  $('response returnVal lastName'
//                                                        ,owner).text();                       
    phoneNumber     =  phoneNumber.split('-').join('');
  
//    var msg         =  $('#messageContent').val() +'\n'+' '+ SITE_URL+
//                        'confirmRider.php' + link;
    var hasSent     =  sendTextMessage(phoneNumber, msg);
    return hasSent;        
}


/* End of file commentMyLifts.js */
/* Location: ./js/commentMyLifts.js */  