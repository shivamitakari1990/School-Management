<?php

namespace Drupal\student_payment\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Stud pay mgnt3 entities.
 *
 * @ingroup student_payment
 */
interface StudPayMgnt3Interface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Stud pay mgnt3 name.
   *
   * @return string
   *   Name of the Stud pay mgnt3.
   */
  public function getName();

  /**
   * Sets the Stud pay mgnt3 name.
   *
   * @param string $name
   *   The Stud pay mgnt3 name.
   *
   * @return \Drupal\student_payment\Entity\StudPayMgnt3Interface
   *   The called Stud pay mgnt3 entity.
   */
  public function setName($name);

  /**
   * Gets the Stud pay mgnt3 creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Stud pay mgnt3.
   */
  public function getCreatedTime();

  /**
   * Sets the Stud pay mgnt3 creation timestamp.
   *
   * @param int $timestamp
   *   The Stud pay mgnt3 creation timestamp.
   *
   * @return \Drupal\student_payment\Entity\StudPayMgnt3Interface
   *   The called Stud pay mgnt3 entity.
   */
  public function setCreatedTime($timestamp);

}
