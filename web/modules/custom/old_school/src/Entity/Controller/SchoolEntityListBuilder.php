<?php

namespace Drupal\school\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Provides a list controller for SchoolEntity entity.
 */
class SchoolEntityListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['name'] = $this->t('Name');
    // Add more header columns as needed.

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['id'] = $entity->id();
    $row['name'] = $entity->label();
    // Add more row values as needed.

    return $row + parent::buildRow($entity);
  }

}
