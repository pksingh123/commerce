<?php

namespace Drupal\school\Form;

use Drupal\Core\Entity\BundleEntityFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\school\Entity\SchoolTypeInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\language\Entity\ContentLanguageSettings;


/**
 * Form controller for the school type entity edit forms.
 */
class SchoolTypeForm extends BundleEntityFormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'school_type_edit_form';
    }

    /**
     * {@inheritdoc}
     */
    protected function prepareEntity()
    {
        parent::prepareEntity();

        // Perform any additional preparation for the entity form.
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form = parent::buildForm($form, $form_state);

        // Add custom form elements or alter existing ones.
        /** @var \Drupal\school\Entity\SchoolTypeInterface $school_type */
        $school_type = $this->entity;

        $form['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#maxlength' => 255,
            '#default_value' => $school_type->label(),
            '#required' => TRUE,
        ];
        $form['id'] = [
            '#type' => 'machine_name',
            '#default_value' => $school_type->id(),
            '#machine_name' => [
                'exists' => '\Drupal\school\Entity\SchoolType::load',
            ],
            '#maxlength' => EntityTypeInterface::BUNDLE_MAX_LENGTH,
            '#disabled' => !$school_type->isNew(),

        ];
        $form['description'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Description'),
            '#description' => $this->t('This text will be displayed on the <em>Add store</em> page.'),
            '#default_value' => $school_type->getDescription(),
        ];
        //$form = $this->buildTraitForm($form, $form_state);

        if ($this->moduleHandler->moduleExists('language')) {
            $form['language'] = [
                '#type' => 'details',
                '#title' => $this->t('Language settings'),
                '#group' => 'additional_settings',
            ];
            $form['language']['language_configuration'] = [
                '#type' => 'language_configuration',
                '#entity_information' => [
                    'entity_type' => 'school',
                    'bundle' => $school_type->id(),
                ],
                '#default_value' => ContentLanguageSettings::loadByEntityTypeBundle('school', $school_type->id()),
            ];
            $form['#submit'][] = 'language_configuration_element_submit';
        }
        return $form;
    }




    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        //$this->validateTraitForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function save(array $form, FormStateInterface $form_state)
    {
        $this->entity->save();
        // $this->postSave($this->entity, $this->operation);
        // $this->submitTraitForm($form, $form_state);

        $this->messenger()->addMessage($this->t('Saved the %label school type.', [
            '%label' => $this->entity->label(),
        ]));
        $form_state->setRedirect('entity.school_type.collection');
    }
}
