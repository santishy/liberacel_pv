<?php

namespace App\Jobs;

use App\Models\Raffle;
use App\Models\RaffleNumber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateRaffleNumbers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $raffle;

    public function __construct(Raffle $raffle)
    {
        $this->raffle = $raffle;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $numbers = [];
        $chunkSize = 1000;
        $totalNumbers = $this->raffle->total_numbers ? $this->raffle->total_numbers : 9999; // Assuming this is the total number of raffle numbers to generate
        for ($i = 1; $i <= $totalNumbers; $i++) {
            $numbers[] = [
                'raffle_id' => (int) $this->raffle->id,
                'code' => str_pad($i, 4, '0', STR_PAD_LEFT),
                'number' => $i,
                'created_at' => now(),
                'updated_at' => now(),
                'saleable_id' => null,
                'saleable_type' => null,
            ];
            if (count($numbers) >= $chunkSize) {
                RaffleNumber::insert($numbers);
                $numbers = [];
            }
        }
        if (count($numbers) > 0) {
            RaffleNumber::insert($numbers);
        }
    }
}
