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
    public int $raffleId;
    public function __construct(Raffle $raffle)
    {
        $this->raffleId = $raffle->id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $numbers = [];
        $chunkSize = 1000;
        for ($i = 1; $i <= 9999; $i++) {
            $numbers[] = [
                'raffle_id' => $this->raffleId,
                'code' => str_pad($i, 4, '0', STR_PAD_LEFT),
                'number' => $i,
                'created_at' => now(),
                'updated_at' => now(),
                'ticketable_id' => null,
                'ticketable_type' => null,
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
