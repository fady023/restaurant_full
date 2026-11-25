<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'date', 'time', 'guests', 'status', 'notes'
    ];

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notification()
    {
        return $this->hasOne(Notification::class);
    }
}