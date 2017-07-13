<?php

namespace App\Controllers\User;

use App\User;
use App\Component\Auth;
use App\Controllers\Controller;

class Login extends Controller
{
    protected function assess(): bool
    {
        return $this->auth->guest();
    }

    /**
     * Показать форму логина
     */
    public function actionLogin()
    {
        $this->view->display(__DIR__ . '/../../../template/user/login.php');
    }

    /**
     * Показать форму регистрации
     */
    public function actionRegistration()
    {
        $this->view->display(__DIR__ . '/../../../template/user/registration.php');
    }

    /**
     * Проверка на авторизацию
     * @throws \InvalidArgumentException
     */
    public function actionAuth()
    {
        try {
            /** @var User $user */
            if (!$user = User::findByEmail($this->request->post('email'))) {
                throw new \InvalidArgumentException('Error');
            }
            if (!$user->passwordVerify($this->request->post('password'))) {
                throw new \InvalidArgumentException('Error');
            }
        } catch (\InvalidArgumentException $e) {
            var_dump($e->getMessage());
            die;
        }
        $_SESSION[Auth::identificator()] = $user->id;
        header('Location: /');
    }

    /**
     * Зарегистрироваться
     * @throws \App\Exceptions\MultiException
     * @throws \App\Exceptions\DataBaseException
     */
    public function actionStore()
    {
        try {
            if (empty($name = $this->request->post('name'))) {
                throw  new \InvalidArgumentException('name не может быть пустым');
            }

            if (empty($email = $this->request->post('email'))) {
                throw  new \InvalidArgumentException('email не должен быть пустым');
            }

            if (User::findByEmail($email)) {
                throw new \InvalidArgumentException('Email уже занят');
            }

            if (empty($password = $this->request->post('password')) ||
                $password !== $this->request->post('confirm')
            ) {
                throw new \InvalidArgumentException('Ошибка при вооде пароля');
            }

            $data = [
                'name'     => $name,
                'email'    => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];

            (new User())->fill($data)->save();
            header('Location: /user/login/login');

        } catch (\Exception $e) {
            var_dump($e->getMessage());
            die;
        }
    }

}
