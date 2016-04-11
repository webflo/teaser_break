<?php

/**
 * @file
 * Contains \Drupal\teaser_break\Plugin\migrate\process\TeaserBreak
 */

namespace Drupal\teaser_break\Plugin\migrate\process;

use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * This plugin converts teaser from html comments to the html element.
 *
 * @MigrateProcessPlugin(
 *   id = "teaser_break"
 * )
 */
class TeaserBreak extends ProcessPluginBase {

  protected function body($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    return $this->split($value[0], $value[1])['body'];
  }

  protected function summary($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    return $this->split($value[0], $value[1])['summary'];
  }

  private function split($body, $summary) {
    $body = str_replace('<!--break-->', '<teaser-break></teaser-break>', $body);

    // Find where the delimiter is in the body
    $delimiter = strpos($body, '<teaser-break></teaser-break>');

    if ($delimiter === FALSE) {
      return [
        'body' => $body,
        'summary' => '',
      ];
    };

    return [
      'body' => $body,
      'summary' => $summary
    ];
  }

}
