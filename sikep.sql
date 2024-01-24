-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jan 2024 pada 07.46
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikep`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'testing', 'admin.1234', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2023-12-27 01:26:25', '2023-12-28 13:18:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cutis`
--

CREATE TABLE `cutis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_cuti` varchar(255) DEFAULT NULL,
  `alasan_cuti` varchar(255) DEFAULT NULL,
  `mulai_cuti` varchar(255) DEFAULT NULL,
  `selesai_cuti` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `jumlah_hari` int(11) DEFAULT NULL,
  `link_cuti` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cutis`
--

INSERT INTO `cutis` (`id`, `pegawai_id`, `jenis_cuti`, `alasan_cuti`, `mulai_cuti`, `selesai_cuti`, `no_hp`, `alamat`, `jumlah_hari`, `link_cuti`, `created_at`, `updated_at`) VALUES
(1, 2, 'cuti tahunan', '123', '2024-01-05', '2024-01-07', '(+62) 986 9644 644', 'Gg. Kusmanto No. 156, Tual 61803, Papua', 3, '123', '2024-01-06 01:43:18', '2024-01-06 01:43:18'),
(2, 3, 'cuti tahunan', '123', '2024-08-01', '2024-08-06', '0544 9026 8822', 'Jr. Daan No. 14, Bengkulu 24641, DKI', 6, 'https://id.search.yahoo.com/search?fr=mcafee&type=E210ID91215G0&p=how+to+approve+collab+in+github', '2024-01-06 13:34:14', '2024-01-06 13:34:14'),
(3, 4, 'cuti tahunan', '123', '2024-01-02', '2024-01-05', '(+62) 913 8819 748', 'Ds. Ikan No. 684, Manado 16021, DIY', 4, 'https://id.search.yahoo.com/search?fr=mcafee&type=E210ID91215G0&p=how+to+approve+collab+in+github', '2024-01-06 13:38:05', '2024-01-06 13:38:05'),
(4, 4, 'cuti tahunan', '123', '2024-01-07', '2024-01-08', '(+62) 913 8819 748', 'Ds. Ikan No. 684, Manado 16021, DIY', 2, 'https://id.search.yahoo.com/search?fr=mcafee&type=E210ID91215G0&p=how+to+approve+collab+in+github', '2024-01-06 13:47:32', '2024-01-06 13:47:32'),
(5, 4, 'cuti tahunan', '123', '2024-01-09', '2024-01-10', '(+62) 913 8819 748', 'Ds. Ikan No. 684, Manado 16021, DIY', 2, 'https://id.search.yahoo.com/search?fr=mcafee&type=E210ID91215G0&p=how+to+approve+collab+in+github', '2024-01-06 13:48:33', '2024-01-06 13:48:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diklats`
--

CREATE TABLE `diklats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `ruangan_id` bigint(20) UNSIGNED NOT NULL,
  `nama_diklat` varchar(255) DEFAULT NULL,
  `tanggal_mulai` varchar(255) DEFAULT NULL,
  `tanggal_selesai` varchar(255) DEFAULT NULL,
  `jumlah_hari` int(11) DEFAULT NULL,
  `jumlah_jam` int(11) DEFAULT NULL,
  `penyelenggara` varchar(255) DEFAULT NULL,
  `tempat` varchar(255) DEFAULT NULL,
  `tahun` varchar(255) DEFAULT NULL,
  `no_sertifikat` varchar(255) DEFAULT NULL,
  `tanggal_sertifikat` date DEFAULT NULL,
  `link_sertifikat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `diklats`
--

INSERT INTO `diklats` (`id`, `pegawai_id`, `ruangan_id`, `nama_diklat`, `tanggal_mulai`, `tanggal_selesai`, `jumlah_hari`, `jumlah_jam`, `penyelenggara`, `tempat`, `tahun`, `no_sertifikat`, `tanggal_sertifikat`, `link_sertifikat`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '123', '2024-01-06', '2024-01-06', 1, 5, '123', 'Dinkes', '2024', '123', '2024-01-06', 'https://www.youtube.com/watch?v=PGr3NVRN5DA', '2024-01-06 01:32:05', '2024-01-06 01:32:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hari_besars`
--

CREATE TABLE `hari_besars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tanggal` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hari_besars`
--

INSERT INTO `hari_besars` (`id`, `keterangan`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'hari libur nasional', '2024-01-01', '2024-01-06 01:46:46', '2024-01-06 01:46:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kenaikan_pangkats`
--

CREATE TABLE `kenaikan_pangkats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `pangkat_golongan_id` bigint(20) UNSIGNED NOT NULL,
  `pangkat_golongan_sebelumnya_id` bigint(20) UNSIGNED NOT NULL,
  `ruangan_id` bigint(20) UNSIGNED NOT NULL,
  `tmt_sebelumnya` varchar(255) DEFAULT NULL,
  `tmt_pangkat_dari` date DEFAULT NULL,
  `tmt_pangkat_sampai` date DEFAULT NULL,
  `no_sk` varchar(255) DEFAULT NULL,
  `tanggal_sk` varchar(255) DEFAULT NULL,
  `penerbit_sk` varchar(255) DEFAULT NULL,
  `link_sk` text DEFAULT NULL,
  `status_tipe` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kenaikan_pangkats`
--

INSERT INTO `kenaikan_pangkats` (`id`, `pegawai_id`, `pangkat_golongan_id`, `pangkat_golongan_sebelumnya_id`, `ruangan_id`, `tmt_sebelumnya`, `tmt_pangkat_dari`, `tmt_pangkat_sampai`, `no_sk`, `tanggal_sk`, `penerbit_sk`, `link_sk`, `status_tipe`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 1, 3, '2024-01-04', '2024-01-06', '2028-01-06', '123', '2024-01-06', 'rsud', 'https://www.youtube.com/results?search_query=laravel+project+e+commerce', 'pppk', '2024-01-06 01:34:49', '2024-01-06 01:34:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_12_20_075419_create_pangkat_golongans_table', 1),
(6, '2023_08_09_094933_create_ruangans_table', 1),
(7, '2023_08_20_115009_create_pegawais_table', 1),
(8, '2023_08_24_025509_create_cutis_table', 1),
(9, '2023_08_24_043739_create_s_t_r_s_table', 1),
(10, '2023_08_24_043758_create_s_i_p_s_table', 1),
(11, '2023_09_18_055415_create_mutasi_table', 1),
(12, '2023_09_21_013135_create_hari_besars_table', 1),
(13, '2023_09_23_011512_create_diklat_table', 1),
(14, '2023_09_29_172649_kenaikan_pangkats_table', 1),
(15, '2023_10_05_090549_create_admins_table', 1),
(16, '2023_11_02_071436_create_notifikasis_table', 1),
(17, '2023_11_02_101817_create_notifikasi_admin_table', 1),
(18, '2023_11_03_074102_create_notifikasi_pegawai_table', 1),
(19, '2023_12_09_091255_create_promosi_demosis_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mutasis`
--

CREATE TABLE `mutasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `ruangan_awal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ruangan_tujuan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `instansi_awal` varchar(255) DEFAULT NULL,
  `instansi_tujuan` varchar(255) DEFAULT NULL,
  `jenis_mutasi` enum('internal','eksternal') NOT NULL DEFAULT 'internal',
  `tanggal_berlaku` date DEFAULT NULL,
  `no_sk` varchar(255) DEFAULT NULL,
  `tanggal_sk` date DEFAULT NULL,
  `link_sk` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mutasis`
--

INSERT INTO `mutasis` (`id`, `pegawai_id`, `ruangan_awal_id`, `ruangan_tujuan_id`, `instansi_awal`, `instansi_tujuan`, `jenis_mutasi`, `tanggal_berlaku`, `no_sk`, `tanggal_sk`, `link_sk`, `created_at`, `updated_at`) VALUES
(4, 2, 3, 4, NULL, NULL, 'internal', '2024-01-06', '123', '2024-01-06', '123', '2024-01-06 10:40:32', '2024-01-06 10:40:32'),
(5, 2, 4, 6, NULL, NULL, 'internal', '2025-01-06', '123', '2025-01-06', 'https://www.youtube.com/results?search_query=laravel+project+e+commerce', '2024-01-06 10:44:16', '2024-01-06 10:56:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasis`
--

CREATE TABLE `notifikasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pesan` varchar(255) DEFAULT NULL,
  `jenis_notifikasi` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `dibaca` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `notifikasis`
--

INSERT INTO `notifikasis` (`id`, `pesan`, `jenis_notifikasi`, `icon`, `status`, `dibaca`, `created_at`, `updated_at`) VALUES
(1, 'Mutasi pegawai Wasis Vero Adriansyah berhasil ditambahkan oleh testing', 'mutasi', 'fas fa-compress-alt', 'bg-success', 0, '2024-01-06 01:30:50', '2024-01-06 01:30:50'),
(2, 'Data diklat pegawai Wasis Vero Adriansyah berhasil dibuat oleh testing', 'diklat', 'fas fa-chalkboard-teacher', 'bg-success', 0, '2024-01-06 01:32:05', '2024-01-06 01:32:05'),
(3, 'Data kenaikan pangkat pegawai Wasis Vero Adriansyah berhasil dibuat oleh testing', 'kenaikan pangkat', 'fas fa-calendar-day', 'bg-success', 0, '2024-01-06 01:34:49', '2024-01-06 01:34:49'),
(4, ' pegawai Bella Wastuti berhasil ditambahkan oleh testing', 'jabatan', 'fas fa-compress-alt', 'bg-success', 0, '2024-01-06 01:40:08', '2024-01-06 01:40:08'),
(5, 'Data cuti pegawai Wasis Vero Adriansyah berhasil dibuat oleh testing', 'cuti', 'fas fa-calendar-week', 'bg-success', 0, '2024-01-06 01:43:18', '2024-01-06 01:43:18'),
(6, 'data STR pegawai Wasis Vero Adriansyah berhasil  dibuat oleh testing', 'str', 'fas fa-folder-plus', 'bg-success', 0, '2024-01-06 01:44:54', '2024-01-06 01:44:54'),
(7, 'Mutasi pegawai Wasis Vero Adriansyah berhasil ditambahkan oleh testing', 'mutasi', 'fas fa-compress-alt', 'bg-success', 0, '2024-01-06 10:07:51', '2024-01-06 10:07:51'),
(8, 'Mutasi pegawai Wasis Vero Adriansyah berhasil ditambahkan oleh testing', 'mutasi', 'fas fa-compress-alt', 'bg-success', 0, '2024-01-06 10:39:30', '2024-01-06 10:39:30'),
(9, 'Mutasi pegawai Wasis Vero Adriansyah berhasil ditambahkan oleh testing', 'mutasi', 'fas fa-compress-alt', 'bg-success', 0, '2024-01-06 10:40:32', '2024-01-06 10:40:32'),
(10, 'Mutasi pegawai Wasis Vero Adriansyah berhasil ditambahkan oleh testing', 'mutasi', 'fas fa-compress-alt', 'bg-success', 0, '2024-01-06 10:44:16', '2024-01-06 10:44:16'),
(11, 'mutasi  pegawai Wasis Vero Adriansyah berhasil  diupdate oleh testing', 'mutasi', 'fas fa-compress-alt', 'bg-success', 0, '2024-01-06 10:46:37', '2024-01-06 10:46:37'),
(12, 'mutasi  pegawai Wasis Vero Adriansyah berhasil  diupdate oleh testing', 'mutasi', 'fas fa-compress-alt', 'bg-success', 0, '2024-01-06 10:49:54', '2024-01-06 10:49:54'),
(13, 'mutasi  pegawai Wasis Vero Adriansyah berhasil  diupdate oleh testing', 'mutasi', 'fas fa-compress-alt', 'bg-success', 0, '2024-01-06 10:50:35', '2024-01-06 10:50:35'),
(14, 'mutasi  pegawai Wasis Vero Adriansyah berhasil  diupdate oleh testing', 'mutasi', 'fas fa-compress-alt', 'bg-success', 0, '2024-01-06 10:52:18', '2024-01-06 10:52:18'),
(15, 'mutasi  pegawai Wasis Vero Adriansyah berhasil  diupdate oleh testing', 'mutasi', 'fas fa-compress-alt', 'bg-success', 0, '2024-01-06 10:52:48', '2024-01-06 10:52:48'),
(16, 'mutasi  pegawai Wasis Vero Adriansyah berhasil  diupdate oleh testing', 'mutasi', 'fas fa-compress-alt', 'bg-success', 0, '2024-01-06 10:56:04', '2024-01-06 10:56:04'),
(17, 'mutasi  pegawai Wasis Vero Adriansyah berhasil  diupdate oleh testing', 'mutasi', 'fas fa-compress-alt', 'bg-success', 0, '2024-01-06 10:56:46', '2024-01-06 10:56:46'),
(18, 'Data cuti pegawai Ghaliyati Patricia Farida berhasil dibuat oleh testing', 'cuti', 'fas fa-calendar-week', 'bg-success', 0, '2024-01-06 13:34:14', '2024-01-06 13:34:14'),
(19, 'Data cuti pegawai Gilda Sadina Mandasari S.Ked berhasil dibuat oleh testing', 'cuti', 'fas fa-calendar-week', 'bg-success', 0, '2024-01-06 13:38:05', '2024-01-06 13:38:05'),
(20, 'Data cuti pegawai Gilda Sadina Mandasari S.Ked berhasil dibuat oleh testing', 'cuti', 'fas fa-calendar-week', 'bg-success', 0, '2024-01-06 13:47:32', '2024-01-06 13:47:32'),
(21, 'Data cuti pegawai Gilda Sadina Mandasari S.Ked berhasil dibuat oleh testing', 'cuti', 'fas fa-calendar-week', 'bg-success', 0, '2024-01-06 13:48:33', '2024-01-06 13:48:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi_admin`
--

CREATE TABLE `notifikasi_admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notifikasi_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `notifikasi_admin`
--

INSERT INTO `notifikasi_admin` (`id`, `notifikasi_id`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 5, 1, NULL, NULL),
(6, 6, 1, NULL, NULL),
(7, 7, 1, NULL, NULL),
(8, 8, 1, NULL, NULL),
(9, 9, 1, NULL, NULL),
(10, 10, 1, NULL, NULL),
(11, 11, 1, NULL, NULL),
(12, 12, 1, NULL, NULL),
(13, 13, 1, NULL, NULL),
(14, 14, 1, NULL, NULL),
(15, 15, 1, NULL, NULL),
(16, 16, 1, NULL, NULL),
(17, 17, 1, NULL, NULL),
(18, 18, 1, NULL, NULL),
(19, 19, 1, NULL, NULL),
(20, 20, 1, NULL, NULL),
(21, 21, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi_pegawai`
--

CREATE TABLE `notifikasi_pegawai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `notifikasi_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `notifikasi_pegawai`
--

INSERT INTO `notifikasi_pegawai` (`id`, `pegawai_id`, `notifikasi_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 7, 4, NULL, NULL),
(5, 2, 5, NULL, NULL),
(6, 2, 6, NULL, NULL),
(7, 2, 7, NULL, NULL),
(8, 2, 8, NULL, NULL),
(9, 2, 9, NULL, NULL),
(10, 2, 10, NULL, NULL),
(11, 2, 11, NULL, NULL),
(12, 2, 12, NULL, NULL),
(13, 2, 13, NULL, NULL),
(14, 2, 14, NULL, NULL),
(15, 2, 15, NULL, NULL),
(16, 2, 16, NULL, NULL),
(17, 2, 17, NULL, NULL),
(18, 3, 18, NULL, NULL),
(19, 4, 19, NULL, NULL),
(20, 4, 20, NULL, NULL),
(21, 4, 21, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pangkat_golongans`
--

CREATE TABLE `pangkat_golongans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nama_kecil` varchar(255) NOT NULL,
  `jenis` enum('pns','pppk') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pangkat_golongans`
--

INSERT INTO `pangkat_golongans` (`id`, `nama`, `nama_kecil`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 'testing/8', 'testing/5', 'pppk', '2024-01-04 15:52:44', '2024-01-04 15:52:44'),
(2, 'testing/4', 'testing/9', 'pppk', '2024-01-04 15:52:44', '2024-01-04 15:52:44'),
(3, 'testing/9', 'testing/2', 'pppk', '2024-01-04 15:52:44', '2024-01-04 15:52:44'),
(4, 'testing/6', 'testing/9', 'pns', '2024-01-04 15:52:44', '2024-01-04 15:52:44'),
(5, 'testing/6', 'testing/9', 'pppk', '2024-01-04 15:52:44', '2024-01-04 15:52:44'),
(6, 'Gol. A', 'gol. a', 'pppk', '2024-01-06 01:34:49', '2024-01-06 01:34:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `nip_nippk` varchar(255) DEFAULT NULL,
  `gelar_depan` varchar(255) DEFAULT NULL,
  `gelar_belakang` varchar(255) DEFAULT NULL,
  `nama_depan` varchar(255) DEFAULT NULL,
  `nama_belakang` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `usia` varchar(255) DEFAULT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `no_wa` varchar(255) DEFAULT NULL,
  `status_pegawai` varchar(255) DEFAULT NULL,
  `ruangan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tahun_pensiun` varchar(255) DEFAULT NULL,
  `pendidikan_terakhir` varchar(255) DEFAULT NULL,
  `tanggal_lulus` varchar(255) DEFAULT NULL,
  `no_ijazah` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `cuti_tahunan` int(11) DEFAULT 12,
  `tahun_cuti` int(11) NOT NULL DEFAULT 2023,
  `sisa_cuti_tahunan` int(11) DEFAULT NULL,
  `masa_kerja` varchar(255) DEFAULT NULL,
  `status_tenaga` enum('asn','non asn') DEFAULT NULL,
  `status_tipe` enum('pns','pppk','thl') DEFAULT NULL,
  `tmt_cpns` varchar(255) DEFAULT NULL,
  `tmt_pns` varchar(255) DEFAULT NULL,
  `tmt_pppk` varchar(255) DEFAULT NULL,
  `tmt_pangkat_terakhir` varchar(255) DEFAULT NULL,
  `pangkat_golongan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sekolah` varchar(255) DEFAULT NULL,
  `jenis_tenaga` enum('struktural','umum','nakes') DEFAULT NULL,
  `niPtt_pkThl` varchar(255) DEFAULT NULL,
  `tanggal_masuk` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `no_karpeg` varchar(255) DEFAULT NULL,
  `no_taspen` varchar(255) DEFAULT NULL,
  `no_npwp` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pelatihan` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status_nonaktif` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pegawais`
--

INSERT INTO `pegawais` (`id`, `nik`, `nip_nippk`, `gelar_depan`, `gelar_belakang`, `nama_depan`, `nama_belakang`, `nama_lengkap`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `usia`, `agama`, `no_wa`, `status_pegawai`, `ruangan_id`, `tahun_pensiun`, `pendidikan_terakhir`, `tanggal_lulus`, `no_ijazah`, `jabatan`, `cuti_tahunan`, `tahun_cuti`, `sisa_cuti_tahunan`, `masa_kerja`, `status_tenaga`, `status_tipe`, `tmt_cpns`, `tmt_pns`, `tmt_pppk`, `tmt_pangkat_terakhir`, `pangkat_golongan_id`, `sekolah`, `jenis_tenaga`, `niPtt_pkThl`, `tanggal_masuk`, `created_at`, `updated_at`, `no_karpeg`, `no_taspen`, `no_npwp`, `no_hp`, `email`, `pelatihan`, `password`, `status_nonaktif`) VALUES
(2, '30809', '89138', 'i', 'l', 'Rendy Prasetyo S.Gz', 'Rafi Jasmani Pangestu', 'Wasis Vero Adriansyah', 'laki-laki', 'banyuwangi', '2001-10-10', 'Gg. Kusmanto No. 156, Tual 61803, Papua', '23', 'islam', '(+62) 986 9644 644', 'aktif', 6, '2056', 'D4', '2023-10-10', '659390', 'rem', 12, 2023, 9, '12', 'asn', 'pppk', NULL, NULL, '2022-10-10', '2024-01-06', 6, 'Politeknik Negeri Banyuwangi', 'nakes', NULL, NULL, '2023-12-01 15:52:44', '2024-01-06 10:56:46', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$0trgQyZpNz42lHLUp7iAvecd77j.RuagTPGoQ5KdB2DncMXR9zE2a', NULL),
(3, '81954', '77726', 'l', 'r', 'Wulan Nuraini S.Farm', 'Kasim Prasetya', 'Ghaliyati Patricia Farida', 'laki-laki', 'banyuwangi', '2001-10-10', 'Jr. Daan No. 14, Bengkulu 24641, DKI', '21', 'islam', '0544 9026 8822', 'aktif', 1, '2056', 'D4', '2023-10-10', '600236', 'omnis', 12, 2023, 6, '12', 'asn', 'pppk', NULL, NULL, '2022-10-10', '2024-01-04', 1, 'Politeknik Negeri Banyuwangi', 'nakes', NULL, NULL, '2024-01-04 15:52:44', '2024-01-06 13:34:14', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Dr.peQ4cMMHCgLF20b2BI.NV6cmMMuu7AAMrBgbLwFrfe90fx9kK.', NULL),
(4, '95204', '72700', 'v', 'l', 'Maryanto Marpaung S.E.I', 'Kemba Dongoran', 'Gilda Sadina Mandasari S.Ked', 'laki-laki', 'banyuwangi', '2001-10-10', 'Ds. Ikan No. 684, Manado 16021, DIY', '25', 'islam', '(+62) 913 8819 748', 'aktif', 1, '2056', 'D4', '2023-10-10', '808410', 'voluptates', 12, 2023, 4, '12', 'asn', 'pppk', NULL, NULL, '2022-10-10', '2024-01-04', 1, 'Politeknik Negeri Banyuwangi', 'nakes', NULL, NULL, '2024-01-04 15:52:44', '2024-01-06 13:48:33', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$pNahD4rKlOjE3mUOCtwSy.iPj5ELTFRcKrUOHW8666TpKsC5qQG9m', NULL),
(5, '46997', '18018', 'p', 'r', 'Almira Widya Hariyah', 'Banawa Banara Maryadi S.H.', 'Nasim Anggriawan S.E.', 'laki-laki', 'banyuwangi', '2001-10-10', 'Jr. Basoka Raya No. 842, Sibolga 51389, Bengkulu', '24', 'islam', '(+62) 27 7826 955', 'aktif', 1, '2056', 'D4', '2023-10-10', '352634', 'dolorum', 12, 2023, 12, '12', 'asn', 'pppk', NULL, NULL, '2022-10-10', '2024-01-04', 1, 'Politeknik Negeri Banyuwangi', 'nakes', NULL, NULL, '2024-01-04 15:52:44', '2024-01-04 15:52:44', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$SbS8bLdqMnOpiT5/K0DvouJvkYUL3ZjIDUWRo/Jx2XZLPBL23tAwC', NULL),
(6, '85147', '51087', 'c', 'l', 'Muhammad Latupono', 'Rudi Jumadi Marpaung', 'Lili Laksmiwati', 'laki-laki', 'banyuwangi', '2001-10-10', 'Ds. Lada No. 520, Tual 38100, Jateng', '24', 'islam', '028 2907 666', 'aktif', 1, '2056', 'D4', '2023-10-10', '427725', 'ut', 12, 2023, 12, '12', 'asn', 'pppk', NULL, NULL, '2022-10-10', '2024-01-04', 1, 'Politeknik Negeri Banyuwangi', 'nakes', NULL, NULL, '2024-01-04 15:52:44', '2024-01-04 15:52:44', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$82SRce99/s/p1VDyXOV/mOD1KhjL.FNsSiGFFsLb3xtpIcxsZQAcO', NULL),
(7, '49298', '94481', 't', 'o', 'Tugiman Samosir', 'Jamil Prabowo Samosir S.Pd', 'Bella Wastuti', 'laki-laki', 'banyuwangi', '2001-10-10', 'Kpg. Baranangsiang No. 656, Gorontalo 83467, Bengkulu', '24', 'islam', '0866 4755 1698', 'aktif', 3, '2056', 'D4', '2023-10-10', '996286', 'staff', 12, 2023, 12, '12', 'asn', 'pppk', NULL, NULL, '2022-10-10', '2024-01-04', 1, 'Politeknik Negeri Banyuwangi', 'nakes', NULL, NULL, '2024-01-04 15:52:44', '2024-01-06 01:40:07', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$0l8stVS4QLOUdzZ0n2/bcOxWRhJGZTGL.YNGiiUT.mleGEEnTtQJ6', NULL),
(8, '14383', '70548', 'f', 'q', 'Cahyanto Latupono', 'Bajragin Satya Mansur', 'Titi Rahmawati', 'laki-laki', 'banyuwangi', '2001-10-10', 'Ki. Sutarto No. 49, Banjar 49975, Pabar', '22', 'islam', '0632 9224 6944', 'aktif', 1, '2056', 'D4', '2023-10-10', '205743', 'minus', 12, 2023, 12, '12', 'asn', 'pppk', NULL, NULL, '2022-10-10', '2024-01-04', 1, 'Politeknik Negeri Banyuwangi', 'nakes', NULL, NULL, '2024-01-04 15:52:44', '2024-01-04 15:52:44', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$3oXcPQqP/ftYUUm6CJ8/qes0IgDGKlUJRi9V3z00yUbUlQs607akW', NULL),
(9, '71999', '10105', 'n', 'd', 'Jaga Sihombing S.IP', 'Reksa Kasim Siregar', 'Cagak Natsir', 'laki-laki', 'banyuwangi', '2001-10-10', 'Ki. Abdul Muis No. 807, Samarinda 43737, Jabar', '21', 'islam', '(+62) 29 2093 4585', 'aktif', 1, '2056', 'D4', '2023-10-10', '732801', 'doloremque', 12, 2023, 12, '12', 'asn', 'pppk', NULL, NULL, '2022-10-10', '2024-01-04', 1, 'Politeknik Negeri Banyuwangi', 'nakes', NULL, NULL, '2024-01-04 15:52:44', '2024-01-04 15:52:44', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Aepz/AwHMfcyRERIH598Ouv/XhJeX1cSPfHxIWmzRFiJ94uxg6I86', NULL),
(10, '68384', '84077', 'j', 'a', 'Mursita Gunawan', 'Jaga Wahyudin', 'Hani Kuswandari', 'laki-laki', 'banyuwangi', '2001-10-10', 'Gg. Ikan No. 755, Manado 49591, Sumsel', '20', 'islam', '(+62) 557 1372 9891', 'aktif', 1, '2056', 'D4', '2023-10-10', '308421', 'natus', 12, 2023, 12, '12', 'asn', 'pppk', NULL, NULL, '2022-10-10', '2024-01-04', 1, 'Politeknik Negeri Banyuwangi', 'nakes', NULL, NULL, '2024-01-04 15:52:44', '2024-01-04 15:52:44', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$TVLZKJY9aNNr8C0WdD3wIelVhkQL0Laucfxffgypq2FirnTouEBD.', NULL),
(11, '77094', '38824', 'w', 'v', 'Paris Nuraini S.Gz', 'Yusuf Widodo', 'Ciaobella Rahmawati S.T.', 'laki-laki', 'banyuwangi', '2001-10-10', 'Ds. Samanhudi No. 280, Sibolga 30571, Sulteng', '25', 'islam', '(+62) 467 6870 5314', 'aktif', 1, '2056', 'D4', '2023-10-10', '713834', 'earum', 12, 2023, 12, '12', 'asn', 'pppk', NULL, NULL, '2022-10-10', '2024-01-04', 1, 'Politeknik Negeri Banyuwangi', 'nakes', NULL, NULL, '2024-01-04 15:52:44', '2024-01-04 15:52:44', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$0HDANQuNxuzpQChA2CjnPemGPGbqSAJO3k8nJwRRqjwebNJfs3fzO', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `promosi_demosis`
--

CREATE TABLE `promosi_demosis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `ruanganawal_id` bigint(20) UNSIGNED NOT NULL,
  `ruanganbaru_id` bigint(20) UNSIGNED NOT NULL,
  `jabatan_sebelumnya` varchar(255) DEFAULT NULL,
  `jabatan_selanjutnya` varchar(255) DEFAULT NULL,
  `tanggal_berlaku` varchar(255) DEFAULT NULL,
  `no_sk` varchar(255) DEFAULT NULL,
  `tanggal_sk` varchar(255) DEFAULT NULL,
  `link_sk` varchar(255) DEFAULT NULL,
  `type` enum('demosi','promosi') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `promosi_demosis`
--

INSERT INTO `promosi_demosis` (`id`, `pegawai_id`, `ruanganawal_id`, `ruanganbaru_id`, `jabatan_sebelumnya`, `jabatan_selanjutnya`, `tanggal_berlaku`, `no_sk`, `tanggal_sk`, `link_sk`, `type`, `created_at`, `updated_at`) VALUES
(1, 7, 1, 3, 'illum', 'staff', '2024-01-06', '123', '2024-01-06', '123', 'demosi', '2024-01-06 01:40:08', '2024-01-06 01:40:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangans`
--

CREATE TABLE `ruangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_ruangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ruangans`
--

INSERT INTO `ruangans` (`id`, `nama_ruangan`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2023-12-27 01:26:25', '2023-12-27 01:26:25'),
(2, 'IT', '2024-01-06 01:16:19', '2024-01-06 01:16:19'),
(3, 'Humas', '2024-01-06 01:30:50', '2024-01-06 01:30:50'),
(4, 'kepeg', '2024-01-06 10:07:51', '2024-01-06 10:07:51'),
(5, 'kepeg', '2024-01-06 10:07:51', '2024-01-06 10:07:51'),
(6, 'testing', '2024-01-06 10:46:37', '2024-01-06 10:46:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `s_i_p_s`
--

CREATE TABLE `s_i_p_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `no_str` varchar(255) DEFAULT NULL,
  `no_sip` varchar(255) NOT NULL,
  `no_rekomendasi` varchar(255) DEFAULT NULL,
  `penerbit_sip` varchar(255) DEFAULT NULL,
  `tanggal_terbit_sip` varchar(255) NOT NULL,
  `masa_berakhir_sip` varchar(255) NOT NULL,
  `tempat_praktik` varchar(255) DEFAULT NULL,
  `link_sip` varchar(255) NOT NULL,
  `alamat_sip` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `s_t_r_s`
--

CREATE TABLE `s_t_r_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `no_sip` varchar(255) DEFAULT NULL,
  `no_str` varchar(255) NOT NULL,
  `kompetensi` varchar(255) DEFAULT NULL,
  `no_sertikom` varchar(255) DEFAULT NULL,
  `penerbit_str` varchar(255) DEFAULT NULL,
  `tanggal_terbit_str` varchar(255) NOT NULL,
  `masa_berakhir_str` varchar(255) NOT NULL,
  `link_str` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `s_t_r_s`
--

INSERT INTO `s_t_r_s` (`id`, `pegawai_id`, `no_sip`, `no_str`, `kompetensi`, `no_sertikom`, `penerbit_str`, `tanggal_terbit_str`, `masa_berakhir_str`, `link_str`, `created_at`, `updated_at`) VALUES
(1, 2, '22777881', '123', '123', '123', 'RSUD', '2024-01-06', 'Seumur Hidup', 'https://drive.google.com/file/d/0B4eE3EAAsV6jaXg5SXQweDUyc28/view?resourcekey=0-QeSPnTIRa2FWntQ-9ev6wQ', '2024-01-06 01:44:54', '2024-01-06 01:44:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Argono Himawan Nababan', 'kenari64@example.net', '2024-01-04 15:51:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'M6Q2pL5qga', '2024-01-04 15:51:45', '2024-01-04 15:51:45'),
(2, 'Damu Gunawan S.E.', 'zulaika.wulan@example.org', '2024-01-04 15:51:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'stQoXixFzX', '2024-01-04 15:51:45', '2024-01-04 15:51:45'),
(3, 'Kuncara Pranowo', 'aditya98@example.org', '2024-01-04 15:51:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sy8StYccIN', '2024-01-04 15:51:45', '2024-01-04 15:51:45'),
(4, 'Salman Bakidin Sihombing', 'osantoso@example.net', '2024-01-04 15:51:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'QosoYauhdA', '2024-01-04 15:51:45', '2024-01-04 15:51:45'),
(5, 'Amelia Pudjiastuti S.E.', 'lpertiwi@example.com', '2024-01-04 15:51:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '762fziJkVp', '2024-01-04 15:51:45', '2024-01-04 15:51:45'),
(6, 'Tania Novi Wijayanti S.Farm', 'yuniar.gambira@example.org', '2024-01-04 15:51:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'bMC0dEdCfN', '2024-01-04 15:51:45', '2024-01-04 15:51:45'),
(7, 'Jail Prasetyo Pranowo', 'rwijayanti@example.org', '2024-01-04 15:51:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '5IUqb9yydo', '2024-01-04 15:51:45', '2024-01-04 15:51:45'),
(8, 'Mila Ajeng Novitasari M.Kom.', 'laksmiwati.bala@example.org', '2024-01-04 15:51:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mf4aiGlFJX', '2024-01-04 15:51:45', '2024-01-04 15:51:45'),
(9, 'Edi Rajasa', 'narpati.legawa@example.net', '2024-01-04 15:51:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'h5hegGqXZz', '2024-01-04 15:51:45', '2024-01-04 15:51:45'),
(10, 'Cinthia Jelita Hariyah S.H.', 'digdaya.purnawati@example.com', '2024-01-04 15:51:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'aEpzcHM1he', '2024-01-04 15:51:45', '2024-01-04 15:51:45');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cutis`
--
ALTER TABLE `cutis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cutis_pegawai_id_foreign` (`pegawai_id`);

--
-- Indeks untuk tabel `diklats`
--
ALTER TABLE `diklats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diklats_pegawai_id_foreign` (`pegawai_id`),
  ADD KEY `diklats_ruangan_id_foreign` (`ruangan_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `hari_besars`
--
ALTER TABLE `hari_besars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kenaikan_pangkats`
--
ALTER TABLE `kenaikan_pangkats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kenaikan_pangkats_pegawai_id_foreign` (`pegawai_id`),
  ADD KEY `kenaikan_pangkats_pangkat_golongan_id_foreign` (`pangkat_golongan_id`),
  ADD KEY `kenaikan_pangkats_pangkat_golongan_sebelumnya_id_foreign` (`pangkat_golongan_sebelumnya_id`),
  ADD KEY `kenaikan_pangkats_ruangan_id_foreign` (`ruangan_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mutasis`
--
ALTER TABLE `mutasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mutasis_pegawai_id_foreign` (`pegawai_id`),
  ADD KEY `mutasis_ruangan_awal_id_foreign` (`ruangan_awal_id`),
  ADD KEY `mutasis_ruangan_tujuan_id_foreign` (`ruangan_tujuan_id`);

--
-- Indeks untuk tabel `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifikasi_admin`
--
ALTER TABLE `notifikasi_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifikasi_admin_notifikasi_id_foreign` (`notifikasi_id`),
  ADD KEY `notifikasi_admin_admin_id_foreign` (`admin_id`);

--
-- Indeks untuk tabel `notifikasi_pegawai`
--
ALTER TABLE `notifikasi_pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifikasi_pegawai_pegawai_id_foreign` (`pegawai_id`),
  ADD KEY `notifikasi_pegawai_notifikasi_id_foreign` (`notifikasi_id`);

--
-- Indeks untuk tabel `pangkat_golongans`
--
ALTER TABLE `pangkat_golongans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pegawais_nik_unique` (`nik`),
  ADD UNIQUE KEY `pegawais_nip_nippk_unique` (`nip_nippk`),
  ADD KEY `pegawais_ruangan_id_foreign` (`ruangan_id`),
  ADD KEY `pegawais_pangkat_golongan_id_foreign` (`pangkat_golongan_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `promosi_demosis`
--
ALTER TABLE `promosi_demosis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promosi_demosis_pegawai_id_foreign` (`pegawai_id`),
  ADD KEY `promosi_demosis_ruanganawal_id_foreign` (`ruanganawal_id`),
  ADD KEY `promosi_demosis_ruanganbaru_id_foreign` (`ruanganbaru_id`);

--
-- Indeks untuk tabel `ruangans`
--
ALTER TABLE `ruangans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `s_i_p_s`
--
ALTER TABLE `s_i_p_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `s_i_p_s_pegawai_id_foreign` (`pegawai_id`);

--
-- Indeks untuk tabel `s_t_r_s`
--
ALTER TABLE `s_t_r_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `s_t_r_s_pegawai_id_foreign` (`pegawai_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `cutis`
--
ALTER TABLE `cutis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `diklats`
--
ALTER TABLE `diklats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hari_besars`
--
ALTER TABLE `hari_besars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kenaikan_pangkats`
--
ALTER TABLE `kenaikan_pangkats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `mutasis`
--
ALTER TABLE `mutasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `notifikasis`
--
ALTER TABLE `notifikasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `notifikasi_admin`
--
ALTER TABLE `notifikasi_admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `notifikasi_pegawai`
--
ALTER TABLE `notifikasi_pegawai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pangkat_golongans`
--
ALTER TABLE `pangkat_golongans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `promosi_demosis`
--
ALTER TABLE `promosi_demosis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ruangans`
--
ALTER TABLE `ruangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `s_i_p_s`
--
ALTER TABLE `s_i_p_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `s_t_r_s`
--
ALTER TABLE `s_t_r_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cutis`
--
ALTER TABLE `cutis`
  ADD CONSTRAINT `cutis_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `diklats`
--
ALTER TABLE `diklats`
  ADD CONSTRAINT `diklats_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diklats_ruangan_id_foreign` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kenaikan_pangkats`
--
ALTER TABLE `kenaikan_pangkats`
  ADD CONSTRAINT `kenaikan_pangkats_pangkat_golongan_id_foreign` FOREIGN KEY (`pangkat_golongan_id`) REFERENCES `pangkat_golongans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kenaikan_pangkats_pangkat_golongan_sebelumnya_id_foreign` FOREIGN KEY (`pangkat_golongan_sebelumnya_id`) REFERENCES `pangkat_golongans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kenaikan_pangkats_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kenaikan_pangkats_ruangan_id_foreign` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangans` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mutasis`
--
ALTER TABLE `mutasis`
  ADD CONSTRAINT `mutasis_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mutasis_ruangan_awal_id_foreign` FOREIGN KEY (`ruangan_awal_id`) REFERENCES `ruangans` (`id`),
  ADD CONSTRAINT `mutasis_ruangan_tujuan_id_foreign` FOREIGN KEY (`ruangan_tujuan_id`) REFERENCES `ruangans` (`id`);

--
-- Ketidakleluasaan untuk tabel `notifikasi_admin`
--
ALTER TABLE `notifikasi_admin`
  ADD CONSTRAINT `notifikasi_admin_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifikasi_admin_notifikasi_id_foreign` FOREIGN KEY (`notifikasi_id`) REFERENCES `notifikasis` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `notifikasi_pegawai`
--
ALTER TABLE `notifikasi_pegawai`
  ADD CONSTRAINT `notifikasi_pegawai_notifikasi_id_foreign` FOREIGN KEY (`notifikasi_id`) REFERENCES `notifikasis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifikasi_pegawai_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  ADD CONSTRAINT `pegawais_pangkat_golongan_id_foreign` FOREIGN KEY (`pangkat_golongan_id`) REFERENCES `pangkat_golongans` (`id`),
  ADD CONSTRAINT `pegawais_ruangan_id_foreign` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangans` (`id`);

--
-- Ketidakleluasaan untuk tabel `promosi_demosis`
--
ALTER TABLE `promosi_demosis`
  ADD CONSTRAINT `promosi_demosis_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`),
  ADD CONSTRAINT `promosi_demosis_ruanganawal_id_foreign` FOREIGN KEY (`ruanganawal_id`) REFERENCES `ruangans` (`id`),
  ADD CONSTRAINT `promosi_demosis_ruanganbaru_id_foreign` FOREIGN KEY (`ruanganbaru_id`) REFERENCES `ruangans` (`id`);

--
-- Ketidakleluasaan untuk tabel `s_i_p_s`
--
ALTER TABLE `s_i_p_s`
  ADD CONSTRAINT `s_i_p_s_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `s_t_r_s`
--
ALTER TABLE `s_t_r_s`
  ADD CONSTRAINT `s_t_r_s_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
