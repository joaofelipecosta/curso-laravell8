<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts'; // adicional pois pelo nome da model já consegue relacionar com table, em caso  contrario ussa assim.

    protected $fillable = ['title', 'content', 'photo']; // indico quais colunas podem ser preenchidas, dando seguranção para não ser burlado caso burlem e coloquem a mais não vai fazer diferença

}
