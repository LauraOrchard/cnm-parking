<?php
// require the encrypted config functions
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

// require the SimpleTest framework <http://www.simpletest.org/>
// this path is *NOT* universal, but deployed on the bootcamp-coders server
require_once("/usr/lib/php5/simpletest/autorun.php");

// require the class from the project under scrutiny
require_once("../php/classes/parkingspot.php");

/**
 * Unit test for the ParkingSpot class
 *
 * This is a SimpleTest test case for the CRUD methods of the ParkingSpot class.
 *
 * @see ParkingSpot
 * @author Kyle Dozier <kyle@kedlogic.com>
 **/

class ParkingSpotTest extends UnitTestCase {
	/**
	 * mysqli object shared amongst all tests
	 */
	private $mysqli = null;

	/**
	 * instance of the object parkingSpot
	 */
	private $parkingSpot = null;

	/**
	 * integer of location id
	 */
	private $locationId = 1;

	/**
	 * char(16) of placardNumber
	 */
	private $placardNumber = "203";


	/**
	 * sets up the mySQL connection for this test
	 */
	public function setUp() {
		// tell mysqli to throw exceptions
		mysqli_report(MYSQLI_REPORT_STRICT);

		// now connect to mySQL
		$config = readConfig("/etc/apache2/capstone-mysql/cnmparking.ini");
		$this->mysqli = new mysqli($config["hostname"], $config["username"], $config["password"], $config["database"]);

		// second, create an instance of the object under scrutiny
		$this->parkingSpot = new ParkingSpot(null, $this->locationId, $this->placardNumber);
	}

	/**
	 * tears down he connection to mySQL and deletes the test instance object
	 **/
	public function tearDown() {
		// destroy the object if it was created
		if($this->parkingSpot !== null) {
			$this->parkingSpot->delete($this->mysqli);
			$this->parkingSpot = null;
		}

		//disconnect from mySQL
		if($this->mysqli !== null) {
			$this->mysqli->close();
			$this->mysqli = null;
		}
	}
	/**
	 * test inserting a valid parkingSpot into mySQL
	 */
	public function testInsertValidParkingSpot() {
		//zeroth, ensure the parkingSpot and mySQL class are sane
		$this->assertNotNull($this->parkingSpot);
		$this->assertNotNull($this->mysqli);

		//first, insert the parkingSpot into mySQL
		$this->parkingSpot->insert($this->mysqli);

		//second, grab a parkingSpot from mySQL
		$mysqlParkingSpot = ParkingSpot::getParkingSpotByParkingSpotId($this->mysqli, $this->parkingSpot->getParkingSpotId());

		//third, assert the parkingSpot created and mySQL's parkingSpot are the same object
		$this->assertIdentical($this->parkingSpot->getParkingSpotId(), $mysqlParkingSpot->getParkingSpotId());
		$this->assertIdentical($this->parkingSpot->getLocationId(), $mysqlParkingSpot->getLocationId());
		$this->assertIdentical($this->parkingSpot->getPlacardNumber(), $mysqlParkingSpot->getPlacardNumber());
	}

	/**
	 * test inserting an invalid parkingSpot into mySQL
	 */
	public function testInsertInvalidParkingSpot() {
		//zeroth, ensure the parkingSpot and mySQL class are same
		$this->assertNotNull($this->parkingSpot);
		$this->assertNotNull($this->mysqli);

		//first, set the parkingSpot id to an invented value that should never insert in the first place
		$this->parkingSpot->setParkingSpotId(999);

		//second, try to insert the parkingSpot and ensure the exception is thrown
		$this->expectException("mysqli_sql_exception");
		$this->parkingSpot->insert($this->mysqli);

		//third, set the parkingSpot to null to prevent the tearDown() from deleting a parkingSpot that never existed
		$this->parkingSpot = null;
	}

	/**
	 * test deleting a parkingSpot from mySQL
	 */
	public function testDeleteValidParkingSpot() {
		//zeroth, ensure the parkingSpot and mySQL class are sane
		$this->assertNotNull($this->parkingSpot);
		$this->assertNotNull($this->mysqli);

		//first, assert the parkingSpot is inserted into mySQL by grabbing it from mySQL and asserting the primary key
		$this->parkingSpot->insert($this->mysqli);
		$mysqlParkingSpot = ParkingSpot::getParkingSpotByParkingSpotId($this->mysqli, $this->parkingSpot->getParkingSpotId());
		$this->assertIdentical($this->parkingSpot->getParkingSpotId(), $mysqlParkingSpot->getParkingSpotId());

		//second, delete the parkingSpot from mySQL and re-grab it from mySQL and assert id does not exist
		$this->parkingSpot->delete($this->mysqli);
		$mysqlParkingSpot= ParkingSpot::getParkingSpotByParkingSpotId($this->mysqli, $this->parkingSpot->getParkingSpotId());
		$this->assertNull($mysqlParkingSpot);

		//third, set the parkingSpot to null to prevent tearDown() from deleting a parkingSpot that has already been deleted
		$this->parkingSpot = null;
	}

	/**
	 * test deleting a parkingSpot from mySQL that does not exist
	 */
	public function testDeleteInvalidParkingSpot() {
		//zeroth, ensure the parkingSpot and mySQL class are sane
		$this->assertNotNull($this->parkingSpot);
		$this->assertNotNull($this->mysqli);

		//first, try to delete the parkingSpot before inserting it and ensure the exception is thrown
		$this->expectException('mysqli_sql_exception');
		$this->parkingSpot->delete($this->mysqli);

		//second, set the parkingSpot to null to prevent tearDown() from deleting a parkingSpot that has already been deleted
		$this->parkingSpot = null;
	}

	/**
	 * test updating an parkingSpot from mySQL
	 */
	public function testUpdateValidParkingSpot() {
		//zeroth, ensure the parkingSpot and mySQL class are the sane
		$this->assertNotNull($this->parkingSpot);
		$this->assertNotNull($this->mysqli);

		//first, assert the parkingSpot is inserted into mySQL by grabbing it from mySQL and asserting the primary key
		$this->parkingSpot->insert($this->mysqli);
		$mysqlParkingSpot = ParkingSpot::getParkingSpotByParkingSpotId($this->mysqli, $this->parkingSpot->getParkingSpotId());
		$this->assertIdentical($this->parkingSpot->getParkingSpotId(), $mysqlParkingSpot->getParkingSpotId());

		//second, grab a parkingSpot from mySQL
		$mysqlParkingSpot = ParkingSpot::getParkingSpotByParkingSpotId($this->mysqli, $this->parkingSpot->getParkingSpotId());

		//third, assert the parkingSpot created and mySQL's parkingSpot are the same object
		$this->assertIdentical($this->parkingSpot->getParkingSpotId(), $mysqlParkingSpot->getParkingSpotId());
		$this->assertIdentical($this->parkingSpot->getLocationId(), $mysqlParkingSpot->getLocationId());
		$this->assertIdentical($this->parkingSpot->getPlacardNumber(), $mysqlParkingSpot->getPlacardNumber());
	}


	/**
	 * test updating a parkingSpot from mySQL that does not exist
	 */
	public function testUpdateInvalidParkingSpot() {
		//zeroth, ensure the parkingSpot and mySQL class are the sane
		$this->assertNotNull($this->parkingSpot);
		$this->assertNotNull($this->mysqli);

		//first, try to update the parkingSpot before inserting it and ensure the exception is thrown
		$this->expectException("mysqli_sql_exception");
		$this->parkingSpot->update($this->mysqli);

		//second, set the parkingSpot to null to prevent tearDown() from deleting an parkingSpot that has already been deleted
		$this->parkingSpot = null;
	}

	/**
	 * test selecting a parking spot by parkingSpotId from mySQL
	 **/
	public function testSelectValidParkingSpotId() {
		// zeroth, ensure the parking spot and mySQL class are sane
		$this->assertNotNull($this->parkingSpot);
		$this->assertNotNull($this->mysqli);

		// first, insert the parking spot into mySQL
		$this->parkingSpot->insert($this->mysqli);
		$mysqlParkingSpot = ParkingSpot::getParkingSpotByParkingSpotId($this->mysqli, $this->parkingSpot->getParkingSpotId());

		// second, assert the query returned a result
		$this->assertNotNull($mysqlParkingSpot);
	}

	/**
	 * test selecting a parking spot that does not exist in mySQL
	 **/
	public function testSelectInvalidParkingSpotId() {
		// zeroth, ensure the parking spot and mySQL class are sane
		$this->assertNotNull($this->parkingSpot);
		$this->assertNotNull($this->mysqli);

		// first, try to selecting a parking spot by parkingSpotId
		$parkingSpotId = 0;

		// ensure the exception is thrown
		$this->expectException("mysqli_sql_exception");
		$mysqlParkingSpot = ParkingSpot::getParkingSpotByParkingSpotId($this->mysqli, $parkingSpotId);

		// second, assert the query returned no results
		$this->assertNull($mysqlParkingSpot);
	}

	/**
	 * test selecting a parking spot's placard number by location id from mySQL
	 */
	public function testSelectValidPlacardNumber() {
		// zeroth, ensure the placard number and mySQL class are sane
		$this->assertNotNull($this->parkingSpot);
		$this->assertNotNull($this->mysqli);

		// first, insert a test placard number into mySQL
		$this->parkingSpot->insert($this->mysqli);
		$mysqlParkingSpot = ParkingSpot::getParkingSpotByPlacardNumber($this->mysqli, $this->parkingSpot->getlocationId(), $this->parkingSpot->getPlacardNumber());

		// second, assert the query returned a result
		$this->assertNotNull($mysqlParkingSpot);
	}

	/**
	 * test grabbing a parking spot's placard number by location id from mySQL by non existent content
	 **/
	public function testSelectInvalidPlacardNumber() {
		// zeroth, ensure the placard number and mySQL class are sane
		$this->assertNotNull($this->parkingSpot);
		$this->assertNotNull($this->mysqli);

		// first, insert a test placard number
		$this->parkingSpot->insert($this->mysqli);

		// second, try to grab a placard number from mySQL
		$locationId = 0;
		$placardNumber = "NA";

		// ensure the exception is thrown
		$this->expectException("RangeException");
		$mysqlParkingSpot = ParkingSpot::getParkingSpotByPlacardNumber($this->mysqli, $locationId, $placardNumber);

		// third, assert the query returned a result
		$this->assertNull($mysqlParkingSpot);
	}
}
?>