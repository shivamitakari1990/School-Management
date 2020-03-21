<?php

namespace Drupal\student_payment;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\student_payment\Entity\StudPayMgntInterface;

/**
 * Defines the storage handler class for Stud pay mgnt entities.
 *
 * This extends the base storage class, adding required special handling for
 * Stud pay mgnt entities.
 *
 * @ingroup student_payment
 */
class StudPayMgntStorage extends SqlContentEntityStorage implements StudPayMgntStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(StudPayMgntInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {stud_pay_mgnt_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {stud_pay_mgnt_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(StudPayMgntInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {stud_pay_mgnt_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('stud_pay_mgnt_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
