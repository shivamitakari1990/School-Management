<?php

namespace Drupal\student_payment\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a form for deleting a Stud pay mgnt4 revision.
 *
 * @ingroup student_payment
 */
class StudPayMgnt4RevisionDeleteForm extends ConfirmFormBase {

  /**
   * The Stud pay mgnt4 revision.
   *
   * @var \Drupal\student_payment\Entity\StudPayMgnt4Interface
   */
  protected $revision;

  /**
   * The Stud pay mgnt4 storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $studPayMgnt4Storage;

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
    $instance->studPayMgnt4Storage = $container->get('entity_type.manager')->getStorage('stud_pay_mgnt4');
    $instance->connection = $container->get('database');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'stud_pay_mgnt4_revision_delete_confirm';
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
    return new Url('entity.stud_pay_mgnt4.version_history', ['stud_pay_mgnt4' => $this->revision->id()]);
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
  public function buildForm(array $form, FormStateInterface $form_state, $stud_pay_mgnt4_revision = NULL) {
    $this->revision = $this->StudPayMgnt4Storage->loadRevision($stud_pay_mgnt4_revision);
    $form = parent::buildForm($form, $form_state);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->StudPayMgnt4Storage->deleteRevision($this->revision->getRevisionId());

    $this->logger('content')->notice('Stud pay mgnt4: deleted %title revision %revision.', ['%title' => $this->revision->label(), '%revision' => $this->revision->getRevisionId()]);
    $this->messenger()->addMessage(t('Revision from %revision-date of Stud pay mgnt4 %title has been deleted.', ['%revision-date' => format_date($this->revision->getRevisionCreationTime()), '%title' => $this->revision->label()]));
    $form_state->setRedirect(
      'entity.stud_pay_mgnt4.canonical',
       ['stud_pay_mgnt4' => $this->revision->id()]
    );
    if ($this->connection->query('SELECT COUNT(DISTINCT vid) FROM {stud_pay_mgnt4_field_revision} WHERE id = :id', [':id' => $this->revision->id()])->fetchField() > 1) {
      $form_state->setRedirect(
        'entity.stud_pay_mgnt4.version_history',
         ['stud_pay_mgnt4' => $this->revision->id()]
      );
    }
  }

}
