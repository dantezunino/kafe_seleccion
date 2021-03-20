<?php

namespace app\models;

use Yii;

use yii\base\Model;

class Registro extends Model
{
    public $nombre;
    public $apellido;
    public $edad;
    public $email;
    public $dni;
    public $amigo;


    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['nombre', 'apellido', 'edad', 'email', 'dni'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            ['amigo', 'string'],
            [['nombre', 'apellido'], 'string', 'max'=>30],
            ['edad', 'integer', 'min'=>18],
            ['dni', 'integer']
        ];
    }
}