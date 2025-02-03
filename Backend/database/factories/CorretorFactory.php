<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Corretor>
 */
class CorretorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => User::all()->random()->name,
            'cpf' => (string) rand(10000000000, 99999999999), // Gera número e converte para string
            'creci' => (string) rand(10000000000, 99999999999) // Gera número e converte para string
        ];
    }
}
