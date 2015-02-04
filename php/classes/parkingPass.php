<?php
/**
 *Class file for parkingPass
 *
 * @author Kyle Dozier <kyle@kedlogic.com
 */
class ParkingPass {
	/**
	 * Primary Key / int, auto-inc
	 *
	 * id for ParkingPass Class
	 */
	private $parkingPassId;

	/**
	 * Foreign Key / int, not null
	 *
	 * id to reference ParkingSpot Class
	 */
	private $parkingSpotId;

	/**
	 * Foreign Key / int, not null
	 *
	 * id to reference Vehicle Class
	 */
	private $vehicleId;

	/**
	 * Foreign Key / int, not null
	 *
	 * id to reference Admin Class
	 */
	private $adminId;

	/**
	 * string, not null
	 *
	 * uuid
	 */
	private $uuId;

	/**
	 * datetime, not null
	 *
	 * from when is the the pass valid
	 */
	private $startDateTime;

	/**
	 * datetime, not null
	 *
	 * until when is the pass valid
	 */
	private $endDateTime;

	/**
	 * datetime
	 *
	 * when the pass was issued
	 */
	private $issuedDateTime;

	public function __construct($newParkingPassId, $newParkingSpotId, $newVehicleId, $newAdminId, $newUuId, $newStartDateTime, $newEndDateTime, $newIssuedDateTime) {
		try {
			$this->setParkingPassId($newParkingPassId);
			$this->setParkingSpotId($newParkingSpotId);
			$this->setVehicleId($newVehicleId);
			$this->setAdminId($newAdminId);
			$this->setUuId($newUuId);
			$this->setStartDateTime($newStartDateTime);
			$this->setEndDateTime($newEndDateTime);
			$this->setIssuedDateTime($newIssuedDateTime);
			} catch(InvalidArgumentException $invalidArgument) {
				// rethrow the exception to caller
			throw(new InvalidArgumentException($invalidArgument-> getMessage(), 0, $invalidArgument));
			} catch(RangeException $range) {
				// rethrow the exception to caller
				throw(new RangeException($range->getMessage(), 0, $range));
		}
	}

	/**
	 * accessor method for parkingPassId
	 *
	 * @return mixed value of parkingPassId
	 */
	public function getParkingPassId() {
		return ($this->parkingPassId);
	}

	/**
	 * mutator method for parkingPassId
	 *
	 * @param mixed $newParkingPassId new value of parkingPassId
	 * @throws InvalidArgumentException if $newParkingPassId is not an integer
	 * @throws RangeException if $newParkingPassId is not positive
	 */
	public function setParkingPassId($newParkingPassId) {
		// base case: if the parkingPassId is null, this is a new object
		if($newParkingPassId = null) {
			$this->parkingPassId = null;
				return;
			}

			// verify that parkingPassId is valid
		$newParkingPassId = filter_var($newParkingPassId, FILTER_VALIDATE_INT);
		if($newParkingPassId === false) {
			throw(new InvalidArgumentException("parkingPassId is not a valid integer"));
		}

		// verify that parkingPassId is positive
		if($newParkingPassId <= 0) {
			throw(new RangeException("parkingPassId is not positive"));
		}
		// convert and store the parkingPassId
		$this->parkingPassId = intval(($newParkingPassId));
		}

	/**
	 * accessor method for parkingSpotId
	 *
	 * @return int value of parkingSpotId
	 */
	public function getParkingSpotId() {
		return ($this->parkingSpotId);
	}

	/**
	 * mutator method for parkingSpotId
	 *
	 * @param int $newParkingSpotId new value of parkingSpotId
	 * @throws InvalidArgumentException if $newParkingSpotId is not an integer or is null
	 * @throws RangeException if $newParkingSpotId is not positive
	 */
	public function setParkingSpotId($newParkingSpotId) {
		// verify that parkingPassId is valid
		$newParkingSpotId = filter_var($newParkingSpotId, FILTER_VALIDATE_INT);
		if($newParkingSpotId === false) {
			throw(new InvalidArgumentException("parkingSpotId is not a valid integer or is null"));
		}

		// verify that parkingSpotId is positive
		if($newParkingSpotId <= 0) {
			throw(new RangeException("parkingSpotId is not positive"));
		}
		// convert and store the parkingSpotId
		$this->parkingSpotId = intval(($newParkingSpotId));
	}

	/**
	 * accessor method for vehicleId
	 *
	 * @return int value of vehicleId
	 */
	public function getVehicleId() {
		return ($this->vehicleId);
	}

	/**
	 * mutator method for vehicleId
	 *
	 * @param int $newVehicleId new value of vehicleId
	 * @throws InvalidArgumentException if $newVehicleId is not an integer or is null
	 * @throws RangeException if $newVehicleId is not positive
	 */
	public function setVehicleId($newVehicleId) {
		// verify that vehicleId is valid
		$newVehicleId = filter_var($newVehicleId, FILTER_VALIDATE_INT);
		if($newVehicleId === false) {
			throw(new InvalidArgumentException("vehicleId is not a valid integer or is null"));
		}

		// verify that vehicleId is positive
		if($newVehicleId <= 0) {
			throw(new RangeException("vehicleId is not positive"));
		}
		// convert and store the vehicleId
		$this->adminId = intval(($newVehicleId));
	}

	/**
	 * accessor method for adminId
	 *
	 * @return int value of adminId
	 */
	public function getAdminId() {
		return ($this->adminId);
	}

	/**
	 * mutator method for adminId
	 *
	 * @param int $newAdminId new value of adminId
	 * @throws InvalidArgumentException if $newAdminId is not an integer or is null
	 * @throws RangeException if $newAdminId is not positive
	 */
	public function setAdminId($newAdminId) {
		// verify that adminId is valid
		$newAdminId = filter_var($newAdminId, FILTER_VALIDATE_INT);
		if($newAdminId === false) {
			throw(new InvalidArgumentException("adminId is not a valid integer or is null"));
		}

		// verify that adminId is positive
		if($newAdminId <= 0) {
			throw(new RangeException("adminId is not positive"));
		}
		// convert and store the adminId
		$this->adminId = intval(($newAdminId));
	}

	/**
	 * accessor method for uuId
	 *
	 * @return int value of uuId
	 */
	public function getUuId() {
		return ($this->uuId);
	}

	/**
	 * mutator method for uuId
	 *
	 *
	 */
	// public function


	/**
	 * accessor method for startDateTime
	 *
	 * @return DateTime value of startDateTime
	 */
	public function getStartDateTime() {
		return($this->startDateTime);
	}

	/**
	 * mutator method for startDateTime
	 *
	 * @param mixed $newStartDateTime startDateTime as DateTime or string
	 * @throws InvalidArgumentException if $newStartDateTime is not a valid object or string
	 * @throws RangeException if $newStartDateTime is a date that doesn't exist
	 */
	public function setStartDateTime($newStartDateTime) {
		// verify not null
		if($newStartDateTime === null) {
			throw(new InvalidArgumentException("startDateTime cannot be null"));
		}

		// base case: if is a DateTime object already then pass as-is
		if(is_object($newStartDateTime) === true && get_class($newStartDateTime) === "DateTime") {
			$this->startDateTime = $newStartDateTime;
			return;
		}

		// treat date as string(y-m-d H:i:s)
		$newStartDateTime = trim($newStartDateTime);
		if((preg_match("/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2}):$/", $newStartDateTime, $matches)) !== 1) {
			throw(new InvalidArgumentException("startDateTime is not a valid date"));
		}

		// verify is a valid calendar date
		$year		= intval($matches[1]);
		$month	= intval($matches[2]);
		$day		= intval($matches[3]);
		$hour		= intval($matches[4]);
		$minute	= intval($matches[5]);
		$second	= intval($matches[6]);
		if(checkdate($month, $day, $year) === false) {
			throw(new RangeException("given startDateTime value is not a Gregorian date"));
		}

		// verify the time is really a valid wall clock time
		if($hour < 0 || $hour >= 24 || $minute < 0 || $minute >= 60 || $second < 0 || $second >= 60) {
			throw(new RangeException("given startDateTime is not a valid time"));
		}

		// store the startDateTime
		$newStartDateTime = DateTime::createFromFormat("Y-m-d H:i:s", $newStartDateTime);
		$this->startDateTime = $newStartDateTime;
	}


	/**
	 * accessor method for endDateTime
	 *
	 * @return DateTime value of endDateTime
	 */
	public function getEndDateTime() {
		return($this->endDateTime);
	}

	/**
	 * mutator method for endDateTime
	 *
	 * @param mixed $newEndDateTime endDateTime as DateTime or string
	 * @throws InvalidArgumentException if $newEndDateTime is not a valid object or string
	 * @throws RangeException if $newEndDateTime is a date that doesn't exist
	 */
	public function setEndDateTime($newEndDateTime) {
		// verify not null
		if($newEndDateTime === null) {
			throw(new InvalidArgumentException("endDateTime cannot be null"));
		}

		// base case: if is a DateTime object already then pass as-is
		if(is_object($newEndDateTime) === true && get_class($newEndDateTime) === "DateTime") {
			$this->endDateTime = $newEndDateTime;
			return;
		}

		// treat date as string(y-m-d H:i:s)
		$newEndDateTime = trim($newEndDateTime);
		if((preg_match("/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2}):$/", $newEndDateTime, $matches)) !== 1) {
			throw(new InvalidArgumentException("endDateTime is not a valid date"));
		}

		// verify is a valid calendar date
		$year		= intval($matches[1]);
		$month	= intval($matches[2]);
		$day		= intval($matches[3]);
		$hour		= intval($matches[4]);
		$minute	= intval($matches[5]);
		$second	= intval($matches[6]);
		if(checkdate($month, $day, $year) === false) {
			throw(new RangeException("given endDateTime value is not a Gregorian date"));
		}

		// verify the time is really a valid wall clock time
		if($hour < 0 || $hour >= 24 || $minute < 0 || $minute >= 60 || $second < 0 || $second >= 60) {
			throw(new RangeException("given endDateTime is not a valid time"));
		}

		// store the endDateTime
		$newEndDateTime = DateTime::createFromFormat("Y-m-d H:i:s", $newEndDateTime);
		$this->endDateTime = $newEndDateTime;
	}


	/**
	 * accessor method for issuedDateTime
	 *
	 * @return DateTime value of issuedDateTime
	 */
	public function getIssuedDateTime() {
		return($this->issuedDateTime);
	}

	/**
	 * mutator method for issuedDateTime
	 *
	 * @param mixed $newIssuedDateTime issuedDateTime as DateTime or string(or current datetime if null)
	 * @throws InvalidArgumentException if $newIssuedDateTime is not a valid object or string
	 * @throws RangeException if $newIssuedDateTime is a date that doesn't exist
	 */
	public function setIssuedDateTime($newIssuedDateTime) {
		// base case: if issuedDateTime is null, use current DateTime(NOW)
		if($newIssuedDateTime === null) {
			$this->issuedDateTime = new DateTime();
			return;
		}

		// base case: if is a DateTime object already then pass as-is
		if(is_object($newIssuedDateTime) === true && get_class($newIssuedDateTime) === "DateTime") {
			$this->issuedDateTime = $newIssuedDateTime;
			return;
		}

		// treat date as string(y-m-d H:i:s)
		$newIssuedDateTime = trim($newIssuedDateTime);
		if((preg_match("/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2}):$/", $newIssuedDateTime, $matches)) !== 1) {
			throw(new InvalidArgumentException("issuedDateTime is not a valid date"));
		}

		// verify is a valid calendar date
		$year		= intval($matches[1]);
		$month	= intval($matches[2]);
		$day		= intval($matches[3]);
		$hour		= intval($matches[4]);
		$minute	= intval($matches[5]);
		$second	= intval($matches[6]);
		if(checkdate($month, $day, $year) === false) {
			throw(new RangeException("given issuedDateTime value is not a Gregorian date"));
		}

		// verify the time is really a valid wall clock time
		if($hour < 0 || $hour >= 24 || $minute < 0 || $minute >= 60 || $second < 0 || $second >= 60) {
			throw(new RangeException("given issuedDateTime is not a valid time"));
		}

		// store the issuedDateTime
		$newIssuedDateTime = DateTime::createFromFormat("Y-m-d H:i:s", $newIssuedDateTime);
		$this->issuedDateTime = $newIssuedDateTime;
	}

}
?>