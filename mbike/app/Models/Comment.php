<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
 public $table = 'comments';
  protected $guarded = [];
  protected $primaryKey = 'comment_id';

}