<?php

namespace Database\Factories\Persona;

use App\Models\Persona\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonaFactory extends Factory
{
    protected $model = Persona::class;

    public function definition(): array
    {
        return [
            'primer_nombre' => $this->faker->firstName(),
            'segundo_nombre' => $this->faker->boolean(70) ? $this->faker->firstName() : null,
            'primer_apellido' => $this->faker->lastName(),
            'segundo_apellido' => $this->faker->boolean(70) ? $this->faker->lastName() : null,
            'telefono' => $this->faker->numerify('#######'),
            'direccion' => $this->faker->address(),
            'email' => $this->faker->boolean(80) ? $this->faker->safeEmail() : null,
            'ministerio_id' => $this->faker->numberBetween(1, 3),
            'estado_id' => $this->faker->numberBetween(1, 2),
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '-18 years'),
            'correlativo' => $this->faker->unique()->numerify('2025-####'),
            'dpi' => $this->faker->boolean(90) ? $this->faker->numerify('##########') : null,
            'nivel_academico_id' => $this->faker->numberBetween(1, 6),
            'genero_id' => $this->faker->randomElement([1, 2]),
        ];
    }
}
