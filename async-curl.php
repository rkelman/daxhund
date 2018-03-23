<?php
private function request($url, $payload) {

  $cmd = "curl -X POST -H 'Content-Type: application/json'";
  $cmd.= /*" -d '" . $payload . "' " . */"'" . $url . "'";

  if (!$this->debug()) {
    $cmd .= " > /dev/null 2>&1 &";
  }

  exec($cmd, $output, $exit);
  return $exit == 0;
}

request('http://www.daxhund.com/curl-scraper.php?type=OTC&id=1','')
?>
