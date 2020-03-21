<?php

namespace Drupal\student_payment\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Stud pay mgnt2 entity.
 *
 * @ingroup student_payment
 *
 * @ContentEntityType(
 *   id = "stud_pay_mgnt2",
 *   label = @Translation("Stud pay mgnt2"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\student_payment\StudPayMgnt2ListBuilder",
 *     "views_data" = "Drupal\student_payment\Entity\StudPayMgnt2ViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\student_payment\Form\StudPayMgnt2Form",
 *       "add" = "Drupal\student_payment\Form\StudPayMgnt2Form",
 *       "edit" = "Drupal\student_payment\Form\StudPayMgnt2Form",
 *       "delete" = "Drupal\student_payment\Form\StudPayMgnt2DeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\student_payment\StudPayMgnt2HtmlRouteProvider",
 *     },
 *     "access" = "Drupal\student_payment\StudPayMgnt2AccessControlHandler",
 *   },
 *   base_table = "stud_pay_mgnt2",
 *   translatable = FALSE,
 *   admin_permission = "administer stud pay mgnt2 entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/stud_pay_mgnt2/{stud_pay_mgnt2}",
 *     "add-form" = "/admin/structure/stud_pay_mgnt2/add",
 *     "edit-form" = "/admin/structure/stud_pay_mgnt2/{stud_pay_mgnt2}/edit",
 *     "delete-form" = "/admin/structure/stud_pay_mgnt2/{stud_pay_mgnt2}/delete",
 *     "collection" = "/admin/structure/stud_pay_mgnt2",
 *   },
 *   field_ui_base_route = "stud_pay_mgnt2.settings"
 * )
 */
class StudPayMgnt2 extends ContentEntityBase implements StudPayMgnt2Interface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

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
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Stud pay mgnt2 entity.'))
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

    $fields['status']->setDescription(t('A boolean indicating whether the Stud pay mgnt2 is published.'))
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
