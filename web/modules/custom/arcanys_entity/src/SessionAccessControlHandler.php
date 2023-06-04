<?php

namespace Drupal\arcanys_entity;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Access controller for the session entity. Controls create/edit/delete access for entity and fields.
 *
 * @see \Drupal\arcanys_entity\Entity\Session
 */
class SessionAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    $access = AccessResult::forbidden();

    switch ($operation) {
      case 'view':
        if ($account->hasPermission('administer own sessions')) {
          $access = AccessResult::allowedIf($account->id() == $entity->getOwnerId())
            ->cachePerUser()
            ->addCacheableDependency($entity);
        }
        break;

      case 'update':
        // Shows the edit buttons in operations
        if ($account->hasPermission('administer own sessions')) {
          $access = AccessResult::allowedIf($account->id() == $entity->getOwnerId())
            ->cachePerUser()
            ->addCacheableDependency($entity);
        }
        break;

      case 'edit':
        // Lets me in on the edit-page of the entity
        if ($account->hasPermission('administer own sessions')) {
          $access = AccessResult::allowedIf($account->id() == $entity->getOwnerId())
            ->cachePerUser()
            ->addCacheableDependency($entity);
        }
        break;

      case 'delete':
        // Shows the delete buttons + access to delete this entity
        if ($account->hasPermission('administer own sessions')) {
          $access = AccessResult::allowedIf($account->id() == $entity->getOwnerId())
            ->cachePerUser()
            ->addCacheableDependency($entity);
        }
        break;
    }

    return $access;
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'administer own sessions');
  }

}
