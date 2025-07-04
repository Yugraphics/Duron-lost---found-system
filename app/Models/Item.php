<?php

// app/Models/Item.php
// app/Models/Item.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
    'name', 'description', 'location', 'contact', 'status', 'image',
    'time_lost', 'time_found'
];

}
