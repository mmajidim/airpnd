<?php
/**
* @description  Controller class used for handling Driver Licnese model.
* 
* @copyright    CARRBO LLC. 2013. All rights reseverd.
*               Property of CARRBO. This file can not be used, altered, in any way
*               without expressed writeen permission from CARRBO, LLC.
* @version      1.0
* @author       Mehran Majidi
* @file         DriverLicenseCT.php
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
require_once("DriverLicenseVO.php");

class DriverLicenseCT extends CT
{
    //______________________________ M E M B E R S _____________________________  
    
    /**
    * @desc   - Used for database interactions
    * @access - private
    * @var    - object
    */
    private $driverLicenseDAO;
     
    

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
        $this->driverLicenseDAO = new DAO($dbLink);    
        $this->dbLink = $this->driverLicenseDAO->getDBLink();
    }
   
    
    //____________________________ U T I L I T Y  ______________________________

    /**
    * @desc   - Gets a DriverLicense object by its primary key
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
            $vo = new DriverLicenseVO();
            $this->driverLicenseDAO->findByPK($vo, $id);
            return $vo; 
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }   
    }
    
    /**
    * @desc   - Adds a DriverLicense object to the database
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
            return $this->driverLicenseDAO->insert($vo);
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }
    }
 
    
    /**
    * @desc    - Updates a DriverLicense object in the database. 
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
            return $this->driverLicenseDAO->update($vo);
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }
    }
    
    /**
    * @desc   - Delete a driver license by its primary key. 
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
            $driverLicenseVO = new DriverLicenseVO($id);
            return $this->driverLicenseDAO->delete($driverLicenseVO);
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }
    }    
    
    
    /**
    * @desc   - Get driver license by customer id
    * @access - public
    * @param  - integer $customerId    : customer id 
    * @return - object  $driverLicense : customer driver license or NULL
    */
    function byCustomerId
    (
        $customerId
    ) 
    {
        try
        {            
            $limit  = "";
            $where  = "";
            $voList = NULL;
            if ($customerId != NO_ID)
            {
                $where  = "customerId = '" . $customerId . "'";               
            }

            if ($where != "")
            {
                $vo = new DriverLicenseVO();         
                $voList = $this->driverLicenseDAO->findWhere($vo,$where,
                                                             "","","",
                                                             $limit);
            }            
            
            if (!isEmpty($voList) && 
                count($voList) > 0)
            {                
                return $voList[0];
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