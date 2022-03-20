<?php
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'jose',
            'email' => 'ebjose781@gmail.com',
            'password' => Hash::make('12345678'),
            'pagina' => 'https//jose.com.mx'
        ]);
    }
}
