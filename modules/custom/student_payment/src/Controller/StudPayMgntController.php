<?php

namespace Drupal\student_payment\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\student_payment\Entity\StudPayMgntInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class StudPayMgntController.
 *
 *  Returns responses for Stud pay mgnt routes.
 */
class StudPayMgntController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * The date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $dateFormatter;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\Renderer
   */
  protected $renderer;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->dateFormatter = $container->get('date.formatter');
    $instance->renderer = $container->get('renderer');
    return $instance;
  }

  /**
   * Displays a Stud pay mgnt revision.
   *
   * @param int $stud_pay_mgnt_revision
   *   The Stud pay mgnt revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($stud_pay_mgnt_revision) {
    $stud_pay_mgnt = $this->entityTypeManager()->getStorage('stud_pay_mgnt')
      ->loadRevision($stud_pay_mgnt_revision);
    $view_builder = $this->entityTypeManager()->getViewBuilder('stud_pay_mgnt');

    return $view_builder->view($stud_pay_mgnt);
  }

  /**
   * Page title callback for a Stud pay mgnt revision.
   *
   * @param int $stud_pay_mgnt_revision
   *   The Stud pay mgnt revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($stud_pay_mgnt_revision) {
    $stud_pay_mgnt = $this->entityTypeManager()->getStorage('stud_pay_mgnt')
      ->loadRevision($stud_pay_mgnt_revision);
    return $this->t('Revision of %title from %date', [
      '%title' => $stud_pay_mgnt->label(),
      '%date' => $this->dateFormatter->format($stud_pay_mgnt->getRevisionCreationTime()),
    ]);
  }

  /**
   * Generates an overview table of older revisions of a Stud pay mgnt.
   *
   * @param \Drupal\student_payment\Entity\StudPayMgntInterface $stud_pay_mgnt
   *   A Stud pay mgnt object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(StudPayMgntInterface $stud_pay_mgnt) {
    $account = $this->currentUser();
    $stud_pay_mgnt_storage = $this->entityTypeManager()->getStorage('stud_pay_mgnt');

    $langcode = $stud_pay_mgnt->language()->getId();
    $langname = $stud_pay_mgnt->language()->getName();
    $languages = $stud_pay_mgnt->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $stud_pay_mgnt->label()]) : $this->t('Revisions for %title', ['%title' => $stud_pay_mgnt->label()]);

    $header = [$this->t('Revision'), $this->t('Operations')];
    $revert_permission = (($account->hasPermission("revert all stud pay mgnt revisions") || $account->hasPermission('administer stud pay mgnt entities')));
    $delete_permission = (($account->hasPermission("delete all stud pay mgnt revisions") || $account->hasPermission('administer stud pay mgnt entities')));

    $rows = [];

    $vids = $stud_pay_mgnt_storage->revisionIds($stud_pay_mgnt);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\student_payment\StudPayMgntInterface $revision */
      $revision = $stud_pay_mgnt_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = $this->dateFormatter->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $stud_pay_mgnt->getRevisionId()) {
          $link = $this->l($date, new Url('entity.stud_pay_mgnt.revision', [
            'stud_pay_mgnt' => $stud_pay_mgnt->id(),
            'stud_pay_mgnt_revision' => $vid,
          ]));
        }
        else {
          $link = $stud_pay_mgnt->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => $this->renderer->renderPlain($username),
              'message' => [
                '#markup' => $revision->getRevisionLogMessage(),
                '#allowed_tags' => Xss::getHtmlTagList(),
              ],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.stud_pay_mgnt.translation_revert', [
                'stud_pay_mgnt' => $stud_pay_mgnt->id(),
                'stud_pay_mgnt_revision' => $vid,
                'langcode' => $langcode,
              ]) :
              Url::fromRoute('entity.stud_pay_mgnt.revision_revert', [
                'stud_pay_mgnt' => $stud_pay_mgnt->id(),
                'stud_pay_mgnt_revision' => $vid,
              ]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.stud_pay_mgnt.revision_delete', [
                'stud_pay_mgnt' => $stud_pay_mgnt->id(),
                'stud_pay_mgnt_revision' => $vid,
              ]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['stud_pay_mgnt_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
