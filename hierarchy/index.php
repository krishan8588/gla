
<?php
error_reporting(0);
echo "<body bgcolor= #f0e68c>";
session_start();
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
if(isset($_SESSION['roll'])) {
    if ($_SESSION['roll'] == 181500329) {
        echo "<h2 align='center' style='color: crimson'>";
        echo "fuckoff";
        echo "</h2>";

    } else {
        $roll = $_SESSION['roll'];
        $sem = $_POST['res'];
        $name = $_SESSION['name'];
        $soapUrl = "http://glauniversity.in/connectapp.asmx"; // asmx URL of WSDL
        $soapUser = "username";  //  username
        $soapPassword = "password"; // password


// xml post structure

        $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
                     <v:Envelope xmlns:i="http://www.w3.org/2001/XMLSchema-instance" xmlns:d="http://www.w3.org/2001/XMLSchema" xmlns:c="http://schemas.xmlsoap.org/soap/encoding/" xmlns:v="http://schemas.xmlsoap.org/soap/envelope/"><v:Header /><v:Body><StudentHierarchy xmlns="http://tempuri.org/" id="o0" c:root="1"><roll i:type="d:string">'.$roll.'</roll><servicekey i:type="d:string">thisismycommunicationapp</servicekey><servicetype i:type="d:string">SOFT</servicetype></StudentHierarchy></v:Body></v:Envelope>';
        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            " http://tempuri.org/result",
            "Host: glauniversity.in",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

// PHP cURL  for https connection with auth
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// converting
        $response = curl_exec($ch);

//echo "$response";
        preg_match_all("/<string[^>]*>[^>]*<\/string>/", $response, $return);
// converting

        $response1 = str_replace("<soap:Body>", "", $response);
        $response2 = str_replace("</soap:Body>", "", $response1);
        $c = count($return, COUNT_RECURSIVE);

// convertingc to XML
        $parser = simplexml_load_string($response2);
// user $parser to get your data out of XML response and to display it.
//print_r($return);
        echo "<div>";
        echo "<h2 align='center' style='color: green'>";
        print_r("HIERARCHY OF : $name");
        echo "</h2>";
        echo "</div>";
        echo "<div align='center'>";
        echo "<a> <img style=\"-webkit-user-select: none;margin: auto;\" src=\"https://glauniversity.in:8103/$roll.jpg\"> </a>";
        echo "</div>";
        echo "<h4 align='center' style='color: deeppink'>";
        print_r($return[0][1]);echo"<br>";
        print_r($return[0][0]);
        echo "</h4>";
        echo "<h4 align='center' style='color: purple'>";
        print_r($return[0][4]);echo"<br>";
        print_r($return[0][3]);
        echo "</h4>";
        echo "<h4 align='center' style='color: green'>";
        print_r($return[0][7]);echo"<br>";
        print_r($return[0][6]);echo"<br>";
        print_r("Email :".$return[0][8]);echo"<br>";
        print_r("Contact :".$return[0][9]);
        echo "</h4>";
        for ($i = 11; $i <= $c - 2; $i++) {
            echo " <br>";
            echo "<h4 align='center' style='color: crimson'>";
            print_r("name : " . $return[0][$i+1]);
            echo "</h4>";
            echo "<h4 align='center' style='color: crimson'>";
            print_r("post :".$return[0][$i]);
            echo "</h4>";
            echo "<h4 align='center' style='color: crimson'>";
            print_r("email :".$return[0][$i+2]);
            echo "</h4>";
            echo "<h4 align='center' style='color: crimson'>";
            print_r("phone number :".$return[0][$i+3]);
            echo "</h4>";
            echo "<h4 align='center' style='color: crimson'>";
            print_r("subject: ".$return[0][$i+4]);
            echo "</h4>";

            $i=$i+4;
        }

    }

}

?>
