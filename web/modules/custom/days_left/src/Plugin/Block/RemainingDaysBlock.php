<?php

namespace Drupal\days_left\Plugin\Block;

use Drupal;
use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'days_left' Block.
 *
 * @Block(
 *   id = "days_left_block",
 *   admin_label = @Translation("Days to event"),
 *   category = @Translation("Event"),
 * )
 */

class RemainingDaysBlock extends BlockBase {
  public function build() {
    if($node = Drupal::routeMatch()->getParameter('node')) {
      if ($node->getType() == "event") {
        $eventDate = $node->field_date->value;
        $output = Drupal::service('days_left.event_calculator')
          ->CountEventDays($eventDate);
      }else{
        $output = "This is not an event (no date avaliable)";
      }
    }
    return [
      '#markup' => $output,
      '#cache' => [
        'max-age' => 0,
        ],
      ];
    }
}
