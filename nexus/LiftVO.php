<?php
/**
* @description  manages the ride requests
*  
* @copyright    CARRBO LLC. 2013. All rights reseverd.
*               Property of CARRBO. This file can not be used, 
*               altered, in any way without expressed writeen permission 
*               from CARRBO, LLC.
* @version		1.0
* @author 		Mehran Majidi
* @file  		VO.php
* 
* @revDate      
* @revAuthor    
* @revDesc                   
*/

require_once("VO.php");

class LiftVO extends VO
{
	//________________________ D A T A   M E M B E R S _________________________

    /**#@+
     * @desc   - Constants for lift start type
     *           AIRPORT : start the lift from airport,
     *           ADDRESS : start the lift from an address,
     * @access - public
     * @var    - int 
     */
    const AIRPORT_START = 0; 
    const ADDRESS_START = 1;
    /**#@-*/

    /**#@+
     * @desc   - Constants for status of lift
     *           NEW_LIFT                = new lift request,
     *           PENDING_CONFIRM         = waiting for rider confirmation, 
     *                                     rider has requested a ride
     *           PENDING_PAYMENT         = waiting for payment,
     *           PENDING_FULFILLED       = waiting to complete the ride
     *           FULFILLED               = paid for the ride
     *           PENDING_CONFIRM_DRIVER  = waiting to confirm the driver offer,
     *                                     status for rider to confirm the 
     *                                     driver offer
     * @access - public
     * @var    - int 
     */
    const NEW_LIFT               = 0; 
    const PENDING_CONFIRM        = 1;
    const PENDING_PAYMENT        = 2;
    const PENDING_FULFILLED      = 3;
    const FULFILLED              = 4; 
    const PENDING_CONFIRM_DRIVER = 5;
    /**#@-*/

    /**#@+
     * @desc   - Constants for bag size
     *           S,
     *           M,
     *           L 
     * @access - public
     * @var    - string 
     */
    const SMALL  = 'S'; 
    const MEDIUM = 'M';
    const LARGE  = 'L';
    /**#@-*/

    /**
    * @desc   - Primary Key ID
    * @access - public
    * @var    - integer
    */

    /**#@-*/


	/**
	* @desc   - Primary Key ID
	* @access - public
	* @var    - integer
	*/

    /**#@+
     * @desc   - Constants for default seat number
     *           1
     * @access - public
     * @var    - integer 
     */
    const DEFAULT_SEAT  = 1; 
    /**#@-*/

    /**
    * @desc   - Primary Key ID
    * @access - public
    * @var    - integer
    */
	public $id;
	
    /**
    * @desc   - customer id that has the lift
    * @access - public
    * @var    - integer 
    */
    public $customerId;

    /**
    * @desc   - order id that shows the order information
    * @access - public
    * @var    - integer 
    */
    public $orderId;

    /**
    * @desc   - ride id that shows the ride information
    * @access - public
    * @var    - integer 
    */
    public $rideId;

    /**
    * @desc   - location id
    * @access - public
    * @var    - integer 
    */
    public $locationId;

    /**
    * @desc   - confirmation number
    * @access - public
    * @var    - string 
    */
    public $confNum;

    /**
    * @desc   - contribution amount
    * @access - public
    * @var    - float (two decimal points) 
    */
    public $contribution;

    /**
    * @desc   - Where lift starts (airport or address)
    * @access - public
    * @var    - integer 
    */
    public $startType;
        
    /**
    * @desc   - status of the lift
    * @access - public
    * @var    - integer 
    */
    public $status;
        
    /**
    * @desc   - request date time of the lift
    * @access - public
    * @var    - string 
    */
    public $dt;

    /**
    * @desc   - longitude of the to address
    * @access - public
    * @var    - float 
    */
    public $longitude;
    
    /**
    * @desc   - latitude of the to addresss
    * @access - public
    * @var    - float 
    */
    public $latitude;
    
    /**
    * @desc   - start location
    * @access - public
    * @var    - string 
    */
    public $start;

    /**
    * @desc   - the destination address
    * @access - public
    * @var    - string 
    */
    public $to;
    
    /**
    * @desc   - the via address
    * @access - public
    * @var    - string 
    */
    public $via;

    /**
    * @desc   - maximum mile radius for the lift
    * @access - public
    * @var    - integer 
    */
    public $maxMiles;

    /**
    * @desc   - the requested seats
    * @access - public
    * @var    - integer 
    */
    public $seats;

    /**
    * @desc   - smoking is allowed
    * @access - public
    * @var    - boolean 
    */
    public $smoker;

    /**
    * @desc   - number of bags
    * @access - public
    * @var    - integer 
    */
    public $bags;
 
    /**
    * @desc   - size of bags (small, medium, large)
    * @access - public
    * @var    - string 
    */
    public $bagSize;

    /**
    * @desc   - note
    * @access - public
    * @var    - string 
    */
    public $note;

	//________________________ C O N S T R U C T O R ___________________________

	/**
	* @desc  - Class Constructor 
	* @param - integer $id
    * @param - string  $customerId : id of the customer   
    * @param - string  $rideId     : id of the rider   
    * @param - string  $locationId : location longitude
    * @param - date    $latitude   : location latitude
    * @param - string  $region     : code for the region   
    * @param - string  $name       : name of the location   
    * @param - string  $longitude  : location longitude
    * @param - date    $latitude   : location latitude
	*/
	function __construct
    (
        $id           = NO_ID,
        $customerId   = NO_ID,
        $orderId      = NO_ID,
        $rideId       = NO_ID,
        $locationId   = NO_ID,
        $confNum      = "",
        $contribution = "",
        $startType    = self::AIRPORT_START,
        $status       = "",
        $dt           = "",
        $longitude    = "",
        $latitude     = "",
        $start        = "",
        $to           = "",
        $via          = "",
        $maxMiles     = "",
        $seats        = 0,
        $smoker       = FALSE,
        $bags         = 0,
        $bagSize      = self::SMALL,
        $note         = ""
    )
	{
		// SET VALUES;
		$this->id            = $id;
        $this->customerId    = $customerId;
        $this->orderId       = $orderId;
        $this->rideId        = $rideId;
        $this->locationId    = $locationId;
        $this->confNum       = $confNum;
        $this->contribution  = $contribution;
        $this->startType     = $startType;
        $this->status        = $status;
        $this->dt            = $dt;
        $this->longitude     = $longitude;
        $this->latitude      = $latitude;
        $this->start         = $start;
        $this->to            = $to;
        $this->via           = $via;
        $this->maxMiles      = $maxMiles;
        $this->seats         = $seats;
        $this->smoker        = $smoker;
        $this->bags          = $bags;
        $this->bagSize       = $bagSize;
        $this->note          = $note;
 
		// SET TABLE NAME:
		$this->_tableName = "lift";
		$this->_pKey = "id";
		$this->_prepareForDBFx = "prepareForDB";
		$this->_prepareForDispFx = "prepareForDisplay";		
	}

	
	//__________________________ U T I L I T Y  ________________________________
	
    /**
    * @desc   - Changes the values for display
    * @access - public
    */
    protected function prepareForDisplay
    (
    )
    {
        if ($this->customerId == NULL)
        {
            $this->customerId = NO_ID;    
        }

        if ($this->orderId == NULL)
        {
            $this->orderId = NO_ID;    
        }

        if ($this->rideId == NULL)
        {
            $this->rideId = NO_ID;    
        }

        if ($this->locationId == NULL)
        {
            $this->locationId = NO_ID;    
        }
        $this->dt = Date::convertMySqlToUSADateTime($this->dt);    
    }

    
    /**
    * @desc   - Changes the values for database
    * @access - public
    */
    protected function prepareForDB
    (
    )
    {
        if ($this->customerId == NO_ID)
        {
            $this->customerId = NULL;    
        }    

        if ($this->orderId == NO_ID)
        {
            $this->orderId = NULL;    
        }    

        if ($this->rideId == NO_ID)
        {
            $this->rideId = NULL;    
        }    

        if ($this->locationId == NO_ID)
        {
            $this->locationId = NULL;    
        }    
        $this->dt = Date::convertUSADateToMySqlDateTime($this->dt);
    }


    //____________________ B U S I N E S S  L O G I C  _________________________

    /**
    * @desc   - airport is the starting point
    * @access - public
    * @return - 
    */
    public function airportStart
    (
    )
    {
        $this->startType = self::AIRPORT_START;
    }

    
    /**
    * @desc   - address is the starting point
    * @access - public
    * @return - 
    */
    public function addressStart
    (
    )
    {
        $this->startType = self::ADDRESS_START;
    }

    
    /**
    * @desc   - new lift
    * @access - public
    * @return - 
    */
    public function newLift
    (
    )
    {
        $this->status = self::NEW_LIFT;
    }

    
    /**
    * @desc   - pending confirm the lift
    * @access - public
    * @return - 
    */
    public function pendingConfirm
    (
    )
    {
        $this->status = self::PENDING_CONFIRM;
    }


    /**
    * @desc   - pending confirm for rider
    * @access - public
    * @return - 
    */
    public function pendingConfirmDriver
    (
    )
    {
        $this->status = self::PENDING_CONFIRM_DRIVER;
    }


    /**
    * @desc   - pending payment the lift
    * @access - public
    * @return - 
    */
    public function pendingPayment
    (
    )
    {
        $this->status = self::PENDING_PAYMENT;
    }

    
    /**
    * @desc   - pending fulfilled the lift
    * @access - public
    * @return - 
    */
    public function pendingFulFilled
    (
    )
    {
        $this->status = self::PENDING_FULFILLED;
    }

    
    /**
    * @desc   - confirm the lift
    * @access - public
    * @return - 
    */
    public function confirm
    (
    )
    {
        $this->status = self::FULFILLED;
    }
    
    
	//____________________________ G E T T E R S _______________________________
		
	/**
	* @desc   - Getter for ID
	* @access - public
	* @return - integer
	*/
	public function getID
    (
    )
	{
		return $this->id;
	}

	
    /**
    * @desc   - Getter for customer Id
    * @access - public
    * @return - integer
    */
    public function getCustomerId
    (
    )
    {
        return $this->rideId;
    }

    
    /**
    * @desc   - Getter for order Id
    * @access - public
    * @return - integer
    */
    public function getOrderId
    (
    )
    {
        return $this->orderId;
    }


    /**
    * @desc   - Getter for ride Id
    * @access - public
    * @return - integer
    */
    public function getRideId
    (
    )
    {
        return $this->rideId;
    }

    
    /**
    * @desc   - Getter for location Id
    * @access - public
    * @return - integer
    */
    public function getLocationId
    (
    )
    {
        return $this->locationId;
    }

    
    /**
    * @desc   - Getter for confirmation number
    * @access - public
    * @return - string
    */
    public function getConfNum
    (
    )
    {
        return $this->confNum;
    }                             


    /**
    * @desc   - Getter for contribution
    * @access - public
    * @return - string
    */
    public function getContribution
    (
    )
    {
        return $this->contribution;
    }                             


    /**
    * @desc   - Getter for start type
    * @access - public
    * @return - integer
    */
    public function getStartType
    (
    )
    {
        return $this->startType;
    }                             

    
    /**
    * @desc   - Getter for status
    * @access - public
    * @return - integer
    */
    public function getStatus
    (
    )
    {
        return $this->status;
    }                             

    
    /**
    * @desc   - Getter for date time of the lift
    * @access - public
    * @return - string
    */
    public function getDT
    (
    )
    {
        return $this->dt;
    }                             

    
    /**
    * @desc   - Getter for logitude
    * @access - public
    * @return - float
    */
    public function getLongitude
    (
    )
    {
        return $this->longitude;
    }                             


    /**
    * @desc   - Getter for latitude
    * @access - public
    * @return - float
    */
    public function getLatitude
    (
    )
    {
        return $this->latitude;
    }                             


    /**
    * @desc   - Getter for start address
    * @access - public
    * @return - string
    */
    public function getStart
    (
    )
    {
        return $this->start;
    }                           
    
    
    /**
    * @desc   - Getter for destination address
    * @access - public
    * @return - string
    */
    public function getTo
    (
    )
    {
        return $this->to;
    }                           
    
    
    /**
    * @desc   - Getter for via address
    * @access - public
    * @return - string
    */
    public function getVia
    (
    )
    {
        return $this->via;
    }                           

      
    /**
    * @desc   - Getter for maxMiles
    * @access - public
    * @return - integer
    */
    public function getMaxMiles
    (
    )
    {
        return $this->maxMiles;
    }                           

      
    /**
    * @desc   - Getter for seats
    * @access - public
    * @return - integer
    */
    public function getSeats
    (
    )
    {
        return $this->seats;
    }                           


    /**
    * @desc   - Getter for smoker
    * @access - public
    * @return - boolean
    */
    public function getSmoker
    (
    )
    {
        return $this->smoker;
    }                           


    /**
    * @desc   - Getter for bag
    * @access - public
    * @return - integer
    */
    public function getBags
    (
    )
    {
        return $this->bags;
    }                           


    /**
    * @desc   - Getter for bag size
    * @access - public
    * @return - string
    */
    public function getBagSize
    (
    )
    {
        return $this->bagSize;
    }                           


    /**
    * @desc   - Getter for note
    * @access - public
    * @return - string
    */
    public function getNote
    (
    )
    {
        return $this->note;
    }                           


	//_________________________ S E T T E R S __________________________________
	
	/**
	* @desc   - Setter for ID
	* @access - public
	* @param  - integer $newID
	*/
	public function setID
    (
        $newID
    )
	{
		$this->id = $newID;
	}
	
    
    /**
    * @desc   - Setter for customer id
    * @access - public
    * @param  - integer $newCustomerId : new customer id
    */
    public function setCustomerId
    (
        $newCustomerId
    )
    {
        $this->customerId = $newCustomerId;
    }


    /**
    * @desc   - Setter for order id
    * @access - public
    * @param  - integer $newOrderId : new order id
    */
    public function setOrderId
    (
        $newOrderId
    )
    {
        $this->orderId = $newOrderId;
    }


    /**
    * @desc   - Setter for ride id
    * @access - public
    * @param  - integer $newRideId : new ride id
    */
    public function setRideId
    (
        $newRideId
    )
    {
        $this->rideId = $newRideId;
    }
    
    
    /**
    * @desc   - Setter for location id
    * @access - public
    * @param  - integer $newLocationId : new location id
    */
    public function setLocationId
    (
        $newLocationId
    )
    {
        $this->locationId = $newLocationId;
    }
    
    
    /**
    * @desc   - Setter for status
    * @access - public
    * @param  - string $newConfNum : new confirmation number
    */
    public function setConfNum
    (
        $newConfNum
    )
    {
        $this->confNum = $newConfNum;
    }


    /**
    * @desc   - Setter for contribution
    * @access - public
    * @param  - string $newContribution : new contribution
    */
    public function setContribution
    (
        $newContribution
    )
    {
        $this->contribution = $newContribution;
    }


    /**
    * @desc   - Setter for status
    * @access - public
    * @param  - string $newStatus : new status
    */
    public function setStartType
    (
        $newStartType
    )
    {
        $this->startType = $newStartType;
    }


    /**
    * @desc   - Setter for status
    * @access - public
    * @param  - string $newStatus : new status
    */
    public function setStatus
    (
        $newStatus
    )
    {
        $this->status = $newStatus;
    }


    /**
    * @desc   - Setter for date time of lift
    * @access - public
    * @param  - string $newDt : the new date time
    */
    public function setDT
    (
        $newDT
    )
    {
        $this->dt = $newDT;
    }                                        


    /**
    * @desc   - Setter for longitude
    * @access - public
    * @param  - string $newLongitude : the new Longitude
    */
    public function setLongitude
    (
        $newLongitude
    )
    {
        $this->longitude = $newLongitude;
    }                                        

    
    /**
    * @desc   - Setter for latitude
    * @access - public
    * @param  - string $newLatitude : the new Latitude
    */
    public function setLatitude
    (
        $newLatitude
    )
    {
        $this->latitude = $newLatitude;
    }                                        


    /**
    * @desc   - Setter for start position
    * @access - public
    * @param  - string $newStart : the new start position
    */
    public function setStart
    (
        $newStart
    )
    {
        $this->start = $newStart;
    }                                        


    /**
    * @desc   - Setter for to address
    * @access - public
    * @param  - string $newTo : the new to address
    */
    public function setTo
    (
        $newTo
    )
    {
        $this->to = $newTo;
    }                                        


    /**
    * @desc   - Setter for via
    * @access - public
    * @param  - string $newVia : the new via
    */
    public function setVia
    (
        $newVia
    )
    {
        $this->via = $newVia;
    }                                        


    /**
    * @desc   - Setter for maxMiles
    * @access - public
    * @param  - integer $newMaxMiles : the new maxMiles
    */
    public function setMaxMiles
    (
        $newMaxMiles
    )
    {
        $this->maxMiles = $newMaxMiles;
    }                                        


    /**
    * @desc   - Setter for seats
    * @access - public
    * @param  - string $newSeats : the new seats
    */
    public function setSeats
    (
        $newSeats
    )
    {
        $this->seats = $newSeats;
    }                                        


    /**
    * @desc   - Setter for smoker
    * @access - public
    * @param  - string $newSmoker : the new smoker
    */
    public function setSmoker
    (
        $newSmoker
    )
    {
        $this->smoker = $newSmoker;
    }                           


    /**
    * @desc   - Setter for bags
    * @access - public
    * @param  - string $newBags : the new bags
    */
    public function setBags
    (
        $newBags
    )
    {
        $this->bags = $newBags;
    }                                        


    /**
    * @desc   - Setter for bagSize
    * @access - public
    * @param  - string $newBagSize : the new bagSize
    */
    public function setBagSize
    (
        $newBagSize
    )
    {
        $this->bagSize = $newBagSize;
    }                                        


    /**
    * @desc   - Setter for note
    * @access - public
    * @param  - string $newNote : the new note
    */
    public function setNote
    (
        $newNote
    )
    {
        $this->note = $newNote;
    }                                        
}