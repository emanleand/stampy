<?php

include_once __DIR__ . '../../AppController.php';

/**
 * Class UserController
 * 
 * @Description This class is used to unify the processes common to user.
 * 
 */
class UserController extends AppController
{
	/**
	 * Here the validation rules are defined
	 */
	const VALIDATION = [
		'firstName' => ['alpha+', 'not_null'],
		'lastName' => ['alpha+', 'not_null'],
		'email' => ['email', 'not_null'],
		'username' => ['alpha-num', 'not_null'],
		'password' => ['string', 'not_null'],
	];

	/**
	 * This validates the input data
	 * 
	 * @param Array $input
	 * 
	 * @return String
	 */
	protected function validateInput($input)
	{
		$response = '';
		foreach ($input as $key => $value) {
			if (!$this->check($value, self::VALIDATION[$key])) {
				$response = 'Invalid ' . $key;
				break;
			}
		}
		return $response;
	}


	/**
	 * This performs the validation of the input fields
	 * 
	 * @param String|Int $value
	 * @param Array $regexs
	 * 
	 * @return Bool
	 */
	private function check($value, $regexs = [])
	{
		try {
			foreach ($regexs as $regex) {
				switch ($regex) {
					case 'alpha':
						if (!filter_var(
							$value,
							FILTER_VALIDATE_REGEXP,
							array("options" =>
							array('regexp' => '/^[a-zA-ZáéíóúÁÉÍÓÚÑñäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ]{1,}+$/'))
						)) {
							return false;
						}
						break;
					case 'alpha+':
						if (!filter_var(
							$value,
							FILTER_VALIDATE_REGEXP,
							array("options" =>
							array('regexp' => '/^[a-zA-ZáéíóúÁÉÍÓÚÑñäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]{1,}+$/'))
						)) {
							return false;
						}
						break;
					case 'alpha-num':
						if (!filter_var(
							$value,
							FILTER_VALIDATE_REGEXP,
							array("options" =>
							array('regexp' => '/^[a-zA-ZáéíóúÁÉÍÓÚÑñäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\.\,0-9]{1,}+$/'))
						)) {
							return false;
						}
						break;
					case 'alpha-num+':
						if (!filter_var(
							$value,
							FILTER_VALIDATE_REGEXP,
							array("options" =>
							array('regexp' => '/^[a-zA-ZáéíóúÁÉÍÓÚÑñäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\.\,0-9\s]{1,}+$/'))
						)) {
							return false;
						}
						break;
					case 'string':
						if (!filter_var(
							$value,
							FILTER_VALIDATE_REGEXP,
							array("options" =>
							array('regexp' => '/^[\w\dáéíóúÁÉÍÓÚÑñäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s\-\*\¡\=\?\¿\!\{\}\[\]\_\"\#\$\%\.\:\,\;\/\|\°]{1,}+$/'))
						)) {
							return false;
						}
						break;
					case 'int':
						if (!filter_var(
							$value,
							FILTER_VALIDATE_REGEXP,
							array("options" =>
							array('regexp' => '/^[\-]{0,1}[0-9]{1,}+$/'))
						)) {
							return false;
						}
						break;
					case 'email':
						if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
							return false;
						}
						break;
					case 'not_null':
						if (!isset($value) && !empty($value)) {
							return false;
						}
						break;
					default:
						return false;
				}
			}
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	/**
	 * This encrypts the password
	 * 
	 * @param String $password
	 * 
	 * @return String
	 */
	protected function generateHash(String $password) {
		return password_hash($password, PASSWORD_DEFAULT, [15]);
	}

	/**
	 * This verifies the password
	 * 
	 * @param String $password
	 * @param String $hash
	 * 
	 * @return bool
	 */
	protected function verificateHash(String $password, String $hash) {
		return password_verify($password, $hash);
	}
}
