<?php
include_once ('php/functions.php');

$conn = connectDB();

if ($conn->connect_errno > 0) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT CompanyName, FRAStockTicker, GoogFinURLFRA, ID, FRADividend FROM dax30";

// code to check trading
if (checkTrading('FRA')) {
  $result=$conn->query($sql);

  while($row = $result->fetch_assoc()) {

    $price = getCurrPrice($row['GoogFinURLFRA']);
    $yld=round(100*($row['FRADividend']/$price),2);
    $dax_id=$row['ID'];
    //insert statement

    //temp echo to test logic
    //echo $row['CompanyName']."; ".$row['OTCStotckTicker'].": Yield: ".$yld."; Price: ".$price."<BR>\n";
    $sql_ins = "INSERT into dailyPriceYieldFRA
       (ID, currDate, Yield, Price)
       VALUES
       ('$dax_id', now(), $yld, $price)";
    //echo $sql_ins."<BR><BR>\n";
    $res_ins=$conn->query($sql_ins);
  }
}

$conn->close();

?>
