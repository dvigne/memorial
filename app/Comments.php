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
      'id', 'first', 'last', 'message', 'photo_name'
    ];
}
