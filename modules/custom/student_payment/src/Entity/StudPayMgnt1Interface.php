<?php

namespace Drupal\student_payment\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Stud pay mgnt1 entities.
 *
 * @ingroup student_payment
 */
interface StudPayMgnt1Interface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Stud pay mgnt1 name.
   *
   * @return string
   *   Name of the Stud pay mgnt1.
   */
  public function getName();

  /**
   * Sets the Stud pay mgnt1 name.
   *
   * @param string $name
   *   The Stud pay mgnt1 name.
   *
   * @return \Drupal\student_payment\Entity\StudPayMgnt1Interface
   *   The called Stud pay mgnt1 entity.
   */
  public function setName($name);

  /**
   * Gets the Stud pay mgnt1 creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Stud pay mgnt1.
   */
  public function getCreatedTime();

  /**
   * Sets the Stud pay mgnt1 creation timestamp.
   *
   * @param int $timestamp
   *   The Stud pay mgnt1 creation timestamp.
   *
   * @return \Drupal\student_payment\Entity\StudPayMgnt1Interface
   *   The called Stud pay mgnt1 entity.
   */
  public function setCreatedTime($timestamp);

}
