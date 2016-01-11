<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadstatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('
            CREATE TABLE IF NOT EXISTS `leadstats` (
              `offer_id` mediumint(8) unsigned NOT NULL,
              `date` date NOT NULL,
              `clicks` mediumint(8) unsigned NOT NULL,
              `leads` mediumint(8) unsigned NOT NULL,
              `pay_total` float(7,2) NOT NULL,
              UNIQUE KEY `offer_id` (`offer_id`,`date`),
              KEY `date` (`date`)
            ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
        ');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('leadstats');
	}

}
