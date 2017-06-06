<?php
use Illuminate\Database\Seeder;
use Aizxin\Models\Role;
use Aizxin\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('slug','admin')->first();
        $user = Role::where('slug','user')->first();
       	factory(User::class, 1)->create([
       		'name' => '管理员',
          'username' => 'admin',
       		'email' => '709344897@qq.com',
       		'password' => bcrypt('admin888'),
       	])->each(function ($u) use ($admin){
            $u->attachRole($admin);
        });

        factory(User::class, 3)->create([
            'password' => bcrypt('admin888')
        ])->each(function ($u) use ($user){
            $u->attachRole($user);
        });
    }
}
