<div class="box-container-inner container bodyContainer">
    <div class="container-fluid ">
        <div class="airspndDivider row-fluid">
            <div class="row-fluid">
                <div class="span5" >
                    <div class="airspndHeader pull-left">
                        <span>ACTIVATION</span>
                    </div>
                    <div class="airspndHeaderImg pull-left">                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">&nbsp;</div>
        <div class="row-fluid">
            <div class="span10">
                <div class="container-fluid">                
                    <div class="row-fluid">
                        <div id="activationSuccess" class="alert alert-info hide">
                            <p><center><strong><p><h1>&#9786;</h1></p></strong></center>
                            <p><center><strong><p>Your email address has been successfully verified. Please continue to Sign In using your username and your account's password.</p></strong></center>
                        </div>
                    </div>                
                    <div class="row-fluid">
                        <div id="activationError" class="alert alert-error hide">
                            <p><center><strong><p><h1>&#9786;</h1></p></strong></center>
                            <p><center><strong>Sorry your credentials does not match our records.</strong></center></p>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div id="activationActivationLinkError" class="alert alert-error hide">
                            <p><center><strong><p><h1>&#9786;</h1></p></strong></center>
                            <p><center><strong>Sorry activation link is not valid.</strong></center></p>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <form id="verifyAccountForm" class="errorPopUp topSide">
                            <fieldset>                            
                                <div class="offset4 span7">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            User Name
                                        </div>
                                        <div  class="span4">
                                            <div id="userNameLabel" class="greenLabel">-</div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span3">
                                            Password
                                        </div>
                                        <div class="span4">
                                            <input type="password" class="input-medium" maxlength="20" autocomplete="off" name="passwordActivationPage" id="passwordActivationPage" placeholder="Password"/>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="offset3 span12">
                                            <div class="span4 pull-left">
                                                <button type="submit" name="verify" id="verify" class="btn btn-success input-small">Verify</button>
                                            </div>
                                            <div class="span2 pull-left">
                                                <div id="loaderVerifyPassword" class="hide">
                                                    <img src="resource/images/loader.gif" alt="loading..."/>
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
    </div>
</div>
</div>
<div class="clear clearfix">&nbsp;</div>