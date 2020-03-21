<?php

namespace Drupal\student_payment\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Stud pay mgnt entities.
 *
 * @ingroup student_payment
 */
interface StudPayMgntInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Stud pay mgnt name.
   *
   * @return string
   *   Name of the Stud pay mgnt.
   */
  public function getName();

  /**
   * Sets the Stud pay mgnt name.
   *
   * @param string $name
   *   The Stud pay mgnt name.
   *
   * @return \Drupal\student_payment\Entity\StudPayMgntInterface
   *   The called Stud pay mgnt entity.
   */
  public function setName($name);

  /**
   * Gets the Stud pay mgnt creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Stud pay mgnt.
   */
  public function getCreatedTime();

  /**
   * Sets the Stud pay mgnt creation timestamp.
   *
   * @param int $timestamp
   *   The Stud pay mgnt creation timestamp.
   *
   * @return \Drupal\student_payment\Entity\StudPayMgntInterface
   *   The called Stud pay mgnt entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Gets the Stud pay mgnt revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Stud pay mgnt revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\student_payment\Entity\StudPayMgntInterface
   *   The called Stud pay mgnt entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Stud pay mgnt revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Stud pay mgnt revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\student_payment\Entity\StudPayMgntInterface
   *   The called Stud pay mgnt entity.
   */
  public function setRevisionUserId($uid);

}
