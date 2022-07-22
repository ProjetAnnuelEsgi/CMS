<?php

declare(strict_types=1);

namespace App\Core\Observer;

use SplObjectStorage;
use SplObserver;
use SplSubject;

class Article implements SplSubject
{
  private SplObjectStorage $observers;
  private $name;
  // private $observers = array();
  private $content;

  // public function __construct($name)
  // {
  //   $this->name = $name;
  // }

  public function __construct()
  {
    $this->observers = new SplObjectStorage();
  }

  //add observer
  public function attach(SplObserver $observer): void
  {
    // $this->observers[] = $observer;
    $this->observers->attach($observer);
  }

  //remove observer
  public function detach(SplObserver $observer): void
  {

    // $key = array_search($observer, $this->observers, true);
    // if ($key) {
    //   unset($this->observers[$key]);
    // }

    $this->observers->detach($observer);
  }

  //set breakouts news
  public function breakOutNews($content)
  {
    $this->content = $content;
    $this->notify();
  }

  public function getContent()
  {
    return $this->content . " ({$this->name})";
  }

  //notify observers(or some of them)
  public function notify(): void
  {
    foreach ($this->observers as $value) {
      $value->update($this);
    }
  }
}
