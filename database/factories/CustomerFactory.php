<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'cpf' => $this->faker->cpf(),
            'cep' => '79116-520',
            'uf' => $this->faker->regionAbbr(),
            'localidade' => $this->faker->name(),
            'bairro' => $this->faker->name(),
            'logradouro' => 'Rua '.$this->faker->name(),
            'complemento' => $this->faker->numberBetween($min = 10, $max = 2000)
        ];
    }
}
