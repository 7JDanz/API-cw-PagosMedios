<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'activated' => 'Activated',
            'email' => 'Email',
            'first_name' => 'First name',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
            'last_name' => 'Last name',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'modulo' => [
        'title' => 'Modulo',

        'actions' => [
            'index' => 'Modulo',
            'create' => 'New Modulo',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            
        ],
    ],

    'status' => [
        'title' => 'Status',

        'actions' => [
            'index' => 'Status',
            'create' => 'New Status',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'modulo_id' => 'Modulo',
            
        ],
    ],

    'tipo-documento' => [
        'title' => 'Tipo Documento',

        'actions' => [
            'index' => 'Tipo Documento',
            'create' => 'New Tipo Documento',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'status' => 'Status',
            
        ],
    ],

    'grado' => [
        'title' => 'Grado',

        'actions' => [
            'index' => 'Grado',
            'create' => 'New Grado',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'status' => 'Status',
            
        ],
    ],

    'persona' => [
        'title' => 'Persona',

        'actions' => [
            'index' => 'Persona',
            'create' => 'New Persona',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'apellidos' => 'Apellidos',
            'direccion' => 'Direccion',
            'email' => 'Email',
            'identificacion' => 'Identificacion',
            'nombres' => 'Nombres',
            'representante_persona_id' => 'Representante persona',
            'status' => 'Status',
            'telefono' => 'Telefono',
            'tipo_documento_id' => 'Tipo documento',
            
        ],
    ],

    'concepto' => [
        'title' => 'Concepto',

        'actions' => [
            'index' => 'Concepto',
            'create' => 'New Concepto',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'grado_id' => 'Grado',
            'valor' => 'Valor',
            
        ],
    ],

    'descuento' => [
        'title' => 'Descuento',

        'actions' => [
            'index' => 'Descuento',
            'create' => 'New Descuento',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'grado_id' => 'Grado',
            'max' => 'Max',
            'min' => 'Min',
            'status' => 'Status',
            'valor' => 'Valor',
            
        ],
    ],

    'matricula' => [
        'title' => 'Matricula',

        'actions' => [
            'index' => 'Matricula',
            'create' => 'New Matricula',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'fecha_fin' => 'Fecha fin',
            'fecha_inicio' => 'Fecha inicio',
            'grado_id' => 'Grado',
            'persona_id' => 'Persona',
            'status' => 'Status',
            
        ],
    ],

    'me' => [
        'title' => 'Mes',

        'actions' => [
            'index' => 'Mes',
            'create' => 'New Me',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];