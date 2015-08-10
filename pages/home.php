<div class="container-fluid homeScreen bodyContainer">
    <div class="videoContainer">
        <center>
            <video id="headerVideo" controls height="55%" width="60%"  poster="resource/images/video.png">
                <source src="resource/video/airpnd.mp4" type="video/mp4">
                <source src="resource/video/airpnd.ogg" type="video/ogg">
                Your browser does not support the video tag.
            </video>
        </center>            
    </div>
</div>

<div class="row">
    <div class="span3">
        <div class="row-fluid">
            <div class="row-fluid">
                <div class="col-md-11">
                    <img src="resource/images/icon-contact.png"  class="span2 contactUsImg" alt=""/>
                    <h4 class="span6">
                        <a href='https://secure.airpnd.com/support.php' 
                           style="color:black">Contact Us
                        </a>
                    </h4>
                </div>
            </div>
            <div class="row-fluid ">
                <div class="col-md-9 contactBorder">
                    1-866-552-2477
                </div>
            </div>
            <div class="row-fluid">
                <div class="col-md-10" id ='socialConnect'>
                </div> 
            </div>
        </div>
    </div>
    <div class="span5">
        <div class="row-fluid">
            <div class="row-fluid">
                <label class="greenFont">A SMARTER WAY TO PLAN AND SHARE WHEN YOU TRAVEL</label>
            </div>
            <div class="row-fluid">
                <span><b>Who we are?</b></span>
                <p>A social web-based ride sharing that promotes and allows you to find rides to/from airports with other individuals also commuting to/from airports.</p>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="row-fluid">
            <div class="col-md-5 noPad margin-bottom margin-right">
                <select id="airportLocation" name="location" class="airport  customBox ignore" placeholder="Choose your location">
                    <option></option>
                </select>
            </div>
            <div class="col-med-1 span2"></div>
            <div class="col-md-3 no-pad">
                <input id="go_btn" type="image" hideFocus="true" src="resource/images/go_btn.png" alt="GO"/>
            </div>
        </div>   
        <div class="row-fluid">
            <div id="airspndPage" class="radio row-fluid">
                <label class="radio-inline span6">
                    <input type="radio" class="airspndPage active " checked  name="quickNav" data-for="findRider.php">Search Riders
                </label>
                <label class="radio-inline">
                    <input type="radio" class="airspndPage" name="quickNav" data-for="findRide.php">Search Drivers
                </label>
            </div>
        </div>
    </div>
    </div>
    <div class="row">&nbsp;</div>
</div>
