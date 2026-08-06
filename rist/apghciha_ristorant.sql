-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Ago 06, 2026 alle 23:57
-- Versione del server: 10.11.18-MariaDB-cll-lve-log
-- Versione PHP: 8.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apghciha_ristorante`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `people` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_slot` enum('lunch','dinner') NOT NULL,
  `time` time NOT NULL,
  `notes` text DEFAULT NULL,
  `tables_needed` int(11) NOT NULL,
  `status` enum('confirmed','cancelled') NOT NULL DEFAULT 'confirmed',
  `modification_token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `email`, `phone`, `people`, `date`, `time_slot`, `time`, `notes`, `tables_needed`, `status`, `modification_token`, `created_at`, `updated_at`) VALUES
(1, 'Mario Rossi', 'mario.rossi@email.com', '3331234567', 4, '2026-07-01', 'lunch', '12:30:00', 'Vicino finestra', 1, 'confirmed', 'TOKEN_JUL_01', '2026-06-15 10:00:00', '2026-06-15 10:00:00'),
(2, 'Anna Verdi', 'anna.verdi@email.com', '3332345678', 2, '2026-07-02', 'lunch', '13:00:00', 'Vegetariano', 1, 'confirmed', 'TOKEN_JUL_02', '2026-06-16 11:30:00', '2026-06-16 11:30:00'),
(3, 'Luca Moretti', 'luca.m@gmail.com', '3471122334', 5, '2026-07-04', 'dinner', '20:30:00', 'Seggiolone richiesto', 2, 'confirmed', 'TOKEN_JUL_03', '2026-06-18 15:45:00', '2026-06-18 15:45:00'),
(4, 'Elena Bianchi', 'e.bianchi@libero.it', '3385566778', 2, '2026-07-05', 'dinner', '21:00:00', '', 1, 'confirmed', 'TOKEN_JUL_04', '2026-06-20 09:20:00', '2026-06-20 09:20:00'),
(5, 'Roberto Neri', 'r.neri@outlook.it', '3209988771', 8, '2026-07-06', 'lunch', '13:15:00', 'Tavolata aziendale', 2, 'confirmed', 'TOKEN_JUL_05', '2026-06-22 14:10:00', '2026-06-22 14:10:00'),
(6, 'Luigi Bianchi', 'luigi.b@email.com', '3333456789', 6, '2026-07-10', 'dinner', '20:00:00', 'Compleanno', 2, 'confirmed', 'TOKEN_JUL_06', '2026-06-25 18:30:00', '2026-06-25 18:30:00'),
(7, 'Giulia Neri', 'giulia.n@email.com', '3334567890', 3, '2026-07-12', 'lunch', '12:15:00', '', 1, 'confirmed', 'TOKEN_JUL_07', '2026-06-28 10:15:00', '2026-06-28 10:15:00'),
(8, 'Stefano Sala', 's.sala@gmail.com', '3311223344', 4, '2026-07-15', 'dinner', '19:45:00', 'Allergia noci', 1, 'confirmed', 'TOKEN_JUL_08', '2026-07-01 12:00:00', '2026-07-01 12:00:00'),
(9, 'Marta Ferri', 'm.ferri@tiscali.it', '3456677889', 2, '2026-07-18', 'lunch', '12:30:00', 'Anniversario', 1, 'confirmed', 'TOKEN_JUL_09', '2026-07-02 09:45:00', '2026-07-02 09:45:00'),
(10, 'Marco Gialli', 'marco.g@email.com', '3335678901', 8, '2026-07-20', 'dinner', '20:00:00', 'Fattura richiesta', 2, 'confirmed', 'TOKEN_JUL_10', '2026-07-05 16:20:00', '2026-07-05 16:20:00'),
(11, 'Sara Volpi', 'sara.v@gmail.com', '3398877665', 12, '2026-07-22', 'dinner', '20:30:00', 'Cena di laurea', 4, 'confirmed', 'TOKEN_JUL_11', '2026-07-08 11:10:00', '2026-07-08 11:10:00'),
(12, 'Paolo Grigi', 'paolo.g@email.com', '3337890123', 2, '2026-07-25', 'lunch', '12:45:00', 'No glutine', 1, 'confirmed', 'TOKEN_JUL_12', '2026-07-10 14:30:00', '2026-07-10 14:30:00'),
(13, 'Fabio Risi', 'f.risi@email.it', '3471112223', 4, '2026-07-28', 'lunch', '13:00:00', '', 1, 'confirmed', 'TOKEN_JUL_13', '2026-07-12 10:00:00', '2026-07-12 10:00:00'),
(14, 'Elena Rosa', 'elena.r@email.com', '3338901234', 7, '2026-08-01', 'dinner', '21:15:00', '', 2, 'confirmed', 'TOKEN_AUG_01', '2026-07-15 18:45:00', '2026-07-15 18:45:00'),
(15, 'Francesco Viola', 'f.viola@email.com', '3339012345', 4, '2026-08-02', 'dinner', '19:45:00', 'Bambino piccolo', 1, 'confirmed', 'TOKEN_AUG_02', '2026-07-16 09:30:00', '2026-07-16 09:30:00'),
(16, 'Chiara Marrone', 'c.marrone@email.com', '3330123456', 6, '2026-08-05', 'lunch', '13:15:00', 'Tavolo esterno', 2, 'confirmed', 'TOKEN_AUG_03', '2026-07-20 11:15:00', '2026-07-20 11:15:00'),
(17, 'Davide Nero', 'd.nero@email.com', '3331111111', 5, '2026-08-08', 'dinner', '20:30:00', 'Terrazza', 2, 'confirmed', 'TOKEN_AUG_04', '2026-07-22 15:00:00', '2026-07-22 15:00:00'),
(18, 'Laura Argento', 'l.argento@email.com', '3332222222', 3, '2026-08-10', 'lunch', '12:00:00', 'Vegani', 1, 'confirmed', 'TOKEN_AUG_05', '2026-07-25 10:30:00', '2026-07-25 10:30:00'),
(19, 'Giorgio Pini', 'g.pini@email.it', '3284455660', 2, '2026-08-12', 'dinner', '21:00:00', '', 1, 'confirmed', 'TOKEN_AUG_06', '2026-07-28 17:45:00', '2026-07-28 17:45:00'),
(20, 'Sonia Gatti', 's.gatti@gmail.com', '3334445556', 4, '2026-08-14', 'dinner', '20:15:00', 'Torta ordinata', 1, 'confirmed', 'TOKEN_AUG_07', '2026-08-01 12:20:00', '2026-08-01 12:20:00'),
(21, 'Matteo Oro', 'm.oro@email.com', '3333333333', 9, '2026-08-15', 'lunch', '12:30:00', 'Pranzo Ferragosto', 3, 'confirmed', 'TOKEN_AUG_08', '2026-08-02 09:00:00', '2026-08-02 09:00:00'),
(22, 'Alessia Verde', 'a.verde@email.com', '3478581614', 6, '2026-08-15', 'lunch', '13:00:00', 'Ferragosto in famiglia', 2, 'confirmed', 'TOKEN_AUG_09', '2026-08-03 14:15:00', '2026-08-03 14:15:00'),
(23, 'Riccardo Azzurri', 'r.azz@email.com', '3335555555', 4, '2026-08-15', 'dinner', '20:00:00', 'Cena di Ferragosto', 1, 'confirmed', 'TOKEN_AUG_10', '2026-08-05 11:30:00', '2026-08-05 11:30:00'),
(24, 'Martina Viola', 'm.viola@email.com', '3336666666', 4, '2026-08-18', 'lunch', '12:30:00', '', 1, 'confirmed', 'TOKEN_AUG_11', '2026-08-10 10:45:00', '2026-08-10 10:45:00'),
(25, 'Stefano Celeste', 's.celeste@email.com', '3337777777', 3, '2026-08-20', 'dinner', '19:15:00', '', 1, 'confirmed', 'TOKEN_AUG_12', '2026-08-12 16:00:00', '2026-08-12 16:00:00'),
(26, 'Federica Marrone', 'f.marrone@email.com', '3338888888', 5, '2026-08-22', 'lunch', '13:00:00', 'Evento', 2, 'confirmed', 'TOKEN_AUG_13', '2026-08-15 09:15:00', '2026-08-15 09:15:00'),
(27, 'Giovanni Corallo', 'g.corallo@email.com', '3339999999', 6, '2026-08-25', 'dinner', '20:00:00', 'Torta personalizzata', 2, 'confirmed', 'TOKEN_AUG_14', '2026-08-18 11:20:00', '2026-08-18 11:20:00'),
(28, 'Daniela Perla', 'd.perla@gmail.com', '3401122335', 4, '2026-08-28', 'dinner', '21:00:00', 'No aglio', 1, 'confirmed', 'TOKEN_AUG_15', '2026-08-20 15:30:00', '2026-08-20 15:30:00'),
(29, 'Elias Riva', 'e.riva@libero.it', '3318899001', 2, '2026-08-30', 'lunch', '12:45:00', '', 1, 'confirmed', 'TOKEN_AUG_16', '2026-08-22 10:00:00', '2026-08-22 10:00:00'),
(30, 'Simona Bini', 's.bini@email.it', '3352233445', 8, '2026-09-02', 'dinner', '20:30:00', 'Gruppo amici', 2, 'confirmed', 'TOKEN_SEP_01', '2026-08-25 14:15:00', '2026-08-25 14:15:00'),
(31, 'Luca Basso', 'l.basso@email.com', '3331231234', 2, '2026-09-05', 'dinner', '20:00:00', '', 1, 'confirmed', 'TOKEN_SEP_02', '2026-08-28 09:45:00', '2026-08-28 09:45:00'),
(32, 'Andrea Mura', 'a.mura@email.com', '3332342345', 4, '2026-09-08', 'lunch', '13:00:00', 'Vicino ingresso', 1, 'confirmed', 'TOKEN_SEP_03', '2026-09-01 11:15:00', '2026-09-01 11:15:00'),
(33, 'Elisa Costa', 'e.costa@email.com', '3333453456', 3, '2026-09-10', 'dinner', '19:30:00', '', 1, 'confirmed', 'TOKEN_SEP_04', '2026-09-02 16:30:00', '2026-09-02 16:30:00'),
(34, 'Nicola Fonti', 'n.fonti@email.com', '3334564567', 6, '2026-09-12', 'dinner', '21:00:00', 'Compleanno', 2, 'confirmed', 'TOKEN_SEP_05', '2026-09-05 10:00:00', '2026-09-05 10:00:00'),
(35, 'Sara Lodi', 's.lodi@email.com', '3335675678', 2, '2026-09-15', 'lunch', '12:30:00', '', 1, 'confirmed', 'TOKEN_SEP_06', '2026-09-08 14:45:00', '2026-09-08 14:45:00'),
(36, 'Giacomo Fini', 'g.fini@email.com', '3336786789', 5, '2026-09-18', 'dinner', '20:15:00', 'Tavolo isolato', 2, 'confirmed', 'TOKEN_SEP_07', '2026-09-10 18:20:00', '2026-09-10 18:20:00'),
(37, 'Beatrice Sani', 'b.sani@email.com', '3337897890', 4, '2026-09-20', 'lunch', '13:15:00', '', 1, 'confirmed', 'TOKEN_SEP_08', '2026-09-12 09:30:00', '2026-09-12 09:30:00'),
(38, 'Cristina Mori', 'c.mori@email.com', '3338908901', 2, '2026-09-22', 'dinner', '19:45:00', 'Romantico', 1, 'confirmed', 'TOKEN_SEP_09', '2026-09-15 15:10:00', '2026-09-15 15:10:00'),
(39, 'Tommaso Gori', 't.gori@email.com', '3339019012', 7, '2026-09-25', 'dinner', '20:30:00', '', 2, 'confirmed', 'TOKEN_SEP_10', '2026-09-18 11:45:00', '2026-09-18 11:45:00'),
(40, 'Vittoria Valli', 'v.valli@email.com', '3330120123', 3, '2026-09-28', 'lunch', '12:45:00', '', 1, 'confirmed', 'TOKEN_SEP_11', '2026-09-20 14:20:00', '2026-09-20 14:20:00'),
(41, 'Davide Sola', 'd.sola@email.com', '3331232345', 5, '2026-09-30', 'dinner', '21:00:00', 'Addio al celibato', 2, 'confirmed', 'TOKEN_SEP_12', '2026-09-22 10:15:00', '2026-09-22 10:15:00');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reservations_modification_token_unique` (`modification_token`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
