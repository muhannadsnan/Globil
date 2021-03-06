<?php

namespace App;

use App\Picture;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
	protected $fillable = ['title', 'desc', 'type'];

	public function pictures()
	{
		return $this->hasMany(Picture::class);
	}
}
