<?php
include_once('../php/functions.php');

$conn = connectDB();

if ($conn->connect_errno > 0) {
    die("Connection failed: " . $conn->connect_error);
}
/*
$sql = "SELECT CompanyName, FRAStockTicker, GoogFinURLFRA, ID, FRADividend FROM dax30
        WHERE ID < 11";
*/
// code to check trading
if (checkTrading('OTC')) {
  //$result=$conn->query($sql);

  //while($row = $result->fetch_assoc()) {

  $url = "https://www.google.com/finance?q=INDEXDJX%3.DJI";
  //$url = 'https://www.google.com/finance?q=FRA%3AADS';
  $dow_curl = curl_init();

  curl_setopt($dow_curl, CURLOPT_URL, $url);
  //no header
  curl_setopt($dow_curl, CURLOPT_HEADER, 0);
  //return results instead of outputting
  curl_setopt($dow_curl, CURLOPT_RETURNTRANSFER, 1);

  if (!$dow_page=curl_exec($dow_curl)) {
    die('Error: "'.curl_error($dow_curl).'" - Code '.curl_errno($dow_curl));
    curl_close($dow_curl);
  } else {
    curl_close($dow_curl);
    //echo "worked:";
  }
/*
  //parse for dividend yield
  $pos=strpos($fra_page, 'Div/yield');
  $str1=substr($fra_page, $pos, 100);
  $pieces = explode("/",$str1);
  $yld=floatval(substr($pieces[3],0,4));
  */
  //Find and parse price string
  $pos=strpos($dow_page, 'meta itemprop="price"');
  $str1=substr($dow_page, $pos, 100);
  $pieces = explode('"',$str1);
  //$yld=round(100*($row['FRADividend']/$price),2);
  //$dax_id=$row['ID'];
    //insert statement

    //temp echo to test logic
    //echo "DAX: ".$row['OTCStotckTicker']."; Price: ".$price."<BR>\n";
    $sql_ins = "INSERT into dailyIndices
       (ID, currDate, Price)
       VALUES
       ('DOW', now(), $price)";
    //echo $sql_ins."<BR><BR>\n";
    $res_ins=$conn->query($sql_ins);

}

$conn->close();

?>
