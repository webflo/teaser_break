<?php

/**
 * @file
 * Contains \Drupal\teaser_break\Plugin\Field\FieldWidget\TextareaWithTeaserBreak.
 */

namespace Drupal\teaser_break\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\text\Plugin\Field\FieldWidget\TextareaWidget;

/**
 * Plugin implementation of the 'teaser_break_textarea' widget.
 *
 * @FieldWidget(
 *   id = "teaser_break_textarea",
 *   label = @Translation("Text area with a summary (Teaser-Break)"),
 *   field_types = {
 *     "text_with_summary"
 *   }
 * )
 */
class TextareaWithTeaserBreak extends TextareaWidget {

  /**
   * {@inheritdoc}
   */
  function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element = parent::formElement($items, $delta, $element, $form, $form_state);
    return $element;
  }

  /**
   * @inheritDoc
   */
  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    $values = parent::massageFormValues($values, $form, $form_state);
    foreach ($values as &$value) {
      $text = explode('<teaser-break></teaser-break>', $value['value']);
      if (count($text) == 2) {
        $value['summary'] = $text[0];
      }
    }
    return $values;
  }

}
