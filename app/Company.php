<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable=['name','email','logo','website'];
    protected $perPage = 5;

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    //this method for delete relationship. If company delete =>al employees in that company delete also
    public static function boot() {
        parent::boot();

        static::deleting(function($company) { // before delete() method call this
             $company->employees()->delete();
             // do the rest of the cleanup...
        });
    }
}
