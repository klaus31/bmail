<?php
require_once(__DIR__ . '/Bmail.php');
class BmailBirthday extends Bmail {
  public function run() {
    $message = '';
    $ctrl = BmailsController::me();
    foreach($this->events as $event) {
      if($this->isCurrent($event)) {
        $message .= $this->getMessage($event);
      }
    }
    if(!empty($message)) {
      $message .= $this->getNextEvents();
      $mailHeader = 'From: ' . $ctrl->config['from'] . PHP_EOL;
      $mailHeader .= 'Content-Type: text/plain; charset=utf-8';
      $subject = 'Geburtstag';
      if($ctrl->isTest()) {
        echo 'Subject: ' . $subject . PHP_EOL;
        echo "Header: $mailHeader" . PHP_EOL;
        echo 'Message:' . PHP_EOL . $message . PHP_EOL . PHP_EOL;
        echo 'Receivers: ' . implode(',', $this->receivers) . PHP_EOL;
      } else {
        foreach($this->receivers as $receiver) {
          mail($receiver, $subject, $message, $mailHeader);
        }
      }
    }
  }
  private function getMessage($event) {
    return $event['name'] . ' hat heute ' . $this->getAge($event) . ' mal die Sonne umrundet' . PHP_EOL;
  }
  private function getAge($event) {
    return date('Y') - $this->createDateTime($event)->format('Y');
  }
  private function getNextEvents() {
    $result = PHP_EOL . 'Next:' . PHP_EOL;
    $nextEvents = array();
    $today = new DateTime();
    foreach($this->events as $event) {
      $date = $this->createDateTime($event);
      if(count($nextEvents) < 5 && $today->format('md') < $date->format('md')) {
        $nextEvents[] = $event;
      }
    }
    if(count($nextEvents) < 5) {
      $nextEvents[] = $this->events[0];
    }
    foreach($nextEvents as $nextEvent) {
      $result .= $this->createDateTime($nextEvent)->format('d.m.Y') . ': ' . $nextEvent['name'] . PHP_EOL;
    }
    return $result;
  }
  private function isCurrent($event) {
    $date = $this->createDateTime($event);
    $today = new DateTime();
    return $today->format('md') == $date->format('md');
  }
}
