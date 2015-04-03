<div class="box-container-inner container bodyContainer">
    <div class="container-fluid">
        <div class="container-fluid ">
            <div class="airspndDivider row-fluid">
                <div class="row-fluid">
                    <div class="span5" >
                        <div class="airspndHeader pull-left">
                            <span> <a href="requestRide.php" class="underline">Request A Ride</a> - Requests</span>
                        </div>
                        <div class="airspndHeaderImg pull-left">                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">&nbsp;</div>
            <div class="row-fluid">
                <div class="span7">
                    <div id="panelMyRequestRide" class="panel panel-default">
                        <div class="panel-heading"> 
                            <h4 class="greenLabel"> My Requests</h4>
                        </div>
                        <div class="panel-body">
                            <div id="myLiftsContainer" class="liquid-slider">                             
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span5">
                    <div id="rideAssignedPanel" class="panel panel-default hide">
                        <div class="panel-heading"> 
                            <h4 class="greenLabel">My Drivers</h4>
                        </div>
                        <div  class="panel-body">
                            <table id="rideAssignedContainer" class="table table-bordered"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="clear clearfix">&nbsp;</div>
<div id="editLiftModalPopUp" class="editRideModalPopUp">
    <div id="editLiftModal" class="modal fade in hide">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="pull-right closeModal">
                        <img src="resource/images/close_icon.png" alt="Close" title="Close"/>
                    </div>
                    <span class="modal-title">
                        <font size="5">Edit Lift</font> 
                    </span>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal errorPopUp topSide" id="editLiftForm">
                        <fieldset>
                            <div class="container-fluid">                      
                                <div id="message" class="row hide">
                                    <div id="messageContent" class="alert alert-error">  
                                    </div>
                                </div>
                                <div class="row-fluid editLiftContainer">
                                    <div class="span3">
                                        Date
                                    </div>
                                    <div class="span7">
                                        <div class="input-append">
                                            <input type="text" name="editLiftDateTime" id="editLiftDateTime" class="input-medium date"/>
                                            <span class="add-on">
                                                <i class="icon-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid">&nbsp;</div>
                                <div class="row-fluid editLiftContainer">
                                    <div class="span3">
                                        Time
                                    </div>
                                    <div class="span7">
                                        <div class="input-append">
                                            <input type="text" name="editLiftTime" id="editLiftTime" class="input-medium date"/>
                                            <span class="add-on">
                                                <i class="icon-time"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid">&nbsp;</div>
                                <div class="row-fluid editLiftContainer swapLocationAddress">
                                    <div class="span3" id="startLabel">
                                        Airport
                                    </div>
                                    <div class="span7">
                                    <div id="startLocation">
                                         <select name="editLiftStartLocation" class="airport isShown" id="editLiftStartLocation" placeholder="Pick Up Point">
                                        </select>
                                    </div>
                                    <div id="toLocationStart" class="hide">
                                        <input type="text" maxlength="100" name="editLiftFromAddress" id="editLiftFromAddress" placeholder="Pick Up" class="myLiftLocationInput input-large ignore"/>
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
                                
                                <div class="row-fluid editLiftContainer myLiftSwapHeight">
                                    <div class="span3" id="toLabel">
                                         Address
                                    </div>
                                    <div class="span7">
                                    <div id="toLocation">
                                        <input type="text" maxlength="100" name="editLiftToAddress" id="editLiftToAddress" placeholder="Drop Off" class="myLiftLocationInput input-large isShown"/>
                                    </div>
                                    <div id="toStartLocation" class="hide">
                                        <select name="editLiftStartLocationTo" class="airport" id="editLiftStartLocationTo" placeholder="Pick Up Point">
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="row-fluid">&nbsp;</div>                               
                               <!-- <div class="row-fluid ">
                                    <div class="span2">
                                        Within
                                    </div>
                                    <div class="span10">     
                                        <div id="editLiftRange" class="pull-right bold"></div>
                                    </div>
                                </div> -->
                              <!--  <div class="row-fluid ">                     
                                    <div class="row-fluid slider">
                                        <div class="pull-left margin-right">0</div>
                                        <div id="editLiftLocation" class="pull-left"></div>
                                        <div class="pull-left">50</div>
                                    </div>
                                </div> -->
                                <div class="row-fluid">&nbsp;</div>
                                <div class="row-fluid editLiftContainer">
                                    <div class="span3">
                                        Seats
                                    </div>
                                    <div class="span7">
                                        <select id="editLiftSeat" name="bagSize" class="seatsBagSize  " placeholder="Choose BagSize">
                                        </select> 
                                    </div>
                                </div>
                                <div class="row-fluid">&nbsp;</div>
                                 <div class="row-fluid editLiftContainer">
                                    <div class="span3">
                                        Bag Size
                                    </div>
                                    <div class="span7">
                                   <select id="myLiftbagSizeSelect" name="bagSize" class="seatsBagSize  " placeholder="Choose BagSize">
                                        </select> 
                                    </div>
                                </div>
                                  <div class="row-fluid">&nbsp;</div>
                                       <div class="row-fluid">
                                          <div class="span3">
                                                        Bags
                                            </div>
                                                <div class="span7">  
                                                        <input type="text" name="editLiftBags" id="editLiftBags" maxlength="2" placeholder="Bags" class="input-mini ignore numeric"/>
                                                  </div>
                                                </div>
                                <div class="row-fluid">&nbsp;</div>

                                <div class="row-fluid editLiftContainer">
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
                                <div class="row-fluid editLiftContainer">
                                    <div class="span3">
                                        Note
                                    </div>
                                    <div class="span7">
                                        <textarea id="editLiftNote" maxlength="200" name="editLiftNote" class="input-large" placeholder="Note" maxlength="100"></textarea>
                                    </div>
                                </div>    
                                <div class="row-fluid">&nbsp;</div>
                                <div class="row-fluid editLiftContainer">
                                    <div class="span3">&nbsp;</div>
                                    <div class="span9">
                                        <div class="row-fluid pull-left">
                                            <div class="span4">
                                                <button id="updateLift" name="updateLift" class="btn btn-success">Update</button>
                                            </div>
                                            <div id="editLiftLoader" class="span4 hide">
                                                <img src="resource/images/searchLoader.GIF" alt="Logging.."/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-edit Lift -->
        </div>
    </div>
</div>
<div id="paymentModalPopup" class="paymentModalPopUp">
    <div id="paymentModal" class="modal fade in hide">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="pull-right close" data-dismiss="modal" aria-hidden="true">
                        <img src="resource/images/close_icon.png" alt="Close" title="Close"/>
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
                                <div class="container-fluid ">
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
                                                                    <input type="text" name="zipCode" maxlength="6" id="zipCode" placeholder="Zip Code" class="input-medium"/>
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
                                                                    <input type="text" name="ccNumber" maxlength="16" id="ccNumber" 
                                                                           placeholder="Card Number" autocomplete="off" class="input-medium"/>
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
                                                                <div class="span6">
                                                                    <input type="text" name="cvv" id="cvv" maxlength="4" placeholder="CVV" class="input-mini"/>
                                                                </div>                                                
                                                                <div class="span2">
                                                                    <img src="resource/images/questionmark.png" alt="What is this?"  
                                                                         class="paymentHelpImg" rel="tooltip" tile="" 
                                                                         data-original-title="CVV are three or four-digit number on the back of a credit card (on the front for American Express)."/>
                                                                </div>                                                
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <div class="span4">
                                                                Amount
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span6" id="amount">$
                                                                </div>                                                
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">&nbsp;</div>
                                                        <div class="row-fluid">&nbsp;</div>
                                                        <div class="row-fluid">
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