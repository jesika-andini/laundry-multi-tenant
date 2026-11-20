# LaundryMap — integrasi web dan modul Admin

Paket ini menyatukan route web, autentikasi, modul Admin, model Tenant, dan direktori laundry agar memakai satu aplikasi Laravel dan satu tabel `tenants`.

## Fitur yang disambungkan

- Beranda utama: `/`
- Direktori laundry aktif: `/layanan` (membaca data tenant dari database)
- Daftar dan masuk akun: `/daftar` dan `/masuk`
- Dashboard mitra: `/tenant/dashboard` (role `tenant`)
- Dashboard Admin: `/admin` (role `admin` atau `super_admin`)
- Kelola data tenant: `/admin/tenants` (CRUD tambah dan edit)
- Modul Admin menggunakan middleware `web`, `auth`, dan `superadmin`, sehingga session, CSRF, serta pesan validasi tersedia.
- Model `App\\Models\\Tenant` menjadi model utama yang digunakan Admin, API, middleware, dan relasi aplikasi.

## Cara menerapkan pada project Laragon

1. Backup folder project dan database terlebih dahulu.
2. Ekstrak ZIP ini ke folder sementara, lalu salin file/folder hasil ekstrak ke folder project `D:\laragon\www\Laundry-Multitenant`. Izinkan file yang sama untuk ditimpa.
3. Jangan mengganti file `.env` milikmu. Pastikan konfigurasi database yang sekarang tetap benar dan atur `SESSION_DRIVER=file`.
4. Pastikan database MySQL `laundry_multi_tenant` (atau nama database yang dipakai pada `.env`) sudah dibuat di phpMyAdmin.
5. Buka terminal pada folder project, lalu jalankan:

```bash
composer dump-autoload -o
php artisan optimize:clear
php artisan migrate
php artisan route:list
```

6. Jika perintah migration selesai tanpa error, jalankan:

```bash
php artisan serve
```

7. Buka `http://127.0.0.1:8000`.

> Jangan menjalankan `php artisan migrate:fresh` pada database yang berisi data penting karena perintah itu menghapus tabel dan data.

## Akses halaman Admin

Pendaftaran publik hanya membuat akun ber-role `customer`. Untuk memberi akses Admin pada akun yang sudah ada, ubah rolenya melalui phpMyAdmin, tab SQL:

```sql
UPDATE users
SET role = 'admin'
WHERE email = 'email-akunmu@example.com';
```

Ganti email contoh dengan email akun yang benar. Setelah itu logout dan login kembali. Akun dengan role `admin` atau `super_admin` dapat membuka `/admin` dan `/admin/tenants`.

## Catatan ruang lingkup

Data tenant yang disimpan oleh halaman Admin sekarang menjadi data yang sama dengan yang dibaca halaman `/layanan` dan API tenant. Halaman layanan/pesanan mitra masih berupa fondasi tampilan pada source awal; tabel dan proses CRUD layanan/pesanan belum lengkap di project sumber, jadi paket ini tidak mengklaim fitur tersebut sudah aktif.

## Menyelesaikan Git Rebase yang sedang berjalan

Paket ini sengaja tidak membawa folder `.git` agar metadata repository dan konflik lokal tidak tertimpa. Terapkan file paket ke folder project yang sudah ada (jangan hapus folder `.git` atau `.env`). Karena repository kamu sebelumnya sedang berada dalam proses rebase:

```bash
git add -A
git status
```

Pastikan bagian `Unmerged paths` sudah tidak muncul. **Pertahankan `app/Models/Tenant.php`** karena model inti ini dipakai API, middleware tenant, dan relasi model lainnya. Setelah tidak ada konflik, lanjutkan:

```bash
git rebase --continue
git -c http.version=HTTP/1.1 push -u origin main
```

Jangan memakai `git push --force` untuk menyelesaikan konflik tersebut.
