<?php

namespace Drupal\student_payment\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EditorialContentEntityBase;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Stud pay mgnt entity.
 *
 * @ingroup student_payment
 *
 * @ContentEntityType(
 *   id = "stud_pay_mgnt",
 *   label = @Translation("Stud pay mgnt"),
 *   handlers = {
 *     "storage" = "Drupal\student_payment\StudPayMgntStorage",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\student_payment\StudPayMgntListBuilder",
 *     "views_data" = "Drupal\student_payment\Entity\StudPayMgntViewsData",
 *     "translation" = "Drupal\student_payment\StudPayMgntTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\student_payment\Form\StudPayMgntForm",
 *       "add" = "Drupal\student_payment\Form\StudPayMgntForm",
 *       "edit" = "Drupal\student_payment\Form\StudPayMgntForm",
 *       "delete" = "Drupal\student_payment\Form\StudPayMgntDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\student_payment\StudPayMgntHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\student_payment\StudPayMgntAccessControlHandler",
 *   },
 *   base_table = "stud_pay_mgnt",
 *   data_table = "stud_pay_mgnt_field_data",
 *   revision_table = "stud_pay_mgnt_revision",
 *   revision_data_table = "stud_pay_mgnt_field_revision",
 *   translatable = TRUE,
 *   admin_permission = "administer stud pay mgnt entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "revision" = "vid",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/stud_pay_mgnt/{stud_pay_mgnt}",
 *     "add-form" = "/admin/structure/stud_pay_mgnt/add",
 *     "edit-form" = "/admin/structure/stud_pay_mgnt/{stud_pay_mgnt}/edit",
 *     "delete-form" = "/admin/structure/stud_pay_mgnt/{stud_pay_mgnt}/delete",
 *     "version-history" = "/admin/structure/stud_pay_mgnt/{stud_pay_mgnt}/revisions",
 *     "revision" = "/admin/structure/stud_pay_mgnt/{stud_pay_mgnt}/revisions/{stud_pay_mgnt_revision}/view",
 *     "revision_revert" = "/admin/structure/stud_pay_mgnt/{stud_pay_mgnt}/revisions/{stud_pay_mgnt_revision}/revert",
 *     "revision_delete" = "/admin/structure/stud_pay_mgnt/{stud_pay_mgnt}/revisions/{stud_pay_mgnt_revision}/delete",
 *     "translation_revert" = "/admin/structure/stud_pay_mgnt/{stud_pay_mgnt}/revisions/{stud_pay_mgnt_revision}/revert/{langcode}",
 *     "collection" = "/admin/structure/stud_pay_mgnt",
 *   },
 *   field_ui_base_route = "stud_pay_mgnt.settings"
 * )
 */
class StudPayMgnt extends EditorialContentEntityBase implements StudPayMgntInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function urlRouteParameters($rel) {
    $uri_route_parameters = parent::urlRouteParameters($rel);

    if ($rel === 'revision_revert' && $this instanceof RevisionableInterface) {
      $uri_route_parameters[$this->getEntityTypeId() . '_revision'] = $this->getRevisionId();
    }
    elseif ($rel === 'revision_delete' && $this instanceof RevisionableInterface) {
      $uri_route_parameters[$this->getEntityTypeId() . '_revision'] = $this->getRevisionId();
    }

    return $uri_route_parameters;
  }

  /**
   * {@inheritdoc}
   */
  public function preSave(EntityStorageInterface $storage) {
    parent::preSave($storage);

    foreach (array_keys($this->getTranslationLanguages()) as $langcode) {
      $translation = $this->getTranslation($langcode);

      // If no owner has been set explicitly, make the anonymous user the owner.
      if (!$translation->getOwner()) {
        $translation->setOwnerId(0);
      }
    }

    // If no revision author has been set explicitly,
    // make the stud_pay_mgnt owner the revision author.
    if (!$this->getRevisionUser()) {
      $this->setRevisionUserId($this->getOwnerId());
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Stud pay mgnt entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Stud pay mgnt entity.'))
      ->setRevisionable(TRUE)
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    // $fields['status']->setDescription(t('A boolean indicating whether the Stud pay mgnt is published.'))
    //   ->setDisplayOptions('form', [
    //     'type' => 'boolean_checkbox',
    //     'weight' => -3,
    //   ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    $fields['revision_translation_affected'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Revision translation affected'))
      ->setDescription(t('Indicates if the last edit of a translation belongs to current revision.'))
      ->setReadOnly(TRUE)
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE);

    return $fields;
  }

}
