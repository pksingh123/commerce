<?php

namespace Drupal\school\Entity;

use CommerceGuys\Addressing\AddressFormat\AddressField;
use CommerceGuys\Addressing\AddressFormat\FieldOverride;
use Drupal\address\AddressInterface;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\school\EntityOwnerTrait;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the school entity class.
 *
 * @ContentEntityType(
 *   id = "school",
 *   label = @Translation("school", context = "School"),
 *   label_collection = @Translation("schools", context = "School"),
 *   label_singular = @Translation("school", context = "School"),
 *   label_plural = @Translation("schools", context = "School"),
 *   label_count = @PluralTranslation(
 *     singular = "@count school",
 *     plural = "@count school",
 *     context = "school",
 *   ),
 *   handlers = {
 *     "storage" = "Drupal\school\SchoolStorage",
 *     "access" = "Drupal\entity\EntityAccessControlHandler",
 *     "query_access" = "Drupal\entity\QueryAccess\QueryAccessHandler",
 *     "permission_provider" = "Drupal\entity\EntityPermissionProvider",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\school\SchoolListBuilder",
 *     "views_data" = "Drupal\school\SchoolEntityViewsData",
 *     "form" = {
 *       "default" = "Drupal\school\Form\SchoolForm",
 *       "add" = "Drupal\school\Form\SchoolForm",
 *       "edit" = "Drupal\school\Form\SchoolForm",
 *       "duplicate" = "Drupal\school\Form\SchoolForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "local_task_provider" = {
 *       "default" = "Drupal\entity\Menu\DefaultEntityLocalTaskProvider",
 *     },
 *     "route_provider" = {
 *       "default" = "Drupal\entity\Routing\AdminHtmlRouteProvider",
 *       "delete-multiple" = "Drupal\entity\Routing\DeleteMultipleRouteProvider",
 *     },
 *     "translation" = "Drupal\content_translation\ContentTranslationHandler"
 *   },
 *   base_table = "school",
 *   data_table = "school_field_data",
 *   admin_permission = "administer school entities",
 *   permission_granularity = "bundle",
 *   translatable = TRUE,
 *   entity_keys = {
 *     "id" = "sid",
 *     "uuid" = "uuid",
 *     "bundle" = "bundle",
 *     "label" = "name",
 *     "langcode" = "langcode",
 *     "owner" = "uid",
 *     "uid" = "uid",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/school/{school}",
 *     "add-page" = "/school/add",
 *     "edit-form" = "/school/{school}/edit",
 *     "duplicate-form" = "/school/{school}/duplicate",
 *     "delete-form" = "/school/{school}/delete",
 *     "delete-multiple-form" = "/admin/school/config/schools/delete",
 *     "collection" = "/school/commerce/config/schools",
 *   },
 *   
 *   bundle_entity_type = "school_type",
 *   field_ui_base_route = "entity.school_type.edit_form",
 *   
 * )
 */
class School extends ContentEntityBase implements SchoolInterface
{

    use EntityOwnerTrait;
    use EntityChangedTrait;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->get('name')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->set('name', $name);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        $email = $this->get('mail')->value;
        // Defaults to the site email if the school email isn't set.
        if (empty($email)) {
            $email = \Drupal::config('system.site')->get('mail') ?: ini_get('sendmail_from');
        }

        return $email;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmailFromHeader()
    {
        // Ensure "," and ";" are removed from the school name.
        $name = str_replace([',', ';'], '', $this->getName());
        return sprintf('%s <%s>', $name, $this->getEmail());
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail($mail)
    {
        $this->set('mail', $mail);
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function getRegistrationNumber()
    {
        return $this->get('registration_number')->value;
    }
    /**
     * {@inheritdoc}
     */
    public function setRegistrationNumber($registration_number)
    {
        $this->set('registration_number', $registration_number);
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function getPhoneNumber()
    {
        return $this->get('phone_number')->value;
    }
    /**
     * {@inheritdoc}
     */
    public function setPhoneNumber($phone_number)
    {
        $this->set('phone_number', $phone_number);
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function getMobile()
    {
        return $this->get('mobile')->value;
    }
    /**
     * {@inheritdoc}
     */
    public function setMobile($mobile)
    {
        $this->set('mobile', $mobile);
        return $this;
    }
    public function getEstablishedDate()
    {
        return $this->get('established_date')->value;
    }
    /**
     * {@inheritdoc}
     */
    public function setEstablishedDate($established_date)
    {
        $this->set('established_date', $established_date);
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->get('school_type')->value;
    }
    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->set('school_type', $type);
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function getBoard()
    {
        return $this->get('board')->value;
    }
    /**
     * {@inheritdoc}
     */
    public function setBoard($board)
    {
        $this->set('board', $board);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRecognize()
    {
        return (bool) $this->get('recognize')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setRecognize($recognize)
    {
        $this->set('recognize', (bool) $recognize);
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function getPattern()
    {
        return $this->get('pattern')->value;
    }
    /**
     * {@inheritdoc}
     */
    public function setPattern($pattern)
    {
        $this->set('pattern', $pattern);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress()
    {
        return $this->get('address')->first();
    }

    /**
     * {@inheritdoc}
     */
    public function setAddress(AddressInterface $address)
    {
        // $this->set('address', $address) results in the address being appended
        // to the item list, instead of replacing the existing first item.
        $this->address = $address;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLogo()
    {
        return $this->get('school_logo')->entity;
    }
    /**
     * {@inheritdoc}
     */
    public function setLogo($logo)
    {
        $this->set('school_logo', $logo);
    }
    /**
     * {@inheritdoc}
     */
    public function getCreatedTime()
    {
        return $this->get('created')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedTime($timestamp)
    {
        $this->set('created', $timestamp);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function preSave(EntityStorageInterface $storage)
    {
        parent::preSave($storage);

        foreach (array_keys($this->getTranslationLanguages()) as $langcode) {
            $translation = $this->getTranslation($langcode);

            // Explicitly set the owner ID to 0 if the translation owner is anonymous
            // (This will ensure we don't school a broken reference in case the user
            // no longer exists).
            if ($translation->getOwner()->isAnonymous()) {
                $translation->setOwnerId(0);
            }
        }
    }



    /**
     * {@inheritdoc}
     */
    public function postSave(EntityStorageInterface $storage, $update = TRUE)
    {
        /** @var \Drupal\school\SchoolStorage $storage */
        parent::postSave($storage, $update);

        $default = $this->getRecognize();
        $original_default = $this->original ? $this->original->getRecognize() : FALSE;
        if ($default && !$original_default) {
            // The store was set as default, remove the flag from other schools.
            $school_ids = $storage->getQuery()
                ->condition('sid', $this->id(), '<>')
                ->condition('recognize', TRUE)
                ->accessCheck(FALSE)
                ->execute();
            foreach ($school_ids as $school_id) {
                /** @var \Drupal\school\Entity\SchoolInterface $school */
                $store = $storage->load($school_id);
                $store->setRecognize(FALSE);
                $store->save();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
    {
        $fields = parent::baseFieldDefinitions($entity_type);
        $fields += static::ownerBaseFieldDefinitions($entity_type);

        $fields['uid']
            ->setLabel(t('Owner'))
            ->setDescription(t('The store owner.'))
            ->setDisplayConfigurable('view', TRUE)
            ->setDisplayConfigurable('form', TRUE);

        $fields['name'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Name'))
            ->setDescription(t('The name of the school.'))
            ->setRequired(TRUE)
            ->setTranslatable(TRUE)
            ->setSettings([
                'default_value' => '',
                'max_length' => 255,
            ])
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => 0,
            ])
            ->setDisplayConfigurable('view', TRUE)
            ->setDisplayConfigurable('form', TRUE);
        $fields['school_logo'] = BaseFieldDefinition::create('entity_reference')
            ->setLabel(t('School Logo'))
            ->setDescription(t('Recommended image size is 1600x900 pixels.'))
            ->setRevisionable(TRUE)
            ->setTranslatable(TRUE)
            ->setRequired(FALSE)
            ->setSetting('target_type', 'media')
            ->setSetting('handler', 'default:media')
            ->setSettings([
                'handler_settings' => [
                    'target_bundles' => [
                        'image' => 'image',
                    ],
                    'sort' => [
                        'field' => '_none',
                    ],
                    'auto_create' => FALSE,
                    'auto_create_bundle' => '',
                ],
            ])
            ->setCardinality(1)
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE)
            ->setDisplayOptions('form', [
                'settings' => [
                    'entity_browser' => 'image_browser',
                    'field_widget_display' => 'rendered_entity',
                    'field_widget_edit' => TRUE,
                    'field_widget_remove' => TRUE,
                    'open' => TRUE,
                    'selection_mode' => 'selection_append',
                    'field_widget_display_settings' => [
                        'view_mode' => 'default',
                    ],
                    'field_widget_replace' => FALSE,
                ],
                'type' => 'entity_browser_entity_reference',
                'weight' => 3,
            ])
            ->setDisplayOptions('view', [
                'label' => 'hidden',
                'settings' => [
                    'target_type' => 'media',
                ],
                'weight' => 3,
            ]);

        $fields['mail'] = BaseFieldDefinition::create('email')
            ->setLabel(t('Email'))
            ->setDescription(t('school email notifications are sent from this address. If omitted, the "site" email address will be used.'))
            ->setDisplayOptions('form', [
                'type' => 'email_default',
                'weight' => 1,
            ])
            ->setSetting('display_description', TRUE)
            ->setDisplayConfigurable('view', TRUE)
            ->setDisplayConfigurable('form', TRUE);
        // Registration Number field.
        $fields['registration_number'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Registration Number'))
            ->setDescription(t('The registration number of the school.'))
            ->setTranslatable(TRUE)
            ->setSettings([
                'default_value' => '',
                'max_length' => 255,
            ])
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => 0,
            ])
            ->setDisplayConfigurable('view', TRUE)
            ->setDisplayConfigurable('form', TRUE);
        // Phone Number field.
        $fields['phone_number'] = BaseFieldDefinition::create('telephone')
            ->setLabel(t('Phone Number'))
            ->setDescription(t('The phone number of the school.'))
            ->setTranslatable(TRUE)
            ->setSettings([
                'default_value' => '',
                'max_length' => 20,
            ])
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => 0,
            ])
            ->setDisplayConfigurable('view', TRUE)
            ->setDisplayConfigurable('form', TRUE);

        // Mobile field.
        $fields['mobile'] = BaseFieldDefinition::create('telephone')
            ->setLabel(t('Mobile'))
            ->setDescription(t('The mobile number of the school.'))
            ->setTranslatable(TRUE)
            ->setSettings([
                'default_value' => '',
                'max_length' => 20,
            ])
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => 0,
            ])
            ->setDisplayConfigurable('view', TRUE)
            ->setDisplayConfigurable('form', TRUE);
        // Established Date field.
        $fields['established_date'] = BaseFieldDefinition::create('datetime')
            ->setLabel(t('Established Date'))
            ->setDescription(t('The date the school was established.'))
            ->setTranslatable(TRUE)
            ->setSettings([
                'default_value' => '',
                'max_length' => 255,
            ])
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => 0,
            ])
            ->setDisplayConfigurable('view', TRUE)
            ->setDisplayConfigurable('form', TRUE);

        // Type field.
        $fields['school_type'] = BaseFieldDefinition::create('string')
            ->setLabel(t('School Type'))
            ->setDescription(t('The type of the school (e.g., public, private).'))
            ->setTranslatable(TRUE)
            ->setSettings([
                'default_value' => '',
                'max_length' => 255,
            ])
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => 0,
            ])
            ->setDisplayConfigurable('view', TRUE)
            ->setDisplayConfigurable('form', TRUE);
        // Board field.
        $fields['board'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Board'))
            ->setDescription(t('The educational board to which the school is affiliated.'))
            ->setTranslatable(TRUE)
            ->setSettings([
                'default_value' => '',
                'max_length' => 255,
            ])
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => 0,
            ])
            ->setDisplayConfigurable('view', TRUE)
            ->setDisplayConfigurable('form', TRUE);
        // Pattern field.
        $fields['pattern'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Pattern'))
            ->setDescription(t('The educational pattern followed by the school.'))
            ->setTranslatable(TRUE)
            ->setSettings([
                'default_value' => '',
                'max_length' => 255,
            ])
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => 0,
            ])
            ->setDisplayConfigurable('view', TRUE)
            ->setDisplayConfigurable('form', TRUE);

        $fields['address'] = BaseFieldDefinition::create('address')
            ->setLabel(t('Address'))
            ->setDescription(t('The store address.'))
            ->setCardinality(1)
            ->setRequired(TRUE)
            ->setSetting('field_overrides', [
                AddressField::GIVEN_NAME => ['override' => FieldOverride::HIDDEN],
                AddressField::ADDITIONAL_NAME => ['override' => FieldOverride::HIDDEN],
                AddressField::FAMILY_NAME => ['override' => FieldOverride::HIDDEN],
                AddressField::ORGANIZATION => ['override' => FieldOverride::HIDDEN],
                AddressField::ADDRESS_LINE3 => ['override' => FieldOverride::HIDDEN],
            ])
            ->setDisplayOptions('form', [
                'type' => 'address_default',
                'weight' => 4,
            ])
            ->setDisplayConfigurable('view', TRUE)
            ->setDisplayConfigurable('form', TRUE);

        $fields['path'] = BaseFieldDefinition::create('path')
            ->setLabel(t('URL alias'))
            ->setDescription(t('The store URL alias.'))
            ->setTranslatable(TRUE)
            ->setDisplayOptions('form', [
                'type' => 'path',
                'weight' => 30,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setCustomStorage(TRUE);

        // 'recognize'
        $fields['recognize'] = BaseFieldDefinition::create('boolean')
            ->setLabel(t('Default'))
            ->setDescription(t('Whether this is the default recognize.'))
            ->setDefaultValue(FALSE)
            ->setDisplayOptions('form', [
                'type' => 'boolean_checkbox',
                'settings' => [
                    'display_label' => TRUE,
                ],
                'weight' => 90,
            ])
            ->setDisplayConfigurable('view', TRUE)
            ->setDisplayConfigurable('form', TRUE);

        $fields['created'] = BaseFieldDefinition::create('created')
            ->setLabel(t('Created'))
            ->setDescription(t('The time when the store was created.'))
            ->setTranslatable(TRUE)
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        $fields['changed'] = BaseFieldDefinition::create('changed')
            ->setLabel(t('Changed'))
            ->setDescription(t('The time when the store was last edited.'))
            ->setTranslatable(TRUE);

        return $fields;
    }
}
