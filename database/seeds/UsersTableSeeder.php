<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = new User();
        $u->name = "Oliver";
        $u->password = "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi";
        $u->email = "admin@admin.com";
        $u->admin = true;
        $u->save();
       

        //factory(App\User::class,50)->create();
        //Create a notepad and user at the same time
        factory(App\Notepad::class,49)->create();
    }
}

