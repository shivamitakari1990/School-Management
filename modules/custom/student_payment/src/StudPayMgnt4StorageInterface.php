<?php

namespace Drupal\student_payment;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface StudPayMgnt4StorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Stud pay mgnt4 revision IDs for a specific Stud pay mgnt4.
   *
   * @param \Drupal\student_payment\Entity\StudPayMgnt4Interface $entity
   *   The Stud pay mgnt4 entity.
   *
   * @return int[]
   *   Stud pay mgnt4 revision IDs (in ascending order).
   */
  public function revisionIds(StudPayMgnt4Interface $entity);

  /**
   * Gets a list of revision IDs having a given user as Stud pay mgnt4 author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Stud pay mgnt4 revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\student_payment\Entity\StudPayMgnt4Interface $entity
   *   The Stud pay mgnt4 entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(StudPayMgnt4Interface $entity);

  /**
   * Unsets the language for all Stud pay mgnt4 with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
