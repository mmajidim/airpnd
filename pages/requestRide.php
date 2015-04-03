<div class="box-container-inner container bodyContainer">
    <div class="container-fluid"> 
        <div class="row">
            <div class="container">
                <div class="container-fluid">
                    <div class="airspndDivider row-fluid">
                        <div class="span7">
                            <div class="span5" >
                                <div class="airspndHeader pull-left">
                                    <span> Request A Ride</span>
                                </div>
                                <div class="airspndHeaderImg pull-left">
                                </div>
                            </div>
                        </div>
                       <!-- <div class="span3 pull-right">
                            <a id="myLiftsRequestRide" href="myLifts.php" class="btn btn-success hide">My Offers</a>
                        </div> -->
                    </div>
                    <div class="row">&nbsp;</div>
                    <div class="row-fluid">
                        <div class="span5">
                            <div class="panel panel-success">
                                <div class="panel-body">
                                    <form id ="requestRideForm" class="errorPopUp rightSide">
                                        <fieldset>
                                            <div class="row-fluid">
                                                <div class="row-fluid">
                                                    <div class="span2">
                                                        Date
                                                    </div>
                                                    <div class="span4">
                                                        <div class="input-append ">
                                                            <input id="requestRideDateTime" name="dateRequestRide" class="input-large date" placeholder="DATE" type="text">
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
                                                        <div id="startLocationFrom" >
                                                            <select id="fromLocationRequestRide" name="startLocation" class="customBox airport  " placeholder="Choose your location">
                                                            </select> 
                                                        </div>  
                                                        <div id="startLocationTo" class="hide">
                                                            <input type="text" name="fromLocation" class="postRideLocationInput ignore" placeholder="Address" id="fromLocation" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row-fluid swapLocationAddress  ">
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
                                                        <div id="toLocationFrom">
                                                            <input type="text" name="toLocation" class="postRideLocationInput " placeholder="Address" id="toLocation" />  
                                                        </div> 
                                                        <div id="toLocationAirport" class="hide">
                                                            <select id="toLocationRequestRide" name="toLocation" class="customBox airport" placeholder="Choose your location">
                                                            </select>
                                                        </div>  
                                                    </div>
                                                </div>
                                                <div class="row-fluid"></div>
                                                
                                            <!--    <div class="row-fluid">
                                                    <div class="span4 range">
                                                        Maximum Radius
                                                        <i class="icon-question-sign" rel="tooltip" data-original-title="Maximum radius"></i>
                                                    </div>
                                                    <div class="span6">     
                                                        <div id="requestRideRange" class="range pull-right bold"></div>
                                                    </div>
                                                </div> -->
                                             <!--   <div class="row-fluid">                     
                                                    <div class="span11 slider">
                                                        <div class="pull-left margin-right range">0</div>
                                                        <div id="searchLocation" class=" sliderRange pull-left"></div>
                                                        <div class="pull-left range">50</div>
                                                    </div>
                                                </div>  -->
                                                <hr>
                                                <div class="row-fluid">
                                                    <div class="span2">
                                                        Seats
                                                    </div>
                                                    <div class="span6">     
                                                         <select id="seatsRequestRide" name="seatsRequestRide" placeholder="Choose Seats" name="seatsRequestRide" class="seatsBagSize" > 
                                                         </select> 
                                                    </div>
                                                </div>
                                                 <div class="row-fluid">&nbsp;</div>
                                                <div class="row-fluid">
                                                    <div class="span2">
                                                        Bag Size
                                                    </div>
                                                    <div class="span6">
                                                        <div id="bagSizeDiv">
                                                            <select id="requestRideBagSizeSelect" name="requestRideBagSizeSelect" 
                                                                    placeholder="Choose BagSize" name="bagSize" class="seatsBagSize"> 
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
                                                        <input type="text" name="bagSizePostRide" id="bagRequestRide" maxlength="2" 
                                                               placeholder="Bags" class="input-mini ignore numeric"/>
                                                    </div>
                                                </div>
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
                                                        <textarea id="liftNote" maxlength="200" name="liftNote" 
                                                                  class="input-large" placeholder="Note" maxlength="100"></textarea>
                                                    </div>
                                                </div> 
                                                <hr>
                                                <div class="row-fluid">
                                                    <div class="span2">
                                                    </div>
                                                    <div class="span6">     
                                                        <button type="submit" id="requestRide"  class="btn btn-success">REQUEST A RIDE</button>
                                                    </div>
                                                    <div id="requestRideLoader" class="span4 hide">
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
                                            <h4 class="blueLable"><a id="myLiftsRequestRide" href="myLifts.php" class="blueLable" title="Manage Rides" >Manage Requests</a></h4>
                                        </div>
                                        <div class="span2 pull-right">
                                            <i class="icon-minus-sign pull-right"></i>
                                        </div>
                                    </div>
                                </div>
                                <div id="requestRideContainer" class="panel-body">
                                    <div id="requestRidePanel" class="liquid-slider"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="panelMyRequestRide" class="panel panel-default hide">
                        <div class="panel-heading"> 
                            <h4 class="greenLabel"> My Lifts</h4>
                        </div>
                        <div class="panel-body">
                            <div id="myLiftsContainer" class="liquid-slider">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">&nbsp;</div>
    </div>
</div>
</div>
</div>
</div>
<div class="clear clearfix">&nbsp;</div>
<div id="paymentModalPopup" class="editRideModalPopUp">
    <div id="paymentModal" class="modal fade in hide">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="pull-right closeModal">
                        <img src="resource/images/close_icon.png" alt="Close" class="close" title="Close" data-dismiss="modal" aria-hidden="true"/>
                    </div>
                    <span class="modal-title">
                        <font size="5">Payment</font> 
                    </span>
                </div>
                <div class="modal-body">
                    <section class="container-fluid">                        
                        <div class="row-fluid">
                            <div class="span7 alert alert-success">
                                <div class="row-fluid">
                                    <div class="span4">
                                        <strong>Address</strong>
                                    </div>
                                    <div id="custAddress" class="span8">
                                       
                                    </div>
                                </div
                            </div>
                        </div>
                    </section>
                    <section id="paymentDetails" class="container-fluid">
                        <div class="container-fluid">
                            <div class="container-fluid  bodyContainer">
                                <div class="row-fluid">
                                    <div class="row-fluid">
                                        <form id="paymentForm" class="errorPopUp topSide">
                                            <fieldset> 
                                                <div class="span7 rightBorder">
                                                    <div class="container-fluid">
                                                        <div class="row-fluid">
                                                            <div class="span4">
                                                                Name
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span6">
                                                                    <input type="text" name="firstName" id="firstNamePayment" placeholder="First Name" class="input-medium"/>
                                                                </div>                                               
                                                            </div>
                                                        </div> 
                                                        <div class="row-fluid">
                                                            <div class="span4">
                                                                &nbsp;
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span6">
                                                                    <input type="text" name="middleNamePayment" id="middleNamePayment" placeholder="Middle Name" class="input-medium"/>
                                                                </div>                                               
                                                            </div>
                                                        </div> 
                                                        <div class="row-fluid">
                                                            <div class="span4">
                                                                &nbsp;
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span6">
                                                                    <input type="text" name="lastName" id="lastNamePayment" placeholder="Last Name" class="input-medium"/>
                                                                </div>                                               
                                                            </div>
                                                        </div> 
                                                        <div class="row-fluid">
                                                            <h6>Billing Address</h6></div>
                                                        <div class="row-fluid">
                                                            <div class="span4">
                                                                Street Address
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span6">
                                                                    <textarea name="streetAddress" id="steetAddress" class="input-medium"></textarea>
                                                                </div>                                                
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <div class="span4">
                                                                City
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span6">
                                                                    <input type="text" name="city" id="city" placeholder="City" class="input-medium"/>
                                                                </div>                                                
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <div class="span4">
                                                                State
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span6">
                                                                    <select name="state" id="state" placeeholder="Choose your state" class="input-medium"></select>
                                                                </div>                                                
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">&nbsp;</div>
                                                        <div class="row-fluid">
                                                            <div class="span4">
                                                                Zip Code
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span6">
                                                                    <input type="text" name="zipCode" id="zipCode" maxlength="6"  placeholder="Zip Code" class="input-medium"/>
                                                                </div>                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span5">
                                                    <div class="container-fluid">
                                                        <div id="ccTypeDiv" class="row-fluid">
                                                            <div class="span4">
                                                                Card Type
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span6">
                                                                    <select name="ccType" id="ccType" class="input-medium customBox" placeholder="Choose your card type.">
                                                                        <option></option>
                                                                    </select>
                                                                </div>                                                
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">&nbsp;</div>
                                                        <div  class="row-fluid">
                                                            <div class="span4">
                                                                Card Number
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span6">
                                                                    <input type="text" autocomplete="off" name="ccNumber" id="ccNumber" 
                                                                           maxlength="16" placeholder="Card Number" class="input-medium"/>
                                                                </div>                                                
                                                            </div>
                                                        </div>
                                                        <div id="ccExpMonthDiv" class="row-fluid">
                                                            <div class="span4">
                                                                Expiry
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span6">
                                                                    <select name="ccExpMonth" id="ccExpMonth" class="input-medium customBox" 
                                                                            placeholder="Choose card exp month.">
                                                                        <option></option>
                                                                    </select>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">&nbsp;</div>
                                                        <div id="ccExpYearDiv" class="row-fluid">
                                                            <div class="span4">
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span6">
                                                                    <select name="ccExpYear" id="ccExpYear" class="input-medium customBox" 
                                                                            placeholder="Choose your card exp year.">
                                                                        <option></option>
                                                                    </select>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">&nbsp;</div>
                                                        <div class="row-fluid">
                                                            <div class="span4">
                                                                CVV
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span8">
                                                                    <input type="text" autocomplete="off" name="cvv" maxlength="4" id="cvv" 
                                                                           placeholder="CVV" class="input-mini"/>
                                                                </div>                                                
                                                                <div class="span2">
                                                                    <img src="resource/images/questionmark.png" alt="What is this?"  class="paymentHelpImg" 
                                                                         rel="tooltip" 
                                                                         tile="" data-original-title="CVV are three or four-digit number on the back of a credit card (on the front for American Express)."/>
                                                                </div>                                                
                                                            </div>
                                                        </div>
                                                        <div  class="row-fluid">
                                                            <div class="span4">
                                                                Amount
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span6" id="amount">$
                                                                </div>                                                
                                                            </div>
                                                        </div>    
                                                        <div class="row-fluid">&nbsp;</div>
                                                        <div class="row-fluid">
                                                            <div class="span4">                                            
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span6">
                                                                    <button type="submit" name="pay" id="processPayment" class="btn btn-success">Pay</button>
                                                                </div> 
                                                                <div  id="paymentLoader" class="span2 hide">
                                                                    <!--<img src="resource/images/searchLoader.GIF" alt=""/>-->
                                                                    <div><b>Processing....</b></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-edit ride -->
        </div>
    </div>
</div>
