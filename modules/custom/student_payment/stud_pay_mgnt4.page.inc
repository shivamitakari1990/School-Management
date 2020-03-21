<?php

/**
 * @file
 * Contains stud_pay_mgnt4.page.inc.
 *
 * Page callback for Stud pay mgnt4 entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Stud pay mgnt4 templates.
 *
 * Default template: stud_pay_mgnt4.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_stud_pay_mgnt4(array &$variables) {
  // Fetch StudPayMgnt4 Entity Object.
  $stud_pay_mgnt4 = $variables['elements']['#stud_pay_mgnt4'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
