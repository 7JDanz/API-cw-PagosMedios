<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'activated' => true,
        'created_at' => $faker->dateTime,
        'deleted_at' => null,
        'email' => $faker->email,
        'first_name' => $faker->firstName,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'last_name' => $faker->lastName,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'updated_at' => $faker->dateTime,
        
    ];
});/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Modulo::class, static function (Faker\Generator $faker) {
    return [
        'descripcion' => $faker->sentence,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Status::class, static function (Faker\Generator $faker) {
    return [
        'descripcion' => $faker->sentence,
        'modulo_id' => $faker->sentence,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\TipoDocumento::class, static function (Faker\Generator $faker) {
    return [
        'descripcion' => $faker->sentence,
        'status' => $faker->boolean(),
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Grado::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'descripcion' => $faker->sentence,
        'status' => $faker->boolean(),
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Persona::class, static function (Faker\Generator $faker) {
    return [
        'apellidos' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'direccion' => $faker->sentence,
        'email' => $faker->email,
        'identificacion' => $faker->sentence,
        'nombres' => $faker->sentence,
        'representante_persona_id' => $faker->sentence,
        'status' => $faker->boolean(),
        'telefono' => $faker->sentence,
        'tipo_documento_id' => $faker->randomNumber(5),
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Concepto::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'descripcion' => $faker->sentence,
        'grado_id' => $faker->sentence,
        'updated_at' => $faker->dateTime,
        'valor' => $faker->randomFloat,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Descuento::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'descripcion' => $faker->sentence,
        'grado_id' => $faker->sentence,
        'max' => $faker->sentence,
        'min' => $faker->sentence,
        'status' => $faker->boolean(),
        'updated_at' => $faker->dateTime,
        'valor' => $faker->randomFloat,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Matricula::class, static function (Faker\Generator $faker) {
    return [
        'created_at' => $faker->dateTime,
        'fecha_fin' => $faker->dateTime,
        'fecha_inicio' => $faker->dateTime,
        'grado_id' => $faker->sentence,
        'persona_id' => $faker->sentence,
        'status' => $faker->boolean(),
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Me::class, static function (Faker\Generator $faker) {
    return [
        'descripcion' => $faker->sentence,
        
        
    ];
});
