<?php
// Encrypt user name and password for testing
    $_SERVER['SERVER_NAME'] = 'nexus.airpnd.com';
    require_once('nexusPath.inc');
    require_once('config.php');    
    include_once("CSVParsing.php");
//    include_once("DataPopulate.php");
    $csvParsing = new CSVParsing();
    
//    $dataPopulate = new DataPopulate();
    //Recording
    $arr= $csvParsing->convertToArray("airports.dat");
    
    $updateCount = 0;
    $addCount = 0;
    $notImport = 0;
    $locationCT = new LocationCT();
    foreach ($arr AS $rec)
    {
        if ($rec[11] == 'yes')
        {
            $region = $rec[14];            
            $matchLocations = $locationCT->byRegion($region);
            if (!isEmpty($matchLocations) &&
                count($matchLocations) > 0)
            {
                $updateCount++;
                $matchLocation = $matchLocations[0];
                $matchLocation->region     = $rec[14];
                $matchLocation->name       = $rec[3];
                $matchLocation->longitude  = $rec[5];
                $matchLocation->latitude   = $rec[4];
                $locationCT->update($matchLocation);
            }
            else
            {
                $addCount++;
                $location             = new LocationVO();
                $location->region     = $rec[14];
                $location->name       = $rec[3];
                $location->longitude  = $rec[5];
                $location->latitude   = $rec[4];
                $locationCT->add($location);
            }
        }
        else
        {
            $notImport++;
        }
    }    
//    $dataPopulate->populateSIUserDb($arr);
    
    echo $addCount . " are inserted \n" . 
         "\n" . $updateCount . " are updated in airport \n" . 
         "\n" . $notImport . " are not imported \n"; 
