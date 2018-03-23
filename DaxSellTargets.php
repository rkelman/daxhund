<?php

include_once 'php/functions.php';
connectDaxDB();

$DaxTargets = getDaxTargets();

while($row = $DaxTargets->fetch_assoc()) {
  if (getCurrPrice($row['url'])>=$row['sellTarget'] {
    $message = $row['companyName']." crossed or hit target of ".$row['sellTarget'];
    sendDaxMail('robb.kelman@gmail.com', 'Sell Target Hit', $message)
  }
}
  
?>
