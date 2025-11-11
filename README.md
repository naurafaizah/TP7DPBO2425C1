Saya Naura Nur Faizah dengan NIM 2408352 mengerjakan TP 7 dalam mata kuliah Desain Pemrograman Berbasis Objek untuk keberkahan-Nya maka saya tidak akan melakukan kecurangan seperti yang telah di spesifikasikan

# penjelasan website
Website ini merupakan website katalog sederhana bernama Catalog App, yang digunakan untuk mengelola data produk.
Terdiri dari tiga entitas utama:

Products → data barang yang dijual
Categories → jenis atau kategori produk
Users → orang yang menambahkan produk

Setiap produk memiliki kategori dan user yang menambahkannya, sehingga data antar tabel saling terhubung melalui relasi foreign key. Tujuannya adalah untuk menampilkan, menambah, mengubah, dan menghapus data (CRUD) dari ketiga entitas tersebut.

# penjelasan database
Struktur database terdiri dari tiga tabel, yaitu tabel category, tabel user, dan tabel product. 
- Tabel category menyimpan data kategori produk seperti nama kategori. Tabel user menyimpan data pengguna yang menambahkan produk.
- Sedangkan tabel product menyimpan data produk seperti nama, harga, kategori, dan pengguna yang menambahkannya.
- Relasi antar tabel diatur melalui foreign key, di mana product.category_id terhubung dengan category.id, dan product.user_id terhubung dengan user.id. Dengan demikian, setiap produk selalu memiliki kategori dan pengguna yang terhubung.

# penjelasan struktur dan alur program
Struktur program dibagi ke dalam beberapa folder agar lebih teratur. Folder config berisi file db.php yang digunakan untuk mengatur koneksi ke database. Folder class berisi file Product.php, Category.php, dan User.php yang masing-masing berisi operasi CRUD (Create, Read, Update, Delete) untuk setiap tabel. Folder view berisi file tampilan seperti products.php, categories.php, dan users.php yang digunakan untuk menampilkan data serta form input. Selain itu terdapat file header.php yang berisi navbar agar navigasi antar halaman tetap konsisten. File style.css digunakan untuk mengatur tampilan halaman, sedangkan file index.php merupakan halaman utama aplikasi.

Alur kerja program dimulai dari halaman index.php yang menampilkan halaman utama dengan navbar. Pengguna dapat menavigasi ke halaman Products, Categories, atau Users. Masing-masing halaman akan memanggil class sesuai entitasnya untuk menampilkan data dari database. Jika pengguna mengisi form untuk menambah data, menekan tombol edit, atau menghapus data, maka sistem akan menjalankan method di class terkait yang menggunakan prepared statement untuk berinteraksi dengan database.

# penjelasan cara kerja website
Dalam penggunaan website ini, pengisian data dilakukan secara berurutan agar relasi antar tabel tetap konsisten. Pertama, pengguna harus menambahkan data pada tabel Users terlebih dahulu, karena setiap produk akan dikaitkan dengan pengguna tertentu. Setelah itu, pengguna dapat menambahkan data kategori pada tabel Categories untuk menentukan kelompok produk. Jika data pengguna dan kategori sudah ada, barulah pengguna dapat menambahkan data produk pada tabel Products dengan memilih kategori dan pengguna yang sesuai

# dokumentasi
ada di folder dokumentasi
