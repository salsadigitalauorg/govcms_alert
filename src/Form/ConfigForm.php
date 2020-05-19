<?php

namespace Drupal\alert_banner\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfigForm.
 */
class ConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'alert_banner.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'alert_banner_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('alert_banner.settings');

    $form['enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Alerts'),
      '#default_value' => $config->get('enable'),
    ];

    $form['show_on_admin'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show on Administration Pages'),
      '#description' => $this->t('This will allow the alerts to show on backend admin pages as well as the frontend.'),
      '#default_value' => $config->get('show_on_admin'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('alert_banner.settings')
      ->set('enable', $form_state->getValue('enable'))
      ->set('show_on_admin', $form_state->getValue('show_on_admin'))
      ->save();
  }

}
