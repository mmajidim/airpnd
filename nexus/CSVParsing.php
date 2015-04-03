<?php

class CSVParsing
{
  //________________________ C O N S T R U C T O R _________________________

    /**
     * @desc   - Constructor
     * @access - public
     * @param  - 
     * @return
     */
    public function __construct
    (
          
    )
    {
       
    }
    
      /**
     * @desc   - extract the data and convert it to array
     * @access - public
     * @param  - dat : bar separated data
     * @return - 
     */
    function convertToArray
    (
        $dat // Dat File
    )
    {
        $lines = file($dat);
        $i = 0;
        $dataList = NULL;  
        foreach ($lines AS $line_num => $line)
        {
            $new = explode("|",trim($line));
            $new = array_map('trim', $new);

            if($i>0)
            {
                $dataList[] = $new;
            }
            $i++;
        }
        return $dataList;
    }          
}
  

