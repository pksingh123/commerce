<?php

namespace Drupal\school;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Access controller for the School entity.
 */
class SchoolEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    switch ($operation) {
      case 'view':
        return parent::checkAccess($entity, $operation, $account);

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'administer school entity');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'administer school entity');

      default:
        return AccessResult::neutral();
    }
  }
}
