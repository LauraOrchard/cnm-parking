<?php
/**
 * controller to search for visitors
 * uses plate
 *
 * @Author Kyle Dozier <kyle@kedlogic.com>
 */

/**
 * require the encrypted config functions
 */
require_once("/home/cnmparki/etc/mysql/encrypted-config.php");

/**
 * require the classes
 */
require_once("../classes/visitor.php");
require_once("../classes/vehicle.php");



/**
 * create function for meta file
 */
function searchByPlate($mysqli, $plate) {
	/**
	 * ensure string length is 8 char or less
	 */
	if	(strlen($plate) > 8) {
		throw(new RangeException("License plate number cannot be more than 8 characters in length."));
	}

	/**
	 * populate array via get method
	 */
	$searchResults = array();
	$results = Vehicle::getVehicleByPlateNumber($mysqli, $plate);
	if($results !== null) {
		foreach($results as $result) {
			$searchResults[] = Visitor::getVisitorByVisitorId($mysqli, $result->getVisitorId());
		}
	}
	return($searchResults);
}
?>