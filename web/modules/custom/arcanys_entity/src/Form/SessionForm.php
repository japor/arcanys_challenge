<?php
/**
 * @file
 * Contains Drupal\arcanys_entity\Form\SessionForm.
 */

namespace Drupal\arcanys_entity\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the session entity edit forms.
 *
 * @ingroup content_entity_example
 */
class SessionForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\arcanys_entity\Entity\Session */
    $form = parent::buildForm($form, $form_state);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    // Redirect to session list after save.
    $form_state->setRedirect('entity.session.collection');
    $entity = $this->getEntity();
    $entity->save();
  }

}
