<?php

namespace Drupal\student_payment;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\student_payment\Entity\StudPayMgnt3;


/**
 * Provides dynamic permissions for Stud pay mgnt3 of different types.
 *
 * @ingroup student_payment
 *
 */
class StudPayMgnt3Permissions{

  use StringTranslationTrait;

  /**
   * Returns an array of node type permissions.
   *
   * @return array
   *   The StudPayMgnt3 by bundle permissions.
   *   @see \Drupal\user\PermissionHandlerInterface::getPermissions()
   */
  public function generatePermissions() {
    $perms = [];

    foreach (StudPayMgnt3::loadMultiple() as $type) {
      $perms += $this->buildPermissions($type);
    }

    return $perms;
  }

  /**
   * Returns a list of node permissions for a given node type.
   *
   * @param \Drupal\student_payment\Entity\StudPayMgnt3 $type
   *   The StudPayMgnt3 type.
   *
   * @return array
   *   An associative array of permission names and descriptions.
   */
  protected function buildPermissions(StudPayMgnt3 $type) {
    $type_id = $type->id();
    $type_params = ['%type_name' => $type->label()];

    return [
      "$type_id create entities" => [
        'title' => $this->t('Create new %type_name entities', $type_params),
      ],
      "$type_id edit own entities" => [
        'title' => $this->t('Edit own %type_name entities', $type_params),
      ],
      "$type_id edit any entities" => [
        'title' => $this->t('Edit any %type_name entities', $type_params),
      ],
      "$type_id delete own entities" => [
        'title' => $this->t('Delete own %type_name entities', $type_params),
      ],
      "$type_id delete any entities" => [
        'title' => $this->t('Delete any %type_name entities', $type_params),
      ],
    ];
  }

}
