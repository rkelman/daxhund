<?php
include "php/functions.php";
include "php/date_functions.php";

$conn = connectDB();

if ($conn->connect_errno > 0) {
    die("Connection failed: " . $conn->connect_error);
}

//check if FRA Markets were open/scraped today
if (checkTrading('FRA')) {
  //get all 30 DAX co
  $max_date = getRecentDate('OTC');

  $sql = "SELECT dpyf.ID ID, dpyf.Yield Yield, dpyf.Price, dpyf.currDate
      FROM dailyPriceYieldFRA dpyf
      WHERE dpyf.currDate = '".$max_date."'
      ORDER BY dpyf.Yield Desc";

  if (!$result = $conn->query($sql)) {
    /* Oh no! The query failed. */
    echo "Sorry, the website is experiencing problems.";
  }
  //echo $result->num_rows;

  $rank=1;
  //echo "FRA: <BR>";
  while($row = $result->fetch_assoc()) {
    //update FRA ranking
    //echo $rank.": ID:".$row['ID']." Yield: ".$row['Yield']."<BR>";
    $sql_upd = "UPDATE dailyPriceYieldFRA
       SET  Ranking = ".$rank."
       WHERE ID = ".$row['ID']."
         AND currDate = '".$max_date."'";
    //echo $sql_ins."<BR><BR>\n";
    $res_ins=$conn->query($sql_upd);
    $rank++;
  }
}

//check if OTC Markets were open/scraped today
if (checkTrading('OTC')) {
  //get all 30 DAX co
  $max_date = getRecentDate('OTC');

  $sql = "SELECT dpyf.ID ID, dpyf.Yield Yield, dpyf.Price, dpyf.currDate
      FROM dailyPriceYieldOTC dpyf
      WHERE dpyf.currDate = '".$max_date."'
      ORDER BY dpyf.Yield Desc";

  if (!$result = $conn->query($sql)) {
    /* Oh no! The query failed. */
    echo "Sorry, the website is experiencing problems.";
  }
  $rank=1;
  //echo "<BR>OTC: <BR>";
  while($row = $result->fetch_assoc()) {
    //echo $rank.": ID:".$row['ID']." Yield: ".$row['Yield']."<BR>";
    //update OTC ranking
    $sql_upd = "UPDATE dailyPriceYieldOTC
       SET  Ranking = ".$rank."
       WHERE ID = ".$row['ID']."
         AND currDate = '".$max_date."'";
    //echo "<BR>".$sql_upd."\n";
    if (!$res_ins=$conn->query($sql_upd)) {
      echo "Sorry, the website is experiencing problems - query didn't work";
    }
    $rank++;
  }
}

//check if OTC Markets were open/scraped today
if (checkTrading('OTC')) {
  //get all 30 DAX co
  $max_date = getRecentDate('OTC');

  $sql = "SELECT dpyd.ID ID, dpyd.Yield Yield, dpyd.Price, dpyd.currDate
      FROM dailyPriceYieldDOW dpyd
      WHERE dpyd.currDate = '".$max_date."'
      ORDER BY dpyd.Yield Desc";

  if (!$result = $conn->query($sql)) {
    /* Oh no! The query failed. */
    echo "Sorry, the website is experiencing problems.";
  }
  $rank=1;
  //echo "<BR>OTC: <BR>";
  while($row = $result->fetch_assoc()) {
    //echo $rank.": ID:".$row['ID']." Yield: ".$row['Yield']."<BR>";
    //update OTC ranking
    $sql_upd = "UPDATE dailyPriceYieldDOW
       SET  Ranking = ".$rank."
       WHERE ID = ".$row['ID']."
         AND currDate = '".$max_date."'";
    //echo "<BR>".$sql_upd."\n";
    if (!$res_ins=$conn->query($sql_upd)) {
      echo "Sorry, the website is experiencing problems - query didn't work";
    }
    $rank++;
  }
}

$conn->close();
?>
