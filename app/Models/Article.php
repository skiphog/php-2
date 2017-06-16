<?php

namespace App\Models;

/**
 * @property int    $id
 * @property string $title
 * @property string $text
 * @property int    $author_id
 * @property Author $author
 */
class Article extends Model
{
    protected static $table = 'news';

    protected $fillable = ['title', 'text', 'author_id'];

    /**
     * Получает автора
     * @return mixed
     */
    public function getAuthor()
    {
        return empty($this->author_id) ? null : Author::findById($this->author_id);
    }
}
