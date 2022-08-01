<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;


    public function user(){
        return $this->belongsTo('App/User', 'username', 'employeeID');

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $primaryKey = 'employeeID';
    protected $fillable = [
        'employeeID',
        'lastName',
        'firstName',
        'middleName',
        'position',
        'department',
        'contactNumber',   
    ];

    
    public function getPhoneFormattedAttribute($phone) {
        
        $ac = substr($phone, 0, 4);
        $prefix = substr($phone, 4, 3);
        $suffix = substr($phone, 7);
    
        return "{$ac}-{$prefix}-{$suffix}";
    }
}
