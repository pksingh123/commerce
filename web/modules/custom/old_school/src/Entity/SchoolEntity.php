<?php

namespace Drupal\school\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the SchoolEntity entity.
 *
 * @ContentEntityType(
 *   id = "school",
 *   label = @Translation("school Entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\school\Entity\Controller\SchoolEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\school\Form\SchoolEntityForm",
 *       "edit" = "Drupal\school\Form\SchoolEntityForm",
 *       "delete" = "Drupal\school\Form\SchoolEntityDeleteForm"
 *     },
 *     "access" = "Drupal\school\SchoolEntityAccessControlHandler",
 *   },
 *   base_table = "school",
 *   admin_permission = "administer example entity",
 *   translatable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "label" = "name",
 *     "langcode" = "langcode",
 *     "bundle" = "type",
 *   },
 *   links = {
 *     "canonical" = "/school/{school}",
 *     "add-page" = "/school/add",
 *     "edit-form" = "/school/{school}/edit",
 *     "delete-form" = "/school/{school}/delete",
 *     "collection" = "/admin/school",
 *   },
 * )
 */
class SchoolEntity extends ContentEntityBase implements ContentEntityInterface {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add your custom fields here.
    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the school entity.'))
      ->setRequired(true)
      ->setSetting('max_length', 255);

    // Add more fields as needed.

    return $fields;
  }
}
