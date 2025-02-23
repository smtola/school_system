<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if you are following conventions)
    protected $table = 'announcements';

    // Define the fillable attributes (columns you want to allow for mass assignment)
    protected $fillable = [
        'title',
        'message',
    ];

    // Optionally, if you want to customize the timestamps (created_at, updated_at)
    public $timestamps = true;
}
