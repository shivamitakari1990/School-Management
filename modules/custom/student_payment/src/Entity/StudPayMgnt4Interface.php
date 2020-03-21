<?php

namespace Drupal\student_payment\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Stud pay mgnt4 entities.
 *
 * @ingroup student_payment
 */
interface StudPayMgnt4Interface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Stud pay mgnt4 name.
   *
   * @return string
   *   Name of the Stud pay mgnt4.
   */
  public function getName();

  /**
   * Sets the Stud pay mgnt4 name.
   *
   * @param string $name
   *   The Stud pay mgnt4 name.
   *
   * @return \Drupal\student_payment\Entity\StudPayMgnt4Interface
   *   The called Stud pay mgnt4 entity.
   */
  public function setName($name);

  /**
   * Gets the Stud pay mgnt4 creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Stud pay mgnt4.
   */
  public function getCreatedTime();

  /**
   * Sets the Stud pay mgnt4 creation timestamp.
   *
   * @param int $timestamp
   *   The Stud pay mgnt4 creation timestamp.
   *
   * @return \Drupal\student_payment\Entity\StudPayMgnt4Interface
   *   The called Stud pay mgnt4 entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Gets the Stud pay mgnt4 revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Stud pay mgnt4 revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\student_payment\Entity\StudPayMgnt4Interface
   *   The called Stud pay mgnt4 entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Stud pay mgnt4 revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Stud pay mgnt4 revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\student_payment\Entity\StudPayMgnt4Interface
   *   The called Stud pay mgnt4 entity.
   */
  public function setRevisionUserId($uid);

}
