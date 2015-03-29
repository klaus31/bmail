<?php
require_once(__DIR__ . '/BmailBirthday.php');
require_once(__DIR__ . '/BsummaryBirthday.php');
class ActionHandler {
  private $args;
  private $bmails;
  public function __construct(Array $args) {
    $this->args = $args;
    $string = file_get_contents(__DIR__ . '/bmails.json');
    $json = json_decode($string, true);
    $this->bmails = $json['bmails'];
  }
  public function run() {
    if($this->isSummary()) {
      $this->runSummary();
    } else {
      $this->runBmails();
    }
  }
  private function runSummary() {
    foreach($this->bmails as $bmail) {
      if($bmail['kind'] == 'birthday') {
        $bsummary = new BsummaryBirthday($bmail);
        $bsummary->run();
      } else {
        throw new Exception('invalid json');
        die();
      }
    }
  }
  private function isSummary() {
    return count($this->args) == 2 && $this->args[1] == 'summary';
  }
  private function runBmails() {
    foreach($this->bmails as $bmail) {
      if($bmail['kind'] == 'birthday') {
        $bmail = new BmailBirthday($bmail['receivers'], $bmail['events']);
        $bmail->run();
      } else {
        throw new Exception('invalid json');
        die();
     }
    }
  }
}
