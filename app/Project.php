<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $release_date
 * @property string $created_at
 * @property string $updated_at
 */
class Project extends Model
{

    const DESIGNING = 1;
    const DEVELOPMENT = 2;
    const TESTING = 3;
    const REVIEWS = 4;

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'release_date'];

    public function testing()
    {
        return $this->hasMany('App\Task')->where('task_type_id','=',\App\Project::TESTING);
    }

    public function developement()
    {
        return $this->hasMany('App\Task')->where('task_type_id','=',\App\Project::DEVELOPMENT);
    }

    public function designing()
    {
        return $this->hasMany('App\Task')->where('task_type_id','=',\App\Project::DESIGNING);
    }

    public function reviews()
    {
        return $this->hasMany('App\Task')->where('task_type_id','=',\App\Project::REVIEWS);
    }

}
