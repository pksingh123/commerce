<?php

namespace Drupal\school;

use Drupal\Core\Entity\ContentEntityStorageBase;
use Drupal\school\Entity\SchoolInterface;
use Drupal\Core\Entity\Sql\SqlContentEntityStorage;

/**
 * Defines the school storage.
 */
class SchoolStorage extends SqlContentEntityStorage implements SchoolStorageInterface
{

  /**
   * {@inheritdoc}
   */
  public function loadDefault()
  {
    $query = $this->getQuery();
    $query->accessCheck(FALSE);
    $query
      ->sort('recognize', 'DESC')
      ->sort('sid', 'DESC')
      ->range(0, 1);
    $result = $query->execute();

    return $result ? $this->load(reset($result)) : NULL;
  }
}
