<?php

namespace Drupal\student_payment\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Stud pay mgnt2 entities.
 *
 * @ingroup student_payment
 */
interface StudPayMgnt2Interface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Stud pay mgnt2 name.
   *
   * @return string
   *   Name of the Stud pay mgnt2.
   */
  public function getName();

  /**
   * Sets the Stud pay mgnt2 name.
   *
   * @param string $name
   *   The Stud pay mgnt2 name.
   *
   * @return \Drupal\student_payment\Entity\StudPayMgnt2Interface
   *   The called Stud pay mgnt2 entity.
   */
  public function setName($name);

  /**
   * Gets the Stud pay mgnt2 creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Stud pay mgnt2.
   */
  public function getCreatedTime();

  /**
   * Sets the Stud pay mgnt2 creation timestamp.
   *
   * @param int $timestamp
   *   The Stud pay mgnt2 creation timestamp.
   *
   * @return \Drupal\student_payment\Entity\StudPayMgnt2Interface
   *   The called Stud pay mgnt2 entity.
   */
  public function setCreatedTime($timestamp);

}
