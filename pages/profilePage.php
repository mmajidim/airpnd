<div class="box-container-inner container bodyContainer">
    <div class="container-fluid ">
        <div class="airspndDivider row-fluid">
            <div class="row-fluid">
                <div class="span5" >
                    <div class="airspndHeader pull-left">
                        <span>MY PROFILE</span>
                    </div>
                    <div class="airspndHeaderImg pull-left">                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">&nbsp;</div>
        <div class="span2 pull-right">
            <a id="editMyProfile" href="#">Edit</a>
        </div>
        <div class="span4">&nbsp;</div>
        <div class="row-fluid">
            <div class=" offset3 container-fluid">
                <div class="row-fluid">
                    <div  id="notification" class="alert alert-info span8 hide">
                        <div class="row-fluid">
                            <p id="msg"><center><strong>Please wait we are setting up your profile. </strong></center></p>
                        </div>
                    </div> 
                </div>
                <div id="confirmMessage" class="row-fluid hide">
                    <div id="error" class="alert alert-error span8 hide">
                        <div class="row-fluid">
                            <p><strong>Your profile could not be updated. Please change the field.</strong></p>
                        </div>
                    </div> 
                </div>
                <div class="row-fluid">
                    <form id="userProfile" class="errorPopUp rightSide">
                        <fieldset>
                            <div class="row-fluid">
                                <div class="span4 spanLabel">Name</div>
                                <div id="userFullNameProfilePage" class="span4 labelData"></div>
                                <div class="span4 profileEdit hide">
                                    <input type="text" name="firstName" class="alpha" id="firstProfilePage" placeholder="First Name" required/>
                                    <input type="text" name="middleName" class="alpha"  id="middleProfilePage" placeholder="Middle Name" class="ignore"/>
                                    <input type="text" name="lastName" class="alpha"  id="lastProfilePage" placeholder="Last Name" required/>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span4 spanLabel">Email ID</div>
                                <div id="emailIdProfilePage" class="span2 labelData"></div>
                                <div class="span2 profileEdit hide">
                                    <input type="text" name="email" id="emailProfilePage" placeholder="Email Address" readonly="true"/>
                                </div>
                            </div>
                            <div class="row-fluid passwordField hide">
                                <div class="span4 spanLabel">Password</div>                       
                                <div class="span2">
                                    <input type="password" name="password" id="passwordProfilePage" autocomplete="off" placeholder="Password" class="ignore"/>
                                </div>
                            </div>
                            <div class="row-fluid passwordField hide">
                                <div class="span4 spanLabel">Confirm Password</div>                              
                                <div class="span2">
                                    <input type="password" name="confirmPassword" autocomplete="off"  id="confirmPasswordProfilePage" placeholder="Confirm Password" class="ignore"/>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span4 spanLabel">Contact</div>
                                <div id="contact" class="span2 labelData"></div>
                                <div class="span4 profileEdit hide">
                                    <input type="text" name="phoneNumber" id="phoneNumber" placeholder="123-235-1234" required/>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span4 spanLabel">SMS Subscription</div>
                                <div id="smsAlert" class="span4 labelData"></div>
                                <div class="span4 profileEdit  hide">
                                    <input type="checkbox"  name="sms" id="sms" class="ignore" />
                                </div>
                            </div>
                            <div class="row-fluid accountField hide">
                            <div id ="accocuntName" class="span4 spanLabel"></div>                       
                            <div class="span2">
                                <input type="text" name="accountNumber" 
                                       id="accountNumber" autocomplete="off" 
                                       placeholder="Account Number" required/>
                            </div>
                            </div>
                            <div class="row-fluid accountField hide">
                            <div class="span">
                                <div class="span4">
                                &nbsp;
                                </div>
                                <div class="span8">
                                    <div class="span12">
                                        <div class="span6">
                                            <label class="checkbox">
                                                <input type="checkbox" name="account" 
                                                       id="paypal" 
                                                       class="account" 
                                                       data-for="Paypal Account" />Paypal Account  
                                            </label>
                                        </div>
                                        <div class="span6">
                                            <label class="checkbox">
                                                <input type="checkbox" name="account" 
                                                       id="ach" class="account" 
                                                       data-for="ACH Account"  />ACH Account  
                                            </label>
                                        </div>
                                    </div>                                           
                                </div>
                            </div>
                            </div>
                            <div class="row-fluid ">                               
                                <div class="span10 profileEdit hide">
                                    <div class="offset5 span3">
                                        <button type="submit" name="updateProfile" class="btn btn-primary" id="updateProfile" >Update</button>
                                    </div>
                                    <div class="span2">
                                        <button type="button" name="cancelUpdate" class="btn btn-default profileCancel" id="cancelBtn">Cancel</button>
                                    </div>
                                    <div class="span3">
                                        <div id="loaderUpdateProfile" class="hide">
                                            <img src="resource/images/searchLoader.GIF" alt="loading..."/>
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
</div>
<div class="clear clearfix">&nbsp;</div>