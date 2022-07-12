<?php

namespace App\Core;

/**
 * Logger class
 * Singleton using lazy instantiation
 */
class Logger
{
  private static $instance = NULL;
  private $logs;

  private function __construct()
  {
    $this->logs = [];
  }

  /**
   * Gets instance of the Logger
   * @return Logger instance
   * @access public
   */
  public static function getInstance()
  {
    if (self::$instance === NULL) {
      self::$instance = new Logger();
    }
    return self::$instance;
  }

  /**
   * Adds a message to the log
   * @param String $message Message to be logged
   * @access public
   */
  public function log($message)
  {
    $file = "cms.log";

    if (!file_exists($file)) {
      file_put_contents($file, '');
    }

    $ip = $_SERVER['REMOTE_ADDR'];

    date_default_timezone_set('Europe/Paris');
    $time = date('d/m/y h.iA', time());

    $contents = file_get_contents($file);
    $contents .= "$ip\t$time\t$message";

    file_put_contents($file, $contents);

    $this->logs[] = $contents;
  }

  /**
   * Returns array of logs
   * @return array Array of log messages
   * @access public
   */
  public function get_logs()
  {
    return $this->logs;
  }
};
