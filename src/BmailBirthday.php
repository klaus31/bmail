<?php
class BmailBirthday {
  private $events;
  private $receivers;
  private function getMessage($event) {
    return $event['name'] . " hat heute Geburtstag\n";
  }
  private function isCurrent($event) {
    $date = DateTime::createFromFormat('Y-m-d', $event['date']);
    $today = new DateTime();
    return $today->format('md') == $date->format('md');
  }
  public function __construct(Array $receivers, Array $events) {
    $this->receivers = $receivers;
    $this->events = $events;
  }
  public function run() {
    $message = '';
    foreach($this->events as $event) {
      if($this->isCurrent($event)) {
        $message .= $this->getMessage($event);
      }
    }
    if(!empty($message)) {
      foreach($this->receivers as $receiver) {
       	$mailHeader = 'From: ' . $receiver . "\r\n";
        $mailHeader .= 'Content-Type: text/plain; charset=utf-8';
        mail($receiver, 'Geburtstag', $message, $mailHeader);
      }
    }
  }
}
