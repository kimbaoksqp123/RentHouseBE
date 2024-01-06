# Trang web tìm kiếm phòng trọ

## 1. Shiyousho
[火1-OSAKE-k64-ITSS2_システム仕様書（Shichinin）](https://docs.google.com/spreadsheets/d/1HsgODrQXpRjcx2sSIUbgq6Z2qDV6rKnhnmoF6Ia8sk8/edit#gid=1605266564)

## 2. Cài đặt dự án

### 2.1. Cài đặt package
    composer install

### 2.2. Tạo database và kết nối
- Tạo database với tên ***student_apartment_db***
- Duplicate tệp ***.env.example***, đổi tên thành ***.env***

### 2.3. Tạo key dự án
    php artisan key:generate

### 2.4. Migrate database
    php artisan migrate

### 2.5. Chạy các file seeder tạo dữ liệu mẫu
    php artisan migrate:refresh --seed

### 2.6. Chạy dự án
    php artisan serve
