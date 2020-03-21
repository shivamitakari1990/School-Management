<?php

namespace Drupal\student_payment\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a form for deleting a Stud pay mgnt revision.
 *
 * @ingroup student_payment
 */
class StudPayMgntRevisionDeleteForm extends ConfirmFormBase {

  /**
   * The Stud pay mgnt revision.
   *
   * @var \Drupal\student_payment\Entity\StudPayMgntInterface
   */
  protected $revision;

  /**
   * The Stud pay mgnt storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $studPayMgntStorage;

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->studPayMgntStorage = $container->get('entity_type.manager')->getStorage('stud_pay_mgnt');
    $instance->connection = $container->get('database');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'stud_pay_mgnt_revision_delete_confirm';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete the revision from %revision-date?', [
      '%revision-date' => format_date($this->revision->getRevisionCreationTime()),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('entity.stud_pay_mgnt.version_history', ['stud_pay_mgnt' => $this->revision->id()]);
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $stud_pay_mgnt_revision = NULL) {
    $this->revision = $this->StudPayMgntStorage->loadRevision($stud_pay_mgnt_revision);
    $form = parent::buildForm($form, $form_state);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->StudPayMgntStorage->deleteRevision($this->revision->getRevisionId());

    $this->logger('content')->notice('Stud pay mgnt: deleted %title revision %revision.', ['%title' => $this->revision->label(), '%revision' => $this->revision->getRevisionId()]);
    $this->messenger()->addMessage(t('Revision from %revision-date of Stud pay mgnt %title has been deleted.', ['%revision-date' => format_date($this->revision->getRevisionCreationTime()), '%title' => $this->revision->label()]));
    $form_state->setRedirect(
      'entity.stud_pay_mgnt.canonical',
       ['stud_pay_mgnt' => $this->revision->id()]
    );
    if ($this->connection->query('SELECT COUNT(DISTINCT vid) FROM {stud_pay_mgnt_field_revision} WHERE id = :id', [':id' => $this->revision->id()])->fetchField() > 1) {
      $form_state->setRedirect(
        'entity.stud_pay_mgnt.version_history',
         ['stud_pay_mgnt' => $this->revision->id()]
      );
    }
  }

}
