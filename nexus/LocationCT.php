<?php
/**
* @description  Controller class used for handling location model.
* 
* @copyright    CARRBO LLC. 2013. All rights reseverd.
*               Property of CARRBO. This file can not be used, altered, in any way
*               without expressed writeen permission from CARRBO, LLC.
* @version      1.0
* @author       Mehran Majidi
* @file         LocationCT.php
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
require_once("LocationVO.php");

class LocationCT extends CT
{
    //______________________________ M E M B E R S _____________________________  
    
    /**
    * @desc   - Used for database interactions
    * @access - private
    * @var    - object
    */
    private $locationDAO;
     
    

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
        $this->locationDAO = new DAO($dbLink);    
        $this->dbLink = $this->locationDAO->getDBLink();
    }
   
    
    //____________________________ U T I L I T Y  ______________________________

    /**
    * @desc   - Gets a Location object by its primary key
    * @access - public
    * @param  - integer $id
    * @return - object
    */
    public function get
    (
        $id
    )
    {
        try 
        {
            $vo = new LocationVO();
            $this->locationDAO->findByPK($vo, $id);
            return $vo; 
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }   
    }
    
    /**
    * @desc   - Adds a Location object to the database
    * @access - public
    * @param  - resource $vo
    * @return - string
    */
    public function add
    (
        &$vo
    )
    {
        try 
        {
            return $this->locationDAO->insert($vo);
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }
    }
 
    
    /**
    * @desc    - Updates a Location object in the database. 
    * @access  - public
    * @param   - resource $vo
    * @return  - integer or NULL (number of rows updated) 
    */
    public function update
    (
        &$vo
    )
    {
        try 
        {
            return $this->locationDAO->update($vo);
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }
    }
    
    /**
    * @desc   - Delete a location by its primary key. 
    * @access - public
    * @param  - integer : $id
    * @return - integer or NULL (number of rows deleted)
    */
    public function delete
    (
        $id
    )
    {
        try 
        {
            $locationVO = new LocationVO($id);
            return $this->locationDAO->delete($locationVO);
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }
    }    
    
    
    /**
    * @desc   - Get location by region 
    * @access - public
    * @param  - string $region   : region for locations 
    * @return - array $locations : list of locations per region or NULL
    */
    function byRegion
    (
        $region
    ) 
    {
        try
        {            
            $limit  = "";
            $where  = "";
            $voList = NULL;
            if ($region != "")
            {
                $where  = "region = '" . $region . "'";               
            }

            if ($where != "")
            {
                $vo = new LocationVO();         
                $voList = $this->locationDAO->findWhere($vo,$where,
                                                        "","","",
                                                        $limit);
            }            
            
            if (count($voList) > 0)
            {
                return $voList;
            }          
            else
            {
                return NULL;                
            }  
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }
    }    

    
    /**
    * @desc   - Get location by name 
    * @access - public
    * @param  - string $name     : name of locations 
    * @return - array $locations : list of locations per region or NULL
    */
    function byName
    (
        $name
    ) 
    {
        try
        {            
            $limit  = "";
            $where  = "";
            $voList = NULL;
            if ($name != "")
            {
                $where  = "name = '" . $name . "'";               
            }

            if ($where != "")
            {
                $vo = new LocationVO();         
                $voList = $this->locationDAO->findWhere($vo,$where,
                                                        "","","",
                                                        $limit);
            }            
            
            if (count($voList) > 0)
            {
                return $voList;
            }          
            else
            {
                return NULL;                
            }  
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }
    }    

    
    /**
    * @desc   - Get all location 
    * @access - public
    * @param  -  
    * @return - array $locations : list of all location objects or NULL
    */
    function allLocations
    (
    ) 
    {
        try
        {            
            $limit     = "";
            $where     = "";
            $locations = array();
            
            $sql = "SELECT * FROM location ORDER BY name";
            $locationsDat = $this->locationDAO->findBySQL($sql);
            
            foreach ($locationsDat AS $locationDat)
            {
                $location = new LocationVO($locationDat['id'],
                                           $locationDat['region'],
                                           $locationDat['name'],
                                           $locationDat['longitude'],
                                           $locationDat['latitude']);
                array_push($locations, $location);
            }
            if (count($locations) > 0)
            {
                return $locations;
            }          
            else
            {
                return NULL;                
            }  
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }
    }
}