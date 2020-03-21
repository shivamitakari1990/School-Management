<?php

/**
 * @file
 * Contains stud_pay_mgnt2.page.inc.
 *
 * Page callback for Stud pay mgnt2 entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Stud pay mgnt2 templates.
 *
 * Default template: stud_pay_mgnt2.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_stud_pay_mgnt2(array &$variables) {
  // Fetch StudPayMgnt2 Entity Object.
  $stud_pay_mgnt2 = $variables['elements']['#stud_pay_mgnt2'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
