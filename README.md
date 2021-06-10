# final_manager_gym
# chạy các lệnh sau cài thư viện
# front end
1 npm install
2 npm run serve

# backedn
1 composer install
2 coppy .env.example và sửa thành .env ( mở file sửa cấu hình tên databse DB_DATABASE=tên database  , lưu ý tên database mình tạo ra cái database rỗng có cái tên này thôi nha)
3 php artisan migrate
4 php artisan key:generate
5 php artisan passport:install
6 php artisan db:seed
7 php artisan serve
