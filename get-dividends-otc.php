<?php

$servername = "mysql12.000webhost.com";
$user = "a8933301_dax";
$passwd = "d4x-H4nd";
$dbname = "a8933301_dax";

$conn = new mysqli($servername, $user, $passwd, $dbname);

if ($conn->connect_errno > 0) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT CompanyName, FRAStockTicker, OTCStockTicker, ID, GoogFinURLFRA, GoogFinURLOTC FROM dax30
    where ID NOT IN (10, 8, 11, 12)";
$result=$conn->query($sql);

while($row = $result->fetch_assoc()) {
  //$url_fra = "http://www.marketwatch.com/investing/stock/DAI?countrycode=DE";//".
  //$url_fra = 'https://www.google.com/finance?q=FRA%3ADAI';
  //$url_fra = $row['GoogFinURLFRA'];
  $url_otc = $row['GoogFinURLOTC'];

  //echo "FRA : ".$url_fra."<BR>\n";
  //echo "FRA :".$row['ID'].": ".$url_fra."<BR>\n";
  //echo "OTC ".$row['ID'].": ".$url_otc."<BR>\n";
  $otc_curl = curl_init();

  curl_setopt($otc_curl, CURLOPT_URL, $url_otc);
  //no header
  curl_setopt($otc_curl, CURLOPT_HEADER, 0);
  //return results instead of outputtingotc
  curl_setopt($otc_curl, CURLOPT_RETURNTRANSFER, 1);

  if (!$otc_page=curl_exec($otc_curl)) {
    die('Error: "'.curl_error($otc_curl).'" - Code '.curl_errno($otc_curl));
    curl_close($otc_curl);
  } else {
    curl_close($otc_curl);
    //echo "worked:";
  }

  //parse for dividend yield
  $key_str = 'Div/yield'; //Google Finance
  //$key_str = ">Dividend<"; //marketwatch
  $pos=strpos($otc_page, $key_str);
  $str1=substr($otc_page, $pos, 40);
  //echo $str1;
  $pieces = preg_split('/[<>\/]+/',$str1);
  //print_r($pieces);//troubleshooting
  $otc_div=$pieces[5];
  //echo "Stock: ".$row['CompanyName']."Test: ".$fra_div."<BR>\n";
  //Find and parse price string
  /*$pos=strpos($fra_page, 'meta itemprop="price"');
  $str1=substr($fra_page, $pos, 100);
  $pieces = explode('"',$str1);
  $price=floatval($pieces[3]);
  $dax_id=$row['ID'];
  //insert statement
  //temp echo to test logic */
  //echo $row['CompanyName']."; ".$row['OTCStockTicker'].": Yield: ".$yld."; Price: ".$price."<BR>\n";
  if ($otc_div != '&n') {
    $sql_ins = "Update dax30 set OTCDividend=".$otc_div." Where ID =".$row['ID'];
    echo $sql_ins."<BR><BR>\n";
    $res_ins=$conn->query($sql_ins);
  }
}

$conn->close();

?>
