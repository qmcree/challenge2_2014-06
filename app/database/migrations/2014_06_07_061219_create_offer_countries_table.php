<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('
		    CREATE TABLE IF NOT EXISTS `offer_countries` (
              `offer_id` mediumint(8) unsigned NOT NULL,
              `country` char(2) COLLATE latin1_general_ci NOT NULL,
              KEY `offer_id` (`offer_id`),
              KEY `country` (`country`)
            ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
		');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('offer_countries');
	}

}
