<?php
/**
* @description  manages the Location  
* 
* @copyright    CARRBO LLC. 2013. All rights reseverd.
*               Property of CARRBO. This file can not be used, altered, in any way
*               without expressed writeen permission from CARRBO, LLC.
* @version		1.0
* @author 		Mehran Majidi
* @file  		LocationVO.php
*
* @todo         
* 
* @revDate      
* @revAuthor    
* @revDesc                   
*/

require_once("VO.php");

class LocationVO extends VO
{
	//________________________ D A T A   M E M B E R S _________________________

    /** #@+
    * @desc   - default location 
    *           DIA default location for the region
    * @access - public
    * @var    - string 
    */
    const DEFAULT_LOCATION = 'DIA';
    /**#@-*/


	/**
	* @desc   - Primary Key ID
	* @access - public
	* @var    - integer
	*/
	public $id;
	
    /**
    * @desc   - name of regions (e.g. airport code)
    * @access - public
    * @var    - string 
    */
    public $region;

    /**
    * @desc   - name of location
    * @access - public
    * @var    - string 
    */
    public $name;

    /**
    * @desc   - name of longitude
    * @access - public
    * @var    - string 
    */
    public $longitude;

    /**
    * @desc   - name of latitude
    * @access - public
    * @var    - string 
    */
    public $latitude;

    
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
        $region       = "",
        $name         = "",
        $longitude    = "",
        $latitude     = ""
    )
	{
		// SET VALUES;
		$this->id            = $id;
        $this->region        = $region;
        $this->name          = $name;
        $this->longitude     = $longitude;
        $this->latitude      = $latitude;

		// SET TABLE NAME:
		$this->_tableName = "location";
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
    }

    
    /**
    * @desc   - Changes the values for database
    * @access - public
    */
    protected function prepareForDB
    (
    )
    {
    }

    
    //____________________ B U S I N E S S  L O G I C  _________________________

    /**
    * @desc   - Get address of the location 
    * @access - public
    * @param  -  
    * @return - array $locations : list of all location objects or NULL
    */
    public function getAddress
    (
    )
    {
        $address = "";
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.
               trim($this->latitude).','.trim($this->longitude).
               '&sensor=false';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        $data=json_decode($return);
        $status = $data->status;
        if($status=="OK")
        {
            $address= $data->results[0]->formatted_address;        
        }
        return $address;
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
    * @desc   - Getter for region of locations
    * @access - public
    * @return - string
    */
    public function getRegion
    (
    )
    {
        return $this->region;
    }

    
    /**
    * @desc   - Getter for name
    * @access - public
    * @return - string
    */
    public function getName
    (
    )
    {
        return $this->name;
    }                             

    
    /**
    * @desc   - Getter for longitude
    * @access - public
    * @return - string
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
    * @return - string
    */
    public function getLatitude
    (
    )
    {
        return $this->latitude;
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
    * @desc   - Setter for region
    * @access - public
    * @param  - string $newRegion : new region
    */
    public function setRegion
    (
        $newRegion
    )
    {
        $this->region = $newRegion;
    }
    
    
    /**
    * @desc   - Setter for name
    * @access - public
    * @param  - string $newName : new name
    */
    public function setName
    (
        $newName
    )
    {
        $this->name = $newName;
    }


    /**
    * @desc   - Setter for Longitude
    * @access - public
    * @param  - string $newLongitude : the new longitude
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
    * @param  - string $newLatitude : the new latitude
    */
    public function setLatitude
    (
        $newLatitude
    )
    {
        $this->latitude = $newLatitude;
    }                                                                                
}