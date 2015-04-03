// nexus web service URL
var API_URL = 'http://nexus.airpnd.com/nexusService.php';
// custom web serviec URL 
var CUSTOM_API_URL = 'http://nexus.airpnd.com/customService.php';

// site URL
var SITE_URL = 'http://www.airpnd.com/'; 
// facebook app id
var FACEBOOK_APP_ID = '580673358707402'; 
var FACEBOOK_ACCESS_TOKEN ='CAACEdEose0cBAEM8BZAtWQmk31sNxBfkW9YcTzdxQtZBiDhd1ZBdobtxrEXEkB05yDBV18eIIaHxmfpItf55TwQyGFLNbK6NVqVBHfNSrrHWytrxpLrJNa97wDgUvDuOYtoF8GiJTqUwhnGgUzr7BZA5lfCpAvPlqZA80AwPJvdpZCtZAVWJetrv4bQ22KayunaQ1f6tMEqTgZDZD';
// role 

var CUSTOMER_OWNER_ROLE = 3; // customer owner role
// encryption key
var ENCRYPT_KEY = "z1Mc6KRxA7Nw90dGjY5qLXhtrPgJOfeCaUmHvQT3yW8nDsI2VkEpiS4blFoBuZ";

//rental web service.
var GET_ENTITY_IMAGES   = 'getEntityImages';
var RENTAL_INVOICE_TYPE = 'Rental';

//custom web service
var ADD_RENTAL               = "addRental";
var SEARCH_RENTAL            = "searchRental";
var GET_LOCATIONS            = 'getLocations';
var ADD_DRIVER_LICENSE       = "addDriverLicense";
var GET_OWNER_RENTALS        = 'getOwnerRentals';
var GET_RENTAL               = 'getRentals';
var POST_A_RIDE              = 'postARide'; 
var GET_RIDES                = "getRides";
var BOOK_A_RIDE              = "bookARide";
var REJECT_A_RIDE            = "rejectARide";
var CONFIRM_A_RIDE           = "confirmARide";
var POST_AUTO_LIFT           = "postAutoLift"
var POST_A_LIFT              = "postALift";
var GET_LIFTS                = "getLifts";
var BOOK_A_LIFT              = "bookALift";
var REJECT_A_LIFT            = "rejectALift";
var ADD_ORDER_TO_LIFT        = "addOrderToLift";
var GET_FEATURED_RENTALS     = 'getFeaturedRentals';
var UPDATE_ENTITY_FEATURES   = 'updateEntityFeatures';
var UPDATE_PRICE             = 'updatePrice';
var GET_DRIVER_LICENSE       = "getDriverLicense";
var GET_MEM_ORDER            = "getMemOrder";
var LIFTS_BY_CUSTOMER        = "liftsByCustomer";
var RIDES_BY_CUSTOMER        = "ridesByCustomer";
var UPDATE_A_RIDE            = "updateARide";
var DELETE_A_RIDE            = "deleteARide";
var DELETE_A_LIFT            = "deleteALift";
var UPDATE_A_LIFT            = "updateALift";
var GET_A_RIDE               = "getARide";
var GET_A_LIFT               = "getALift";
var CONFIRM_A_LIFT           = "confirmALift";
var PENDING_CONFIRM_A_LIFT   = "pendingConfirmALift";;
var PENDING_PAYMENT_A_LIFT   = "pendingPaymentALift";
var PENDING_FULFILLED_A_LIFT = "pendingFulFilledALift";
var UPDATE_CONTRIBUTION      = "updateContribution";
var GET_PRICE_FOR_RIDE       = 'getPriceForRide';
var GET_BAG_SIZES            = 'getBagSizes';
var GET_SEAT                 = 'getSeats';

// nexus web service api
var REGISTER_USER            = 'registerUser';
var ADD_OWNER                = 'addOwner';
var ADD_CUSTOMER             = 'addCustomer';
var GET_OWNERS_BY_FL_NAME    = 'getOwnersByFLName';
var VALIDATE_USER            = 'validateUser';
var ADD_ITEM                 = 'addItem';
var ADD_PRICE                = 'addPrice';
var FORGOT_PASSWORD          = 'forgotPassword';
var SEND_MESSAGE             = 'sendMessage';
var GET_OWNER_BY_ITEM        = 'getOwnerByItem';
var GET_PRIMARY_OWNER        = 'getPrimaryOwner';
var ADD_OWNERSHIP            = 'addOwnership';
var GET_SYSTEM_USER_ACTION   ='getSystemUserId';
var GET_CUSTOMER_BY_FL_NAME  ='getCustomersByFLName';
var GET_ORDER_BY_ID          ='getOrderById';
var GET_ORDER_BY_ENTITY      ='getOrderByEntity';
var CAPTURE_PAYMENT          ='capturePayment';
var GET_PAYMENTS_BY_ORDER_ID ='getPaymentsByOrderId';
var GET_PRICE                ='getPrice';
var GET_INVOICE_TYPE         ='getInvoiceType';
var GET_SYSTEM_USER          ='getSystemUserId';
var CREATE_ORDER             ='createOrder';
var UPDATE_PRCIE             = 'updatePrice';
var GET_ENTITY_FEATURES      = 'getEntityFeatures';
var GET_OWNER_BY_ID          = 'getOwnerById';
var GET_CUSTOMER_BY_ID       = 'getCustomerById';
var CATEGORY_BY_NAME         = 'getCategoryByName';
var DELETE_ITEM              = 'deleteItem';
var DELETE_ORDER             = 'deleteOrder';
var SEND_TEXT_MESSAGE        = 'sendTextMessage';
var GET_ENTITIES_BY_CATEGORY = 'getEntitiesByCategory';
var UPDATE_CUSTOMER          = 'updateCustomer'
var GET_REGIONS_FOR_COUNTRY  = 'getRegionsForCountry'
var UPDATE_PAYMENT           = 'updatePayment';
var PAID_ORDER               = 'paidOrder';
var GET_CAR_RENTALS          = 'getCarRentals';
var MAKE_PAYMENT             = 'makePayment';

// entities
var GET_ENTITY_BY_NUMBER_ACTION = 'getEntityByNumber';
var CAR_ENTITY = 'CAR';
var BLANK_CAR_IMAGE = 'http://nexuscb/entityImage/_blank.gif';

//CARRBO support
var CARRBO_SUPPORT = 'support@airpnd.com';

// error messages 
var ERROR_MSG_FB = " We can not process your request this time. Sorry for the inconvenience caused."
var ERROR_MSG = " We can not process your request this time. Sorry for the inconvenience caused.";
var INVALID_USER = "<strong>Error !</strong><br />This email address does not exist in our system.";
var FB_INVALID_USER = "This email <strong>{emailID}</strong> is not registered with us.";
var REGISTRATION_FAILED_MSG = 'User with email address/first name/last name already exists.';
var REGISTRATION_SUCCESSFUL_MSG = 'Successfully registered in the Airpnd system and an activation link has been sent to the email <strong>{emailID}</strong>.';
var FORGOTPASSWORD_MSG ='A recovery email has been sent to <strong>emailAddress</strong>';
FORGOTPASSWORD_MSG +='.If you do not see this email in your inbox within';
FORGOTPASSWORD_MSG +=' 15 minutes, look for it in your junk-mail folder.';
FORGOTPASSWORD_MSG +=' If you find it there, please mark the email as <strong>Not Junk</strong>.';
var FORGOTPASSWORD_ERROR_MSG ='The email account does not exists.';
var VALIDATION_ERROR_MSG_INPUT = 'Please enter {element}.';
var VALIDATION_ERROR_MSG_SELECT = 'Please choose {element}.';
var VALIDATION_ERROR_MSG_CHECK = 'You must check at least 1 box.';
var LOGIN_ERROR_MSG = '<strong>Error !</strong><br />Please enter valid credentials.';

// owner confirmation message.
var OWNER_SUCCESS_MSG = 'You have successfully shared your car with us. A confirmation email has been sent to the email <strong>{emailID}</strong>.';
//emai messages
var REGISTER_EMAIL_MESSAGE = 'Dear userName,<br />Thank you for registering';
REGISTER_EMAIL_MESSAGE +=' with AIRPND.  Please click on link below to login';
REGISTER_EMAIL_MESSAGE +=' into AIRPND.<br/>userName<br />password<br />';
REGISTER_EMAIL_MESSAGE +='<a href="' + SITE_URL + '"linkPage>';
REGISTER_EMAIL_MESSAGE += SITE_URL +'linkPage</a>';

var EMAIL_SUCCESS = 'An activation email has been sent to the <b>emailID</b>.';
    EMAIL_SUCCESS+= ' Please activate your account to login into AIRPND.'
// header
var HEADER = {
    "X-Requested-With": "XMLHttpRequest"
};

// select list
var yearList = {
    '2011':'2011', 
    '2012':'2012', 
    '2013':'2013'
};
var modelList = {
    '2011_Compact':'2011/Compact',
    '2012_Coupe':'2012/Coupe',
    '2013_Sedan ':'2013/Sedan '
};   

var maskUSFormat = "999-999-9999";

var seatList = {
    '1':'1', 
    '2':'2', 
    '3':'3', 
    '4':'4', 
    '5':'5', 
    '6':'6'
};
var transmissionList = {
    'automatic':'Automatic',
    'manual':'Manual'
};
var mileageList = {
    '0_50':'0-50.000 Miles', 
    '50_90':'50-90.000 Miles'
};
var colorList = {
    'red':'Red', 
    'black':'Black', 
    'white': 'White'
};
var locationList = {
    'San Francisco':'San Francisco International Airport', 
    'Washington':'Washington International Airport'
};
var fuelTypes = {
    'Petrol':'Petrol',
    ' Diesel':' Diesel',
    'LPG':'Liquefied Petroleum Gas',
    'LNG':'Liquefied Natural Gas',
    'M85':'Methanol',
    'E85':'Ethanol',
    'B20':'Biodiesel',
    'Electricity':'Electricity',
    'Hydrogen':'Hydrogen'
};
var partyList = {
    '1':'1',
    '2':'2',
    '3':'3',
    '4':'4',
    '5':'5',
    '6':'6',
    '7':'7',
    '8':'8',
    '9':'9',
    '10':'10'
};
var months = {
    '1':'Jan',
    '2':'Feb',
    '3':'Mar',
    '4':'Apr',
    '5':'May',
    '6':'Jun',
    '7':'Jul',
    '8':'Aug',
    '9':'Sep',
    '10':'Oct',
    '11':'Nov',
    '12':'Dec'
};
var years = {
    '1':'2013',
    '2':'2014',
    '3':'2015',
    '4':'2016',
    '5':'2017',
    '6':'2018',
    '7':'2019',
    '8':'2020',
    '9':'2021',
    '10':'2022',
    '11':'2023',
    '12':'2024',
    '13':'2025',
    '14':'2026',
    '15':'2027',
    '16':'2028',
    '17':'2029',
    '18':'2030'
};    
var cardTypes =
{
    'Visa':'Visa',
    'Amex':'Amex',
    'Master':'MasterCard',
    'Discover':'Discover'
};
//Google Ad
var QUERY = 'car rental in united states';
var PUBLISHER_ID = 'ca-pub-8695986068108963';
var IS_LOCATION  = true;
var AD_NUMBER = 6;
var GOOGLE_ADTEST = "on";
var GOOGLE_AD_TYPE = "text_image";
var GOOGLE_AD_LANGUAGE = "en";

//social connects

var TWITTER = 'http://www.twitter.com/';
var FACEBOOK = 'http://www.facebook.com/';
var FLICKR = 'http://www.flickr.com/';
var VIMEO = 'http://www.vimeo.com/';

//user status
var INACTIVE = 0;
var ACTIVE = 1;

//price type
var FIXED_TYPE = 0; 
var FIXED_RATE_TYPE = 1; 
var VARIABLE_RATE_TYPE = 2;  

//item data of entity
var NO_ID      = -1;
var YES        =  1;
var NO         =  0;
var CAR_PREFIX = 'CAR'

//charge for other(confirmation)
 var FREE = '$0.00';
 
 //category name
 var CATEGORY_NAME = 'MEM';
 
 //invoice type 
var INVOICE_TYPE = 'Membership';

var DATE_FORMAT ='mm/dd/yy';

var NEW_LIFT               = 0; 
var PENDING_CONFIRM        = 1;
var PENDING_PAYMENT        = 2;
var PENDING_FULFILLED      = 3; 
var LIFT_FULFILLED         = 4; 
var PENDING_CONFIRM_DRIVER = 5; 

var NEW_RIDE        = 0; 
var RIDE_AVAILABLE  = 1;
var RIDE_FULL       = 2;
var RIDE_FULFILLED  = 3; 

var COUNTRY_NAME = 'US';
var DRIVE = 'DRIVE';

var OPEN_STATUS      = 0; 
var HOLD_STATUS      = 1; 
var PENDING_STATUS   = 2; 
var FULFILLED_STATUS = 3;
var SHIPPED_STATUS   = 4; 
var INVOICED_STATUS  = 5; 
var PAID_STATUS      = 6; 
var VOID_STATUS      = 7;
var RETURN_STATUS    = 8;

var TAX = 0;
var FEE = 0;

//for swapping 
var AIRPORT_START = 0; 
var ADDRESS_START = 1;

var DEFAULT_MAP_ID = 1;

/**************** Ride Status ***********************/
var AVAILABLE = 0; 
var PENDING   = 1;
var FULL      = 2;

/**************** Lift Status ***********************/
var NEW_LIFT        = 0; 
var PENDING_CONFIRM = 1;
var PENDING_PAYMENT = 2;
var FULFILLED       = 3; 

/***********Constants for checking users uniqueness***********/
var MATCH_FL_NAME            = 1;
var MATCH_EMAIL              = 2;
var MATCH_FL_NAME_AND_EMAIL  = 3;
var MATCH_FUZZY              = 4;

/***********Constants for Account Numbers ***********/
var NO_ACCT      = 0;
var PAY_PAL_ACCT = 1;
var ACH_ACCT     = 2;
var PAY_PAL_ACCT_LABEL = "Paypal Account";
var ACH_ACCT_LABEL     = "ACH Account";
var PAY_PAL_TAG = "paypal";
var ACH_TAG     = "ach";