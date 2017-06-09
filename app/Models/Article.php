<?php

namespace App\Models;

class Article extends Model
{
    protected static $table = 'news';

    public $title;
    public $text;
    public $author;
}
