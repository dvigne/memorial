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
    'id', 'comments_id', 'photo_path'
  ];

  public function comment()
  {
    $this->hasOne('App\Comments', 'comment_id');
  }

}
