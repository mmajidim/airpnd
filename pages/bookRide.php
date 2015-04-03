<div class="box-container-inner container bodyContainer">
    <div class="container-fluid"> 
        <div class="row"></div>
            <div class="container-fluid">
                <div class="airspndDivider row-fluid">
                    <div class="span7">
                        <div class="span7" >
                            <div class="airspndHeader pull-left">
                                <span><a class="underline" href="findRide.php"> Search Drivers</a> - Book A Ride</span>
                            </div>
                            <div class="airspndHeaderImg pull-left">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="row-fluid">&nbsp;</div>
                    <div id="bookRiderContainer" class="row-fluid">
                        <div  class="row-fluid">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="row-fluid">
                                        <h5 class="panel-title span3" id="title">Rides</h5>
                                        <div class="span8 pull-right">
                                            <div class="row-fluid">
                                                <div id="filterBy" class="span4 pull-right">Sort By<div>&nbsp;</div>
                                                    <select  id="filterPrice" class="ignore liftRideFilter" placeholder="Choose Price Filter ">
                                                        <option value="datetime" selected>Time</option>
                                                        <option value="contribution">Price</option>
                                                        <option value="maxMiles">Distance</option>
                                                    </select>
                                                </div>
                                                <div id="sortBy" class="span4 pull-right ">Sort Order<div >&nbsp;</div>
                                                    <select id="filterOrder" class="ignore liftRideFilter" placeholder="Choose Filter Order">
                                                        <option value="1">Asc</option>
                                                        <option value="2">Desc</option>
                                                    </select>
                                                </div>  
                                            </div> 
                                        </div>                                             
                                    </div> 
                                </div>
                                <div id="riderResult"  class="panel-body"></div>
                            </div>
                        </div>
                        <div class="span3 pull-right">
                            <table id="bookedRiders" class="pure-table pure-table-bordered" >                       
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">&nbsp;</div>
            </div>
<!--            
            <div id="sendSMSContainer" class="span4 popoverContainer container-fluid">
                <div class="row-fluid">
                    <div class="span2 pull-right">
                        <a href="#" class="closePopUp pull-right close" title="Close">X</a>
                    </div>
                </div>
                <div class="row-fluid">&nbsp;</div>
                <div class="row-fluid">
                    <div class="row-fluid">
                        <textarea id="messageRider" maxlength="225" cols="2" rows="1" placeholder="Enter your text" required></textarea>
                    </div>
                </div>
                <div class="row-fluid">&nbsp;</div>
                <div class="row-fluid">
                    <div class="row-fluid">
                        <button type="submit" class="btn btn-success sendMessageRider"  name="sendMessageRider">SEND</button>
                        <div id="sendSmsLoader" class="offset1 span2 pull-right  hide">
                            <img src="resource/images/searchLoader.GIF" alt="..."/>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">&nbsp;</div>
            </div>
-->            
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
                <button type="submit" id="sendSMS" class="btn btn-success">Send SMS</button>
                <div id="sendSmsLoader" class="offset1 span2 hide pull-right ">
                    <img src="resource/images/searchLoader.GIF" alt="..."/>
                </div>
            </div>
            <div class="row-fluid">&nbsp;</div>
        </div>
    </div>
</div>  
<div id="panelMyRideModal" class="span6">
    <div id="panelMyRide" class="panel panel-success modal fade in hide airspndModal">
        <div class="modal-header"> 
            <div class="pull-right close airspndClose" data-dismiss="modal" aria-hidden="true">
                <img src="resource/images/close_icon.png" alt="Close" title="Close"/>
            </div>
            <span class="modal-title">
                <h4 > My Lifts</h4>
            </span>  
        </div>
        <div class="panel-body">
            <div class="liquid-slider"  id="myFindRideContainer">
            </div>
        </div>
    </div>
 </div>   