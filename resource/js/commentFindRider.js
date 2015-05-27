/**
 * @file       commentFindRider.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for find rider.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added search rider functionality and
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    fixed issue and done with minor formatting
 * @revDate    05/28/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    remove the miles 
 * @revDate    06/02/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    updated the functionality for previous search.
 * @revDate    06/17/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added the date time  restriction  validation
 * @revDesc    updated functionality for SMS.
 * @revDate    06/20/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 * @revDate    06/30/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    fix minor alingment issues
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
       
    var autocomplete;
    $.session.clear('hasRide'); 
    validateForm();   
    $('#bagSizeSelect').select2();
    $('#seatsFindRider').select2();
    getSeats('seatsFindRider')
    getBagTypes('bagSizeSelect');
    getLocation('locationFindRider',true,false);
    getLocation('locationFindRider',true,true);
    
    // Create the autocomplete object, restricting the search
    // to geographical location types.   addressFindRider
    if($('#toAddress').css('display') != 'none')
    {
        autocomplete = new google.maps.places.Autocomplete(   
        (document.getElementById('geoLocation')), 
        { types: ['geocode'] });
    }

    autocomplete = new google.maps.places.Autocomplete(
    /** @type {HTMLInputElement} */
    (document.getElementById('addressFindRider')),
    { 
        types: ['geocode'] 
    });
    
    // When the user selects an address from the dropdown,
    // populate the address fields in the form.
    google.maps.event.addListener(autocomplete, 'place_changed', function(){
    });

    var pageName = window.location.pathname.toLowerCase();
    if($.session.get('pageLocation'))
    {
        $('.locationFindRider').select2('val',$.session.get('pageLocation'));
        $.session.clear('addressFindRider');    
    }
     // validate whether user is logged in.
    isLoggedInUser();
    $('#time').timePicker(); 
    $('#date').datePicker(); 
    var date = new Date();
    $.validator.addMethod('minStrict', function (value, el, param) {
        value = $.getDateTime.time($('#time').val(),true).split(':')[1] ;
        return value > param;
    });
                         
    $( "#time" ).rules( "add", {
        required: true,
        minStrict: date.getMinutes(),
        messages: {
        required: "Required input",
        minStrict: jQuery.format("Please select correct time")
        }
        });
                           
    //get locations from google
    $('#addressFindRider,.addressFindRider').keyup(function(e){
        geoLocation();
    });
   
    //set  the search fields
//    if( $.session.get('addressFindRider') != null && isLoggedIn())
    if( $.session.get('addressFindRider') != null)
    {
        if( $.session.get('addressType') == ADDRESS_START)
        {
            if($('#geoLocation').hasClass('isShown'))
            {
                $("#fromLabelLoc,#addressFindRiderFrom").toggleClass(
                                                            'hide');
                $("#toLabelAdd,#toAddress").toggleClass('hide');
                $("#locationFindRider,#geoLocation").toggleClass(
                                                            'isShown');
                $("#addressFindRider,#fromSelect").toggleClass(
                                                            'isShown');
            } 
            $('#addressFindRider').val( 
                                    $.session.get('addressFindRider'));
            $('#locationFindRider').select2('val',
                                     $.session.get('locationFindRider'));
            $('#startLabel').html('Address');
            $('#toLabel').html('Airport');
        }
        else if($.session.get('addressType') == AIRPORT_START)
        {
            if($('#addressFindRider').hasClass('isShown'))
            {
                $("#fromLabelLoc,#addressFindRiderFrom") .toggleClass(
                                                            'hide'); 
                $("#toLabelAdd,#toAddress").toggleClass('hide');
                $("#locationFindRider,#geoLocation").toggleClass(
                                                            'isShown');
                $("#addressFindRider,#fromSelect").toggleClass(
                                                            'isShown');
            } 
            $('#fromSelect').select2('val',
                                 $.session.get('locationFindRider'));
            $('#toAddress .addressFindRider').val(
                                    $.session.get('addressFindRider'));
            $('#startLabel').html('Airport');
            $('#toLabel').html('Address');  
        }
        $('#seatsFindRider').select2('val',
                                     $.session.get('seatsFindRider'));
        $('#bagSizeSelect').select2('val',
                                    $.session.get('bagSizeFindRider'));
        $("#date").datePicker( $.session.get('dateFindRider'));
        $("#bagsFindRider").val($.session.get('bagsFindRider'));        
        $("#time").val($.session.get('timeFindRider'));                
        $("#time").timePicker($.session.get('timeFindRider'));  
        $("#smoker").prop('checked',parseInt(
            $.session.get('smokerFindRider')) == 1 ? true : false );
    }
   
     // show timepicker when click on icon
    $('.icon-time').on('click',function(){       
       $('#time').timepicker('show');         
    });           
    
    // show datepicker when click on icon
    $('.icon-calendar add-on').on('click',function(){
          $(this).closest('div').children('input[type="text"]').
            datepicker('show');
    });
      // remove the error message from date
    $('#date').on('click',function(e){         
        $(this).next('.popover').remove(); 
        $(this).removeClass('error');
    }) ;
     // remove the error message from date
    $('#date').on('blur',function(e){          
        $(this).next('.popover').remove(); 
        $(this).removeClass('error');
    }) ;
    
   // swap to and from address
    $(document).on('click','.exchange',function(){   
        $("#fromLabelLoc,#addressFindRiderFrom,#toLabelAdd,#toAddress").
            toggleClass('hide');
        $("#locationFindRider,#geoLocation,#addressFindRider,#fromSelect")
        .toggleClass('isShown'); 
        $("#addressFindRiderFrom .airspndLocation").toggleClass('ignore');
        $("#toAddress .addressFindRider").toggleClass('ignore');
        var fromLocation = $('.locationFindRider option:selected').val();
        var fromAddress  = $('#addressFindRider').val();                
        var toAddress    = $('.addressFindRider').val(); 
        var toLocation   = $('#locationFindRider option:selected').val();
            
            // for upper part     
        $('.locationFindRider').select2('val',toLocation);
        $('#addressFindRider').val(toAddress);

        //for second part
        $('.addressFindRider').val(fromAddress);
        $('#locationFindRider').select2('val',fromLocation);

            //code for label toggling
        if(!$('#addressFindRider').hasClass('ignore')) 
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
       //load ride info on left section
    $(document).on('click','.selectRide',function(e)
    {
        var startType = $(this).attr('startType');
        var parent = $(this).closest('table');
        $.session.set('rideId',$(this).attr('rideId'));
        $.session.set('customerId',$(this).attr('customerId'));
        $.session.set('hasRide',true);
        var dateTime = $(this).attr('date'); 
        var time = $.getDateTime.formatTime(dateTime); 
        $.session.set('dateFindRider',$.getDateTime.date(dateTime)); 
        var from = $('tr .start',parent).html();
        var to = $('tr .to',parent).html();
        var smoker = $(parent).find('.smoker').html();
        smoker = smoker== "Yes"? 1 : 0;
        var currentDate =  new Date().getTime();   
        var rideDate =  new Date(dateTime).getTime();
        if(rideDate <  currentDate)
        {
            addValidationRules();
            time = $.getDateTime.formatTime(new Date());
        } 
        else
        {
              removeValidationRules();
        }
            
        if(startType == ADDRESS_START)
        {
           if($('#geoLocation').hasClass('isShown'))
           {
                $("#fromLabelLoc,#addressFindRiderFrom").toggleClass(
                                                            'hide');
                $("#toLabelAdd,#toAddress").toggleClass('hide');
                $("#locationFindRider,#geoLocation").toggleClass(
                                                         'isShown');
                $("#addressFindRider,#fromSelect").toggleClass(
                                                            'isShown');
           } 
            $('#addressFindRiderFrom .airspndLocation').val(from);
//            $('#toLabelAdd .airspndLocation').select2('val',to);
            $('#locationFindRider').select2('val',to);

            $('#startLabel').html('Address');
            $('#toLabel').html('Airport');
        }
        else if(startType == AIRPORT_START)
        {
            if($('#addressFindRider').hasClass('isShown'))
            {
                $("#fromLabelLoc,#addressFindRiderFrom").toggleClass(
                                                                'hide'); 
                $("#toLabelAdd,#toAddress").toggleClass('hide');
                $("#locationFindRider,#geoLocation").toggleClass(
                                                            'isShown');
                $("#addressFindRider,#fromSelect").toggleClass(
                                                            'isShown');
            } 
//            $('#fromLabelLoc .airspndLocation').select2('val',from); 
            $('#fromSelect').select2('val',from); 
            $('#toAddress .addressFindRider').val(to);
            $('#startLabel').html('Airport');
            $('#toLabel').html('Address');  
        }
        $('#seatsFindRider').select2('val',$('.seat',parent).text());
        $('#bagsFindRider').val($('.bags',parent).text());
        $('#bagSizeSelect').select2('val',getBagCode($('.bagSize',
                                    parent).text().toLowerCase()));
        $("#date").datePicker(dateTime);
        $("#time").val(time);                
        $("#time").timePicker(time);  
        $('#smoker').prop('checked',smoker);
        
        // remove error class and messages
        $('.popover','#findRiderform').remove();
        $('#findRiderform :input').each(function(e){
            $(this).removeClass('error');
        });
        e.preventDefault();
    });
});


// function get locations from google
function geoLocation
(
) 
{
    if (navigator.geolocation) 
    {
        navigator.geolocation.getCurrentPosition(function(position) 
        {
            var geolocation = new google.maps.LatLng(
                position.coords.latitude, position.coords.longitude);
            if (typeof autocomplete != 'undefined')
            {
                autocomplete.setBounds(
                    new google.maps.LatLngBounds(geolocation,
                                                 geolocation));
            }  
        });
    }
}     

//function search lift.
function searchLift
(
)
{           
    var location = '';
    var address = '';    
    var startType = ADDRESS_START;                    
    if($('#fromSelect').hasClass('isShown'))
    {
        location = $('option:selected','#fromSelect').val();
        address  = $('#geoLocation').val();
        startType = AIRPORT_START;
    }
    else if($('#addressFindRider').hasClass('isShown'))
    {
        location = $('option:selected','#locationFindRider').val();
        address = $('#addressFindRider').val();
    }                  
    $.session.set('addressType',startType);                  
    $.session.set('locationFindRider',location);
    $.session.set('addressFindRider',address);  
    $.session.set('dateFindRider',$.getDateTime.date($('#date').val()));       
    $.session.set('timeFindRider',$('#time').val());  
    var smokerRider = $('#smoker').prop('checked')? 1 : 0  ;
    $.session.set('smokerFindRider',smokerRider);
    $.session.set('seatsFindRider',$('option:selected','#seatsFindRider').val());  
    $.session.set('bagSizeFindRider',
                            $('option:selected','#bagSizeSelect').val());  
    $.session.set('bagsFindRider',$('#bagsFindRider').val()); 
    $.session.clear('pageLocation');                                                                         
   // $.session.set('mileFindRider',$('#findLocationRange').html().split(' ')[0]);
    window.location = SITE_URL + 'bookRider.php';
}

//function get my rides
function getMyRides
(
)
{
    var customerId = sessionManager('getSession','customerId');
    var res = rideByCustomer(customerId);
    var htmlBody = '';
    var hasArrow = res.lifts == null || res.lifts.length == 1;
    if(res.retCode && res.rides.length > 0)
    {
        var rides =  sortByKey(res.rides,'dt','0'); 
        $.each(rides,function(i,item)
        {
            var canSelect = (item.status == 0 || item.status == 1);
            var date = $.getDateTime.formatDate(item.dt);
            var time = $.getDateTime.formatTime(item.dt);
            var dateTime = $.getDateTime.formatDateTime(item.dt);
            var bagSize = getBagSizeName(item.bagSize);
            var from = item.startType == AIRPORT_START ? "Airport" : "Address"
            var to   = item.startType == ADDRESS_START ? "Airport" : "Address"
            var via =  (item.via == null || item.via =='') ? 'NA' : item.via;
            var bags = item.bags == null ? 0 : item.bags;
            var smoker = item.smoker == 1? "Yes" : "No"
            htmlBody+='<div><h2 class="title greenLabel">'+date+'</h2>';
            htmlBody+='<table class="table table-striped">';
            if(canSelect)
            {
                htmlBody+='<tr><td colspan="99">';
                htmlBody+='<a href="#" class="selectRide '+canSelect+'"';
                htmlBody+=' rideId="'+item.id +'" date="'+item.dt+'"';
                htmlBody+=' startType='+item.startType;
                htmlBody+=' customerId="'+item.customerId+'">';
                htmlBody+='<i class="icon-th"></i>';
                htmlBody+=' Select Offer</a></td></tr>';
            }
            htmlBody+='<tr><td colspan="2">Date</td><td  colspan="2" '+
                      'class="dateTime">'+date+'</td></tr>';
            htmlBody+='<tr><td colspan="2">Time</td><td  colspan="2" '+
                      'class="dateTime">'+time+'</td></tr>';
            htmlBody+='<tr><td colspan="2">'+from+'</td><td colspan="2" '+
                      'class="start">'+item.start+'</td></tr>';
            htmlBody+='<tr><td colspan="2">Via</td><td colspan="2" '+
                      'class="via">'+via+'</td></tr>';
            htmlBody+='<tr><td colspan="2">'+to+'</td><td colspan="2" '+
                      'class="to">'+item.to+'</td></tr>';
            htmlBody+='<tr><td colspan="2">Seats</td><td colspan="2" '+
                      'class="seat">'+ item.seats +'</td></tr>'; 
            htmlBody+='<tr><td colspan="2">Bag Size</td><td colspan="2" '+
                      'class="bagSize">'+ bagSize+'</td></tr>';
            htmlBody+='<tr><td colspan="2">Bags</td><td colspan="2" '+
                      'class="bags">'+ bags +'</td></tr>'; 
            htmlBody+='<tr><td colspan="2">Smoker</td><td colspan="2" '+
                      'class="smoker">'+ smoker +'</td></tr>';                                   
            htmlBody+='<tr><td colspan="2">Status</td><td colspan="2">'+
                      getStatusName(item.status)+ '</td></tr>';
            htmlBody+='<tr><td colspan="2">Note</td><td colspan="2"  '+
                      'class="textBreak">'+(item.note || '-')+'</td></tr>';
            htmlBody+='</table></div>';
        });
    }
    else
    {
        htmlBody+='<div><h2 class="greenLabel">No ride is found</h2>';
        htmlBody+='</div>';
    }    
    $('#myLiftsContainer').append(htmlBody);
    $('#panelMyLift').removeClass('hide');
    $('#myLiftsContainer').contentSlider('My Rides',hasArrow,
                                         $.session.get('selectedTabFindRider'));
}

//function addValidation rules
function addValidationRules
(
)
{         
    $.validator.addMethod('minStrict', function (value, el, param) {
               var newDateTime = $('#date').val()+' '+$('#time').val();
               value = new Date(newDateTime).getTime();
               return value > param;
           }); 
       $('#time').rules( "add", {
            required: true,
            minStrict: new Date().getTime(),
            messages: {
            required: "Please enter time",
            minStrict: jQuery.format("Time should  be greater than current time")
            }
       });
}
 // remove validation rules
function removeValidationRules
(
)
{    
     $('#time').rules("remove", "minStrict"); 
     $('#time').next('.popover').remove();
     $('#time').addClass('ignore');
     $('#time').removeClass('error');
}

//function is logged in user
function isLoggedInUser
(
)
{
    $('#from,#to').autoComplete();  
    var userDetails = sessionManager('getSession','user');
    if(userDetails)
    {      
        getMyRides(); 
    }
    else
    {
        $('#panelMyLift').addClass('hide');
    } 
} 

$(window).on('load',function()
{
    $( "#findLocation" ).getSlider('findLocationRange',' Miles');
    $( "#findLocationRange" ).html( $( "#findLocation" ).slider( "value" ) + 
        ' Miles');  
    $('.locationFindRide').select2('val',$.session.get('pageLocation')); 
        addValidationRules();
});

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
            status = 'New';
            break;
        case 1:
            status = 'Available';
            break;
        case 2:
            status = 'Full';
            break;
        case 3:
            status = 'Fullfilled';
            break;
    }

    return status;
}

// for the selected lift
$(window).bind('beforeunload',function(){
    if($('#myLiftsContainer-nav-select').is(':visible'))
    {
        var tabId = $('#myLiftsContainer-nav-select option:selected').val().
                    split('tab')[1];
        $.session.set('selectedTabFindRider',tabId);    
    }
    else
    {
        $('#myLiftsContainer-nav-ul li').each(function(i,item){
            if($('a',this).hasClass('current'))
            {
                var tabId = $('a',this).attr('href').split('#')[1];
                $.session.set('selectedTabFindRider',tabId);
            }
        });
    } 
});

//function validate form
function validateForm()
{
    $('#findRiderform').validate({
        onfocusout: function(element)
        {
            if (!$(element).is('select') && element.value === '' && 
                element.defaultValue === '') 
            {                
                $(element).valid();
            }
            if(!$(element).hasClass("ignore"))
            {
                if($(element).valid())
                {
                    $(element).removeClass('error').addClass('success'); 
                }
                else
                {
                    $(element).removeClass('success').addClass('error'); 
                }
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
            address : {
                required:true
            }, 
            geoLocation :{
               required:true  
            },  
            date : {
                required:true
            },
            time :{
                required:true
            },
            seatsFindRider :{
                required:true
            }
          
        },
        messages: {
            address: 
            {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'address ')
            },
             geoLocation: 
            {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'address ')
            },
            date:{
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'date')
            },
            time:{
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'time')
            } ,
            
            seatsFindRider:{
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'seats')
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
            searchLift();
        }
    });
}
/* End of file commentFindRider.js */
/* Location: ./js/commentFindRider.js */  
