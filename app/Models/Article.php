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
     * Устанавливает Заголовок
     * @param string $title
     * @throws \InvalidArgumentException
     * @return void
     */
    protected function setTitle($title)
    {
        if (empty($title)) {
            throw new \InvalidArgumentException('Заголовок не может быть пустым');
        }

        $this->attributes['title'] = $title;
    }

    /**
     * Устанавливает текст
     * @param string $text
     * @throws \InvalidArgumentException
     * @return void
     */
    protected function setText($text)
    {
        if (empty($text)) {
            throw new \InvalidArgumentException('Текст не может быть пустым');
        }

        $this->attributes['text'] = $text;
    }

    /**
     * Установка id автора
     * @param $author_id
     * @throws \App\Exceptions\DataBaseException
     * @throws \InvalidArgumentException
     * @return void
     */
    protected function setAuthorId($author_id)
    {
        if (0 === $author_id = abs((int)$author_id)) {
            $this->attributes['author_id'] = null;
        } else {
            if (!Author::findById($author_id)) {
                throw new \InvalidArgumentException('Некорректный id автора');
            }
            $this->attributes['author_id'] = $author_id;
        }
    }
}
