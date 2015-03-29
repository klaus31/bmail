<?php
require_once(__DIR__ . '/Bmail.php');
class BsummaryBirthday extends Bmail {
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
  private function lineSep() {
    $this->line('---------');
  }
  private function line($line) {
    echo $line . PHP_EOL;
  }
}
