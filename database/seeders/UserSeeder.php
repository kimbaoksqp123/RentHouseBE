<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
        [
            [
                'type' => 1,
                'name' => "Trần Minh Khuê",
                'phone' => "0333501404",
                'email' => "tranminhkhue@gmail.com",
                'avatar' => 'url_avatar',
                'username' => "tranminhkhue",
                'password' => '12345678',
            ],
            [
                'type' => 1,
                'name' => "Lê Ðài Trang",
                'phone' => "0353502304",
                'email' => "ledaitrang@gmail.com",
                'avatar' => 'url_avatar',
                'username' => "ledaitrang",
                'password' => '12345678',
            ],
            [
                'type' => 1,
                'name' => "Võ Ðức Quang",
                'phone' => "0345654147",
                'email' => "voducquang@gmail.com",
                'avatar' => 'url_avatar',
                'username' => "voducquang",
                'password' => '12345678',
            ],
            [
                'type' => 1,
                'name' => "Nguyễn Cao Tiến",
                'phone' => "0367865918",
                'email' => "nguyencaotien@gmail.com",
                'avatar' => 'url_avatar',
                'username' => "nguyencaotien",
                'password' => '12345678',
            ],
            [
                'type' => 1,
                'name' => "Nguyễn Bá Thành",
                'phone' => "0323561654",
                'email' => "nguyenbathanh@gmail.com",
                'avatar' => 'url_avatar',
                'username' => "nguyenbathanh",
                'password' => '12345678',
            ],
            [
                'type' => 1,
                'name' => "Nguyễn Kiều Trinh",
                'phone' => "0387965247",
                'email' => "nguyenkieutrinh@gmail.com",
                'avatar' => 'url_avatar',
                'username' => "nguyenkieutrinh",
                'password' => '12345678',
            ],
            [
                'type' => 1,
                'name' => "Trần Hán Lâm",
                'phone' => "0367854679",
                'email' => "tranhanlam@gmail.com",
                'avatar' => 'url_avatar',
                'username' => "tranhanlam",
                'password' => '12345678',
            ],
            [
                'type' => 1,
                'name' => "Nguyễn Bình Yên",
                'phone' => "0325985742",
                'email' => "nguyenbinhyen@gmail.com",
                'avatar' => 'url_avatar',
                'username' => "nguyenbinhyen",
                'password' => '12345678',
            ],
            [
                'type' => 1,
                'name' => "Lê Thu Ngọc",
                'phone' => "0976568954",
                'email' => "lethungoc@gmail.com",
                'avatar' => 'url_avatar',
                'username' => "lethungoc",
                'password' => '12345678',
            ],
            [
                'type' => 1,
                'name' => "Đào Mỹ Nga",
                'phone' => "0986578352",
                'email' => "daomynga@gmail.com",
                'avatar' => 'url_avatar',
                'username' => "daomynga",
                'password' => '12345678',
            ],
            [
                'type' => 1,
                'name' => "Vũ Bá Quân",
                'phone' => "0986348352",
                'email' => "vubaquan@gmail.com",
                'avatar' => 'url_avatar',
                'username' => "vubaquan",
                'password' => '12345678',
            ],
            [
                'type' => 2,
                'name' => "Nguyễn Kim Bảo",
                'phone' => "062357854",
                'email' => "nguyenkimbao@gmail.com",
                'avatar' => 'url_avatar',
                'username' => "nguyenkimbao",
                'password' => '12345678',
            ],
            [
                'type' => 2,
                'name' => "Hứa Việt Hoàng",
                'phone' => "062357854",
                'email' => "huaviethoang@gmail.com",
                'avatar' => 'url_avatar',
                'username' => "huaviethoang",
                'password' => '12345678',
            ]
        ]);
    }
}
