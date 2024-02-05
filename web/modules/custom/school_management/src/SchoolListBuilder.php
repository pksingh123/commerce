<?php

namespace Drupal\school;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines the list builder for schools.
 */
class SchoolListBuilder extends EntityListBuilder
{

  /**
   * {@inheritdoc}
   */
  public function buildHeader()
  {
    $header['name'] = $this->t('Name');
    #$header['type'] = $this->t('Type');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity)
  {
    /** @var \Drupal\school\Entity\SchoolInterface $entity */

    $row['name']['data'] = Link::fromTextAndUrl($entity->label(), $entity->toUrl());


    return $row + parent::buildRow($entity);
  }
}
