<div class="box-container-inner container bodyContainer">
    <div class="container-fluid"> 
        <div class="row">
            <div class="container">
                <div class="container-fluid ">
                    <div class="container-fluid">
                        <div class="airspndDivider row-fluid">
                            <div class="span7">
                                <div class="span7" >
                                    <div class="airspndHeader pull-left">
                                        <span><a class="underline" href="findRider.php"> Search Riders</a> - Book A Rider</span>
                                    </div>
                                    <div class="airspndHeaderImg pull-left">                        
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="row-fluid">&nbsp;</div>
                        <div class="row">
                            <div class="container-fluid">
                                <div class="span10 panel panel-success">
                                    <div class="panel-heading">
                                        <div class="row-fluid">
                                            <h3 class="panel-title span3">Riders</h3>
                                            <div class="span8 pull-right">
                                                <div class="row-fluid">
                                                    <div id="filterBy" class="span4 pull-right">Sort By<div>&nbsp;</div>
                                                        <select  id="filterPrice" class="ignore liftRideFilter" placeholder="Choose Price Filter ">
                                                            <option value="datetime" selected>Time</option>
                                                            <option value="maxMiles">Distance</option>
                                                            <option value="contribution">Price</option>
                                                        </select>
                                                    </div>

                                                    <div id="sortBy" class="span4 pull-right ">Sort Order<div>&nbsp;</div>
                                                        <select id="filterOrder" class="ignore liftRideFilter" placeholder="Choose Filter Order">
                                                            <option value="1">Asc</option>
                                                            <option value="2">Desc</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row-fluid"  id="rideContainer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>                
            </div>
        </div>
    </div>
</div>
<div class="clear clearfix">&nbsp;</div>
<div id ="popUpContainer" class="row-fluid hide">
    <div class="row-fluid">
        <div class="row-fluid">
            <div class="span2 pull-right">
                <a href="#" class="closePopUp pull-right" title="Close">X</a>
            </div>
        </div>
        <div class="row-fluid">            
            <div class="row-fluid">
                <textarea name="messageContent" maxlength="225" id="messageContent" placeholder="Enter your text"></textarea>
            </div>
            <div class="row-fluid">
                <button type="submit" id="sendSMS" class="btn btn-success smsTxt">Send SMS</button> 
                <div id="sendSmsLoader" class="offset1 span2 pull-right  hide">
                    <img src="resource/images/searchLoader.GIF" alt="..."/>
                </div>
            </div>
            <div class="row-fluid">&nbsp;</div>
        </div>
    </div>
</div>
<div id="panelMyLiftModel" class="span6">
    <div id="panelMyLift" class="panel panel-success modal fade in hide airspndModal">
        <div class="modal-header"> 
            <div class="pull-right close airspndClose" data-dismiss="modal" aria-hidden="true">
                <img src="resource/images/close_icon.png" alt="Close" title="Close"/>
            </div>
            <span class="modal-title">
                <h4 class="">My Rides</h4></span>
        </div>
        <div class="panel-body">
            <div class="liquid-slider"  id="myLiftsContainer">
            </div>
        </div>
    </div>
</div>   