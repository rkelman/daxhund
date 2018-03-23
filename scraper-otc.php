<?php

$servername = "mysql12.000webhost.com";
$user = "a8933301_dax";
$passwd = "d4x-H4nd";
$dbname = "a8933301_dax";

$conn = new mysqli($servername, $user, $passwd, $dbname);

if ($conn->connect_errno > 0) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT CompanyName, OTCStockTicker, GoogFinURLOTC, ID FROM dax30";
$result=$conn->query($sql);

while($row = $result->fetch_assoc()) {
    //Get the OTC Page from Google
    $url = $row['GoogFinURLOTC'];
    $page=file_get_contents($url);
    //Find and parse Yield
    $pos=strpos($page, 'Div/yield');
    $str1=substr($page, $pos, 100);
    $pieces = explode("/",$str1);
    $yld=floatval(substr($pieces[3],0,4));
    //Find and parse price string
    $pos=strpos($page, 'meta itemprop="price"');
    $str1=substr($page, $pos, 100);
    $pieces = explode('"',$str1);
    $price=floatval($pieces[3]);
    $dax_id=$row['ID'];
    //insert statement
    //temp echo to test logic
    //echo $row['CompanyName']."; ".$row['OTCStockTicker'].": Yield: ".$yld."; Price: ".$price."<BR>\n";
    $sql_ins = "INSERT into dailyPriceYieldOTC
         (ID, currDate, Yield, Price)
         VALUES
         ('$dax_id', now(), $yld, $price)";
    //echo $sql_ins."<BR><BR>\n";
    $res_ins=$conn->query($sql_ins);
}

$conn->close();

?>
