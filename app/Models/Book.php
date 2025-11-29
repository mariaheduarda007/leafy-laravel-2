<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use SoftDeletes;

    public function compBooks() {
        return $this->belongsTo('\App\Models\CompBooks');
    }

    public function wishlist() {
                return $this->belongsTo('\App\Models\Wishlist');

    }

    public function genre() {
        return $this->hasMany('\App\Models\Genre');
    }

    public function author() {
        return $this->hasMany('\App\Models\Author');
    }
}
