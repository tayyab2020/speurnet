<?php

namespace App\Console\Commands;

use Mail;
use Illuminate\Console\Command;

class DailyCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Cron job for Properties alerts.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $words = [
            'aberration' => 'a state or condition markedly different from the norm',
            'convivial' => 'occupied with or fond of the pleasures of good company',
            'diaphanous' => 'so thin as to transmit light',
            'elegy' => 'a mournful poem; a lament for the dead',
            'ostensible' => 'appearing as such but not necessarily so'
        ];

// Finding a random word
        $key = array_rand($words);
        $value = $words[$key];

        Mail::raw("{$key} -> {$value}", function ($mail) {
            $mail->from('info@tutsforweb.com');
            $mail->to('tayyabkhurram62@gmail.com')
                ->subject('Word of the Day');
        });

        \Log::info("Cron is working fine!");
        $this->info('Demo:Cron Cummand Run successfully!');

    }
}
