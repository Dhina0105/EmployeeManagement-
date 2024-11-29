<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table ='leave_';

    protected $fillable =[
        'employee_name',
        'start_date',
        'end_date',
        'leave_type',
        'reason',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_name','id'); // 'user_id' is the foreign key in the 'leaves' table
    }
}
