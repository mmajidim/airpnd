<?php
/**
* @description  Controller class for calculating the ride contribution
* 
* @copyright    CARRBO LLC. 2013. All rights reseverd.
*               Property of CARRBO. This file can not be used, 
*               altered, in any way without expressed writeen permission 
*               from CARRBO, LLC.
* @version      1.0
* @author       Mehran Majidi
* @file         ContributionCT.php
*
* @todo         
* 
* @revDate      
* @revAuthor    
* @revDesc                   
*/

require_once("nexusPath.inc");
require_once("config.php");
require_once("DAO.php");

class ContributionCT extends CT
{

    const PRICE_PER_MILE = "0.50";

    //______________________________ M E M B E R S _____________________________  
    
    /**
    * @desc   - Used for database interactions
    * @access - private
    * @var    - object
    */
    private $dao;
         

    //______________________ C O N S T R U C T O R  ____________________________  
    
    /**
    * @desc  - Constructor
    * @param - resource $dblink
    */
    function __construct
    (
        $dbLink = NULL
    )
    {    
        $this->dao = new DAO($dbLink);    
        $this->dbLink = $this->dao->getDBLink();
    }
   
    
    //____________________________ U T I L I T Y  ______________________________
        

    /**
    * @desc   - calculate the rider maximum based on mileage selection
    * @access - public
    * @param  - string  $mileage       : maximum mileage driver gives ride  
    * @param  - string  $airportName   : name of the aiport  
    * @param  - string  $driverAddress : driver address  
    * @return - integer $maxPerRider   : maximum rider rate 
    */
    public function calculateMaxPerRider
    (
        $mileage,
        $airportName,
        $driverAddress
    ) 
    {
        $maxPerRider = 0;
        $locationCT = new LocationCT($this->dbLink);
        $locations  = $locationCT->byName($airportName);
        if (!isEmpty($locations) && count($locations) > 0)
        {
            $location       = $locations[0];
            $airportAddress = $location->getAddress();
            $airportMiles   = $this->getMiles($airportAddress,
                                              $driverAddress);
            
            // use the mileage from airport to driver
            // and the maximum mileage
//            $mileageRate    = 0.5;                                  
            $maxPerRider = self::PRICE_PER_MILE * ($airportMiles + $mileage);                                                                                  
        }
            
        return $maxPerRider;
    }       


    /**
    * @desc   - calculate the price based on mileage rate
    *           between two distances 
    * @access - public
    * @param  - string  $mileageRate   : maximum mileage rate used per rider  
    * @param  - string  $airportName   : name of the aiport  
    * @param  - string  $driverAddress : driver address  
    * @param  - string  $riderAddress  : rider address 
    * @param  - string  $seats         : number of seats 
    * @return - integer $price         : contribution on the ride 
    */
    public function calculateContribution
    (
        $mileageRate,
        $airportName,
        $driverAddress,
        $riderAddress,
        $seats
    ) 
    {
        $contribution = 0;
        $locationCT = new LocationCT($this->dbLink);
        $locations  = $locationCT->byName($airportName);
        if (!isEmpty($locations) && count($locations) > 0)
        {
            $location       = $locations[0];
            $airportAddress = $location->getAddress();
            $airportMiles   = $this->getMiles($airportAddress,
                                              $driverAddress);
            $riderMiles     = $this->getMiles($driverAddress,
                                              $riderAddress);
            
            // use the mileage rate with mileage from airport to driver
            // address and from driver address to rider address
//            $mileageRate    = 0.5;                                  
            $contribution   = ($mileageRate * ($airportMiles + $riderMiles)) * 
                               $seats;                                                                                 
        }
            
        return $contribution;
    }       

                                                
    /**
    * @desc   - get mileage rate based on the distance
    *           between aiprot and driver address and the contribution
    *           per rider
    * @access - public
    * @param  - string  $airportName   : name of the aiport  
    * @param  - string  $driverAddress : driver address  
    * @param  - integer $driverToRider : miles between driver and rider
    * @param  - float   $pricePerRider : price per rider 
    * @return - float   $rate          : rate per mile 
    */
    public function getRate
    (
        $airportName,
        $driverAddress,
        $driverToRider,
        $pricePerRider
    )
    {
        $rate = 0;
        $locationCT = new LocationCT($this->dbLink);
        $locations  = $locationCT->byName($airportName);
        if (!isEmpty($locations) && count($locations) > 0)
        {
            $location       = $locations[0];
            $airportAddress = $location->getAddress();
            $airportDistance = $this->getMiles($airportAddress, 
                                               $driverAddress);
            $rate = $pricePerRider / ($airportDistance + $driverToRider);
        }        
        return $rate;        
    }
    
    
    /**
    * @desc   - get mileage between two addresses using google APIs
    * @access - public
    * @param  - string  $from    : from address  
    * @param  - string  $to      : to address  
    * @return - integer $mileage : mileage between two addresses 
    */
    private function getMiles
    (
        $from,
        $to
    )
    {
        $miles = 0;
        if ($from != "" && 
            $to   != "")
        {
            $parms = array ('origin'      => $from,
                            'destination' => $to,
                            'sensor'      => 'true',
                            'units'       => 'imperial');
            $parmsString = "";                
            foreach ($parms AS $var => $val)
            {
                $parmsString .= '&' . $var . '=' . urlencode($val);
            }

            $url = "http://maps.googleapis.com/maps/api/directions/json?" . 
                   ltrim($parmsString, '&');
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $return = curl_exec($curl);
            curl_close($curl);

            $directions = json_decode($return);
            $meterDistance = $directions->routes[0]->legs[0]->distance->value;
            
            // convert to mileage
            $miles = round($meterDistance * 0.000621371);        
        }
        return $miles;
    }
}