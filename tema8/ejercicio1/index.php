<?php
/**
 * @author Hugo Vicente Peligro
 */

 $num1 = 5;
 $num2 =  3;

 $msgSoap = <<<EOD
 <?xml version="1.0" encoding="utf-8"?>
 <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
   <soap:Body>
     <Add xmlns="http://tempuri.org/">
       <intA>$num1</intA>
       <intB>$num2</intB>
     </Add>
   </soap:Body>
 </soap:Envelope>
 EOD;

 $ch = curl_init();
    //curl_setopt($ch, CURLOPT_URL, "http://www.dneonline.com/calculator.asmx?op=Add");

    
    
    $array = array(CURLOPT_URL => "http://www.dneonline.com/calculator.asmx?WSDL",
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