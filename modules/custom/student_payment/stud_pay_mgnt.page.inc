<?php

/**
 * @file
 * Contains stud_pay_mgnt.page.inc.
 *
 * Page callback for Stud pay mgnt entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Stud pay mgnt templates.
 *
 * Default template: stud_pay_mgnt.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_stud_pay_mgnt(array &$variables) {
  // Fetch StudPayMgnt Entity Object.
  $stud_pay_mgnt = $variables['elements']['#stud_pay_mgnt'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
