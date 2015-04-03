<?php
/**
* @description  manages the Driver License information
* 
* @copyright    CARRBO LLC. 2013. All rights reseverd.
*               Property of CARRBO. This file can not be used, altered, in any way
*               without expressed writeen permission from CARRBO, LLC.
* @version		1.0
* @author 		Mehran Majidi
* @file  		DriverLicenseVO.php
*
* @todo         
* 
* @revDate      
* @revAuthor    
* @revDesc                   
*/

require_once("VO.php");

class DriverLicenseVO extends VO
{
	//________________________ D A T A   M E M B E R S _________________________

	/**
	* @desc   - Primary Key ID
	* @access - public
	* @var    - integer
	*/
	public $id;
	
    /**
    * @desc   - customer id that has the driver license
    * @access - public
    * @var    - integer 
    */
    public $customerId;

    /**
    * @desc   - state code for the driver license
    * @access - public
    * @var    - string 
    */
    public $state;

    /**
    * @desc   - driver license number
    * @access - public
    * @var    - string 
    */
    public $number;
    
    /**
    * @desc   - date of birth
    * @access - public
    * @var    - string 
    */
    public $dob;

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
        $customerId   = NO_ID,
        $state        = "",
        $number       = "",
        $dob          = ""
    )
	{
		// SET VALUES;
		$this->id            = $id;
        $this->customerId    = $customerId;
        $this->state         = $state;
        $this->number        = $number;
        $this->dob           = $dob;

		// SET TABLE NAME:
		$this->_tableName = "driverLicense";
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
        $this->dob = Date::convertMySqlDatetoUSA($this->dob);    
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
        $this->dob = Date::convertUSADateToMysql($this->dob);
    }

	

    //____________________ B U S I N E S S  L O G I C  _________________________

    
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
        return $this->customerId;
    }

    
    /**
    * @desc   - Getter for state
    * @access - public
    * @return - string
    */
    public function getState
    (
    )
    {
        return $this->state;
    }                             

    
    /**
    * @desc   - Getter for driver license number
    * @access - public
    * @return - string
    */
    public function getNumber
    (
    )
    {
        return $this->number;
    }                             

    
    /**
    * @desc   - Getter for date of birth
    * @access - public
    * @return - string
    */
    public function getDOB
    (
    )
    {
        return $this->dob;
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
    * @param  - string $newCustomerId : new customer id
    */
    public function setCustomerId
    (
        $newCustomerId
    )
    {
        $this->customerId = $newCustomerId;
    }
    
    
    /**
    * @desc   - Setter for state
    * @access - public
    * @param  - string $newState : new state
    */
    public function setState
    (
        $newState
    )
    {
        $this->state = $newState;
    }


    /**
    * @desc   - Setter for driver license number
    * @access - public
    * @param  - string $newNumber : the new number
    */
    public function setNumber
    (
        $newNumber
    )
    {
        $this->number = $newNumber;
    }                                        


    /**
    * @desc   - Setter for date of birth
    * @access - public
    * @param  - string $newDOB : the new DOB
    */
    public function setDOB
    (
        $newDOB
    )
    {
        $this->dob = $newDOB;
    }                                        
}