<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
        
        /**
         * This method creates comet token, store it in the database and returns
         * it.
         * 
         * @return string <p>This method returns token for comet server wich
         * will be expired in a time</p>
         */
        public function createCometToken() {
            $this->comet_token = md5(time());
            $this->comet_token_created_at = (new DateTime())
                    ->setTimezone(new DateTimezone('UTC'))
                    ->format('Y-m-d H:i:s');
            $this->save();
            return $this->comet_token;
        }

}
