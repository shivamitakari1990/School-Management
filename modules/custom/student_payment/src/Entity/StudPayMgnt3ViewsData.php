<?php

namespace Drupal\student_payment\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Stud pay mgnt3 entities.
 */
class StudPayMgnt3ViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.
    return $data;
  }

}
