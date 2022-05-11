<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationReason extends Model {
  protected $table = 'verification_reasons';

  protected $fillable = ['title'];

  public static $VERIFICATION_TYPE_USER      = 'User';

}
