<?php

namespace Drupal\school;

use Drupal\school\Entity\SchoolInterface;
use Drupal\Core\Entity\ContentEntityStorageInterface;

/**
 * Defines the interface for school storage.
 */
interface SchoolStorageInterface extends ContentEntityStorageInterface
{

  /**
   * Loads the default school.
   *
   * @return \Drupal\school\Entity\SchoolInterface|null
   *   The default school, if known.
   */
  public function loadDefault();

  /**
   * Marks the provided school as the default.
   *
   * @param \Drupal\school\Entity\SchoolInterface $school
   *   The new default school.
   *
   */
  #public function markAsDefault(SchoolInterface $school);
}
