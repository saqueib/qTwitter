<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Un Guard model
        Model::unguard();

        // disable fk constrain check
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {

            // Call the php artisan migrate:refresh using Artisan
            $this->command->call('migrate:refresh');

            $this->command->warn("Data cleared, starting from blank database.");
        }

        // How many users you need, defaulting to 20
        $numberOfUser = (int) $this->command->ask('How many users you need ?', 20);

        $this->command->info("Creating {$numberOfUser} users.");

        $users = factory(\App\User::class, $numberOfUser)->create();

        $tweetsRange = $this->command->ask('How many tweets one user should get in range', '10-20');
        $repliesAndLikeRange = $this->command->ask('How many replies and likes a tweet should get.', '5-30');

        $this->command->warn("Doing heave lifting....");

        $users->each(function($user) use ($tweetsRange, $repliesAndLikeRange, $users) {
            // create profile for user
            factory(\App\Profile::class)->create(['user_id' => $user->id]);

            // give range of tweets
            $tweets = factory(\App\Tweet::class, $this->rangeFromInput($tweetsRange))
                        ->create(['user_id' => $user->id ]);

            // replies & likes on a tweet
            $tweets->each(function ($tweet) use ($repliesAndLikeRange, $user, $users) {
                // replies
                factory(\App\Reply::class, $this->rangeFromInput($repliesAndLikeRange))
                        ->create([
                            'user_id' => $users->random()->id,
                            'tweet_id' => $tweet->id
                        ]);

                // likes
                \App\Like::firstOrCreate([
                    'user_id' => $users->random()->id,
                    'tweet_id' => $tweet->id
                ]);
            });
        });

        $this->command->info("Huh! {$numberOfUser} users with profile, {$tweetsRange} tweets with {$repliesAndLikeRange} replies and likes...");

        $followCount = $this->command->ask('How many followers should get user.', '2-9');

        $users->each(function($user) use ($users, $followCount) {
            $user->followers()->sync($users->random($this->rangeFromInput($followCount))->pluck('id'));
        });

        $this->command->warn("All done!");


        // enable back fk constrain check
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Re Guard model
        Model::reguard();
    }

    private function rangeFromInput($input) {
        $range = explode('-', $input);
        return rand(...$range);
    }
}
