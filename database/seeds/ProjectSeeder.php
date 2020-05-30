<?php

use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\User::get() as $user) {
            for($count = rand(1,10); $count > 0; $count--) {
                $project = factory(\App\Project::class)->create([
                    'owner_id' => $user->id,
                ]);

                $user->attachProject($project);
            }
        }
    }
}
