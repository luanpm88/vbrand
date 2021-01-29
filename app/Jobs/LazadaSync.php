<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\UserConnection;
use App\User;

class LazadaSync implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $lazadaConnection;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UserConnection $lazadaConnection)
    {
        //
        $this->lazadaConnection = $lazadaConnection;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // import all lazada products
        $this->lazadaConnection->importProducts();
    }
}