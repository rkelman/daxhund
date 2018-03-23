<?php
include 'php/connection.php';
include 'php/divrates.php';
include 'php/functions.php';

$conn = connectDB();

if ($conn->connect_errno > 0) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT CompanyName, StockTicker, GoogFinURL, ID, Dividend FROM dow30";

$result=$conn->query($sql);

while($row = $result->fetch_assoc()) {
    $rowdiv = getCurrDiv($row['GoogFinURL'],'DOW');
    echo $row['StockTicker'].": ".$rowdiv." - ".$row['Dividend']."<BR>\n";
    if ($rowdiv != $row['Dividend']) {
      echo $row['StockTicker']." - needs update<BR>\n";

      //DB - Updates, create entry in Div History, update dow30
      $ins_sql= "INSERT into dowDividendHistory
         (ID, StockTicker, Dividend, DivDate)
         values
         (".$row['ID'].", '".$row['StockTicker']."', $rowdiv, now())";
      //echo ": ".$ins_sql." ";
      $ins_divhist=$conn->query($ins_sql);

      $upd_sql="UPDATE dow30
         SET Dividend = $rowdiv
         where ID = ".$row['ID'];
      //echo ": ".$upd_sql."<BR>\n";
      $upd_div=$conn->query($upd_sql);

      //send email notification
      $div_message = "Hi Robb,\n\nAs we discussed, I would let you know
      when I see dividend updates.  Today I noticed that ".$row['CompanyName']."
      has changed their dividend from ".$row['Dividend']." to ".$rowdiv.".\n\n
      I have updated the Daxhund Dow (Dow30, DowDividendHistory) tables already.\n\nEnjoy, your personal assistant.";
      sendDaxMail('robb.kelman@gmail.com', 'Dividend Update', $div_message);
    }
}

$conn->close();
?>
