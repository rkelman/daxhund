<?php
include_once('connection.php');
/*
function listing:
getRecentDate($mkt_type) - return $maxdate
getMonthAgo($currDate, $mkt_type) - returns closest trading date to a month ago
getPriorDay($currDate, $mkt_type) - returns closest trading prior to getRecentDate
getWeekAgo($currDate, $mkt_type) - returns closest trading date to a week ago
*/

function getRecentDate($mkt_type) {
  $conn=connectDB();

  //get most recent date
  $sql_date = "select max(currDate) from dailyPriceYield".$mkt_type;
  $res_date = $conn->query($sql_date);
  $date_row = $res_date->fetch_assoc();
  $max_date = $date_row['max(currDate)'];
  $conn->close();
  return $max_date;
}

function getMonthAgo($currDate, $mkt_type) {
  $gma_conn = connectDB();
  $month_ago = date("Y-m-d", strtotime("-1 month", strtotime($currDate)));
  //echo "Month Ago 1: ".$month_ago."<BR>";

  $sql_checkdate = "select yield from dailyPriceYield".$mkt_type." WHERE currDate = '".$month_ago."'";
  if (!$checkResult = $gma_conn->query($sql_checkdate)) {
      /* Oh no! The query failed. */
      echo "Sorry -- we are having issue with website provider";
  }
  //echo "Num Rows: ".$checkResult->num_rows."<BR>";
  while ($checkResult->num_rows == 0) {
    $month_ago = date("Y-m-d", strtotime("-1 day", strtotime($month_ago)));
    //echo "Month Ago n: ".$month_ago."<BR>";
    $sql_checkdate = "select yield from dailyPriceYield".$mkt_type." WHERE currDate = '".$month_ago."'";
    $checkResult = $gma_conn->query($sql_checkdate);
    //echo "Num Rows: ".$checkResult->num_rows."<BR>";
  }
  $gma_conn->close();
  return $month_ago;
}

function getPriorDay($currDate, $mkt_type) {
  $gpd_conn = connectDB();
  $prior_day = date("Y-m-d", strtotime("-1 day", strtotime($currDate)));
  //echo "Month Ago 1: ".$month_ago."<BR>";

  $sql_checkdate = "select yield from dailyPriceYield".$mkt_type." WHERE currDate = '".$prior_day."'";
  if (!$checkResult = $gpd_conn->query($sql_checkdate)) {
      /* Oh no! The query failed. */
      echo "Sorry -- we are having issue with website provider";
  }
  //echo "Num Rows: ".$checkResult->num_rows."<BR>";
  while ($checkResult->num_rows == 0) {
    $prior_day = date("Y-m-d", strtotime("-1 day", strtotime($prior_day)));
    //echo "Day Ago n: ".$prior_day."<BR>";
    $sql_checkdate = "select yield from dailyPriceYield".$mkt_type." WHERE currDate = '".$prior_day."'";
    $checkResult = $gpd_conn->query($sql_checkdate);
    //echo "Num Rows: ".$checkResult->num_rows."<BR>";
  }
  $gpd_conn->close();
  return $prior_day;
}

function getWeekAgo($currDate, $mkt_type) {
  $gwa_conn = connectDB();
  $week_ago = date("Y-m-d", strtotime("-1 week", strtotime($currDate)));
  //echo "Month Ago 1: ".$month_ago."<BR>";

  $sql_checkdate = "select yield from dailyPriceYield".$mkt_type." WHERE currDate = '".$week_ago."'";
  if (!$checkResult = $gwa_conn->query($sql_checkdate)) {
      /* Oh no! The query failed. */
      echo "Sorry -- we are having issue with website provider";
  }
  //echo "Num Rows: ".$checkResult->num_rows."<BR>";
  while ($checkResult->num_rows == 0) {
    $week_ago = date("Y-m-d", strtotime("-1 day", strtotime($week_ago)));
    //echo "Month Ago n: ".$month_ago."<BR>";
    $sql_checkdate = "select yield from dailyPriceYield".$mkt_type." WHERE currDate = '".$week_ago."'";
    $checkResult = $gwa_conn->query($sql_checkdate);
    //echo "Num Rows: ".$checkResult->num_rows."<BR>";
  }
  $gwa_conn->close();
  return $week_ago;
}
