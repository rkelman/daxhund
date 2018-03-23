<?php
include 'php/connection.php';
include 'php/divrates.php';
include 'php/functions.php';

$conn = connectDB();

if ($conn->connect_errno > 0) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT CompanyName, OTCStockTicker, GoogFinURLOTC, ID, OTCDividend FROM dax30";

$result=$conn->query($sql);

while($row = $result->fetch_assoc()) {
    $rowdiv = getCurrDiv($row['GoogFinURLOTC'],'FRA');
    //echo $row['OTCStockTicker'].": ".number_format((float)$rowdiv, 2, '.', '')." - ".number_format((float)$row['OTCDividend'], 2, '.', '')."<BR>\n";
    if ($rowdiv != $row['OTCDividend']) {
      //echo " - needs update<BR>\n";

      //DB - Updates, create entry in Div History, update dow30
      $ins_sql= "INSERT into daxDividendHistory
         (ID, StockTicker, Dividend, DivDate, MarketType)
         values
         (".$row['ID'].", '".$row['OTCStockTicker']."', $rowdiv, now(), 'OTC')";
      //echo "INS: ".$ins_sql." <BR>\n";
      $ins_divhist=$conn->query($ins_sql);

      $upd_sql="UPDATE dax30
         SET OTCDividend = $rowdiv
         where ID = ".$row['ID'];
      //echo "UPD: ".$upd_sql."<BR>\n";
      $upd_div=$conn->query($upd_sql);

      //send email notification
      $div_message = "Hi Robb,\n\nAs we discussed, I would let you know
      when I see dividend updates.  Today I noticed that ".$row['CompanyName'].", on the OTC exchange,
      has changed their dividend from ".$row['OTCDividend']." to ".$rowdiv.".\n\n
      I have updated the Daxhund Dow (DAX30, DaxDividendHistory) tables already.\n\nEnjoy, your personal assistant.";
      sendDaxMail('robb.kelman@gmail.com', 'Dividend Update', $div_message);

    }
}

$conn->close();
?>
