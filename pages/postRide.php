<div class="box-container-inner container">
    <div class="container-fluid bodyContainer"> 
        <div class="row">
            <div class="container-fluid">
                <div class="airspndDivider row-fluid">
                    <div class="span7">
                        <div class="span5" >
                            <div class="airspndHeader pull-left">
                                <span> Offer A Ride</span>
                            </div>
                            <div class="airspndHeaderImg pull-left">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="span3 pull-right">
                    <a id="myBookingsPostRide" href="myBookings.php" class="btn btn-success hide" >My Requests</a>
                    </div> -->
                </div>
                <div class="row">&nbsp;</div>
                <div class="row-fluid">
                    <div class="span5">

                        <div class="panel panel-success">
                            <div class="panel-body">
                                <form id ="postRideForm" class="errorPopUp rightSide">
                                    <fieldset>
                                        <div class="row-fluid">
                                            <div class="row-fluid">
                                                <div class="span2">
                                                    Date
                                                </div>
                                                <div class="span4">
                                                    <div class="input-append ">
                                                        <input id="date" name="datePostRide" class="input-large date" placeholder="DATE" type="text">
                                                        <span class="add-on">
                                                            <i class="icon-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row-fluid">
                                                <div class="span2" id="startLabel">
                                                    Airport
                                                </div>
                                                <div class="span6">  
                                                    <div id="startLocationSelect">
                                                        <select id="startLocation" name="startLocation" class="airport customBox " placeholder="Choose your location">
                                                        </select> 
                                                    </div> 
                                                    <div id="startLocationInput" class="hide">
                                                        <input type="text" name="startToLocation" class="postRideLocationInput ignore" placeholder="Address" id="startToLocation" />
                                                    </div>  

                                                </div>
                                            </div>

                                            <div class="row-fluid swapLocationAddress ">
                                                <div class="pull-right ">                                 
                                                    <a class="exchange" href="#" >
                                                        <img src="resource/images/swapLocation.png" alt="" title="Swap to and from" />
                                                    </a> 
                                                </div>
                                            </div> 
                                            <div class="row-fluid">
                                                <div class="span2" id="toLabel">
                                                    Address
                                                </div>
                                                <div class="span6">    
                                                    <div id="toLocationInput">
                                                        <input type="text" name="toLocation" class="postRideLocationInput" placeholder="Address" id="toLocation" />
                                                    </div> 
                                                    <div id="toLocationSelect" class="hide">
                                                        <select id="toStartLocation" name="startLocation" class="airport customBox " placeholder="Choose your location">
                                                        </select> 
                                                    </div>    
                                                </div>
                                            </div>
                                             <div class="row-fluid">&nbsp;</div>
                                            <div class="row-fluid">
                                                <div class="span2">
                                                    Via
                                                </div>
                                                <div class="span6">      
                                                    <input type="text" name="viaLocation" class="postRideLocationInput" placeholder="Via location" id="viaLocation" />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row-fluid">
                                                <div class="span11">
                                                    <div class="range span4">Maximum Radius
                                                        <i class="icon-question-sign" rel="tooltip" data-original-title="Maximum Radius from Home Location"></i></div>
                                                    <div id="locationRange"  class="pull-right bold range"></div>
                                                </div>
                                            </div>
                                            <div class="row-fluid margin-bottom">
                                                <div class="range">0</div>
                                                <div class="sliderRange">
                                                    <div id="searchLocation" ></div>
                                                </div>
                                                <div id="maxDistance" class="range">50</div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span11">
                                                    <div class="range span5"> Minimum Rider Contribution
                                                    </div>
                                                    <div id="" class="range pull-right span4 ">Maximum Rider Contribution</div>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="range">0</div>
                                                <div class="sliderRange">
                                                    <div id="contribution"></div>
                                                </div>
                                                <div id="maxPrice" class="range">50</div>
                                            </div>
                                            <hr>
                                            <div class="row-fluid">
                                                <div class="span11">
                                                    <div class="range span9"> Maximum Contribution per Rider
                                                        <i class="icon-question-sign" rel="tooltip" data-original-title="Minimum contribution is the cost to/from the Drivers Home Location Only. Maximum Rider Contribution is the minumum contriubtion plus the variable contribution at the maximum radius."></i>
                                                    </div>
                                                    <div id="contributionPrice" class="range pull-right bold"></div>
                                                </div>
                                            </div>
                                            <div class="row-fluid">&nbsp;</div>
                                            <div class="row-fluid">
                                                <div class="span2">
                                                    Seats
                                                </div>
                                                <div class="span6"> 
                                                    <div id="seatDiv" class="span3">
                                                        <select id="seats" name="seats" placeholder="Choose Seats" name="seats" class="seatsBagSize ignore " > 
                                                        </select> 
                                                    </div>    
                                                </div>
                                            </div>
                                            <div class="row-fluid">&nbsp;</div>
                                            <div class="row-fluid">
                                                <div class="span2">
                                                    Bag Size
                                                </div>
                                                <div class="span6">     
                                                    <div id="bagSizeDiv">
                                                        <select id="bagSizePostRide" name="bagSize" class="seatsBagSize  " placeholder="Choose bag Size">
                                                        </select> 
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="row-fluid">&nbsp;</div>
                                            <div class="row-fluid">
                                                <div class="span2">
                                                    Bags
                                                </div>
                                                <div class="span6">  
                                                    <input type="text" name="bagSizePostRide" id="bagPostRide" maxlength="2" placeholder="Bags" class="input-mini ignore numeric"/>
                                                </div>
                                            </div>
                                            <div class="row-fluid">&nbsp;</div>
                                            <div class="row-fluid">
                                                <div class="span2">Smoker</div>
                                                <div class="span6">
                                                    <div class="smoker">
                                                        <input type="checkbox" name="smoker" class="smoker-checkbox" id="smoker">
                                                        <label class="smoker-label" for="smoker">
                                                            <div class="smoker-inner"></div>
                                                            <div class="smoker-switch"></div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-fluid">&nbsp;</div>
                                            <div class="row-fluid">
                                                <div class="span2">
                                                    Note
                                                </div>
                                                <div class="span7">
                                                    <textarea id="rideNote" maxlength="200" name="rideNote" class="input-large" placeholder="Note" maxlength="100"></textarea>
                                                </div>
                                            </div> 
                                             <div class="row-fluid">
                                                    <label class="checkbox">
                                                        <input required type="checkbox" name="termsCondition" id="termsCondition" />
                                                        I agree to the <a href="#" onclick="window.open('terms.php');return false;" target="_blank">Terms and Conditions.</a>
                                                    </label>                                
                                                </div>
                                            <hr>
                                            <div class="row-fluid">
                                                <div class="span2">
                                                </div>
                                                <div class="span5">     
                                                    <div class="span4">
                                                        <button id="postRide"  class="btn btn-primary hide">POST RIDE</button>
                                                    </div>
                                                </div>
                                                <div id="editRideLoader" class="span2 hide">
                                                    <img src="resource/images/searchLoader.GIF" alt=".."/>
                                                </div>
                                            </div>                                
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="span6 pull-right"> 
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <div class="row-fluid">
                                    <div class="span4 pull-left">
                                        <h4 class="blueLable"><a id="myBookingsPostRide" href="myBookings.php" class="blueLable" title="Manage Offers" >Manage Offers</a></h4>
                                    </div>
                                    <div class="span2 pull-right">
                                        <i class="icon-minus-sign pull-right"></i>
                                    </div>
                                </div>
                            </div>
                            <div  class="panel-body">
                                <div id="postRidePanel" class="liquid-slider"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">&nbsp;</div>
            </div>
        </div>
    </div>
</div>
<div class="clear clearfix">&nbsp;</div>
