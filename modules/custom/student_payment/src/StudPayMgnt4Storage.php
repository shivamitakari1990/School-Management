<?php

namespace Drupal\student_payment;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\student_payment\Entity\StudPayMgnt4Interface;

/**
 * Defines the storage handler class for Stud pay mgnt4 entities.
 *
 * This extends the base storage class, adding required special handling for
 * Stud pay mgnt4 entities.
 *
 * @ingroup student_payment
 */
class StudPayMgnt4Storage extends SqlContentEntityStorage implements StudPayMgnt4StorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(StudPayMgnt4Interface $entity) {
    return $this->database->query(
      'SELECT vid FROM {stud_pay_mgnt4_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {stud_pay_mgnt4_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(StudPayMgnt4Interface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {stud_pay_mgnt4_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('stud_pay_mgnt4_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
