<?php

namespace Drupal\hello_world\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Configuration form definition for the salutation message.
 */
class SalutationConfigurationForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['hello_world.custom_salutation'];
  }
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'salutation_configuration_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('hello_world.custom_salutation');
    $form['salutation'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Salutation'),
      '#description' => $this->t('Please provide the salutation you want to use.'),
      '#default_value' => $config->get('salutation'),
    );
    return parent::buildForm($form, $form_state);
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('hello_world.custom_salutation')
      ->set('salutation', $form_state->getValue('salutation'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}

/**
 * {@inheritdoc}
 */
public function validateForm(array &$form, FormStateInterface $form_state) {
  $salutation = $form_state->getValue('salutation');
  if (strlen($salutation) > 20) {
    $form_state->setErrorByName('salutation', $this->t('This salutation is too long'));
  }
}

/**
 * Implements hook_form_alter().
 */
function my_module_form_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state, $form_id) {
  if ($form_id === 'salutation_configuration_form') {
    // Perform alterations. 
  }
}

/**
 * Implements hook_form_FORM_ID_alter().
 */
function my_module_form_salutation_configuration_form_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state, $form_id) {
  // Perform alterations. 
}

/**
 * Implements hook_form_FORM_ID_alter().
 */
function my_module_form_salutation_configuration_form_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state, $form_id) {
  // Perform alterations.
  $form['#submit'][] = 'my_module_salutation_configuration_form_submit';
}

/** 
 * Custom submit handler for the form_salutation_configuration form. 
 * 
 * @param $form 
 * @param \Drupal\Core\Form\FormStateInterface $form_state 
 */ 
function my_module_salutation_configuration_form_submit(&$form, \Drupal\Core\Form\FormStateInterface $form_state) { 
  // Do something when the form is submitted. 
} 

$builder = \Drupal::formBuilder(); 
$form = $builder->getForm('Drupal\hello_world\Form\SalutationConfigurationForm'); 
