<?php
include 'php/connection.php';
include 'php/divrates.php';
include 'php/functions.php';

$conn = connectDB();

if ($conn->connect_errno > 0) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT CompanyName, FRAStockTicker, GoogFinURLFRA, ID, FRADividend FROM dax30";

$result=$conn->query($sql);

while($row = $result->fetch_assoc()) {
    $rowdiv = getCurrDiv($row['GoogFinURLFRA'],'FRA');
    //echo $row['FRAStockTicker'].": ".number_format((float)$rowdiv, 2, '.', '')." - ".number_format((float)$row['FRADividend'], 2, '.', '')."<BR>\n";
    if ($rowdiv != $row['FRADividend']) {
      //echo " - needs update<BR>\n";

      //DB - Updates, create entry in Div History, update dow30
      $ins_sql= "INSERT into daxDividendHistory
         (ID, StockTicker, Dividend, DivDate, MarketType)
         values
         (".$row['ID'].", '".$row['FRAStockTicker']."', $rowdiv, now(), 'FRA')";
      //echo "INS: ".$ins_sql." <BR>\n";
      $ins_divhist=$conn->query($ins_sql);

      $upd_sql="UPDATE dax30
         SET FRADividend = $rowdiv
         where ID = ".$row['ID'];
      //echo "UPD: ".$upd_sql."<BR>\n";
      $upd_div=$conn->query($upd_sql);

      //send email notification
      $div_message = "Hi Robb,\n\nAs we discussed, I would let you know
      when I see dividend updates.  Today I noticed that ".$row['CompanyName'].", on the FRA exchange,
      has changed their dividend from ".$row['FRADividend']." to ".$rowdiv.".\n\n
      I have updated the Daxhund Dow (DAX30, DaxDividendHistory) tables already.\n\nEnjoy, your personal assistant.";
      sendDaxMail('robb.kelman@gmail.com', 'Dividend Update', $div_message);

    }
}

$conn->close();
?>
