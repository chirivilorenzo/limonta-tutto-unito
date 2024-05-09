-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2024 at 08:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `limonta`
--

-- --------------------------------------------------------

--
-- Table structure for table `aperturaticket`
--

CREATE TABLE `aperturaticket` (
  `ID` int(11) NOT NULL,
  `IDcliente` int(11) NOT NULL,
  `stato` enum('aperto','chiuso','sospeso','annullato') NOT NULL,
  `area` enum('Area PC e reti','AS400','Java','Contabilità','Formatori','Derma','Terzisti','Commerciali') NOT NULL,
  `breveDescrizione` varchar(64) NOT NULL,
  `descrizione` text NOT NULL,
  `dataApertura` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aperturaticket`
--

INSERT INTO `aperturaticket` (`ID`, `IDcliente`, `stato`, `area`, `breveDescrizione`, `descrizione`, `dataApertura`) VALUES
(2, 1, 'aperto', 'Area PC e reti', 'cose da fare', 'tante cose perché si', '2024-05-07 15:25:52');

-- --------------------------------------------------------

--
-- Table structure for table `chiusuraticket`
--

CREATE TABLE `chiusuraticket` (
  `ID` int(11) NOT NULL,
  `IDticket` int(11) NOT NULL,
  `IDdipendente` int(11) NOT NULL,
  `dataFine` datetime NOT NULL,
  `risoluzioneProblema` varchar(128) NOT NULL,
  `altro` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
  `nome` varchar(16) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `numTelefono` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`ID`, `nome`, `cognome`, `username`, `password`, `email`, `numTelefono`) VALUES
(1, 'a', 'a', 'mario', 'rossi', 'gg@gmail.com', '12');

-- --------------------------------------------------------

--
-- Table structure for table `dipendente`
--

CREATE TABLE `dipendente` (
  `ID` int(11) NOT NULL,
  `nome` varchar(16) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `numTelefono` char(10) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dipendente`
--

INSERT INTO `dipendente` (`ID`, `nome`, `cognome`, `username`, `password`, `email`, `numTelefono`, `isAdmin`) VALUES
(1, 'b', 'b', 'gianluca', 'torre', 'abc@gmail', '122', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dipendente_ticket`
--

CREATE TABLE `dipendente_ticket` (
  `idDipendente` int(11) NOT NULL,
  `idTicket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aperturaticket`
--
ALTER TABLE `aperturaticket`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idCliene` (`IDcliente`);

--
-- Indexes for table `chiusuraticket`
--
ALTER TABLE `chiusuraticket`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDticket` (`IDticket`,`IDdipendente`),
  ADD KEY `IDdipendente` (`IDdipendente`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`,`numTelefono`);

--
-- Indexes for table `dipendente`
--
ALTER TABLE `dipendente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`,`email`,`numTelefono`);

--
-- Indexes for table `dipendente_ticket`
--
ALTER TABLE `dipendente_ticket`
  ADD PRIMARY KEY (`idDipendente`,`idTicket`),
  ADD UNIQUE KEY `idDipendente_2` (`idDipendente`,`idTicket`),
  ADD KEY `idDipendente` (`idDipendente`,`idTicket`),
  ADD KEY `idTicket` (`idTicket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aperturaticket`
--
ALTER TABLE `aperturaticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chiusuraticket`
--
ALTER TABLE `chiusuraticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dipendente`
--
ALTER TABLE `dipendente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aperturaticket`
--
ALTER TABLE `aperturaticket`
  ADD CONSTRAINT `aperturaticket_ibfk_1` FOREIGN KEY (`IDcliente`) REFERENCES `cliente` (`ID`);

--
-- Constraints for table `chiusuraticket`
--
ALTER TABLE `chiusuraticket`
  ADD CONSTRAINT `chiusuraticket_ibfk_1` FOREIGN KEY (`IDticket`) REFERENCES `aperturaticket` (`ID`),
  ADD CONSTRAINT `chiusuraticket_ibfk_2` FOREIGN KEY (`IDdipendente`) REFERENCES `dipendente` (`ID`);

--
-- Constraints for table `dipendente_ticket`
--
ALTER TABLE `dipendente_ticket`
  ADD CONSTRAINT `dipendente_ticket_ibfk_1` FOREIGN KEY (`idDipendente`) REFERENCES `dipendente` (`ID`),
  ADD CONSTRAINT `dipendente_ticket_ibfk_2` FOREIGN KEY (`idTicket`) REFERENCES `aperturaticket` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
