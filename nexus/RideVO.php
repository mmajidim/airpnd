<?php
/**
* @description  manages the share ride information
*  
* @copyright    CARRBO LLC. 2013. All rights reseverd.
*               Property of CARRBO. This file can not be used, 
*               altered, in any way without expressed writeen permission 
*               from CARRBO, LLC.
* @version		1.0
* @author 		Mehran Majidi
* @file  		VO.php
*
* @todo         
* 
* @revDate      
* @revAuthor    
* @revDesc                   
*/

require_once("VO.php");

class RideVO extends VO
{
	//________________________ D A T A   M E M B E R S _________________________

    /**#@+
     * @desc   - Constants for ride start type
     *           AIRPORT : start the lift from airport,
     *           ADDRESS : start the lift from an address,
     * @access - public
     * @var    - int 
     */
    const AIRPORT_START = 0; 
    const ADDRESS_START = 1;
    /**#@-*/

    
    /**#@+
     * @desc   - Constants for status of ride
     *           NEW_RIDE  : ride with no lift,
     *           AVAILABLE : ride with a lift and more available seats,
     *           FULL      : ride with lifts and no avaailable seats
     *           FULFILLED : completed ride with confirmation number for 
     *                       all lifts
     * @access - public
     * @var    - int 
     */
    const NEW_RIDE           = 0; 
    const AVAILABLE          = 1;
    const FULL               = 2;
    const FULFILLED          = 3;
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
    * @desc   - customer id for the ride
    * @access - public
    * @var    - integer 
    */
    public $ownerId;
    
    /**
    * @desc   - entity id for the ride
    * @access - public
    * @var    - integer 
    */
    public $entityId;
    
    /**
    * @desc   - location id 
    * @access - public
    * @var    - integer 
    */
    public $locationId;

    /**
    * @desc   - Where ride starts (airport or address)
    * @access - public
    * @var    - integer 
    */
    public $startType;

    /**
    * @desc   - status of the ride
    * @access - public
    * @var    - integer 
    */
    public $status;

    /**
    * @desc   - date time of the ride
    * @access - public
    * @var    - string 
    */
    public $dt;

    /**
    * @desc   - longitude of the destination address
    * @access - public
    * @var    - integer 
    */
    public $longitude;
    
    /**
    * @desc   - latitude of the destination address
    * @access - public
    * @var    - integer 
    */
    public $latitude;

    /**
    * @desc   - start location
    * @access - public
    * @var    - string 
    */
    public $start;

    /**
    * @desc   - destination address
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
    * @desc   - maximum mile radius for the ride
    * @access - public
    * @var    - integer 
    */
    public $maxMiles;

    /**
    * @desc   - number of available seats
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
    * @desc   - note for the ride
    * @access - public
    * @var    - string 
    */
    public $note;

	//________________________ C O N S T R U C T O R ___________________________

	/**
	* @desc  - Class Constructor 
	* @param - integer $id
    * @param - string  $region    : code for the region   
    * @param - string  $name      : name of the location   
    * @param - string  $longitude : location longitude
    * @param - date    $latitude  : location latitude
	*/
	function __construct
    (
        $id           = NO_ID,
        $ownerId      = NO_ID,
        $entityId     = NO_ID,
        $locationId   = NO_ID,
        $startType    = self::AIRPORT_START,
        $status       = self::AVAILABLE,
        $dt           = "",
        $longitude    = "",
        $latitude     = "",
        $start        = "",
        $to           = "",
        $via          = "",
        $maxMiles     = 0,
        $seats        = 0,
        $smoker       = FALSE,
        $bags         = 0,
        $bagSize      = self::SMALL,
        $note         = ""        
    )
	{
		// SET VALUES;
        $this->id            = $id;
        $this->ownerId       = $ownerId;
        $this->entityId      = $entityId;
        $this->locationId    = $locationId;
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
		$this->_tableName = "ride";
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
        if ($this->ownerId == NULL)
        {
            $this->ownerId = NO_ID;    
        }

        if ($this->entityId == NULL)
        {
            $this->entityId = NO_ID;    
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
        if ($this->ownerId == NO_ID)
        {
            $this->ownerId = NULL;    
        }    

        if ($this->entityId == NO_ID)
        {
            $this->entityId = NULL;    
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
        return $this->startType = self::AIRPORT_START;
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
        return $this->startType = self::ADDRESS_START;
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
    * @desc   - Getter for owner Id
    * @access - public
    * @return - integer
    */
    public function getOwnerId
    (
    )
    {
        return $this->ownerId;
    }


    /**
    * @desc   - Getter for entity Id
    * @access - public
    * @return - integer
    */
    public function getEntityId
    (
    )
    {
        return $this->entityId;
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
    * @desc   - Getter for maximum miles
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
    * @desc   - Getter for number of bags
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
    * @desc   - Setter for owner id
    * @access - public
    * @param  - string $newOwnerId : new owner id
    */
    public function setOwnerId
    (
        $newOwnerId
    )
    {
        $this->ownerId = $newOwnerId;
    }


    /**
    * @desc   - Setter for entity id
    * @access - public
    * @param  - string $newRideId : new entity id
    */
    public function setEntityId
    (
        $newEntityId
    )
    {
        $this->entityId = $newEntityId;
    }
    
    
    /**
    * @desc   - Setter for location id
    * @access - public
    * @param  - string $newLocationId : new location id
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
    * @desc   - Setter for max miles
    * @access - public
    * @param  - string $newMaxMiles : the new max miles
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
    * @param  - string $newBags : the new bag
    */
    public function setBags
    (
        $newBags
    )
    {
        $this->bags = $newBags;
    }                                        


    /**
    * @desc   - Setter for bag size
    * @access - public
    * @param  - string $newBagSize : the new bag size
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