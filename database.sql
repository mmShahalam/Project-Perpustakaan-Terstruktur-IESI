CREATE DATABASE perpustakaan;

CREATE TABLE buku (
  id INT PRIMARY KEY AUTO_INCREMENT,
  judul VARCHAR(255) NOT NULL,
  harga_sewa_harian DECIMAL(10,2) NOT NULL
);

CREATE TABLE peminjaman (
  id INT PRIMARY KEY AUTO_INCREMENT,
  tanggal_pinjam TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE dipinjam (
  peminjaman_id INT,
  buku_id INT,
  hari INT,
  FOREIGN KEY (peminjaman_id) REFERENCES peminjaman(id),
  FOREIGN KEY (buku_id) REFERENCES buku(id)
);

INSERT INTO buku (judul, harga_sewa_harian) VALUES
  ('Harry Potter and the Sorcerer\'s Stone', 10000),
  ('The Great Gatsby', 15000),
  ('To Kill a Mockingbird', 12000),
  ('Pride and Prejudice', 8000),
  ('The Catcher in the Rye', 9000);