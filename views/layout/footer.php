<div id="signInModalPopup">
    <div id="signInModal" class="modal fade in hide">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="pull-right closeIcon">
                        <img src="resource/images/close_icon.png" alt="Close signIn" title="Close"/>
                    </div>
                    <span class="modal-title">
                        <font size="5">Sign In</font> 
                    </span>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal errorPopUp topSide" id="signInForm">
                        <fieldset>
                            <div class="container-fluid">                      
                                <div id="message" class="row hide">
                                    <div id="messageContent" class="alert alert-error">  
                                    </div>
                                </div>
                                <div class="row-fluid signInContainer">
                                    <div class="span3">
                                        EMAIL ID
                                    </div>
                                    <div class="span7">
                                        <div class="input-prepend">
                                            <span class="add-on">@</span>
                                            <input required id="emailAddress" maxlength="254" data-placement="top right" name="emailAddress" type="text" placeholder="Email ID" class="input-xlarge">
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid signInContainer">
                                    <div class="span3">
                                        PASSWORD
                                    </div>
                                    <div class="span7">
                                        <div class="input-prepend">
                                            <span class="add-on"><i class="icon-lock"></i></span>
                                            <input required id="password" maxlength="20" name="password" type="password" placeholder="Password" class="input-xlarge">
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid signInContainer">
                                    <div class="span3">
                                        <div id="signInLoader" class="span4 hide">
                                            <img src="resource/images/searchLoader.GIF" alt="Logging.."/>
                                        </div></div>
                                    <div class="span9">
                                        <div class="span3 pull-left">
                                            <div class="span3">
                                                <button id="signIn" name="signIn" class="btn btn-primary">LOGIN</button>
                                            </div>
                                        </div>
                                        <div class="span7 pull-right">
                                            <div class="span9">
                                                <a id="forgotPassword" href = "#" name="forgotPassword" > &nbsp;Forgot Password?</a>
                                            </div>
                                            <div class="span9">
                                                <a id="createAccount" href="#">Create an Account</a>
                                            </div>
                                            <div class="span12">
                                                <div id="fb-root"></div>
                                                <a id="fbLoginLink" href = "#" name="fbLoginLink" >Sign in/Sign up using Facebook</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-signin -->
        </div>
    </div>
</div>
<div id="signUpModalPopup">
    <div id="signUpModal" class="modal fade in hide">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="pull-right closeIcon">
                        <img src="resource/images/close_icon.png"  alt="Close signUp" title="Close" />
                    </div>
                    <span class="modal-title">
                        <font size="5">Sign Up</font> 
                    </span>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <form class="form-horizontal errorPopUp topSide" id="signUpForm">
                            <fieldset>
                                <div class="container-fluid">
                                    <div id="messageSignUp" class="row-fluid hide">
                                        <div id="messageContentSignUp" class="alert alert-info">  
                                        </div>
                                    </div>
                                    <div id="fbcSuccess" class="row-fluid hide">  
                                        <div class="alert alert-info"> 
                                            <p><strong>Facebook verification has been completed. Please fill the rest of sign up and click on submit.</strong></p> 
                                        </div>
                                    </div>       
                                    <div class="row-fluid"> 
                                        <div class="row-fluid signInContainer">
                                            <div class="span">
                                                <div class="span4">
                                                    Name
                                                </div>
                                                <div class="span6">
                                                    <div class="input-prepend">
                                                        <span class="add-on"><i class="icon-user"></i></span>
                                                        <input maxlength="30" class="input-small name" required type="text" name="firstName" id="firstNameSignUp" placeholder="First"/>
                                                        <input maxlength="30" class="input-mini name ignore" type="text" name="middleName" id="middleNameSignUp" placeholder="Middle"/>
                                                        <input maxlength="30" class="input-small name" required type="text" name="lastName" id="lastNameSignUp" placeholder="Last"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid signInContainer">
                                            <div class="span">
                                                <div class="span4">
                                                    Email Id
                                                </div>
                                                <div class="span6">
                                                    <div class="input-prepend">
                                                        <span class="add-on">@</span>
                                                        <input maxlength="254" id="emailSignUp" autocomplete="off" required data-placement="top right" name="emailSignUp" type="text" placeholder="Email Address" class="input-xlarge">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid signInContainer">
                                            <div class="span">
                                                <div class="span4">
                                                    Phone Number
                                                </div>
                                                <div class="span7">
                                                    <div class="input-prepend">
                                                        <span class="add-on"> <img class="icon-phone" src="resource/images/phone.png"/></span>
                                                        <input id="phoneNumber" autocomplete="off" required data-placement="top right" name="phoneNumber" type="text" placeholder="123-456-5789" class="input-xlarge ignore">
                                                    </div>
                                                    <label id="phoneMessageLabel" class="checkbox">
                                                        <input type="checkbox" name="phoneMessage" id="phoneMessage"/>
                                                        Send me important alerts via SMS
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid signInContainer" id="passwordDiv">
                                            <div class="span">
                                                <div class="span4">
                                                    Password
                                                </div>
                                                <div class="span6">
                                                    <div class="input-prepend">
                                                        <span class="add-on"><i class="icon-lock"></i></span>
                                                        <input maxlength="20" id="passwordSignUp" autocomplete="off" required data-placement="top right" name="password" type="password" placeholder="Password" class="input-xlarge">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid signInContainer" id="confirmPasswordDiv">
                                            <div class="span">
                                                <div class="span4">
                                                    Confirm Password
                                                </div>
                                                <div class="span6">
                                                    <div class="input-prepend">
                                                        <span class="add-on"><i class="icon-lock"></i></span>
                                                        <input maxlength="20" id="confirmPasswordSignUp" required data-placement="top right" name="confirmPassword" type="password" placeholder="Confirm Password" class="input-xlarge">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      <!--  <div class="row-fluid signInContainer">
                                            <div class="span">
                                                <div class="span4">
                                                    &nbsp;
                                                </div>
                                                <div class="span8">
                                                    <div class="span12">
                                                        <div class="span6">
                                                            <label class="radio">
                                                                <input type="radio" name="account" id="paypal" class="account" data-for="Paypal Account" />Paypal Account  
                                                            </label>
                                                        </div>
                                                        <div class="span6">
                                                            <label class="radio">
                                                                <input type="radio" name="account" id="ach" class="account" data-for="ACH Account"  />ACH Account  
                                                            </label>
                                                        </div>
                                                    </div>                                           
                                                </div>
                                            </div>
                                        </div> -->
                                  <!--      <div class="row-fluid signInContainer">
                                            <div class="span">
                                                <div class="span4">
                                                    &nbsp;
                                                </div>
                                                <div class="span8">                                         
                                                    <div class="span12">
                                                        <input type="text" name="accountNumber" id="accountNumber" maxlength="16" class="numeric"  autocomplete="off"  placeholder="Account number" class="ignore" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="row-fluid signInContainer">
                                            <div class="span">
                                                <div class="span4">&nbsp;
                                                </div>
                                                <div class="span8">
                                                    <label class="checkbox">
                                                        <input required type="checkbox" name="termsCondition" id="termsCondition" />
                                                        I agree to the <a href="#" onclick="window.open('terms.php');return false;" target="_blank">Terms and Conditions.</a>
                                                    </label>                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid signInContainer">
                                            <div class="span">
                                                <div class="span4">     

                                                </div>
                                                <div class="span8">
                                                    <div class="span6">
                                                        <div class="span6">
                                                            <button type="submit" id="signUpButton" class="btn btn-success">Submit</button>      
                                                        </div>     
                                                        <div class="span2">
                                                            <div id="signUpLoader" class="hide">
                                                                <img src="resource/images/searchLoader.GIF" alt="loading..."/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="span6">
                                                        <div class="row-fluid">
                                                            <div id="fb-root"></div>
                                                            <a id="fbsignUpLink" href="#">Sign up/Sign in using Facebook</a>
                                                            <a id="simpleCreate" class='hide' href="#">Create an Account</a>
                                                        </div>
                                                        <!--<div class="row-fluid">
                                                        <a id="signInLink" href="#">Sign In</a>
                                                        </div>-->
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
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
<div id="forgotPasswordModalPopup">
    <div id="forgotPasswordModal" class="modal fade in hide">
        <div id="loaderforgotPassword" class="loader">
            <img src="resource/images/loader.gif" alt="loading..."/>
        </div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="pull-right closeIcon">
                        <img src="resource/images/close_icon.png" alt="Close forgotPassword" title="Close"/>
                    </div>
                    <label class="modal-title forgotPasswordModal">Forgot Password</label>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal errorPopUp topSide" id="forgotPasswordForm">
                        <fieldset>
                            <div class="container-fluid"> 
                                <div id="messageForgotPassword" class="row hide">
                                    <div id="messageContentForgotPassword" class="alert alert-error">  
                                    </div>
                                </div>                     
                                <div class="row-fluid signInContainer">
                                    <div class="span3">
                                        EMAIL ID
                                    </div>
                                    <div class="span7">
                                        <div class="input-prepend">
                                            <span class="add-on">@</span>
                                            <input maxlength="50" required id="emailAddressForgotPassword" name="emailAddress" class="input-large" placeholder="Email ID" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid signInContainer">
                                    <div class="span3">&nbsp;</div>
                                    <div class="span9">
                                        <div class="span6 pull-left">
                                            <button id="forgotPasswordButton" name="forgotPasswordButton" class="btn btn-primary">RESET</button>
                                        </div>
                                        <div id="loaderForgotPassword" class="hide">
                                            <img src="resource/images/searchLoader.GIF" alt="Please wait..."/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-forgot password -->
    </div>
</div>
<div id="modalFade" class="modal-backdrop fade in hide"></div>
<div id="fbOverlay" class="modal fade in hide">

    <div class="row-fluid">
        <div class="span2">
            <img src="resource/images/fbLoadingImage.GIF" alt="Loading..."/>
        </div>
        <div class="span10">
            <h4 class="greenLabel">Validating with Facebook</h4>
        </div>
    </div>
</div>
<footer class="footer edge-to-edge">
    <div class="container">
        <div class="row">
            <ul class="footerListItem">
                <li >
                    <a href="support.php">Support</a>
                    |
                    <a href="insurance.php">Safety &amp; Insurance </a>
                    |
                    <a href="ourLocation.php">Our Locations</a> 
                    |
                    <a href="howItWorks.php">How It Works</a>
                    |
                    <a href="faq.php">FAQ</a>
                    |
                    <a href="terms.php">Terms of Service</a>
                    |
                    <a href="jobs.php">Jobs</a>
                    |
                    <a href="press.php">Press</a>
                    |
                    <a href="policy.php">Privacy Policy</a>
                    |
                    <a href="blog.php">Blog</a>
                </li>                
            </ul> 
        </div>
        <div class="row">
            <ul class="footerListItem">
            <li class="copy">&copy;&nbsp;2014 AirPnD, LLC. All Rights Reserved.</li>            
        </div>
    </div>
</footer>
<link href='resource/js/lib/nProgress/nprogress.css' rel='stylesheet' />
<script src='resource/js/lib/nProgress/nprogress.js'></script>
<script>
    $('body').show();
    NProgress.start();
    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
  </script>