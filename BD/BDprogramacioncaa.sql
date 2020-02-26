

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE BDprogramacioncaa;
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
(3, 3, 34, 35),
(4, 4, 35, 36),
(5, 5, 36, 37),
(6, 6, 37, 38),
(7, 7, 38, 39),
(10, 11, 41, 43),
(11, 12, 42, 44),
(12, 13, 43, 45),
(13, 14, 44, 46),
(14, 15, 45, 47),
(15, 16, 46, 48),
(16, 17, 47, 49),
(19, 22, 52, 54),
(20, 22, 53, 54),
(23, 25, 56, 57),
(25, 27, 58, 59),
(26, 28, 59, 60),
(27, 29, 60, 61),
(28, 30, 61, 62),
(29, 31, 62, 63),
(30, 32, 63, 64),
(31, 33, 64, 65),
(32, 34, 65, 67),
(33, 35, 66, 68),
(34, 36, 67, 69),
(35, 37, 68, 70),
(36, 38, 69, 71),
(37, 39, 70, 72),
(48, 50, 81, 83),
(51, 53, 84, 86),
(52, 54, 85, 87),
(53, 55, 86, 88);

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
(12, '2019-11-14', '2019-11-29', '2019-11-26', '2019-11-13', '2019-11-05', '2019-11-20', '2019-11-13'),
(15, '2020-01-15', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(16, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(29, '2019-11-29', '0000-00-00', '0000-00-00', '0000-00-00', '2019-11-29', '2019-11-29', '2019-11-29'),
(31, '2019-11-01', '2019-11-01', '2019-11-01', '2019-11-01', '2019-11-01', '2019-11-01', '2019-11-01'),
(32, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(33, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(34, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(35, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(36, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2020-01-10', '0000-00-00', '0000-00-00'),
(37, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(39, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(40, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(41, '2020-01-22', '0000-00-00', '0000-00-00', '0000-00-00', '2020-01-22', '0000-00-00', '0000-00-00'),
(42, '2020-01-27', '0000-00-00', '0000-00-00', '0000-00-00', '2020-02-10', '0000-00-00', '0000-00-00'),
(43, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(44, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(45, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(46, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(48, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(49, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(51, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(52, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(54, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(56, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(57, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(58, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(59, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(60, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(61, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(62, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(63, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(64, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(65, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(66, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(67, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(68, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(69, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(71, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(72, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(75, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(77, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(79, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(80, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(82, '2020-02-20', '0000-00-00', '0000-00-00', '0000-00-00', '2020-02-28', '0000-00-00', '2020-02-28'),
(83, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(84, '2020-02-24', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2020-02-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corrector`
--

CREATE TABLE `corrector` (
  `idCorrector` int(11) NOT NULL,
  `fechaEntra` date DEFAULT NULL,
  `nombreCorrector` varchar(35) DEFAULT NULL,
  `fechaSale` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `corrector`
--

INSERT INTO `corrector` (`idCorrector`, `fechaEntra`, `nombreCorrector`, `fechaSale`) VALUES
(14, '2019-11-19', 'El correcto textil', '2019-11-27'),
(15, '2019-11-27', 'El correcto textil', '2019-11-19'),
(18, '2020-01-15', 'Alfred', '2020-01-14'),
(19, '2019-11-12', 'alfred', '2019-11-07'),
(32, '0000-00-00', '', '0000-00-00'),
(34, '2019-11-01', '*/mantenimiento/*', '2019-11-01'),
(35, '0000-00-00', '', '0000-00-00'),
(36, '0000-00-00', '', '0000-00-00'),
(37, '0000-00-00', '', '0000-00-00'),
(38, '0000-00-00', '', '0000-00-00'),
(39, '2020-01-09', 'Adriana Cervantes', '2020-01-09'),
(40, '0000-00-00', '', '0000-00-00'),
(42, '0000-00-00', '', '0000-00-00'),
(43, '0000-00-00', '', '0000-00-00'),
(44, '2020-01-21', 'Adriana Cervantes', '2020-01-13'),
(45, '2020-01-13', 'Alfred', '2020-01-14'),
(46, '0000-00-00', 'Adriana Cervantes', '0000-00-00'),
(47, '0000-00-00', '', '0000-00-00'),
(48, '0000-00-00', '', '0000-00-00'),
(49, '0000-00-00', '', '0000-00-00'),
(51, '0000-00-00', 'mantenimiento', '0000-00-00'),
(52, '0000-00-00', '', '0000-00-00'),
(54, '0000-00-00', '', '0000-00-00'),
(55, '0000-00-00', '', '0000-00-00'),
(57, '0000-00-00', '', '0000-00-00'),
(59, '0000-00-00', '', '0000-00-00'),
(60, '0000-00-00', '', '0000-00-00'),
(61, '0000-00-00', '', '0000-00-00'),
(62, '0000-00-00', '', '0000-00-00'),
(63, '0000-00-00', '', '0000-00-00'),
(64, '0000-00-00', '', '0000-00-00'),
(65, '0000-00-00', '', '0000-00-00'),
(66, '0000-00-00', '', '0000-00-00'),
(67, '0000-00-00', '', '0000-00-00'),
(68, '0000-00-00', '', '0000-00-00'),
(69, '0000-00-00', '', '0000-00-00'),
(70, '0000-00-00', '', '0000-00-00'),
(71, '0000-00-00', '', '0000-00-00'),
(72, '0000-00-00', '', '0000-00-00'),
(73, '0000-00-00', '', '0000-00-00'),
(75, '0000-00-00', '', '0000-00-00'),
(76, '0000-00-00', '', '0000-00-00'),
(79, '0000-00-00', '', '0000-00-00'),
(81, '0000-00-00', '', '0000-00-00'),
(83, '0000-00-00', '', '0000-00-00'),
(84, '0000-00-00', '', '0000-00-00'),
(86, '2020-02-19', 'Adriana Cervantes', '2020-02-19'),
(87, '0000-00-00', '', '0000-00-00'),
(88, '2020-02-20', 'Adriana Cervantes', '2020-02-19');

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
(14, '2019-11-14'),
(17, '2020-01-20'),
(18, '2019-12-25'),
(31, '2019-11-29'),
(33, '2019-11-01'),
(34, '0000-00-00'),
(35, '0000-00-00'),
(36, '0000-00-00'),
(37, '0000-00-00'),
(38, '2020-01-09'),
(39, '0000-00-00'),
(41, '2020-01-27'),
(42, '2020-01-22'),
(43, '2020-02-03'),
(44, '0000-00-00'),
(45, '0000-00-00'),
(46, '0000-00-00'),
(47, '0000-00-00'),
(49, '0000-00-00'),
(50, '0000-00-00'),
(52, '0000-00-00'),
(53, '0000-00-00'),
(54, '0000-00-00'),
(56, '0000-00-00'),
(58, '0000-00-00'),
(59, '2020-01-21'),
(60, '0000-00-00'),
(61, '0000-00-00'),
(62, '0000-00-00'),
(63, '0000-00-00'),
(64, '0000-00-00'),
(65, '2020-02-11'),
(66, '0000-00-00'),
(67, '0000-00-00'),
(68, '0000-00-00'),
(69, '0000-00-00'),
(70, '0000-00-00'),
(71, '0000-00-00'),
(73, '0000-00-00'),
(74, '0000-00-00'),
(77, '0000-00-00'),
(79, '0000-00-00'),
(81, '0000-00-00'),
(82, '0000-00-00'),
(84, '2020-02-24'),
(85, '2020-03-20'),
(86, '2020-03-02');

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
(14, 18, 12, 14),
(15, 18, 12, 15),
(18, 21, 15, 18),
(19, 23, 16, 19),
(32, 36, 29, 32),
(34, 38, 31, 34),
(35, 39, 32, 35),
(36, 40, 33, 36),
(37, 41, 34, 37),
(38, 42, 35, 38),
(39, 43, 36, 39),
(40, 44, 37, 40),
(42, 46, 39, 42),
(43, 47, 40, 43),
(44, 48, 41, 44),
(45, 49, 42, 45),
(46, 50, 43, 46),
(47, 51, 44, 47),
(48, 52, 45, 48),
(49, 53, 46, 49),
(51, 55, 48, 51),
(52, 56, 49, 52),
(54, 58, 51, 54),
(55, 59, 52, 55),
(57, 61, 54, 57),
(59, 63, 56, 59),
(60, 64, 57, 60),
(61, 65, 58, 61),
(62, 66, 59, 62),
(63, 67, 60, 63),
(64, 68, 61, 64),
(65, 69, 62, 65),
(66, 70, 63, 66),
(67, 70, 63, 67),
(68, 71, 64, 68),
(69, 72, 65, 69),
(70, 73, 66, 70),
(71, 74, 67, 71),
(72, 75, 68, 72),
(73, 76, 69, 73),
(75, 78, 71, 75),
(76, 79, 72, 76),
(79, 82, 75, 79),
(81, 84, 77, 81),
(83, 86, 79, 83),
(84, 87, 80, 84),
(86, 89, 82, 86),
(87, 90, 83, 87),
(88, 91, 84, 88);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disenopersonal`
--

CREATE TABLE `disenopersonal` (
  `idpersonaldiseno` int(11) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `idFase2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `disenopersonal`
--

INSERT INTO `disenopersonal` (`idpersonaldiseno`, `direccion`, `idFase2`) VALUES
(1, '../disenos/QP2wXm__Migrarweb.jpg', 43),
(2, '../disenos/27TpG6__Migrar impresión .jpg', 64),
(3, '../disenos/PL7G1p__Migrar impresión .jpg', 64),
(7, '../disenos/z3giGh__ofunam-web.jpg', 61),
(8, '../disenos/FEgqdx__ofunam 2.pdf', 61),
(9, '../disenos/De1UCP__Naxin impresión.jpg', 65),
(11, '../disenos/ViRK03__orquesta de guitarras.pdf', 70),
(12, '../disenos/9E4pxm__orquesta de guitarras impre.jpg', 70),
(13, '../disenos/S41TZz__orquesta-de-guitarras.-web.jpg', 70),
(14, '../disenos/kHYq5I__CARTELNAXINweb.jpg', 65),
(16, '../disenos/NTAXp5__CARTELNAXINIMP.jpg', 65),
(17, '../disenos/naxDer__perros impresión.jpg', 89),
(19, '../disenos/tVO4Gw__perros impresión.jpg', 89),
(20, '../disenos/7W3oDO__perros impresión.jpg', 89),
(21, '../disenos/6Brth2__perrosweb.jpg', 89),
(22, '../disenos/QdmEoy__perrosweb.jpg', 89);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fase2`
--

CREATE TABLE `fase2` (
  `idFase2` int(11) NOT NULL,
  `nombreDisenador` varchar(35) DEFAULT NULL,
  `fechaEntra` date DEFAULT NULL,
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

INSERT INTO `fase2` (`idFase2`, `nombreDisenador`, `fechaEntra`, `fechaSalida`, `cartel`, `web`, `cortesias`, `programa`, `invitacion`) VALUES
(18, 'Diseñador pro', '2019-11-18', '2019-11-26', 0, 0, 1, 1, 1),
(21, 'Itzel Avendaño ', '2020-01-13', '2020-01-14', 1, 1, 1, 0, 0),
(22, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(23, 'tzel', '2019-11-27', '2019-11-22', 1, 1, 1, 1, 1),
(36, 'Eli', '2019-11-25', '2019-11-29', 1, 1, 1, 1, 1),
(38, '*/mantenimiento/*', '2020-01-01', '2020-01-01', 1, 1, 1, 1, 1),
(39, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(40, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(41, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(42, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(43, 'Juan Pablo Rivera', '2020-01-09', '2020-01-09', 0, 0, 0, 0, 0),
(44, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(46, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(47, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(48, 'Elizabeth Audelo', '2020-01-13', '2020-01-20', 1, 1, 0, 1, 0),
(49, 'Ángel López', '2020-01-20', '2020-01-21', 0, 0, 0, 0, 0),
(50, 'Elizabeth Audelo', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(51, 'Elizabeth Audelo', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(52, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(53, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(55, 'mantenimiento', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(56, 'Juan Pablo', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(58, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(59, 'Juan Pablo', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(61, 'Juan Pablo', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(63, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(64, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(65, 'Itzel Avendaño', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(66, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(67, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(68, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(69, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(70, 'Juan Pablo Rivera', '0000-00-00', '0000-00-00', 1, 1, 1, 0, 0),
(71, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(72, 'Ángel', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(73, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(74, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(75, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(76, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(78, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(79, 'Eli', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(82, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(84, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(86, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(87, '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(89, 'Itzel Avendaño ', '2020-02-19', '2020-02-23', 1, 1, 0, 1, 0),
(90, 'Ángel López', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0),
(91, 'Juan Pablo Rivera', '2020-02-19', '2020-02-20', 1, 1, 1, 0, 0);

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
(19, '../images/4k6DuN__ddis002-de4790e5-eef7-4def-b957-411183cc52cd.jpg', 24),
(20, '../images/bPTDo3__ddimiur-42c97a27-6e26-4765-8b3a-839bcc513a34.jpg', 24),
(24, '../images/Yg3cEs__0G21Qmm.jpg', 24),
(25, '../images/JOYGOu__34603301_1698703580225162_7526753078968582144_n.jpg', 24),
(32, '../images/TTKh2E__Carmen-Actualizado web 5-2019 .jpg', 27),
(33, '../images/sLV23K__Carmen-Actualizado web 5-2019 .jpg', 28),
(34, '../images/YLqj22__Juan Carlos Laguna 2017.jpg', 30),
(35, '../images/JGQBEP__paco.jpg', 30),
(36, '../images/abuems__paco.jpg', 31),
(37, '../images/Im2BLX__76769607_2525736097539740_4918391436921012224_n.png', 45),
(38, '../images/GY8TUZ__Foto entrevista.jpg', 49),
(39, '../images/yYslhC__concurso rap cartel impre.jpg', 57),
(40, '../images/8V8BIY__concurso rap cartel impre.jpg', 58),
(41, '../images/UgA1FU__Tarea S1.2.JPG', 69),
(42, '../images/6HIndz__image001.jpg', 106),
(43, '../images/8y90Hw__image002.jpg', 106),
(44, '../images/Ij54PI__IMG_1855-2.jpeg', 106);

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
(4, '10:00:00', 3),
(5, '13:00:00', 4),
(6, '13:00:00', 5),
(7, '13:00:00', 6),
(8, '18:00:00', 6),
(9, '10:00:00', 7),
(10, '12:00:00', 7),
(11, '14:00:00', 7),
(12, '10:00:00', 8),
(13, '12:00:00', 8),
(14, '14:00:00', 8),
(15, '11:00:00', 9),
(16, '11:00:00', 10),
(17, '13:00:00', 10),
(18, '19:00:00', 11),
(19, '13:00:00', 12),
(21, '12:00:00', 14),
(22, '12:00:00', 15),
(23, '19:00:00', 16),
(24, '13:00:00', 17),
(25, '14:00:00', 18),
(26, '12:00:00', 19),
(27, '12:00:00', 20),
(30, '10:00:00', 22),
(33, '10:00:00', 25),
(35, '11:00:00', 27),
(36, '12:30:00', 27),
(37, '11:00:00', 28),
(38, '12:30:00', 28),
(39, '19:00:00', 29),
(40, '12:00:00', 30),
(41, '12:00:00', 30),
(42, '12:00:00', 31),
(43, '18:00:00', 31),
(44, '18:00:00', 32),
(45, '18:00:00', 33),
(46, '11:00:00', 33),
(47, '11:00:00', 34),
(48, '11:00:00', 35),
(49, '13:30:00', 35),
(50, '18:00:00', 35),
(51, '11:00:00', 36),
(52, '13:00:00', 37),
(53, '13:00:00', 38),
(54, '18:00:00', 39),
(65, '12:30:00', 45),
(68, '18:00:00', 47),
(69, '17:00:00', 48),
(70, '13:00:00', 49);

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
(24, '../images/G26vUG__images (2).jpeg', 24),
(25, '../images/ItnPOs__D9RtHV8WwAUalzR.jpg', 24),
(30, '../images/tyg0E5__21231302_1795026057178961_3817550862221906458_n.jpg', 24),
(32, '../images/gTNOHq__3e5010acd206b91cffd6f50bf7d58ba4.jpg', 24),
(35, '../images/4kQpOK__logo CND blanco.png', 27),
(36, '../images/oNS4iF__logo CND blanco.png', 28),
(37, '../images/tXxe2r__diseno-fondo-abstracto_1297-81.jpg', 31),
(38, '../images/LDp4Zh__LOGO COALI.png', 31),
(39, '../images/LDp4Zh__LOGO COALI.png', 31),
(40, '../images/bb8jbZ__77063941_509345073255095_7935877279740067840_n.png', 45),
(41, '../images/HqlbLl__Foto entrevista 2.jpg', 49),
(42, '../images/kneDjh__impresiÃ³n OFM.jpg', 57),
(43, '../images/PczBsD__impresiÃ³n OFM.jpg', 58),
(44, '../images/BnldIr__Tarea S1.2.JPG', 69),
(45, '../images/BnldIr__Tarea S1.2.JPG', 69),
(46, '../images/AcwSib__image002.jpg', 63),
(47, '../images/1wndof__image003.jpg', 63),
(48, '../images/6sT8pW__image005.jpg', 63),
(49, '../images/svJZl3__image009.jpg', 63),
(50, '../images/svJZl3__image009.jpg', 63),
(51, '../images/fSaoDH__Comunidad CulturaUNAM_Logo_negro.png', 106);

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
(3, 7, 51, 44, 82),
(4, 8, 52, 45, 83),
(5, 9, 53, 46, 84),
(6, 10, 55, 47, 85),
(7, 11, 56, 48, 86),
(10, 14, 60, 51, 89),
(11, 15, 61, 52, 90),
(12, 16, 62, 53, 91),
(13, 17, 63, 54, 92),
(14, 18, 64, 55, 93),
(15, 19, 65, 56, 94),
(16, 20, 66, 57, 95),
(17, 20, 67, 58, 96),
(19, 22, 69, 60, 98),
(22, 22, 72, 63, 101),
(25, 25, 75, 66, 104),
(27, 28, 77, 68, 106),
(28, 29, 78, 69, 107),
(29, 30, 79, 70, 108),
(30, 31, 80, 71, 109),
(31, 31, 81, 72, 110),
(32, 32, 82, 73, 111),
(33, 33, 83, 74, 112),
(34, 34, 84, 75, 113),
(35, 35, 85, 76, 114),
(36, 36, 86, 77, 115),
(37, 37, 87, 78, 116),
(38, 38, 88, 79, 117),
(39, 39, 89, 80, 118),
(50, 45, 100, 91, 129),
(53, 47, 104, 94, 132),
(54, 48, 105, 95, 133),
(55, 49, 106, 97, 134);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimientoactividad`
--

CREATE TABLE `requerimientoactividad` (
  `idRequerimientoActividad` int(11) NOT NULL,
  `fechaProgramacion` date DEFAULT NULL,
  `fechaEvento` date DEFAULT NULL,
  `nombreCompania` varchar(50) DEFAULT NULL,
  `nombreActividad` varchar(50) DEFAULT NULL,
  `disciplina` varchar(50) DEFAULT NULL,
  `lugar` varchar(50) DEFAULT NULL,
  `tipoEntrada` int(11) DEFAULT NULL,
  `costo` int(11) DEFAULT NULL,
  `duracion` time DEFAULT NULL,
  `observacion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `requerimientoactividad`
--

INSERT INTO `requerimientoactividad` (`idRequerimientoActividad`, `fechaProgramacion`, `fechaEvento`, `nombreCompania`, `nombreActividad`, `disciplina`, `lugar`, `tipoEntrada`, `costo`, `duracion`, `observacion`) VALUES
(3, '2019-11-14', '2020-03-03', 'OFUNAM', 'Concierto de temporada', 'Música', 'Teatro Javier Barros Sier', 1, 0, '00:00:01', 'Se requieren 80 sillas sin posabrazos, iluminación básica. Catering'),
(4, '2019-11-14', '2019-11-19', '3° Encuentro de danza de ', '3° Encuentro de danza de ', 'Danza', 'Teatro Javier Barros Sier', 1, 0, '01:00:00', 'Alfredo y Perla atienden la entrada, no habrá catering, reportar asistencia.'),
(5, '2019-11-21', '2020-01-03', 'Compañía Nacional', 'las flores', 'Teatro', 'Teatro Javier Barros', 1, 120, '01:30:00', 'Área de observaciones'),
(6, '2019-11-21', '2019-11-20', 'dfsdfsdf', 'sdfsdfsd', 'sdfsdfsdf', 'sdfsdfsdf', 1, 0, '01:25:00', 'gfgsdfgsdfgsdfgsdfgs'),
(7, '2020-01-09', '2020-01-13', 'Dirección FES Acatlán', 'Entrega de diplomas gener', 'Evento académico', 'Teatro Javier Barros Sier', 1, 0, '01:00:00', 'Actividad organizada por Secretaría General de la FES Acatlán'),
(8, '2020-01-09', '2020-01-14', 'Dirección FES Acatlán', 'Entrega de diplomas gener', 'Evento académico', 'Teatro Javier Barros Sier', 1, 0, '01:00:00', 'Actividad organizada por la Secretaría General de la FES Acatlán'),
(9, '2020-01-09', '2020-01-15', 'Dirección FES Acatlán', 'Entrega de diplomas gener', 'Evento académico', 'Teatro Javier Barros Sier', 1, 0, '01:00:00', 'Actividad organizada por la Secretaría General de la FES Acatlán'),
(10, '2020-01-09', '2020-01-29', 'Dirección FES Acatlán', 'Toma de protesta', 'Evento académico', 'Teatro Javier Barros Sier', 1, 0, '01:00:00', 'Actividad organizada por la Secretaría General de la FES Acatlán'),
(11, '2020-01-21', '2020-01-30', 'Armando Luna', 'Migrar', 'Teatro', 'Teatro Javier Barros Sier', 1, 0, '01:30:00', 'Obra finalista 27 FITU, Dir. Armando Luna'),
(12, '2020-01-09', '2020-02-13', 'compañia', 'nombre', 'disciplina', 'lugar', 1, 0, '02:00:00', 'observaciones'),
(14, '2020-01-10', '2020-02-10', 'Diplomado Diseño', 'Exposición Fotográfica', 'Fotografia', 'Teatro Javier Barros Sier', 1, 0, '01:00:00', 'El montaje se lleva a cabo del \r\n'),
(15, '2020-01-10', '2020-02-10', 'Expo Foto Oswaldo Taboada', 'Diplomado en Foto Digital', 'Exposición', 'Sala de Arte Emma Rizo', 1, 0, '01:00:00', 'Exposición organizada por Educación Continua, ellos elaboran difusión. Sólo apoyamos en montaje y logística de inauguración'),
(16, '2020-01-10', '2020-02-13', 'Giselle', 'Compañía Nacional de Danz', 'Danza', 'Teatro Javier Barros Sier', 3, 50, '02:00:00', 'El costo para comunidad interna, alumnos y profesores de diferentes colegios, INAPAM, exalumnos $50.00 pesos General $100.00 pesos'),
(17, '2020-01-20', '2020-02-18', 'Trio de Metales', 'OFUNAM', 'Música', 'Auditorio Miguel de la To', 1, 0, '01:00:00', 'Programa: Música en territorio PUMA, Grupos de Cámara de la OFUNAM de la Dirección General de Música, UNAMñ'),
(18, '2020-01-10', '2020-02-14', 'Giselle', 'Compañía Nacional de Danz', 'Danza', 'Teatro Javier Barros Sier', 3, 50, '02:00:00', 'Costo UNAM, alumnos, profesores de cualquier escuela o institución educativa, INAPAM y exalumnos $50.00 pesos, General $100.00'),
(19, '2020-01-10', '2020-02-15', 'Giselle', 'Compañía Nacional de Danz', 'Danza', 'Teatro Javier Barros Sier', 3, 50, '02:00:00', 'Costo UNAM, profesores y alunmos de escuelas e instituciones educativas $50.00, General $100.00'),
(20, '2020-01-17', '2020-02-16', 'Giselle', 'Compañía Nacional de Danz', 'Danza', 'Teatro Javier Barros Sier', 3, 50, '02:00:00', 'Costo UNAM, profesores y alunmos de escuelas e instituciones educativas $50.00, General $100.00'),
(22, '2020-01-14', '2033-10-14', 'mantenimiento', 'mantenimiento', 'mantenimiento', 'mantenimiento', 1, 0, '01:05:00', 'mantenimiento'),
(25, '2020-01-20', '2020-03-03', 'OFUNAM', 'OFUNAM', 'Música', 'Teatro Javier Barros Sierra', 2, 0, '01:00:00', ''),
(27, '2020-01-20', '2020-02-20', 'Dirección FES Acatlán', 'Toma de protesta', 'Evento académico', 'Teatro Javier Barros Sierra', 1, 0, '01:00:00', ''),
(28, '2020-01-20', '2020-02-20', 'Dirección FES Acatlán', 'Toma de protesta', 'Evento académico', 'Teatro Javier Barros Sierra', 1, 0, '01:00:00', ''),
(29, '2020-01-21', '2020-01-31', 'Armando Luna', 'Migrar', 'Teatro', 'Teatro Javier Barros Sierra', 1, 0, '00:00:00', 'Obra finalista 27 FITU, Dir. Armando Luna'),
(30, '2020-02-04', '2020-02-21', ' Inauguración Filogonio Naxin', 'Exposición', 'Exposición', 'Sala de Arte Emma Rizo', 1, 0, '01:00:00', ''),
(31, '2020-01-23', '2020-02-17', 'Giselle', 'Compañía Nacional de Danza', 'Danza', 'Teatro Javier Barros Sierra', 1, 0, '01:00:00', ''),
(32, '2020-01-23', '2020-03-24', 'Dirección FES Acatlán', 'Toma de protesta', 'Evento académico', 'Teatro Javier Barros Sierra', 1, 0, '01:00:00', 'Por confirmar'),
(33, '2020-01-23', '2020-03-25', 'Dirección FES Acatlán', 'Toma de protesta', 'Evento académico', 'Teatro Javier Barros Sierra', 1, 0, '01:00:00', 'Confirmado, solicitar tiempo extraordinario desde las 17:00 hasta las 20:00 horas'),
(34, '2020-02-11', '2020-02-25', 'Orquesta de guitarras', 'EBAN Naucalpan ', 'musica', 'Auditorio Miguel de la Torre', 1, 0, '00:00:01', 'Sillas y micrófonos'),
(35, '2020-02-17', '2020-02-26', 'Documentales Cacao', '\"La ira o el seol\", \"Retorno a Aztlán\" y Eréndira ', 'Cine Documental', 'Teatro Javier Barros Sierra', 3, 25, '01:00:00', ''),
(36, '2020-02-17', '2020-02-28', 'Presentación de libro', '\"De docente a víctima del estudiantado\"', 'Literatura', 'Auditorio de Investigación ', 1, 0, '01:00:00', ''),
(37, '2020-02-19', '2020-03-06', 'Para siempre es mucho tiempo', 'Mil grullas', 'Teatro', 'Teatro Javier Barros Sierra', 2, 0, '01:00:00', ''),
(38, '2020-02-17', '2020-03-10', 'Concierto de voz y piano', 'Bellas artes en la UNAM', 'Música', 'Auditorio Miguel de la Torre', 2, 0, '01:30:00', ''),
(39, '2020-02-17', '2020-03-12', 'Un beso en la frente', 'Teatro UNAM', 'Teatro', 'Teatro Javier Barros Sierra', 2, 0, '01:30:00', ''),
(45, '2020-02-17', '2020-03-15', 'Concierto OSEM', 'OSEM', 'Música', 'Teatro Javier Barros Sierra', 2, 0, '01:30:00', ''),
(47, '2020-02-19', '2020-03-05', 'Los Perros', 'Teatro, Laura Mirandé', 'Teatro', 'Teatro Javier Barros Sierra', 3, 50, '01:00:00', 'Cuota de recuperación $50.oo, venta de boletos en taquilla del Centro Cultural Acatlán a partir del lunes 2 de marzo, de 10:00 a 14:00 horas. el día de la función, una hora antes.\r\n\r\nPoner la dirección de la FES y el tel del CCA en el cartel.'),
(48, '2020-02-19', '2020-03-19', 'Tuna Universitaria de la FES Acatlán', 'Concierto', 'Música', 'Teatro Javier Barros Sierra', 1, 0, '02:00:00', '41 aniversario de la Tuna Universitaria de la FES Acatlán, Dr. Roberto Ramírez'),
(49, '2020-02-19', '2020-03-20', 'Tambuco', 'Concierto', 'Música', 'Teatro Javier Barros Sierra', 2, 0, '01:00:00', 'En colaboración con Difusión Cultural UNAM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimientodiseno`
--

CREATE TABLE `requerimientodiseno` (
  `idRequerimientoDiseno` int(11) NOT NULL,
  `fechaEntrega` date DEFAULT NULL,
  `semblanzaCompania` varchar(50) DEFAULT NULL,
  `semblanzaActividad` varchar(50) DEFAULT NULL,
  `programaMano` varchar(50) DEFAULT NULL,
  `direccionPdf` varchar(100) DEFAULT NULL,
  `word` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `requerimientodiseno`
--

INSERT INTO `requerimientodiseno` (`idRequerimientoDiseno`, `fechaEntrega`, `semblanzaCompania`, `semblanzaActividad`, `programaMano`, `direccionPdf`, `word`) VALUES
(24, '2019-11-03', '', '', '1', NULL, NULL),
(27, '2020-01-13', 'kjsdhfpiawjer', 'jdljasdlkfmlm oijwekrgklnmcp{vm', '1', NULL, NULL),
(28, '2020-01-13', 'kjsdhfpiawjer', 'jdljasdlkfmlm oijwekrgklnmcp{vm', '1', NULL, NULL),
(29, '0000-00-00', '', '', '0', NULL, NULL),
(30, '2019-12-04', '', '', '1', NULL, NULL),
(31, '2019-12-04', '', '', '1', NULL, NULL),
(32, '0000-00-00', '', '', '0', NULL, NULL),
(45, '2019-11-23', '', '', '1', 'jsjsjsjsjs', NULL),
(49, '2020-01-01', '*/mantenimiento/*', '*/mantenimiento/*', '1', '../pdfs/meysXi__Tarea-5.pdf', '../words/ukGeAz__tarea 5.docx'),
(50, '0000-00-00', '', '', '0', '', ''),
(51, '0000-00-00', '', '', '0', '', ''),
(52, '0000-00-00', '', '', '0', '', ''),
(53, '0000-00-00', '', '', '0', '', ''),
(54, '0000-00-00', '', '', '0', '', ''),
(55, '0000-00-00', '', '', '0', '', ''),
(56, '2020-01-09', '', '', '1', '', ''),
(57, '0000-00-00', '', '', '0', '../pdfs/ytCihO__Circular.pdf', '../words/Ovs599__RECONOCIMIENTO MAC.docx'),
(58, '2020-01-16', '', '', '0', '../pdfs/7t5G0l__Circular.pdf', '../words/diSg0o__RECONOCIMIENTO MAC.docx'),
(60, '0000-00-00', '', '', '0', '', ''),
(61, '0000-00-00', '', '', '0', '', ''),
(62, '2020-01-13', 'CompaÃ±Ã­a Nacional de Danza  \r\n\r\nNuestros orÃ­gen', 'https://companianacionaldedanza.inba.gob.mx/2014-0', '1', '', ''),
(63, '2020-01-20', '', '', '1', '', '../words/ayK795__ficha trio metales.docx'),
(64, '2020-01-13', '', '', '0', '', ''),
(65, '0000-00-00', '', '', '0', '', ''),
(66, '0000-00-00', '', '', '0', '', ''),
(67, '0000-00-00', '', '', '0', '', ''),
(69, '0000-00-00', '', '', '1', '../pdfs/R6W6jC__TareaS6.1.pdf', '../words/aG8xqW__TareaS6.1.docx'),
(70, '0000-00-00', '', '', '0', '', ''),
(72, '0000-00-00', '', '', '0', '', ''),
(73, '0000-00-00', '', '', '0', '', ''),
(75, '0000-00-00', '', '', '0', '', ''),
(77, '0000-00-00', '', '', '0', '', ''),
(78, '0000-00-00', '', '', '0', '', ''),
(79, '0000-00-00', '', '', '0', '', ''),
(80, '0000-00-00', '', '', '0', '', ''),
(81, '0000-00-00', '', '', '0', '', ''),
(82, '0000-00-00', '', '', '0', '', ''),
(83, '0000-00-00', '', '', '0', '', ''),
(84, '2020-02-04', '', '', '0', '', ''),
(85, '0000-00-00', '', '', '0', '', ''),
(86, '0000-00-00', '', '', '0', '', ''),
(87, '0000-00-00', '', '', '0', '', ''),
(88, '0000-00-00', '', '', '0', '', ''),
(89, '0000-00-00', '', '', '0', '', ''),
(90, '0000-00-00', '', '', '0', '', ''),
(92, '0000-00-00', '', '', '0', '', ''),
(93, '0000-00-00', '', '', '0', '', ''),
(96, '0000-00-00', '', '', '0', '', ''),
(98, '0000-00-00', '', '', '0', '', ''),
(100, '0000-00-00', '', '', '0', '', ''),
(101, '0000-00-00', '', '', '0', '', ''),
(103, '2020-02-19', '', '', '0', '../pdfs/o3Acb5__los-perros.pdf', '../words/4lLyCH__Dossier Los Perros.docx'),
(104, '2020-02-19', '', '', '0', '../pdfs/OxqgcV__los-perros.pdf', '../words/dz6k07__Dossier Los Perros.docx'),
(105, '2020-02-19', '', '', '0', '', ''),
(106, '2020-02-19', '', '', '0', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimientopago`
--

CREATE TABLE `requerimientopago` (
  `idRequerimientoPago` int(11) NOT NULL,
  `requerimiento` varchar(100) DEFAULT NULL,
  `fechaDocumentacion` date DEFAULT NULL,
  `fechaTentativa` date DEFAULT NULL,
  `direccionPdf` varchar(100) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `word` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `requerimientopago`
--

INSERT INTO `requerimientopago` (`idRequerimientoPago`, `requerimiento`, `fechaDocumentacion`, `fechaTentativa`, `direccionPdf`, `imagen`, `word`) VALUES
(49, 'asdf', '2019-11-13', '2019-11-28', NULL, NULL, NULL),
(52, '', '0000-00-00', '0000-00-00', NULL, NULL, NULL),
(53, '', '0000-00-00', '0000-00-00', NULL, NULL, NULL),
(54, 'pago con factura', '2019-12-11', '2020-01-15', NULL, NULL, NULL),
(55, 'pago con factura', '2019-12-11', '0000-00-00', NULL, NULL, NULL),
(56, '', '0000-00-00', '0000-00-00', NULL, NULL, NULL),
(69, '', '0000-00-00', '0000-00-00', NULL, NULL, NULL),
(77, '', '0000-00-00', '0000-00-00', '../pdfs/HLCN7x__examen5 abd.pdf', '../images/dVzxa6__FB_IMG_1543954818087.jpg', NULL),
(78, '', '0000-00-00', '0000-00-00', '', '', '../words/lDfsi5__languange learning.docx'),
(79, '', '0000-00-00', '0000-00-00', '', '', '../words/OMNeyg__Tarea 10.docx'),
(81, '*/mantenimiento/*', '2020-01-01', '2020-01-01', '../pdfs/terF43__tarea 8.pdf', '../images/t6vYZN__Foto entrevista 3.jpg', '../words/hlLKqC__tarea 8.docx'),
(82, '', '0000-00-00', '0000-00-00', '', '', ''),
(83, '', '0000-00-00', '0000-00-00', '', '', ''),
(84, '', '0000-00-00', '0000-00-00', '', '', ''),
(85, '', '0000-00-00', '0000-00-00', '', '', ''),
(86, '', '0000-00-00', '0000-00-00', '', '', ''),
(87, '', '0000-00-00', '0000-00-00', '', '', ''),
(89, '', '0000-00-00', '0000-00-00', '', '', ''),
(90, '', '0000-00-00', '0000-00-00', '', '', ''),
(91, '', '0000-00-00', '0000-00-00', '', '', ''),
(92, '', '0000-00-00', '0000-00-00', '', '', ''),
(93, '', '0000-00-00', '0000-00-00', '', '', ''),
(94, '', '0000-00-00', '0000-00-00', '', '', ''),
(95, '', '0000-00-00', '0000-00-00', '', '', ''),
(96, '', '0000-00-00', '0000-00-00', '', '', ''),
(98, 'mantenimiento', '0000-00-00', '2020-01-17', '../pdfs/y85ssb__Tarea S1-4.pdf', '../images/oEV0uG__Tarea S1.2.JPG', '../words/UZvcVF__Tarea S1-4.docx'),
(99, '', '0000-00-00', '0000-00-00', '', '', ''),
(101, '', '0000-00-00', '0000-00-00', '', '', ''),
(102, '', '0000-00-00', '0000-00-00', '', '', ''),
(104, '', '0000-00-00', '0000-00-00', '', '', ''),
(106, '', '0000-00-00', '0000-00-00', '', '', ''),
(107, '', '0000-00-00', '0000-00-00', '', '', ''),
(108, '', '0000-00-00', '0000-00-00', '', '', ''),
(109, '', '0000-00-00', '0000-00-00', '', '', ''),
(110, '', '0000-00-00', '0000-00-00', '', '', ''),
(111, '', '0000-00-00', '0000-00-00', '', '', ''),
(112, '', '0000-00-00', '0000-00-00', '', '', ''),
(113, '', '0000-00-00', '0000-00-00', '', '', ''),
(114, '', '0000-00-00', '0000-00-00', '', '', ''),
(115, '', '0000-00-00', '0000-00-00', '', '', ''),
(116, '', '0000-00-00', '0000-00-00', '', '', ''),
(117, '', '0000-00-00', '0000-00-00', '', '', ''),
(118, '', '0000-00-00', '0000-00-00', '', '', ''),
(119, '', '0000-00-00', '0000-00-00', '', '', ''),
(121, '', '0000-00-00', '0000-00-00', '', '', ''),
(122, '', '0000-00-00', '0000-00-00', '', '', ''),
(125, '', '0000-00-00', '0000-00-00', '', '', ''),
(127, '', '0000-00-00', '0000-00-00', '', '', ''),
(129, '', '0000-00-00', '0000-00-00', '', '', ''),
(130, '', '0000-00-00', '0000-00-00', '', '', ''),
(132, '', '0000-00-00', '0000-00-00', '', '', ''),
(133, '', '0000-00-00', '0000-00-00', '', '', ''),
(134, '', '0000-00-00', '0000-00-00', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimientotecnico`
--

CREATE TABLE `requerimientotecnico` (
  `idRequerimientoTecnico` int(11) NOT NULL,
  `requerimiento` varchar(120) DEFAULT NULL,
  `direccionPdf` varchar(100) DEFAULT NULL,
  `word` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `requerimientotecnico`
--

INSERT INTO `requerimientotecnico` (`idRequerimientoTecnico`, `requerimiento`, `direccionPdf`, `word`) VALUES
(38, 'Andamio de 6m de altura', '', NULL),
(40, '', '', NULL),
(43, '*/mantenimiento/*', '../pdfs/b02XCy__tarea 7.pdf', '../words/MS6w3Y__tarea 7.docx'),
(44, '', '', ''),
(45, '', '', ''),
(46, '', '', ''),
(47, '', '', ''),
(48, '', '', ''),
(49, '', '', ''),
(51, '', '', ''),
(52, 'Podio, audio, sillas para el dÃ­a de inauguraciÃ³n', '', ''),
(53, 'Montaje del 10 al 12 de febrero', '', ''),
(54, 'Tres sillas sin posabrazos, un micrÃ³fono con pedestal, limpieza del auditorio, un tÃ©cnico que apoye la actividad.', '', '../words/yRBa6E__ficha trio metales.docx'),
(55, '', '', ''),
(56, '', '', ''),
(57, '', '', ''),
(58, '', '', ''),
(60, 'mantenimiento', '../pdfs/z4Jx4A__Tarea S1-2.pdf', '../words/cw5crd__Proyecto.docx'),
(61, '', '', ''),
(63, '', '', ''),
(64, '', '', ''),
(66, '', '', ''),
(68, '', '', ''),
(69, '', '', ''),
(70, '', '', ''),
(71, '', '', ''),
(72, '', '', ''),
(73, '', '', ''),
(74, '', '', ''),
(75, '', '', ''),
(76, '', '', ''),
(77, '', '', ''),
(78, '', '', ''),
(79, '', '', ''),
(80, '', '', ''),
(81, '', '', ''),
(83, '', '', ''),
(84, '', '', ''),
(87, '', '', ''),
(89, '', '', ''),
(91, '', '', ''),
(92, '', '', ''),
(94, 'Anexo ficha con los requerimientos tÃ©cnicos.', '', '../words/D9CBsh__Dossier Los Perros.docx'),
(95, '', '', ''),
(96, '', '../pdfs/Uf11ct__tambuco gira Comunidad CulturaUNAM 2020.pdf', ''),
(97, 'Anexo dossier', '../pdfs/P5pcQM__tambuco gira Comunidad CulturaUNAM 2020.pdf', '');

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
-- Indices de la tabla `disenopersonal`
--
ALTER TABLE `disenopersonal`
  ADD PRIMARY KEY (`idpersonaldiseno`),
  ADD KEY `idFase2` (`idFase2`);

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
  MODIFY `idActividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `cartelycortesias`
--
ALTER TABLE `cartelycortesias`
  MODIFY `idCartelyCortesias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `corrector`
--
ALTER TABLE `corrector`
  MODIFY `idCorrector` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `difusion`
--
ALTER TABLE `difusion`
  MODIFY `idDifusion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `diseno`
--
ALTER TABLE `diseno`
  MODIFY `idDiseno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `disenopersonal`
--
ALTER TABLE `disenopersonal`
  MODIFY `idpersonaldiseno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `fase2`
--
ALTER TABLE `fase2`
  MODIFY `idFase2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `fotografia`
--
ALTER TABLE `fotografia`
  MODIFY `idFotografia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `idHorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `logotipo`
--
ALTER TABLE `logotipo`
  MODIFY `idLogotipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `programacion`
--
ALTER TABLE `programacion`
  MODIFY `idProgramacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `requerimientoactividad`
--
ALTER TABLE `requerimientoactividad`
  MODIFY `idRequerimientoActividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `requerimientodiseno`
--
ALTER TABLE `requerimientodiseno`
  MODIFY `idRequerimientoDiseno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT de la tabla `requerimientopago`
--
ALTER TABLE `requerimientopago`
  MODIFY `idRequerimientoPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT de la tabla `requerimientotecnico`
--
ALTER TABLE `requerimientotecnico`
  MODIFY `idRequerimientoTecnico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

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
-- Filtros para la tabla `disenopersonal`
--
ALTER TABLE `disenopersonal`
  ADD CONSTRAINT `disenopersonal_ibfk_1` FOREIGN KEY (`idFase2`) REFERENCES `fase2` (`idFase2`);

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
