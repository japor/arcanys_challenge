<?php

/**
 * @file
 * Contains \Drupal\arcanys_entity\Form\SessionDeleteForm.
 */

namespace Drupal\arcanys_entity\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides a form for deleting a content_entity_session entity.
 *
 * @ingroup session
 */
class SessionDeleteForm extends ContentEntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete %name?', array('%name' => $this->entity->label()));
  }

  /**
   * {@inheritdoc}
   * If the delete command is canceled, return to the session.
   */
  public function getCancelUrl() {
    return Url::fromRoute('entity.session.edit_form', ['session' => $this->entity->id()]);
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   * Delete the entity.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $entity->delete();
    $this->logger('session')->notice('Deleted %title.', array('%title' => $this->entity->label()));
    // Redirect to session list after delete.
    $form_state->setRedirect('entity.session.collection');
  }

}
