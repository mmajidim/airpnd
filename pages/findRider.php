<div class="box-container-inner container bodyContainer">
    <div class="container-fluid"> 
        <div class="row">
            <div class="container">
                <div class="container-fluid ">
                    <div class="container-fluid">
                        <div class="airspndDivider row-fluid">
                            <div class="span7">
                                <div class="span5" >
                                    <div class="airspndHeader pull-left">
                                        <span> Search Riders</span>
                                    </div>
                                    <div class="airspndHeaderImg pull-left">                        
                                    </div>
                                </div>
                            </div>                           
                        </div>
                        <div class="row-fluid">&nbsp;</div>
                        <div class="row-fluid">
                            <div class="span6">
                                <form id="findRiderform" class="errorPopUp rightSide pull-left row-fluid">
                                    <fieldset>
                                        <div class="row-fluid panel panel-success">
                                            <div class="panel-body">                                                
                                                <div class="row-fluid swapLocationAddress">
                                                    <div class="span3" id="startLabel">
                                                        Airport
                                                    </div>
                                                    <div id="fromLabelLoc" class="span9">
                                                        <select name="location" id="fromSelect" class="locationFindRider airport isShown" placeholder="Location"></select>   
                                                    </div>
                                                    <div id="addressFindRiderFrom" class="span9 hide">
                                                        <input type="text" name="address" id="addressFindRider" 
                                                               class="hide alphaNumeric airspndLocation ignore" class="from" placeholder="Address" />   
                                                    </div>                                                            
                                                </div>
                                                <div class="row-fluid swapLocationAddress  ">
                                                    <div class="pull-right ">                                 
                                                        <a class="exchange" href="#" >
                                                            <img src="resource/images/swapLocation.png" alt="" title="Swap to and from" />
                                                        </a> 
                                                    </div>
                                                </div> 
                                                <div class="row-fluid swapLocationAddress">

                                                    <div class="span3" id="toLabel">
                                                        Address
                                                    </div>
                                                    <div id="toLabelAdd" class="span9 hide">
                                                        <select name="location" id="locationFindRider" class="airport"></select>   
                                                    </div>
                                                    <div id="toAddress" class="span9">
                                                        <input type="text" name="geoLocation" id="geoLocation" 
                                                               class="alphaNumeric addressFindRider airspndLocation isShown" 
                                                               placeholder="Address" "/>   
                                                    </div>
                                                </div>
                                                <div class="row-fluid" style="height: 20px;"></div>
                                                <div class="row-fluid"></div>
                                                <!-- <div class="row-fluid">
                                                <div class="span10"> 
                                                <div class="pull-left range">WITHIN</div>
                                                <div id="findLocationRange" class="pull-right bold range"></div>         
                                                </div>
                                                </div>  -->
                                                <!-- <div class="row-fluid">                     
                                                <div class="span10">
                                                <div class="pull-left margin-right range">0</div>  
                                                <div id="findLocation" class="pull-left sliderRange"></div>
                                                <div class="slideRangeExt">50</div>
                                                </div>
                                                </div>  -->
                                                <div class="row-fluid">
                                                    <div class="span3">
                                                        Seats
                                                    </div>
                                                    <div class="span9">     
                                                        <!-- <input type="text" name="seatsFindRider" id="seatsFindRider" maxlength="2" placeholder="Seats" class="input-mini numeric"/>-->
                                                        <select id="seatsFindRider" name="seatsFindRider" placeholder="Choose Seats" name="seatsFindRider " class="seatsBagSize ignore" > 
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row-fluid">&nbsp;</div>
                                                <div class="row-fluid">
                                                    <div class="span3">
                                                        Bag Size
                                                    </div>
                                                    <div class="span9">     
                                                        <select id="bagSizeSelect" name="bagSizeFindRider" class="seatsBagSize " placeholder="Choose your bag Size">
                                                        </select> 
                                                        <!--<input type="text" name="bagSizeFindRider" 
                                                                   id="bagSizeFindRider" maxlength="2" placeholder="Bag size" class="input-mini numeric ignore" />-->
                                                    </div>
                                                </div>
                                                <div class="row-fluid">&nbsp;</div>
                                                <div class="row-fluid">
                                                    <div class="span3">
                                                        Bags
                                                    </div>
                                                    <div class="span9">  
                                                        <input type="text" name="bagsFindRider" id="bagsFindRider" maxlength="2" placeholder="Bags" class="input-mini ignore numeric"/>
                                                    </div>
                                                </div>
                                                 <div class="row-fluid">&nbsp;</div>
                                               <div class="row-fluid">
                                                <div class="span3">Smoker</div>
                                                <div class="span9">
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

                                                    <div class="span3">
                                                        Date
                                                    </div>
                                                    <div class="span9">
                                                        <div class="input-append">
                                                            <input id="date" name="date" class="input-medium date" placeholder="DATE" type="text">
                                                            <span class="add-on">
                                                                <i class="icon-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row-fluid">

                                                    <div class="span3">
                                                        Time
                                                    </div>
                                                    <div  class="span9">
                                                        <div class="input-append">
                                                            <input type="text" name="time" id="time" placeholder="TIME" class="input-mini" />
                                                            <span class="add-on">
                                                                <i class="icon-time"></i>
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row-fluid">&nbsp;</div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div class="span3">
                                                            &nbsp;
                                                        </div>
                                                        <div  class="span7">
                                                            <button type="submit" name="findRider" id="findRiderButton" class="btn btn-success">Find Rider</button>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>                
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="span6 pull-right">
                                <div id="panelMyLift" class="panel panel-success hide ">
                                    <div class="panel-heading"> 
                                        <h4 class="greenLabel">My Offers</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="liquid-slider"  id="myLiftsContainer">
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

</div>
</div>
</div>
</div>
<div class="clear clearfix">&nbsp;</div>