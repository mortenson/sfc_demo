<?php

namespace Drupal\sfc_demo\Plugin\SingleFileComponent;

use Drupal\Core\Form\FormStateInterface;
use Drupal\sfc\ComponentBase;

/**
 * A configurable header component.
 *
 * @SingleFileComponent(
 *   id = "sfc_demo_header",
 *   group = "SFC Demo",
 *   field_formatter = {
 *     "label" = "Header",
 *     "description" = "Displays text in a header tag.",
 *     "field_types" = {"string", "string_long"}
 *   },
 *   block = {
 *     "admin_label" = "Header",
 *     "category" = "SFC Demo",
 *   }
 * )
 */
class Header extends ComponentBase {

  const TEMPLATE = <<<TWIG
{% set tag = "h" ~ heading_level %}
<{{ tag }}>{{ text }}</{{ tag }}>
TWIG;

  /**
   * {@inheritdoc}
   */
  public function buildContextForm(array $form, FormStateInterface $form_state, array $default_values = []) {
    $form['heading_level'] = [
      '#type' => 'select',
      '#title' => $this->t('Heading level'),
      '#options' => [
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
      ],
      '#required' => TRUE,
      '#default_value' => isset($default_values['heading_level']) ? $default_values['heading_level'] : 1,
    ];
    $form['text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text'),
      '#required' => TRUE,
      '#default_value' => isset($default_values['text']) ? $default_values['text'] : '',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function prepareContext(array &$context) {
    if (isset($context['heading_level'])) {
      $context['heading_level'] = (int) $context['heading_level'];
    }
    else {
      $context['heading_level'] = 1;
    }
  }

}
