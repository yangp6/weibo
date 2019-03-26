<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();
        //批量数据，转换为数组
        $data = $users->makeVisible(['password','remember_token'])->toArray();
        User::insert($data);

        //将第一个用户单独设置
        $user = User::find(1);
        $user->name = 'young';
        $user->email = 'yangping0607@163.com';
        $user->password = bcrypt('123456');
        $user->save();
    }
}
