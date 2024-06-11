CREATE DATABASE perpustakaan;
USE perpustakaan;

CREATE TABLE buku (
  id INT PRIMARY KEY AUTO_INCREMENT,
  judul VARCHAR(255) NOT NULL,
  harga_sewa_harian DECIMAL(10,2) NOT NULL,
  stok INT NOT NULL DEFAULT 0
);

CREATE TABLE peminjaman (
  id INT PRIMARY KEY AUTO_INCREMENT,
  tanggal_pinjam TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE dipinjam (
  id INT PRIMARY KEY AUTO_INCREMENT,
  peminjaman_id INT,
  buku_id INT,
  hari INT,
  jumlah INT,
  FOREIGN KEY (peminjaman_id) REFERENCES peminjaman(id),
  FOREIGN KEY (buku_id) REFERENCES buku(id)
);

-- Trigger update stock
DELIMITER $$
CREATE TRIGGER after_delete_dipinjam
AFTER DELETE ON dipinjam
FOR EACH ROW
BEGIN
    UPDATE buku SET stok = stok + OLD.jumlah WHERE id = OLD.buku_id;
END$$
DELIMITER ;

INSERT INTO buku (judul, harga_sewa_harian, stok) VALUES
  ('Harry Potter and the Sorcerer\'s Stone', 10000, 5),
  ('The Great Gatsby', 15000, 2),
  ('To Kill a Mockingbird', 12000, 3),
  ('Pride and Prejudice', 8000, 4),
  ('The Catcher in the Rye', 9000, 1);
