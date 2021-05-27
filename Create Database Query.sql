# ====================================================
# DATABASE PREPARATION :
# ====================================================


# Pembuatan Database Baru:
CREATE DATABASE IF NOT EXISTS perpusku;

# Memilih database perpusku
USE perpusku;


# CREATE TABLE =======================================

# Untuk Execute Query di Bawah ganti koneksi Database terlebih dahulu!!!
CREATE TABLE IF NOT EXISTS penerbit (
  id_penerbit int PRIMARY KEY AUTO_INCREMENT,
  penerbit varchar(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS penulis (
  id_penulis int PRIMARY KEY AUTO_INCREMENT,
  penulis varchar(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS kategori (
  id_kategori int PRIMARY KEY,
  kategori varchar(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS buku (
  isbn_buku varchar(20) PRIMARY KEY,
  judul varchar(100) NOT NULL,
  id_penerbit int NOT NULL,
  id_penulis int NOT NULL,
  id_kategori int NOT NULL,
  halaman int NOT NULL,
  stok int NOT NULL,
  tahun_terbit year NOT NULL,
  FOREIGN KEY (id_penerbit) REFERENCES penerbit(id_penerbit),
  FOREIGN KEY (id_penulis) REFERENCES penulis(id_penulis),
  FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
);

# Untuk field status (belum/sudah) membayar
CREATE TABLE IF NOT EXISTS denda (
  id_denda int PRIMARY KEY AUTO_INCREMENT,
  jumlah_denda int NOT NULL,
  status_bayar varchar(20) DEFAULT 'belum'
);

CREATE TABLE IF NOT EXISTS peminjam (
  id_peminjam int PRIMARY KEY AUTO_INCREMENT,
  nama_peminjam varchar(50) NOT NULL,
  nik varchar(20) NOT NULL,
  alamat varchar(50) NOT NULL,
  no_telp varchar(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS pegawai (
  id_pegawai int PRIMARY KEY AUTO_INCREMENT,
  username varchar(50),
  password varchar(50),
  role varchar(50) NOT NULL DEFAULT 'pegawai',
  nama_pegawai varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  nik varchar(20) NOT NULL,
  alamat varchar(50) NOT NULL,
  no_telp varchar(20) NOT NULL
);

# Kolom status untuk mengetahui buku (sudah/belum) dikembalikan
CREATE TABLE IF NOT EXISTS peminjaman (
  id_peminjaman int PRIMARY KEY AUTO_INCREMENT,
  id_peminjam int NOT NULL,
  isbn_buku varchar(20) NOT NULL,
  id_denda int NOT NULL,
  id_pegawai int NOT NULL,
  tanggal_pinjam date NOT NULL,
  tanggal_kembali date NOT NULL,
  status_dikembalikan varchar(20) DEFAULT 'belum',
  FOREIGN KEY (id_peminjam) REFERENCES peminjam(id_peminjam),
  FOREIGN KEY (isbn_buku) REFERENCES buku(isbn_buku),
  FOREIGN KEY (id_pegawai) REFERENCES pegawai(id_pegawai),
  FOREIGN KEY (id_denda) REFERENCES denda(id_denda)
);

# Membuat tabel log_buku jika belum ada
CREATE TABLE IF NOT EXISTS log_buku(
  isbn_buku varchar(20) PRIMARY KEY,
  judul varchar(100) NOT NULL,
  id_penerbit int NOT NULL,
  id_penulis int NOT NULL,
  id_kategori int NOT NULL,
  halaman int NOT NULL,
  stok int NOT NULL,
  tahun_terbit year NOT NULL,
  FOREIGN KEY (id_penerbit) REFERENCES penerbit(id_penerbit),
  FOREIGN KEY (id_penulis) REFERENCES penulis(id_penulis),
  FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
);

# Membuat tabel log_peminjaman jika tidak ada
# CREATE TABLE IF NOT EXISTS log_peminjaman(
#  id_peminjaman int PRIMARY KEY,
#  id_peminjam int NOT NULL,
#  isbn_buku varchar(20) NOT NULL,
#  id_denda int NOT NULL,
#  id_pegawai int NOT NULL,
#  tanggal_pinjam date NOT NULL,
#  tanggal_kembali date NOT NULL,
#  status_dikembalikan varchar(20) DEFAULT 'belum'
#);

# Membuat tabel log_pegawai jika belum ada
CREATE TABLE IF NOT EXISTS log_pegawai(
  id_pegawai int PRIMARY KEY,
  username varchar(50),
  password varchar(50),
  role varchar(50) NOT NULL DEFAULT 'pegawai',
  nama_pegawai varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  nik varchar(20) NOT NULL,
  alamat varchar(50) NOT NULL,
  no_telp varchar(20) NOT NULL
);


# INSERT DATA ========================================

# Insert data pegawai: (example)
INSERT INTO pegawai (username, password, role, nama_pegawai, email, nik, alamat, no_telp)
VALUES 
  ('admin',     'admin',        'admin',    'Kadek Andre Suryana',  'Andresuryana17@gmail.com', '1908561103', 'Klungkung',  '081239732992'),
  ('pegawai1',  'pegawai123',   'pegawai',  'Pegawai 1',            'Pegawai1@gmail.com',       '1928477728', 'Denpasar',   '086789543652');


# Insert data kategori
INSERT INTO kategori (id_kategori, kategori)
VALUES
  (1, 'Novel'),
  (2, 'Masakan'),
  (3, 'Bisnis'),
  (4, 'Komik'),
  (5, 'Komputer dan Teknologi'),
  (6, 'Anak-anak'),
  (7, 'Ensiklopedia'),
  (8, 'Fiksi dan Literatur'),
  (9, 'Lainnya');

# Insert data penerbit
INSERT INTO penerbit (id_penerbit, penerbit)
VALUES
  (1, 'Benteng Pustaka'),
  (2, 'Gramedia'),
  (3, 'Elex Media Komputindo'),
  (4, 'M&C'),
  (5, 'GagasMedia'),
  (6, 'Mizan'),
  (7, 'Charissa Publisher'),
  (8, 'Kanisius');

# Insert data penulis
INSERT INTO penulis (id_penulis, penulis)
VALUES
  (1, 'Andrea Hirata'),
  (2, 'Ahmad Fuadi'),
  (3, 'John Green'),
  (4, 'Lanny Rustan'),
  (5, 'Theodorus Setyo'),
  (6, 'Napoleon Hill'),
  (7, 'Peter Theil'),
  (8, 'Aoyama Gosho'),
  (9, 'Ono Eriko'),
  (10, 'Hamdan Lugina Jaya'),
  (11, 'Tim Ems'),
  (12, 'Adhitya Mulya'),
  (13, 'Adel'),
  (14, 'Adiria Dian'),
  (15, 'Retnoning Tyas'),
  (16, 'Anies'),
  (17, 'Ahmad Tohari'),
  (18, 'Mario Bloem');

# Insert data tabel buku
INSERT INTO buku (isbn_buku, judul, id_penerbit, id_penulis, id_kategori, halaman, stok, tahun_terbit)
VALUES
  ('9793062797', 'Laskar Pelangi', 1, 1, 1, 529, 6, '2005'),
  ('9789792248616', 'Negeri 5 Menara',  2, 2, 1, 416, 4, '2009'),
  ('9781101434208', 'Looking For Alaska', 2, 3, 1, 297, 3, '2005'),
  ('9786239546021', 'Sabtu Bersama Bapak', 5, 12, 1, 372, 8, '2021'),
  ('9786020646558', '30 Resep Jajan Pasar Ala Master Kue Tradisional', 2, 4, 2, 96, 2, '2020'),
  ('9786020648118', 'Indonesian Modern Food: 60 Resep Masakan Citarasa Indonesia Modern', 2, 5, 2, 136, 3, '2020'),
  ('9786020630663', 'Think and Grow Rich', 2, 6, 3, 406, 2, '1937'),
  ('9786020321486', 'Zero To One: Membangun Startup Membangun Masa Depan', 2, 7, 3, 224, 2, '2014'),
  ('9786020276373', 'Detektif Conan Movie: The Lost Ship In The Sky (last)', 3, 8, 4, 216, 4, '2015'),
  ('9786022109518', 'Hai, Miiko! 25', 4, 9, 4, 200, 5, '2013'),
  ('9786020287126', 'Ciptakan Aplikasi Otomatis di Excel', 3, 10, 5, 260, 5, '2016'),
  ('9786020274010', 'Pemrograman Android Dalam Sehari', 3, 11, 5, 168, 3, '2015'),
  ('9786022427018', 'KKPK: The Seven Angels', 6, 13, 6, 112, 5, '2016'),
  ('9786020273396', 'Kumpulan Cerita Hewan Hampir Punah', 3, 14, 6, 76, 3, '2016'),
  ('9786021659847', 'Mengenal Transportasi Super Canggih', 7, 15, 7, 91, 6, '2016'),
  ('9789792149371', 'Ensiklopedia Penyakit', 8, 16, 7, 538, 3, '2016'),
  ('9786020300450', 'Mata Yang Enak Dipandang', 2, 17, 8, 215, 5, '2013'),
  ('9786024240974', 'Moemie (gadis Berusia Seratus Tahun)', 2, 18, 8, 619, 7, '2016');


# CREATE VIEW ========================================

# Total Buku
CREATE VIEW totalBuku AS
  SELECT SUM(stok) AS total_buku
  FROM buku;


# Total Buku yg Dipinjam
CREATE VIEW bukuDipinjam AS
  SELECT COUNT(id_peminjaman) AS buku_dipinjam
  FROM peminjaman
  INNER JOIN buku b ON peminjaman.isbn_buku = b.isbn_buku
  WHERE status_dikembalikan = 'belum';


# Buku Paling Sering Dipinjam
CREATE VIEW bukuSeringDipinjam AS
  SELECT b.judul, COUNT(p.isbn_buku) AS total_dipinjam
  FROM peminjaman AS p
  INNER JOIN buku b ON p.isbn_buku = b.isbn_buku
  GROUP BY p.isbn_buku
  ORDER BY total_dipinjam DESC
  LIMIT 5;


# Buku Terbaru
CREATE VIEW bukuTerbaru AS
  SELECT judul, tahun_terbit 
  FROM buku
  ORDER BY tahun_terbit DESC
  LIMIT 5;


# Tabel Peminjaman Terbaru (Limit 5)
CREATE VIEW peminjamanTerbaru AS
  SELECT 
    p1.nama_peminjam, 
    b.judul, DATE_FORMAT(p.tanggal_pinjam, '%d-%m-%Y') AS tanggal_pinjam, 
    DATE_FORMAT(p.tanggal_kembali, '%d-%m-%Y') AS tanggal_kembali, 
    p.status_dikembalikan
  FROM peminjaman AS p
  INNER JOIN peminjam p1 ON p.id_peminjam = p1.id_peminjam
  INNER JOIN buku b ON p.isbn_buku = b.isbn_buku
  ORDER BY tanggal_pinjam DESC
  LIMIT 5;

# View Tabel Peminjaman
CREATE VIEW tabelPeminjaman AS
  SELECT 
    p.id_peminjaman, 
    p1.nama_peminjam, 
    b.judul, 
    d.jumlah_denda, 
    p2.username, 
    DATE_FORMAT(p.tanggal_pinjam, '%d-%m-%Y') AS tanggal_pinjam, 
    DATE_FORMAT(p.tanggal_kembali, '%d-%m-%Y') AS tanggal_kembali, 
    p.status_dikembalikan
  FROM 
    peminjaman AS p
  INNER JOIN peminjam p1 ON p.id_peminjam = p1.id_peminjam
  INNER JOIN buku b ON p.isbn_buku = b.isbn_buku
  INNER JOIN denda d ON p.id_denda = d.id_denda
  INNER JOIN pegawai p2 ON p.id_pegawai = p2.id_pegawai;

# View Tabel Denda
CREATE VIEW tabelDenda AS
  SELECT d.id_denda, p1.nama_peminjam, d.jumlah_denda, d.status_bayar
  FROM denda AS d 
  INNER JOIN peminjaman AS p ON d.id_denda = p.id_denda
  INNER JOIN peminjam AS p1 ON p.id_peminjam = p1.id_peminjam
  GROUP BY d.id_denda;

# View Tabel Pegawai
CREATE VIEW tabelPegawai AS
  SELECT
    id_pegawai,
    username,
    role,
    nama_pegawai,
    nik,
    email,
    no_telp,
    alamat
  FROM pegawai;

# Show Data Buku Order By (termasuk buku yang telah dihapus)
CREATE VIEW showAllDataBuku AS
  SELECT b.isbn_buku, b.judul, terbit.penerbit, tulis.penulis, k.kategori, b.halaman, b.stok, b.tahun_terbit
  FROM buku AS b
  INNER JOIN penerbit AS terbit ON b.id_penerbit = terbit.id_penerbit
  INNER JOIN penulis AS tulis ON b.id_penulis = tulis.id_penulis
  INNER JOIN kategori AS k ON b.id_kategori = k.id_kategori
  UNION 
  SELECT lb.isbn_buku, CONCAT_WS(" ", "<b>(Deleted)</b>", lb.judul), terbit.penerbit, tulis.penulis, k.kategori, lb.halaman, lb.stok, lb.tahun_terbit
  FROM log_buku AS lb
  INNER JOIN penerbit AS terbit ON lb.id_penerbit = terbit.id_penerbit
  INNER JOIN penulis AS tulis ON lb.id_penulis = tulis.id_penulis
  INNER JOIN kategori AS k ON lb.id_kategori = k.id_kategori;

# Show Data Buku Aktif
CREATE VIEW showAllDataBukuAktif AS
  SELECT b.isbn_buku, b.judul, terbit.penerbit, tulis.penulis, k.kategori, b.halaman, b.stok, b.tahun_terbit
  FROM buku AS b
  INNER JOIN penerbit AS terbit ON b.id_penerbit = terbit.id_penerbit
  INNER JOIN penulis AS tulis ON b.id_penulis = tulis.id_penulis
  INNER JOIN kategori AS k ON b.id_kategori = k.id_kategori;


# STORED PROCEDURE ===================================

# Procedure Tamabah Pegawai
DELIMITER $$
  CREATE PROCEDURE tambahPegawai(
    IN nusername varchar(50),
    IN npassword varchar(50),
    IN nrole varchar(50),
    IN nnama_pegawai varchar(50),
    IN nemail varchar(50),
    IN nnik varchar(20),
    IN nalamat varchar(50), 
    IN nno_telp varchar(20)
  )
  BEGIN
    INSERT INTO pegawai (username, password, role, nama_pegawai, email, nik, alamat, no_telp)
    VALUES (nusername, npassword, nrole, nnama_pegawai, nemail, nnik, nalamat, nno_telp);
  END $$
DELIMITER ;

# Edit Data Pegawai
DELIMITER $$
  CREATE PROCEDURE editPegawai(
    IN nid_pegawai int,
    IN nusername varchar(50),
    IN npassword varchar(50),
    IN nrole varchar(50),
    IN nnama_pegawai varchar(50),
    IN nemail varchar(50),
    IN nnik varchar(20),
    IN nalamat varchar(50), 
    IN nno_telp varchar(20)
  )
  BEGIN
    UPDATE pegawai
    SET
      username = nusername,
      password = npassword,
      role = nrole,
      nama_pegawai = nnama_pegawai,
      email = nemail,
      nik = nnik,
      alamat = nalamat,
      no_telp = nno_telp
    WHERE id_pegawai = nid_pegawai;
  END $$
DELIMITER ;

# Hapus Data Pegawai
DELIMITER $$
  CREATE PROCEDURE hapusPegawai(IN nid_pegawai int)
  BEGIN
    DELETE FROM pegawai WHERE id_pegawai = nid_pegawai;
  END $$
DELIMITER ;

# Tambah Data Buku Baru
DELIMITER $$
  CREATE PROCEDURE tambahBuku(
    IN nisbn varchar(20),
    IN njudul varchar(100),
    IN npenerbit int,
    IN npenulis int,
    IN nkategori int,
    IN nhalaman int,
    IN nstok int, 
    IN ntahun year
  )
  BEGIN
    INSERT INTO buku (isbn_buku, judul, id_penerbit, id_penulis, id_kategori, halaman, stok, tahun_terbit)
    VALUES (nisbn, njudul, npenerbit, npenulis, nkategori, nhalaman, nstok, ntahun);
  END $$
DELIMITER ;

# Edit Data Buku
DELIMITER $$
  CREATE PROCEDURE editBuku(
    IN nisbn_buku varchar(20),
    IN njudul varchar(100),
    IN npenerbit int,
    IN npenulis int,
    IN nkategori int,
    IN nhalaman int,
    IN nstok int, 
    IN ntahun_terbit year
  )
  BEGIN
    UPDATE buku
    SET
      judul = njudul,
      id_penerbit = npenerbit,
      id_penulis = npenulis,
      id_kategori = nkategori,
      halaman = nhalaman,
      stok = nstok,
      tahun_terbit = ntahun_terbit
    WHERE isbn_buku = nisbn_buku;
  END $$
DELIMITER ;

# Hapus Data Buku
  # a. Buat trigger: sebelum delete buku, data yg akan dihapus dimasukkan ke dalam tabel 'log_buku'
  # b. Buat trigger: jika buku dihapus maka data pada tabel peminjaman juga dihapus,
  #    oleh karena itu buat trigger: sebelum delete data peminjaman, data peminjaman yg akan dihapus dimasukkan ke dalam tabel 'log_peminjaman'
DELIMITER $$
  CREATE PROCEDURE hapusBuku(IN nisbn_buku varchar(20))
  BEGIN
    DELETE FROM buku WHERE isbn_buku = nisbn_buku;
  END $$
DELIMITER ;

# Procedure approve pengembalian buku
DELIMITER $$
  CREATE PROCEDURE approvePengembalianBuku(IN nid_peminjaman int)
  BEGIN
    UPDATE peminjaman AS p
    INNER JOIN denda AS d ON p.id_denda = d.id_denda
    SET 
      d.jumlah_denda = 
      CASE 
        WHEN p.tanggal_kembali < CURDATE() AND d.status_bayar = 'belum' 
          THEN d.jumlah_denda + 10000
        WHEN p.tanggal_kembali < CURDATE() AND (d.status_bayar = 'lunas' AND d.jumlah_denda != 0) 
          THEN 10000 END, 
      d.status_bayar = 'belum',
      p.status_dikembalikan = 'sudah'
    WHERE id_peminjaman = nid_peminjaman;
  END $$
DELIMITER ;

SELECT * FROM tabelDenda d;

# Procedure Approve Pembayaran Denda
DELIMITER $$
  CREATE PROCEDURE approvePembayaranDenda(IN nid_denda int)
  BEGIN
    UPDATE denda 
    SET status_bayar = 'lunas'
    WHERE id_denda = nid_denda;
  END $$
DELIMITER ;

# Get Judul By ISBN
DELIMITER $$
  CREATE PROCEDURE getJudul(IN nisbn_buku varchar(20))
  BEGIN
    SELECT judul 
    FROM buku
    WHERE isbn_buku = nisbn_buku;
  END $$
DELIMITER ;

# getIdPenerbitByName
DELIMITER $$
  CREATE PROCEDURE getIdPenerbit(IN nama_penerbit varchar(50))
  BEGIN
    SELECT id_penerbit
    FROM penerbit
    WHERE penerbit = nama_penerbit
    LIMIT 1;
  END $$
DELIMITER ;


# getIdPenulisByName
DELIMITER $$
  CREATE PROCEDURE getIdPenulis(IN nama_penulis varchar(50))
  BEGIN
    SELECT id_penulis
    FROM penulis
    WHERE penulis = nama_penulis;
  END $$
DELIMITER ;

# Show Judul All Buku In Stock (stok tidak kosong)
DELIMITER $$
  CREATE PROCEDURE showJudulBukuInStock()
  BEGIN
    SELECT isbn_buku, judul 
    FROM buku 
    WHERE stok > 0
    ORDER BY judul ASC;
  END $$
DELIMITER ;

# Tampilkan Semua Nama Peminjam
DELIMITER $$
  CREATE PROCEDURE showPeminjam()
  BEGIN
    SELECT id_peminjam, nama_peminjam FROM peminjam;
  END $$
DELIMITER ;

# Get id_pegawai by username
DELIMITER $$
  CREATE PROCEDURE getIdPegawai(IN nusername varchar(50))
  BEGIN
    SELECT id_pegawai FROM pegawai WHERE username = nusername;
  END $$
DELIMITER ;

# Add New penerbit
DELIMITER $$
  CREATE PROCEDURE addNewPenerbit(IN nama_penerbit varchar(50))
  BEGIN
    INSERT INTO penerbit (penerbit)
    VALUES (nama_penerbit);
  END $$
DELIMITER ;

# Add New penulis
DELIMITER $$
  CREATE PROCEDURE addNewPenulis(IN nama_penulis varchar(50))
  BEGIN
    INSERT INTO penulis (penulis)
    VALUES (nama_penulis);
  END $$
DELIMITER ;


# TRIGGERS ===============================================

# Trigger masukan data buku ke 'log_buku'
DELIMITER $$
  CREATE TRIGGER bd_buku
  BEFORE DELETE ON buku
  FOR EACH ROW BEGIN
    # Memasukkan data ke log_buku
    INSERT INTO log_buku (isbn_buku, judul, id_penerbit, id_penulis, id_kategori, halaman, stok, tahun_terbit)
    VALUES (OLD.isbn_buku, OLD.judul, OLD.id_penerbit, OLD.id_penulis, OLD.id_kategori, OLD.halaman, OLD.stok, OLD.tahun_terbit);

    # Delete data buku bersangkutan dari data tabel peminjaman
    DELETE FROM peminjaman 
    WHERE isbn_buku = OLD.isbn_buku;
  END $$
DELIMITER ;  

# Trigger masukan data ke log_peminjaman
DELIMITER $$
  CREATE TRIGGER bd_peminjaman
  BEFORE DELETE ON peminjaman
  FOR EACH ROW BEGIN
    # Masuk data log_peminjaman
    INSERT INTO log_peminjaman(id_peminjaman, id_peminjam, isbn_buku, id_denda, id_pegawai, tanggal_pinjam, tanggal_kembali, status_dikembalikan)
    VALUES (OLD.id_peminjaman, OLD.id_peminjam, OLD.isbn_buku, OLD.id_denda, OLD.id_pegawai, OLD.tanggal_pinjam, OLD.tanggal_kembali, OLD.status_dikembalikan);
  END $$
DELIMITER ;

# Trigger masukan data pegawai ke 'log_pegawai'
DELIMITER $$
  CREATE TRIGGER bd_pegawai
  BEFORE DELETE ON pegawai
  FOR EACH ROW BEGIN
    # Memasukkan data ke log_pegawai
    INSERT INTO log_pegawai (id_pegawai, username, password, role, nama_pegawai, email, nik, alamat, no_telp)
    VALUES (OLD.id_pegawai, OLD.username, OLD.password, OLD.role, OLD.nama_pegawai, OLD.email, OLD.nik, OLD.alamat, OLD.no_telp);

    # Delete data buku bersangkutan dari data tabel peminjaman
    DELETE FROM peminjaman
    WHERE id_pegawai = OLD.id_pegawai;
  END $$
DELIMITER ; 

# Setiap ada data peminjam baru, maka langsung akan dibuatkan denda
# id_peminjam = id_denda
DELIMITER $$
  CREATE TRIGGER ai_peminjam
  AFTER INSERT ON peminjam
  FOR EACH ROW BEGIN
    INSERT INTO denda(jumlah_denda, status_bayar)
    VALUES (0, 'belum');
  END $$
DELIMITER ;

# Trigger mengurangi stok buku jika ada buku dipinjam
DELIMITER $$
  CREATE TRIGGER ai_peminjaman
  AFTER INSERT ON peminjaman
  FOR EACH ROW BEGIN
    UPDATE buku
    SET stok = stok - 1
    WHERE isbn_buku = NEW.isbn_buku;
  END $$
DELIMITER ;

# Trigger menambah stok buku jika buku dikembalikan (after update on )
DELIMITER $$
  CREATE TRIGGER au_peminjaman
  AFTER UPDATE ON peminjaman
  FOR EACH ROW BEGIN
    UPDATE buku
    SET stok = stok + 1
    WHERE isbn_buku = NEW.isbn_buku;
  END $$
DELIMITER ;


