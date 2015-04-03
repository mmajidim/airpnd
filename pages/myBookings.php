<div class="box-container-inner container bodyContainer">
    <div class="container-fluid">
        <div class="container ">
            <div class="airspndDivider row-fluid">
                <div class="row-fluid">
                    <div class="span5" >
                        <div class="airspndHeader pull-left">
                            <span><a class="underline" href="postRide.php"> Offer A Ride</a> - Offers</span>
                        </div>
                        <div class="airspndHeaderImg pull-left">                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">&nbsp;</div>
            <div class="row-fluid">
                <div class="span6">
                    <div id="panelMyRide" class="panel panel-default">
                        <div class="panel-heading"> 
                            <h4 class="greenLabel"> My Offers</h4>
                        </div>
                        <div class="panel-body">
                            <div id="myRidesContainer" class="liquid-slider">                             
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span5">
                    <div id="liftAssignedPanel" class="panel panel-default hide">
                        <div class="panel-heading"> 
                            <h4 class="greenLabel">My Riders</h4>
                        </div>
                        <div  class="panel-body">
                            <div id="liftAssignedContainer" class="liquid-slider">                             
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
<div id="editRideModalPopUp" class="editRideModalPopUp">
    <div id="editRideModal" class="modal fade in hide">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="pull-right closeModal">
                        <img src="resource/images/close_icon.png" alt="Close" title="Close"/>
                    </div>
                    <span class="modal-title">
                        <font size="5">Edit Ride</font> 
                    </span>
                </div>
                <div class="modal-body">
                    <form class="container-fluid form-horizontal errorPopUp topSide" id="editRideForm">
                        <fieldset>
                            <div class="container-fluid">                      
                                <div id="message" class="row hide">
                                    <div id="messageContent" class="alert alert-error">  
                                    </div>
                                </div>
                                <div class="row-fluid editRideContainer">
                                    <div class="span3">
                                        Date
                                    </div>
                                    <div class="span6">
                                        <div class="input-append">
                                            <input type="text" name="editRideDateTime" id="editRideDateTime" class="input-large date"/>
                                            <span class="add-on">
                                                <i class="icon-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid editRideContainer">
                                    <div class="span3">
                                        Time
                                    </div>
                                    <div class="span6">
                                        <div class="input-append">
                                            <input type="text" name="editRideTime" id="editRideTime" class="input-large date"/>
                                            <span class="add-on">
                                                <i class="icon-time"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid editRideContainer myBookingSwapHeight">
                                    <div class="span3" id="startLabel">
                                        Airport
                                    </div>
                                    <div class="span6">
                                        <div id="startEditRideSelect">
                                            <select name="editRideStartLocation" class="airport isShown" id="editRideStartLocation" placeholder="Pick Up Point">
                                            </select>
                                        </div>

                                        <div id="startEditRideInput" class="hide">
                                            <input type="text" maxlength="100" name="editRideFromAddress" id="editRideFromAddress" placeholder="Address" class="input-large ignore"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid  swapPositionMyBooking ">
                                    <div class="pull-right ">                                 
                                        <a class="exchange" href="#" >
                                            <img src="resource/images/swapLocation.png" alt="" title="Swap to and from" />
                                        </a> 
                                    </div>
                                </div> 
                                <div class="row-fluid editRideContainer myBookingSwapHeight">
                                    <div class="span3" id="toLabel">
                                        Address
                                    </div>
                                    <div class="span6">
                                        <div id="toEditRideInput">
                                            <input type="text" maxlength="100" name="editRideToAddress" id="editRideToAddress" placeholder="Address" class="input-large isShown"/>
                                        </div>
                                        <div id="toEditRideSelect" class="hide">
                                            <select name="editRideStartLocation" class="airport" id="editRideToStartLocation" placeholder="Pick Up Point">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                  <div class="row-fluid ">&nbsp;</div>
                                <div class="row-fluid editRideContainer">
                                    <div class="span3">
                                        Via
                                    </div>
                                    <div class="span6">
                                        <input type="text" maxlength="100" name="editRideViaLocation" id="editRideViaLocation" placeholder="Via Point" class="input-large  ignore"/>
                                    </div>
                                </div>
                                <div class="row-fluid ">
                                    <div class="span2">
                                        Within
                                    </div>
                                    <div class="span7">     
                                        <div id="editRideRange" class="pull-right bold"></div>
                                    </div>
                                </div>
                                <div class="row-fluid ">                     
                                    <div class="span12 slider">
                                        <div class="pull-left margin-right">0</div>
                                        <div id="editRideLocation" class="pull-left"></div>
                                        <div id="maxDistance" class="pull-left">50</div>
                                    </div>
                                </div>
                                <div class="row-fluid ">
                                    <div class="span2">
                                        Contribution
                                    </div>
                                    <div class="span7">     
                                        <div id="editRidePriceRange" class="pull-right bold"></div>
                                    </div>
                                </div>
                                <div class="row-fluid ">                     
                                    <div class="span12 slider">
                                        <div class="pull-left margin-right">0</div>
                                        <div id="editRidePriceSlider" class="sliderExt pull-left"></div>
                                        <div id="maxPrice" class="pull-left">50</div>
                                    </div>
                                </div>
                                <div class="row-fluid ">&nbsp;</div>
                                <div class="row-fluid editRideContainer">
                                    <div class="span3">
                                        Seats
                                    </div>
                                    <div class="span6">
                                        <!-- <input type="text" maxlength="2" name="editRideSeat" id="editRideSeat" placeholder="Seat Available" class="input-mini"/>-->
                                        <select id="editRideSeat" name="bagSize" class="seatsBagSize  " placeholder="Choose seats">
                                        </select> 
                                    </div>
                                </div>
                                <div class="row-fluid editRideContainer">
                                    <div class="span3">
                                        Bag Size
                                    </div>
                                    <div class="span6">
                                        <select id="editRideBagSizeSelect" name="bagSize" class="seatsBagSize " placeholder="Choose BagSize">
                                        </select> 
                                    </div>
                                </div>
                                <div class="row-fluid editRideContainer">
                                    <div class="span3">
                                        Bags
                                    </div>
                                    <div class="span6">
                                        <input type="text" maxlength="2" name="editBags" id="editBags" placeholder="Bags" class="input-mini ignore numeric"/>  
                                    </div>
                                </div>

                                <div class="row-fluid editRideContainer">
                                    <div class="span3">
                                        Smoker
                                    </div>
                                    <div class="span2">
                                        <div class="smoker">
                                            <input type="checkbox" name="smoker" class="smoker-checkbox" id="smoker" >
                                            <label class="smoker-label" for="smoker">
                                                <div class="smoker-inner"></div>
                                                <div class="smoker-switch"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row-fluid editRideContainer">
                                    <div class="span3">
                                        Notes
                                    </div>
                                    <div class="span6">
                                        <textarea maxlength="200" id="editRideNote" name="editRideNote" class="input-large" placeholder="Note" maxlength="100"></textarea>
                                    </div>
                                </div>
                                <!--  smoker -->
                                <!--   <div class="row">
                                <div class="span3 smokerLabel postLabel">SMOKER</div>
                                <div class="span2">
                                <div class="smoker">
                                <input type="checkbox" name="smoker" class="smoker-checkbox" id="smoker" checked>
                                <label class="smoker-label" for="smoker">
                                <div class="smoker-inner"></div>
                                <div class="smoker-switch"></div>
                                </label>
                                </div>
                                </div>
                                </div>  -->
                                <div class="row-fluid editRideContainer">
                                    <div class="span3">&nbsp;</div>
                                    <div class="span9">
                                        <div class="row-fluid pull-left">
                                            <div class="span4">
                                                <button id="updateRide" name="updateRide" class="btn btn-success">Update</button>
                                            </div>
                                            <div id="editRideLoader" class="span4 hide">
                                                <img src="resource/images/searchLoader.GIF" alt=".."/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-edit ride -->
        </div>
    </div>
</div>