<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Looge uus Admin Kasutaja';

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
     * @return int
     */
    public function handle()
    {
        $this->info("Looge uus Admin Kasutaja");

        $name = $this->ask('Mis on teie nimi?', 'Admin');
        $email = $this->ask('Mis on teie email?', 'admin@example.org');
        $password = $this->secret('Sisestage tugev parool');
        if ($this->confirm("Kas soovite luua Admin Kasutaja {$name} emailiga {$email}?", true)) {
            $this->info("Uee Admin Kasutaja loomine!");
            if (empty($password)) {
                return $this->error("Parool ei saa olla tühi!");
            }
            if (strlen($password) < 8) {
                $this->warn('Parool on liiga nõrk (alla 8 tähemärgi)!');
                if ($this->confirm('Kas soovita sisestada uue parooli?', true)) {
                    $password = $this->secret('Sisestage tugev parool');
                }
            }
            try {
                User::forceCreate([
                    'name' => $name,
                    'email' => $email,
                    'email_verified_at' => now(),
                    'password' => Hash::make($password),
                    'is_admin' => true,
                    'is_author' => true,
                ]);
                $this->info("Kasutaja edukalt loodud!");
            } catch (\Throwable $th) {
                $this->error("Midagi läks valesti!");
                return $this->line($th->getMessage());
            }
        } else {
            return $this->warn("Tühistamine Admin Kasutaja loomisel!");
        }
    }
}
