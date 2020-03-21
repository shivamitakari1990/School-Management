<?php

namespace Drupal\student_payment;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Stud pay mgnt2 entities.
 *
 * @ingroup student_payment
 */
class StudPayMgnt2ListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Stud pay mgnt2 ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\student_payment\Entity\StudPayMgnt2 $entity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.stud_pay_mgnt2.edit_form',
      ['stud_pay_mgnt2' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
