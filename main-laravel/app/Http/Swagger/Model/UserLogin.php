<?php namespace App;

/**
 * @SWG\Definition(@SWG\Xml(name="UserLogin"))
 */
class UserLogin extends Model {

	/**
     * @var string
     * @SWG\Property()
     */
	public $email;

     /**
     * @var string
     * @SWG\Property()
     */
     public $password;
}
