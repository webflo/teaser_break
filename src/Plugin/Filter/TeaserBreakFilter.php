<?php

/**
 * @file
 * Contains \Drupal\teaser_break\Plugin\Filter\TeaserBreakFilter.
 */

namespace Drupal\teaser_break\Plugin\Filter;

use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

/**
 * Provides a filter to convert <teaser-break> to <!--break-->.
 *
 * @Filter(
 *   id = "teaser_break_filter",
 *   title = @Translation("Convert teaser-break to break"),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_REVERSIBLE,
 *   settings = {
 *   },
 *   weight = -100
 * )
 */
class TeaserBreakFilter extends FilterBase {

  /**
   * @inheritDoc
   */
  public function process($text, $langcode) {
    return new FilterProcessResult(str_replace('<teaser-break></teaser-break>', '<!--break-->', $text));
  }

}
