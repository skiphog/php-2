<?php

namespace App;

use App\Models\Model;

/**
 * @property int    $id
 * @property int    $admin
 * @property string $name
 * @property string $email
 * @property string $password
 */
class User extends Model
{
    const USER_ADMIN = 1;
    const USER_REGULAR = 0;

    protected static $table = 'users';

    protected $fillable = [
        'admin',
        'name',
        'email',
        'password'
    ];

    public function isAdmin()
    {
        return (int)$this->admin === User::USER_ADMIN;
    }

    public function passwordVerify(string $password)
    {
        return password_verify($password, $this->password);
    }

    public static function findByEmail($email)
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE email = :email LIMIT 1';
        $result = (new Db())->query($sql, static::class, [':email' => $email]);
        return empty($result) ? false : array_shift($result);
    }
}
