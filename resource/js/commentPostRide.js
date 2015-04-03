/**
 * @file       commentPostRide.js
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       javascript for post ride.
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added offer ride functionality and
 *             done with minor formatting
 * @revDate    05/06/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    modified functionality and for auto address
 *             done with minor formatting
 * @revDate    05/09/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    modified functionality for auto address and
 *             done with minor formatting
 * @revDate    05/12/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    modified functionality for contribution and
 *             done with minor formatting
 * @revDate    05/23/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    Fixed issue and done with minor formatting
 * @revDate    05/29/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    update code for Conribution 
 * @revDate    06/02/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    update code for Conribution and fixed issue
 * @revDate    06/17/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added the datetimepicker restrction validation
 * @revDate    06/20/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formating
 */ 
$(function(){ 
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
        $('[rel="tooltip"]').tooltip();
        // attach event to slider
        $( "#searchLocation" ).on( "slidestop", function( event, ui ) {
           airportName   =  $('#startLocationSelect').css('display') != 'none' ?  
                            $('option:selected','#startLocation').val() : 
                            $('option:selected','#toStartLocation').val();  
           driverAddress =  $('#toLocationInput').is(':visible')?  
                            $('#toLocation').val() : $('#startToLocation').val();
                       
          if(driverAddress !="")
          {
             var price = getPriceForRide(airportName,driverAddress,ui.value);
             $('#contribution').slider("option","max",(price <= 1 ? 0 : price));
             $('#contribution').slider("option","disabled",false);
             var currentVal =  $( "#contribution" ).slider( "value" ) < 1 ? '' : 
                               $( "#contribution" ).slider( "value" )
             $( "#contributionPrice" ).html( '$'+currentVal); 
             $('#maxPrice').html("$"+(price < 1 ? 0 : price));
          }
           
        });
        //sliding  of contribution
        $( "#contribution" ).on( "slidestop", function( event, ui ) {
            var contribution = ui.value <= 1 ? '$' : '$'+ ui.value;
            $( "#contributionPrice" ).html(contribution); 
        } );
        
          $('#bagSizePostRide').select2();
          $('#seats').select2();
          getSeats('seats');
         // Create the autocomplete object, restricting the search
        // to geographical location types.   addressFindRider
        if($('#toLocationInput').css('display') != 'none')
        {
          autocomplete = new google.maps.places.Autocomplete(   
          (document.getElementById('toLocation')), { types: ['geocode'] });
        }
        
        autocomplete = new google.maps.places.Autocomplete(   
        (document.getElementById('startToLocation')), { types: ['geocode'] });
         autocomplete = new google.maps.places.Autocomplete(   
        (document.getElementById('viaLocation')), { types: ['geocode'] });   
            
            
        // When the user selects an address from the dropdown,
        // populate the address fields in the form.
        google.maps.event.addListener(autocomplete, 'place_changed',
        function() {
        });    
        
          //get locations from google
       $('#toLocation,#startToLocation').keyup(function(e){
           geoLocation();
       });
        
        // show previous rides
        showPreviousRides();
             // swap to and from address
        $(document).on('click','.exchange',function()
        {                                
            $("#startLocationSelect,#startLocationInput").toggleClass('hide');  
            $("#toLocationInput,#toLocationSelect").toggleClass('hide');  
            $("#startLocationInput .postRideLocationInput").toggleClass('ignore');
            $("#toLocationInput .postRideLocationInput").toggleClass('ignore');
            var airPortAddress  = $('#startLocation option:selected').val();
            var toLocAddress    = $("#toLocation").val();
            var locationAddress = $('#toStartLocation option:selected').val();
            var toAirLocation   = $("#startToLocation").val();
            
            $("#startToLocation").val(toLocAddress);
            $("#toStartLocation").select2('val',airPortAddress);
            $("#startLocation").select2('val',locationAddress);
            $("#toLocation").val(toAirLocation);
            
            //code for label toggling
            if(!$('#startToLocation').hasClass('ignore')) 
            {
                $('#startLabel').html('Address');
                $('#toLabel').html('Airport');
            }
            else
            {
                $('#startLabel').html('Airport');
                $('#toLabel').html('Address');
            }
          airportName   = $('#startLocationSelect').css('display') != 'none' ?  
                          $('option:selected','#startLocation').val() : 
                          $('option:selected','#toStartLocation').val();  
          driverAddress = $('#toLocationInput').is(':visible')?  
                          $('#toLocation').val() : $('#startToLocation').val();
          return false;
        });  
        
          // changing of address and location   
        $(document).on('change','#startLocation,#toLocation', function(e){        
             setTimeout(function() {   
                getCountribution();}, 300); 
            return false;
        });
        // changing of address and location
        $(document).on('change','#startToLocation,#toStartLocation',function(e){
            setTimeout(function() {   
                getCountribution();}, 300); 
            return false;
        });
         // remove the  focus when press enter
        $("#toLocation,#startToLocation").on('keyup',function(e){
              if(e.keyCode == 13)
              {
                   $(this).blur();
              } 
             if($(this).val().trim() == '')
              {
                   $("#contribution").slider( "option", "disabled", true );
                   $("#contribution").slider('value',0);
                   $("#maxPrice").text("$"); 
                   $("#contributionPrice").text("$"); 
              }
         });
        
         // on remove focus
          $("#toLocation,#startToLocation").on('blur',function(e) {      
              if($(this).val().trim() == '')
              {
                   $("#contribution").slider( "option", "disabled", true );
                   $("#contribution").slider('value',0);
                   $("#maxPrice").text("$"); 
                   $("#contributionPrice").text("$"); 
              }
         });
        
        var dataToHide = 
        [
            {'id':'postRide'},
            {'id':'myBookingsPostRide'}
        ];
        toggleSection(dataToHide);  

        getLocation('startLocation',true); 
        getLocation('toStartLocation ',true); 
        getBagTypes('bagSizePostRide');
         
        $('#toLocation').filterType('special');
        $('#viaLocation').filterType('special');
        $('#seats').filterType('numeric'); 

        //toggle right panel   on click
        $(".icon-minus-sign, .icon-plus-sign").on('click',function()
            {
                $(this).toggleClass("icon-minus-sign icon-plus-sign");
                $('#postRidePanel-wrapper').slideToggle(200, "linear");
        });
            
         //init datetimepicker
        $('#date').dateTimePicker();
        //remove the error pop up
        $('#date').on('click',function(){
            $(this).next('.popover').remove();
            $(this).popover('hide');
        }) ;

        //to open datepicker on click of icon
        $('.icon-calendar').on('click',function(){
            $(this).closest('div').children('input[type="text"]').
            datetimepicker('show');
        });

        //validate form 
        $("#postRideForm").validate({
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
               
                toLocation : 
                {
                    required:true
                },
                datePostRide : 
                {
                    required:true,
                    date:false
                },
                seats : 
                {
                    required:true
                }
            },
            messages:
            {
                toLocation:
                {
                    required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                        'destination location')
                },
             
                datePostRide:
                {
                    required:VALIDATION_ERROR_MSG_SELECT.replace('{element}',
                        'date')
                },
                seats:
                {
                    required:VALIDATION_ERROR_MSG_INPUT.replace('{element}',
                        'free seats')
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
                $('#postRide').attr('disabled','disabled');
                postRide();
            }
        });
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

// get contribution price
function getCountribution
(
)
{             
    airportName   =  $('#startLocationSelect').css('display') != 'none' ?  
                     $('option:selected','#startLocation').val() : 
                     $('option:selected','#toStartLocation').val();  
    driverAddress =  $('#toLocationInput').is(':visible')?  
                     $('#toLocation').val() : $('#startToLocation').val();
 
   if(driverAddress.trim() !="" )
   {
     
      $( "#contribution" ).getSlider('contributionPrice',null,'$');
      var price = getPriceForRide(airportName,driverAddress,
      $('#locationRange').text().split(' ')[0]);
      $('#contribution').slider("option",
                                "max",
                                (price <= 1 ? 0 : price));
      $('#contribution').slider("option","disabled",false);
      var nowVal = $( "#contribution" ).slider( "value" ) <= 1 ? '' :
                   $( "#contribution" ).slider( "value" );
      $( "#contributionPrice" ).html( '$'+nowVal); 
      $('#maxPrice').html("$"+(price <= 1 ? 0 : price));      
   }
}

//function post a ride
function postARide
(
    userDetails,
    entityId
)
{
    var startAddress =  $('#startLocationSelect').css('display') != 'none' ?  
                        $('option:selected','#startLocation').val() : 
                        $('#startToLocation').val();
    var toAddress   =   $('#toLocationInput').is(':visible')?  
                        $('#toLocation').val() : 
                        $('option:selected','#toStartLocation').val(); 
    var startType   =   $('#startLocationSelect').css('display') != 'none' ?
                        AIRPORT_START : ADDRESS_START; 
    
    var time = $.getDateTime.time($('#date').val());
        time = $.getDateTime.time(time,true);
    var price    = $('#contributionPrice').html().split('$')[1] 
    var rideData = 
    {
        'ownerId'       : userDetails.userInfoId,
        'entityId'      : entityId,
        'date'          : $.getDateTime.date($('#date').val()),
        'time'          : time,
        'start'         : startAddress,
        'to'            : toAddress,
        'startType'     : startType,
        'via'           : $('#viaLocation').val(),
        'maxMiles'      : $('#locationRange').html().split(' ')[0],
        'contribution'  : price,
        'seats'         : $('#seats').val(),
        'smoker'        : $('#smoker').is(':checked'),
        'bags'          : $('#bagPostRide').val(),
        'bagSize'       : $('#bagSizePostRide option:selected').val(),
        'note'          : $('#rideNote').val()
    } 
    var dataToSend = {
        "action"    : POST_A_RIDE,
        "ride"      : JSON.stringify(rideData)
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
            $('#editRideLoader').addClass('hide');
            $('#postRide').removeAttr('disabled');
            showAlertBox('Error',ERROR_MSG);
        },
        success  : function(jsonResult)
        {
            $('#editRideLoader').addClass('hide');
            $('#postRide').removeAttr('disabled');
            if(jsonResult.retCode)
            {                  
                msg  = "You have successfully posted a ride.";
                msg += "Please make sure your payment information ";
                msg += "is up-to-date in your user profile. ";
                msg += "This information can be updated using manage "
                msg += "<a href='http://www.airpnd.com/profile.php'>"
                msg += "profile</a>";
                
                showAlertBox('Successful',
                             msg,
                             SITE_URL + 'postRide.php');
           }
        }
    });  
    moveTotop();        
}

// getting entity information for membership
function getEntity
(
)
{
    var entityId;
    var dataToSend = {
        "action"  : GET_ENTITY_BY_NUMBER_ACTION,
        "number"  : CAR_ENTITY
    }
    $.ajax({
        type: "POST",
        url: API_URL,
        data: dataToSend,                    	                    
        dataType: "xml",
        async:false,
        headers: HEADER,
        error: function (e)
        {
            showAlertBox('Error',ERROR_MSG);
            moveTotop();
        },
        success: function(xmlResult)
        {
            $(xmlResult).find("response").each(function()
                { 
                    entityId = $(this).find("id").text(); 		
            });  
        }
    });	

    return entityId;
} 
// resetting the fileds
$(window).on('load',function()
{
    $( "#searchLocation" ).getSlider('locationRange',' Miles');
    $( "#locationRange" ).html( $( "#searchLocation" ).slider( "value" ) + 
                                ' Miles');
     airportName   =  $('#startLocationSelect').css('display') != 'none' ?  
                      $('option:selected','#startLocation').val() : 
                      $('option:selected','#toStartLocation').val();  
     driverAddress =  $('#toLocationInput').is(':visible')?  
                      $('#toLocation').val() : $('#startToLocation').val(); 
    $( "#contribution" ).getSlider('contributionPrice',null,'$');
    
    $.validator.addMethod('minStrict', function (value, el, param) {
               value = new Date($('#requestRideDateTime').val()).getTime();
               return value > param;
                       }); 
    $('#date').rules( "add", {
        required: true,
        minStrict: new Date().getTime(),
        messages: {
        required: "please enter time",
        minStrict: jQuery.format("Time should  be greater than current time")
          }
    }); 
  $("#contribution").slider( "option", "disabled", true );
  $("#contribution").slider('value',0);
  $("#maxPrice").text("$"); 
});

// function show previous rides
function showPreviousRides
(
)
{
    var customerId = sessionManager('getSession','customerId');
    if(customerId)
    {
        var result = rideByCustomer(customerId);
        var hasArrow =result.rides == null || result.rides.length == 1;
        loadPreviousRides(result);  
        $('#postRidePanel').contentSlider('My Rides',hasArrow);
    }
}

// function load previous rides
function loadPreviousRides
(
    result
)
{
    var htmlBody='';
    if(result.retCode && result.rides.length > 0)
    {  
        result = sortByKey(result.rides,'dt','0');  
        $.each(result,function(i,item){
                var date = $.getDateTime.formatDate(item.dt);
                var dateTime = $.getDateTime.formatDateTime(item.dt);
                var from = item.startType == AIRPORT_START 
                            ? "Airport" : "Address"
                var to   = item.startType == ADDRESS_START 
                            ? "Airport" : "Address"
                var smoker = item.smoker == 1 ? "Yes" : "No";  
                var via = (item.via == null || item.via =='') ? "NA" : item.via;          

                var bags = "";
                if (typeof item.bags !== 'undefined' &&
                    item.bags != null)
                {
                    bags = item.bags
                }
                
                var note = "";
                if (typeof item.note !== 'undefined' &&
                    item.note != null)
                {
                    note = item.note
                }

                htmlBody+='<div><h2 class="title greenLabel">' + date + '</h2>';
                htmlBody+='<table class="table table-striped"><tbody>';
                htmlBody+='<tr><td>'+from+'</td><td>';
                htmlBody+=item.start+'</td></tr>';
                htmlBody+='<tr><td>'+to+'</td><td>'+item.to+'</td></tr>';
                 htmlBody+='<td>Via</td><td>'+via+'</td></tr>';
                htmlBody+='<td>Date</td><td>'+dateTime+'</td></tr>';
                htmlBody+='<tr><td>Available Seats</td><td>'+
                            item.seats+'</td></tr>';
                htmlBody+='<tr><td>Contribution</td><td>'+
                            item.contribution + ' $'+'</td></tr>';            
                htmlBody+='<tr><td>Within</td><td>';
                htmlBody+=item.maxMiles + ' Miles</td></tr><tr><td>Status</td>';
                htmlBody+='<td>'+getRideStatusName(item.status) 
                            + '</td></tr>';
                htmlBody+='<tr><td>Bag Size</td><td>'+
                            getBagSizeName(item.bagSize )+'</td></tr>';
                htmlBody+='<tr><td>Bags</td><td>'+
                            bags+'</td></tr>';  
                htmlBody+='<tr><td>Smoker</td><td>'+
                            smoker+'</td></tr>'; 
                htmlBody+='<tr><td>Note</td><td>'+
                            note+'</td></tr>';                                 
                htmlBody+='</tr></tbody></table></div>';
        });
    }
    else
    {
        htmlBody = '<div><h2 class="greenLabel">No ride is found.</h2></div>';
    }
    $('#postRidePanel').append(htmlBody);
}


//function get ride status name
/*
function getRideStatusName
(
    status
)
{
    var statusName='';
    switch(status)
    {
        case '0':
            statusName = 'Available';
            break;
        case '1':
            statusName = 'Pending';
            break;
        case '2':
            statusName = 'Full';
            break;
    }
    return statusName;
}
*/
//function addItem
function addItem
(
)
{
    var res = -1;
    var categoryId = getCategoryName(DRIVE);
    var itemData  =  {
        "info"    :  
        {
            "id"             : NO_ID, 
            "classId"        : categoryId,
            "pkgId"          : NO_ID, 
            "history"        : NO,
            "lotId"          : NO_ID,
            "autogen"        : YES,
            "prefix"         : DRIVE,
            "type"           : YES,
            "level"          : YES,
            "limit"          : NO,
            "description"    : '',
            "quantity"       : '',
            "commissionable" : YES,
            "taxable"        : YES,
            "active"         : YES,
            "display"        : YES,
            "sequence"       : NO,
            "number"         : YES,
            "name"           : DRIVE,
            "priceType"      : FIXED_TYPE
        },
        "features" : ''

    };

    var dataToSend  = {
        "action"    : ADD_ITEM,
        "item"      : JSON.stringify(itemData)   
    }
    $.ajax({
        type      : "POST",
        url       : API_URL,
        data      : dataToSend,                    	                    
        dataType  : "json",
        headers   : HEADER,
        async     : false,
        error     : function (e) 
        { 
            showAlertBox('Error',ERROR_MSG);
        },
        success   : function(jsonResult)
        { 
            res = jsonResult;
        }
    });

    return res;
}

//function add price
function addPrice
(
    itemId,
    contribution
)
{
    var res = -1;

    var priceList =
    [
        [
            contribution,
            contribution
        ]
    ];
    var dataToSend = 
    {
        "action"   : ADD_PRICE,
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
            showAlertBox("Error",ERROR_MSG);
        },
        success  : function(jsonResult)
        { 
            res = jsonResult;
        }
    });

    return res;
}

//function post ride.
function postRide
(
)
{
    var res = -1;
    var userDetails = sessionManager('getSession','user');
    if(userDetails)
    {
        res =  addItem();
        if(res.retCode)
        {
            var itemId = res.itemId;
            res =  addPrice(itemId,
                $( "#contributionPrice" ).html().split('$')[1] || 1);
            if(res.retCode)
            {
                postARide(userDetails,itemId);
            }
        }
    }
}
/* End of file commentPostRide.js */
/* Location: ./js/commentPostRide.js */ 