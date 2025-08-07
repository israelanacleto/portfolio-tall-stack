<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'subject' => fake()->sentence(4),
            'message' => fake()->paragraphs(2, true),
            'metadata' => fake()->optional(0.3)->randomElements([
                'ip_address' => fake()->ipv4(),
                'user_agent' => fake()->userAgent(),
                'referrer' => fake()->url()
            ]),
            'status' => fake()->randomElement(['new', 'read', 'replied', 'archived']),
            'read_at' => fake()->optional(0.5)->dateTimeBetween('-1 month', 'now'),
            'replied_at' => fake()->optional(0.3)->dateTimeBetween('-1 month', 'now'),
            'notes' => fake()->optional(0.4)->sentence(8),
        ];
    }

    public function newStatus()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'new',
            'read_at' => null,
            'replied_at' => null,
            'notes' => null,
        ]);
    }

    public function read()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'read',
            'read_at' => fake()->dateTimeBetween('-1 week', 'now'),
            'replied_at' => null,
        ]);
    }

    public function replied()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'replied',
            'replied_at' => fake()->dateTimeBetween('-1 week', 'now'),
            'notes' => fake()->sentence(6),
        ]);
    }

    public function archived()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'archived',
        ]);
    }

    public function recent()
    {
        return $this->state(fn (array $attributes) => [
            'created_at' => fake()->dateTimeBetween('-1 week', 'now'),
        ]);
    }

    public function old()
    {
        return $this->state(fn (array $attributes) => [
            'created_at' => fake()->dateTimeBetween('-6 months', '-1 month'),
        ]);
    }
}