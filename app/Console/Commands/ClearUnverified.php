<?php

namespace App\Console\Commands;

use App\Repositories\UserRepository;
use Illuminate\Console\Command;

class ClearUnverified extends Command
{
    /**
     * Create a new command instance.
     */
    public function __construct(protected UserRepository $userRepository)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:clear-unverified {--D|day=7 : The day the user was created}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear unverified user.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $day = $this->option('day');

        if (is_numeric($day) && ctype_digit($day)) {
            $this->userRepository->deleteWhere([
                ['email_verified_at', '=', null],
                ['created_at', '<', now()->subDays($day)],
            ]);

            $this->info('Unverified user cleared successfully.');
        } else {
            $this->error('The option value must be an integer.');
        }
    }
}
