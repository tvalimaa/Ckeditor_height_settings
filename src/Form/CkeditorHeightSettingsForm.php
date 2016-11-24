<?php

namespace Drupal\ckeditor_height\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Ckeditor height settings for this site.
 */
class CkeditorHeightSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ckeditor_height_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'ckeditor_height.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('ckeditor_height.settings');

    $form['ckeditor_height_height'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Ckeditor height'),
      '#default_value' => $config->get('ckeditor_height_height'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (!is_numeric($form_state->getValue('ckeditor_height_height'))) {
      $form_state->setErrorByName('ckeditor_height_height', $this->t('The value is not numeric. Please enter a number.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = \Drupal::service('config.factory')->getEditable('ckeditor_height.settings');
    $config->set('ckeditor_height_height', $form_state->getValue('ckeditor_height_height'))->save();

    parent::submitForm($form, $form_state);
  }
}