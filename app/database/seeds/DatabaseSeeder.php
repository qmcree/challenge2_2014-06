<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $basePath = __DIR__ . '/dumps/';

        DB::statement(file_get_contents($basePath . 'leadstats.sql'));
        DB::statement(file_get_contents($basePath . 'offers.sql'));
        DB::statement(file_get_contents($basePath . 'offer_countries.sql'));

        $this->command->info('Seed succeeded!');
	}

}
