<?php
include_once('php/connection.php');

$conn = connectDB();

if ($conn->connect_errno > 0) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT CompanyName, OTCStockTicker, GoogFinURLOTC, ID, OTCDividend FROM dax30 WHERE ID > 20";
$result=$conn->query($sql);

while($row = $result->fetch_assoc()) {
  $url = $row['GoogFinURLOTC'];
  //$url = 'https://www.google.com/finance?q=FRA%3AADS';
  $otc_curl = curl_init();

  curl_setopt($otc_curl, CURLOPT_URL, $url);
  //no header
  curl_setopt($otc_curl, CURLOPT_HEADER, 0);
  //return results instead of outputting
  curl_setopt($otc_curl, CURLOPT_RETURNTRANSFER, 1);

  if (!$otc_page=curl_exec($otc_curl)) {
    die('Error: "'.curl_error($otc_curl).'" - Code '.curl_errno($otc_curl));
    curl_close($otc_curl);
  } else {
    curl_close($otc_curl);
    //echo "worked:";
  }
/*
  //parse for dividend yield
  $pos=strpos($otc_page, 'Div/yield');
  $str1=substr($otc_page, $pos, 100);
  $pieces = explode("/",$str1);
  $yld=floatval(substr($pieces[3],0,4));
  */
  //Find and parse price string
  $pos=strpos($otc_page, 'meta itemprop="price"');
  $str1=substr($otc_page, $pos, 100);
  $pieces = explode('"',$str1);
  $price=floatval($pieces[3]);
  $yld=round(100*($row['OTCDividend']/$price),2);
  $dax_id=$row['ID'];
  //insert statement
  //temp echo to test logic
  //echo $row['CompanyName']."; ".$row['OTCStotckTicker'].": Yield: ".$yld."; Price: ".$price."<BR>\n";
  $sql_ins = "INSERT into dailyPriceYieldOTC
       (ID, currDate, Yield, Price)
       VALUES
       ('$dax_id', now(), $yld, $price)";
  //echo $sql_ins."<BR><BR>\n";
  $res_ins=$conn->query($sql_ins);

}

$conn->close();

?>
