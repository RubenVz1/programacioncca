drop database prueba;
create database prueba;
use prueba;

CREATE TABLE `TipoUsuarios`
(
  `idTipoUsuario` int(11) DEFAULT NULL AUTO_INCREMENT,
  `nombreCargo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (idTipoUsuario)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `TipoUsuarios` (`nombreCargo`) VALUES
('Administrador'),
('Personal');

CREATE TABLE `Usuarios`
(
  `idUsuario` int(11) DEFAULT NULL AUTO_INCREMENT,
  `nombre` varchar(15) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `idTipoUsuario` int(11) DEFAULT NULL,
   PRIMARY KEY (idUsuario),
   FOREIGN KEY (idTipoUsuario) REFERENCES TipoUsuarios(idTipoUsuario) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Usuarios` ( `nombre`, `username`, `password`,`idTipoUsuario`) VALUES
('Ruben', 'hrvo', '1234',1),
('Celis', 'notCelis', 'celiss',2);

CREATE TABLE `requerimientoActividad`
(
  `idRequerimientoActividad` int(11) DEFAULT NULL AUTO_INCREMENT,
  `fechaProgramacion` date DEFAULT NULL,
  `fechaEvento` date DEFAULT NULL,
  `nombreCompania` varchar(25) DEFAULT NULL,
  `nombreActividad` varchar(25) DEFAULT NULL,
  `disciplina` varchar(25) DEFAULT NULL,
  `lugar` varchar(25) DEFAULT NULL,
  `tipoEntrada` int(11) DEFAULT NULL,
  `costo` int(11) DEFAULT NULL,
  `duracion` time DEFAULT NULL,
  `observacion` varchar(500) DEFAULT NULL,
  PRIMARY KEY (idRequerimientoActividad)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `requerimientoactividad` (`idRequerimientoActividad`, `fechaProgramacion`, `fechaEvento`, `nombreCompania`, `nombreActividad`, `disciplina`, `lugar`, `tipoEntrada`, `costo`, `duracion`, `observacion`) VALUES
(1, '2019-07-05', '2019-08-05', 'programacioncca', 'estreno', 'informatica', 'fesAcatlan', 3, NULL, '02:30:40', 'Esta observacion es de la actividad estreno'),
(5, '2018-04-03', '2019-09-01', 'finalizacionPro', 'cierre', 'cedetec', 'fesAcatlanUnam', 2, NULL, '02:02:02', 'Esta observacion es de la actividad cierre'),
(6, '2019-07-28', '2019-10-14', 'notcelis', 'fortnite', 'juegos', 'el chain', 1, NULL, '02:30:00', NULL),
(7, '2019-07-28', '2019-07-17', 'celis', 'skate', 'ytretyerty', 'mi casa', 1, 100, '01:05:00', ''),
(8, '2019-07-28', '2019-07-31', 'celis', 'skate', 'ytretyerty', 'mi casa', 1, 100, '01:05:00', 'jsjsjsjs'),
(9, '2019-07-28', '2019-10-13', 'celis', 'mi cumple', 'ytretyerty', 'mi casa', 1, 25, '05:30:00', 'trae tu alcohol'),
(10, '2019-07-28', '2019-08-29', 'celis', 'skate', 'ytretyerty', 'mi casa', 1, 0, '01:05:00', ''),
(11, '2019-07-28', '2019-07-29', 'celis', 'fotos', 'ytretyerty', 'mi casa', 1, 0, '01:05:00', ''),
(12, '2019-07-28', '2019-10-14', 'nombre compaÃ±i', 'nombre activida', 'disciplina', 'lugar', 1, 100, '01:30:00', 'observacion');

CREATE TABLE `Horario`
(
  `idHorario` int(11) DEFAULT NULL AUTO_INCREMENT,
  `horario` time DEFAULT NULL,
  `idRequerimientoActividad` int(11),
  PRIMARY KEY (idHorario),
  FOREIGN KEY (idRequerimientoActividad) REFERENCES requerimientoActividad(idRequerimientoActividad)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `horario` (`horario`, `idRequerimientoActividad`) VALUES
('02:21:00', 1),
('03:22:00', 1),
('04:20:00', 1),
('01:21:00', 1),
('02:22:00', 1),
('03:23:00', 1),
('01:25:00', 1),
('02:24:00', 5),
('03:23:00', 5),
('01:15:00', 5),
('02:25:00', 6),
('04:35:00', 6),
('01:45:00', 7),
('02:45:00', 8),
('03:55:00', 9),
('01:15:00', 9),
('02:10:00', 10),
('03:10:00', 10),
('01:15:00', 11),
('02:20:00', 11),
('03:22:00', 11),
('01:23:00', 12);

CREATE TABLE `requerimientoDiseno`
(
  `idRequerimientoDiseno` int(11) DEFAULT NULL AUTO_INCREMENT,
  `fechaEntrega` date DEFAULT NULL,
  `semblanzaCompania` varchar(50) DEFAULT NULL,
  `semblanzaActividad` varchar(50) DEFAULT NULL,
  `programaMano` varchar(15) DEFAULT NULL,
  PRIMARY KEY (idRequerimientoDiseno)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `requerimientodiseno` (`idRequerimientoDiseno`, `fechaEntrega`, `semblanzaCompania`, `semblanzaActividad`, `programaMano`) VALUES
(1, '2019-10-05', 'semblanzaCompan', 'semblanzaActivi', 'programaMano1'),
(7, '2017-11-03', 'semblanzaCompan', 'semblanzaActivi', 'programaMano2'),
(8, '0000-00-00', '', '', '0'),
(9, '0000-00-00', '', '', '0'),
(10, '0000-00-00', '', '', '0'),
(11, '0000-00-00', '', '', '0'),
(12, '0000-00-00', '', '', '0'),
(13, '2019-10-14', 'Semblanza de la', 'Semblanza de la', '1');

CREATE TABLE `fotografia`
(
  `idFotografia` int(11) DEFAULT NULL AUTO_INCREMENT,
  `fotografia`varchar(100) DEFAULT NULL,
  `idRequerimientoDiseno` int(11),
  PRIMARY KEY (idFotografia),
  FOREIGN KEY (idRequerimientoDiseno) REFERENCES requerimientoDiseno(idRequerimientoDiseno) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `logotipo`
(
  `idLogotipo` int(11) DEFAULT NULL AUTO_INCREMENT,
  `logotipo` varchar(100) DEFAULT NULL,
  `idRequerimientoDiseno` int(11),
  PRIMARY KEY (idLogotipo),
  FOREIGN KEY (idRequerimientoDiseno) REFERENCES requerimientoDiseno(idRequerimientoDiseno) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `requerimientoTecnico`
(
  `idRequerimientoTecnico` int(11) DEFAULT NULL AUTO_INCREMENT,
  `requerimiento` varchar(100) DEFAULT NULL,
  `direccionPdf` varchar(100) DEFAULT NULL,
  PRIMARY KEY (idRequerimientoTecnico)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `requerimientotecnico` (`idRequerimientoTecnico`, `requerimiento`) VALUES
(1, 'Este es el requerimientoTecnido para la actividad1'),
(2, 'Este es el requerimientoTecnido para la actividad2'),
(3, ''),
(4, ''),
(5, ''),
(6, ''),
(7, ''),
(8, 'req tec');

CREATE TABLE `requerimientoPago`
(
  `idRequerimientoPago` int(11) DEFAULT NULL AUTO_INCREMENT,
  `requerimiento` varchar(100) DEFAULT NULL,
  `fechaDocumentacion` date DEFAULT NULL,
  `fechaTentativa` date DEFAULT NULL,
  PRIMARY KEY (idRequerimientoPago)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `requerimientopago` (`idRequerimientoPago`, `requerimiento`, `fechaDocumentacion`, `fechaTentativa`) VALUES
(1, 'Este es el requerimientoPago para la actividad1', '2019-07-01', '2019-06-06'),
(32, 'Este es el requerimientoPago para la actividad2', '2018-06-01', '2019-03-06'),
(33, '', '0000-00-00', '0000-00-00'),
(34, '', '0000-00-00', '0000-00-00'),
(35, '', '0000-00-00', '0000-00-00'),
(36, '', '0000-00-00', '0000-00-00'),
(37, '', '0000-00-00', '0000-00-00'),
(38, 'req pag', '2019-07-14', '2019-10-13');

CREATE TABLE `Programacion`
(
  `idProgramacion` int(11) DEFAULT NULL AUTO_INCREMENT,
  `idRequerimientoActividad` int(11) DEFAULT NULL,
  `idRequerimientoDiseno` int(11) DEFAULT NULL,
  `idRequerimientoTecnico` int(11) DEFAULT NULL,
  `idRequerimientoPago` int(11) DEFAULT NULL,
  PRIMARY KEY (idProgramacion),
  FOREIGN KEY (idRequerimientoActividad) REFERENCES requerimientoActividad(idRequerimientoActividad) ON DELETE CASCADE,
  FOREIGN KEY (idRequerimientoDiseno) REFERENCES requerimientoDiseno(idRequerimientoDiseno) ON DELETE CASCADE,
  FOREIGN KEY (idRequerimientoTecnico) REFERENCES requerimientoTecnico(idRequerimientoTecnico) ON DELETE CASCADE,
  FOREIGN KEY (idRequerimientoPago) REFERENCES requerimientoPago(idRequerimientoPago) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `programacion` (`idProgramacion`, `idRequerimientoActividad`, `idRequerimientoDiseno`, `idRequerimientoTecnico`, `idRequerimientoPago`) VALUES
(1, 1, 1, 1, 1),
(4, 5, 7, 2, 32),
(5, 6, 8, 3, 33),
(6, 8, 9, 4, 34),
(7, 9, 10, 5, 35),
(8, 10, 11, 6, 36),
(9, 11, 12, 7, 37),
(10, 12, 13, 8, 38);

create TABLE `fase2`
(
  `idFase2` int(11) DEFAULT NULL AUTO_INCREMENT,
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
  `invitacion` int(2) DEFAULT NULL,
  PRIMARY KEY (idfase2)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `fase2` (`idfase2`, `nombredisenador`, `fechaentra`, `fotos`, `vineta`, `logos`, `lugar`, `fecha`, `hora`, `leyenda`, `fechasalida`, `cartel`, `web`, `cortesias`, `programa`, `invitacion`) VALUES
(1, '', '0000-00-00', 0, 0, 0, '', '0000-00-00', '00:00:00', '', '0000-00-00', 0, 0, 0, 0, 0),
(2, '', '0000-00-00', 0, 0, 0, '', '0000-00-00', '00:00:00', '', '0000-00-00', 0, 0, 0, 0, 0),
(3, '', '0000-00-00', 0, 0, 0, '', '0000-00-00', '00:00:00', '', '0000-00-00', 0, 0, 0, 0, 0),
(4, '', '0000-00-00', 0, 0, 0, '', '0000-00-00', '00:00:00', '', '0000-00-00', 0, 0, 0, 0, 0),
(5, '', '0000-00-00', 0, 0, 0, '', '0000-00-00', '00:00:00', '', '0000-00-00', 0, 0, 0, 0, 0),
(6, 'nombre diseñado', '2019-10-07', 1, 1, 1, 'lugar diseño', '2019-10-07', '20:30:00', 'leyenda', '2019-10-07', 1, 1, 1, 1, 1);

create TABLE `CartelyCortesias`
(
  `idCartelyCortesias` int(11) DEFAULT NULL AUTO_INCREMENT,
  `digital` date DEFAULT NULL,
  `offset` date DEFAULT NULL,
  `serigrafia` date DEFAULT NULL,
  `fuera` date DEFAULT NULL,
  `entregaPrograma` date DEFAULT NULL,
  `invitacion` date DEFAULT NULL,
  `volante` date DEFAULT NULL,
  PRIMARY KEY(idCartelyCortesias)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `cartelycortesias` (`idcartelycortesias`, `digital`, `offset`, `serigrafia`, `fuera`, `entregaprograma`, `invitacion`, `volante`) VALUES
(1, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(2, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(3, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(4, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(5, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(6, '2019-10-07', '2019-10-07', '2019-10-07', '2019-10-07', '2019-10-07', '2019-10-07', '2019-10-07');

create TABLE `Corrector`
(
  `idCorrector` int(11) DEFAULT NULL AUTO_INCREMENT,
  `fechaEntra` date DEFAULT NULL,
  `nombreCorrector` varchar(25) DEFAULT NULL,
  `fechaSale` date DEFAULT NULL,
  PRIMARY KEY(idCorrector)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `corrector` (`idcorrector`, `fechaentra`, `nombrecorrector`, `fechasale`) VALUES
(1, '0000-00-00', '', '0000-00-00'),
(2, '0000-00-00', '', '0000-00-00'),
(3, '0000-00-00', '', '0000-00-00'),
(4, '0000-00-00', '', '0000-00-00'),
(5, '0000-00-00', '', '0000-00-00'),
(6, '2019-10-14', 'corrector de textos', '2019-10-07');

CREATE TABLE `Diseno`
(
  `idDiseno` int(11) DEFAULT NULL AUTO_INCREMENT,
  `idFase2` int(11) DEFAULT NULL,
  `idCartelyCortesias` int(11) DEFAULT NULL,
  `idCorrector` int(11) DEFAULT NULL,
  PRIMARY KEY (idDiseno),
  FOREIGN KEY (idFase2) REFERENCES Fase2(idFase2) ON DELETE CASCADE,
  FOREIGN KEY (idCartelyCortesias) REFERENCES CartelyCortesias(idCartelyCortesias) ON DELETE CASCADE,
  FOREIGN KEY (idCorrector) REFERENCES Corrector(idCorrector) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `diseno` (`iddiseno`, `idfase2`, `idcartelycortesias`, `idcorrector`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2),
(3, 3, 3, 3),
(4, 4, 4, 4),
(5, 5, 5, 5),
(6, 6, 6, 6);

create TABLE `Difusion`
(
  `idDifusion` int(11) DEFAULT NULL AUTO_INCREMENT,
  `fechaDifusion` date DEFAULT NULL,
  PRIMARY KEY(idDifusion)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `difusion` (`idDifusion`, `fechadifusion`) VALUES
(1, '0000-00-00'),
(2, '0000-00-00'),
(3, '0000-00-00'),
(4, '0000-00-00'),
(5, '0000-00-00'),
(6, '2019-10-11');

CREATE TABLE `Actividad`
(
  `idActividad` int(11) DEFAULT NULL AUTO_INCREMENT,
  `idProgramacion` int(11) DEFAULT NULL,
  `idDifusion` int(11) DEFAULT NULL,
  `idDiseno` int(11) DEFAULT NULL,
  PRIMARY KEY (idActividad),
  FOREIGN KEY (idProgramacion) REFERENCES Programacion(idProgramacion) ON DELETE CASCADE,
  FOREIGN KEY (idDifusion) REFERENCES Difusion(idDifusion) ON DELETE CASCADE,
  FOREIGN KEY (idDiseno) REFERENCES Diseno(idDiseno) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `actividad` (`idActividad`, `idProgramacion`, `idDiseno`, `idDifusion`) VALUES
(1, 1, 1, 1),
(5, 4, 6, 6),
(6, 5, 1, 1),
(7, 6, 2, 2),
(8, 7, 3, 3),
(9, 8, 4, 4),
(10, 9, 5, 5),
(11, 10, 6, 6);
