<?php
/**
 * @author Hugo Vicente Peligro
 */

    $mostrarBandera = false;
 if (isset($_POST['enviar'])) {
    $msgSoap = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <CountryFlag xmlns="http://www.oorsprong.org/websamples.countryinfo">
        <sCountryISOCode>'.$_POST["pais"].'</sCountryISOCode>
        </CountryFlag>
    </soap:Body>
    </soap:Envelope>';

    $ch = curl_init();

    
    
    $array = array(CURLOPT_URL => "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => 1.1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $msgSoap,
    CURLOPT_HTTPHEADER => array("Content-Type: text/xml; charset=utf-8",
                                         "Content-Length: ".strlen($msgSoap))
                  );
    
    curl_setopt_array($ch, $array);
    $result = curl_exec($ch);
    curl_close($ch);
    preg_match('/<m:CountryFlagResult>(.*)<\/m:CountryFlagResult>/', $result, $matches);
    $mostrarBandera = true;
    
 }
 

?>

<form action="" method="post">
    <label>Escoge un pais</label>
    <select name="pais" id="">
        <option value="BR">Brazil</option>
        <option value="ES">España</option>
        <option value="FR">Francia</option>
        <option value="IT">Italia</option>
    </select>
    <input type="submit" name="enviar" value="Enviar">
</form>

<?php
    if ($mostrarBandera) {
        echo '<img src="'.$matches[1].'" alt="">';
    }

?>

