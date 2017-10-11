<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Backpack\CRUD\CrudTrait;

class Properties extends Model
{
    use CrudTrait;
    /*
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('filter', function (Builder $builder) {
            if(!auth()->user()->hasRole('superadmin'))
            {
              $builder->where('user_id', auth()->user()->id);
            }
        });
    }*/

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    //protected $table = 'propertiess';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
     protected $fillable = [
       'name',
       'image',
       'street',
       'city',
       'state',
       'country',
       'zip',
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function blocks(){
      return $this->hasMany(Block::class);
    }

    public function block(){
      return $this->hasOne(Block::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeUser($query)
    {
        return $query->where('id', 1);
    }
    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    
}
