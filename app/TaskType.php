<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
    //

    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name'];


}
