<?php
/**
* @description  Controller class used for handling Ride model.
* 
* @copyright    CARRBO LLC. 2013. All rights reseverd.
*               Property of CARRBO. This file can not be used, 
*               altered, in any way without expressed writeen permission 
*               from CARRBO, LLC.
* @version      1.0
* @author       Mehran Majidi
* @file         RideCT.php
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
require_once("RideVO.php");

class RideCT extends CT
{
    //______________________________ M E M B E R S _____________________________  
    
    /**
    * @desc   - Used for database interactions
    * @access - private
    * @var    - object
    */
    private $rideDAO;
         

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
        $this->rideDAO = new DAO($dbLink);    
        $this->dbLink = $this->rideDAO->getDBLink();
    }
   
    
    //____________________________ U T I L I T Y  ______________________________

    /**
    * @desc   - Gets a Ride object by its primary key
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
            $vo = new RideVO();
            $this->rideDAO->findByPK($vo, $id);
            return $vo; 
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }   
    }
    
    
    /**
    * @desc   - Adds a Ride object to the database
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
            return $this->rideDAO->insert($vo);
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }
    }
 
    
    /**
    * @desc    - Updates a Ride object in the database. 
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
            return $this->rideDAO->update($vo);
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }
    }
    
    /**
    * @desc   - Delete a ride by its primary key. 
    * @access - public
    * @param  - integer : $id
    * @return - integer or NULL (number of rows deleted)
    */
    public function delete
    (
        $id
    )
    {
        $deleteLifts = "DELETE FROM lift WHERE 
                        rideId = '$id'";
        $this->rideDAO->deleteBySQL($deleteLifts);
        
        try 
        {
            $rideVO = new RideVO($id);
            return $this->rideDAO->delete($rideVO);
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }
    }    
        

    /**
    * @desc   - Get rides by owner 
    * @access - public
    * @param  - string $ownerId : owner id 
    * @return - object $rides   : list of rides or NULL
    */
    function byOwner
    (
        $ownerId
    ) 
    {
        try
        {            
            $limit  = "";
            $where  = "";
            $voList = NULL;
            if ($ownerId != NO_ID)
            {
                $where  = "ownerId = '" . $ownerId . "'";               
            }

            if ($where != "")
            {
                $vo = new RideVO();         
                $voList = $this->rideDAO->findWhere($vo,$where,
                                                    "","","",
                                                    $limit);
            }            
            
            if (!isEmpty($voList) && 
                count($voList) > 0)
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
    * @desc   - Does the ride have any pending lifts 
    * @access - public
    * @param  - integer $rideId  : id of the ride  
    * @return - boolean          : TRUE if the ride has any pending lift
    */
    function hasPendingLifts
    (
        $rideId
    )
    {
        // get the top 20 matched rides
        $dao     = new DAO();        
        $sql = "SELECT l.id AS lId FROM lift AS l, ride AS r
                WHERE l.status <> 4 AND r.id = " . $rideId . " " .  
                "AND r.id = l.rideId";
                
        $pendingLifts = $dao->findBySQL($sql);
                
        if (!isEmpty($pendingLifts) && 
            count($pendingLifts) > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }     

    /**
    * @desc   - Get available rides based on 
    *           lift longitude and latitude address, and ride date time 
    * @access - public
    * @param  - integer $startType    : start type for the ride  
    * @param  - string  $location     : airport name
    * @param  - string  $riderAddress : address of the rider  
    * @param  - float   $longitude    : longitude of the ride address 
    * @param  - float   $latitude     : latitude of the ride address 
    * @param  - string  $date         : date of the ride  (mysql date) 
    * @param  - string  $time         : time of the ride  (hh:mm:ss) 
    * @param  - integer $seats        : seats 
    * @param  - boolean $smoker       : smoker ride is offered
    * @param  - integer $bags         : number of bags
    * @param  - string  $bagSize      : bagSize 
//    * @param  - string  $maxMiles   : maximum miles 
    * @return - object  $matchedRides : list of matched rides or NULL
    */
    function getAvailableRides
    (
        $startType,
        $location,
        $riderAddress,
        $longitude,
        $latitude,
        $date,
        $time,
        $seats,
        $smoker,
        $bags,
        $bagSize
//        $maxMiles
    )
    {
        // extra conditions
        $cond = "";
        
        // maximum miles allowed for the rider 
        $maxMiles = 50;
        
        // set the date time query
        if (!isEmpty($time))
        {
            $dt = $date . " " . $time;
            if ($startType == RideVO::AIRPORT_START)
            {
                // select rides after the selected time because 
                // the driver should wait for the rider
                // this is the case for driving from the airport
//                $dtWhere = "'" . $date . "' = DATE(r.dt) AND " . 
//                           "'" . $time . "' <= TIME(r.dt) AND " . 
//                           "start = '" . $location . "'";
                // the requested date time needs to be less than the 
                // driver date time and can not exceed 24 hours (MM needs to do
                // this in future.  dt must be greater than r.dt - 24 hours)
                $dtWhere = "'" . $dt . "' >= r.dt AND ";
                $dtWhere .= "'" . $dt . 
                            "' <= DATE_ADD(r.dt, INTERVAL 24 HOUR) AND ";  
                $dtWhere .= "start = '" . $location . "'";
            }  
            else
            {
//                $dtWhere = "'" . $date . "' = DATE(r.dt) AND " . 
//                           "'" . $time . "' >= TIME(r.dt) AND " .
//                           "`to` = '" . $location . "'";
                // the requested date time needs to be greater than the 
                // driver date time and can not exceed 24 hours (MM need to do
                // this in future. dt must less than r.dt + 24 hours)
                $dtWhere  = "'" . $dt . "' >= r.dt AND "; 
                $dtWhere .= "'" . $dt . 
                            "' <= DATE_ADD(r.dt, INTERVAL 24 HOUR) AND ";  
                $dtWhere .= "`to` = '" . $location . "'";
            }
        }
        else
        {
            $dtWhere = "'" . $date . "' = DATE(dt)"; 
        }


        if ($seats)
        {
            $cond .= " AND r.seats >= " . $seats;
        }

        // get the top 20 matched rides
        $dao     = new DAO();        
        $sql = "SELECT r.id AS rId, r.ownerId AS ownerId, 
                r.entityId AS entityId, r.startType AS startType, 
                r.dt AS datetime, r.start AS start, r.to AS `to`, r.via AS via, 
                r.maxMiles AS maxMiles, r.seats AS seats, 
                r.smoker AS smoker, r.bags AS bags, r.bagSize AS bagSize, 
                o.firstName AS firstName, o.lastName AS lastName, 
                c.note AS note, 
                p.price AS contribution,
                (((acos(sin((" . $latitude . "*pi()/180)) * 
                sin((`latitude`*pi()/180))+cos((" . $latitude  . "*pi()/180)) * 
                cos((`latitude`*pi()/180)) * 
                cos(((" . $longitude . " - `longitude`)* 
                pi()/180))))*180/pi())*60*1.1515) AS distance 
                FROM ride AS r, owner AS o, customer AS c, price AS p
                WHERE r.status IN (" . RideVO::NEW_RIDE . "," . 
                RideVO::AVAILABLE . ") AND " .
                $dtWhere . " AND o.id = r.ownerId AND " . 
                "o.customerId = c.id AND " . 
                "p.entityId = r.entityId " . $cond . 
                " HAVING distance <= maxMiles AND distance <= " . $maxMiles . " 
                ORDER BY distance, price
                LIMIT 0 , 20;";
        $rides = $dao->findBySQL($sql);
                
        $matchedRides = NULL;
        if (!isEmpty($rides) && count($rides) > 0)
        {
            $matchedRides = array();
            foreach ($rides AS $ride)
            {
                $matchedRide   = array();
                $matchedRide['rId']       = $ride['rId'];
                $matchedRide['ownerId']   = $ride['ownerId'];
                $matchedRide['entityId']  = $ride['entityId'];
                $matchedRide['firstName'] = $ride['firstName'];
                $matchedRide['lastName']  = $ride['lastName'];
                $matchedRide['startType'] = $ride['startType'];
                $matchedRide['datetime']  = Date::convertMySqlToUSADateTime(
                                                $ride['datetime']);
                                                
                $start     = $ride['start'];
                $to        = $ride['to'];
                if ($ride['startType'] == RideVO::AIRPORT_START)
                {
                    $addressList = explode(",", $to);
                    $cnt         = count($addressList);
                    $to          = $addressList[$cnt-3] . "," . 
                                   $addressList[$cnt-2] . "," .
                                   $addressList[$cnt - 1];
                }
                else
                {
                    $addressList = explode(",", $start);
                    $cnt         = count($addressList);
                    $start       = $addressList[$cnt-3] . "," . 
                                   $addressList[$cnt-2] . "," .
                                   $addressList[$cnt - 1];
                }
                                                
                $matchedRide['start']     = $start;
                $matchedRide['to']        = $to;
                $matchedRide['via']       = $ride['via'];
                $matchedRide['maxMiles']  = $ride['maxMiles'];
                $maxContributionPerRider  = $ride['contribution'];
                $matchedRide['seats']     = $ride['seats'];
                $matchedRide['smoker']    = $ride['smoker'];
                $matchedRide['bags']      = $ride['bags'];
                $matchedRide['bagSize']   = $ride['bagSize'];
                
                // get the address of driver
                if ($ride['startType'] == RideVO::AIRPORT_START)
                {
                    $driverAddress = $ride['to'];    
                }   
                else
                {
                    $driverAddress = $ride['start'];    
                }   
                                                
                $contributionCT = new ContributionCT($this->dbLink);           

                // calculate mileage rate based on the contribution per rider
                $mileageRate    = $contributionCT->getRate(
                                                $location,
                                                $driverAddress,
                                                $matchedRide['maxMiles'],
                                                $maxContributionPerRider);
                                                
                // calculate the contribution based on the mileage rate
                // and the distance between airport->driver->rider distance                                
                $contribution   = $contributionCT->calculateContribution(
                                                       $mileageRate,
                                                       $location,
                                                       $driverAddress,
                                                       $riderAddress,
                                                       $seats);               
                $matchedRide['contribution'] = $contribution;                
                array_push($matchedRides, $matchedRide);                
            }
        }
        return $matchedRides;
    }
}
?>
