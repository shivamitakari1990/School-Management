<?php

/**
 * @file
 * Contains stud_pay_mgnt3.page.inc.
 *
 * Page callback for Stud pay mgnt3 entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Stud pay mgnt3 templates.
 *
 * Default template: stud_pay_mgnt3.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_stud_pay_mgnt3(array &$variables) {
  // Fetch StudPayMgnt3 Entity Object.
  $stud_pay_mgnt3 = $variables['elements']['#stud_pay_mgnt3'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
