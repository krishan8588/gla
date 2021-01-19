
<?php
error_reporting(0);
echo "<body bgcolor= #f0e68c>";
session_start();
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
if(isset($_SESSION['roll'])) {
    error_reporting(0);
    $date = date("Y-m-d");
    $roll = $_SESSION['roll'];
    $name=$_SESSION['name'];

    $data = "roll=$roll&servicekey=thisismycommunicationapp&servicetype=SOFT";
    $headers = array(
        " Host glauniversity.in",

        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:85.0) Gecko/20100101 Firefox/85.0",

        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",

        "Accept-Language: en-US,en;q=0.5",


        "Content-Type: application/x-www-form-urlencoded",

        "Content-Length:" . strlen($data),


        "Origin: http://glauniversity.in",

        "Connection: keep-alive",

        "Referer: http://glauniversity.in/connectapp.asmx?op=StudentProfile",

        "Upgrade-Insecure-Requests: 1"
    );

//$data="rollno=181500340&servicekey=thisismycommunicationapp&servicetype=SOFT";
    $url = "http://glauniversity.in/connectapp.asmx/StudentAttendenceWithMarks";


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
//curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
//curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_POSTREDIR, 3);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1000000000000);
    $output = curl_exec($ch);

    preg_match_all("/<string[^>]*>[^>]*<\/string>/", $output, $return);


    $c = count($return, COUNT_RECURSIVE);

    echo "<h1 align='center' style='color: green'>";
    print_r("ATTENDANCE OF " . $name);
    echo "</h1>";
    for ($i = 0; $i <= $c - 2; $i++) {
        echo " <br>";
        echo "<h4 align='center' style='color: crimson'>";
        print_r("SUBJECT CODE =>" . $return[0][$i]);
        echo "</h4>";
        $i++;
        echo "<h4 align='center' style='color: crimson'>";
        print_r("SUBJECT NAME=>" . $return[0][$i]);
        echo "</h4>";
        $i++;
        echo "<h4 align='center' style='color: crimson'>";
        print_r(" LECTURES HELD =>" . $return[0][$i]);
        echo "</h4>";
        $i++;
        echo "<h4 align='center' style='color: crimson'>";
        print_r("LECTURES ATTEND =>" . $return[0][$i]);
        echo "</h4>";
        $i++;
        echo "<h4 align='center' style='color: crimson'>";
        print_r("PERCENTAGE=>" . $return[0][$i]);
        echo "</h4>";
        $i = $i + 4;
        echo "<h4 align='center' style='color: crimson'>";
        print_r("FACULTY=>" . $return[0][$i]);
        echo "</h4>";
        $i++;


    }
}
