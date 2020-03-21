<?php

namespace Drupal\student_payment\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Stud pay mgnt3 entity.
 *
 * @ingroup student_payment
 *
 * @ContentEntityType(
 *   id = "stud_pay_mgnt3",
 *   label = @Translation("Stud pay mgnt3"),
 *   bundle_label = @Translation("Stud pay mgnt3 type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\student_payment\StudPayMgnt3ListBuilder",
 *     "views_data" = "Drupal\student_payment\Entity\StudPayMgnt3ViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\student_payment\Form\StudPayMgnt3Form",
 *       "add" = "Drupal\student_payment\Form\StudPayMgnt3Form",
 *       "edit" = "Drupal\student_payment\Form\StudPayMgnt3Form",
 *       "delete" = "Drupal\student_payment\Form\StudPayMgnt3DeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\student_payment\StudPayMgnt3HtmlRouteProvider",
 *     },
 *     "access" = "Drupal\student_payment\StudPayMgnt3AccessControlHandler",
 *   },
 *   base_table = "stud_pay_mgnt3",
 *   translatable = FALSE,
 *   permission_granularity = "bundle",
 *   admin_permission = "administer stud pay mgnt3 entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "type",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/stud_pay_mgnt3/{stud_pay_mgnt3}",
 *     "add-page" = "/admin/structure/stud_pay_mgnt3/add",
 *     "add-form" = "/admin/structure/stud_pay_mgnt3/add/{stud_pay_mgnt3_type}",
 *     "edit-form" = "/admin/structure/stud_pay_mgnt3/{stud_pay_mgnt3}/edit",
 *     "delete-form" = "/admin/structure/stud_pay_mgnt3/{stud_pay_mgnt3}/delete",
 *     "collection" = "/admin/structure/stud_pay_mgnt3",
 *   },
 *   bundle_entity_type = "stud_pay_mgnt3_type",
 *   field_ui_base_route = "entity.stud_pay_mgnt3_type.edit_form"
 * )
 */
class StudPayMgnt3 extends ContentEntityBase implements StudPayMgnt3Interface {

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
      ->setDescription(t('The user ID of author of the Stud pay mgnt3 entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
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
      ->setDescription(t('The name of the Stud pay mgnt3 entity.'))
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

    $fields['status']->setDescription(t('A boolean indicating whether the Stud pay mgnt3 is published.'))
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => -3,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
