</head>
<body ondragstart="return false;" ondrop="return false;">

    <?php if(!isset($_SESSION['user']) || empty($_SESSION['user'])){?>
<div class="pull-center" style="left:5px;-moz-box-shadow: 0 0 2px red;
                               -webkit-box-shadow: 0 0 2px red;
                               box-shadow: 0 0 2px red;">
    <span class="glyphicons glyphicons-circle-exclamation-mark">
        <a id="createAccountHome" href="#"><b>Transaction fees waived until 1/31/2016</b>.</a>
    </span> 
</div>
    <?php }; ?>
    <!-- /.modal for alert box -->
    <div id="alertBox" ></div>

    <div  id="welcomeMenu" class="topMenu pull-right">
        <div id="fbLoader" class="signInModal hide">
            <img src="resource/images/loader.gif" alt="Loading..."/>&nbsp;&nbsp;Loading....
        </div>
        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])){?>
        <div class="pull-right">    
            <a id="userName" href="#" class="dropdown-toggle greenLabel" 
               data-toggle="dropdown">
               <span style='float:left'><b>Welcome - </b><?php echo $_SESSION['user']['firstName']." ".$_SESSION['user']['lastName']; ?></span>
               <div style='float:left;left:5px;top:7px;position:relative' class='arrowDown'></div>
                <ul class="dropdown-menu">
                    <li>
                        <a  href="profile.php">Manage Profile</a>
                    </li>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a id="logOut" href="index.php" for="">Log Out</a>
                    </li>
                </ul>
            </a>
        </div>
       <?php } else{ ?> 
        <div class="pull-right">
            <a id="signInTop" class="signInModal" href="#">
                <span class="add-on">
                    <i class="icon-off"></i>
                </span> Sign In
            </a>
        </div>
           <?php }; ?>
    </div>
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <div class="container">
                <button id="menuButton" type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand" href="index.php"><img src="resource/images/logoairPnD.png" alt="AIRPND" height="200" width="200"/></a>
                <div class="nav-collapse collapse">
                    <ul class="nav pull-right">
                        <li class="navList requestRide" ><a href="#" for="requestRide" class="white-color menuLink">
                            <img height="17" alt="" src="resource/images/share_car.png"> Request A Ride</a>
                        </li>
                        <li class="navList postRide" ><a href="#" for="postRide" class="white-color menuLink">
                            <img height="17" alt="" src="resource/images/airspend.png"> Offer A Ride</a>
                        </li>
                        <li class="navList findRider" ><a href="#" for="findRider" class="white-color menuLink">
                            <img height="17" alt="" src="resource/images/find_car.png"> Search Riders</a>
                        </li>  
                        <li class="navList findRide" ><a href="#" for="findRide" class="white-color menuLink">
                            <img height="17" alt="" src="resource/images/share_car.png"> Search Drivers</a>
                        </li>
                        <li class="navList howItWorks" ><a href="#" for="howItWorks" class="white-color menuLink">
                            <img height="17" alt="" src="resource/images/how_it_work.png"> HOW IT WORKS</a>
                        </li>
                        <li class="navList support" ><a href="#" for="support" class="white-color menuLink">
                            <img height="17" alt="" src="resource/images/support.png"> SUPPORT</a>
                        </li>       
                    </ul>
                </div>
            </div>
        </div>
    </div>