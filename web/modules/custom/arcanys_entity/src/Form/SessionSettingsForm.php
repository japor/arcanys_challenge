<?php
/**
 * @file
 * Contains \Drupal\arcanys_entity\Form\OfferSettingsForm.
 */

namespace Drupal\arcanys_entity\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SessionSettingsForm.
 *
 * @package Drupal\arcanys_entity\Form
 *
 * @ingroup session
 */
class SessionSettingsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'session_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['session_settings']['#markup'] = 'Settings form for session. We don\'t need additional entity settings. Manage field settings with the tabs above.';
    return $form;
  }

}
