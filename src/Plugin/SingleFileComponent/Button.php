<?php

namespace Drupal\sfc_demo\Plugin\SingleFileComponent;

use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Form\FormStateInterface;
use Drupal\sfc\ComponentBase;

/**
 * A simple button.
 *
 * @SingleFileComponent(
 *   id = "sfc_demo_button",
 *   group = "SFC Demo",
 *   field_formatter = {
 *     "label" = "Button",
 *     "description" = "Displays the link as a button.",
 *     "field_types" = {"link"}
 *   },
 *   block = {
 *     "admin_label" = "Button",
 *     "category" = "SFC Demo",
 *   }
 * )
 */
class Button extends ComponentBase {

  const TEMPLATE = <<<TWIG
<a href="{{ url }}" class="sfc-demo-button">{{ text }}</a>
TWIG;

  const CSS = <<<CSS
.sfc-demo-button {
  padding: 15px 20px;
  background: #0071b3;
  color: white;
  text-decoration: none;
  border: none;
  transition: .4s background;
}
.sfc-demo-button:hover {
  background: #004977;
  color: white;
  text-decoration: none;
  border: none;
}
CSS;

  /**
   * {@inheritdoc}
   */
  public function buildContextForm(array $form, FormStateInterface $form_state, array $default_values = []) {
    $form['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL'),
      '#required' => TRUE,
      '#default_value' => isset($default_values['url']) ? $default_values['url'] : '',
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
    if (isset($context['url'])) {
      $context['url'] = UrlHelper::stripDangerousProtocols($context['url']);
    }
  }

}
