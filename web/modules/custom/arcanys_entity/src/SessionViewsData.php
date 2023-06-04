<?php

namespace Drupal\arcanys_entity;

use Drupal\views\EntityViewsData;

/**
 * Provides views data for Session entities.
 */
class SessionViewsData extends EntityViewsData {

  /**
   * Returns the Views data for the entity.
   */
  public function getViewsData() {
    $data = parent::getViewsData();
    return $data;
  }

}
