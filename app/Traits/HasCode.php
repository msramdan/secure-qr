<?php

namespace App\Traits;

trait HasCode
{
  protected static function boot()
  {
    parent::boot();
    static::creating(function ($model) {
      if (empty($model->attributes['code'])) {
        $model->attributes['code'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16);
      }
    });
  }
  // public function uid($limit)
  // {
  //   return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
  // }
}
