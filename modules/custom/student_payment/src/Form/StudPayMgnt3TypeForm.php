<?php

namespace Drupal\student_payment\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class StudPayMgnt3TypeForm.
 */
class StudPayMgnt3TypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $stud_pay_mgnt3_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $stud_pay_mgnt3_type->label(),
      '#description' => $this->t("Label for the Stud pay mgnt3 type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $stud_pay_mgnt3_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\student_payment\Entity\StudPayMgnt3Type::load',
      ],
      '#disabled' => !$stud_pay_mgnt3_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $stud_pay_mgnt3_type = $this->entity;
    $status = $stud_pay_mgnt3_type->save();

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the %label Stud pay mgnt3 type.', [
          '%label' => $stud_pay_mgnt3_type->label(),
        ]));
        break;

      default:
        $this->messenger()->addMessage($this->t('Saved the %label Stud pay mgnt3 type.', [
          '%label' => $stud_pay_mgnt3_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($stud_pay_mgnt3_type->toUrl('collection'));
  }

}
