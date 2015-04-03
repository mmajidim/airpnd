<?php
/**
* @description  Controller class used for handling Lift model.
* 
* @copyright    CARRBO LLC. 2013. All rights reseverd.
*               Property of CARRBO. This file can not be used, altered, in any way
*               without expressed writeen permission from CARRBO, LLC.
* @version      1.0
* @author       Mehran Majidi
* @file         LiftCT.php
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
require_once("LiftVO.php");

class LiftCT extends CT
{
    //______________________________ M E M B E R S _____________________________  
    
    /**
    * @desc   - Used for database interactions
    * @access - private
    * @var    - object
    */
    private $liftDAO;
     
    

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
        $this->liftDAO = new DAO($dbLink);    
        $this->dbLink = $this->liftDAO->getDBLink();
    }
   
    
    //____________________________ U T I L I T Y  ______________________________

    /**
    * @desc   - Gets a Lift object by its primary key
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
            $vo = new LiftVO();
            $this->liftDAO->findByPK($vo, $id);
            return $vo; 
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }   
    }
    
    
    /**
    * @desc   - Adds a Lift object to the database
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
            return $this->liftDAO->insert($vo);
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }
    }
 
    
    /**
    * @desc    - Updates a Lift object in the database. 
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
            return $this->liftDAO->update($vo);
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }
    }
    
    /**
    * @desc   - Delete a lift by its primary key. 
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
            $liftVO = new LiftVO($id);
            return $this->liftDAO->delete($liftVO);
        }
        catch (Exception $e)
        {
            Error::report($e);
            return NULL;
        }
    }    
    
    /**
    * @desc   - Reject a ride by the lift. 
    * @access - public
    * @param  - integer : $liftId
    * @return - integer : 1 means rejects and 0 means can not reject
    */
    public function reject
    (
        $liftId
    )
    {        
        $retCode = 1;
        try 
        {
            $lift = $this->get($liftId);            
            $lift->newLift();
            $lift->rideId = NO_ID;
            $this->update($lift);

            return $retCode;
        }
        catch (Exception $e)
        {
            $retCode = -1;
            Error::report($e);
            return $retCode;
        }
    }    

    
    /**
    * @desc   - Get lifts by customer 
    * @access - public
    * @param  - string $customerId  : customer id 
    * @return - object $lifts       : list of lifts or NULL
    */
    function byCustomer
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
                $vo = new LiftVO();         
                $voList = $this->liftDAO->findWhere($vo,$where,
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
    * @desc   - Get lifts by ride 
    * @access - public
    * @param  - string $rideId : ride id 
    * @return - object $lifts  : list of lifts or NULL
    */
    function byRide
    (
        $rideId
    ) 
    {
        try
        {            
            $limit  = "";
            $where  = "";
            $voList = NULL;
            if ($rideId != NO_ID)
            {
                $where  = "rideId = '" . $rideId . "'";               
            }

            if ($where != "")
            {
                $vo = new LiftVO();         
                $voList = $this->liftDAO->findWhere($vo,$where,
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
    * @desc   - Get available lifts based on 
    *           ride longitude and latitude address, ride date time and 
    *           ride maximum miles  
    * @access - public
    * @param  - integer $rideId        : the ride id 
    * @param  - integer $startType     : start address type 
    * @param  - string  $location      : airport name 
    * @param  - string  $driverAddress : startiug location 
    * @param  - float   $longitude     : longitude of the ride address 
    * @param  - float   $latitude      : latitude of the ride address 
    * @param  - string  $date          : date time of the ride (SQL format)
    * @param  - string  $time          : time of the ride 
    * @param  - integer $seats         : seats 
    * @param  - boolean $smoker        : the rider smoke 
    * @param  - string  $bags          : bags 
    * @param  - string  $bagSize       : bagSize 
//    * @param  - integer $maxMiles      : maximum miles for the radius 
    * @return - object  $matchedLifts  : list of matched lifts or NULL
    *  
    */
    function getAvailableLifts
    (
        $rideId,
        $startType,
        $location,
        $driverAddress,
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

        // extra condition
        $cond = "";

        if ($rideId != NO_ID)
        {
            $rideCT = new RideCT($this->dbLink);
            $ride   = $rideCT->get($rideId);
            if (!isEmpty($ride))
            {
                $maxMiles = $ride->maxMiles;                
                $priceCT  = new PriceCT($this->dbLink);
                $prices   = $priceCT->getByEntity($ride->entityId);
                if (!isEmpty($prices) && count($prices) > 0)
                {
                    $price = $prices[0];
                    $maxContributionPerRider = $price->price;
                }
            }
        }
        else
        {
            // maximum miles allowed for the rider 
            $maxMiles             = 50;
            $maxContributionPerRider = $maxMiles * 
                                       ContributionCT::PRICE_PER_MILE;
        }

        // set the date time query
        if (!isEmpty($time))
        {
            $dt = $date . " " . $time;

            if ($startType == LiftVO::AIRPORT_START)
            {
                // select any lifts before the selected time
                // for rides from airport becuase the rider should 
                // not wait for the drivers
//                $dtWhere = "'" . $date . "' = DATE(l.dt) AND " . 
//                           "'" . $time . "' <= TIME(l.dt) AND " . 
//                           "start = '" . $location . "'";
                // the requested date time needs to be less than the 
                // rider date time and can not exceed 24 hours (MM need to do
                // this in future.  dt must be greater than l.dt - 24 hours)
                $dtWhere  = "'" . $dt . "' <= l.dt AND ";
                $dtWhere .= "'" . $dt . 
                            "' >= DATE_SUB(l.dt, INTERVAL 24 HOUR) AND ";  
//                $dtWhere .= "'" . $dt . 
//                            "' <= DATE_ADD(l.dt, INTERVAL 24 HOUR) AND ";  
               $dtWhere .=  "start = '" . $location . "'";
            }  
            else
            {
                // select any lifts before he selected time 
                // for going to airport
//                $dtWhere = "'" . $date . "' = DATE(l.dt) AND " . 
//                           "'" . $time . "' >= TIME(l.dt) AND " .
//                           "`to` = '" . $location . "'";
                // the requested date time needs to be greater than the 
                // rider date time and can not exceed 24 hours (MM need to do
                // this in future. dt must less than l.dt + 24 hours)
                $dtWhere  = "'" . $dt . "' >= l.dt AND ";
                $dtWhere .= "'" . $dt . 
                            "' <= DATE_ADD(l.dt, INTERVAL 24 HOUR) AND ";  
                $dtWhere .= "`to` = '" . $location . "'";
            }
        }
        else
        {
            $dtWhere = "'" . $date . "' = DATE(dt)"; 
        }

        if ($seats)
        {
            $cond .= " AND l.seats <= " . $seats;
        }
        
        // get the top 20 matched lifts
        $dao     = new DAO();
        $sql = "SELECT l.id AS lId, l.customerId AS customerId, 
                l.startType AS startType, l.dt AS datetime, 
                l.start AS start, l.to AS `to`, l.via AS via, 
                l.bags AS bags, l.bagSize AS bagSize, l.seats AS seats, 
                l.smoker AS smoker, c.firstName firstName, c.note AS note, 
                c.lastName lastName, l.maxMiles,
                (((acos(sin((" . $latitude . "*pi()/180)) * 
                sin((`latitude`*pi()/180))+cos((" . $latitude  . "*pi()/180)) * 
                cos((`latitude`*pi()/180)) * 
                cos(((" . $longitude . " - `longitude`)* 
                pi()/180))))*180/pi())*60*1.1515) AS distance 
                FROM lift AS l, customer AS c
                WHERE l.status = " . LiftVO::NEW_LIFT . " AND " .
                $dtWhere . " AND c.id = l.customerId " . $cond .
                " HAVING distance <= " . $maxMiles . "                
                ORDER BY distance
                LIMIT 0 , 20;";

        $lifts   = $dao->findBySQL($sql);
        
        $matchedLifts = NULL;
        if (!isEmpty($lifts) && count($lifts) > 0)
        {
            $matchedLifts = array();
            foreach ($lifts AS $lift)
            {
                $matchedLift   = array();
                $matchedLift['lId']          = $lift['lId'];
                $matchedLift['customerId']   = $lift['customerId'];
                $matchedLift['firstName']    = $lift['firstName'];
                $matchedLift['lastName']     = $lift['lastName'];
                $matchedLift['startType']    = $lift['startType'];
                $matchedLift['datetime']     = Date::convertMySqlToUSADateTime(
                                                   $lift['datetime']);

                $start        = $lift['start'];
                $to           = $lift['to'];
                                                   
                if ($lift['startType'] == LiftVO::AIRPORT_START)
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
                
                $matchedLift['start']        = $start;
                $matchedLift['to']           = $to;
                $matchedLift['via']          = $lift['via'];
                $matchedLift['maxMiles']     = $maxMiles;
                $matchedLift['seats']        = $lift['seats'];
                $matchedLift['smoker']       = $lift['smoker'];
                $matchedLift['bags']         = $lift['bags'];
                $matchedLift['bagSize']      = $lift['bagSize'];
                
                // get the address of driver
                if ($lift['startType'] == LiftVO::AIRPORT_START)
                {
                    $riderAddress = $lift['to'];
                }   
                else
                {
                    $riderAddress = $lift['start'];    
                }   
                
                $contributionCT = new ContributionCT($this->dbLink);           

                // calculate mileage rate based on the contribution per rider
                $mileageRate    = $contributionCT->getRate(
                                                $location,
                                                $driverAddress,
                                                $maxMiles,
                                                $maxContributionPerRider);
                                                
                // calculate the contribution based on the mileage rate
                // and the distance between airport->driver->rider distance                                
                $contribution = $contributionCT->calculateContribution(
                                                     $mileageRate,
                                                     $location,
                                                     $driverAddress,
                                                     $riderAddress,
                                                     $lift['seats']);               
                $matchedLift['contribution'] = $contribution;                
                array_push($matchedLifts, $matchedLift);                
            }
        }
        return ($matchedLifts);        
    }            


    /**
    * @desc   - Get lifts per customer 
    * @access - public
    * @param  - string  $customerId   : id of the customer 
    * @return - object  $lifts      : list of lifts or NULL
    */
    function liftsPerCustomer
    (
        $customerId
    )
    {
        $dao   = new DAO();
        $sql   = "SELECT * FROM lift WHERE customerId =" . $customerId ;
        $lifts = $dao->findBySQL($sql);
        return ($lifts);
    }            
}