<?php

declare(strict_types=1);

namespace App\Core\Observer;

use SplObserver;
use SplSubject;

/**
 * Observer,that who recieves news
 */
class Creator implements SplObserver
{
  private $name;

  private array $createdArticles = [];

  public function update(SplSubject $subject): void
  {
    $this->createdArticles[] = clone $subject;
  }

  public function getChangedUsers(): array
  {
    return $this->createdArticles;
  }

}
