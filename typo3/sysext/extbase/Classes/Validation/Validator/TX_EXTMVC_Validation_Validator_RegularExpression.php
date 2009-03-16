<?php

/*                                                                        *
 * This script belongs to the FLOW3 framework.                            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

require_once(t3lib_extMgm::extPath('extmvc') . 'Classes/Validation/Validator/TX_EXTMVC_Validation_Validator_ValidatorInterface.php');

/**
 * Validator for regular expressions
 *
 * @version $ID:$
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class TX_EXTMVC_Validation_Validator_RegularExpression implements TX_EXTMVC_Validation_Validator_ValidatorInterface {

	/**
	 * @var string The regular expression
	 */
	protected $regularExpression;

	/**
	 * Creates a RegularExpression validator with the given expression
	 *
	 * @param string The regular expression, must be ready to use with preg_match()
	 */
	public function __construct($regularExpression) {
		$this->regularExpression = $regularExpression;
	}

	/**
	 * Returns TRUE, if the given propterty ($proptertyValue) matches the given regular expression.
	 * Any errors will be stored in the given errors object.
	 * If at least one error occurred, the result is FALSE.
	 *
	 * @param mixed $value The value that should be validated
	 * @param TX_EXTMVC_Validation_Errors $errors An Errors object which will contain any errors which occurred during validation
	 * @param array $validationOptions Not used
	 * @return boolean TRUE if the value is valid, FALSE if an error occured
	 */
	public function isValid($value, TX_EXTMVC_Validation_Errors &$errors, array $validationOptions = array()) {
		if (!is_string($value) || preg_match($this->regularExpression, $value) === 0) {
			$errors->append('The given subject did not match the pattern.');
			return FALSE;
		}
		return TRUE;
	}
}

?>