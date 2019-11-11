-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-11-2019 a las 17:41:42
-- Versión del servidor: 5.6.45-cll-lve
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
DROP database BDprogramacioncaa;
CREATE database BDprogramacioncaa;
USE BDprogramacioncaa;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `BDprogramacioncaa`
--
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--


CREATE TABLE `actividad` (
  `idActividad` int(11) NOT NULL,
  `idProgramacion` int(11) DEFAULT NULL,
  `idDifusion` int(11) DEFAULT NULL,
  `idDiseno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`idActividad`, `idProgramacion`, `idDifusion`, `idDiseno`) VALUES
(14, 13, 9, 9),
(15, 14, 10, 10),
(16, 15, 11, 11),
(17, 19, 12, 12),
(18, 20, 13, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartelycortesias`
--

CREATE TABLE `cartelycortesias` (
  `idCartelyCortesias` int(11) NOT NULL,
  `digital` date DEFAULT NULL,
  `offset` date DEFAULT NULL,
  `serigrafia` date DEFAULT NULL,
  `fuera` date DEFAULT NULL,
  `entregaPrograma` date DEFAULT NULL,
  `invitacion` date DEFAULT NULL,
  `volante` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cartelycortesias`
--

INSERT INTO `cartelycortesias` (`idCartelyCortesias`, `digital`, `offset`, `serigrafia`, `fuera`, `entregaPrograma`, `invitacion`, `volante`) VALUES
(9, '2019-11-30', '2019-11-30', '2019-11-30', '2019-11-30', '2019-11-30', '2019-11-30', '2019-11-30'),
(10, '2019-11-27', '2019-11-26', '2019-11-28', '2019-11-28', '2019-11-11', '2019-11-06', '2019-11-20'),
(11, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corrector`
--

CREATE TABLE `corrector` (
  `idCorrector` int(11) NOT NULL,
  `fechaEntra` date DEFAULT NULL,
  `nombreCorrector` varchar(25) DEFAULT NULL,
  `fechaSale` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `corrector`
--

INSERT INTO `corrector` (`idCorrector`, `fechaEntra`, `nombreCorrector`, `fechaSale`) VALUES
(9, '2019-11-30', 'ííííííííííííííííííííííííí', '2019-11-30'),
(10, '0000-00-00', '', '0000-00-00'),
(11, '0000-00-00', '', '0000-00-00'),
(12, '2019-11-18', 'El correcto textil', '2019-11-20'),
(13, '0000-00-00', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `difusion`
--

CREATE TABLE `difusion` (
  `idDifusion` int(11) NOT NULL,
  `fechaDifusion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `difusion`
--

INSERT INTO `difusion` (`idDifusion`, `fechaDifusion`) VALUES
(9, '2019-11-30'),
(10, '2019-11-30'),
(11, '0000-00-00'),
(12, '2019-11-28'),
(13, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diseno`
--

CREATE TABLE `diseno` (
  `idDiseno` int(11) NOT NULL,
  `idFase2` int(11) DEFAULT NULL,
  `idCartelyCortesias` int(11) DEFAULT NULL,
  `idCorrector` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `diseno`
--

INSERT INTO `diseno` (`idDiseno`, `idFase2`, `idCartelyCortesias`, `idCorrector`) VALUES
(9, 9, 9, 9),
(10, 10, 9, 10),
(11, 11, 9, 11),
(12, 16, 10, 12),
(13, 17, 11, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fase2`
--

CREATE TABLE `fase2` (
  `idFase2` int(11) NOT NULL,
  `nombreDisenador` varchar(25) DEFAULT NULL,
  `fechaEntra` date DEFAULT NULL,
  `fotos` int(2) DEFAULT NULL,
  `vineta` int(2) DEFAULT NULL,
  `logos` int(2) DEFAULT NULL,
  `lugar` varchar(25) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `leyenda` varchar(25) DEFAULT NULL,
  `fechaSalida` date DEFAULT NULL,
  `cartel` int(2) DEFAULT NULL,
  `web` int(2) DEFAULT NULL,
  `cortesias` int(2) DEFAULT NULL,
  `programa` int(2) DEFAULT NULL,
  `invitacion` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fase2`
--

INSERT INTO `fase2` (`idFase2`, `nombreDisenador`, `fechaEntra`, `fotos`, `vineta`, `logos`, `lugar`, `fecha`, `hora`, `leyenda`, `fechaSalida`, `cartel`, `web`, `cortesias`, `programa`, `invitacion`) VALUES
(9, 'ííííííííííííííííííííííííí', '2019-11-30', 1, 1, 1, 'ííííííííííííííííííííííííí', '2019-11-30', '00:00:00', 'ííííííííííííííííííííííííí', '0000-00-00', 1, 1, 1, 1, 1),
(10, 'nombre diseñador', '2019-11-30', 1, 1, 1, 'CIUDAD DE MEXICO', '2019-11-30', '00:00:00', 'leyenda', '2019-11-30', 1, 1, 1, 1, 1),
(11, '', '0000-00-00', 0, 0, 0, '', '0000-00-00', '00:00:00', '', '0000-00-00', 0, 0, 0, 0, 0),
(12, 'Diseñador pro', '2019-11-19', 1, 1, 1, 'FES Cultura', '2019-11-21', '02:00:00', 'La leyenda innombrable', '2019-11-13', 1, 0, 1, 1, 1),
(13, 'alguien', '2019-11-20', 0, 1, 0, 'Javier Barros Sierra', '2019-11-06', '01:05:00', 'La leyenda innombrable', '2019-11-05', 0, 1, 1, 0, 1),
(14, 'ffg', '2019-11-12', 0, 1, 1, 'Javier Barros Sierra', '2019-11-20', '01:00:00', 'La leyenda innombrable', '2019-11-04', 0, 1, 1, 0, 0),
(15, 'alguien', '2019-11-11', 0, 1, 0, 'FES Cultura', '2019-11-07', '01:05:00', 'La leyenda innombrable', '2019-11-06', 0, 1, 0, 0, 1),
(16, 'Diseñador', '2019-11-17', 1, 1, 1, 'FES Cultura', '2019-11-21', '01:00:00', 'La leyenda innombrable', '2019-11-27', 1, 1, 1, 1, 1),
(17, '', '0000-00-00', 0, 0, 0, '', '0000-00-00', '00:00:00', '', '0000-00-00', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotografia`
--

CREATE TABLE `fotografia` (
  `idFotografia` int(11) NOT NULL,
  `fotografia` varchar(100) DEFAULT NULL,
  `idRequerimientoDiseno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fotografia`
--

INSERT INTO `fotografia` (`idFotografia`, `fotografia`, `idRequerimientoDiseno`) VALUES
(1, '../images/jb5O7H__mexicana 1.jpeg', 16),
(2, '../images/VPT69f__mexicana 2.jpeg', 16),
(3, '../images/VPT69f__mexicana 2.jpeg', 16),
(4, '../images/SptEDE__27073035_1822401707831427_331286', 18),
(5, '../images/ftIRQR__73201496_2583924891694658_521776', 18),
(6, '../images/8fa7ix__Foto entrevista.jpg', 19),
(7, '../images/FnmAZ5__2a6.jpg', 20),
(8, '../images/byqlZ5__3c7.jpg', 20),
(9, '../images/5fBJFX__35483260_616308362058499_4461733', 21),
(10, '../images/8ZHR0I__39289217_1046358652238416_884636', 21),
(12, '../images/BbijYf__received_1589716011179514.jpeg', 22),
(15, '../images/SEQLbY__Kiwi Flight OST.png', 22),
(16, '../images/dkJwhv__WKwbxhf.png', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `idHorario` int(11) NOT NULL,
  `horario` time DEFAULT NULL,
  `idRequerimientoActividad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`idHorario`, `horario`, `idRequerimientoActividad`) VALUES
(8, '02:24:00', 5),
(9, '03:23:00', 5),
(10, '01:15:00', 5),
(11, '02:25:00', 6),
(12, '04:35:00', 6),
(13, '01:45:00', 7),
(31, '01:05:00', 15),
(32, '00:00:00', 17),
(33, '02:00:00', 18),
(34, '05:30:00', 18),
(35, '01:05:00', 19),
(36, '04:25:00', 19),
(39, '02:05:00', 20),
(40, '02:25:00', 20),
(41, '20:00:00', 21),
(42, '21:00:00', 21),
(43, '22:00:00', 21),
(44, '03:00:00', 22),
(45, '02:10:00', 22),
(46, '02:05:00', 23),
(47, '03:05:00', 23),
(48, '05:30:00', 24),
(49, '10:50:00', 24),
(50, '01:05:00', 25),
(53, '02:10:00', 25),
(54, '02:15:00', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logotipo`
--

CREATE TABLE `logotipo` (
  `idLogotipo` int(11) NOT NULL,
  `logotipo` varchar(100) DEFAULT NULL,
  `idRequerimientoDiseno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `logotipo`
--

INSERT INTO `logotipo` (`idLogotipo`, `logotipo`, `idRequerimientoDiseno`) VALUES
(1, '../images/s0lgWF__Fake.jpg', 16),
(2, '../images/VIJpXR__img cv.jpg', 16),
(3, '../images/VIJpXR__img cv.jpg', 16),
(4, '../images/h5PB88__27337254_1822401667831431_646039', 18),
(5, '../images/lzkWfc__72750247_2583924925027988_732852', 18),
(6, '../images/RsVY5R__Foto entrevista 2.jpg', 19),
(7, '../images/Vq3dgO__26000977_520481751667497_5798004', 20),
(8, '../images/T4iJ8X__100_3123.jpg', 20),
(9, '../images/ONdIEc__unknown.png', 21),
(10, '../images/hH4uTn__received_1589716011179514.jpeg', 21),
(12, '../images/fseRvN__unknown.png', 22),
(16, '../images/iCQtsL__Black.jpg', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion`
--

CREATE TABLE `programacion` (
  `idProgramacion` int(11) NOT NULL,
  `idRequerimientoActividad` int(11) DEFAULT NULL,
  `idRequerimientoDiseno` int(11) DEFAULT NULL,
  `idRequerimientoTecnico` int(11) DEFAULT NULL,
  `idRequerimientoPago` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programacion`
--

INSERT INTO `programacion` (`idProgramacion`, `idRequerimientoActividad`, `idRequerimientoDiseno`, `idRequerimientoTecnico`, `idRequerimientoPago`) VALUES
(4, 5, 7, 2, 32),
(5, 6, 8, 3, 33),
(13, 15, 16, 11, 41),
(14, 17, 17, 12, 42),
(15, 21, 19, 14, 43),
(16, 21, 19, 14, 44),
(17, 22, 20, 15, 45),
(18, 23, 21, 16, 46),
(19, 24, 22, 17, 47),
(20, 25, 23, 18, 48);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimientoactividad`
--

CREATE TABLE `requerimientoactividad` (
  `idRequerimientoActividad` int(11) NOT NULL,
  `fechaProgramacion` date DEFAULT NULL,
  `fechaEvento` date DEFAULT NULL,
  `nombreCompania` varchar(25) DEFAULT NULL,
  `nombreActividad` varchar(25) DEFAULT NULL,
  `disciplina` varchar(25) DEFAULT NULL,
  `lugar` varchar(25) DEFAULT NULL,
  `tipoEntrada` int(11) DEFAULT NULL,
  `costo` int(11) DEFAULT NULL,
  `duracion` time DEFAULT NULL,
  `observacion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `requerimientoactividad`
--

INSERT INTO `requerimientoactividad` (`idRequerimientoActividad`, `fechaProgramacion`, `fechaEvento`, `nombreCompania`, `nombreActividad`, `disciplina`, `lugar`, `tipoEntrada`, `costo`, `duracion`, `observacion`) VALUES
(5, '2018-04-03', '2019-09-01', 'finalizacionPro', 'cierre', 'cedetec', 'fesAcatlanUnam', 2, NULL, '02:02:02', 'Esta observacion es de la actividad cierre'),
(6, '2019-07-28', '2019-10-14', 'notcelis', 'fortnite', 'juegos', 'el chain', 1, NULL, '02:30:00', NULL),
(7, '2019-07-28', '2019-07-17', 'celis', 'skate', 'ytretyerty', 'mi casa', 1, 100, '01:05:00', ''),
(15, '2019-11-10', '2019-11-28', 'ííííííííííííííííííííííííí', 'ííííííííííííííííííííííííí', 'ííííííííííííííííííííííííí', 'ííííííííííííííííííííííííí', 1, 100, '01:05:00', 'íííííííííííííííííííííííííííííííí'),
(16, '2019-11-10', '2019-11-30', 'ññññññññññññññññ', 'skate', 'ññññññññññññññññ', 'CIUDAD DE MEXICO', 1, 0, '00:05:00', 'ahuevo'),
(17, '2019-11-10', '2019-11-30', 'celis', 'skate', 'ytretyerty', 'CIUDAD DE MEXICO', 1, 0, '00:00:00', 'stdrgsrega\r\nahuevo'),
(18, '2019-11-10', '2019-11-20', 'Ñandu', 'Hello there', 'Artes Visuales', 'FES Cultura', 1, 234, '01:00:00', 'Observar'),
(19, '2019-11-10', '2019-11-13', 'ñañaras', 'Hello there', 'Artes Visuales', 'FES Cultura', 1, 1234, '01:05:00', 'observaaa'),
(20, '2019-11-10', '2019-11-28', 'compañia ñia', 'Hello there', 'Musica', 'aqui de nuevo', 1, 100, '01:00:00', 'onssss'),
(21, '2019-11-10', '2020-01-01', 'televisa', 'new year', 'festivo', 'zocalo', 1, 0, '01:00:00', 'feliz año nuevo'),
(22, '2019-11-10', '2019-11-22', 'ñañaras', 'Hello there', 'Musica', 'FES Cultura', 1, 1234, '01:00:00', 'odasdf'),
(23, '2019-11-10', '2019-11-13', 'compañia ñia', 'Por favor', 'correr', 'Javier Barros Sierra', 1, 1234, '01:00:00', 'dsasd'),
(24, '2019-11-10', '2019-11-13', 'Ñandú', 'Hello there', 'Musica', 'FES Cultura', 2, 0, '01:00:00', 'sdasf'),
(25, '2019-11-10', '2019-11-08', 'ññññññññññññññññ', 'ññññññññññññññññ', 'ññññññññññññññññ', 'ññññññññññññññññññññññn', 1, 100, '01:05:00', 'ññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimientodiseno`
--

CREATE TABLE `requerimientodiseno` (
  `idRequerimientoDiseno` int(11) NOT NULL,
  `fechaEntrega` date DEFAULT NULL,
  `semblanzaCompania` varchar(50) DEFAULT NULL,
  `semblanzaActividad` varchar(50) DEFAULT NULL,
  `programaMano` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `requerimientodiseno`
--

INSERT INTO `requerimientodiseno` (`idRequerimientoDiseno`, `fechaEntrega`, `semblanzaCompania`, `semblanzaActividad`, `programaMano`) VALUES
(7, '2017-11-03', 'semblanzaCompan', 'semblanzaActivi', 'programaMano2'),
(8, '0000-00-00', '', '', '0'),
(16, '0000-00-00', '', '', '1'),
(17, '2019-11-30', '', '', '1'),
(18, '0000-00-00', 'semblanzzzz', 'zzzza actividad', '1'),
(19, '2020-01-01', 'semblanza compaÃ±Ã­a', 'semblanza actividad', '1'),
(20, '2019-11-28', 'sssss', 'sssaaaa', '1'),
(21, '2019-11-28', 'cdfdsa', '1234ftfdsb', '1'),
(22, '2019-11-27', '', '', '1'),
(23, '0000-00-00', '', '', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimientopago`
--

CREATE TABLE `requerimientopago` (
  `idRequerimientoPago` int(11) NOT NULL,
  `requerimiento` varchar(100) DEFAULT NULL,
  `fechaDocumentacion` date DEFAULT NULL,
  `fechaTentativa` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `requerimientopago`
--

INSERT INTO `requerimientopago` (`idRequerimientoPago`, `requerimiento`, `fechaDocumentacion`, `fechaTentativa`) VALUES
(32, 'Este es el requerimientoPago para la actividad2', '2018-06-01', '2019-03-06'),
(33, '', '0000-00-00', '0000-00-00'),
(41, 'req pag', '2019-11-30', '2019-11-30'),
(42, 'el daniel no hace ni madres x2', '2019-11-30', '2019-12-01'),
(43, 'requerimientos para pagos', '2020-01-01', '2020-01-01'),
(44, 'reqqq pag', '2019-11-19', '2019-11-25'),
(45, 'reqqq', '2019-11-04', '2019-11-18'),
(46, 'rtewwert', '2019-11-14', '2019-11-12'),
(47, 'Requerimientos pagos', '2019-11-05', '0000-00-00'),
(48, '', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimientotecnico`
--

CREATE TABLE `requerimientotecnico` (
  `idRequerimientoTecnico` int(11) NOT NULL,
  `requerimiento` varchar(120) DEFAULT NULL,
  `direccionPdf` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `requerimientotecnico`
--

INSERT INTO `requerimientotecnico` (`idRequerimientoTecnico`, `requerimiento`, `direccionPdf`) VALUES
(2, 'Este es el requerimientoTecnido para la actividad2', NULL),
(3, '', NULL),
(11, 'req tec', '../pdfs/vX2uQd__celis.pdf'),
(12, 'el daniel no hace nimadres', '../pdfs/W4wHxe__tenencia 2019.pdf'),
(13, 'requerimientos tÃ©cnicos', '../pdfs/HI63xH__tenencia 2019.pdf'),
(14, 'reqqqq', '../pdfs/nN0q3i__complete_midi_96-1-3.pdf'),
(15, 'reqqq tec', '../pdfs/Xr8xOD__templateA4.pdf'),
(16, 'rewq', '../pdfs/LmGPe1__templateA4.pdf'),
(17, 'Requerimientos técnicos', '../pdfs/pUTiIM__templateA4.pdf'),
(18, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuarios`
--

CREATE TABLE `tipousuarios` (
  `idTipoUsuario` int(11) NOT NULL,
  `nombreCargo` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipousuarios`
--

INSERT INTO `tipousuarios` (`idTipoUsuario`, `nombreCargo`) VALUES
(1, 'Administrador'),
(2, 'Personal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(15) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `idTipoUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `username`, `password`, `idTipoUsuario`) VALUES
(1, 'administrador', 'administrador', 'admin1234', 1),
(2, 'Personal', 'personal', 'personal1234', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`idActividad`),
  ADD KEY `idProgramacion` (`idProgramacion`),
  ADD KEY `idDifusion` (`idDifusion`),
  ADD KEY `idDiseno` (`idDiseno`);

--
-- Indices de la tabla `cartelycortesias`
--
ALTER TABLE `cartelycortesias`
  ADD PRIMARY KEY (`idCartelyCortesias`);

--
-- Indices de la tabla `corrector`
--
ALTER TABLE `corrector`
  ADD PRIMARY KEY (`idCorrector`);

--
-- Indices de la tabla `difusion`
--
ALTER TABLE `difusion`
  ADD PRIMARY KEY (`idDifusion`);

--
-- Indices de la tabla `diseno`
--
ALTER TABLE `diseno`
  ADD PRIMARY KEY (`idDiseno`),
  ADD KEY `idFase2` (`idFase2`),
  ADD KEY `idCartelyCortesias` (`idCartelyCortesias`),
  ADD KEY `idCorrector` (`idCorrector`);

--
-- Indices de la tabla `fase2`
--
ALTER TABLE `fase2`
  ADD PRIMARY KEY (`idFase2`);

--
-- Indices de la tabla `fotografia`
--
ALTER TABLE `fotografia`
  ADD PRIMARY KEY (`idFotografia`),
  ADD KEY `idRequerimientoDiseno` (`idRequerimientoDiseno`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`idHorario`),
  ADD KEY `idRequerimientoActividad` (`idRequerimientoActividad`);

--
-- Indices de la tabla `logotipo`
--
ALTER TABLE `logotipo`
  ADD PRIMARY KEY (`idLogotipo`),
  ADD KEY `idRequerimientoDiseno` (`idRequerimientoDiseno`);

--
-- Indices de la tabla `programacion`
--
ALTER TABLE `programacion`
  ADD PRIMARY KEY (`idProgramacion`),
  ADD KEY `idRequerimientoActividad` (`idRequerimientoActividad`),
  ADD KEY `idRequerimientoDiseno` (`idRequerimientoDiseno`),
  ADD KEY `idRequerimientoTecnico` (`idRequerimientoTecnico`),
  ADD KEY `idRequerimientoPago` (`idRequerimientoPago`);

--
-- Indices de la tabla `requerimientoactividad`
--
ALTER TABLE `requerimientoactividad`
  ADD PRIMARY KEY (`idRequerimientoActividad`);

--
-- Indices de la tabla `requerimientodiseno`
--
ALTER TABLE `requerimientodiseno`
  ADD PRIMARY KEY (`idRequerimientoDiseno`);

--
-- Indices de la tabla `requerimientopago`
--
ALTER TABLE `requerimientopago`
  ADD PRIMARY KEY (`idRequerimientoPago`);

--
-- Indices de la tabla `requerimientotecnico`
--
ALTER TABLE `requerimientotecnico`
  ADD PRIMARY KEY (`idRequerimientoTecnico`);

--
-- Indices de la tabla `tipousuarios`
--
ALTER TABLE `tipousuarios`
  ADD PRIMARY KEY (`idTipoUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idTipoUsuario` (`idTipoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `idActividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `cartelycortesias`
--
ALTER TABLE `cartelycortesias`
  MODIFY `idCartelyCortesias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `corrector`
--
ALTER TABLE `corrector`
  MODIFY `idCorrector` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `difusion`
--
ALTER TABLE `difusion`
  MODIFY `idDifusion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `diseno`
--
ALTER TABLE `diseno`
  MODIFY `idDiseno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `fase2`
--
ALTER TABLE `fase2`
  MODIFY `idFase2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `fotografia`
--
ALTER TABLE `fotografia`
  MODIFY `idFotografia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `idHorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `logotipo`
--
ALTER TABLE `logotipo`
  MODIFY `idLogotipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `programacion`
--
ALTER TABLE `programacion`
  MODIFY `idProgramacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `requerimientoactividad`
--
ALTER TABLE `requerimientoactividad`
  MODIFY `idRequerimientoActividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `requerimientodiseno`
--
ALTER TABLE `requerimientodiseno`
  MODIFY `idRequerimientoDiseno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `requerimientopago`
--
ALTER TABLE `requerimientopago`
  MODIFY `idRequerimientoPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `requerimientotecnico`
--
ALTER TABLE `requerimientotecnico`
  MODIFY `idRequerimientoTecnico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tipousuarios`
--
ALTER TABLE `tipousuarios`
  MODIFY `idTipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_1` FOREIGN KEY (`idProgramacion`) REFERENCES `programacion` (`idProgramacion`) ON DELETE CASCADE,
  ADD CONSTRAINT `actividad_ibfk_2` FOREIGN KEY (`idDifusion`) REFERENCES `difusion` (`idDifusion`) ON DELETE CASCADE,
  ADD CONSTRAINT `actividad_ibfk_3` FOREIGN KEY (`idDiseno`) REFERENCES `diseno` (`idDiseno`) ON DELETE CASCADE;

--
-- Filtros para la tabla `diseno`
--
ALTER TABLE `diseno`
  ADD CONSTRAINT `diseno_ibfk_1` FOREIGN KEY (`idFase2`) REFERENCES `fase2` (`idFase2`) ON DELETE CASCADE,
  ADD CONSTRAINT `diseno_ibfk_2` FOREIGN KEY (`idCartelyCortesias`) REFERENCES `cartelycortesias` (`idCartelyCortesias`) ON DELETE CASCADE,
  ADD CONSTRAINT `diseno_ibfk_3` FOREIGN KEY (`idCorrector`) REFERENCES `corrector` (`idCorrector`) ON DELETE CASCADE;

--
-- Filtros para la tabla `fotografia`
--
ALTER TABLE `fotografia`
  ADD CONSTRAINT `fotografia_ibfk_1` FOREIGN KEY (`idRequerimientoDiseno`) REFERENCES `requerimientodiseno` (`idRequerimientoDiseno`) ON DELETE CASCADE;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`idRequerimientoActividad`) REFERENCES `requerimientoactividad` (`idRequerimientoActividad`) ON DELETE CASCADE;

--
-- Filtros para la tabla `logotipo`
--
ALTER TABLE `logotipo`
  ADD CONSTRAINT `logotipo_ibfk_1` FOREIGN KEY (`idRequerimientoDiseno`) REFERENCES `requerimientodiseno` (`idRequerimientoDiseno`) ON DELETE CASCADE;

--
-- Filtros para la tabla `programacion`
--
ALTER TABLE `programacion`
  ADD CONSTRAINT `programacion_ibfk_1` FOREIGN KEY (`idRequerimientoActividad`) REFERENCES `requerimientoactividad` (`idRequerimientoActividad`) ON DELETE CASCADE,
  ADD CONSTRAINT `programacion_ibfk_2` FOREIGN KEY (`idRequerimientoDiseno`) REFERENCES `requerimientodiseno` (`idRequerimientoDiseno`) ON DELETE CASCADE,
  ADD CONSTRAINT `programacion_ibfk_3` FOREIGN KEY (`idRequerimientoTecnico`) REFERENCES `requerimientotecnico` (`idRequerimientoTecnico`) ON DELETE CASCADE,
  ADD CONSTRAINT `programacion_ibfk_4` FOREIGN KEY (`idRequerimientoPago`) REFERENCES `requerimientopago` (`idRequerimientoPago`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipousuarios` (`idTipoUsuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
