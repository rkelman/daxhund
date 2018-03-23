<?php

$servername = "mysql12.000webhost.com";
$user = "a8933301_dax";
$passwd = "d4x-H4nd";
$dbname = "a8933301_dax";

$conn = new mysqli($servername, $user, $passwd, $dbname);

if ($conn->connect_errno > 0) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT CompanyName, FRAStockTicker, OTCStockTicker, ID, GoogFinURLFRA FROM dax30
    where ID NOT IN (10, 8, 11, 25)";
$result=$conn->query($sql);

while($row = $result->fetch_assoc()) {
  //$url_fra = "http://www.marketwatch.com/investing/stock/DAI?countrycode=DE";//".
  //$url_fra = 'https://www.google.com/finance?q=FRA%3ADAI';
  $url_fra = $row['GoogFinURLFRA'];
  //$url_otc = "http://www.marketwatch.com/investing/stock/DDAIF";//.$row['OTCStockTicker'];

  //echo "FRA : ".$url_fra."<BR>\n";
  //echo "FRA :".$row['ID'].": ".$url_fra."<BR>\n";
  //echo "OTC ".$row['ID'].": ".$url_otc."<BR>\n";
  $fra_curl = curl_init();

  curl_setopt($fra_curl, CURLOPT_URL, $url_fra);
  //no header
  curl_setopt($fra_curl, CURLOPT_HEADER, 0);
  //return results instead of outputting
  curl_setopt($fra_curl, CURLOPT_RETURNTRANSFER, 1);

  if (!$fra_page=curl_exec($fra_curl)) {
    die('Error: "'.curl_error($fra_curl).'" - Code '.curl_errno($fra_curl));
    curl_close($fra_curl);
  } else {
    curl_close($fra_curl);
    //echo "worked:";
  }

  //parse for dividend yield
  $key_str = 'Div/yield'; //Google Finance
  //$key_str = ">Dividend<"; //marketwatch
  $pos=strpos($fra_page, $key_str);
  $str1=substr($fra_page, $pos, 40);
  //echo $str1;
  $pieces = preg_split('/[<>\/]+/',$str1);
  //print_r($pieces);//troubleshooting
  $fra_div=$pieces[5];
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
  $sql_ins = "Update dax30 set FRADividend=".$fra_div." Where ID =".$row['ID'].";";
  echo $sql_ins."<BR><BR>\n";
  $res_ins=$conn->query($sql_ins);

}

$conn->close();

?>
