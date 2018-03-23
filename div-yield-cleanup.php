<?php
include_once '../php/date_functions.php';

$recentDate=getRecentDate('FRA');
$deleteDate= date("Y-m-d", strtotime("-11 month", strtotime($recentDate)));

$conn=connectDB();

$clean_sql = "DELETE FROM dailPriceYieldFRA WHERE currDate < $deleteDate";
$clean_res=$conn->query($clean_sql);

//assume same current date between FRA and OTC
$clean_sql="DELETE FROM dailyPriceYieldOTC where currDate < '".$deleteDate."'";
$clean_res=$conn->query($clean_sql);

$conn->close();

?>
