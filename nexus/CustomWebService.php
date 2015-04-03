<?php
/**
* @description  Handles Custom ajax calls for CARRBO. 
* 
* @copyright    MindShare HDV LLC. 2013. All rights reseverd.
*               Property of MindShare HDV. 
*               This file can not be used, altered, in any way
*               without expressed written permission from MindShare HDV, LLC.
* @version      1.0.0
* @author       Mehran Majidi
* @file         CustomWebService.php
*
* @todo         
* 
* @revDate      
* @revAuthor    
* @revDesc                   
*/

class CustomWebService extends Ajax
{
    const CARS = "CAR";
   
    const ONE_SEAT    = 1; 
    const TWO_SEAT    = 2; 
    const THREE_SEAT  = 3; 
    const FOUR_SEAT   = 4; 

    const SMALL_BAG_SIZE_CODE       = "S"; 
    const MEDIUM_BAG_SIZE_CODE      = "M"; 
    const LARGE_BAG_SIZE_CODE       = "L"; 
   
    const SMALL_BAG_SIZE_LABEL      = "Small"; 
    const MEDIUM_BAG_SIZE_LABEL     = "Medium"; 
    const LARGE_BAG_SIZE_LABEL      = "Large"; 

    const TEXT_MSG_INDICATOR        = "SMS:Y";
     
    const GET_LOCATIONS             = "getLocations";
    const GET_FEATURED_RENTALS      = "getFeaturedRentals";
    const ADD_DRIVER_LICENSE        = "addDriverLicense";
    const ADD_RENTAL                = "addRental";
    const GET_CAR_RENTALS           = "getCarRentals";
    const SEARCH_RENTAL             = "searchRental";
    const GET_OWNER_RENTALS         = "getOwnerRentals";
    const GET_RENTALS               = "getRentals";
    const GET_DRIVER_LICENSE        = "getDriverLicense";
    const GET_RENTAL_PAYMENT        = "getRentalPayment";
    const GET_MEM_ORDER             = "getMemOrder";
    
    const GET_A_RIDE                = "getARide";
    const UPDATE_A_RIDE             = "updateARide";
    const DELETE_A_RIDE             = "deleteARide";
    const REJECT_A_RIDE             = "rejectARide";
    const POST_A_RIDE               = "postARide";
    const CONFIRM_A_RIDE            = "confirmARide";
    const GET_RIDES                 = "getRides";
    const BOOK_A_RIDE               = "bookARide";
    const RIDES_BY_CUSTOMER         = "ridesByCustomer";
    
    const GET_A_LIFT                = "getALift";
    const UPDATE_A_LIFT             = "updateALift";
    const DELETE_A_LIFT             = "deleteALift";
    const REJECT_A_LIFT             = "rejectALift";
    const POST_AUTO_LIFT            = "postAutoLift";
    const POST_A_LIFT               = "postALift";
    const ADD_ORDER_TO_LIFT         = "addOrderToLift";
    const GET_LIFTS                 = "getLifts";
    const BOOK_A_LIFT               = "bookALift";
    const LIFTS_BY_CUSTOMER         = "liftsByCustomer";
    const PENDING_CONFIRM_A_LIFT    = "pendingConfirmALift";
    const PENDING_PAYMENT_A_LIFT    = "pendingPaymentALift";
    const PENDING_FULFILLED_A_LIFT  = "pendingFulFilledALift";
    const CONFIRM_A_LIFT            = "confirmALift";
    const UPDATE_CONTRIBUTION       = "updateContribution";

    const GET_PRICE_FOR_RIDE        = "getPriceForRide";
    const GET_BAG_SIZES             = "getBagSizes";
    const GET_SEATS                 = "getSeats";
    
    //________________________ C O N S T R U C T O R  __________________________  
    /**
    * @desc   - initialize the XMLVC class.
    *  
    */
	function __construct
	(
	)
	{
        parent::__construct();    
                                          
	}

    
    //____________________________ U T I L I T Y  ______________________________  
    
    /**
    * @desc   - reads the request for XMLVC object
    * @access - public
    */
	public function readRequest
	(
	)
	{
        $parm = "";
        parent::readRequest();
          
        switch($this->action)
        {
            case self::GET_LOCATIONS:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['region']) ?
                            json_decode($_REQUEST['region']) :
                            "";
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['region']) ? 
                            $_REQUEST['region'] : 
                            "";
                    array_push($this->parms, $parm);
                }
            break; 
            case self::GET_FEATURED_RENTALS:
            break; 
            case self::ADD_DRIVER_LICENSE:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['customerId']) ?
                            json_decode($_REQUEST['customerId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['state']) ?
                            json_decode($_REQUEST['state']) :
                            "";
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['number']) ?
                            json_decode($_REQUEST['number']) :
                            "";
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['dob']) ?
                            json_decode($_REQUEST['dob']) :
                            "";
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['customerId']) ? 
                            $_REQUEST['customerId'] : 
                            NO_ID;
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['state']) ? 
                            $_REQUEST['state'] : 
                            "";
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['number']) ? 
                            $_REQUEST['number'] : 
                            "";
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['dob']) ? 
                            $_REQUEST['dob'] : 
                            "";
                    array_push($this->parms, $parm);
                }
            break; 
            case self::ADD_RENTAL:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['customerId']) ?
                            json_decode($_REQUEST['customerId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                    
                    $parm  = isset($_REQUEST['priceItems']) ? 
                             json_decode($_REQUEST['priceItems']) : 
                             NULL;
                             
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['size']) ?
                            json_decode($_REQUEST['size']) :
                            "";
                    array_push($this->parms, $parm);
                
                    $parm = isset($_REQUEST['startDate']) ?
                            json_decode($_REQUEST['startDate']) :
                            "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['endDate']) ?
                            json_decode($_REQUEST['endDate']) :
                            "";
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['customerId']) ? 
                            $_REQUEST['customerId'] : NO_ID;
                    array_push($this->parms, $parm);
                    
                    $parm = isset($_REQUEST['priceItems']) ?
                        unserialize($_REQUEST['priceItems']) : NULL;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['size']) ?
                            $_REQUEST['size'] : "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['startDate']) ?
                            $_REQUEST['startDate'] : "";
                    array_push($this->parms, $parm);
                
                    $parm = isset($_REQUEST['endDate']) ?
                            $_REQUEST['endDate'] : "";
                    array_push($this->parms, $parm);                
                }
            break; 
            case self::GET_CAR_RENTALS:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['entityId']) ?
                            json_decode($_REQUEST['entityId']) :
                            "";
                    array_push($this->parms, $parm);                    
                } 
                else 
                {
                    $parm = isset($_REQUEST['entityId']) ? 
                            $_REQUEST['entityId'] : "";
                    array_push($this->parms, $parm);
                }
            break; 
            case self::SEARCH_RENTAL:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['startDate']) ?
                            json_decode($_REQUEST['startDate']) :
                            "";
                    array_push($this->parms, $parm);
                    
                    $parm = isset($_REQUEST['endDate']) ?
                            json_decode($_REQUEST['endDate']) :
                            "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['location']) ?
                            json_decode($_REQUEST['location']) :
                            "";
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['startDate']) ? 
                            $_REQUEST['startDate'] : "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['endDate']) ? 
                            $_REQUEST['endDate'] : "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['location']) ? 
                            $_REQUEST['location'] : "";
                    array_push($this->parms, $parm);
                }
            break; 
            case self::GET_OWNER_RENTALS:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['ownerId']) ?
                            json_decode($_REQUEST['ownerId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                }
                else 
                {
                    $parm = isset($_REQUEST['ownerId']) ? 
                            $_REQUEST['ownerId'] : NO_ID;
                    array_push($this->parms, $parm);
                }
            break;
            case self::GET_RENTALS:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['customerId']) ?
                            json_decode($_REQUEST['customerId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['customerId']) ? 
                            $_REQUEST['customerId'] : NO_ID;
                    array_push($this->parms, $parm);
                }
            break;
            case self::GET_MEM_ORDER:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['customerId']) ?
                            json_decode($_REQUEST['customerId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['customerId']) ? 
                            $_REQUEST['customerId'] : NO_ID;
                    array_push($this->parms, $parm);
                }
            break;
            case self::GET_DRIVER_LICENSE:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['customerId']) ?
                            json_decode($_REQUEST['customerId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['customerId']) ? 
                            $_REQUEST['customerId'] : NO_ID;
                    array_push($this->parms, $parm);
                }
            break;
            case self::GET_RENTAL_PAYMENT:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['orderId']) ?
                            json_decode($_REQUEST['orderId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['orderId']) ? 
                            $_REQUEST['orderId'] : NO_ID;
                    array_push($this->parms, $parm);
                }
            break;            
            case self::GET_A_RIDE:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['rideId']) ?
                            json_decode($_REQUEST['rideId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['rideId']) ? 
                            $_REQUEST['rideId'] : NO_ID;
                    array_push($this->parms, $parm);
                }                
            break;            
            case self::UPDATE_A_RIDE:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['ride']) ?
                            json_decode($_REQUEST['ride']) :
                            "";
                    if (!isEmpty($parm))
                    {
                        $parm = (array) $parm;
                    }         
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['ride']) ? 
                            unserialize($_REQUEST['ride']) : NULL;
                    array_push($this->parms, $parm);
                }                
            break;            
            case self::DELETE_A_RIDE:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['rideId']) ?
                            json_decode($_REQUEST['rideId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['rideId']) ? 
                            $_REQUEST['rideId'] : NO_ID;
                    array_push($this->parms, $parm);
                }                
            break;            
            case self::REJECT_A_RIDE:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['liftId']) ?
                            json_decode($_REQUEST['liftId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['liftId']) ? 
                            $_REQUEST['liftId'] : NO_ID;
                    array_push($this->parms, $parm);
                }                
            break;            
            case self::POST_A_RIDE:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['ride']) ?
                            json_decode($_REQUEST['ride']) :
                            "";
                    if (!isEmpty($parm))
                    {
                        $parm = (array) $parm;
                    }         
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['ride']) ? 
                            unserialize($_REQUEST['ride']) : NULL;
                    array_push($this->parms, $parm);
                }                
            break;            
            case self::CONFIRM_A_RIDE:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['rideId']) ?
                            json_decode($_REQUEST['rideId']) :
                            NO_ID;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['liftId']) ?
                            json_decode($_REQUEST['liftId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                    
                    // not sure why json_decode does not work with dash
                    $parm = isset($_REQUEST['confNum']) ?
                            $_REQUEST['confNum'] :
                            "";
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['rideId']) ? 
                            $_REQUEST['rideId'] : NO_ID;
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['liftId']) ? 
                            $_REQUEST['liftId'] : NO_ID;
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['confNum']) ? 
                            $_REQUEST['confNum'] : "";
                    array_push($this->parms, $parm);
                }                
            break;            
            case self::GET_RIDES:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['startType']) ?
                            json_decode($_REQUEST['startType']) :
                            RideVO::AIRPORT_START;
                    array_push($this->parms, $parm);
                    
                    $parm = isset($_REQUEST['location']) ?
                            json_decode($_REQUEST['location']) :
                            "";
                    array_push($this->parms, $parm);
                    
                    $parm = isset($_REQUEST['address']) ?
                            json_decode($_REQUEST['address']) :
                            "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['date']) ?
                            json_decode($_REQUEST['date']) :
                            "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['time']) ?
                            json_decode($_REQUEST['time']) :
                            "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['seats']) ?
                            json_decode($_REQUEST['seats']) :
                            RideVO::DEFAULT_SEAT;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['smoker']) ?
                            json_decode($_REQUEST['smoker']) :
                            FALSE;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['bags']) ?
                            json_decode($_REQUEST['bags']) :
                            0;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['bagSize']) ?
                            json_decode($_REQUEST['bagSize']) :
                            RideVO::SMALL;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['startType']) ? 
                            $_REQUEST['startType'] : 
                            RideVO::AIRPORT_START;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['location']) ? 
                            $_REQUEST['location'] : "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['address']) ? 
                            $_REQUEST['address'] : "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['date']) ? 
                            $_REQUEST['date'] : "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['time']) ? 
                            $_REQUEST['time'] : "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['seats']) ?
                            $_REQUEST['seats'] :
                            RideVO::DEFAULT_SEAT;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['smoker']) ?
                            $_REQUEST['smoker'] :
                            RideVO::DEFAULT_SEAT;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['bags']) ? 
                            $_REQUEST['bags'] : 0;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['bagSize']) ?
                            $_REQUEST['bagSize'] :
                            RideVO::SMALL;
                    array_push($this->parms, $parm);
                }
            break;            
            case self::BOOK_A_RIDE:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['rideId']) ?
                            json_decode($_REQUEST['rideId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['liftId']) ?
                            json_decode($_REQUEST['liftId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['seats']) ?
                            json_decode($_REQUEST['seats']) :
                            0;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['rideId']) ? 
                            $_REQUEST['rideId'] : NO_ID;
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['liftId']) ? 
                            $_REQUEST['liftId'] : NO_ID;
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['seats']) ? 
                            $_REQUEST['seats'] : 0;
                    array_push($this->parms, $parm);
                }
            break;            
            case self::RIDES_BY_CUSTOMER:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['customerId']) ?
                            json_decode($_REQUEST['customerId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['customerId']) ? 
                            $_REQUEST['customerId'] : NO_ID;
                    array_push($this->parms, $parm);
                }
            break;            
            case self::GET_A_LIFT:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['liftId']) ?
                            json_decode($_REQUEST['liftId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['liftId']) ? 
                            $_REQUEST['liftId'] : NO_ID;
                    array_push($this->parms, $parm);
                }                
            break;            
            case self::UPDATE_A_LIFT:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['lift']) ?
                            json_decode($_REQUEST['lift']) :
                            "";
                    if (!isEmpty($parm))
                    {
                        $parm = (array) $parm;
                    }         
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['lift']) ? 
                            unserialize($_REQUEST['lift']) : NULL;
                    array_push($this->parms, $parm);
                }                
            break;            
            case self::DELETE_A_LIFT:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['liftId']) ?
                            json_decode($_REQUEST['liftId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['liftId']) ? 
                            $_REQUEST['liftId'] : NO_ID;
                    array_push($this->parms, $parm);
                }                
            break;            
            case self::REJECT_A_LIFT:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['liftId']) ?
                            json_decode($_REQUEST['liftId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['liftId']) ? 
                            $_REQUEST['liftId'] : NO_ID;
                    array_push($this->parms, $parm);
                }                
            break;            
            case self::POST_AUTO_LIFT:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['lift']) ?
                            json_decode($_REQUEST['lift']) :
                            "";
                    if (!isEmpty($parm))
                    {
                        $parm = (array) $parm;
                    }                                     
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['lift']) ? 
                            unserialize($_REQUEST['lift']) : NULL;
                    array_push($this->parms, $parm);
                }                
            break;            
            case self::POST_A_LIFT:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['lift']) ?
                            json_decode($_REQUEST['lift']) :
                            "";
                    if (!isEmpty($parm))
                    {
                        $parm = (array) $parm;
                    }                                     
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['lift']) ? 
                            unserialize($_REQUEST['lift']) : NULL;
                    array_push($this->parms, $parm);
                }                
            break;            
            case self::ADD_ORDER_TO_LIFT:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['orderId']) ?
                            json_decode($_REQUEST['orderId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['liftId']) ?
                            json_decode($_REQUEST['liftId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['orderId']) ? 
                            unserialize($_REQUEST['orderId']) : NULL;
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['liftId']) ? 
                            unserialize($_REQUEST['liftId']) : NULL;
                    array_push($this->parms, $parm);
                }                
            break;            
            case self::GET_LIFTS:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['rideId']) ?
                            json_decode($_REQUEST['rideId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                    
                    $parm = isset($_REQUEST['startType']) ?
                            json_decode($_REQUEST['startType']) :
                            LiftVO::AIRPORT_START;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['location']) ?
                            json_decode($_REQUEST['location']) :
                            "";
                    array_push($this->parms, $parm);
                    
                    $parm = isset($_REQUEST['address']) ?
                            json_decode($_REQUEST['address']) :
                            "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['date']) ?
                            json_decode($_REQUEST['date']) :
                            "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['time']) ?
                            json_decode($_REQUEST['time']) :
                            "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['seats']) ?
                            json_decode($_REQUEST['seats']) :
                            LiftVO::DEFAULT_SEAT;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['smoker']) ?
                            json_decode($_REQUEST['smoker']) :
                            LiftVO::DEFAULT_SEAT;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['bags']) ?
                            json_decode($_REQUEST['bags']) :
                            0;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['bagSize']) ?
                            json_decode($_REQUEST['bagSize']) :
                            LiftVO::SMALL;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['rideId']) ? 
                            $_REQUEST['rideId'] : 
                            NO_ID;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['startType']) ? 
                            $_REQUEST['startType'] : 
                            LiftVO::AIRPORT_START;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['location']) ? 
                            $_REQUEST['location'] : "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['address']) ? 
                            $_REQUEST['address'] : "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['date']) ? 
                            $_REQUEST['date'] : "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['time']) ? 
                            $_REQUEST['time'] : "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['seats']) ?
                            $_REQUEST['seats'] :
                            1;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['smoker']) ?
                            $_REQUEST['smoker'] :
                            1;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['bags']) ? 
                            $_REQUEST['bags'] : 0;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['bagSize']) ?
                            $_REQUEST['bagSize'] :
                            LiftVO::SMALL;
                    array_push($this->parms, $parm);
                }
            break;            
            case self::BOOK_A_LIFT:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['liftId']) ?
                            json_decode($_REQUEST['liftId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['rideId']) ?
                            json_decode($_REQUEST['rideId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['seats']) ?
                            json_decode($_REQUEST['seats']) :
                            0;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['liftId']) ? 
                            $_REQUEST['liftId'] : NO_ID;
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['rideId']) ? 
                            $_REQUEST['rideId'] : NO_ID;
                    array_push($this->parms, $parm);
                    $parm = isset($_REQUEST['seats']) ? 
                            $_REQUEST['seats'] : 0;
                    array_push($this->parms, $parm);
                }
            break;            
            case self::LIFTS_BY_CUSTOMER:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['customerId']) ?
                            json_decode($_REQUEST['customerId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['customerId']) ? 
                            $_REQUEST['customerId'] : NO_ID;
                    array_push($this->parms, $parm);
                }
            break;            
            case self::CONFIRM_A_LIFT:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['liftId']) ?
                            json_decode($_REQUEST['liftId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['liftId']) ? 
                            $_REQUEST['liftId'] : NO_ID;
                    array_push($this->parms, $parm);
                }                
            break;            
            case self::PENDING_CONFIRM_A_LIFT:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['liftId']) ?
                            json_decode($_REQUEST['liftId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['liftId']) ? 
                            $_REQUEST['liftId'] : NO_ID;
                    array_push($this->parms, $parm);
                }                
            break;            
            case self::PENDING_PAYMENT_A_LIFT:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['liftId']) ?
                            json_decode($_REQUEST['liftId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['liftId']) ? 
                            $_REQUEST['liftId'] : NO_ID;
                    array_push($this->parms, $parm);
                }                
            break;  
            case self::PENDING_FULFILLED_A_LIFT:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['liftId']) ?
                            json_decode($_REQUEST['liftId']) :
                            NO_ID;
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['liftId']) ? 
                            $_REQUEST['liftId'] : NO_ID;
                    array_push($this->parms, $parm);
                }                
            break;              
            case self::UPDATE_CONTRIBUTION:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['liftId']) ?
                            json_decode($_REQUEST['liftId']) :
                            NO_ID;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['contribution']) ?
                            json_decode($_REQUEST['contribution']) :
                            "";
                    array_push($this->parms, $parm);
                } 
                else 
                {
                    $parm = isset($_REQUEST['liftId']) ? 
                            $_REQUEST['liftId'] : NO_ID;
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['contribution']) ? 
                            $_REQUEST['contribution'] : NO_ID;
                    array_push($this->parms, $parm);
                }                
            break;              
            case self::GET_PRICE_FOR_RIDE:
                if ($this->isJSONDecode()) 
                {
                    $parm = isset($_REQUEST['airportName']) ?
                            json_decode($_REQUEST['airportName']) :
                            "";
                    array_push($this->parms, $parm);                    

                    $parm = isset($_REQUEST['driverAddress']) ?
                            json_decode($_REQUEST['driverAddress']) :
                            "";
                    array_push($this->parms, $parm);                    

                    $parm = isset($_REQUEST['miles']) ?
                            json_decode($_REQUEST['miles']) :
                            0;
                    array_push($this->parms, $parm);                    
                } 
                else 
                {
                    $parm = isset($_REQUEST['airportName']) ? 
                            $_REQUEST['airportName'] : "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['driverAddress']) ? 
                            $_REQUEST['driverAddress'] : "";
                    array_push($this->parms, $parm);

                    $parm = isset($_REQUEST['miles']) ? 
                            $_REQUEST['miles'] : 0;
                    array_push($this->parms, $parm);
                }
            break;                       
            case self::GET_BAG_SIZES:
            case self::GET_SEATS:
            break;                       
        }
    }

    
    /**
    * @desc   - process the request for processing the request
    * @access - public
    * @return - XML result document
    * 
    */
    public function processRequest
	(
	)
	{
        if ($this->isJSONDecode())
        {
            $result = "";
        }
        else
        {
            $result = '<?xml version="1.0" encoding="ISO-8859-1" ?>';
        }
        $resultReq = "";

	    switch($this->action)
		{
            case self::GET_LOCATIONS:
                $resultReq = $this->getLocations($this->parms[0]);
            break; 
            case self::GET_FEATURED_RENTALS:
                $resultReq = $this->getFeaturedRentals();
            break; 
            case self::ADD_DRIVER_LICENSE:
                $resultReq = $this->addDriverLicense($this->parms[0],
                                                     $this->parms[1],
                                                     $this->parms[2],
                                                     $this->parms[3]);
            break;
		    case self::ADD_RENTAL:
                $resultReq = $this->addRental($this->parms[0],
                                              $this->parms[1],
                                              $this->parms[2],
                                              $this->parms[3],
                                              $this->parms[4]);
            break; 
            case self::GET_CAR_RENTALS:
                $resultReq = $this->getCarRentals($this->parms[0]);
            break;
            case self::SEARCH_RENTAL:
                $resultReq = $this->searchRental($this->parms[0],
                                                 $this->parms[1],
                                                 $this->parms[2]);
            break; 
            case self::GET_OWNER_RENTALS:
                $resultReq = $this->getOwnerRentals($this->parms[0]);
            break; 
            case self::GET_RENTALS:
                $resultReq = $this->getRentals($this->parms[0]);
            break; 
            case self::GET_MEM_ORDER:
                $resultReq = $this->getMemOrder($this->parms[0]);
            break; 
            case self::GET_DRIVER_LICENSE:
                $resultReq = $this->getDriverLicense($this->parms[0]);
            break; 
            case self::GET_RENTAL_PAYMENT:
                $resultReq = $this->getRentalPayment($this->parms[0]);
            break;             
            case self::GET_A_RIDE:
                $resultReq = $this->getARide($this->parms[0]);
            break;            
            case self::UPDATE_A_RIDE:
                $resultReq = $this->updateARide($this->parms[0]);
            break;            
            case self::DELETE_A_RIDE:
                $resultReq = $this->deleteARide($this->parms[0]);
            break;            
            case self::REJECT_A_RIDE:
                $resultReq = $this->rejectARide($this->parms[0]);
            break;            
            case self::POST_A_RIDE:
                $resultReq = $this->postARide($this->parms[0]);
            break;            
            case self::CONFIRM_A_RIDE:
                $resultReq = $this->confirmARide($this->parms[0],
                                                 $this->parms[1],
                                                 $this->parms[2]);
            break;            
            case self::GET_RIDES:
                $resultReq = $this->getRides($this->parms[0],
                                             $this->parms[1],
                                             $this->parms[2],
                                             $this->parms[3],
                                             $this->parms[4],
                                             $this->parms[5],
                                             $this->parms[6],
                                             $this->parms[7],
                                             $this->parms[8]);
            break;            
            case self::BOOK_A_RIDE:
                $resultReq = $this->bookARide($this->parms[0],
                                              $this->parms[1],
                                              $this->parms[2]);
            break;            
            case self::RIDES_BY_CUSTOMER:
                $resultReq = $this->ridesByCustomer($this->parms[0]);
            break;            
            case self::GET_A_LIFT:
                $resultReq = $this->getALift($this->parms[0]);
            break;            
            case self::UPDATE_A_LIFT:
                $resultReq = $this->updateALift($this->parms[0]);
            break;            
            case self::DELETE_A_LIFT:
                $resultReq = $this->deleteALift($this->parms[0]);
            break;            
            case self::REJECT_A_LIFT:
                $resultReq = $this->rejectALift($this->parms[0]);
            break;            
            case self::POST_AUTO_LIFT:
                $resultReq = $this->postAutoLift($this->parms[0]);
            break;            
            case self::POST_A_LIFT:
                $resultReq = $this->postALift($this->parms[0]);
            break;            
            case self::GET_LIFTS:
                $resultReq = $this->getLifts($this->parms[0],
                                             $this->parms[1],
                                             $this->parms[2],
                                             $this->parms[3],
                                             $this->parms[4],
                                             $this->parms[5],
                                             $this->parms[6],
                                             $this->parms[7],
                                             $this->parms[8],
                                             $this->parms[9]);
            break;            
            case self::BOOK_A_LIFT:
                $resultReq = $this->bookALift($this->parms[0],
                                              $this->parms[1],
                                              $this->parms[2]);
            break;            
            case self::ADD_ORDER_TO_LIFT:
                $resultReq = $this->addOrderToLift($this->parms[0],
                                                   $this->parms[1]);
            break;            
            case self::LIFTS_BY_CUSTOMER:
                $resultReq = $this->liftsByCustomer($this->parms[0]);
            break;            
            case self::CONFIRM_A_LIFT:
                $resultReq = $this->confirmALift($this->parms[0]);
            break;            
            case self::PENDING_CONFIRM_A_LIFT:
                $resultReq = $this->pendingConfirmALift($this->parms[0]);
            break;            
            case self::PENDING_PAYMENT_A_LIFT:
                $resultReq = $this->pendingPaymentALift($this->parms[0]);
            break;                           
            case self::PENDING_FULFILLED_A_LIFT:
                $resultReq = $this->pendingFulFilledALift($this->parms[0]);
            break;                                                
            case self::UPDATE_CONTRIBUTION:
                $resultReq = $this->updateContribution($this->parms[0],
                                                       $this->parms[1]);
            break;                                    
            case self::GET_PRICE_FOR_RIDE:
                $resultReq = $this->getPriceForRide($this->parms[0],
                                                    $this->parms[1],
                                                    $this->parms[2]);
            break; 
            case self::GET_BAG_SIZES:
                $resultReq = $this->getBagSizes();
            break; 
            case self::GET_SEATS:
                $resultReq = $this->getSeats();
            break; 
        }
		$result .= $resultReq;
		return($result);

	}

	
    /**
    * @desc   - getLocations
    * @access - public
    * @param  - string $region  : locations for the region 
    * @return - string $result  : data representing the matched locations   
    *                             representing in json or in XML format
    * 
    *                             retcode = 1
    *                             locations = {name, longitude, latitude}
    * 
    *                             retCode = 0                                 
    *                             message = no location was found 
    */
    public function getLocations
    (
        $region
    )
    {
        $retCode = 1;
        $result      = "";
        $resultItem  = "";
        $jResult     = array();

        $locationCT   = new LocationCT();
        $location     = array();
        $locationDat  = array();
        $locationsDat = array();
        
        if (isEmpty($region))
        {
            $locations = $locationCT->allLocations();        
        }
        else
        {
            $locations = $locationCT->byRegion($region);        
        }

        if (isEmpty($locations) || 
            count($locations) == 0)
        {
            $retCode = 0;
        }
        
        if ($retCode)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode']     = 1;
                $jResult['locations']   = $locations;
                $result = json_encode($jResult);
            }
            else
            {
                foreach ($locations AS $location)
                {
                    $id = $location->id;
                    $resultItem      = "<id>" . $location->id . "</id>";                        
                    $resultItem     .= "<name>" . $location->name . "</name>";                                                                                     
                    $resultItem     .= "<longitude>" . $location->longitude . 
                                       "</longitude>";                                                                                                      
                    $resultItem     .= "<latitude>" . $location->latitude . 
                                       "</latitude>";                                                                                                      
                    $result         .= "<returnVal>" . $resultItem . 
                                       "</returnVal>";
                }
                $result          = "<returnVal><retCode>1</retCode>" . 
                                   "</returnVal>" . $result;
                $result          = '<response>' . $result . '</response>';   
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = "No location was found";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>No location was found</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }        
        return $result;   
    } 


    /**
    * @desc   - getFeaturedRentals   : search for list of feature rentals.  
    * @access - public
    * @return - string $result       : data representing the featured items   
    *                                  representing in json or in XML format
    *                                  retcode = 1
    *                                  item = {id, number weeklyRate, dailyRate,
    *                                         image, price, cost, dr, wr}
    *                                  item[features] = {}
    *                                  item[extras]   = {name, price, cost}
    * 
    *                                  retCode = 0                                 
    *                                  message = no match is found 
    * 
    *                                  retCode = -1                                 
    *                                  message = featured rental has failed
    */
    public function getFeaturedRentals
    (
    )
    {
        $retCode = 1;
        $result      = "";
        $resultItem  = "";
        $jResult     = array();

        $itemCT     = new EntityCT();
        $relationCT = new EntityRelationCT($itemCT->getDBLink());
        $priceCT    = new PriceCT($itemCT->getDBLink());
        $featureCT  = new EntityFeatureCT($itemCT->getDBLink());
        $imageCT    = new EntityImageCT($itemCT->getDBLink());
        $items      = array();
        $imageFPN   = "";

        // used for XML
        $eStreams = array();
        $fStreams = array();

        $dao = new DAO();             
        $sql = "SELECT * FROM (SELECT e.id entityId, 
                sdtt.description sdt, edtt.description edt FROM 
                entity e, entityFeature sdtt, entityFeature edtt, 
                entityFeature featured 
                WHERE 
                e.active=1 AND sdtt.name='From' AND  
                edtt.name='To' AND featured.name='premium' AND 
                sdtt.entityId = edtt.entityId AND 
                featured.entityId = sdtt.entityId AND 
                e.id = sdtt.entityId AND 
                e.id = featured.entityId AND 
                e.id=edtt.entityId 
                GROUP BY e.id) AS featuredRental";
        $featuredCars = $dao->findBySQL($sql);        

        if (!isEmpty($featuredCars) && 
            count($featuredCars)>0)
        {
            foreach ($featuredCars AS $featuredCar)
            {
                $startDate = DATE::convertMySqlDatetoUSA($featuredCar['sdt']);
                $endDate   = DATE::convertMySqlDatetoUSA($featuredCar['edt']);
                
                $entityId = $featuredCar['entityId'];
                $itemOne = $itemCT->get($entityId);
                $price  = $priceCT->getWDFixedRatePrice($entityId, 
                                                        $startDate, 
                                                        $endDate);
                $itemPrices = $priceCT->getByEntity($entityId);
                $dailyRate  = "";
                $weeklyRate = "";
                foreach ($itemPrices AS $itemPrice)
                {
                    if ($itemPrice->rateType == PriceVO::DAILY_RATE)
                    {
                        $dailyRate = $itemPrice->price;
                    }
                    else if ($itemPrice->rateType == PriceVO::WEEKLY_RATE)
                    {
                        $weeklyRate = $itemPrice->price;
                    }                
                }

                $images = $imageCT->getByEntityId($entityId); 
                if (!isEmpty($images) && count($images) > 0)
                {
                    $image = $images[0];
                    $imageFPN = $image->url . $image->fileName;
                }
                else
                {
                    $imageFPN = "";
                }
             
                $cost = $price;
                $item = array();
                $item['id']         = $entityId;
                $item['number']     = $itemOne->number;
                $item['name']       = $itemOne->name;
                $item['weeklyRate'] = $weeklyRate;
                $item['dailyRate']  = $dailyRate;
                $item['image']      = $imageFPN;
                $item['price']      = $price;
                $item['cost']       = $cost;
                $item['image']      = $imageFPN;

                $extras = $relationCT->getByTypeSource(
                                          EntityRelationVO::DEPENDENT_TYPE,            
                                          $entityId);
                $eStream = "";
                $itemExtras = array(); 
                foreach ($extras AS $extra)
                {
                    $price               = $priceCT->getWDFixedRatePrice(
                                               $extra['id'], 
                                               $startDate, 
                                               $endDate);
                    $cost                = $price;
                    $oneItem             = $entityCT->get($extra['id']);
                    $itemExtra['id']     = $oneItem->id;
                    $itemExtra['name']   = $oneItem->name;
                    $itemExtra['number'] = $oneItem->number;
                    $itemExtra['price']  = $price;
                    $itemExtra['cost']   = $cost;
                    $eStream            .= $oneItem->id."|".
                                           $oneItem->number . "|" . 
                                           $oneItem->name . "|" . 
                                           $price."|".$cost.";";
                    array_push($itemExtras, $itemExtra);
                }
                $eStream = rtrim($eStream, ";");    
                $eStreams[$entityId] = $eStream;        
                $item['extras']      = $itemExtras;

                $features = $featureCT->getByEntityId(
                                $featuredCar['entityId'], 
                                EntityFeatureVO::OTHER_FEATURE);
                $fStream = "";
                $featuresDat = array();
                foreach ($features AS $feature)
                {
                    $fStream .= $feature->id. "|" . $feature->name . "|" .
                                $feature->description. ";";
                    $featureDat = array();
                    $featureDat['id']   =  $feature->id;              
                    $featureDat['name'] =  $feature->name;            
                    $featureDat['description'] = $feature->description; 
                    array_push($featuresDat, $featureDat);            
                }
                $fStream = rtrim($fStream, ";");
                $fStreams[$entityId] = $fStream;

                $item['features'] = $featuresDat; 
                array_push($items, $item);
            }
        }   
        else
        {
            $retCode = 0;
        }      


        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 1;
                $jResult['items']     = $items;
                $result = json_encode($jResult);
            }
            else
            {
                foreach ($items AS $item)
                {
                    $id = $item['id'];
                    $resultItem      = "<id>" . $item['id'] . "</id>";                        
                    $resultItem     .= "<number>" . $item['number'] . 
                                       "</number>";                                                                                                      
                    $resultItem     .= "<name>" . $item['name'] . 
                                       "</name>";                                                                                                      
                    $resultItem     .= "<weeklyRate>" . $item['weeklyRate'] . 
                                       "</weeklyRate>";                        
                    $resultItem     .= "<dailyRate>" . $item['dailyRate'] . 
                                       "</dailyRate>";                        
                    $resultItem     .= "<image>" . $item['image'] . 
                                       "</image>";                        
                    $resultItem     .= "<price>" . $item['price'] . 
                                       "</price>";                        
                    $resultItem     .= "<cost>" . $item['cost'] . 
                                       "</cost>";                        
                    $resultItem     .= "<extras>" . $eStreams[$id] . 
                                       "</extras>";                        
                    $resultItem     .= "<features>" . $fStreams[$id] . 
                                       "</features>";                        
                    $result         .= "<returnVal>" . $resultItem . 
                                       "</returnVal>";
                }
                $result          = "<returnVal><retCode>1</retCode>" . 
                                   "</returnVal>" . $result;
                $result          = '<response>' . $result . '</response>';   
            }
        }
        else
        {
            if ($retCode == 0)
            {
                $message = "No match is found";                
            }
            else
            {
                $message = "Featured rentals has failed";
            }

            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = "Featrued Rental has failed";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }        
        return $result;   
    }
    
        
    /**
    * @desc   - addDriverLicense
    * @access - public
    * @param  - integer $customerId  : id of the customer
    * @param  - string  $state       : driver license state
    * @param  - string  $number      : driver license number
    * @param  - string  $dob         : date of birth
    * @return - string  $result      : data return in string   
    *                                  representing in json or in XML format
    *                                  retCode 1 driver license has been added
    *                                  retCode 0 driver license was mot added
    *           
    */
    public function addDriverLicense
    (
        $customerId,
        $state,
        $number,
        $dob
    )
    {
        $retCode     = 1;
        $result      = "";
        $resultItem  = "";
        $jResult     = array();

        
        $dlCT = new DriverLicenseCT();
        
        // create driver license object
        $dlVO = new DriverLicenseVO(NO_ID, $customerId, $state, $number, $dob);
        $retObj = $dlCT->add($dlVO);
 
        if (isEmpty($retObj = 1))
        {
            $retCode = 0;
        }                   
                                     
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 1;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>1</retCode>";
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }
        else
        {
            $message = "Driver License add failed";

            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = $message;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }        
        return $result;   
    } 


    /**
    * @desc   - addRental
    * @access - public
    * @param  - integer $customerId  : id of the customer
    * @param  - array   $priceItems  : items for rental, first element is
    *                                  price and the rest of the items are id
    *                                  {price, id, id}
    * @param  - string  $size        : size of the item (this is optional)
    * @param  - string  $sdt         : start date and time for rental
    * @param  - string  $edt         : end date and time for rental
    * @return - string  $result      : data return in string   
    *                                  representing in json or in XML format
    *                                  retCode 1 and reservation number or
    *                                  retCode 0 with error message
    *           
    */
    public function addRental
    (
        $customerId,
        $priceItems,
        $size,
        $sdt,
        $edt
    )
    {
        $result      = "";
        $resultItem  = "";
        $jResult     = array();

        $rentalCT = new ReservationCT();

        // set up rental parameters
        $resType      = ReservationVO::MADE_ONLINE;
        $paymentTerm  = ReservationVO::NET_PAY_RES;
        $resStatus    = ReservationVO::CONFIRMED;
        $madeOnline   = ReservationVO::MADE_ONLINE;
        $note         = "";  
                
        // converting date time to mysql
        $sdt = DATE::convertUSADateToMysql($sdt);
        $edt = DATE::convertUSADateToMysql($edt);        

        $rental = NULL;
        $retCode = $rentalCT->createRental($rental, 
                                           $customerId, 
                                           $priceItems, $size, 
                                           $sdt, $edt, 
                                           $resType, 
                                           $resStatus, 
                                           $paymentTerm, 
                                           $madeOnline, 
                                           $note); 
        if ($retCode == 1)
        {
            $rental->renterId = $customerId;
            $rentalCT->update($rental);
        }                   
                                     
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 1;
                $jResult['id']        = $rental->id;
                $jResult['number']    = $rental->number;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>1</retCode>";
                $resultItem     .= "<id>"        . $rental->id     . "</id>";                        
                $resultItem     .= "<number>"    . $rental->number . 
                                   "</number>";                        
                $resultItem      = "<returnVal>" . $resultItem     . 
                                   "</returnVal>";
                $result          = "<response>"  . $resultItem     . 
                                   "</response>";   
            }
        }
        else
        {
            if ($retCode == -1)
            {
                $message = "No rate was found for at lease one item.";                    
            }
            else if ($retCode == -2)
            {
                $message = "One of the item(s) have no category.";
            }
            else if ($retCode == -3)
            {
                $message = "An invoice type is missing from InvoiceType table.";
            }
            else
            {
                $message = "Rental add failed";
            }

            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = $message;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }        
        return $result;   
    } 
    
    
    /**
    * @desc   - getRentalsPerCar     : get all of the rentals per car 
    * @access - public
    * @param  - string $entityId     : id of the car
    * @return - string $result       : data representing the rentals for a car   
    *                                  representing in json or in XML format
    *                                  retcode = 1
    * 
    *                                  orders = {customerId, firstName,
    *                                            lastName, orderId, fee,
    *                                            tax, subTotal, total, 
    *                                            rentalId, startDate, endDate}
    *                                  retCode = 0                                 
    *                                  message = no rental is found 
    * 
    *                                  retCode = -1                                 
    *                                  message = rental search failed
    */
    public function getCarRentals
    (
        $entityId
    )
    {
        $retCode = 1;
        $result      = "";
        $resultItem  = "";
        $jResult     = array();

        $itemCT     = new EntityCT();

        // used for XML
        $dao = new DAO();    

        $rentalCarType = $itemCT->getByTypeNumber(
                                      EntityVO::CATEGORY_TYPE,
                                      CustomWebService::CARS);

        $rentalCarTypeId = NO_ID;
        if (!isEmpty($rentalCarType))
        {
            $rentalCarTypeId = $rentalCarType->id;
        }                                         
        
        $oStream = "";
                        
        // get any of the current orders
        $sql = "SELECT c.id AS customerId, firstName, lastName,  
                       ol.orderId AS orderId, o.fee, o.tax, 
                       o.subTotal, o.total, r.id AS rentalId, 
                       r.startDate AS startDate, r.endDate AS endDate
                FROM orderLine AS ol, `order` AS o, 
                     reservation AS r, customer AS c 
                WHERE r.startDate >= CURDATE() AND   
                      r.orderId = o.id AND ol.orderId = o.id AND
                      o.customerID = c.id AND  
                      ol.entityId = " . $entityId  . " AND " . 
                     "ol.entityTypeId = " . $rentalCarTypeId;                 
        $orders = $dao->findBySQL($sql);
        
        if (!isEmpty($orders) && count($orders) > 0)
        {
            $retCode = 1;
            foreach ($orders AS $order)
            {
                $order = $orders[0];
                $oStream = $order['customerId'] . ";" . 
                           $order['firstName'] . ";" . 
                           $order['lastName'] . ";" . 
                           $order['orderId'] . ";" . 
                           $order['fee'] . ";" . 
                           $order['tax'] . ";" . 
                           $order['subTotal'] . ";" . 
                           $order['total'] . ";" . 
                           $order['rentalId'] . ";" . 
                           $order['startDate'] . ";" . 
                           $order['endDate'];
                           
                $oStreams[$rId] = $oStream;
            } 
        }
        else
        {
            $retCode = 0;
        }      


        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 1;
                $jResult['orders']     = $orders;
                $result = json_encode($jResult);
            }
            else
            {
                foreach ($orders AS $order)
                {
                    $id = $item['id'];
                    $resultItem      = "<customerId>" . $order['customerId'] . 
                                       "</customerId>";                        
                    $resultItem     .= "<firstName>" . $order['firstName'] . 
                                       "</firstName>";                                                                                                      
                    $resultItem     .= "<lastName>" . $order['lastName'] . 
                                       "</lastName>";                                                                                                      
                    $resultItem     .= "<orderId>" . $order['orderId'] . 
                                       "</orderId>";                        
                    $resultItem     .= "<fee>" . $order['fee'] . 
                                       "</fee>";                        
                    $resultItem     .= "<tax>" . $order['tax'] . 
                                       "</tax>";                        
                    $resultItem     .= "<subTotal>" . $order['subTotal'] . 
                                       "</subTotal>";                        
                    $resultItem     .= "<total>" . $order['total'] . 
                                       "</total>";                        
                    $resultItem     .= "<rentalId>" . $order['rentalId'] . 
                                       "</rentalId>";                        
                    $resultItem     .= "<startDate>" . $order['startDate'] . 
                                       "</startDate>";                        
                    $resultItem     .= "<endDate>" . $order['endDate'] . 
                                       "</endDate>";                        
                    $result         .= "<returnVal>" . $resultItem . 
                                       "</returnVal>";
                }
                $result              = "<returnVal><retCode>1</retCode>" . 
                                       "</returnVal>" . $result;
                $result              = '<response>' . $result . '</response>';   
            }
        }
        else
        {
            if ($retCode == 0)
            {
                $message = "No rental is found";                
            }
            else
            {
                $message = "Rental search has failed";
            }
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = $message;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }        
        return $result;   
    }
    
    
    /**
    * @desc   - searchRental         : search for available rentals based on 
    *                                  start, end and location
    * @access - public
    * @param  - string $sdt          : start date and time for rental
    * @param  - string $edt          : end date and time for rental
    * @param  - string $location     : location of rental
    * @return - string $result       : data representing the matched items   
    *                                  representing in json or in XML format
    *                                  retcode = 1
    *                                  item = {id, number weeklyRate, dailyRate,
    *                                         image, price, cost, dr, wr}
    *                                  item[features] = array of 
    *                                                   {id, name, description}
    *                                  item[extras]   = {name, price, cost}
    * 
    *                                  retCode = 0                                 
    *                                  message = no match is found 
    * 
    *                                  retCode = -1                                 
    *                                  message = rental search failed
    */
    public function searchRental
    (
        $sdt,
        $edt,
        $location
    )
    {
        $retCode = 1;
        $result      = "";
        $resultItem  = "";
        $jResult     = array();

        $itemCT     = new EntityCT();
        $relationCT = new EntityRelationCT($itemCT->getDBLink());
        $priceCT    = new PriceCT($itemCT->getDBLink());
        $featureCT  = new EntityFeatureCT($itemCT->getDBLink());
        $imageCT    = new EntityImageCT($itemCT->getDBLink());
        $items      = array();
        $imageFPN   = "";

        // used for XML
        $eStreams = array();
        $fStreams = array();

        // converting date time to mysql
        $sdt = DATE::convertUSADateToMysql($sdt);
        $edt = DATE::convertUSADateToMysql($edt);        
        
        $sdtList = explode(' ', $sdt);
        if (count($sdtList) == 2)
        {
            $startDate = $sdtList[0];
        }
        else
        {
            $startDate = $sdt;    
        } 
        
        $edtList = explode(' ', $edt);
        if (count($edtList) == 2)
        {
            $endDate = $edtList[0];
        }
        else
        {
            $endDate = $edt;    
        } 
        
        $dao = new DAO();    
 
        
        $sql = "SELECT ol.entityId AS id FROM 
                reservation AS res, `order` AS o, 
                orderLine AS ol, entity AS cat 
                WHERE (('" . $sdt . "' BETWEEN startDate AND 
                endDate) OR ('" . $edt . "' BETWEEN 
                startDate AND endDate)) AND 
                res.orderId = o.id AND ol.orderId = o.id AND 
                ol.entityTypeId = cat.id AND cat.number='CAR'
                GROUP BY ol.entityId";
        
        $eIds = "";
        
        $resEIds = $dao->findBySQL($sql);
        if (!isEmpty($resEIds) && 
            count($resEIds) > 0)
        {
            foreach ($resEIds AS $resEId)
            {
                $eIds .= $resEId['id'] . ",";  
            }
            $eIds = rtrim($eIds, ",");
            $eIds = "(" . $eIds . ")";        
        }
        
        if ($eIds != "")
        {
            $where = " WHERE entityId NOT IN " . $eIds;
        }
        else
        {
            $where = "";
        }
        
        $sql = "SELECT * FROM (SELECT e.id entityId, 
                sdtt.description sdt, edtt.description edt FROM 
                entity c, entityRelation er, 
                entity e, entityFeature sdtt, entityFeature edtt, 
                entityFeature rental, entityFeature loc WHERE
                c.number = 'CAR' AND c.id = er.source AND 
                er.target = e.id AND er.type=0 AND  
                rental.entityId = e.id AND rental.name = 'rental' AND
                rental.description = 'Yes' AND
                e.active=1 AND sdtt.name='From' AND  
                edtt.name='To' AND loc.name='location' AND 
                sdtt.entityId = edtt.entityId AND 
                loc.entityId = sdtt.entityId AND
                rental.entityId = loc.entityId AND 
                e.id = sdtt.entityId AND e.id = loc.entityId AND 
                e.id=edtt.entityId AND
                ('" . $sdt . "' 
                BETWEEN STR_TO_DATE(sdtt.description, '%m/%d/%Y') AND 
                STR_TO_DATE(edtt.description, '%m/%d/%Y')) AND
                ('" . $edt  . "'   
                BETWEEN STR_TO_DATE(sdtt.description, '%m/%d/%Y') AND 
                STR_TO_DATE(edtt.description, '%m/%d/%Y')) AND
                loc.description = '" . $location . "' 
                GROUP BY e.id) AS rentalDate" . $where; 

        $matchedCars = $dao->findBySQL($sql);        

        if (!isEmpty($matchedCars) && 
            count($matchedCars)>0)
        {
            foreach ($matchedCars AS $matchedCar)
            {
                $entityId = $matchedCar['entityId'];
                $itemOne = $itemCT->get($entityId);
                $price  = $priceCT->getWDFixedRatePrice($entityId, 
                                                        $startDate, 
                                                        $endDate);
                                                        
                if ($price == PriceCT::WEEKLY_RATE_MORE_THAN_ONE || 
                    $price == PriceCT::WEEKLY_RATE_NO_RATE || 
                    $price == PriceCT::DAILY_RATE_MORE_THAN_ONE ||
                    $price == PriceCT::DAILY_RATE_NO_RATE)
                {
                    $price = 0;
                }                                        
                                                        
                $itemPrices = $priceCT->getByEntity($entityId);
                $dailyRate  = "";
                $weeklyRate = "";
                foreach ($itemPrices AS $itemPrice)
                {
                    if ($itemPrice->rateType == PriceVO::DAILY_RATE)
                    {
                        $dailyRate = $itemPrice->price;
                    }
                    else if ($itemPrice->rateType == PriceVO::WEEKLY_RATE)
                    {
                        $weeklyRate = $itemPrice->price;
                    }                
                }

                $images = $imageCT->getByEntityId($entityId); 
                if (!isEmpty($images) && count($images) > 0)
                {
                    $image = $images[0];
                    $imageFPN = $image->url . $image->fileName;
                }
                else
                {
                    $imageFPN = "";
                }
             
                $cost = $price;
                $item = array();
                $item['id']         = $entityId;
                $item['number']     = $itemOne->number;
                $item['name']       = $itemOne->name;
                $item['weeklyRate'] = $weeklyRate;
                $item['dailyRate']  = $dailyRate;
                $item['image']      = $imageFPN;
                $item['price']      = $price;
                $item['cost']       = $cost;
                $item['image']      = $imageFPN;

                $extras = $relationCT->getByTypeSource(
                                          EntityRelationVO::DEPENDENT_TYPE,            
                                          $entityId);
                $eStream = "";
                $itemExtras = array(); 
                foreach ($extras AS $extra)
                {
                    $price               = $priceCT->getWDFixedRatePrice(
                                               $extra['id'], 
                                               $startDate, 
                                               $endDate);
                    if ($price == PriceCT::WEEKLY_RATE_MORE_THAN_ONE || 
                        $price == PriceCT::WEEKLY_RATE_NO_RATE || 
                        $price == PriceCT::DAILY_RATE_MORE_THAN_ONE ||
                        $price == PriceCT::DAILY_RATE_NO_RATE)
                    {
                        $price = 0;
                    }                                        

                    $cost                = $price;
                    $oneItem             = $entityCT->get($extra['id']);
                    $itemExtra['id']     = $oneItem->id;
                    $itemExtra['name']   = $oneItem->name;
                    $itemExtra['number'] = $oneItem->number;
                    $itemExtra['price']  = $price;
                    $itemExtra['cost']   = $cost;
                    $eStream            .= $oneItem->id."|".
                                           $oneItem->number . "|" . 
                                           $oneItem->name . "|" . 
                                           $price."|".$cost.";";
                    array_push($itemExtras, $itemExtra);
                }
                $eStream = rtrim($eStream, ";");    
                $eStreams[$entityId] = $eStream;        
                $item['extras']      = $itemExtras;

                $features = $featureCT->getByEntityId(
                                $matchedCar['entityId'], 
                                EntityFeatureVO::OTHER_FEATURE);
                $fStream = "";
                $featuresDat = array();
                foreach ($features AS $feature)
                {
                    $fStream .= $feature->id. "|" . $feature->name . "|" .
                                $feature->description. ";";
                    $featureDat = array();
                    $featureDat['id']   =  $feature->id;              
                    $featureDat['name'] =  $feature->name;            
                    $featureDat['description'] = $feature->description; 
                    array_push($featuresDat, $featureDat);            
                }
                $fStream = rtrim($fStream, ";");
                $fStreams[$entityId] = $fStream;

                $item['features'] = $featuresDat; 
                array_push($items, $item);
            }
        }   
        else
        {
            $retCode = 0;
        }      


        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 1;
                $jResult['items']     = $items;
                $result = json_encode($jResult);
            }
            else
            {
                foreach ($items AS $item)
                {
                    $id = $item['id'];
                    $resultItem      = "<id>" . $item['id'] . "</id>";                        
                    $resultItem     .= "<number>" . $item['number'] . 
                                       "</number>";                                                                                                      
                    $resultItem     .= "<name>" . $item['name'] . 
                                       "</name>";                                                                                                      
                    $resultItem     .= "<weeklyRate>" . $item['weeklyRate'] . 
                                       "</weeklyRate>";                        
                    $resultItem     .= "<dailyRate>" . $item['dailyRate'] . 
                                       "</dailyRate>";                        
                    $resultItem     .= "<image>" . $item['image'] . 
                                       "</image>";                        
                    $resultItem     .= "<price>" . $item['price'] . 
                                       "</price>";                        
                    $resultItem     .= "<cost>" . $item['cost'] . 
                                       "</cost>";                        
                    $resultItem     .= "<extras>" . $eStreams[$id] . 
                                       "</extras>";                        
                    $resultItem     .= "<features>" . $fStreams[$id] . 
                                       "</features>";                        
                    $result         .= "<returnVal>" . $resultItem . 
                                       "</returnVal>";
                }
                $result          = "<returnVal><retCode>1</retCode>" . 
                                   "</returnVal>" . $result;
                $result          = '<response>' . $result . '</response>';   
            }
        }
        else
        {
            if ($retCode == 0)
            {
                $message = "No match is found";                
            }
            else
            {
                $message = "Rental search has failed";
            }
            
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = "Rental search failed";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }        
        return $result;   
    }
    
    
    /**
    * @desc   - getOwnerRentals      : get all of the rentals information for 
    *                                  the owner 
    * @access - public
    * @param  - string $ownerId      : id of the owner
    * @return - string $result       : data representing the matched items   
    *                                  representing in json or in XML format
    *                                  retcode = 1
    *                                  item = {id, number weeklyRate, dailyRate,
    *                                         image, price, cost, dr, wr}
    *                                  item[features] = array of 
    *                                                   {id, name, description}
    *                                  item[extras]   = {name, price, cost}
    *                                  item[order]    = {firstName, lastName,
    *                                                    startDate, endDate, 
    *                                                    total} 
    *                                  retCode = 0                                 
    *                                  message = no match is found 
    * 
    *                                  retCode = -1                                 
    *                                  message = owner rental failed
    */
    public function getOwnerRentals
    (
        $ownerId
    )
    {
        $retCode = 1;
        $result      = "";
        $resultItem  = "";
        $jResult     = array();

        $itemCT     = new EntityCT();
        $relationCT = new EntityRelationCT($itemCT->getDBLink());
        $priceCT    = new PriceCT($itemCT->getDBLink());
        $featureCT  = new EntityFeatureCT($itemCT->getDBLink());
        $imageCT    = new EntityImageCT($itemCT->getDBLink());
        $items      = array();
        $imageFPN   = "";

        // used for XML
        $oStreams = array();
        $eStreams = array();
        $fStreams = array();

        $dao = new DAO();    
        $sql = "SELECT * FROM (SELECT e.id entityId, 
                sdtt.description sdt, edtt.description edt FROM 
                owner o, ownership ow, entity e, 
                entityRelation er,
                entity c,
                entityFeature sdtt, entityFeature edtt 
                WHERE 
                o.id = " . $ownerId . " AND " .                
                "ow.ownerId = o.id AND 
                ow.entityId = e.id AND
                er.source = c.id AND
                er.target = e.id AND
                er.type = " . EntityRelationVO::CATEGORY_TYPE  . " AND
                c.number = 'CAR' AND 
                e.active=1 AND 
                sdtt.name='From' AND  
                edtt.name='To' AND 
                sdtt.entityId = edtt.entityId AND 
                e.id = sdtt.entityId AND 
                e.id=edtt.entityId 
                GROUP BY e.id) AS rentals"; 

        $matchedCars = $dao->findBySQL($sql);        
        $rentalCarType = $itemCT->getByTypeNumber(
                                      EntityVO::CATEGORY_TYPE,
                                      CustomWebService::CARS);

        $rentalCarTypeId = NO_ID;
        if (!isEmpty($rentalCarType))
        {
            $rentalCarTypeId = $rentalCarType->id;
        }                                         
        
        if (!isEmpty($matchedCars) && 
            count($matchedCars)>0)
        {
            foreach ($matchedCars AS $matchedCar)
            {
                $entityId  = $matchedCar['entityId'];
                                
                $startDate = DATE::convertMySqlDatetoUSA($matchedCar['sdt']);
                $endDate   = DATE::convertMySqlDatetoUSA($matchedCar['edt']);
                
                $itemOne = $itemCT->get($entityId);
                $price  = $priceCT->getWDFixedRatePrice($entityId, 
                                                        $startDate, 
                                                        $endDate);
                $itemPrices = $priceCT->getByEntity($entityId);
                $dailyRate  = "";
                $weeklyRate = "";
                foreach ($itemPrices AS $itemPrice)
                {
                    if ($itemPrice->rateType == PriceVO::DAILY_RATE)
                    {
                        $dailyRate = $itemPrice->price;
                    }
                    else if ($itemPrice->rateType == PriceVO::WEEKLY_RATE)
                    {
                        $weeklyRate = $itemPrice->price;
                    }                
                }

                $images = $imageCT->getByEntityId($entityId); 
                if (!isEmpty($images) && count($images) > 0)
                {
                    $image = $images[0];
                    $imageFPN = $image->url . $image->fileName;
                }
                else
                {
                    $imageFPN = "";
                }
             
                $cost = $price;
                $item = array();
                $item['id']         = $entityId;
                $item['number']     = $itemOne->number;
                $item['name']       = $itemOne->name;
                $item['weeklyRate'] = $weeklyRate;
                $item['dailyRate']  = $dailyRate;
                $item['image']      = $imageFPN;
                $item['price']      = $price;
                $item['cost']       = $cost;
                $item['image']      = $imageFPN;

                $extras = $relationCT->getByTypeSource(
                                          EntityRelationVO::DEPENDENT_TYPE,            
                                          $entityId);
                $eStream = "";
                $itemExtras = array(); 
                foreach ($extras AS $extra)
                {
                    $price               = $priceCT->getWDFixedRatePrice(
                                               $extra['id'], 
                                               $startDate, 
                                               $endDate);
                    $cost                = $price;
                    $oneItem             = $entityCT->get($extra['id']);
                    $itemExtra['id']     = $oneItem->id;
                    $itemExtra['name']   = $oneItem->name;
                    $itemExtra['number'] = $oneItem->number;
                    $itemExtra['price']  = $price;
                    $itemExtra['cost']   = $cost;
                    $eStream            .= $oneItem->id."|".$oneItem->number . "|" . 
                                           $oneItem->name . "|" . 
                                           $price."|".$cost.";";
                    array_push($itemExtras, $itemExtra);
                }
                $eStream = rtrim($eStream, ";");    
                $eStreams[$entityId] = $eStream;        
                $item['extras']      = $itemExtras;

                $features = $featureCT->getByEntityId(
                                $matchedCar['entityId'], 
                                EntityFeatureVO::OTHER_FEATURE);
                $fStream = "";
                $featuresDat = array();
                foreach ($features AS $feature)
                {
                    $fStream .= $feature->id. "|" . $feature->name . "|" .
                                $feature->description. ";";
                    $featureDat = array();
                    $featureDat['id']   =  $feature->id;              
                    $featureDat['name'] =  $feature->name;            
                    $featureDat['description'] = $feature->description; 
                    array_push($featuresDat, $featureDat);            
                }
                $fStream = rtrim($fStream, ";");
                $fStreams[$entityId] = $fStream;

                $item['features'] = $featuresDat;                 
                $oStream = "";
                                
                // get any of the current orders
                $sql = "SELECT c.id AS customerId, firstName, lastName,  
                               ol.orderId AS orderId, o.fee, o.tax, 
                               o.subTotal, o.total, r.id AS rentalId, 
                               r.startDate AS startDate, r.endDate AS endDate
                        FROM orderLine AS ol, `order` AS o, 
                             reservation AS r, customer AS c 
                        WHERE r.startDate >= CURDATE() AND   
                              r.orderId = o.id AND ol.orderId = o.id AND
                              o.customerID = c.id AND  
                              ol.entityId = " . $entityId  . " AND " . 
                             "ol.entityTypeId = " . $rentalCarTypeId;                 
                $orders = $dao->findBySQL($sql);
                
                if (!isEmpty($orders) && count($orders) > 0)
                {
                    $order = $orders[0];
                    $oStream = $order['customerId'] . ";" . 
                               $order['firstName'] . ";" . 
                               $order['lastName'] . ";" . 
                               $order['orderId'] . ";" . 
                               $order['fee'] . ";" . 
                               $order['tax'] . ";" . 
                               $order['subTotal'] . ";" . 
                               $order['total'] . ";" . 
                               $order['rentalId'] . ";" . 
                               $order['startDate'] . ";" . 
                               $order['endDate'];
                               
                    $oStreams[$entityId] = $oStream;
                    $item['order'] = $order;       
                }
                array_push($items, $item);                    
            }
        }   
        else
        {
            $retCode = 0;
        }      


        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 1;
                $jResult['items']     = $items;
                $result = json_encode($jResult);
            }
            else
            {
                foreach ($items AS $item)
                {
                    $id = $item['id'];
                    $resultItem      = "<id>" . $item['id'] . "</id>";                        
                    $resultItem     .= "<number>" . $item['number'] . 
                                       "</number>";                                                                                                      
                    $resultItem     .= "<name>" . $item['name'] . 
                                       "</name>";                                                                                                      
                    $resultItem     .= "<weeklyRate>" . $item['weeklyRate'] . 
                                       "</weeklyRate>";                        
                    $resultItem     .= "<dailyRate>" . $item['dailyRate'] . 
                                       "</dailyRate>";                        
                    $resultItem     .= "<image>" . $item['image'] . 
                                       "</image>";                        
                    $resultItem     .= "<price>" . $item['price'] . 
                                       "</price>";                        
                    $resultItem     .= "<cost>" . $item['cost'] . 
                                       "</cost>";                        
                    $resultItem     .= "<extras>" . $eStreams[$id] . 
                                       "</extras>";                        
                    $resultItem     .= "<features>" . $fStreams[$id] . 
                                       "</features>";                        
                    $resultItem     .= "<order>" . $oStreams[$id] . 
                                       "</order>";                        
                    $result         .= "<returnVal>" . $resultItem . 
                                       "</returnVal>";
                }
                $result              = "<returnVal><retCode>1</retCode>" . 
                                       "</returnVal>" . $result;
                $result              = '<response>' . $result . '</response>';   
            }
        }
        else
        {
            if ($retCode == 0)
            {
                $message = "No match is found";                
            }
            else
            {
                $message = "Rental search has failed";
            }
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = "Rental search failed";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }        
        return $result;   
    }
    
    
    /**
    * @desc   - gets the rental information for the renter
    * @access - public
    * @param  - integer $customerId  : customer Id
    * @return - string $result       : rental information representing in json 
    *                                  or in XML format 
    *                                  retcode = 1
    *                                  order = {ownerFirstName,  
    *                                           owenerLastName, 
    *                                           email, orderId, orderNumber,
    *                                           itemId, itemNumber, itemTypeId,
    *                                           itemTypeNumber, description,
    *                                           startDate, endDate, fee, tax, 
    *                                           subTotal, total)
    * 
    *                                  retCode = 0                                 
    *                                  message = no rental is found
    * 
    */
    public function getRentals
    (
        $customerId
    )
    {
        $retCode       = 0;
        $jResult       = array();
        $resultItem    = "";
        $result        = "";
        $rental        = NULL;
        $orderCT       = new OrderCT();
        $ownerCT       = new OwnerCT($orderCT->getDBLink());
        $entityCT      = new EntityCT($orderCT->getDBLink());
        $ownershipCT   = new OwnershipCT($orderCT->getDBLink());
        $ownershipCT   = new OwnershipCT($orderCT->getDBLink());
        $orderLineCT   = new OrderLineCT($orderCT->getDBLink());
        $reservationCT = new ReservationCT($orderCT->getDBLink());
        $featureCT     = new EntityFeatureCT($orderCT->getDBLink());
                
        $orders = $orderCT->ordersPerCustomer($customerId);

        if (!isEmpty($orders) && 
            count($orders) > 0)
        {
            $rentals = array();
            foreach ($orders AS $order)
            {
                $reservation = $reservationCT->getByOrderId($order['id']); 
                $orderLines  = $orderLineCT->getByOrder($order['id']);
                
                if (!isEmpty($reservation))
                {
                    if (!isEmpty($orderLines) && count($orderLines) > 0)
                    {
                        foreach ($orderLines AS $orderLine)
                        {
                            $itemId     = $orderLine->entityID;
                            $itemTypeId = $orderLine->entityTypeId;
                            
                            $itemType       = $entityCT->get($itemTypeId);
                            $item           = $entityCT->get($itemId);

                            if ($itemType->name == 'CAR')
                            {
                                $feature1 = $featureCT->getByEntityIdAndCode
                                                           ($itemId, 'Make/Model');
                                $feature2 = $featureCT->getByEntityIdAndCode
                                                                ($itemId, 'Year');
                                
                                $fd1 = ""; 
                                if (!isEmpty($feature1) &&
                                    count($feature1) > 0)
                                {
                                    $fd1 = $feature1[0]->description;
                                }          
                                
                                $fd2 = "";
                                if (!isEmpty($feature2) &&
                                    count($feature2) > 0)
                                {
                                    $fd2 = $feature2[0]->description;
                                }                                                      
                                $description   = $fd1 . " " . $fd2;
                            }                
                            else
                            {
                                $description = "";
                            }                
                            
                            $ownerId = $ownershipCT->getPriamryOwner($itemId);
                            $owner   = $ownerCT->get($ownerId);
                            
                            $rental = array();
                                                 
                            $rental['ownerFirstName'] = $owner->firstName;
                            $rental['ownerLastName']  = $owner->lastName;
                            $rental['email']          = $owner->email;
                            $rental['orderId']        = $order['id'];                
                            $rental['orderNumber']    = $order['number'];                
                            $rental['orderLineId']    = $orderLine->id;                
                            $rental['itemId']         = $item->id;
                            $rental['itemNumber']     = $item->number;
                            $rental['itemTypeId']     = $itemType->id;
                            $rental['itemTypeNumber'] = $itemType->number;
                            $rental['description']    = $description;
                            $rental['startDate']      = $reservation->startDate;
                            $rental['endDate']        = $reservation->endDate;
                            $rental['fee']            = $order['fee'];
                            $rental['tax']            = $order['tax'];
                            $rental['subTotal']       = $order['subTotal'];
                            $rental['total']          = $order['total'];
                                                
                            array_push($rentals, $rental);                 
                        }                    
                    }
                }
            }

        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $jResult['rentals'] = $rentals;
                $result = json_encode($jResult);
            }
            else
            {
                foreach ($rentals AS $rental)
                {
                    $resultItem      = "<ownerFirstName>" . 
                                       $rental['ownerFirstName'] . 
                                       "</ownerFirstName>";
                    $resultItem     .= "<ownerLastName>" . 
                                       $rental['ownerLastName'] . 
                                       "</ownerLastName>";
                    $resultItem     .= "<email>" . 
                                       $rental['email'] . 
                                       "</email>";
                    $resultItem     .= "<orderId>" . 
                                       $rental['orderId'] . 
                                       "</orderId>";
                    $resultItem     .= "<orderNumber>" . 
                                       $rental['orderNumber'] . 
                                       "</orderNumber>";
                    $resultItem     .= "<itemId>" . 
                                       $rental['itemId'] . 
                                       "</itemId>";
                    $resultItem     .= "<itemNumber>" . 
                                       $rental['itemNumber'] . 
                                       "</itemNumber>";
                    $resultItem     .= "<itemTypeId>" . 
                                       $rental['itemTypeId'] . 
                                       "</itemTypeId>";
                    $resultItem     .= "<itemTypeNumber>" . 
                                       $rental['itemTypeNumber'] . 
                                       "</itemTypeNumber>";
                    $resultItem     .= "<description>" . 
                                       $rental['description'] . 
                                       "</description>";
                    $resultItem     .= "<startDate>" . 
                                       $rental['startDate'] . 
                                       "</startDate>";
                    $resultItem     .= "<endDate>" . 
                                       $rental['endDate'] . 
                                       "</endDate>";
                    $resultItem     .= "<fee>" . 
                                       $rental['fee'] . 
                                       "</fee>";
                    $resultItem     .= "<tax>" . 
                                       $rental['tax'] . 
                                       "</tax>";
                    $resultItem     .= "<subTotal>" . 
                                       $rental['subTotal'] . 
                                       "</subTotal>";
                    $resultItem     .= "<total>" . 
                                       $rental['total'] . 
                                       "</total>";                                                               
                    $result         .= "<returnVal>" . $resultItem . 
                                       "</returnVal>";
                }
                $result              = "<returnVal><retCode>1</retCode>" . 
                                       "</returnVal>" . $result;
                $result              = '<response>' . $result . '</response>';   
            }
        }
        else
        {
            $retCode = 0;
            $message = "no rental order is found.";                
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = $message;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }            
        }
        return $result;                
    }     
    
    
    /**
    * @desc   - gets the membership order information for owner
    * @access - public
    * @param  - integer $customerId  : customer Id
    * @return - string $result       : order information representing in json 
    *                                  or in XML format 
    *                                  retcode = 1
    *                                  order = {id)
    * 
    *                                  retCode = 0                                 
    *                                  message = no order is found
    * 
    */
    public function getMemOrder
    (
        $customerId
    )
    {
        $retCode       = 0;
        $jResult       = array();
        $resultItem    = "";
        $result        = "";
        $orders        = NULL;
        $order         = NULL;
        $dao           = new DAO();
        $orderCT       = new OrderCT();
        $invoiceTypeCT = new InvoiceTypeCT();
                
        $invoiceType = $invoiceTypeCT->getByCode
                          (InvoiceTypeVO::MEM_INVOICE_TYPE_CODE);
                       
        if (!isEmpty($invoiceType))
        {
            $sql = 'SELECT * FROM `order` WHERE customerId = ' . 
                   $customerId  . ' AND invoiceTypeId = '  . $invoiceType->id; 
            $orders = $dao->findBySQL($sql);
            if (!isEmpty($orders) && count($orders) > 0) 
            {
                $order = $orders[0];
                $retCode = 1;
            } 
        }                    
        if ($retCode)
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $jResult['order'] = $order;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem .= "<id>" . $order['id'] . "</id>";
                $resultItem .= "<salesPersonID>" . $order['salesPersonID'] . 
                               "</salesPersonID>";
                $resultItem .= "<customerParentId>" . 
                               $order['customerParentID'] . 
                               "</customerParentId>";
                $resultItem .= "<customerId>" . $order['customerID'] . 
                               "</customerId>";
                $resultItem .= "<invoiceTypeId>" . $order['invoiceTypeId'] . 
                               "</invoiceTypeId>";
                $resultItem .= "<number>" . $order['number'] . "</number>";
                $resultItem .= "<invoiceNumber>" . $order['invoiceNumber'] . 
                               "</invoiceNumber>";
                $resultItem .= "<status>" . $order['status'] . "</status>";
                $resultItem .= "<PO>" . $order['PO'] . "</PO>";
                $resultItem .= "<FOB>" . $order['FOB'] . "</FOB>";
                $resultItem .= "<requestDate>" . $order['requestDate'] . 
                               "</requestDate>";
                $resultItem .= "<releaseDate>" . $order['releaseDate'] . 
                               "</releaseDate>";
                $resultItem .= "<payDate>" . $order['payDate'] . 
                               "</payDate>";
                $resultItem .= "<shipDate>" . $order['shipDate'] . 
                               "</shipDate>";
                $resultItem .= "<invoiceDate>" . $order['invoiceDate'] . 
                               "</invoiceDate>";
                $resultItem .= "<fee>" . $order['fee'] . "</fee>";
                $resultItem .= "<tax>" . $order['tax'] . "</tax>";
                $resultItem .= "<subTotal>" . $order['subTotal'] . 
                               "</subTotal>";
                $resultItem .= "<total>" . $order['total'] . "</total>";
                $resultItem .= "<note>" . $order['note'] . "</note>";
                $result = '<response><returnVal>' . $resultItem . 
                          '</returnVal></response>';   
            }
        }
        else
        {
            $retCode = 0;
            $message = "no membership order is found.";                
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = $message;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }            
        }
        return $result;                
    }     
    
    
    /**
    * @desc   - gets the driver license information for the customer
    * @access - public
    * @param  - integer $customerId  : customer Id
    * @return - string $result       : rental information representing in json 
    *                                  or in XML format 
    *                                  retcode = 1
    *                                  driverLicense = {customerId,  
    *                                                   state, number, dob} 
    * 
    *                                  retCode = 0                                 
    *                                  message = no driver license is found
    * 
    */
    public function getDriverLicense
    (
        $customerId
    )
    {
        $retCode          = 0;
        $jResult          = array();
        $resultItem       = "";
        $result           = "";
        
        $driverLicenseDat = array();
        $driverLicenseCT  = new DriverLicenseCT();
                
        $driverLicense = $driverLicenseCT->byCustomerId($customerId);

        if (!isEmpty($driverLicense)) 
        {
            $driverLicenseDat['customerId'] = $driverLicense->customerId;
            $driverLicenseDat['state']      = $driverLicense->state;
            $driverLicenseDat['number']     = $driverLicense->number;
            $driverLicenseDat['dob']        = $driverLicense->dob;
            
        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $jResult['driverLicense'] = $driverLicenseDat;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>1</retCode>";
                $resultItem     .= "<customerId>" . 
                                   $driverLicense->customerId . 
                                   "</customerId>";
                $resultItem     .= "<state>" . 
                                   $driverLicense->state . 
                                   "</state>";
                $resultItem     .= "<number>" . 
                                   $driverLicense->number . 
                                   "</number>";
                $resultItem     .= "<dob>" . 
                                   $driverLicense->dob . 
                                   "</dob>";
                $resultItem      = "<returnVal>" . $resultItem . 
                                   "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }
        else
        {
            $retCode = 0;
            $message = "no driver license is found.";                
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = $message;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }            
        }
        return $result;                
    }     
    
    
    /**
    * @desc   - gets the rental service payment that is made by the driver
    * @access - public
    * @param  - integer $orderId  : order Id
    * @return - string $result       : payment information for the rental order   
    *                                  representing in json or in XML format
    *                                  retcode = 1
    *                                  order = {id, orderId, payerId, paymentId,
    *                                           status, transactionType, method,
    *                                           payDate, description, amount,
    *                                           ccType, ccNum, ccCode, 
    *                                           ccExpMonth, ccExpYear, 
    *                                           authorizationId}
    *                                  retCode = 0                                 
    *                                  message = no match is found 
    * 
    */
    public function getRentalPayment
    (
        $orderId
    )
    {
        $retCode = 0;
        $jResult = array();
        $resultItem = "";
        $result     = "";
        $rentalSVC = NULL;
        $paymentCT = new PaymentCT();
        
        $payments = $paymentCT->byOrder($orderId);
        if (!isEmpty($payments) && 
            count($payments) > 0)
        {
            $payment = $pauments[0];
            $retCode = 1;
        }
        
        if ($retCode == 1) 
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $paymentData        = array();
                $paymentData["id"]              = $payment->id;
                $paymentData["orderId"]         = $payment->orderId;
                $paymentData["payerId"]         = $payment->payerId;
                $paymentData["paymentId"]       = $payment->paymentId;
                $paymentData["status"]          = $payment->status;
                $paymentData["transactionType"] = $payment->transactionType;
                $paymentData["method"]          = $payment->method;
                $paymentData["payDate"]         = $payment->payDate;
                $paymentData["description"]     = $payment->description;
                $paymentData["amount"]          = $payment->amount;
                $paymentData["ccType"]          = $payment->ccType;
                $paymentData["ccNum"]           = $payment->ccNum;
                $paymentData["ccCode"]          = $payment->ccCode;
                $paymentData["ccExpMonth"]      = $payment->ccExpMonth;
                $paymentData["ccExpYear"]       = $payment->ccExpYear;
                $paymentData["authorizationId"] = $payment->authorizationId;
                $jResult[''] = $paymentData;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>1</retCode>";
                $resultItem     .= "<id>" . $payment->id . "</id>";
                $resultItem     .= "<orderId>" . $payment->orderId . 
                                   "</orderId>";
                $resultItem     .= "<payerId>" . $payment->payerId . 
                                   "</payerId>";
                $resultItem     .= "<paymentId>" . $payment->paymentId . 
                                   "</paymentId>";
                $resultItem     .= "<status>" . $payment->status . 
                                   "</status>";
                $resultItem     .= "<transactionType>" . 
                                   $payment->transactionType . 
                                   "</transactionType>";
                $resultItem     .= "<method>" . $payment->method . 
                                   "</method>";
                $resultItem     .= "<payDate>" . $payment->payDate . 
                                   "</payDate>";
                $resultItem     .= "<description>" . $payment->description . 
                                   "</description>";
                $resultItem     .= "<amount>" . $payment->amount . "</amount>";
                $resultItem     .= "<ccType>" . $payment->ccType . "</ccType>";
                $resultItem     .= "<ccNum>" . $payment->ccNum . "</ccNum>";
                $resultItem     .= "<ccCode>" . $payment->ccCode . "</ccCode>";
                $resultItem     .= "<ccExpMonth>" . $payment->ccExpMonth . 
                                   "</ccExpMonth>";
                $resultItem     .= "<ccExpYear>" . $payment->ccExpYear . 
                                   "</ccExpYear>";
                $resultItem     .= "<authorizationId>" . 
                                   $payment->authorizationId . 
                                   "</authorizationId>";
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }
        else
        {
            $message = "No match is found";                
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = $message;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }
        return $result;                
    }
    
    
    /**
    * @desc   - get the ride from the ride id 
    * @access - public
    * @param  - integer $rideId       : id of the ride
    * @param  - integer $showAddress  : 1 means show address, 0 means hide 
    *                                     address
    * @return - string  $result       : ride information representing in json 
    *                                   or in XML format 
    *                              retcode = 1
    *                              ride = {id, ownerId, entityId, locationId,
    *                                      startType, firstName, lastName, 
    *                                      phone, email, textYes, contribution, 
    *                                      status, dt, start, to, via, 
    *                                      maxMiles, seats, 
    *                                      smoker, bags, bagSize, note, 
    *                                      liftsStream}
    *                                      comma separated lift record
    *                              A lift record has the following 
    *                              information. Each record is separate by 
    *                              a bar (|) for XML and for JSON is an 
    *                              associated array.      
    *                              liftId, startType, firstName;lastName;
    *                              email;phone;textYes;status;address;dt;note 
    * 
    *                              retCode = 0                                 
    *                              message = no ride is found
    * 
    */
    public function getARide
    (
        $rideId
    )
    {
        $ride       = NULL;
        $retCode    = 1;
        $jResult    = array();
        $resultItem = "";
        $result     = "";
        
        $matchedRide   = array();
        $rideCT     = new RideCT();
        $liftCT     = new LiftCT($rideCT->getDBLink());
        $ownerCT    = new OwnerCT($rideCT->getDBLink());
        $customerCT = new CustomerCT($rideCT->getDBLink());
        $priceCT    = new PriceCT($rideCT->getDBLink());
        
        $liftsStreamList = array();        
        if ($rideId != "" || $rideId != NO_ID)
        {
            $ride = $rideCT->get($rideId);
            if (isEmpty($ride))
            {
                $retCode = 0;
            }
            else
            {
                $matchedRide['id']           = $ride->id;
                $matchedRide['ownerId']      = $ride->ownerId;
                $matchedRide['entityId']     = $ride->entityId;
                $matchedRide['locationId']   = $ride->locationId;
                $editable = 0;
                if ($ride->status == RideVO::AVAILABLE)
                {
                    $editable = 1;
                }
                $matchedRide['editable']     = $editable;
                $matchedRide['startType']    = $ride->startType;
                $matchedRide['status']       = $ride->status;
                $matchedRide['dt']           = $ride->dt;
                $matchedRide['start']        = $ride->start;
                $matchedRide['to']           = $ride->to;
                $matchedRide['via']          = $ride->via;
                $matchedRide['maxMiles']     = $ride->maxMiles;
                $matchedRide['seats']        = $ride->seats;
                $matchedRide['smoker']       = $ride->smoker;
                $matchedRide['bags']         = $ride->bags;
                $matchedRide['bagSize']      = $ride->bagSize;
                $matchedRide['note']         = $ride->note;
                
                $customerId = NO_ID;
                if ($ride->ownerId != NO_ID) 
                {
                    $owner   = $ownerCT->get($ride->ownerId);
                    $customerId = $owner->customerId;
                }
                    
                if ($customerId != NO_ID)
                {
                    $customer  = $customerCT->get($customerId);
                    $firstName = $customer->firstName;
                    $lastName  = $customer->lastName;
                    $email     = $customer->email;
                    $phone     = $customer->phone1;
                    $note      = $customer->note;
                    if (strpos($note, self::TEXT_MSG_INDICATOR) !== false)
                    {
                        $textYes = 1;
                    }
                    else
                    {
                        $textYes = 0;
                    }
                }
                else
                {
                    $firstName = "";
                    $lastName  = "";
                    $email     = "";
                    $phone     = "";
                    $textYes   = "";
                }                
                
                $contribution = 0;
                $prices = $priceCT->getByEntity($ride->entityId);
                if (!isEmpty($prices) && 
                    count($prices) > 0)
                {
                    $price = $prices[0];
                    $contribution = $price->cost;
                }
                
                $matchedRide['firstName']    = $firstName;
                $matchedRide['lastName']     = $lastName;
                $matchedRide['email']        = $email;
                $matchedRide['phone']        = $phone;
                $matchedRide['textYes']      = $textYes;
                $matchedRide['contribution'] = $contribution;                        

                $lifts = $liftCT->byRide($ride->id);
                if (!isEmpty($lifts))                
                {
                    $liftsStream = '';
                    $liftsData   = array();
                    foreach ($lifts AS $lift)
                    {
                        $liftId   = $lift->id;
                        if ($lift->customerId != NO_ID)
                        {
                            $customer  = $customerCT->get($lift->customerId);
                            $firstName = $customer->firstName;
                            $lastName  = $customer->lastName;
                            $email     = $customer->email;                            
                            $phone     = $customer->phone1;      
                            $note      = $customer->note;                      
                            if (strpos($note, 
                                self::TEXT_MSG_INDICATOR) !== false)
                            {
                                $textYes = 1;
                            }
                            else
                            {
                                $textYes = 0;
                            }
                        }
                        else
                        {
                            $firstName = "";
                            $lastName  = "";
                            $email     = "";
                            $phone     = "";
                            $textYes   = "";
                        }               
                        
                        $liftData = array();
                        $liftData['id']        = $liftId;                
                        $liftData['firstName'] = $firstName;                
                        $liftData['lastName']  = $lastName;                
                        $liftData['email']     = $email;                
                        $liftData['phone']     = $phone;                
                        $liftData['textYes']   = $textYes;                
                        $liftData['strtType']  = $lift->startType;                
                        $liftData['status']    = $lift->status;                
                        $liftData['to']        = $lift->to;                
                        $liftData['dt']        = $lift->dt;                
                        $liftData['note']      = $lift->note;
                                 
                        $liftStream   = $liftId . ";" . $firstName . ";" . 
                                        $lastName . ";" . $email . ";" .
                                        $textYes . ";" .  
                                        $phone . ";" . $lift->startType .
                                        ";" . $lift->status . ";" . 
                                        $lift->to . ";" .  $lift->dt . ";" . 
                                        $lift->note; 
                        $liftsStream .= ($liftsStream == '') ? 
                                        $liftStream : 
                                        '|' . $liftStream;
                                                                
                        array_push($liftsData, $liftData);                
                    } 
                    $liftsStreamList[$rideId] = $liftsStream;
                    $matchedRide['lifts'] = $liftsData;                
                }
            }
        }
        else
        {
            $retCode = 0;
        }
        
        if ($retCode == 1)
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $jResult['ride']  = $matchedRide;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<id>" . 
                                   $matchedRide['id'] . 
                                   "</id>";
                $resultItem     .= "<ownerId>" . 
                                   $matchedRide['ownerId'] . 
                                   "</ownerId>";
                $resultItem     .= "<entityId>" . 
                                   $matchedRide['entityId'] . 
                                   "</entityId>";
                $resultItem     .= "<locationId>" . 
                                   $matchedRide['locationId'] . 
                                   "</locationId>";
                $resultItem     .= "<startType>" . 
                                   $matchedRide['startType'] . 
                                   "</startType>";
                $resultItem     .= "<dt>" . 
                                   $matchedRide['dt'] . 
                                   "</dt>";
                $resultItem     .= "<start>" . 
                                   $matchedRide['start'] . 
                                   "</start>";
                $resultItem     .= "<to>" . 
                                   $matchedRide['to'] . 
                                   "</to>";
                $resultItem     .= "<via>" . 
                                   $matchedRide['via'] . 
                                   "</via>";
                $resultItem     .= "<maxMiles>" . 
                                   $matchedRide['maxMiles'] . 
                                   "</maxMiles>";
                $resultItem     .= "<seats>" . 
                                   $matchedRide['seats'] . 
                                   "</seats>";
                $resultItem     .= "<smoker>" . 
                                   $matchedRide['smoker'] . 
                                   "</smoker>";
                $resultItem     .= "<bags>" . 
                                   $matchedRide['bags'] . 
                                   "</bags>";
                $resultItem     .= "<bagSize>" . 
                                   $matchedRide['bagSize'] . 
                                   "</bagSize>";
                $resultItem     .= "<note>" . 
                                   $matchedRide['note'] . 
                                   "</note>";
                $resultItem     .= "<firstName>" . 
                                   $matchedRide['firstName'] . 
                                   "</firstName>";
                $resultItem     .= "<lastName>" . 
                                   $matchedRide['lastName'] . 
                                   "</lastName>";
                $resultItem     .= "<email>" . 
                                   $matchedRide['email'] . 
                                   "</email>";
                $resultItem     .= "<phone>" . 
                                   $matchedRide['phone'] . 
                                   "</phone>";
                $resultItem     .= "<textYes>" . 
                                   $matchedRide['textYes'] . 
                                   "</textYes>";
                $resultItem     .= "<contribution>" . 
                                   $matchedRide['contribution'] . 
                                   "</contribution>";
                                   
                $rideId          = $matchedRide['id'];
                if (isset($liftsStreamList[$rideId]))
                {
                    $liftsStream     = $liftsStreamList[$rideId];
                    $resultItem     .= "<liftsStream>" . 
                                       $liftsStream . 
                                       "</liftsStream>";
                }                      
                                   
                $result         .= "<returnVal>" . $resultItem . 
                                   "</returnVal>";
                $result  = "<returnVal><retCode>1</retCode></returnVal>" . 
                           $result;                
                $result = '<response>' . $result . '</response>'; 
            }              
        }
        else
        {
            $retCode = 0;
            $message = "no ride is found.";                
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = $message;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }                        
        }
        return $result;
    } 
    
    
    /**
    * @desc   - update a ride  
    * @access - public
    * @param  - array  $ride   : the associative array containing data 
    *                            for updating a ride  
    *                            See RideVO for explanation for each field
    *                            date must have mm/dd/yyyy format
    *                            time must have hh:mm:ss format
    *                            rideDat = {id, ownerId, entityId, startType,
    *                                       date, time, start, to, via, 
    *                                       maxMiles, seats, smoker, bags, 
    *                                       bagSize, note} 
    * @return - string $result : XML result of id of the ride
    *                            1 means the ride was updated
    *                            0 means the ride did not get updated
    */
    public function updateARide
    (
        $ride
    )
    {
        $retCode = 1;
        $jResult = array();
        $resultItem = "";
        $result  = "";
        
        $rideCT     = new RideCT();
        $locationCT = new LocationCT($rideCT->getDBLink());
        
        $startType = isset($ride['startType']) ? 
                     $ride['startType'] : 
                     RideVO::AIRPORT_START;
        if ($startType == RideVO::AIRPORT_START)
        {
            $locations  = $locationCT->byName($ride['start']);
        }
        else
        {
            $locations  = $locationCT->byName($ride['to']);
        }
        
        if (!isEmpty($locations))
        {
            $location = $locations[0];
            $locationId = $location->id;
        }
        else
        {
            $retCode = -1;
            $locationId = NO_ID;
        }
        
        if ($retCode == 1)
        {
            $id        = isset($ride['id']) ? 
                         $ride['id'] : NO_ID;
                         
            $theRide   = $rideCT->get($id);             
            $ownerId   = isset($ride['ownerId']) ? 
                         $ride['ownerId'] : $theRide->ownerId;
            $entityId  = isset($ride['entityId']) ? 
                         $ride['entityId'] : $theRide->entityId;
            $status    = isset($ride['status']) ? $ride['status'] : 
                         "";
     
            $date      = isset($ride['date']) ? 
                         $ride['date'] : "";
            $time      = isset($ride['time']) ?
                         $ride['time'] : "";                    
            if ($date != "" && $time != "")
            {
                $dt = $date . " " . $time;              
            }             
            else
            {
                $dt = $ride->dt;
            }
            
            
            if ($startType == RideVO::AIRPORT_START)
            {
                $address  = $ride['to'];
            }
            else
            {
                $address  = $ride['start'];
            }
            
            $prepAddr = str_replace(' ','+', $address);
            $geocode  = file_get_contents(
                          'http://maps.google.com/maps/api/geocode/json?address='.
                          $prepAddr.
                          '&sensor=false');
            $output= json_decode($geocode);
            $latitude = $output->results[0]->geometry->location->lat;
            $longitude = $output->results[0]->geometry->location->lng;        

            $start     = isset($ride['start']) ?
                         $ride['start'] : $ride->start;
            $to        = isset($ride['to']) ?
                         $ride['to'] : $ride->to;
            $via       = isset($ride['via']) ?
                         $ride['via'] : $ride->via;
            $maxMiles  = isset($ride['maxMiles']) ?
                         $ride['maxMiles'] : $ride->maxMiles;
            $seats     = isset($ride['seats']) ?
                         $ride['seats'] : $ride->seats;
            $smoker    = isset($ride['smoker']) ?
                         $ride['smoker'] : $ride->smoker;
            $bags      = isset($ride['bags']) ?
                         $ride['bags'] : $ride->bags;
            $bagSize   = isset($ride['bagSize']) ?
                         $ride['bagSize'] : $ride->bagSize;
            $note      = isset($ride['note']) ?
                         $ride['note'] : $ride->note;

            $ride = new RideVO($id, $ownerId, $entityId, $locationId, 
                               $startType, $status, $dt, $longitude, $latitude, 
                               $start, $to, $via, $maxMiles, $seats, 
                               $smoker, $bags, $bagSize, $note);
            $rideCT->update($ride);
        }
        
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $jResult['rideId']  = $ride->id;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem .= "<rideId>" . $ride->id . "</rideId>"; 
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                if ($retCode == -1)
                {
                    $jResult['retCode']   = -1;
                    $jResult['errorMsg']  = "No location is found";
                }
                else
                {
                    $jResult['retCode']   = 0;
                    $jResult['errorMsg']  = "Updating ride has failed";
                }
                $result = json_encode($jResult);
            }
            else
            {
                if ($retCode == -1)
                {
                    $resultItem      = "<retCode>-1</retCode>";
                    $resultItem     .= "<errorMsg>No location is found " . 
                                       "</errorMsg>";                        
                }
                else
                {
                    $resultItem      = "<retCode>0</retCode>";
                    $resultItem     .= "<errorMsg>Updating ride has " . 
                                       "failed</errorMsg>";                        
                }
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    } 

 
    /**
    * @desc   - delete a ride  
    * @access - public
    * @param  - integer  $rideId : the id of the ride 
    * @return - string $result : XML result of the ride
    *                            1 means the ride was deleted
    *                            0 means the ride did not get deleted
    */
    public function deleteARide
    (
        $rideId
    )
    {
        $retCode = 1;
        $jResult = array();
        $resultItem = "";
        $result  = "";
        
        $rideCT = new RideCT();
        $delRet = $rideCT->delete($rideId);
       
        if ($delRet = "")
        {
            $retCode = 0;
        } 
        
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = "Deleting ride has failed";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>Deleting ride has failed</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>'  . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    } 

 
    /**
    * @desc   - reject a ride which is the same as reject a lift
    * @access - public
    * @param  - integer $liftId : the id of the lift that has 
    *                             rejected the ride offer 
    * @return - string  $result : XML result of the ride
    *                            1 means the ride was rejected
    *                            0 means the ride did not get rejected
    */
    public function rejectARide
    (
        $liftId
    )
    {
        $retCode = 1;
        $jResult = array();
        $resultItem = "";
        $result  = "";
        
        // the reject processing happens from lift,
        // no change to the ride is necessary.
        $liftCT = new LiftCT();
        $retCode = $liftCT->reject($liftId);
       
        
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = "Rejecting ride has failed";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>Rejecting ride has failed</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>'  . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    } 

 
    /**
    * @desc   - post a ride  
    * @access - public
    * @param  - array  $ride   : the associative array containing data 
    *                            to add a ride.  
    *                            See RideVO for explanation for each field
    *                            date must have mm/dd/yyyy format
    *                            time must have hh:mm:ss format
    *                            rideDat = {ownerId, entityId, startType, 
    *                                       date, time, start, to, via, 
    *                                       maxMiles, seats, smoker, bags, 
    *                                       bagSize, note} 
    * @return - string $result : XML result of id of the ride
    *                            1 means the ride was posted
    *                            0 means the ride did not get posted
    */
    public function postARide
    (
        $ride
    )
    {
        $retCode = 1;
        $jResult = array();
        $resultItem = "";
        $result  = "";
        
        $rideCT     = new RideCT();
        $locationCT = new LocationCT($rideCT->getDBLink());
        
        
        $startType = isset($ride['startType']) ? 
                     $ride['startType'] : 
                     RideVO::AIRPORT_START;

        if ($startType == RideVO::AIRPORT_START)
        {
            $locations  = $locationCT->byName($ride['start']);
        }
        else
        {
            $locations  = $locationCT->byName($ride['to']);
        }
        
        if (!isEmpty($locations))
        {
            $location = $locations[0];
            $locationId = $location->id;
        }
        else
        {
            $retCode    = -1;
            $locationId = NO_ID;
        }
        
        if ($retCode == 1)
        {
            $ownerId   = isset($ride['ownerId']) ? 
                         $ride['ownerId'] : NO_ID;
            $entityId  = isset($ride['entityId']) ? 
                         $ride['entityId'] : NO_ID;
            $status    = RideVO::AVAILABLE;
            $date      = isset($ride['date']) ? 
                         $ride['date'] : Date::getCurrentDateInUSAFormat();
            $time      = isset($ride['time']) ?
                         $ride['time'] : Date::getCurrentTimeInUSAFormat();
            $dt = $date . " " . $time;              

            if ($startType == RideVO::AIRPORT_START)
            {
                $address  = $ride['to'];
            }
            else
            {
                $address  = $ride['start'];
            }
            $prepAddr = str_replace(' ','+', $address);
            $geocode  = file_get_contents(
                          'http://maps.google.com/maps/api/geocode/json?address='.
                          $prepAddr.
                          '&sensor=false');
            $output= json_decode($geocode);
            $latitude = $output->results[0]->geometry->location->lat;
            $longitude = $output->results[0]->geometry->location->lng;        

            $start     = isset($ride['start']) ?
                         $ride['start'] : "";
            $to        = isset($ride['to']) ?
                         $ride['to'] : "";
            $via       = isset($ride['via']) ?
                         $ride['via'] : "";
            $maxMiles  = isset($ride['maxMiles']) ?
                         $ride['maxMiles'] : 0;
            $seats     = isset($ride['seats']) ?
                         $ride['seats'] : 0;
            $smoker    = isset($ride['smoker']) ?
                         $ride['smoker'] : FALSE;
            $bags      = (isset($ride['bags']) && $ride['bags']) ?
                         $ride['bags'] : 0;
            $bagSize   = isset($ride['bagSize']) ?
                         $ride['bagSize'] : RideVO::SMALL;
            $note      = isset($ride['note']) ?
                         $ride['note'] : "";

            $ride = new RideVO(NO_ID, $ownerId, $entityId, $locationId, 
                               $startType, $status, $dt, $longitude, $latitude, 
                               $start, $to, $via, $maxMiles, $seats, 
                               $smoker, $bags, $bagSize, $note);
            $rideCT->add($ride);            
        }
        
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $jResult['rideId']  = $ride->id;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem .= "<rideId>" . $ride->id . "</rideId>"; 
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                if ($retCode == -1)
                {
                    $jResult['retCode']   = -1;
                    $jResult['errorMsg']  = "No location is found";
                }
                else
                {
                    $jResult['retCode']   = 0;
                    $jResult['errorMsg']  = "Adding ride has failed";
                }
                $result = json_encode($jResult);
            }
            else
            {
                if ($retCode == -1)
                {
                    $resultItem      = "<retCode>-1</retCode>";
                    $resultItem     .= "<errorMsg>No location is found " . 
                                       "</errorMsg>";                        
                }
                else
                {
                    $resultItem      = "<retCode>0</retCode>";
                    $resultItem     .= "<errorMsg>Adding ride has " . 
                                       "failed</errorMsg>";                        
                }
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    } 

 
    /**
    * @desc   - confirm a ride  
    * @access - public
    * @param  - integer  $rideId  : id of the ride 
    *           integer  $liftId  : id of the lift
    *           string   $confNum : confirmation number
    * @return - string $result : XML result of id of the ride
    *                            1 means the ride was updated and confirmed
    *                            2 means the confirmation did not match 
    *                            0 means the confirmation has failed
    */
    public function confirmARide
    (
        $rideId,
        $liftId,
        $confNum
    )
    {
// change to include order id and number        
        $retCode = 1;
        $jResult = array();
        $resultItem = "";
        $result  = "";
        
        $rideCT      = new RideCT();
        $liftCT      = new LiftCT($rideCT->getDBLink());
        $lift        = $liftCT->get($liftId);
        
        if ($lift->confNum == $confNum)
        {
            $lift->confirm();
            $liftCT->update($lift);
            $hasAnyPendingLifts = $rideCT->hasPendingLifts($rideId);
            if (!$hasAnyPendingLifts)
            {
                $ride = $rideCT->get($rideId);
                $ride->status = RideVO::FULFILLED;
                $rideCT->update($ride);
            } 
        }   
        else
        {
            $retCode = 2;
        }        
        
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else if ($retCode == 2)
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 2;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>2</retCode>";
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = "Lift confirmation has failed";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>Lift confirmation has failed" . 
                                   "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    } 

 
    /**
    * @desc   - gets the matching rides based on the longitude, latitude of
    *           the address, date, time and maximum miles 
    * @access - public
    * @param  - string  $startType : start type
    * @param  - string  $location  : start location
    * @param  - string  $address   : address of the rider
    * @param  - string  $date      : request date for drive (format dd/mm/yyyy)
    * @param  - string  $time      : request time for drive
    * @param  - integer $seats     : requested seats
    * @param  - boolean $smoker    : indicating if a smoker
    * @param  - integer $bags      : bags
    * @param  - string  $bagSize   : requests bag size
    * @return - string  $result    : ride information representing in json 
    *                                or in XML format 
    *                                retcode = 1
    *                                ride = {rId, ownerId, entityId, 
    *                                        startType, datetime, start, to, 
    *                                        via, maxMiles, seats, 
    *                                        smoker, bags, bagSize, firstName,
    *                                        lastName, contribution}
    * 
    *                                retCode = 0                                 
    *                                message = no ride is found
    * 
    */
    public function getRides
    (
        $startType,
        $location, 
        $address, 
        $date, 
        $time, 
        $seats,
        $smoker,
        $bags,
        $bagSize
    )
    {
        $rideCT = new RideCT();
        $retCode       = 0;
        $jResult       = array();
        $resultItem    = "";
        $result        = "";
        
        $matchedRides  = array();
        
        $sqlDate = Date::convertUSADateToMysql($date);

        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents(
            'http://maps.google.com/maps/api/geocode/json?address='.
            $prepAddr.
            '&sensor=false');
        $output= json_decode($geocode);
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;        
       
        $matchedRides = $rideCT->getAvailableRides($startType, $location, 
                                                   $address, $longitude, 
                                                   $latitude, $sqlDate, $time, 
                                                   $seats, $smoker, 
                                                   $bags, $bagSize);
  
        if (!isEmpty($matchedRides) && 
            count($matchedRides) > 0) 
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $jResult['rides']   = $matchedRides;
                $result = json_encode($jResult);
            }
            else
            {
                foreach ($matchedRides AS $matchedRide)
                {
                    $resultItem      = "<rideId>" . 
                                       $matchedRide['rId'] . 
                                       "</rideId>";
                    $resultItem     .= "<ownerId>" . 
                                       $matchedRide['ownerId'] . 
                                       "</ownerId>";
                    $resultItem     .= "<entityId>" . 
                                       $matchedRide['entityId'] . 
                                       "</entityId>";
                    $resultItem     .= "<startType>" . 
                                       $matchedRide['startType'] . 
                                       "</startType>";
                    $resultItem     .= "<datetime>" . 
                                       $matchedRide['datetime'] . 
                                       "</datetime>";
                    $resultItem     .= "<start>" . 
                                       $matchedRide['start'] . 
                                       "</start>";
                    $resultItem     .= "<to>" . 
                                       $matchedRide['to'] . 
                                       "</to>";
                    $resultItem     .= "<via>" . 
                                       $matchedRide['via'] . 
                                       "</via>";
                    $resultItem     .= "<maxMiles>" . 
                                       $matchedRide['maxMiles'] . 
                                       "</maxMiles>";
                    $resultItem     .= "<seats>" . 
                                       $matchedRide['seats'] . 
                                       "</seats>";
                    $resultItem     .= "<smoker>" . 
                                       $matchedRide['smoker'] . 
                                       "</smoker>";
                    $resultItem     .= "<bags>" . 
                                       $matchedRide['bags'] . 
                                       "</bags>";
                    $resultItem     .= "<bagSize>" . 
                                       $matchedRide['bagSize'] . 
                                       "</bagSize>";
                    $resultItem     .= "<firstName>" . 
                                       $matchedRide['firstName'] . 
                                       "</firstName>";
                    $resultItem     .= "<lastName>" . 
                                       $matchedRide['lastName'] . 
                                       "</lastName>";
                    $note      = $matchedRide['note'];                      
                    if (strpos($note, self::TEXT_MSG_INDICATOR) !== false)
                    {
                        $resultItem     .= "<textYes>" . 
                                           1 . 
                                           "</textYes>";
                    }
                    else
                    {
                        $resultItem     .= "<textYes>" . 
                                           0 . 
                                           "</textYes>";
                    }
                                                                              
                    $resultItem     .= "<contribution>" . 
                                       $matchedRide['contribution'] . 
                                       "</contribution>";
                    $result         .= "<returnVal>" . $resultItem . 
                                       "</returnVal>";
                }
                $result  = "<returnVal><retCode>1</retCode></returnVal>" . 
                           $result;                
                $result = '<response>' . $result . '</response>';   
            }
        }                                           
        else
        {
            $retCode = 0;
            $message = "no ride is found.";                
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = $message;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }            
        }
        return $result;                
    }         
    
    
    /**
    * @desc   - book a ride  
    * @access - public
    * @param  - integer $rideId : id of the ride
    * @param  - integer $liftId : id of the lift
    * @param  - integer $seats  : number of seats
    * @return - string  $result : 1 means the ride was booked
    *                             0 means the ride did not get booked, not
    *                               enough seats  
    */
    public function bookARide
    (
        $rideId,
        $liftId,
        $seats
    )
    {
        $retCode = 1;
        
        $rideCT = new RideCT();
        $liftCT = new LiftCT($rideCT->getDBLink());
        
        $ride = $rideCT->get($rideId);
        
        if (!isEmpty($ride) && 
            $ride->id != NO_ID)
        {
            $lift = $liftCT->get($liftId);
            if (!isEmpty($lift) && 
                $lift->id != NO_ID)
            {
                if ($ride->seats >= $seats)
                {
/*                    $ride->seats = $ride->seats - $seats;
                    if ($ride->seats == 0)
                    {
                        $ride->status = RideVO::FULL;
                    }
                    else
                    {
                        $ride->status = RideVO::AVAILABLE;                        
                    }
*/                    
                    $lift->rideId = $rideId;
                    $lift->pendingConfirm();                    
                    $liftCT->update($lift);
                }
                else
                {
                    $retCode = 0;
                }
            }
            else
            {
                $retCode = -2;
            }
        }
        else 
        {
            $retCode = -1;
        }

        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else if ($retCode == -1)
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = -1;
                $jResult['errorMsg']  = "No ride is found.";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>-1</retCode>";
                $resultItem     .= "<errorMsg>No ride is found</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }
        else if ($retCode == -2)
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = -2;
                $jResult['errorMsg']  = "No lift is found.";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>-2</retCode>";
                $resultItem     .= "<errorMsg>No lift is found</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = "Not enough seat";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>Not enough seat</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    }
 
             
    /**
    * @desc   - rides by customer 
    * @access - public
    * @param  - string  $customerId  : id of the customer
    * @return - string  $result      : ride information representing in json 
    *                                  or in XML format 
    *                                  retcode = 1
    *                                  ride = {id, ownerId, customerId, 
    *                                          entityId, locationId, 
    *                                          startType, editable, status, 
    *                                          contribution, dt, start, to, 
    *                                          via, maxMiles, seats, smoker, 
    *                                          bags, bagSize, note, liftsStream}
    *                                          comma separated lift record
    *                                  A lift record has the following 
    *                                  information. Each record is separate by 
    *                                  a bar (|) for XML and it is an 
    *                                  associated array for JSON.  
    *                                  liftId;orderId;confNum;contribution
    *                                  firstName;lastName;email;phone;startType;
    *                                  status;start;to;dt;note
    *                                
    *                                  retCode = 0                                 
    *                                  message = no ride is found
    * 
    */
    public function ridesByCustomer
    (
        $customerId 
    )
    {
        $rides      = NULL;
        $ownerCT    = new OwnerCT();
        $customerCT = new CustomerCT($ownerCT->getDBLink());
        $priceCT    = new PriceCT($ownerCT->getDBLink());        
        $rideCT     = new RideCT($ownerCT->getDBLink());        
        $liftCT     = new LiftCT($ownerCT->getDBLink());        
                
        $retCode       = 0;
        $jResult       = array();
        $resultItem    = "";
        $result        = "";
        
        $owner = $ownerCT->getByCustomerId($customerId);
        if (isEmpty($owner))
        {
            $ownerId = NO_ID;
        }
        else
        {
            $ownerId = $owner->id;
            $rides = $rideCT->byOwner($ownerId); 
        }
        
        $matchedRides = array();
        $liftsStreamList = array();        
        
        if (!isEmpty($rides) && count($rides) > 0) 
        {
            foreach ($rides AS $ride)
            {
                $matchedRide   = array();
                $matchedRide['id']           = $ride->id;
                $matchedRide['ownerId']      = $ride->ownerId;
                $matchedRide['customerId']   = $customerId;
                $matchedRide['entityId']     = $ride->entityId;
                $matchedRide['locationId']   = $ride->locationId;
                $matchedRide['startType']    = $ride->startType;
                
                $editable = 0;
                if ($ride->status == RideVO::AVAILABLE)
                {
                    $editable = 1;
                }
                $matchedRide['editable']   = $editable;
                $matchedRide['status']     = $ride->status;

                $contribution = 0;
                $prices = $priceCT->getByEntity($ride->entityId);
                if (!isEmpty($prices) && 
                    count($prices) > 0)
                {
                    $price = $prices[0];
                    $contribution = $price->cost;
                }
                
                $matchedRide['dt']           = $ride->dt;
                $matchedRide['contribution'] = $contribution;
                $matchedRide['start']        = $ride->start;
                $matchedRide['to']           = $ride->to;
                $via = str_replace('&', 'and', $ride->via);
                $matchedRide['via']          = $via;
                $matchedRide['maxMiles']     = $ride->maxMiles;
                $matchedRide['seats']        = $ride->seats;
                $matchedRide['smoker']       = $ride->smoker;
                $matchedRide['bags']         = $ride->bags;
                $matchedRide['bagSize']      = $ride->bagSize;
                $matchedRide['note']         = $ride->note;
                
                $lifts = $liftCT->byRide($ride->id);
                $liftsStream = '';
                $liftsData   = array();
                if (!isEmpty($lifts))                
                {
                    foreach ($lifts AS $lift)
                    {
                        $liftId   = $lift->id;
                        $orderId  = $lift->orderId;
                        $confNum  = $lift->confNum;
                        if ($lift->customerId != NO_ID)
                        {
                            $customer  = $customerCT->get($lift->customerId);
                            $firstName = $customer->firstName;
                            $lastName  = $customer->lastName;
                            $email     = $customer->email;                            
                            $phone     = $customer->phone1; 
                            $note      = $customer->note;
                            if (strpos($note, 
                                self::TEXT_MSG_INDICATOR) !== false)
                            {
                                $textYes = 1;
                            }
                            else
                            {
                                $textYes = 0;
                            }                                                       
                        }
                        else
                        {
                            $firstName = "";
                            $lastName  = "";
                            $email     = "";
                            $phone     = "";
                            $textYes    = "";
                        }                        

                        $liftData                   = array();                          
                        $liftData['id']             = $liftId;                
                        $liftData['orderId']        = $orderId;                
                        $liftData['confNum']        = $confNum;                
                        $liftData['contribution']   = $lift->contribution;                
                        $liftData['firstName']      = $firstName;                
                        $liftData['lastName']       = $lastName;                
                        $liftData['email']          = $email;                
                        $liftData['phone']          = $phone;                
                        $liftData['textYes']        = $textYes;                
                        $liftData['startType']      = $lift->startType;                
                        $liftData['status']         = $lift->status;                
                        $liftData['start']          = $lift->start;                
                        $liftData['to']             = $lift->to;                
                        $liftData['dt']             = $lift->dt;                
                        $liftData['seats']          = $lift->seats;
                        $liftData['smoker']         = $lift->smoker;
                        $liftData['bags']           = $lift->bags;
                        $liftData['bagSize']        = $lift->bagSize;
                        $liftData['note']           = $lift->note;
                        
                        array_push($liftsData, $liftData);
                        
                        $liftStream   = $liftId . ";" . $orderId . ";" . 
                                        $confNum . ";" . $contribution . ";" . 
                                        $firstName . ";" . $lastName . ";" . 
                                        $email . ";" . $phone . ";" .
                                        $textYes . ";" . 
                                        $lift->startType . ";" . 
                                        $lift->status . ";" .
                                        $lift->start . ";" .
                                        $lift->to . ";" .  
                                        $lift->dt . ";" . 
                                        $lift->seats . ";" . 
                                        $lift->smoker . ";" . 
                                        $lift->bags . ";" . 
                                        $lift->bagSize . ";" . 
                                        $lift->note; 
                        $liftsStream .= ($liftsStream == '') ? 
                                        $liftStream : 
                                        '|' . $liftStream;                                        
                    } 
                }
                $liftsStreamList[$ride->id] = $liftsStream;
                $matchedRide['lifts']       = $liftsData;                
                array_push($matchedRides, $matchedRide);                
            }
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $jResult['rides']   = $matchedRides;
                $result = json_encode($jResult);
            }
            else
            {
                foreach ($matchedRides AS $matchedRide)
                {
                    $resultItem      = "<id>" . 
                                       $matchedRide['id'] . 
                                       "</id>";
                    $resultItem     .= "<ownerId>" . 
                                       $matchedRide['ownerId'] . 
                                       "</ownerId>";
                    $resultItem     .= "<customerId>" . 
                                       $matchedRide['customerId'] . 
                                       "</customerId>";
                    $resultItem     .= "<entityId>" . 
                                       $matchedRide['entityId'] . 
                                       "</entityId>";
                    $resultItem     .= "<locationId>" . 
                                       $matchedRide['locationId'] . 
                                       "</locationId>";
                    $resultItem     .= "<editable>" . 
                                       $matchedRide['editable'] . 
                                       "</editable>";
                    $resultItem     .= "<status>" . 
                                       $matchedRide['status'] . 
                                       "</status>";
                    $resultItem     .= "<startType>" . 
                                       $matchedRide['startType'] . 
                                       "</startType>";
                    $resultItem     .= "<contribution>" . 
                                       $matchedRide['contribution'] . 
                                       "</contribution>";
                    $resultItem     .= "<dt>" . $matchedRide['dt'] . "</dt>";
                    $resultItem     .= "<start>" . 
                                       $matchedRide['start'] . 
                                       "</start>";
                    $resultItem     .= "<to>" . 
                                       $matchedRide['to'] . 
                                       "</to>";
                    $resultItem     .= "<via>" . 
                                       $matchedRide['via'] . 
                                       "</via>";
                    $resultItem     .= "<maxMiles>" . 
                                       $matchedRide['maxMiles'] . 
                                       "</maxMiles>";
                    $resultItem     .= "<seats>" . 
                                       $matchedRide['seats'] . 
                                       "</seats>";
                    $resultItem     .= "<smoker>" . 
                                       $matchedRide['smoker'] . 
                                       "</smoker>";
                    $resultItem     .= "<bags>" . 
                                       $matchedRide['bags'] . 
                                       "</bags>";
                    $resultItem     .= "<bagSize>" . 
                                       $matchedRide['bagSize'] . 
                                       "</bagSize>";
                    $resultItem     .= "<note>" . 
                                       $matchedRide['note'] . 
                                       "</note>";
                    $rideId          = $matchedRide['id'];
                    if (isset($liftsStreamList[$rideId]))
                    {
                        $liftsStream     = $liftsStreamList[$rideId];
                        $resultItem     .= "<liftsStream>" . 
                                           $liftsStream . 
                                           "</liftsStream>";
                    }                               
                    $result         .= "<returnVal>" . $resultItem . 
                                       "</returnVal>";
                }
                $result = "<returnVal><retCode>1</retCode></returnVal>" . 
                          $result;
                $result = '<response>' . $result . '</response>';   
            }
        }                                           
        else
        {
            $retCode = 0;
            $message = "no ride is found.";                
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = $message;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }            
        }
        return $result;                
    }     


    /**
    * @desc   - get the lift from the lift id 
    * @access - public
    * @param  - integer $liftId  : id of the lift
    * @return - string  $result  : lift information representing in json 
    *                              or in XML format 
    *                              retcode = 1
    *                              lift = {id, customerId, orderId, rideId, 
    *                                      locationId, confNum, contribution, 
    *                                      firstName, lastName, phone, email, 
    *                                      textYes, editable, startType, status, dt, 
    *                                      start, to, via, seats, smoker, 
    *                                      bags, bagSize, note, 
    *                                      driverFirstName, driverLastName, 
    *                                      driverPhone, driverEmail, 
    *                                      driverTextYes, driveDT, 
    *                                      driveSeats, driverBagSize, 
    *                                      driverNote}
    * 
    *                              retCode = 0                                 
    *                              message = no ride is found
    * 
    */
    public function getALift
    (
        $liftId
    )
    {
        $lift       = NULL;
        $retCode    = 1;
        $jResult    = array();
        $resultItem = "";
        $result     = "";
        
        $matchedLift = array();
        $liftCT      = new LiftCT();
        $rideCT      = new RideCT($liftCT->getDBLink());
        $ownerCT     = new OwnerCT($liftCT->getDBLink());
        $customerCT  = new CustomerCT($liftCT->getDBLink());
        
        if ($liftId != "" || 
            $liftId != NO_ID)
        {
            $lift = $liftCT->get($liftId);
            if (isEmpty($lift))
            {
                $retCode = 0;
            }
            else
            {
                $matchedLift['id']           = $lift->id;
                $matchedLift['customerId']   = $lift->customerId;
                $matchedLift['orderId']      = $lift->orderId;
                $matchedLift['rideId']       = $lift->rideId;
                $matchedLift['locationId']   = $lift->locationId;
                $matchedLift['confNum']      = $lift->confNum;
                $matchedLift['contribution'] = $lift->contribution;
                $matchedLift['startType']    = $lift->startType;
                $matchedLift['dt']           = $lift->dt;
                $matchedLift['start']        = $lift->start;
                $matchedLift['to']           = $lift->to;
                $matchedLift['via']          = $lift->via;
                $matchedLift['maxMiles']     = $lift->maxMiles;
                $matchedLift['seats']        = $lift->seats;
                $matchedLift['smoker']       = $lift->smoker;
                $matchedLift['bags']         = $lift->bags;
                $matchedLift['bagSize']      = $lift->bagSize;
                $matchedLift['note']         = $lift->note;                
                
                $customerId  = $lift->customerId;
                if ($customerId == NO_ID)
                {
                    $matchedLift['firstName']   = "";
                    $matchedLift['lastName']    = "";
                    $matchedLift['phone']       = "";
                    $matchedLift['email']       = "";
                    $matchedLift['textYes']     = "";
                }
                else
                {
                    $customer = $customerCT->get($customerId);
                    $matchedLift['firstName']   = $customer->firstName;
                    $matchedLift['lastName']    = $customer->lastName;
                    $matchedLift['phone']       = $customer->phone1;
                    $matchedLift['email']       = $customer->email;
                    $note                       = $customer->note;
                    if (strpos($note, self::TEXT_MSG_INDICATOR) !== false)
                    {
                        $matchedLift['textYes'] = 1;
                    }
                    else
                    {
                        $matchedLift['textYes'] = 0;
                    }
                }
                
                $editable = 0;
                $status = $lift->status;
                if ($status == LiftVO::NEW_LIFT)
                {
                    $editable = 1;
                }
                
                $matchedLift['editable']     = $editable;
                $matchedLift['status']       = $lift->status;
                                                
                if ($lift->rideId == NO_ID) 
                {
                    $matchedLift['driverFirstName']   = "";
                    $matchedLift['driverLastName']    = "";
                    $matchedLift['driverPhone']       = "";
                    $matchedLift['driverEmail']       = "";
                    $matchedLift['driverTextYes']     = "";
                    $matchedLift['driverDT']          = "";
                    $matchedLift['driverSeats']       = "";
                    $matchedLift['driverBagSize']     = "";
                    $matchedLift['driverNote']        = "";
                }
                else 
                {
                    $customerId = NO_ID;
                    $rideId     = $matchedLift['rideId'];
                    $ride       = $rideCT->get($rideId);
                    if ($ride->ownerId != NO_ID) 
                    {
                        $owner   = $ownerCT->get($ride->ownerId);
                        $customerId = $owner->customerId;
                    }
                    
                    if ($customerId != NO_ID)
                    {
                        $customer  = $customerCT->get($customerId);
                        $matchedLift['driverFirstName'] = $customer->firstName;
                        $matchedLift['driverLastName']  = $customer->lastName;
                        $matchedLift['driverPhone']     = $customer->phone1;
                        $matchedLift['driverEmail']     = $customer->email;
                        $note                           = $customer->note;
                        if (strpos($note, self::TEXT_MSG_INDICATOR) !== false)
                        {
                            $matchedLift['driverTextYes'] = 1;
                        }
                        else
                        {
                            $matchedLift['driverTextYes'] = 0;
                        }
                        $matchedLift['driverDT']        = $ride->dt;
                        $matchedLift['driverSeats']     = $ride->seats;
                        $matchedLift['driverBagSize']   = $ride->bagSize;
                        $matchedLift['driverNote']      = $ride->note;
                    }
                    else
                    {
                        $matchedLift['driverFirstName']   = "";
                        $matchedLift['driverLastName']    = "";
                        $matchedLift['driverPhone']       = "";
                        $matchedLift['driverEmail']       = "";
                        $matchedLift['driverTextYes']     = "";
                        $matchedLift['driverDT']          = "";
                        $matchedLift['driverSeats']       = "";
                        $matchedLift['driverBagSize']     = "";
                        $matchedLift['driverNote']        = "";
                    }
                }
            }
        }
        else
        {
            $retCode = 0;
        }
        
        if ($retCode == 1)
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $jResult['lift']    = $matchedLift;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<id>" . 
                                   $matchedLift['id'] . 
                                   "</id>";
                $resultItem     .= "<customerId>" . 
                                   $matchedLift['customerId'] . 
                                   "</customerId>";
                $resultItem     .= "<rideId>" . 
                                   $matchedLift['rideId'] . 
                                   "</rideId>";
                $resultItem     .= "<locationId>" . 
                                   $matchedLift['locationId'] . 
                                   "</locationId>";
                $resultItem     .= "<confNum>" . 
                                   $matchedLift['confNum'] . 
                                   "</confNum>";
                $resultItem     .= "<firstName>" . 
                                   $matchedLift['firstName'] . 
                                   "</firstName>";
                $resultItem     .= "<lastName>" . 
                                   $matchedLift['lastName'] . 
                                   "</lastName>";
                $resultItem     .= "<phone>" . 
                                   $matchedLift['phone'] . 
                                   "</phone>";
                $resultItem     .= "<email>" . 
                                   $matchedLift['email'] . 
                                   "</email>";
                $resultItem     .= "<textYes>" . 
                                   $matchedLift['textYes'] . 
                                   "</textYes>";
                $resultItem     .= "<editable>" . 
                                   $matchedLift['editable'] . 
                                   "</editable>";
                $resultItem     .= "<startType>" . 
                                   $matchedLift['startType'] . 
                                   "</startType>";
                $resultItem     .= "<status>" . 
                                   $matchedLift['status'] . 
                                   "</status>";
                $resultItem     .= "<dt>" . 
                                   $matchedLift['dt'] . 
                                   "</dt>";
                $resultItem     .= "<start>" . 
                                   $matchedLift['start'] . 
                                   "</start>";
                $resultItem     .= "<to>" . 
                                   $matchedLift['to'] . 
                                   "</to>";
                $resultItem     .= "<via>" . 
                                   $matchedLift['via'] . 
                                   "</via>";
                $resultItem     .= "<seats>" . 
                                   $matchedLift['seats'] . 
                                   "</seats>";
                $resultItem     .= "<smoker>" . 
                                   $matchedLift['smoker'] . 
                                   "</smoker>";
                $resultItem     .= "<bags>" . 
                                   $matchedLift['bags'] . 
                                   "</bags>";
                $resultItem     .= "<bagSizes>" . 
                                   $matchedLift['bagSizes'] . 
                                   "</bagSizes>";
                $resultItem     .= "<note>" . 
                                   $matchedLift['note'] . 
                                   "</note>";
                $resultItem     .= "<driverFirstName>" . 
                                   $matchedLift['driverFirstName'] . 
                                   "</driverFirstName>";
                $resultItem     .= "<driverLastName>" . 
                                   $matchedLift['driverLastName'] . 
                                   "</driverLastName>";
                $resultItem     .= "<driverPhone>" . 
                                   $matchedLift['driverPhone'] . 
                                   "</driverPhone>";                               
                $resultItem     .= "<driverEmail>" . 
                                   $matchedLift['driverEmail'] . 
                                   "</driverEmail>";
                $resultItem     .= "<driverTextYes>" . 
                                   $matchedLift['driverTextYes'] . 
                                   "</driverTextYes>";

                $resultItem     .= "<driverDT>" . 
                                   $matchedLift['driverDT'] . 
                                   "</driverDT>";
                $resultItem     .= "<driverSeats>" . 
                                   $matchedLift['driverSeats'] . 
                                   "</driverSeats>";
                $resultItem     .= "<driverEmail>" . 
                                   $matchedLift['driverEmail'] . 
                                   "</driverEmail>";
                $resultItem     .= "<driverEmail>" . 
                                   $matchedLift['driverEmail'] . 
                                   "</driverEmail>";
                $resultItem     .= "<driverDT>" . 
                                   $matchedLift['driverDT'] . 
                                   "</driverDT>";
                $resultItem     .= "<driverSeats>" . 
                                   $matchedLift['driverSeats'] . 
                                   "</driverSeats>";
                $resultItem     .= "<driverBagSize>" . 
                                   $matchedLift['driverBagSize'] . 
                                   "</driverBagSize>";
                $resultItem     .= "<driverNote>" . 
                                   $matchedLift['driverNote'] . 
                                   "</driverNote>";
                $result         .= "<returnVal>" . $resultItem . 
                                   "</returnVal>";
                $result          = "<returnVal><retCode>1</retCode></returnVal>" . 
                                    $result;                
                $result          = '<response>' . $result . '</response>';               
            }
        }
        else
        {
            $retCode = 0;
            $message = "no lift is found.";                
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = $message;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }                        
        }
        return $result;
    } 
    
    
    /**
    * @desc   - delete a lift  
    * @access - public
    * @param  - integer  $liftId : the id of the lift 
    * @return - string   $result : XML result of the lift
    *                            1 means the lift was deleted
    *                            0 means the lift did not get deleted
    */
    public function deleteALift
    (
        $liftId
    )
    {
        $retCode = 1;
        $jResult = array();
        $resultItem = "";
        $result  = "";
        
        $liftCT = new LiftCT();
        $delRet = $liftCT->delete($liftId);
       
        if ($delRet = "")
        {
            $retCode = 0;
        } 
        
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = "Deleting lift has failed";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>Deleting lift has " . 
                                   "failed</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>'  . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    } 

 
    /**
    * @desc   - reject a lift 
    * @access - public
    * @param  - integer $liftId : the id of the lift that is erjected by 
    *                             the driver
    * @return - string  $result : XML result of the ride
    *                            1 means the lift was rejected
    *                            0 means the lift did not get rejected
    */
    public function rejectALift
    (
        $liftId
    )
    {
        $retCode = 1;
        $jResult = array();
        $resultItem = "";
        $result  = "";
        
        // the reject processing happens from lift,
        // no change to the ride is necessary.
        $liftCT = new LiftCT();
        $retCode = $liftCT->reject($liftId);
       
        
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = "Rejecting ride has failed";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>Rejecting ride has failed</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>'  . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    } 

 
    /**
    * @desc   - post a lift  
    * @access - public
    * @param  - array  $lift  : the associative array containing data 
    *                           to add a lift.  
    *                           See LiftVO for explanation for each field
    *                           date must have mm/dd/yyyy format
    *                           time must have hh:mm:ss format
    *                           liftDat = {customerId, date, time,    
    *                                      startType, start, to, via, 
    *                                      maxMiles, seats, smoker,
    *                                      bags, bagSize, note} 
    * @return - string $result : XML result of id of the ride
    *                            1 means the lift was posted
    *                            0 means the lift did not get posted
    */
    public function postALift
    (
        $lift
    )
    {
        $retCode = 1;
        $jResult = array();
        $resultItem = "";
        $result  = "";
        
        $liftCT      = new LiftCT();
        $locationCT = new LocationCT($liftCT->getDBLink());        

        $startType = isset($lift['startType']) ? 
                     $lift['startType'] : 
                     LiftVO::AIRPORT_START;

        if ($startType == LiftVO::AIRPORT_START)
        {
            $locations  = $locationCT->byName($lift['start']);
        }
        else
        {
            $locations  = $locationCT->byName($lift['to']);
        }
        
        if (!isEmpty($locations))
        {
            $location = $locations[0];
            $locationId = $location->id;
        }
        else
        {
            $retCode = -1;
            $locationId = NO_ID;
        }

        if ($retCode == 1)
        {
            $customerId  = isset($lift['customerId']) ? 
                           $lift['customerId'] : NO_ID;
            $status      = LiftVO::NEW_LIFT;                     
            $date        = isset($lift['date']) ? 
                           $lift['date'] : Date::getCurrentDateInUSAFormat();
            $time        = isset($lift['time']) ?
                           $lift['time'] : Date::getCurrentTimeInUSAFormat();
            $dt = $date . " " . $time;              

            if ($startType == LiftVO::AIRPORT_START)
            {
                $address  = $lift['to'];
            }
            else
            {
                $address  = $lift['start'];
            }
            
            $prepAddr = str_replace(' ','+', $address);
            $geocode  = file_get_contents(
                          'http://maps.google.com/maps/api' . 
                          '/geocode/json?address='.
                          $prepAddr.
                          '&sensor=false');
            $output= json_decode($geocode);
            $latitude = $output->results[0]->geometry->location->lat;
            $longitude = $output->results[0]->geometry->location->lng;        

            $to        = isset($lift['to']) ?
                         $lift['to'] : "";
            $start     = isset($lift['start']) ?
                         $lift['start'] : "";
            $via       = isset($lift['via']) ?
                         $lift['via'] : "";
            $maxMiles  = isset($lift['maxMiles']) ?
                         $lift['maxMiles'] : "";
            $seats     = isset($lift['seats']) ?
                         $lift['seats'] : "";
            $smoker    = isset($lift['smoker']) ?
                         $lift['smoker'] : FALSE;
            $bags      = (isset($lift['bags']) && $lift['bags']) ?
                         $lift['bags'] : 0;
            $bagSize   = isset($lift['bagSize']) ?
                         $lift['bagSize'] : "";
            $note      = isset($lift['note']) ?
                         $lift['note'] : "";

            // $orderId, $confNum and $contribution are set during matched 
            // ride process             
            $orderId      = NO_ID;
            $confNum      = "";       
            $contribution = "";      
            $lift = new LiftVO(NO_ID, $customerId, $orderId, NO_ID, $locationId, 
                               $confNum, $contribution, $startType, $status, 
                               $dt, $longitude, $latitude, $start, $to, $via, 
                               $maxMiles, $seats, $smoker, $bags, $bagSize, 
                               $note);
            $liftCT->add($lift);
        }
        
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $jResult['liftId']  = $lift->id;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem .= "<liftId>" . $lift->id . "</liftId>"; 
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                if ($retCode == -1)
                {
                    $jResult['retCode']   = $retCode;
                    $jResult['errorMsg']  = "No location is found";
                }
                else
                {
                    $jResult['retCode']   = 0;
                    $jResult['errorMsg']  = "Adding lift has failed";                    
                }
                $result = json_encode($jResult);
            }
            else
            {
                if ($retCode == -1)
                {
                    $resultItem      = "<retCode>-1</retCode>";
                    $resultItem     .= "<errorMsg>No location is " . 
                                       "found</errorMsg>";                        
                }
                else
                {
                    $resultItem      = "<retCode>0</retCode>";
                    $resultItem     .= "<errorMsg>Adding lift has failed" . 
                                       "</errorMsg>";                        
                }
                $resultItem      = "<returnVal>" . $resultItem . 
                                   "</returnVal>";
                $result          = '<response>' . $resultItem . 
                                   '</response>';   
            }
        }                
        return ($result);        
    }     

    
    /**
    * @desc   - post auto lift  
    * @access - public
    * @param  - array  $lift  : the associative array containing data 
    *                           to add a lift.  If liftId is set, copy
    *                           existing lift and create new one. 
    *                           See LiftVO for explanation for each field
    *                           date must have mm/dd/yyyy format
    *                           time must have hh:mm:ss format
    *                           liftDat = {customerId, contribution, date, time,    
    *                                      startType, start, to, via, 
    *                                      maxMiles, seats, smoker,
    *                                      bags, bagSize, note} 
    * @return - string $result : XML result of id of the ride
    *                            1 means the lift was automatically created
    *                              if there is no lift or the lift has no 
    *                              new status where the lift should be 
    *                              duplicated and created
    *                            2 means the lift was aleady created and had
    *                              a new status, no need to add another one
    *                           -1 adding lift has failed because of no location
    *                            0 means the add has failed
    */
    public function postAutoLift
    (
        $lift
    )
    {
        $retCode = 1;
        $jResult = array();
        $resultItem = "";
        $result  = "";
        
        $liftCT      = new LiftCT();
        $locationCT = new LocationCT($liftCT->getDBLink());        

        $id = $lift['id'];
        if ($id != NO_ID)
        {
            $liftObj = $liftCT->get($id);
            if ($liftObj->status != LiftVO::NEW_LIFT)
            {
                // the contribution has been passed since the user
                // selected a ride
                $contribution          = isset($lift['contribution']) ?
                                         $lift['contribution'] : 
                                         $liftObj->contribution;
                $lift['id']            = NO_ID;
                $lift['customerId']    = $liftObj->customerId;
                $lift['contribution']  = $liftObj->customerId;
                $lift['orderId']       = NO_ID;
                $lift['confNum']       = "";
                $lift['contribution']  = $contribution;
                $lift['status']        = LiftVO::NEW_LIFT;                     
                $lift['date']          = Date::getDate($liftObj->dt);
                $lift['time']          = Date::getTime($liftObj->dt);
                $lift['startType']     = $liftObj->startType; 
                $lift['start']         = $liftObj->start; 
                $lift['to']            = $liftObj->to; 
                $lift['via']           = $liftObj->via; 
                $lift['maxMiles']      = $liftObj->maxMiles; 
                $lift['seats']         = $liftObj->seats; 
                $lift['smoker']        = $liftObj->smoker; 
                $lift['bags']          = $liftObj->bags; 
                $lift['bagSize']       = $liftObj->bagSize; 
                $lift['note']          = $liftObj->note; 
            }
            else
            {
                $retCode = 2;
                
                // if there is a contribution, update it
                if (isset($lift['contribution']))
                {
                    $contribution = $lift['contribution'];
                    $liftObj->contribution = $contribution;
                    $liftCT->update($liftObj);
                }
                
                // get the lift object and use this lift because
                // the lift is a new status
                $lift    = $liftObj; 
            }
        }
        
        if ($retCode == 1)
        {

            $startType = isset($lift['startType']) ? 
                         $lift['startType'] : 
                         LiftVO::AIRPORT_START;

            if ($startType == LiftVO::AIRPORT_START)
            {
                $locations  = $locationCT->byName($lift['start']);
            }
            else
            {
                $locations  = $locationCT->byName($lift['to']);
            }
            
            if (!isEmpty($locations))
            {
                $location = $locations[0];
                $locationId = $location->id;
            }
            else
            {
                $retCode = -1;
                $locationId = NO_ID;
            }

            $customerId    = isset($lift['customerId']) ? 
                             $lift['customerId'] : NO_ID;
            $orderId       = isset($lift['orderId']) ? 
                             $lift['orderId'] : NO_ID;
            $confNum       = isset($lift['confNum']) ? 
                             $lift['confNum'] : "";               
            $contribution  = isset($lift['contribution']) ? 
                             $lift['contribution'] : "";               
            $status        = LiftVO::PENDING_CONFIRM;                     
            $date          = isset($lift['date']) ? 
                             $lift['date'] : Date::getCurrentDateInUSAFormat();
            $time          = isset($lift['time']) ?
                             $lift['time'] : Date::getCurrentTimeInUSAFormat();
            $dt            = $date . " " . $time;              

            if ($startType == LiftVO::AIRPORT_START)
            {
                $address  = $lift['to'];
            }
            else
            {
                $address  = $lift['start'];
            }
            
            $prepAddr = str_replace(' ','+', $address);
            $geocode  = file_get_contents(
                          'http://maps.google.com/maps/api' . 
                          '/geocode/json?address='.
                          $prepAddr.
                          '&sensor=false');
            $output= json_decode($geocode);
            $latitude = $output->results[0]->geometry->location->lat;
            $longitude = $output->results[0]->geometry->location->lng;        

            $to        = isset($lift['to']) ?
                         $lift['to'] : "";
            $start     = isset($lift['start']) ?
                         $lift['start'] : "";
            $via       = isset($lift['via']) ?
                         $lift['via'] : "";
            $maxMiles  = isset($lift['maxMiles']) ?
                         $lift['maxMiles'] : "";
            $seats     = isset($lift['seats']) ?
                         $lift['seats'] : "";
            $smoker    = isset($lift['smoker']) ?
                         $lift['smoker'] : FALSE;
            $bags      = isset($lift['bags']) ?
                         $lift['bags'] : 0;
            $bagSize   = isset($lift['bagSize']) ?
                         $lift['bagSize'] : "";
            $note      = isset($lift['note']) ?
                         $lift['note'] : "";

            $lift = new LiftVO(NO_ID, $customerId, $orderId, NO_ID, $locationId, 
                               $confNum, $contribution, $startType, $status, 
                               $dt, $longitude, $latitude, $start, $to, $via, 
                               $maxMiles, $seats, $smoker, 
                               $bags, $bagSize, $note);
            $liftCT->add($lift);
        }
        
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $jResult['liftId']  = $lift->id;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem .= "<liftId>" . $lift->id . "</liftId>"; 
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else if ($retCode == 2)
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 2;
                $jResult['liftId']  = $lift->id;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>2</retCode>";
                $resultItem .= "<liftId>" . $lift->id . "</liftId>"; 
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                if ($retCode == -1)
                {
                    $jResult['retCode']   = $retCode;
                    $jResult['errorMsg']  = "No location is found";
                }
                else
                {
                    $jResult['retCode']   = $retCode;
                    $jResult['errorMsg']  = "Adding lift has failed";                    
                }
                $result = json_encode($jResult);
            }
            else
            {
                if ($retCode == -1)
                {
                    $resultItem      = "<retCode>-1</retCode>";
                    $resultItem     .= "<errorMsg>No location is " . 
                                       "found</errorMsg>";                        
                }
                else
                {
                    $resultItem      = "<retCode>0</retCode>";
                    $resultItem     .= "<errorMsg>Adding lift has failed" . 
                                       "</errorMsg>";                        
                }
                $resultItem      = "<returnVal>" . $resultItem . 
                                   "</returnVal>";
                $result          = '<response>' . $resultItem . 
                                   '</response>';   
            }
        }                
        return ($result);        
    }     

    
    /**
    * @desc   - update a lift  
    * @access - public
    * @param  - array  $lift  : the associative array containing data 
    *                           to update a lift.  
    *                           See LiftVO for explanation for each field
    *                           date must have mm/dd/yyyy format
    *                           time must have hh:mm:ss format
    *                           liftDat = {customerId, orderId, 
    *                                      confNum, contribution, startType, 
    *                                      date, status,  
    *                                      time, start, to, via, 
    *                                      maxMiles, seats, smoker,
    *                                      bags, bagSize, note} 
    * @return - string $result : XML result of id of the ride
    *                             1 means the lift was posted
    *                            -1 means no location was found
    *                            -2 means no lift was found
    *                             0 means the lift did not get posted
    */ 
    public function updateALift
    (
        $lift
    )
    {
        $retCode = 1;
        $jResult = array();
        $resultItem = "";
        $result  = "";
        
        $liftCT      = new LiftCT();
        $locationCT  = new LocationCT($liftCT->getDBLink());        

        $id = isset($lift['id']) ? 
              $lift['id'] : NO_ID;
         
        if ($id == NO_ID)
        {
            $retCode = -2;
        }
        else
        {
            $theLift = $liftCT->get($id);                               
                           
            $startType = isset($lift['startType']) ? 
                         $lift['startType'] : 
                         $theLift->startType;


            $start    = isset($lift['start']) ? 
                           $lift['start'] : $theLift->start;
                         
            $to       = isset($lift['to']) ? 
                           $lift['to'] : $theLift->start;
                         
            if ($startType == LiftVO::AIRPORT_START)
            {
                $locations  = $locationCT->byName($lift['start']);
            }
            else
            {
                $locations  = $locationCT->byName($lift['to']);
            }

            if (!isEmpty($locations))
            {
                $location = $locations[0];
                $locationId = $location->id;
            }
            else
            {
                $retCode    = -1;
                $locationId = NO_ID;
            }
        }

        if ($retCode == 1)
        {
            $customerId   = isset($lift['customerId']) ? 
                            $lift['customerId'] : $theLift->customerId;
            $orderId      = isset($lift['orderId']) ? 
                            $lift['orderId'] : $theLift->orderId;
            $rideId       = isset($lift['rideId']) ? 
                            $lift['rideId'] : $theLift->rideId;
            $confNum      = isset($lift['confNum']) ? 
                            $lift['confNum'] : $theLift->confNum;
            $contribution = isset($lift['contribution']) ? 
                            $lift['contribution'] : $theLift->contribution;
            $status       = isset($lift['status']) ? $lift['status'] : 
                            $theLift->status;                     
            $date         = isset($lift['date']) ? 
                            $lift['date'] : "";
            $time         = isset($lift['time']) ?
                            $lift['time'] : "";
            if ($date != "" && 
                $time != "")
            {
                $dt = $date . " " . $time;              
            }               
            else
            {
                $dt = $theLift->dt;
            }

            if ($startType == RideVO::AIRPORT_START)
            {
                $address  = $to;
            }
            else
            {
                $address  = $start;
            }

            $prepAddr = str_replace(' ','+', $address);
            $geocode  = file_get_contents(
                          'http://maps.google.com/maps/api/geocode/json?address='.
                          $prepAddr.
                          '&sensor=false');
            $output= json_decode($geocode);
            $latitude = $output->results[0]->geometry->location->lat;
            $longitude = $output->results[0]->geometry->location->lng;        

//            $start     = isset($lift['start']) ?
//                         $lift['start'] : $theLift->start;
//            $to        = isset($lift['to']) ?
//                         $lift['to'] : $theLift->to;
            $via       = isset($lift['via']) ?
                         $lift['via'] : $theLift->via;
            $seats     = isset($lift['seats']) ?
                         $lift['seats'] : $theLift->seats;
            $bags      = isset($lift['bags']) ?
                         $lift['bags'] : $theLift->bags;
            $smoker    = isset($lift['smoker']) ?
                         $lift['smoker'] : $theLift->smoker;
            $bagSize  = isset($lift['bagSize']) ?
                         $lift['bagSize'] : $theLift->bagSize;
            $maxMiles  = isset($lift['maxMiles']) ?
                         $lift['maxMiles'] : $theLift->maxMiles;
            $note      = isset($lift['note']) ?
                         $lift['note'] : $theLift->note;

            $lift = new LiftVO($id, $customerId, $orderId, $rideId, $locationId, 
                               $confNum, $contribution, $startType, $status, 
                               $dt, $longitude, $latitude, $start, $to, $via, 
                               $maxMiles, $seats, $smoker, $bags, $bagSize, $note);
            $liftCT->update($lift);        
        }

        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = $retCode;
                $jResult['liftId']  = $lift->id;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem .= "<liftId>" . $lift->id . "</liftId>"; 
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($retCode == -1)
            {
                $message = "No location is found";
            }
            else if ($retCode == -2)
            {
                $message = "No lift is found";    
            }
            
            if ($this->isJSONDecode())
            {
                if ($retCode == -1 || $retCode == -2)
                {
                    $jResult['retCode']   = $retCode;                    
                    $jResult['errorMsg']  = $message;
                }
                else
                {
                    $jResult['retCode']   = 0;
                    $jResult['errorMsg']  = "Updating lift has failed";                    
                }
                $result = json_encode($jResult);
            }
            else
            {
                if ($retCode == -1)
                {
                    $resultItem      = "<retCode>" . $retCode . "</retCode>";
                    $resultItem     .= "<errorMsg>" . $message .  
                                       "</errorMsg>";                        
                }
                else
                {
                    $resultItem      = "<retCode>0</retCode>";
                    $resultItem     .= "<errorMsg>Updating lift has failed" . 
                                       "</errorMsg>";                        
                }
                $resultItem      = "<returnVal>" . $resultItem . 
                                   "</returnVal>";
                $result          = '<response>' . $resultItem . 
                                   '</response>';   
            }
        }                
        return ($result);        
    } 


    /**
    * @desc   - set a lift status to pending confirm  
    * @access - public
    * @param  - integer  $liftId  : id of the lift 
    * @return - string   $result  : return code in JSON or XML  
    *                               1 means the lift was confirmed
    *                               0 means the lift was not confirmed
    */
    public function pendingConfirmALift
    (
        $liftId
    )
    {
        $retCode = 1;
        $jResult = array();
        $resultItem = "";
        $result  = "";
        
        $liftCT      = new LiftCT();
        $lift        = $liftCT->get($liftId);
        $lift->pendingConfirm();
        $liftCT->update($lift);
        
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = "Lift pending confirmation has failed";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>Lift pending confirmation " . 
                                   "has failed" . 
                                   "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    } 


    /**
    * @desc   - confirm a lift status to pending payment and set the ride
    *           status to Full or Available. No status changes if no more
    *           seats ia available
    * @access - public
    * @param  - integer  $liftId  : id of the lift 
    * @return - string   $result  : return code in JSON or XML 
    *                               0 means the lift was not pending payment
    *                                 not enough seats
    *                               1 means the lift was pending payment 
    */
    public function pendingPaymentALift
    (
        $liftId
    )
    {
        $retCode = 1;
        $jResult = array();
        $resultItem = "";
        $result  = "";
        
        $rideCT   = new RideCT();
        $liftCT   = new LiftCT($rideCT->getDBLink());

        $lift     = $liftCT->get($liftId);
        $ride     = $rideCT->get($lift->rideId);
        
        if ($ride->seats >= $lift->seats)
        {
            $ride->seats = $ride->seats - $lift->seats;
            if ($ride->seats == 0)
            {
                $ride->status = RideVO::FULL;
            }
            $lift->pendingPayment();
            
            $rideCT->update($ride);
            $liftCT->update($lift);
        }
        else
        {
            $retCode = 0;    
        }
        
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = "Lift pending payment has failed:" .
                                        " not enough seats";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>Lift pending payment has " . 
                                   "failed: not enough seats</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    } 


    /**
    * @desc   - set the staatus to pending fullfilled waiting for the rider
    *           to enter the confirmation number.   
    * @access - public
    * @param  - integer  $liftId  : id of the lift 
    * @return - string   $result  : return code in JSON or XML 
    *                               0 means the lift was not pending fulfilled
    *                               1 means the lift was pending fulfilled 
    */
    public function pendingFulFilledALift
    (
        $liftId
    )
    {
        $retCode = 1;
        $jResult = array();
        $resultItem = "";
        $result  = "";
        
        $rideCT   = new RideCT();
        $liftCT   = new LiftCT($rideCT->getDBLink());

        $lift     = $liftCT->get($liftId);
        $ride     = $rideCT->get($lift->rideId);
        
        $lift->pendingFulFilled();        
        $liftCT->update($lift);
                
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = "Lift pending fulfilled has failed";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>Lift pending fulfilled has " . 
                                   "failed.</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    } 


    /**
    * @desc   - confirm a lift  
    * @access - public
    * @param  - integer  $liftId  : id of the lift 
    * @return - string   $result  : return code in XML or JSON
    *                               1 means the lift was confirmed
    *                               0 means the lift was not confirmed
    */
    public function confirmALift
    (
        $liftId
    )
    {
        $retCode = 1;
        $jResult = array();
        $resultItem = "";
        $result  = "";
        
        $liftCT      = new LiftCT();
        $lift        = $liftCT->get($liftId);
        $lift->confirm();
        $liftCT->update($lift);
        
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = "Lift confirmation has failed";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>Lift confirmation has failed" . 
                                   "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    } 


    /**
    * @desc   - update contribution 
    * @access - public
    * @param  - integer  $liftId        : id of the lift 
    * @param  - float    $contribution  : two decimal points 
    * @return - string   $result  : return code in XML or JSON
    *                               1 means the lift was updated
    *                               0 means the lift was not updated
    */
    public function updateContribution
    (
        $liftId,
        $contribution
    )
    {
        $retCode = 1;
        $jResult = array();
        $resultItem = "";
        $result  = "";
        
        $liftCT      = new LiftCT();
        $lift        = $liftCT->get($liftId);
        $lift->contribution = $contribution;
        $liftCT->update($lift);
        
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = "Updating lift contribution has failed";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>Updating lift contribution has failed" . 
                                   "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    } 


    /**
    * @desc   - gets the matching lifts based on the longitude, latitude
    *           of the address, date, time and maximum miles 
    * @access - public
    * @param  - integer $rideId    : ride Id
    * @param  - integer $startType : start type
    * @param  - string  $location  : location
    * @param  - string  $address   : address of the driver
    * @param  - string  $date      : request date for lift (mm/dd/yyyy)
    * @param  - string  $time      : request time for drive (hh:mm:ss)
    * @param  - integer $seats     : requested seats
    * @param  - boolean $smoker    : if the rider smokes
    * @param  - integer $bags      : bags
    * @param  - string  $bagSize   : requests bag size
    * @return - string  $result    : lift information representing in json 
    *                                   or in XML format 
    *                                   retcode = 1
    * 
    *                                   lift = {lId, customerId, startType,
    *                                           datetime, start, to, maxMiles,
    *                                           contribution, via, 
    *                                           seats, firstName, lastName,
    *                                           textYes}
    * 
    *                                retCode = 0                                 
    *                                message = no lift is found
    * 
    */
    public function getLifts
    (
        $rideId, 
        $startType,
        $location, 
        $address, 
        $date, 
        $time, 
        $seats,
        $smoker,
        $bags,
        $bagSize
    )
    {
        $liftCT = new LiftCT();
        $retCode       = 0;
        $jResult       = array();
        $resultItem    = "";
        $result        = "";
        
        $matchedLifts  = array();
        
        $sqlDate = Date::convertUSADateToMysql($date);

        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents(
            'http://maps.google.com/maps/api/geocode/json?address='.
            $prepAddr.
            '&sensor=false');
        $output= json_decode($geocode);
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;        
        
        $matchedLifts = $liftCT->getAvailableLifts($rideId, $startType, 
                                                   $location, $address, 
                                                   $longitude, 
                                                   $latitude, $sqlDate, $time, 
                                                   $seats, $smoker, $bags, 
                                                   $bagSize);
        if (!isEmpty($matchedLifts) && 
            count($matchedLifts) > 0) 
        {

            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $jResult['lifts']   = $matchedLifts;
                $result = json_encode($jResult);
            }
            else
            {
                foreach ($matchedLifts AS $matchedLift)
                {
                    $resultItem      = "<lId>" . 
                                       $matchedLift['lId'] . 
                                       "</lId>";
                    $resultItem     .= "<customerId>" . 
                                       $matchedLift['customerId'] . 
                                       "</customerId>";
                    $resultItem     .= "<startType>" . 
                                       $matchedLift['startType'] . 
                                       "</startType>";
                    $resultItem     .= "<datetime>" . 
                                       $matchedLift['datetime'] . 
                                       "</datetime>";
                    $resultItem     .= "<start>" . 
                                       $matchedLift['start'] . 
                                       "</start>";
                    $resultItem     .= "<to>" . 
                                       $matchedLift['to'] . 
                                       "</to>";
                    $resultItem     .= "<maxMiles>" . 
                                       $matchedLift['maxMiles'] . 
                                       "</maxMiles>";
                    $resultItem     .= "<contribution>" . 
                                       $matchedLift['contribution'] . 
                                       "</contribution>";
                    $resultItem     .= "<via>" . 
                                       $matchedLift['via'] . 
                                       "</via>";
                    $resultItem     .= "<seats>" . 
                                       $matchedLift['seats'] . 
                                       "</seats>";
                    $resultItem     .= "<smoker>" . 
                                       $matchedLift['smoker'] . 
                                       "</smoker>";
                    $resultItem     .= "<bags>" . 
                                       $matchedLift['bags'] . 
                                       "</bags>";
                    $resultItem     .= "<bagSize>" . 
                                       $matchedLift['bagSize'] . 
                                       "</bagSize>";
                    $resultItem     .= "<firstName>" . 
                                       $matchedLift['firstName'] . 
                                       "</firstName>";
                    $resultItem     .= "<lastName>" . 
                                       $matchedLift['lastName'] . 
                                       "</lastName>";
                    $note      = $matchedLift['note'];
                    if (strpos($note, self::TEXT_MSG_INDICATOR) !== false)
                    {
                        $resultItem     .= "<textYes>" . 1 . "</textYes>";
                    }
                    else
                    {
                        $resultItem     .= "<textYes>" . 0 . "</textYes>";
                    }
                    $result         .= "<returnVal>" . $resultItem . 
                                       "</returnVal>";
                }
                $result = "<returnVal><retCode>1</retCode></returnVal>" . 
                          $result;
                $result = '<response>' . $result . '</response>';   
            }
        }                                           
        else
        {
            $retCode = 0;
            $message = "no lift is found.";                
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = $message;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }            
        }
        return $result;                
    }     
    
    
    
    /**
    * @desc   - book a lift  
    * @access - public
    * @param  - integer $liftId : id of the lift
    * @param  - integer $rideId : id of the ride
    * @param  - integer $seats  : number of seats
    * @return - string $result  : 1 means the lift was booked
    *                             0 means the lift did not get booked, not
    *                               enough seats  
    */
    public function bookALift
    (
        $liftId,
        $rideId,
        $seats
    )
    {
        $retCode = 1;
        
        $liftCT = new LiftCT();
        $rideCT = new RideCT($liftCT->getDBLink());
        
        $lift = $liftCT->get($liftId);
        $ride = $rideCT->get($rideId);
        
        if ($ride->seats >= $seats)
        {
/*            $ride->seats = $ride->seats - $seats;
            if ($ride->seats == 0)
            {
                $ride->status = RideVO::FULL;
            }
*/            
            $lift->pendingConfirmDriver();
            $lift->rideId = $rideId;
//            $rideCT->update($ride);
            $liftCT->update($lift);
        }
        else
        {
            $retCode = 0;
        }

        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = "Not enough seat";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>Not enough seat</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    }
    
    
    /**
    * @desc   - add order id and number to lift  
    * @access - public
    * @param  - integer $orderId : id of the order for the lift
    * @param  - integer $liftId  : id of the lift
    * @return - string $result   : 1 means the lift was linked to the order
    *                              0 means the lift did not get linked to the 
    *                                order  
    */
    public function addOrderToLift
    (
        $orderId, 
        $liftId
    )
    {
        $retCode = 1;
        
        $orderCT = new OrderCT();
        $liftCT  = new LiftCT($orderCT->getDBLink());
        
        $order = $orderCT->get($orderId);
        $lift  = $liftCT->get($liftId);
        
        $lift->orderId = $orderId;
        $lift->confNum = $order->number;

        $liftCT->update($lift);
                 
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem  = "<retCode>1</retCode>";
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = 0;
                $jResult['errorMsg']  = "Order is not linked";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>0</retCode>";
                $resultItem     .= "<errorMsg>Order is not linked</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    }    
    
    
    /**
    * @desc   - lifts by customer 
    * @access - public
    * @param  - string  $customerId  : id of the customer
    * @return - string  $result      : ride information representing in json 
    *                                  or in XML format 
    *                                  retcode = 1
    *                                  lift = {id, customerId, rideId, 
    *                                          locationId, editable, startType, 
    *                                          status, dt, start, to, via, 
    *                                          seats, smoker, bags, bagSize, 
    *                                          note, rideStream}
    * 
    *                                  rideStream 
    *                                  the stream separated by ; for each value
    *                                  rideId;firstName;lastName;email;
    *                                  phone;textYes;customerId;dt;dt;seats;
    *                                  smoker;bags;bagSize;note
    *            
    *                                  retCode = 0                                 
    *                                  message = no lift is found
    * 
    */
    public function liftsByCustomer
    (
        $customerId 
    )
    {
        $liftCT        = new LiftCT();
        $rideCT        = new RideCT($liftCT->getDBLink());
        $ownerCT       = new OwnerCT($liftCT->getDBLink());
        $customerCT    = new CustomerCT($liftCT->getDBLink());

        $retCode       = 0;
        $jResult       = array();
        $resultItem    = "";
        $result        = "";
        
        $matchedLifts   = array();
        $rideStreamList = array();
                
        $lifts = $liftCT->liftsPerCustomer($customerId); 
        if (!isEmpty($lifts) && count($lifts) > 0) 
        {
            foreach ($lifts AS $lift)
            {
                $matchedLift   = array();
                $matchedLift['id']           = $lift['id'];
                $matchedLift['rideId']       = $lift['rideId'];                
                $matchedLift['customerId']   = $lift['customerId'];                
                $matchedLift['locationId']   = $lift['locationId'];

                $editable = 0;
                $status = $lift['status'];
                if ($status == LiftVO::NEW_LIFT)
                {
                    $editable = 1;
                }
                
                $matchedLift['editable']     = $editable;
                $matchedLift['startType']    = $lift['startType'];
                $matchedLift['status']       = $lift['status'];
                $matchedLift['dt']           = Date::convertMySqlToUSADateTime(
                                               $lift['dt']);
                $matchedLift['start']        = $lift['start'];
                $matchedLift['to']           = $lift['to'];
                $matchedLift['via']          = $lift['via'];
                $matchedLift['maxMiles']     = $lift['maxMiles'];
                $matchedLift['seats']        = $lift['seats'];
                $matchedLift['smoker']       = $lift['smoker'];
                $matchedLift['bags']         = $lift['bags'];
                $matchedLift['bagSize']      = $lift['bagSize'];
                $matchedLift['note']         = isset($lift['note']) ? 
                                               $lift['note'] : 
                                               "";
                // the ride id is not set, which is the same as NULL
                if (!isset($lift['rideId']))   
                {
                    $rideId    = NO_ID;
                    $firstName = "";
                    $lastName  = "";
                    $email     = "";
                    $phone     = "";
                    $textYes   = "";
                    $dt        = "";
                    $seats     = "";
                    $smoker    = FALSE;
                    $bags      = "";
                    $bagSize   = "";
                    $note      = "";
                }
                else
                {
                    $customerId = NO_ID;
                    $rideId     = $lift['rideId'];
                    $ride       = $rideCT->get($rideId);
                    if ($ride->ownerId != NO_ID) 
                    {
                        $owner   = $ownerCT->get($ride->ownerId);
                        $customerId = $owner->customerId;
                    }
                    
                    if ($customerId != NO_ID)
                    {
                        $customer  = $customerCT->get($customerId);
                        $firstName = $customer->firstName;
                        $lastName  = $customer->lastName;
                        $email     = $customer->email;
                        $phone     = $customer->phone1;
                        $note      = $customer->note;
                        if (strpos($note, self::TEXT_MSG_INDICATOR) !== false)
                        {
                            $textYes = 1;
                        }
                        else
                        {
                            $textYes = 0;
                        }                        
                    }
                    else
                    {
                        $firstName = "";
                        $lastName  = "";
                        $email     = "";
                        $phone     = "";
                        $textYes   = "";
                    }
                    $dt        = $ride->dt;
                    $seats     = $ride->seats;
                    $smoker    = $ride->smoker;                    
                    $bags      = $ride->bags;                    
                    $bagSize   = $ride->bagSize;                    
                    $note      = $ride->note;                    
                }
                
                $rideData    = array(); 
                $rideData['rideId']     = $rideId;
                $rideData['firstName']  = $firstName;
                $rideData['lastName']   = $lastName;
                $rideData['email']      = $email;                
                $rideData['phone']      = $phone;                
                $rideData['textYes']    = $textYes;                
                $rideData['customerId'] = $customerId;                
                $rideData['dt']         = $dt;                
                $rideData['seats']      = $seats;                
                $rideData['smoker']     = $smoker;                
                $rideData['bags']       = $bags;                
                $rideData['bagSize']    = $bagSize;                
                $rideData['note']       = $note;                

                $rideStream  = "";
                $rideStream .= $rideId . ";" . $firstName . ";" . 
                               $lastName . ";" . $email . ";" . $phone . ";" . 
                               $textYes . ";" . 
                               $customerId . ";" . $dt . ";" . $seats . ";" . 
                               $smoker . ";" . $bags . ";" . 
                               $bagSize . ";" . $note;
                              
                // set the stream and matchedLifts               
                $rideStreamList[$rideId] = $rideStream;
                $matchedLift['ride']     = $rideData;                
                array_push($matchedLifts, $matchedLift);                
            }
            if ($this->isJSONDecode())
            {
                $jResult['retCode'] = 1;
                $jResult['lifts']   = $matchedLifts;
                $result = json_encode($jResult);
            }
            else
            {
                foreach ($matchedLifts AS $matchedLift)
                {
                    $resultItem      = "<id>" . 
                                       $matchedLift['id'] . 
                                       "</id>";
                    $resultItem     .= "<customerId>" . 
                                       $matchedLift['customerId'] . 
                                       "</customerId>";
                    $resultItem     .= "<rideId>" . 
                                       $matchedLift['rideId'] . 
                                       "</rideId>";
                    $resultItem     .= "<locationId>" . 
                                       $matchedLift['locationId'] . 
                                       "</locationId>";
//                    $resultItem     .= "<rideStream>" . 
//                                       $matchedLift['rideStream'] . 
//                                       "</rideStream>";
                    $resultItem     .= "<editable>" . 
                                       $matchedLift['editable'] . 
                                       "</editable>";
                    $resultItem     .= "<startType>" . 
                                       $matchedLift['startType'] . 
                                       "</startType>";
                    $resultItem     .= "<status>" . 
                                       $matchedLift['status'] . 
                                       "</status>";
                    $resultItem     .= "<dt>" . $matchedLift['dt'] . "</dt>";
                    $resultItem     .= "<start>" . 
                                       $matchedLift['start'] . 
                                       "</start>";
                    $resultItem     .= "<to>" . 
                                       $matchedLift['to'] . 
                                       "</to>";
                    $resultItem     .= "<via>" . 
                                       $matchedLift['via'] . 
                                       "</via>";
                    $resultItem     .= "<seats>" . 
                                       $matchedLift['seats'] . 
                                       "</seats>";
                    $resultItem     .= "<smoker>" . 
                                       $matchedLift['smoker'] . 
                                       "</smoker>";
                    $resultItem     .= "<bags>" . 
                                       $matchedLift['bags'] . 
                                       "</bags>";
                    $resultItem     .= "<bagSize>" . 
                                       $matchedLift['bagSize'] . 
                                       "</bagSize>";
                    $resultItem     .= "<maxMiles>" . 
                                       $matchedLift['maxMiles'] . 
                                       "</maxMiles>";
                    $resultItem     .= "<note>" . 
                                       $matchedLift['note'] . 
                                       "</note>";
                    
                    // check if there is a matched ride                   
                    if (isset($matchedLift['rideId']) && 
                        $matchedLift['rideId'] != NO_ID)
                    {
                        $rideId          = $matchedLift['rideId'];                   
                        
                        if (isset($rideStreamList[$rideId]))
                        {
                            $resultItem     .= "<rideStream>" . 
                                               $rideStreamList[$rideId] . 
                                               "</rideStream>";
                        }
                    }                   
                    $result         .= "<returnVal>" . $resultItem . 
                                       "</returnVal>";
                }
                $result = "<returnVal><retCode>1</retCode></returnVal>" . 
                          $result;
                $result = '<response>' . $result . '</response>';   
            }
        }                                           
        else
        {
            $retCode = 0;
            $message = "no lift is found.";                
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = $message;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>" . $message . "</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }            
        }
        return $result;                
    }
    

    /**
    * @desc   - get the price for a ride based on a constant for 
    *           every miles.
    * @access - public
    * @param  - string  $airportName   : miles for the ride
    * @param  - string  $driverAddress : miles for the ride
    * @param  - integer $miles         : miles for the ride
    * @return - string  $result        : price information representing in json 
    *                                  or in XML format 
    *                                  retcode = 1
    *                                  maxPerRider   = get the maximum price 
    *                                                  per rider  
    *            
    *                                  retCode    = 0                                 
    *                                  errorMsg   = No price is calculated
    */
    public function getPriceForRide
    (
        $airportName,
        $driverAddress,
        $miles
    )
    {
        $retCode = 1;
        $jResult       = array();
        $resultItem    = "";
        $result        = "";
        
        $contributionCT = new ContributionCT();
        $maxPerRider = $contributionCT->calculateMaxPerRider($miles,
                                                             $airportName,
                                                             $driverAddress);                 
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode']       = $retCode;
                $jResult['maxPerRider']   = $maxPerRider;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem   = "<retCode>" . $retCode . "</retCode>";
                $resultItem  .= "<maxPerRider>" . $maxPerRider . 
                                "</maxPerRider>";
                $resultItem  = "<returnVal>" . $resultItem . "</returnVal>";
                $result      = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = "No max rider rate is available";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>No price is available</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    }
    

    /**
    * @desc   - get the sizes for bag 
    * @access - public
    * @param  - 
    * @return - string  $result      : bag sizes  in json or in XML format 
    *                                  retcode = 1
    *                                  {S|Small,M|Medium,L|Large}  
    *            
    *                                  retCode    = 0                                 
    *                                  errorMsg   = No bag size is listed
    */
    public function getBagSizes
    (
    )
    {
        $stream  = "";
        $retCode = 1;
        $jResult       = array();
        $resultItem    = "";
        $result        = "";
        
        $bagSizes = array();
        $bagSizes[self::SMALL_BAG_SIZE_CODE]  = self::SMALL_BAG_SIZE_LABEL; 
        $bagSizes[self::MEDIUM_BAG_SIZE_CODE] = self::MEDIUM_BAG_SIZE_LABEL; 
        $bagSizes[self::LARGE_BAG_SIZE_CODE]  = self::LARGE_BAG_SIZE_LABEL; 

        if (count($bagSizes) > 0)
        {
            foreach ($bagSizes AS $key => $value)
            {
                $stream .= ($stream == "") ? $key . "|" . $value :
                           ";" . $key . "|" . $value;                 
            }
        }
        else
        {
            $retCode = 0;
        }
                 
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode']  = $retCode;
                $jResult['bagSizes'] = $bagSizes;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem   = "<retCode>" . $retCode . "</retCode>";
                $resultItem  .= "<bagSizes>" . $stream . "</bagSizes>";
                $resultItem   = "<returnVal>" . $resultItem . "</returnVal>";
                $result       = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = "No bag sizes";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>No bag sizes</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    }
    
    
    /**
    * @desc   - get the number of seats 
    * @access - public
    * @param  - 
    * @return - string  $result      : seats  in json or in XML format 
    *                                  retcode = 1
    *                                  {1,2,3,4}  
    *            
    *                                  retCode    = 0                                 
    *                                  errorMsg   = No seat size
    */
    public function getSeats
    (
    )
    {
        $stream  = "";
        $retCode = 1;
        $jResult       = array();
        $resultItem    = "";
        $result        = "";
        
        $seats = array();
        $seats[self::ONE_SEAT]    = self::ONE_SEAT; 
        $seats[self::TWO_SEAT]    = self::TWO_SEAT; 
        $seats[self::THREE_SEAT]  = self::THREE_SEAT; 
        $seats[self::FOUR_SEAT]   = self::FOUR_SEAT; 

        if (count($seats) > 0)
        {
            foreach ($seats AS $key => $value)
            {
                $stream .= ($stream == "") ? $key :
                           ";" . $key;                 
            }
        }
        else
        {
            $retCode = 0;
        }
                 
        if ($retCode == 1)
        {        
            if ($this->isJSONDecode())
            {
                $jResult['retCode']  = $retCode;
                $jResult['seats']    = $seats;
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem   = "<retCode>" . $retCode . "</retCode>";
                $resultItem  .= "<seats>"   . $stream  . "</seats>";
                $resultItem   = "<returnVal>" . $resultItem . "</returnVal>";
                $result       = "<response>" . $resultItem . "</response>";
            }
        }
        else
        {
            if ($this->isJSONDecode())
            {
                $jResult['retCode']   = $retCode;
                $jResult['errorMsg']  = "No seats";
                $result = json_encode($jResult);
            }
            else
            {
                $resultItem      = "<retCode>" . $retCode . "</retCode>";
                $resultItem     .= "<errorMsg>No seats</errorMsg>";                        
                $resultItem      = "<returnVal>" . $resultItem . "</returnVal>";
                $result          = '<response>' . $resultItem . '</response>';   
            }
        }                
        return ($result);        
    }             
}