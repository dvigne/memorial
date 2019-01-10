<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Photos extends Model
{
  public $incrementing = false;

  protected static function boot(){
  parent::boot();
  static::creating(function ($model) {
      $model->{$model->getKeyName()} = (string) Str::uuid();
    });
  }

  protected $fillable = [
    'id', 'user_id', 'comment_id', 'photo_path'
  ];

  public function comment()
  {
    return $this->belongsTo('App\Comments', 'comment_id');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }

}
