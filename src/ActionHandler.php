<?php
require_once(__DIR__ . '/BmailsController.php');
require_once(__DIR__ . '/BmailBirthday.php');
require_once(__DIR__ . '/BsummaryBirthday.php');
class ActionHandler {
  private $ctrl;
  public function __construct() {
    $this->ctrl = BmailsController::me();
  }
  public function run() {
    if($this->ctrl->isSummary()) {
      $this->runSummary();
    } else {
      $this->runBmails();
    }
  }
  private function runSummary() {
    foreach($this->ctrl->getBmails() as $bmail) {
      if($bmail['kind'] == 'birthday') {
        $bsummary = new BsummaryBirthday($bmail);
        $bsummary->run();
      } else {
        throw new Exception('invalid json');
        die();
      }
    }
  }
  private function runBmails() {
    foreach($this->ctrl->getBmails() as $bmail) {
      if($bmail['kind'] == 'birthday') {
        $bmail = new BmailBirthday($bmail);
        $bmail->run();
      } else {
        throw new Exception('invalid json');
        die();
     }
    }
  }
}
