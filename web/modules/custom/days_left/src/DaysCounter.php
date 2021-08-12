<?php

namespace Drupal\days_left;

use Drupal\Core\Datetime\DrupalDateTime;

class DaysCounter{

  public function CountEventDays($eventDate) {

    //getting current time and setting hours and minutes to 0 
    //get timestamps and subtract timestamp of event and current time.
    $currentTime = new DrupalDateTime();
    $currentTime->setTime(0,0);
    $timestampNow = $currentTime->getTimestamp();

    $eventTime = new DrupalDateTime($eventDate);
    $eventTime->setTime(0,0);

    $timestampEvent = $eventTime->getTimestamp();

    $timeDifference = $timestampEvent - $timestampNow;
    //removing remainder and getting the number of days by dividing the time with number of seconds in a day
    $timeDifference = intdiv($timeDifference, 86400);

    if($timeDifference == 1 || $timeDifference == -1){
      $dayWord = "day";
    }else{
      $dayWord = "days";
    }

    if($timeDifference >= 1) {
      return $timeDifference . " " . $dayWord . " left until event starts";
    } 
    elseif($timeDifference <= -1) {
      return "This event already passed " . $timeDifference * -1 . " " . $dayWord .  " ago" ;
    }
    else {
      return "This event is happening today";
    } 
    

  }
}
