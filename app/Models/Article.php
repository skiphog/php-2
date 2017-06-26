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
     * @throws \App\Exceptions\DataBaseException
     */
    public function getAuthor()
    {
        return empty($this->author_id) ? null : Author::findById($this->author_id);
    }

    protected function validateTitle($title): string
    {
        if (empty($title)) {
            throw new \InvalidArgumentException('Заголовок не может быть пустым');
        }

        return $title;
    }

    protected function validateText($text): string
    {
        if (empty($text)) {
            throw new \InvalidArgumentException('Текст не может быть пустым');
        }

        return $text;
    }

    protected function validateAuthorId($author_id): int
    {
        $author_id = abs((int)$author_id);

        if (!Author::findById($author_id)) {
            throw new \InvalidArgumentException('Некорректный id автора');
        }

        return $author_id;
    }
}
