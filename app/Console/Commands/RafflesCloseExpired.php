<?php

namespace App\Console\Commands;

use App\Models\Raffle;
use Illuminate\Console\Command;

class RafflesCloseExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raffles:close-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cierra rifas vencidas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $raffles = Raffle::where('status', 'active')
            ->where('end_date', '<', today())
            ->get();

        if ($raffles->isEmpty()) {
            $this->info('No hay rifas vencidas');

            return Command::SUCCESS;
        }

        foreach ($raffles as $raffle) {
            $raffle->update(['status' => 'finished']);
        }
        $this->info("Se cerraron {$raffles->count()} rifas.");

        return Command::SUCCESS;
    }
}
