;(function ($, window, undefined) {
  'use strict';

  var $doc = $(document),
      Modernizr = window.Modernizr,
      lt_ie9 = false;

$.noConflict();
  jQuery(document).ready(function($) {
    
    $.fn.foundationMediaQueryViewer ? $doc.foundationMediaQueryViewer() : null;
    $.fn.foundationTabs             ? $doc.foundationTabs() : null;

    if (Modernizr.touch && !window.location.hash) {
      $(window).load(function () {
        setTimeout(function () {
          window.scrollTo(0, 1);
        }, 0);
      });
    }

    $("body").iealert({
      support: 'ie7'
    });

    prettyPrint();

    if($('html').hasClass('lt-ie9')) {
      lt_ie9 = true;
    }


var LocsA = [];
var dataToSend = 
{
    "action"    :GET_LOCATIONS
}

$.ajax({
    type: "POST",
    url: CUSTOM_API_URL,
    data: dataToSend,                    	                    
    dataType: "json",
    headers: header,
    async : false,
    error: function (e) 
    {              

    },
    success: function(jsonResult)
    {
        var airLocation = jsonResult.locations;        
        $.each(airLocation,function(index,item){
            var dataLocation;
            dataLocation =  {   
                "lat": item.latitude,
                "lon": item.longitude,
                "title": item.name, 
                "html":item.region+'-'+item.name, 
                "icon": 'resource/images/airport.png',
                "zoom": 10,
            	visible: true
            }
			LocsA.push(dataLocation); 
        });
    }
});

    //Simple Example, dropdown on map
    var dropdown = new Maplace({
      map_div: '#gmap-2',
      controls_title: 'Choose a location:',
       view_all: false,
       start : DEFAULT_MAP_ID,				
      locations: LocsA
    });

    $('#markers').one('inview', function(event, isInView) {
      if (isInView) {
        dropdown.Load();
      } 
    }); 


    if(lt_ie9) {
      dropdown.Load();
    }



  });//ready

})(jQuery, this);
