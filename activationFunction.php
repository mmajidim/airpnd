<?php
/**
 * @file       activationFunction.php
 * @version    1.0.0
 * @author     Rahamtulla I(Aloha Technology)
 * @desc       activation functinality 
 * @date       10/03/2013
 * @copyright  MindShare HDV LLC. 2013. All rights reseverd. Property of
 *             MindShare HDV. This file can not be used, altered, in any way  
 *             without expressed written permission from MindShare HDV, LLC.
 * @revDate    03/24/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added activation functionality and
 *             done with minor formatting
 * @revDate    06/06/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    added password decryption
 *             done with minor formatting
 * @revDate    07/1/2014
 * @revAuthor  Rahamtulla I(Aloha Technology)
 * @revDesc    done with minor formatting
 */
require_once 'encrypt.php';

    $encrypt = new Encryption();

    if (isset($_POST['link']) && isset($_POST['encode']))
    {
        $iv =  (int) mt_rand(1, 500);
        $encryptedKey = $encrypt->encode($_POST['link'],
                                         $iv, 
                                         $ENCRYPT_KEY);
       
        $linkCode = array("link" => $encryptedKey,
                          "iv" => $iv );
        print(json_encode($linkCode));
    }
    else if (isset($_POST['encode']))
    {
        $iv = isset($_POST['iv']) ? $_POST['iv'] : (int) mt_rand(1, 500);
        $encryptedKey = $encrypt->encode($_POST['activationLinkParam'],
                                         $iv, 
                                         $ENCRYPT_KEY);
        $activationCode = array("activate" => $encryptedKey,
                                "iv" => $iv);
        print(json_encode($activationCode));
    }
    else if (isset($_POST['link']))
    {
        $decryptedData = $encrypt->decode($_POST['link'],
                                          $_POST['iv'], 
                                          $ENCRYPT_KEY);
        $decryptedKey = explode(';',$decryptedData);
        $decryptedValue = array
        (
            "data1" => $decryptedKey[0],
            "data2" => $decryptedKey[1],
            "data3" => $decryptedKey[2]
        );
        print(json_encode($decryptedValue));
    }
    
    else if (isset($_POST['password']))
    {
        $decryptedData = $encrypt->decode($_POST['password'],
                                          $_POST['iv'], 
                                          $ENCRYPT_KEY);
        $decryptedKey = $decryptedData;
        $decryptedValue = array
        (
            "password" => $decryptedKey
        );
        print(json_encode($decryptedValue));
    }
    else 
    {
        $decryptedData = $encrypt->decode($_POST['activationLink'],
                                          $_POST['iv'], 
                                          $ENCRYPT_KEY);
        $decryptedKey = $decryptedData;
        $decryptedValue = array
        (
            "userName" => $decryptedKey,
            "password" => ''
        );
        if(strpos($decryptedData,';'))
        {
            $decryptedKey =  explode(";", $decryptedData);       
            $decryptedValue = array
            (
                "userName" => $decryptedKey[0],
                "password" => $decryptedKey[1]
            );
        }
        print(json_encode($decryptedValue));
    }

/* End of file activationFunction.php */
/* Location: activationFunction.php */
?>
