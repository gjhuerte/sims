<?php

namespace Backpack\Settings\app\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use CrudTrait;

    protected $table = 'settings';
    protected $fillable = ['value'];
}
