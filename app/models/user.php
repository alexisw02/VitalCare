<?php

namespace app\models;

class user extends Model {
    public $table;

    // Asegúrate que estos campos coincidan con las columnas en tu tabla `user`
    public $fillable = [
        'nombre',
        'apellidos',
        'email',
        'passwd',
        'telefono',
        'sexo',
        'direccion',
        'tipo',
        'estado',
    ];

    public $values = [];

    public function __construct(){
        parent::__construct();
        $this->table = $this->connect();
    }

    public function insert($data = []) {
        $this->values = [
            $data['nombre'],
            $data['apellidos'],
            $data['email'],
            sha1($data['password']), // asegúrate de usar 'password' en el form
            $data['telefono'] ?? '',
            $data['sexo'] ?? '',
            $data['direccion'] ?? '',
            $data['tipo'] ?? 'paciente',
            $data['estado'] ?? 1
        ];
        return $this->create();
    }
}
