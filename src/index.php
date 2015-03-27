<?php
require_once(__DIR__ . '/BmailBirthday.php');
$string = file_get_contents(__DIR__ . '/bmails.json');
$json = json_decode($string, true);
$bmails = $json['bmails'];
foreach($bmails as $bmail) {
  if($bmail['kind'] == 'birthday') {
    $bmail = new BmailBirthday($bmail['receivers'], $bmail['events']);
    $bmail->run();
  } else {
    echo 'nope';
  }
}