<?php

use Illuminate\Database\Seeder;

class ProposalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Proposal::class, 30)->create()->each(function($proposal) {
            \App\Bid::savingByModels(factory(\App\Project::class)->create(), $proposal, random_int(1, \App\User::count()));
        });
    }
}
