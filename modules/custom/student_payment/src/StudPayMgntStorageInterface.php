<?php

namespace Drupal\student_payment;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface StudPayMgntStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Stud pay mgnt revision IDs for a specific Stud pay mgnt.
   *
   * @param \Drupal\student_payment\Entity\StudPayMgntInterface $entity
   *   The Stud pay mgnt entity.
   *
   * @return int[]
   *   Stud pay mgnt revision IDs (in ascending order).
   */
  public function revisionIds(StudPayMgntInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Stud pay mgnt author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Stud pay mgnt revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\student_payment\Entity\StudPayMgntInterface $entity
   *   The Stud pay mgnt entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(StudPayMgntInterface $entity);

  /**
   * Unsets the language for all Stud pay mgnt with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
