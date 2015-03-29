<?php
abstract class Bmail {
  protected $events;
  protected $receivers;
  public function __construct(Array $bmail) {
    $this->receivers = $bmail['receivers'];
    $this->events = $bmail['events'];
    usort($this->receivers, array('Bmail', 'sortReceivers'));
    usort($this->events, array('Bmail', 'sortEvents'));
  }
  public abstract function run();
  protected function createDateTime($event) {
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
}
