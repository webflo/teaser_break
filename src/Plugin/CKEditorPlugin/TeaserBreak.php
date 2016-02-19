<?php

/**
 * @file
 * Contains \Drupal\teaser_break\Plugin\CKEditorPlugin\TeaserBreak.
 */

namespace Drupal\teaser_break\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "teaser_break" plugin.
 *
 * @CKEditorPlugin(
 *   id = "teaser_break",
 *   label = @Translation("Teaser break"),
 *   module = "teaser_break"
 * )
 */
class TeaserBreak extends CKEditorPluginBase {

  private function getPluginPath() {
    return drupal_get_path('module', 'teaser_break') . '/js/plugins/teaser_break';
  }

  /**
   * {@inheritdoc}
   */
  public function getFile() {
    return $this->getPluginPath() . '/plugin.js';
  }

  /**
   * @inheritDoc
   */
  public function getButtons() {
    return [
      'TeaserBreak' => [
        'label' => t('Teaser break'),
        'image' => $this->getPluginPath() . '/teaser_break.png',
      ]
    ];
  }

  /**
   * @inheritDoc
   */
  public function getConfig(Editor $editor) {
    return [
      'TeaserBreak_addTeaserBreak' => ('Insert teaser break')
    ];
  }

}
