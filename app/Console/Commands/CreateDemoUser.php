<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateDemoUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-demo-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates the demo user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (! User::query()->where('email', config('app.demo.email'))->exists()) {
            User::query()->create([
                'name' => config('app.demo.username'),
                'email' => config('app.demo.email'),
                'password' => Hash::make(config('app.demo.email')),
            ]);

            $this->info('Demo user created.');
        } else {
            $this->info('Demo user already exists.');
        }
    }
}
