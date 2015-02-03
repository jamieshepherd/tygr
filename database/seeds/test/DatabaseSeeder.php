<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('ClientTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('GroupTableSeeder');
		$this->call('ProjectTableSeeder');
		$this->call('IssueStatusTableSeeder');
		$this->call('IssueTableSeeder');
		$this->call('IssueHistoryTableSeeder');
		$this->call('GroupUserTableSeeder');
	}

}
