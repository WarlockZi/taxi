<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		User::truncate();
		User::create([
			'name' => 'Admin',
			'email' => 'admin@example.com',
			'password' => 'admin',
			'role' => 'admin',
		]);

		User::factory(49)->create();
	}
}
