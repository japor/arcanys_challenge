<?php
/**
 * @file
 * Contains \Drupal\arcanys_entity\Entity\Session.
 */

namespace Drupal\arcanys_entity\Entity;

use Drupal\Core\Entity\EditorialContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityStorageInterface;

/**
 * Defines the Session entity.
 *
 * @ingroup session
 *
 * @ContentEntityType(
 *   id = "session",
 *   label = @Translation("Session"),
 *   base_table = "session",
 *   data_table = "session_field_data",
 *   revision_table = "session_revision",
 *   revision_data_table = "session_field_revision",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "label" = "title",
 *     "revision" = "vid",
 *     "status" = "status",
 *     "published" = "status",
 *     "uid" = "uid",
 *     "owner" = "uid",
 *   },
 *   revision_metadata_keys = {
 *     "revision_user" = "revision_uid",
 *     "revision_created" = "revision_timestamp",
 *     "revision_log_message" = "revision_log"
 *   },
 *   handlers = {
 *      "access" = "Drupal\arcanys_entity\SessionAccessControlHandler",
 *      "views_data" = "Drupal\arcanys_entity\SessionViewsData",
 *      "form" = {
 *        "add" = "Drupal\arcanys_entity\Form\SessionForm",
 *        "edit" = "Drupal\arcanys_entity\Form\SessionForm",
 *        "delete" = "Drupal\arcanys_entity\Form\SessionDeleteForm",
 *      }
 *   },
 *   links = {
 *     "canonical" = "/sessions/{session}",
 *     "delete-form" = "/session/{session}/delete",
 *     "edit-form" = "/session/{session}/edit",
 *     "create" = "/session/create",
 *   },
 *   field_ui_base_route="entity.session.settings"
 * )
 */

class Session extends EditorialContentEntityBase {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type); // provides id and uuid fields

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('User'))
      ->setDescription(t('The user that created the session.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 0,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setDescription(t('The title of the session'))
      ->setSettings([
        'max_length' => 150,
        'text_processing' => 0,
      ])
      ->setRequired(TRUE)
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 1,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'))
      ->setDescription(t('The description of the entity.'))
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'weight' => 2,
      ])
      ->setRequired(TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);

    $fields['type'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Type'))
      ->setDescription(t('The type of the entity.'))
      ->setSettings([
        'allowed_values' => [
          'type-1' => 'Type 1',
          'type-2' => 'Type 2',
          'type-3' => 'Type 3',
        ],
      ])
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'options_select',
        'weight' => 3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['start_time'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Start Time'))
      ->setDescription(t('Date field example.'))
      ->setSettings([
        'datetime_type' => 'date',
      ])
      ->setRequired(TRUE)
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'datetime_default',
        'settings' => [
          'format_type' => 'medium',
        ],
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_default',
        'weight' => 4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['end_time'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('End time'))
      ->setDescription(t('The end time of the entity.'))
      ->setSettings([
        'datetime_type' => 'date',
      ])
      ->setRequired(TRUE)
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'datetime_default',
        'settings' => [
          'format_type' => 'medium',
        ],
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_default',
        'weight' => 5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the session entity is published.'))
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the session was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the session was last edited.'));

    return $fields;
  }

  /*** 
   * {@inheritdoc}
   * 
   * Makes the current user the owner of the entity
   */ 
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values +=array(
      'user_id'=> \Drupal::currentUser()->id(),
    );
  }

  /*** 
   * {@inheritdoc}
   */ 
  public function getOwner() {
    return$this->get('user_id')->entity;
  }

  /*** 
   * {@inheritdoc}
   */ 
  public function getOwnerId() {
    return$this->get('user_id')->target_id;
  }

}
