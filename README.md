# Aplikasi Payment Services PHP Native

Project ini dibuat dengan PHP Native, menggunakan fungsi routing untuk keamanan url.

### Requirements:

1. Mysql > 5.7 / MariaDB > 10.4.21.
2. PHP > 7.0.

### How to Use
1. Clone project lalu buka project yang telah di clone melalui Terminal/CMD.
2. Sesuaikan konfigurasi database pada file `src/config/app.php`.
3. Pada Terminal/CMD ketikan perintah : `php migrate.php` untuk menjalankan migrasi file database.
4. setelah berhasil migrasi database jalankan web service dengan mengetikan perintah: `php -S localhost:8083 public/index.php`
5. untuk informasi terkait API, dapat mengimport collection postman yang terdapat dalam project ini.
6. untuk proses update / merubah status transaksi. ketikan perintah `php transaction-cli.php {references_id} {status}`
7. Apabila keluaran `[1]` itu berarti data transaksi sukses di ubah. jika `[0]` data transaksi tidak ada perubahan. dan jika `[Failed]` terjadi error.