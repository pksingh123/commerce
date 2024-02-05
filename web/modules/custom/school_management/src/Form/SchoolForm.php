<?php

namespace Drupal\school\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\entity\Form\EntityDuplicateFormTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SchoolForm extends ContentEntityForm
{

  use EntityDuplicateFormTrait;

  /**
   * The date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container)
  {
    $instance = parent::create($container);
    $instance->dateFormatter = $container->get('date.formatter');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state)
  {
    $form = parent::form($form, $form_state);
    /** @var \Drupal\school\Entity\SchoolInterface $school */
    $school = $this->entity;

    $form['#theme'] = ['school_form'];
    //$form['#attached']['library'][] = 'school/form';
    $changed = $school->getChangedTime();
    $form['changed'] = [
      '#type' => 'hidden',
      '#default_value' => $changed,
    ];
    if ($changed) {
      $last_saved = $this->dateFormatter->format($changed, 'short');
    } else {
      $last_saved = $school->isNew() ? $this->t('Not saved yet') : $this->t('N/A');
    }

    $form['advanced'] = [
      '#type' => 'container',
      '#attributes' => ['class' => ['entity-meta']],
      '#weight' => 99,
    ];
    $form['meta'] = [
      '#attributes' => ['class' => ['entity-meta__header']],
      '#type' => 'container',
      '#group' => 'advanced',
      '#title' => $this->t('Authoring information'),
      '#weight' => 90,
      'published' => [
        '#type' => 'html_tag',
        '#tag' => 'h3',
        '#value' => $school->getRecognize() ? $this->t('Recognizeed') : '',
        '#access' => $school->getRecognize(),
        '#attributes' => [
          'class' => ['entity-meta__title'],
        ],
      ],
      'changed' => [
        '#type' => 'item',
        '#wrapper_attributes' => [
          'class' => ['entity-meta__last-saved', 'container-inline'],
        ],
        '#markup' => '<h4 class="label inline">' . $this->t('Last saved') . '</h4> ' . $last_saved,
      ],
      'owner' => [
        '#type' => 'item',
        '#wrapper_attributes' => [
          'class' => ['author', 'container-inline'],
        ],
        '#markup' => '<h4 class="label inline">' . $this->t('Owner') . '</h4> ' . $school->getOwner()->getDisplayName(),
      ],
    ];
    if (isset($form['uid'])) {
      $form['uid']['#group'] = 'author';
    }
    if (isset($form['created'])) {
      $form['created']['#group'] = 'author';
    }


    $form['path_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('URL path settings'),
      '#open' => !empty($form['path']['widget'][0]['alias']['#default_value']),
      '#group' => 'advanced',
      '#access' => !empty($form['path']['#access']) && $school->get('path')->access('edit'),
      '#attributes' => [
        'class' => ['path-form'],
      ],
      '#attached' => [
        'library' => ['path/drupal.path'],
      ],
      '#weight' => 91,
    ];
    $form['path']['#group'] = 'path_settings';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state)
  {
    $this->entity->save();
    $this->postSave($this->entity, $this->operation);
    $this->messenger()->addMessage($this->t('Saved the %label school.', [
      '%label' => $this->entity->label(),
    ]));
    $form_state->setRedirect('entity.school.collection');
  }
}
