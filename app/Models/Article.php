<?php
require __DIR__ . '/Model.php';

class Article extends Model
{
    protected static $table = 'News';

    public $id;
    public $title;
    public $text;
    public $author;
}