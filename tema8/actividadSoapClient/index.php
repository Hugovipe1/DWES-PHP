<?php
/**
 * @author Hugo Vicente Peligro
 */



 $soapclient = new SoapClient("http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL");
//var_dump($soapclient->__getFunctions()); 
//var_dump($soapclient->__getTypes()); 

$params = array(
    "sCode" => "EU",
    "sName" => "Europe"
  );
  $response = $soapclient->__soapCall("ListOfContinentsByName", array($params));
  $response2 = $soapclient->ListOfContinentsByName();

 //var_dump($response2);
 
?>