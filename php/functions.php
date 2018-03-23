<?php
include_once('connection.php');
/*
function listing:
sendDaxMail($to, $subject, $message)- no return
getCurrPrice($url) - return $price
getMA($ID, $DMA_length, $mkt_type) - return $ma_row['moving_avg']
checkTrading($url) - return 1 (if trading happened) 0 (if no trading)
tofloat($num) - returns proper float
*/
function sendDaxMail($to, $subject, $message) {
  $headers = 'From: DaxHund Assistant <info@daxhund.com>' . "\r\n" .
    'Reply-To: info@daxhund.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  mail($to, $subject, $message, $headers);
}

function getCurrPrice($url){
  $stock_curl = curl_init();

  curl_setopt($stock_curl, CURLOPT_URL, $url);
  //no header
  curl_setopt($stock_curl, CURLOPT_HEADER, 0);
  //return results instead of outputting
  curl_setopt($stock_curl, CURLOPT_RETURNTRANSFER, 1);
  if (!$stock_page=curl_exec($stock_curl)) {
    die('getCurrPrice Error: "'.curl_error($stock_curl).'" - Code '.curl_errno($stock_curl));
    curl_close($stock_curl);
  } else {
    curl_close($stock_curl);
    //echo "worked:";
  }
  //Find and parse price string
  $pos=strpos($stock_page, 'meta itemprop="price"');
  $str1=substr($stock_page, $pos, 100);
  $pieces = explode('"',$str1);
  //troubleshooting scraping (when Google changed URL)
  //echo "pos: ".$pos;
  //echo $pieces[1];
  //echo $pieces[2];
  //echo $pieces[3];
  $price=floatval($pieces[3]);
  return $price;
}

function getMA($ID, $DMA_length, $mkt_type) {
  $conn=connectDB();

  $ma_sql = "SELECT AVG(a.Price) AS moving_avg
    FROM (SELECT Price FROM dailyPriceYield".$mkt_type." WHERE ID=".$ID." ORDER BY CurrDate DESC LIMIT $DMA_length) a";
  $res_ma=$conn->query($ma_sql);
  $ma_row = $res_ma->fetch_assoc();
  $conn->close();
  return $ma_row['moving_avg'];
}

function checkTrading($mkt_type) {
  //if today is a Saturday - return 0
  if (date('D') == 'Sat') {
    return 0;
  } else if (date('D') == 'Sun') {
  //if today is a Sunday - return 0
    //echo "Sunday";
    return 0;
  }

  //if today is a mkt holiday return 0
  $today = date('Y-m-d');
  $conn = connectDB();

  $sql="SELECT Market, HolidayDate, Holiday FROM marketHolidays where Market = '".$mkt_type."' and HolidayDate = '".$today."'";
  //echo $sql;
  $holiday_res=$conn->query($sql);
  if ($holiday_res->num_rows > 0) {
    $conn->close();
    return 0;
  } else {
    $conn->close();
    return 1;
  }
}

function tofloat($num) {
    $dotPos = strrpos($num, '.');
    $commaPos = strrpos($num, ',');
    $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
        ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

    if (!$sep) {
        return floatval(preg_replace("/[^0-9]/", "", $num));
    }

    return floatval(
        preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
        preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
    );
}
?>
