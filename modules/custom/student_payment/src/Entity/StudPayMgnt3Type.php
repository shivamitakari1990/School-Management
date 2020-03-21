<?php

namespace Drupal\student_payment\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Stud pay mgnt3 type entity.
 *
 * @ConfigEntityType(
 *   id = "stud_pay_mgnt3_type",
 *   label = @Translation("Stud pay mgnt3 type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\student_payment\StudPayMgnt3TypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\student_payment\Form\StudPayMgnt3TypeForm",
 *       "edit" = "Drupal\student_payment\Form\StudPayMgnt3TypeForm",
 *       "delete" = "Drupal\student_payment\Form\StudPayMgnt3TypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\student_payment\StudPayMgnt3TypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "stud_pay_mgnt3_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "stud_pay_mgnt3",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/stud_pay_mgnt3_type/{stud_pay_mgnt3_type}",
 *     "add-form" = "/admin/structure/stud_pay_mgnt3_type/add",
 *     "edit-form" = "/admin/structure/stud_pay_mgnt3_type/{stud_pay_mgnt3_type}/edit",
 *     "delete-form" = "/admin/structure/stud_pay_mgnt3_type/{stud_pay_mgnt3_type}/delete",
 *     "collection" = "/admin/structure/stud_pay_mgnt3_type"
 *   }
 * )
 */
class StudPayMgnt3Type extends ConfigEntityBundleBase implements StudPayMgnt3TypeInterface {

  /**
   * The Stud pay mgnt3 type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Stud pay mgnt3 type label.
   *
   * @var string
   */
  protected $label;

}
