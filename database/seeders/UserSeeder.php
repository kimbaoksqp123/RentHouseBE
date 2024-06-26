<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'type' => 1,
                'name' => "Trần Minh Khuê",
                'phone' => "0333501404",
                'email' => "tranminhkhue@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'address' => "Số 21 ngõ 461, Đường Trần Khát Chân, Phường Thanh Nhàn, Hai Bà Trưng, Hà Nội",
                'cccd_number' => "040201006666",
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 1,
                'name' => "Lê Ðài Trang",
                'phone' => "0353502304",
                'email' => "ledaitrang@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'address' => "Số 15, ngách 75/42, ngõ 75, phố Hoàng Văn Thái, Thanh Xuân, Hà Nội",
                'cccd_number' => "040201006667",
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 1,
                'name' => "Võ Ðức Quang",
                'phone' => "0345654147",
                'email' => "voducquang@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'address' => "Số 37, ngõ 159, phố Nguyễn Phong Sắc, Cầu Giấy, Hà Nội",
                'cccd_number' => "040201006668",
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 1,
                'name' => "Nguyễn Cao Tiến",
                'phone' => "0367865918",
                'email' => "nguyencaotien@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'address' => "Số 99, ngõ 26, phố Cầu Diễn, Nam Từ Liêm, Hà Nội",
                'cccd_number' => "040201006669",
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 1,
                'name' => "Nguyễn Bá Thành",
                'phone' => "0323561654",
                'email' => "nguyenbathanh@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'address' => "Số 17, ngách 109, ngõ 20, phố Yên Lãng, Đống Đa, Hà Nội",
                'cccd_number' => "040201006670",
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 1,
                'name' => "Nguyễn Kiều Trinh",
                'phone' => "0387965247",
                'email' => "nguyenkieutrinh@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'address' => "Số 63, ngõ 127, phố Nguyễn Phúc Lai, Hà Đông, Hà Nội",
                'cccd_number' => "040201006671",
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 1,
                'name' => "Trần Hán Lâm",
                'phone' => "0367854679",
                'email' => "tranhanlam@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'address' => "Số 5, ngõ 30, phố Lê Hồng Phong, Phú Thọ, Thái Nguyên",
                'cccd_number' => "040201006672",
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 1,
                'name' => "Nguyễn Bình Yên",
                'phone' => "0325985742",
                'email' => "nguyenbinhyen@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'address' => "Số 12, ngõ 58, phố Đại La, Hai Bà Trưng, Hà Nội",
                'cccd_number' => "040201006673",
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 1,
                'name' => "Lê Thu Ngọc",
                'phone' => "0976568954",
                'email' => "lethungoc@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'address' => "Số 9, ngách 24/7, ngõ 24, phố Hoàng Cầu, Đống Đa, Hà Nội",
                'cccd_number' => "040201006674",
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 1,
                'name' => "Nguyễn Kim Bảo",
                'phone' => "0343684432",
                'email' => "kimbaoksqp@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'address' => "Số 9, ngách 24/7, ngõ 24, phố Hoàng Cầu, Đống Đa, Hà Nội",
                'cccd_number' => "040201009999",
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
