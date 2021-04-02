<?php

namespace App\Models;

use App\Traits\AuthorObservable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartments extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AuthorObservable;

    protected $table = 'apartments';
    protected $dates = ['deleted_at'];

}
