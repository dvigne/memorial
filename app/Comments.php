<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comments extends Model
{
    public $incrementing = false;

    protected static function boot(){
    parent::boot();
    static::creating(function ($model) {
        $model->{$model->getKeyName()} = (string) Str::uuid();
      });
    }

    protected $fillable = [
      'id', 'message', 'photo_name'
    ];

    public function user() {
      return $this->belongsTo('App\User');
    }

    public function photos()
    {
      return $this->hasMany('App\Photos', 'comment_id');
    }
}
