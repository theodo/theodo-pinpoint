<?php

namespace Theodo\NewOfficeBundle\Service;

class TromItinerary {

  public function getMinTime($origin, $destination)
  {
    // 48.851744%2C2.346832
    // 48.882724%2C2.322462

    $url = 'http://trom.fr/route/?start='.implode('%2C', $origin).'&destination='.implode('%2C', $destination);
    $trom_data = file_get_contents($url);

    $trom_json = json_decode($trom_data);

    $times = array();
    foreach($trom_json->train_connections as $train_connection) {
        $times[] = $train_connection[0];
    }

    return min($times);
  }
}
