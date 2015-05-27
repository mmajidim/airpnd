/**
 * @file       commentFindRide.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for find ride.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added search driver functionality and
 *             done with minor formatting
 * @revDate    05/06/2014
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
 * @revDate    05/28/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    remove the miles  
 * @revDate    06/17/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added the date time  restriction  validation
 * @revDesc    updated functionality for SMS.
 * @revDate    06/20/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 */ 
$(function(){
    var autocomplete;
    $.session.clear('hasLift');
    validateForm();
    getLocation('locationFindRide',true,true);
    getBagTypes('bagSizeFindRide');
    $('#bagSizeFindRide').select2();
    $('#seatsFindRide').select2();
    getSeats('seatsFindRide');   
    // Create the autocomplete object, restricting the search
    // to geographical location types.  
    if($('#toAddress').css('display') != 'none')
    {
        autocomplete = new google.maps.places.Autocomplete(   
        (document.getElementById('toAddressFindRide')),
                                  { types: ['geocode'] });
    }
    autocomplete = new google.maps.places.Autocomplete(   
    (document.getElementById('addressFindRide')), { types: ['geocode'] });
    // When the user selects an address from the dropdown,
    // populate the address fields in the form.
    google.maps.event.addListener(autocomplete, 'place_changed',
    function() {
    });    
     
      //get locations from google
    $('#addressFindRide,#toAddressFindRide').keyup(function(e){
       geoLocation();
    });
           
    if($.session.get('pageLocation'))
    {
        $('.locationFindRide').select2('val',$.session.get('pageLocation'));
        $.session.clear('addressFindRide');    
    }    
    getLocation('locationFindRide',true,false);  
    $.session.clear('hasLift');
    // init timepicker   
    $('#time').timePicker();
    // init datepicker 
    $('#date').datePicker(); 
    //show timepicker 
    $('.icon-time').on('click',function(){
        $('#time').timepicker('show');
    });  
             
    // set the search values
//    if($.session.get('addressFindRide') !=null && isLoggedIn())
    if($.session.get('addressFindRide') !=null)
    {         
        if($.session.get('startType') == ADDRESS_START)
        {            
            if($('#toAddressFindRide').hasClass('isShown'))
            {
                $("#fromLabelLoc,#addressFindRideFrom").toggleClass('hide'); 
                $("#toLabelAdd,#toAddress").toggleClass('hide'); 
                $("#fromSelect,#addressFindRide").toggleClass('isShown');
                $("#locationFindRide,#toAddressFindRide").toggleClass(
                                                                'isShown');
            }
            $('#addressFindRide').val($.session.get('addressFindRide'));
            $('#fromSelect').select2('val',
                                       $.session. get('locationFindRide'));
            $('#startLabel').html('Address');
            $('#toLabel').html('Airport');
       } 
       else if($.session.get('startType') == AIRPORT_START)
       {
            if($('#addressFindRide').hasClass('isShown'))
            {
                $("#fromLabelLoc,#addressFindRideFrom").toggleClass('hide'); 
                $("#toLabelAdd,#toAddress").toggleClass('hide'); 
                $("#fromSelect,#addressFindRide").toggleClass('isShown');
                $("#locationFindRide,#toAddressFindRide").toggleClass(
                                                                'isShown');
            }
            $('#toAddressFindRide').val($.session.get('addressFindRide'));
            $('#fromSelect').select2('val',
                                        $.session. get('locationFindRide'));
            $('#startLabel').html('Airport');
            $('#toLabel').html('Address');
        }
        
        $("#date").datePicker($.session.get('dateFindRide'));
        $("#seatsFindRide").select2('val',$.session.get('seatsFindRide'));
        $('#bagSizeFindRide').select2('val',$.session.get('bagSizeFindRide'));
        $("#bagsFindRide").val($.session.get('bagsFindRide'));
        $("#time").val($.session.get('timeFindRide'));                
        $("#time").timePicker($.session.get('timeFindRide'));
        $("#smoker").prop('checked',parseInt(
            $.session.get('smokerFindRide')) == 1 ? true : false );
    }
    
    // remove the error message from date
    $('#date').on('click',function(e) {         
        $(this).next('.popover').remove(); 
        $(this).removeClass('error');
    }) ;
     // remove the error message from date
    $('#date').on('blur',function(e) {          
        $(this).next('.popover').remove(); 
        $(this).removeClass('error');
    }) ;
        
    // swap to and from address
    $(document).on('click','.exchange',function(){   
        $("#fromLabelLoc,#addressFindRideFrom,#toLabelAdd,#toAddress") .
            toggleClass('hide'); 
        $("#addressFindRideFrom .airspndLocation").toggleClass('ignore');
        $("#toAddress .airspndLocation").toggleClass('ignore');
        $("#fromSelect,#addressFindRide").toggleClass('isShown');
        $("#locationFindRide,#toAddressFindRide").toggleClass('isShown');
       
        var fromLocation  =  $('.locationFindRide option:selected').val();
        var fromAddress   =  $('#addressFindRide').val();  
        var toAddress     =  $('.addressFindRide').val(); 
        var toLocation    =  $('#locationFindRide option:selected').val()
       
        // for upper part
        $('.locationFindRide').select2('val',toLocation);
        $('#addressFindRide').val(toAddress);
        
        //for second part
        $('.addressFindRide').val(fromAddress);
        $('#locationFindRide').select2('val',fromLocation);
        
       //code for label toggling
        if(!$('#addressFindRide').hasClass('ignore')) 
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
      
      //show datepicker when click on icon      
    $('.icon-calendar add-on').on('click',function(){
        $(this).closest('div').children('input[type="text"]').
        datepicker('show');
    });
    ridesByCustomerId(); 
      // select rider    
    $(document).on('click','.selectRider',function(e){  
        var parent = $(this).closest('table');  
        var startType = $(this).attr('startType'); 
        $.session.set('liftId',$(this).attr('liftId'));
        $.session.set('hasLift',true);
        var datetime = $(this).attr('date');
        $.session.set('dateFindRide',$.getDateTime.date(datetime));   
        var date = $.getDateTime.formatDate(datetime);
        var time = $.getDateTime.formatTime(datetime);
        var currentDate =  new Date().getTime();   
        var liftDate =  new Date(datetime).getTime();
        if(liftDate <  currentDate)
        {
          addValidationRules();  
          time = $.getDateTime.formatTime(new Date());
        } 
        else
        {
           removeValidationRules();
        }
        var from  =  $(parent).find('.start').html();
        var to    =  $(parent).find('.to').html();
        var via   =  $(parent).find('.via').html();
        var bags  =  $(parent).find('.bags').html();
        var smoker=  $(parent).find('.smoker').html();
            smoker = smoker== "Yes"? 1 : 0;
        $.session.set('locationFindRide', from) ;
        $.session.set('addressFindRide', to) ;
        if(startType == ADDRESS_START)
        {
            if($('#toAddressFindRide').hasClass('isShown'))
            {
                $("#fromLabelLoc,#addressFindRideFrom").toggleClass('hide'); 
                $("#toLabelAdd,#toAddress").toggleClass('hide'); 
                $("#fromSelect,#addressFindRide").toggleClass('isShown');
                $("#locationFindRide,#toAddressFindRide").toggleClass(
                                                                    'isShown');
            }
            $('#addressFindRide').val(from);
            $('#locationFindRide').select2('val',to)
            $('#startLabel').html('Address');
            $('#toLabel').html('Airport');
        } 
        else if(startType == AIRPORT_START)
        {
            if($('#addressFindRide').hasClass('isShown'))
            {
                $("#fromLabelLoc,#addressFindRideFrom").toggleClass('hide'); 
                $("#toLabelAdd,#toAddress").toggleClass('hide'); 
                $("#fromSelect,#addressFindRide").toggleClass('isShown');
                $("#locationFindRide,#toAddressFindRide").toggleClass(
                                                                    'isShown');
            }
            $('#toAddressFindRide').val(to);
            $('#fromSelect').select2('val',from)
            $('#startLabel').html('Airport');
            $('#toLabel').html('Address');
        }
        $("#date").datePicker(datetime);
        $("#bagsFindRide").val(bags);
        $("#seatsFindRide").select2('val',$('.seat',parent).text());
        $('#bagSizeFindRide').select2('val',
                        getBagCode($('.bagSize',parent).text().toLowerCase()));
        $("#time").val(time);                
        $("#time").timePicker(time);
        $('#smoker').prop('checked',smoker);

         // remove error class and messages
        $('.popover','#findRideform').remove();
        $('#findRideform :input').each(function(e){
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
        navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
        autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
          geolocation));
        });
    }
}   
          
//function findRides
function findRide
(
)
{ 
    var location = '';
    var address = '';              
    var startType = ADDRESS_START;
    
    if($('#fromSelect').hasClass('isShown'))
    {
        location = $('option:selected','#fromSelect').val();
        address = $('#toAddressFindRide').val();
        startType = AIRPORT_START;
    }
    else if($('#locationFindRide').hasClass('isShown'))
    {
        location = $('option:selected','#locationFindRide').val();
        address = $('#addressFindRide').val();
    }
    $.session.set('startType', startType) ;                                             
    $.session.set('locationFindRide', location) ;
    $.session.set('addressFindRide', address) ; 
    //$.session.set('mileFindRide',$('#findLocationRange').html().split(' ')[0]);
    $.session.set('dateFindRide',$.getDateTime.date($('#date').val()));   
    var smokerRide = $('#smoker').prop('checked')? 1 : 0
    $.session.set('smokerFindRide',smokerRide);  
    $.session.set('timeFindRide',$('#time').val());
    $.session.set('seatsFindRide',$('option:selected','#seatsFindRide').val());  
    $.session.set('bagsFindRide',$('#bagsFindRide').val());
    $.session.set('bagSizeFindRide',
                            $('option:selected','#bagSizeFindRide').val());  
    $.session.clear('pageLocation'); 
    window.location  = SITE_URL + 'bookRide.php';
}

//function rides by customer Id
function ridesByCustomerId
(
)
{ 
    $('#from').autoComplete();
    var customerId = sessionManager('getSession','customerId');
    if(customerId)
    {               
        var result = liftsByCustomer(customerId);
        loadCustomerLifts(result);
    }
    else
    {
         $('#panelMyRide').addClass('hide');  
    }
}

// function load rides
function loadCustomerLifts
(
    result
)
{
    $('#myFindRideContainer').empty();    
    var htmlBody = '';
    var hasArrow = result.lifts == null || result.lifts.length == 1;
    if(result.retCode && result.lifts.length > 0)
    { 
        result = sortByKey(result.lifts,'dt','0'); 
        $.each(result,function(i,item){
            var canSelect = item.status == NEW_LIFT;
            var dateTime = $.getDateTime.formatDateTime(item.dt);
            var date = $.getDateTime.formatDate(item.dt);
            var time = $.getDateTime.formatTime(item.dt);
            var bagSize = getBagSizeName(item.bagSize);
            var from = item.startType == AIRPORT_START ? 
                        "Airport" : "Address"
            var to   = item.startType == ADDRESS_START ? 
                        "Airport" : "Address"
            var smoker = (item.smoker == 1) ? "Yes" : "No"
            htmlBody+='<div><h2 class="title greenLabel">'+
                        date+'</h2>';
            htmlBody+='<table class="table table-striped">';
            if(canSelect)
            {
                htmlBody+='<tr><td width="105"><a href="#" class="selectRider"';
                htmlBody+=' liftId="'+item.id+'" date="'+
                            item.dt+'"';
                htmlBody+=' startType='+
                            item.startType;
                htmlBody+=' customerId="'+
                            item.customerId+'"><i class="icon-th"></i>';
                htmlBody+=' Select Request</a></td></tr>';
            }
            htmlBody+='<tr><td colspan="2">Date</td><td colspan="2" '+
                      'class="date">'+date+'</td></tr>';
            htmlBody+='<tr><td colspan="2">Time</td><td colspan="2" '+
                      'class="date">'+time+'</td></tr>';
            htmlBody+='</td></tr>';
            htmlBody+='<tr><td colspan="2">'+from+'</td><td colspan="2" '+
                      'class="start">'+item.start+'</td></tr>';
            htmlBody+='<tr><td colspan="2">'+to+'</td><td colspan="2" '+
                      'class="to">'+item.to+'</td></tr>';
            htmlBody+='<tr><td colspan="2">Seats</td><td colspan="2" '+
                      'class="seat">'+(item.seats || '-')+'</td></tr>';
            htmlBody+='<tr><td colspan="2">Bag Size</td><td colspan="2" '+
                      'class="bagSize">'+bagSize+'</td></tr>';
            htmlBody+='<tr><td colspan="2">Bags</td><td colspan="2" '+
                      'class="bags">'+item.bags+'</td></tr>'; 
            htmlBody+='<tr><td colspan="2">Smoker</td><td  colspan="2" '+
                       'smoker='+item.smoker+' class="smoker">'+smoker+'</td></tr>';                                   
            htmlBody+='<tr><td colspan="2">Status</td><td colspan="2">'+
                       getLiftStatusName(item.status)+'</td></tr>';
            htmlBody+='<tr><td colspan="2">Note</td>';
            htmlBody+='<td colspan="2" class="textBreak">'+(item.note || '-');
            htmlBody+='</td></tr>';
            htmlBody+='</table></div>';
        });
    }
    else
    {
        htmlBody+='<div><h2 class="greenLabel">No lift is found.</h2></div>';
    }    
    $('#myFindRideContainer').append(htmlBody);
    $('#panelMyRide').removeClass('hide');
    $('#myFindRideContainer').contentSlider('My Lifts',hasArrow,
                                $.session.get('selectedTabFindRide'));
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
        minStrict: jQuery.format("Time should be greater than current time")
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

$(window).on('load',function(){ 
   // $('.locationFindRide').select2('val',
  //        $.session.get('pageLocation'));                                  
 //  $( "#findLocation" ).getSlider('findLocationRange' ,' Miles');
 //    $( "#findLocationRange" ).html( $( "#findLocation" ).slider( "value" ) +
 //        ' Miles');
});

$(window).bind('beforeunload',function(){
    if($('#myFindRideContainer-nav-select').is(':visible'))
    {
        var tabId = $('#myFindRideContainer-nav-select option:selected').val().
                    split('tab')[1];
        $.session.set('selectedTabFindRider',tabId);    
    }
    else
    {
        $('#myFindRideContainer-nav-ul li').each(function(i,item){
            if($('a',this).hasClass('current'))
            {
                var tabId = $('a',this).attr('href').split('#')[1];
                $.session.set('selectedTabFindRide',tabId);
            }
        });
    } 
});


//function validate form
function validateForm
(
)
{
    $('#findRideform').validate({
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
            date : {
                required:true
            },
            time :{
                required:true
            } 
        },
        messages: { 
            address: {
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'address')
            },
            date:{
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'date')
            },
            time:{
                required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                    'time')
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
            findRide();
        }
    });
}
/* End of file commentFindRide.js */
/* Location: ./js/commentFindRide.js */  