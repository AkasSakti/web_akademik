-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Mar 2024 pada 05.40
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_webakademis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(10) NOT NULL,
  `ID_Dosen` char(30) NOT NULL,
  `Password_Admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `ID_Dosen`, `Password_Admin`) VALUES
('admin', 'KO-001N', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `ID_Dosen` char(7) NOT NULL,
  `Nama_Dosen` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`ID_Dosen`, `Nama_Dosen`) VALUES
('KO-001N', 'Zikrie Pramudia A'),
('KO-002N', 'Rachmad Andri Atmoko'),
('KO-003N', 'Bayu Sutawijaya'),
('KO-004N', 'Salnan Ratih Asriningtyas'),
('KO-005N', 'I Dewa Made Widia'),
('KO-006N', 'Eka Ratri Noor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `ID_Jadwal` int(11) NOT NULL,
  `ID_Dosen` char(7) NOT NULL,
  `ID_Matkul` char(6) NOT NULL,
  `ID_Ruangan` char(10) NOT NULL,
  `Hari` varchar(7) NOT NULL,
  `Jam_Masuk` time NOT NULL,
  `Jam_Keluar` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`ID_Jadwal`, `ID_Dosen`, `ID_Matkul`, `ID_Ruangan`, `Hari`, `Jam_Masuk`, `Jam_Keluar`) VALUES
(6, 'KO-002N', 'VTT500', 'A402', 'Kamis', '07:00:00', '14:20:00'),
(8, 'KO-001N', 'VTT500', 'A402', 'Kamis', '11:11:03', '14:11:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NIM` char(9) NOT NULL,
  `Nama_Mhs` varchar(30) DEFAULT NULL,
  `Tingkat` char(1) NOT NULL,
  `Password` varchar(30) DEFAULT NULL,
  `Alamat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`NIM`, `Nama_Mhs`, `Tingkat`, `Password`, `Alamat`) VALUES
('171511001', 'Akas', '4', 'demo', 'Malang'),
('171511002', 'Bagus', '4', 'demo', 'Malang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `ID_Matkul` char(6) NOT NULL,
  `Nama_Matkul` varchar(30) NOT NULL,
  `SKS_Matkul` int(11) NOT NULL,
  `Semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`ID_Matkul`, `Nama_Matkul`, `SKS_Matkul`, `Semester`) VALUES
('VTT500', 'Pemrogramman Web Framework', 4, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mengajar`
--

CREATE TABLE `mengajar` (
  `ID_Dosen` char(7) NOT NULL,
  `ID_Matkul` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mengajar`
--

INSERT INTO `mengajar` (`ID_Dosen`, `ID_Matkul`) VALUES
('KO-001N', 'VTT500'),
('KO-002N', 'VTT500');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `ID_Matkul` char(6) NOT NULL,
  `NIM` char(9) NOT NULL,
  `Nilai` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`ID_Matkul`, `NIM`, `Nilai`) VALUES
('VTT500', '171511001', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `ID_Ruangan` char(10) NOT NULL,
  `Nama_Ruangan` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`ID_Ruangan`, `Nama_Ruangan`) VALUES
('A402', 'Ruang Kela');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD KEY `fk_admin_dosen` (`ID_Dosen`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`ID_Dosen`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`ID_Jadwal`),
  ADD KEY `fk_jadwal_ruangan` (`ID_Ruangan`),
  ADD KEY `fk_jadwal_mengajar` (`ID_Matkul`,`ID_Dosen`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NIM`);

--
-- Indeks untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`ID_Matkul`);

--
-- Indeks untuk tabel `mengajar`
--
ALTER TABLE `mengajar`
  ADD PRIMARY KEY (`ID_Dosen`,`ID_Matkul`),
  ADD KEY `fk_mengajar_matkul` (`ID_Matkul`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`NIM`,`ID_Matkul`),
  ADD KEY `fk_nilai_matkul` (`ID_Matkul`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`ID_Ruangan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `ID_Jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_dosen` FOREIGN KEY (`ID_Dosen`) REFERENCES `dosen` (`ID_Dosen`);

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `fk_jadwal_mengajar` FOREIGN KEY (`ID_Matkul`,`ID_Dosen`) REFERENCES `mengajar` (`ID_Matkul`, `ID_Dosen`),
  ADD CONSTRAINT `fk_jadwal_ruangan` FOREIGN KEY (`ID_Ruangan`) REFERENCES `ruangan` (`ID_Ruangan`);

--
-- Ketidakleluasaan untuk tabel `mengajar`
--
ALTER TABLE `mengajar`
  ADD CONSTRAINT `fk_dosen_mengajar` FOREIGN KEY (`ID_Dosen`) REFERENCES `dosen` (`ID_Dosen`),
  ADD CONSTRAINT `fk_mengajar_matkul` FOREIGN KEY (`ID_Matkul`) REFERENCES `mata_kuliah` (`ID_Matkul`);

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `fk_nilai_mahasiswa` FOREIGN KEY (`NIM`) REFERENCES `mahasiswa` (`NIM`),
  ADD CONSTRAINT `fk_nilai_matkul` FOREIGN KEY (`ID_Matkul`) REFERENCES `mata_kuliah` (`ID_Matkul`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
