<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = array(

            array('code' => 'HCM', 'name' => 'Thành phố Hồ Chí Minh'),
            array('code' => 'HN', 'name' => 'Hà Nội'),
            array('code' => 'HP', 'name' => 'Hải Phòng'),
            array('code' => 'DN', 'name' => 'Đà Nẵng'),
            array('code' => 'QT', 'name' => 'Quảng Trị'),
            array('code' => 'BD', 'name' => 'Bình Dương'),
            array('code' => 'LA', 'name' => 'Long An'),
            array('code' => 'TN', 'name' => 'Tây Ninh'),
            array('code' => 'BU', 'name' => 'Bình Thuận'),
            array('code' => 'BP', 'name' => 'Bình Phước'),
            array('code' => 'BL', 'name' => 'Bạc Liêu'),
            array('code' => 'BR', 'name' => 'Bà Rịa - Vũng Tàu'),
            array('code' => 'BGG', 'name' => 'Bắc Giang'),
            array('code' => 'BHN', 'name' => 'Bắc Ninh'),
            array('code' => 'BTR', 'name' => 'Bến Tre'),
            array('code' => 'CB', 'name' => 'Cao Bằng'),
            array('code' => 'CM', 'name' => 'Cà Mau'),
            array('code' => 'CT', 'name' => 'Cần Thơ'),
            array('code' => 'DT', 'name' => 'Đồng Tháp'),
            array('code' => 'DN', 'name' => 'Đắk Nông'),
            array('code' => 'DG', 'name' => 'Đắk Lắk'),
            array('code' => 'GL', 'name' => 'Gia Lai'),
            array('code' => 'HD', 'name' => 'Hải Dương'),
            array('code' => 'HG', 'name' => 'Hà Giang'),
            array('code' => 'HT', 'name' => 'Hà Tĩnh'),
            array('code' => 'HY', 'name' => 'Hậu Giang'),
            array('code' => 'HG', 'name' => 'Hòa Bình'),
            array('code' => 'HM', 'name' => 'Hưng Yên'),
            array('code' => 'KH', 'name' => 'Khánh Hòa'),
            array('code' => 'KG', 'name' => 'Kiên Giang'),
            array('code' => 'KT', 'name' => 'Kon Tum'),
            array('code' => 'LC', 'name' => 'Lào Cai'),
            array('code' => 'LD', 'name' => 'Lâm Đồng'),
            array('code' => 'LS', 'name' => 'Lạng Sơn'),
            array('code' => 'NB', 'name' => 'Nghệ An'),
            array('code' => 'NĐ', 'name' => 'Ninh Định'),
            array('code' => 'NT', 'name' => 'Ninh Thuận'),
            array('code' => 'PT', 'name' => 'Phú Thọ'),
            array('code' => 'QB', 'name' => 'Quảng Bình'),
            array('code' => 'QG', 'name' => 'Quảng Ngãi'),
            array('code' => 'QN', 'name' => 'Quảng Ninh'),
            array('code' => 'QT', 'name' => 'Quảng Trị'),
            array('code' => 'ST', 'name' => 'Sóc Trăng'),
            array('code' => 'SL', 'name' => 'Sơn La'),
            array('code' => 'TN', 'name' => 'Thái Nguyên'),
            array('code' => 'TH', 'name' => 'Thanh Hóa'),
            array('code' => 'TG', 'name' => 'Tiền Giang'),
            array('code' => 'TN', 'name' => 'Thừa Thiên Huế'),
            array('code' => 'TT', 'name' => 'Trà Vinh'),
            array('code' => 'TV', 'name' => 'Tuyên Quang'),
            array('code' => 'VL', 'name' => 'Vĩnh Long'),
            array('code' => 'VT', 'name' => 'Vĩnh Phúc'),
            array('code' => 'YN', 'name' => 'Yên Bái'),
        );

        DB::table('countries')->insert($countries);
    }
}
