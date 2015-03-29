<?php
class BsummaryBirthday {
  private $receivers;
  private $events;
  public function __construct(Array $bmail) {
    usort($bmail['receivers'], array('BsummaryBirthday', 'sortReceivers'));
    usort($bmail['events'], array('BsummaryBirthday', 'sortEvents'));
    $this->receivers = $bmail['receivers'];
    $this->events = $bmail['events'];
  }
  public function run() {
    $this->lineSep();
    $this->line('BIRTHDAYS');
    $this->lineSep();
    foreach($this->receivers as $receiver) {
      $this->line('receiver: ' . strtolower($receiver));
    }
    $this->lineSep();
    foreach($this->events as $event) {
      $this->line($this->createDateTime($event)->format('d.m.Y') . ': ' . $event['name']);
    }
    $this->lineSep();
  }
  private function createDateTime($event) {
    return DateTime::createFromFormat('Y-m-d', $event['date']);
  }
  private function sortEvents($eventA, $eventB) {
    $dateA = $this->createDateTime($eventA);
    $dateB = $this->createDateTime($eventB);
    return $dateA->format('md') > $dateB->format('md');
  }
  private function sortReceivers($receiverA, $receiverB) {
    return strcasecmp($receiverA, $receiverB);
  }
  private function lineSep() {
    $this->line('---------');
  }
  private function line($line) {
    echo $line . PHP_EOL;
  }
}
