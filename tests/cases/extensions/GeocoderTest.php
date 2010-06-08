<?php

namespace li3_geo\tests\cases\extensions;

use \li3_geo\extensions\Geocoder;

class GeocoderTest extends \lithium\test\Unit {

	public function testInvalidService() {
		$this->expectException("The lookup service 'foo' does not exist.");
		Geocoder::find('foo', '1600 Pennsylvania Ave. Washington DC');
	}

	public function testGeocodeLookup() {
		$location = Geocoder::find('google', '1600 Pennsylvania Avenue Northwest, Washington, DC');
		$expected = array('latitude' => 38.897596, 'longitude' => -77.036455);
		$this->assertEqual($expected, $location);
	}

	public function testCreateService() {
		Geocoder::__init();
		Geocoder::services('foo', array('url' => 'http://localhost', 'parser' => null));
		$this->assertEqual(array('google', 'yahoo', 'foo'), array_keys(Geocoder::services()));
	}
}

?>