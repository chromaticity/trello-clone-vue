<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthAccessToken extends Model
{
    // oauth access token model

	// name of access token table
	protected $table = "oauth_access_tokens";

	// relationship to the user
	public function user() 
	{
    	return $this->belongsTo('App\Models\User', 'id');
    }
}
