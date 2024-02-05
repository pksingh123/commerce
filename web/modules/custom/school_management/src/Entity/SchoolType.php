<?php

namespace Drupal\school\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the School entity type bundle.
 *
 * @ConfigEntityType(
 *   id = "school_type",
 *   label = @Translation("School Entity Bundle"),
 *   label_collection = @Translation("School types", context = "School"),
 *   label_singular = @Translation("school type", context = "School"),
 *   label_plural = @Translation("school types", context = "School"),
 *   label_count = @PluralTranslation(
 *   singular = "@count school type",
 *   plural = "@count school types",
 *   context = "school",
 *  ),
 *   handlers = {
 *     "list_builder" = "Drupal\school\SchoolTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\school\Form\SchoolTypeForm",
 *       "edit" = "Drupal\school\Form\SchoolTypeForm",
 *       "delete" = "Drupal\Core\Config\Entity\ConfigEntityBundleBase",
 *     },
 *     "local_task_provider" = {
 *       "default" = "Drupal\entity\Menu\DefaultEntityLocalTaskProvider",
 *     },
 *     "route_provider" = {
 *       "default" = "Drupal\entity\Routing\DefaultHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer site configuration",
 *   config_prefix = "school_type",
 *   bundle_of = "school",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *   },
 * admin_permission = "administer site configuration",
 *   links = {
 *     "add-form" = "/admin/schoole/config/school-types/add",
 *     "edit-form" = "/admin/schoole/config/school-types/{school_type}/edit",
 *     "delete-form" = "/admin/schoole/config/school-types/{school_type}/delete",
 *     "collection" = "/admin/schoole/config/school-types",
 *   }
 * )
 */
class SchoolType extends ConfigEntityBundleBase
{

    /**
     * The machine name of the bundle.
     *
     * @var string
     */
    protected $id;

    /**
     * The human-readable name of the bundle.
     *
     * @var string
     */
    protected $label;


    protected $uuid;
    // Add any additional properties or methods specific to your entity bundle.
    /**
     * A brief description of this store type.
     *
     * @var string
     */
    protected $description;

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}
