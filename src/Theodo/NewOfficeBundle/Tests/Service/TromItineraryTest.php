<?php

namespace Theodo\NewOfficeBundle\Tests\Service;

use Theodo\NewOfficeBundle\Service\TromItinerary;

class TromItineraryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetMinTime()
    {
        $trom_itinerary = new TromItinerary();
        $origin = array(48.851744, 2.346832);
        $destination = array(48.882724, 2.322462);

        $result = $trom_itinerary->getMinTime($origin, $destination);

        // assert that our calculator added the numbers correctly!
        $this->assertEquals(29, $result);
    }
}
