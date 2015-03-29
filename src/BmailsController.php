<?php
class BmailsController {
  private static $me = null;
  private $args;
  private $bmails;
  public $config;
  private function __construct(Array $args) {
    $this->args = $args;
    $string = file_get_contents(__DIR__ . '/bmails.json');
    $json = json_decode($string, true);
    $this->bmails = $json['bmails'];
    $this->config = $json['config'];
  }
  public function getBmails() {
    return $this->bmails;
  }
  public function isSummary() {
    return count($this->args) == 2 && $this->args[1] == 'summary';
  }
  public function isTest() {
    return count($this->args) == 2 && $this->args[1] == 'test';
  }
  final public static function me(Array $args = null) {
    if(self::$me == null) {
      if($args == null) {
        throw new Exception('args must not be null on first call');
        die();
      }
      self::$me = new BmailsController($args);
    }
    return self::$me;
  }
  final public function __clone() {
    throw new Exception('Singleton not clonable.');
  }
}