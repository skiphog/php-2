<?php

namespace App\Controllers\Admin;

use App\Models\Author;
use App\Models\Article;
use App\Controllers\Controller;
use App\Exceptions\MultiException;
use App\Exceptions\NotFoundException;
use App\Exceptions\ForbiddenException;

class News extends Controller
{
    /**
     * Все новости
     * @throws \App\Exceptions\DataBaseException
     */
    public function actionAll()
    {
        $this->view->assign([
            'authors'  => Author::findAll(),
            'articles' => Article::findAll()
        ]);
        $this->view->display(__DIR__ . '/../../../template/admin/index.php');
    }

    /**
     * Редактировать одну новость
     * @throws \App\Exceptions\DataBaseException
     * @throws \App\Exceptions\NotFoundException
     */
    public function actionEdit()
    {
        if (!$article = Article::findById($this->request->get('id'))) {
            throw new NotFoundException('Новость для редактирования не найдена');
        }

        $this->view->article = $article;
        $this->view->display(__DIR__ . '/../../../template/admin/edit.php');
    }

    /**
     * Добавить новость
     * @throws \App\Exceptions\MultiException
     * @throws \App\Exceptions\DataBaseException
     */
    public function actionAdd()
    {
        try {
            (new Article())->fill($this->request->post())->save();
            header('Location: /admin/news/all');
        } catch (MultiException $e) {
            // что-то сделать с этим исключением
            var_dump($e->getAllMessage());
        }
    }

    /**
     * Обновить новость
     * @throws \App\Exceptions\DataBaseException
     * @throws \App\Exceptions\MultiException
     * @throws \App\Exceptions\ForbiddenException
     */
    public function actionUpdate()
    {
        /** @var Article $article */
        if (!$article = Article::findById($this->request->post('id'))) {
            throw new ForbiddenException('Новость для обновления не найдена');
        }

        try {
            $article->fill($this->request->post())->save();
            header('Location: /admin/news/all');
        } catch (MultiException $e) {
            // что-то сделать с этим исключением
            var_dump($e->getAllMessage());
        }
    }

    /**
     * Удалить новость
     * @throws \App\Exceptions\DataBaseException
     * @throws \App\Exceptions\ForbiddenException
     */
    public function actionDelete()
    {
        /** @var Article $article */
        if (!$article = Article::findById($this->request->get('id'))) {
            throw new ForbiddenException('Новость для удаления не найдена');
        }
        $article->delete();
        header('Location: /admin/news/all');
    }
}
