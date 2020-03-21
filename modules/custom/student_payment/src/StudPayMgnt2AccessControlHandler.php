<?php

namespace Drupal\student_payment;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Stud pay mgnt2 entity.
 *
 * @see \Drupal\student_payment\Entity\StudPayMgnt2.
 */
class StudPayMgnt2AccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\student_payment\Entity\StudPayMgnt2Interface $entity */

    switch ($operation) {

      case 'view':

        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished stud pay mgnt2 entities');
        }


        return AccessResult::allowedIfHasPermission($account, 'view published stud pay mgnt2 entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit stud pay mgnt2 entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete stud pay mgnt2 entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add stud pay mgnt2 entities');
  }


}
