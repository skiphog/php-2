<?php

namespace App\Models;

/**
 * @property int    $id
 * @property string $title
 * @property string $text
 * @property int    $author_id
 * @property string $shortcut
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

    /**
     * Сокращенный текст новости
     * @return string
     */
    public function getShortcut(): string
    {
        return subText($this->text, 100);
    }

    /**
     * Валидация заголовка
     * @param string $title
     * @return string
     * @throws \InvalidArgumentException
     */
    protected function validateTitle($title): string
    {
        if (empty($title)) {
            throw new \InvalidArgumentException('Заголовок не может быть пустым');
        }

        return $title;
    }

    /**
     * Валидация текста
     * @param $text
     * @return string
     * @throws \InvalidArgumentException
     */
    protected function validateText($text): string
    {
        if (empty($text)) {
            throw new \InvalidArgumentException('Текст не может быть пустым');
        }

        return $text;
    }

    /**
     * Валидация id автора
     * @param $author_id
     * @return mixed
     * @throws \App\Exceptions\DataBaseException
     * @throws \InvalidArgumentException
     */
    protected function validateAuthorId($author_id)
    {
        if (0 === $author_id = abs((int)$author_id)) {
            return null;
        }

        if (!Author::findById($author_id)) {
            throw new \InvalidArgumentException('Некорректный id автора');
        }

        return $author_id;
    }
}
