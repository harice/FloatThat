<?php

/**
 * @SWG\Definition(@SWG\Xml(name="User"))
 */
class User {

     /**
     * @var string
     * @SWG\Property()
     */
     protected $name;

     /**
     * @var string
     * @SWG\Property()
     */
     protected $email;

     /**
     * @var string
     * @SWG\Property()
     */
     protected $password;

     /**
     * @var string
     * @SWG\Property()
     */
     protected $password_confirmation;

     /**
     * @var string
     * @SWG\Property()
     */
     protected $avatar;

     /**
     * @var string
     * @SWG\Property()
     */
     protected $twitter_provider_id;

     /**
     * @var string
     * @SWG\Property()
     */
     protected $facebook_provider_id;

     /**
     * @var string
     * @SWG\Property()
     */
     protected $confirmation_code;

}
