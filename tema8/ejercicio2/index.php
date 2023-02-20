<?php
/**
 * @author Hugo Vicente Peligro
 */

 $msgSoap = '<?xml version="1.0" encoding="utf-8"?>
 <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
 <soap:Body>
 <ListOfContinentsByName xmlns="http://www.oorsprong.org/websamples.countryinfo">
 </ListOfContinentsByName>
</soap:Body>
</soap:Envelope>';

 $ch = curl_init();

    
    
    $array = array(CURLOPT_URL => "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => 1.1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $msgSoap,
    CURLOPT_HTTPHEADER => array("Content-Type: text/xml; charset=utf-8",
                                         "Content-Length: ".strlen($msgSoap))
                  );
    
    curl_setopt_array($ch, $array);
    $result = curl_exec($ch);
    var_dump($result);
    curl_close($ch);

?>