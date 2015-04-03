<div class="box-container-inner container bodyContainer">
    <div class="container-fluid ">
        <div class="airspndDivider row-fluid">
            <div class="row-fluid">
                <div class="span5" >
                    <div class="airspndHeader pull-left">
                        <span>Confirm My Ride</span>
                    </div>
                    <div class="airspndHeaderImg pull-left">                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">&nbsp;</div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="offset2 span8 panel panel-success"> 
                    <div class="panel-heading">
                        <h4 class="panel-title">Thank you for using AirPnD for requesting rides.</h4>
                    </div>  
                    <div id="confirmRide" class="panel-body">                      
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span10">
                <div class="container-fluid">                
                    <div class="row-fluid">
                        <div id="activationSuccess" class="alert alert-info hide">
                            <p><center><strong><p><h1>&#9786;</h1></p></strong></center>
                            <p><center><strong><p>You have confirm the ride.</p></strong></center>
                        </div>
                    </div>                
                    <div class="row-fluid">
                        <form id="verifyAccountForm" class="errorPopUp topSide">
                            <fieldset>                            
                                <div></div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>           
        </div>
    </div>
</div>
<div class="clear clearfix">&nbsp;</div>
<div id="ridePaymentModalPopup" class="editRideModalPopUp">
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
                    <section id="paymentDetails" class="container-fluid">
                        <div class="container-fluid">
                            <div class="container-fluid  bodyContainer">
                                <div class="row-fluid">
                                    <div class="row-fluid">
                                        <form id="paymentForm" class="errorPopUp topSide">
                                            <fieldset> 
                                                <div class="span6 rightBorder">
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
                                                                    <input type="text" name="zipCode" id="zipCode" placeholder="Zip Code" class="input-medium"/>
                                                                </div>                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span6">
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
                                                                    <input type="text" autocomplete="off" name="ccNumber" id="ccNumber" maxlength="16" placeholder="Card Number" class="input-medium"/>
                                                                </div>                                                
                                                            </div>
                                                        </div>
                                                        <div id="ccExpMonthDiv" class="row-fluid">
                                                            <div class="span4">
                                                                Expiry
                                                            </div>
                                                            <div class="span8">
                                                                <div class="span6">
                                                                    <select name="ccExpMonth" id="ccExpMonth" class="input-medium customBox" placeholder="Choose card exp month.">
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
                                                                    <select name="ccExpYear" id="ccExpYear" class="input-medium customBox" placeholder="Choose your card exp year.">
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
                                                                    <input type="text" autocomplete="off" name="cvv" id="cvv" placeholder="CVV" class="input-mini"/>
                                                                </div>                                                
                                                                <div class="span2">
                                                                    <img src="resource/images/questionmark.png" alt="What is this?"  class="paymentHelpImg" rel="tooltip" tile="" data-original-title="CVV are three or four-digit number on the back of a credit card (on the front for American Express)."/>
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
                                                                    <img src="resource/images/searchLoader.GIF" alt=""/>
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