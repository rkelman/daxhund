<?php

function getCurrDiv($url, $mkt_type) {
  $stock_curl = curl_init();
  curl_setopt($stock_curl, CURLOPT_URL, $url);
  //no header
  curl_setopt($stock_curl, CURLOPT_HEADER, 0);
  //return results instead of outputting
  curl_setopt($stock_curl, CURLOPT_RETURNTRANSFER, 1);
  if (!$stock_page=curl_exec($stock_curl)) {
    die('getCurrDiv Error: "'.curl_error($stock_curl).'" - Code '.curl_errno($stock_curl));
    curl_close($stock_curl);
  } else {
    curl_close($stock_curl);
    //echo "worked:";
  }

  //Find and parse price string
  $pos=strpos($stock_page, 'Div/yield');
  //troubleshooting
  //echo "> pos: ".$pos."<BR>\n";

  $str1=substr($stock_page, $pos, 75);
  //troubleshooting
  //echo "string: ".$str1."<BR>";

  $pieces = explode(">",$str1);
  //troubleshooting scraping (when Google changed URL)
  //echo "0: ".$pieces[0];
  //echo "1: ".$pieces[1];
  //echo "2: ".$pieces[2];
  //echo "3: ".$pieces[3];
  //echo "4: ".$pieces[4];
  //echo "5: ".$pieces[5];
  //echo "6: ".$pieces[6]."<BR>\n";

  $divpieces=explode("/",$pieces[2]);
  //troubleshooting
  //echo "2-0: ".$divpieces[0];
  //echo "2-1: ".$divpieces[1]."<BR>\n";

  if ($mkt_type == "DOW") {
    //echo "val: ".floatval($divpieces[0]);
    $div = floatval($divpieces[0])*4;
  } else {
    $div = floatval($divpieces[0]);
  }
  //echo "Dividend: ".$div."<BR>\n";
  return $div;
}


?>
