<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class JwtMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:jwt-menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menú para login o generar token JWT';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Menú JWT ===');

        $option = $this->choice(
            'Elige una opción',
            ['Login', 'Generar token'],
            0
        );

        switch ($option) {
            case 'Login':
                $this->doLogin();
                break;

            case 'Generar token':
                $this->generateToken();
                break;
        }
    }

    private function doLogin()
    {
        $email = $this->ask('Ingresa tu email');
        $password = $this->secret('Ingresa tu contraseña');

        if(!Auth::attempt(['email' => $email, 'password' => $password])){
            $this->error('Usuario o contraseña incorrectos');
            return;
        }

        $user = Auth::user();

        $token = auth('api')->login($user);

        $this->info("Login exitoso. Token: $token");
    }
    
    private function generateToken()
    {
        $userId = $this->ask('Ingresa el ID del usuario para generar token');

        $user = User::find($userId);

        if (!$user){
            $this->error("Usuario con ID $userId no encontrado");
            return;
        }

        $token = auth('api')->login($user);

        $this->info("Token generado para {$user->email}: $token");
    }
}
