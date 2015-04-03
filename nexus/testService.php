<?php
// Encrypt user name and password for testing
$_SERVER['SERVER_NAME'] = '/nexuscarrbophase2.com/';
require_once('nexusPath.inc');
require_once('config.php');

// url address
$urlAddress = "http://nexus.airpnd.com/";

$encrypt = new Encryption();


$iv = 91;
$encode = $encrypt->encode('cust1',
                             $iv, "z1Mc6KRxA7Nw90dGjY5qLXhtrPgJOfeCaUmHvQT3yW8nDsI2VkEpiS4blFoBuZ");

$iv = 91;
$encode = $encrypt->encode('mmajidi@mindsharehdv.com',
                             $iv, "z1Mc6KRxA7Nw90dGjY5qLXhtrPgJOfeCaUmHvQT3yW8nDsI2VkEpiS4blFoBuZ");
                             
                             
$iv = 91;
$decode = $encrypt->decode('cust1',
                           $iv, "z1Mc6KRxA7Nw90dGjY5qLXhtrPgJOfeCaUmHvQT3yW8nDsI2VkEpiS4blFoBuZ");
                           

// test addItem                           
$item     = array();
$item['info'] = array ('id'        => -1,
                       'history'   => 0,
                       'lotId'     => -1,
                       'autogen'   => 1,
                       'prefix'    => 'CAR',
                       'classId'   => 1,
                       'pkgId'     => -1,
                       'type'      => 1,
                       'priceType' => 2,
                       'level' => 1,
                       'limit' => 0,
                      );

$features = array();

$feature  = array();
$feature['type'] = 1;
$feature['name'] = 'rental';
$feature['description'] = 'Yes';
$feature['rank'] = 0;
array_push($features, $feature);

$feature  = array();
$feature['type'] = 1;
$feature['name'] = 'From';
$feature['description'] = '02/04/2014';
$feature['rank'] = 0;
array_push($features, $feature);

$feature = array();
$feature['type'] = 1;
$feature['name'] = 'To';
$feature['description'] = '02/04/2014';
$feature['rank'] = 0;
array_push($features, $feature);

$feature = array();
$feature['type'] = 1;
$feature['name'] = 'Location';
$feature['description'] = 'San Francisco';
$feature['rank'] = 0;
array_push($features, $feature);

$feature = array();
$feature['type'] = 1;
$feature['name'] = 'Year';
$feature['description'] = '2012';
$feature['name'] = '2011_Compact';
$feature['rank'] = 0;
array_push($features, $feature);
$item['features'] = $features;
echo $urlAddress . "nexusService.php?action=addItem&item=" . serialize($item);
echo "\n";
exit();

// test addCustomer
$customer = array();
$customer['type']      = '1';
$customer['firstName'] = 'firstName';
$customer['lastName']  = 'lastName'; 
$customer['city']      = 'city';  
$customer['state']     = 'CO'; 
$customer['zipCode']   = '80237'; 
$customer['country']   = 'USA'; 
$customer['email']     = 'mmajidi@mindsharehdv.com';
$customer['phone1']    = '303-333-3333'; 

$aadress = array();
$address["firstNameShip"] = 'firstName';
$address["lastNameShip"]  = 'lastName';
$address["address1Ship"]  = 'address1Ship';
$address["cityShip"]      = 'cityShip';
$address["stateShip"]     = 'CO'; 
$address["zipCodeShip"]   = '12345'; 
$address["countryShip"]   = 'USA';
$address["telephoneShip"] = '303-333-3333';
$address["emailShip"]     = 'mmajidi@mindsharehdv.com';
echo $urlAddress . "nexusService.php?action=addCustomer&customer=" . 
      serialize($customer) . "&shippingAddress=" . serialize($address);
echo "\n";
exit();

// test addOwner
$owner = array();
$owner['type'] = 1;
$owner["userInfoId"] = "";
$owner['customerId'] = "";
$owner["role"] = 3;
$owner['firstName']  = 'Mehran';
$owner['lastName']   = 'Majidi'; 
$owner['address1']   = ''; 
$owner['address2']   = '';  
$owner['city']      = ''; 
$owner['state']      = ''; 
$owner['zipCode']    = ''; 
$owner['country']    = ''; 
$owner['email']      = 'mmajidi@mindsharehdv.com';
$owner['phone1']     = '303-333-3333'; 
$owner['phone2']     = ''; 
$owner['fax']        = ''; 
$owner['note']       = 'SMS:N';
$owner['subscribed'] = ''; 
echo $urlAddress . "nexusService.php?action=addOwner&owner=" . 
      serialize($owner);
echo "\n";
exit();

// test addOwnership
$owner = array();
$ownerId = 33;
$entityIds  = array(89, 88);
echo $urlAddress . "nexusService.php?action=addOwnership&ownerId=" . 
      $ownerId . "&entityIds=" . serialize($entityIds);
echo "\n";
exit();

/*****************  test register user ******************************
a) generate the password genPass = 1, no password
b) update the password genPass = 0, password
c) do not generate and do not update
********************************************************************/

// Encrypt user name and password for testing
$_SERVER['SERVER_NAME'] = '/nexus.airpnd.com/';                                                                  
require_once('nexusPath.inc');                                                                                   
require_once('config.php');                                                                                      
                                                                                                                 
$encrypt = new Encryption();                                                                                     
$encodePass = 'z1rn1rv1XvzEz1aa1ef1Qn1Er1nq1u.1Db1F ';                                                           
$iv = 9;                                                                                                         
                                                                                                                 
//$decode = $encrypt->decode($encodePass,                                                                        
//                           $iv, "z1Mc6KRxA7Nw90dGjY5qLXhtrPgJOfeCaUmHvQT3yW8nDsI2VkEpiS4blFoBuZ");             
//echo $decode . "\n";                                                                                           
                                                                                                                 
$pass = 'Password!';                                                                                             
$encodePass = $encrypt->encode($pass,                                                                            
                           $iv, "z1Mc6KRxA7Nw90dGjY5qLXhtrPgJOfeCaUmHvQT3yW8nDsI2VkEpiS4blFoBuZ");               
                                                                                                                 
$un = 'mmajidi@mindsharehdv.com';                                                                                
$encodeUN = $encrypt->encode($un,                                                                                
                           $iv, "z1Mc6KRxA7Nw90dGjY5qLXhtrPgJOfeCaUmHvQT3yW8nDsI2VkEpiS4blFoBuZ");    


$userInfoId = 45;
$role = 3;
$iv = 9;
$genPass = 0;
//$encodeUN = 'NM5@MCFM8p60zcJ';
$encodeUN="zKvnRZvAXv79zwqa98fdwnGkrYKq5I.qbbXC ";
$encodePass = '';
$firstName = 'Mehran';
$lastName = 'Majidi';
$email = 'mmajidi@mindsharehdv.com';
$status = 1;
echo $urlAddress . "nexusService.php?action=registerUser&userInfoId=" . 
      $userInfoId . "&role=" . $role . "&iv=" . $iv . "&genPass" . $genPass .
      "&encodeUN=" . $encodeUN . "&encodePass=" . $encodePass . 
      "&firstName=" . $firstName . "&lastName=" . $lastName . 
      "&email=" . $email . "&status=" . $status;
echo "\n";
exit();

// test register user for customer
$userInfoId = 59;
$role = 2;
$iv = 91;
$encodeUN = 'pMifcL1MO';
$encodePass = '11f';
$firstName = 'Mehran';
$lastName = 'Majidi';
$email = 'mmajidi@mindsharehdv.com';
$status = 1;
echo $urlAddress . "nexusService.php?action=registerUser&userInfoId=" .
      $userInfoId . "&role=" . $role . "&iv=" . $iv . "&encodeUN=" .
      $encodeUN . "&encodePass=" . $encodePass . "&firstName=" . $firstName .
      "&lastName=" . $lastName . "&email=" . $email . "&status=" . $status;
echo "\n";
exit();


//*****************************************************************************************8


// get customer by First Name and Last Name
$name = "firstName lastName";
echo $urlAddress . "nexusService.php?action=getCustomersByFLName&name=" . 
      $name;
echo "\n";
exit();

// get Owner by First Name and Last Name
$name = "firstName lastName";
echo $urlAddress . "nexusService.php?action=getOwnersByFLName&exact=" . 
     "1&name=" . $name;
echo "\n";
exit();

// validate user
$activate = false;
$iv = 91;
$encodeUN = 'NM5@MCFM8p60zcJ'; 
$encodePass = '11f';
echo $urlAddress . "nexusService.php?action=validateUser&activate=" . 
      $activate . "&encodeUN=" . $encodeUN . 
      "&iv=" . $iv . "&encodePass=" . $encodePass; 
echo "\n";
exit();

// validate sendMessage
$recipients = "mmajidi@mindsharehdv.com";
$subject = "Activate Your CARRBO Account";
$msg = "Welcome email with activiation link";
echo $urlAddress . "nexusService.php?action=sendMessage&recipients=" . 
      $recipients . "&subject=" . $subject . 
      "&msg=" . $msg; 
echo "\n";
exit();

// validate forgotPassword
$username="mmajidi@mindsharehdv.com";
$iv = 9;
echo $urlAddress . "nexusService.php?action=forgotPassword&username=" . 
      $username . "&iv=" . $iv; 
echo "\n";
exit();

// validate addRental
$customerId = 9;
$startDate  = '2014-02-04';
$endDate    = '2014-02-15';
$priceItems = array(4, 89);
echo $urlAddress . "customService.php?action=addRental&customerId=" . 
      $customerId . "&startDate=" . $startDate . "&endDate=" . $endDate . 
      "&priceItems=" . $priceItems;
echo "\n";
exit();
  
// validate getRentals  
$customerId = 59;
echo $urlAddress . "customService.php?action=getRentals&customerId=" . 
      $customerId; 
echo "\n";
exit();

// validate getOwnerRentals
$ownerId = 33;
echo $urlAddress . "customService.php?action=getOwnerRentals&ownerId=" . 
      $ownerId; 
echo "\n";
exit();

// validate searchRental
$startDate =  "2013-12-18";
$endDate   =  "2013-12-19";
$location  =  "San Francisco Internation Airport";
echo $urlAddress . "customService.php?action=searchRental&startDate=" . 
      $startDate . "&endDate=" . $endDate . "&location=" . $location; 
echo "\n";
exit();

// validate addDriverLicense
$customerId = 9;
$state  = 'IN';
$number = '12345';
$dob    = '1989-01-01';
echo $urlAddress . "customService.php?action=addDriverLicense&customerId=" . 
      $customerId . "&state=" . $state . "&number=" . $number . 
      "&dob=" . $dob; 
echo "\n";
exit();

// validate getDRiverLicense
$customerId = 9;
echo $urlAddress . "customService.php?action=getDriverLicense&customerId=" . 
      $customerId; 
echo "\n";
exit();

// validate addPrice
$entityId = 79;
$type = 1;    // fixed rate type
$priceList = array();

$price = array(4,4);

// zero is the daily rate
$priceList[0] = $price;

$price = array(11,11);

// one is the weekly rate
$priceList[1] = $price;

echo $urlAddress . "nexusService.php?action=addPrice&entityId=" . 
      $entityId . "&type=" . $type . "&priceList=" . serialize($priceList); 
echo "\n";
exit();

// validate updatePrice
$entityId = 79;
$type = 1;
$priceList = array();
$price = array(33,3,3);
array_push($priceList, $price);
$price = array(34,12,12);
array_push($priceList, $price);
echo $urlAddress . "nexusService.php?action=updatePrice&entityId=" . 
      $entityId . "&type=" . $type . "&priceList=" . serialize($priceList); 
echo "\n";
exit();


// validate updateEntityFeature
$features = array();
$feature = array('id' => 397,
                 'entityId'    => '21',
                 'name'        => 'Location',
                 'description' => 'Seattle International Airport',
                 'type'        => '1',
                 'rank'        => '0');
array_push($features, $feature);
$feature = array('id' => 398,
                 'entityId'    => '21',
                 'name'        => 'From',
                 'description' => '2014-02-17',
                 'type'        => '1',
                 'rank'        => '0');
array_push($features, $feature);
$feature = array('id' => 399,
                 'entityId'    => '21',
                 'name'        => 'To',
                 'description' => '2014-02-27',
                 'type'        => '1',
                 'rank'        => '0');                 
array_push($features, $feature);                     
echo $urlAddress . "nexusService.php?action=updateEntityFeatures&features=" . 
     serialize($features); 
echo "\n";
exit();

echo $urlAddress . "nexusService.php?action=getLocations"; 
echo "\n";
exit();

echo $urlAddress . "nexusService.php?action=getFeaturedRentals";
echo "\n";
exit();

$rideData['ownerId']  = 15;
$rideData['entityId'] = 155;
$rideData['date']     = '06/28/2014';
$rideData['time']     = '21:44';
$rideData['start']    = 'Denver';
$rideData['maxMiles'] = 34;
$rideData['seats']    = 2;
$rideData['smoker']   = false;
$rideData['bags']     = '3';
$rideData['bagSize']  = 'S';
$rideData['note']     = '';
$rideData['to']       = '520 Pearl Street, Boulder CO United States';
$rideData['via']      = 'Boulder CO, United States';
$rideData['startType']= 0;  
$rideData['contribution']= 30;  
echo $urlAddress . "customService.php?action=postARide&ride=" . 
      serialize($rideData); 
echo "\n";
exit();


$startType = 0;
$location  = 'Denver';
$address   = 'Westminster, CO United States';
$date      = '06/23/2014';
$time      = '00:00';
$seats = 1;
$bagSize = 'S';
$bags = 1;
echo $urlAddress . "customService.php?action=getRides&startType=" . 
                   $startType . "&location=" . 
      $location . "&address=" . $address . "&date=" . $date . 
      "&time=" . $time . "&seats=" . $seats . "&bagSize=" . $bagSize; 
echo "\n";
exit();

$lift = array("customerId" => 90,
              "date" => '2014-12-04',
              "time" => '11:25',
              "start" => 'Denver ',
              "to" => '1015 Frisian Drive, Fort Collins, CO, United States',
              "via" => 'Erie',
              "maxMiles" => 5,
              "seats" => 4,
              "smoker" => 0,
//              "bags" => 2,
              "badSize" => 'm',
              "note" => 'this is a test.');
echo $urlAddress . "customService.php?action=postALift&lift=" . 
     serialize($lift); 
echo "\n";
exit();


$rideId=229;
$startType=0;  
$location = 'Denver International Airport';
$address  = '10179 Church Ranch Way, Westminster, CO, United States';
$date      = '12/24/2014';
$time      = '10:27:00';
$seats = 3;
$bags = 3;
$bagSize = 'S';
$smoker=0;
echo $urlAddress . "customService.php?action=getLifts&rideId=" . $rideId . 
      "&location=" . $location . "&address=" . $address . "&date=" . $date . 
      "&time=" . $time . "&seats=3&" .
      "smoker=0&bags=3&bagSize='S'"; 
echo "\n";
exit();

$liftId  =  1;
$rideId  =  1;
$seats   =  2;
echo $urlAddress . "customService.php?action=bookARide&liftId=" . 
     $liftId . "&rideId=" . $rideId . "&seats=" . $seats; 
echo "\n";
exit();

$liftId  =  1;
$rideId  =  1;
$seats   =  2;
echo $urlAddress . "customService.php?action=bookALift&liftId=" . 
     $liftId . "&rideId=" . $rideId . "&seats=" . $seats; 
echo "\n";
exit();


$airportName =  'Denver';
$driverAddress  =  '29th Street Bouldder Colorado';
$miles   =  10;
echo $urlAddress . "customService.php?action=getPriceForRide&airportName=" . 
     $airportName . "&driverAddress=" . $driverAddress . "&miles=" . $miles; 
echo "\n";
exit();



$payerInfo = array(
    'id'         => 21,
    'parentID'   => 21,
    'typeId'     => -1,
    'status'     => 0,
    'number'     => "",
    'firstName'  => 'Mehran',
    'lastName'   => 'Majidi',
    'middleName' => '',
    'companyName' => '',
    'address1'   => '2165 Pinon Dr.',
    'address2'   => '',
    'city'       => 'Erie',
    'state'      => 'CO',
    'zipCode'    => '80516',
    'country'    => 'US',
    'email'      => 'mmajidi@mindsharehdv.com',
    'phone1'     => '303-333-3333',
    'phone2'     => '',
    'fax'        => '',
    'balance'    => '1',
    'note'       => 'SMS:Y;undefined',
    'taxRate'    => '0.000',
    'subscribed' => 1);
    
$paymentInfo = array(    
    'id'         => -1, 
    'orderId'    => 13,
    'payerId'    => 21,
    'amount'     => 1,
    'ccType'     => 'Visa',
    'ccNum'      => '4007000000027',
    'ccCode'     => '000',
    'ccExpMonth' => 12,
    'ccExpYear'  =>2016);
echo $urlAddress . "nexusService.php?action=capturePayment&payer=" . 
     serialize($payerInfo) . "&payment=" . serialize($paymentInfo); 
echo "\n";
exit();

$payerInfo = array(
    'id'         => 41,
    'parentID'   => 41,
    'typeId'     => -1,
    'status'     => 0,
    'number'     => "",
    'firstName'  => 'Mehran',
    'lastName'   => 'Majidi',
    'middleName' => '',
    'companyName' => '',
    'address1'   => '2165 Pinon Dr.',
    'address2'   => '',
    'city'       => 'Erie',
    'state'      => 'CO',
    'zipCode'    => '80516',
    'country'    => 'US',
    'email'      => 'mmajidi@mindsharehdv.com',
    'phone1'     => '303-333-3333',
    'phone2'     => '',
    'fax'        => '',
    'balance'    => '30',
    'note'       => 'SMS:N',
    'taxRate'    => '0.000',
    'subscribed' => 1);
    
$paymentInfo = array(    
    'id'         => -1, 
    'orderId'    => 33,
    'payerId'    => 41,
    'amount'     => 30,
    'ccType'     => 'Visa',
    'ccNum'      => '4007000000027',
    'ccCode'     => '000',
    'ccExpMonth' => 12,
    'ccExpYear'  =>2014);
echo $urlAddress . "nexusService.php?action=makePayment&payer=" . 
     serialize($payerInfo) . "&payment=" . serialize($paymentInfo); 
echo "\n";
exit();

$customerId     = 3;
echo $urlAddress . "customService.php?action=getMemOrder&customerId=" . $customerId;
echo "\n";
exit();

$phone = "7203398379";
$message = "this is a test";
echo $urlAddress . "nexusService.php?action=sendTextMessage&phone=" . 
      $phone . "&msg=" . $message;
echo "\n";
exit();

$orderLines = array();
$orderLine = array();
$orderLine["facilityId"] = -1;
$orderLine["binId"]      = -1;
$orderLine["entityTypeId"] = 58;
$orderLine["entityId"] = 111;
$orderLine["price"] = 11;
$orderLine["cost"] = 11.00;
$orderLine["quantity"] = 1;
array_push($orderLines, $orderLine);
$orderLine = array();
$orderLine["facilityId"] = -1;
$orderLine["binId"]      = -1;
$orderLine["entityTypeId"] = 58;
$orderLine["entityId"] = 111;
$orderLine["price"] = 21;
$orderLine["cost"] = 21.00;
$orderLine["quantity"] = 1;
array_push($orderLines, $orderLine);

$customerId = 41;
$userId = 0;
$invoiceTypeId = 3;
$status = 0;

echo $urlAddress . "nexusService.php?action=createOrder&customerId=" .
     $customerId . "&userId=" . $userId . "&invoiceTypeId=" . $invoiceTypeId .
     "&status=" . $status . "ols=" . serialize($orderLines);
echo "\n";
exit();

$rideData['id']       = 18;
$rideData['ownerId']  = 20;
$rideData['entityId'] = 21;
$rideData['locationId']= 20;
$rideData['date']     = '2014-04-29';
$rideData['time']     = '09:26:25';
$rideData['start']    = 'Denver';
$rideData['status']   = 0;
$rideData['maxMiles'] = 50;
$rideData['seats']    = 4;
$rideData['smoker']   = 0;
$rideData['bags']     = 'M';
$rideData['bagSize']  = 2;
$rideData['note']     = '';
$rideData['to']       = '520 Pearl st boulder, CO 80302';
$rideData['via']      = 'boo boo';
echo $urlAddress . "customService.php?action=updateARide&ride=" .
serialize($rideData);
echo "\n";
exit();

$lift = array("id" => 6,
              "customerId" => 2,
              "rideId" => 4,
              "addressType" => 0,
              "date" => '2014-08-04',
              "time" => '11:25',
              "start" => 'Chicago',
              "to" => 'San Francisco',
              "via" => 'San Francisco',
              "maxMiles" => 5,
              "seats" => 4,
              "smoker" => 1,
              "bags" => 2,
              "badSize" => 'm',
              "note" => 'this is a test.');
echo $urlAddress . "customService.php?action=updateALift&lift=" . 
     serialize($lift); 
echo "\n";
exit();

$liftId = 5;
echo $urlAddress . "customService.php?action=deleteALift&liftId=" . $liftId;
echo "\n";
exit();

$rideId = 3;
echo $urlAddress . "customService.php?action=deleteARide&rideId=" . $rideId;
echo "\n";
exit();

$rideId = 3;
echo $urlAddress . "customService.php?action=getARide&rideId=" . $rideId;
echo "\n";
exit();

echo $urlAddress . "customService.php?action=getBagSizes";
echo "\n";
exit();

echo $urlAddress . "customService.php?action=getSeats";
echo "\n";
exit();
?>  
