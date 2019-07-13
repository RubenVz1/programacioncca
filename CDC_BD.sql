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
   FOREIGN KEY (idTipoUsuario) REFERENCES TipoUsuarios(idTipoUsuario)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `Usuarios` ( `nombre`, `username`, `password`,`idTipoUsuario`) VALUES
('Ruben', 'hrvo', '12344321',2),
('Celis', 'notCelis', 'celiss',1);

CREATE TABLE `requerimientoActividad`
(
  `idRequerimientoActividad` int(11) DEFAULT NULL AUTO_INCREMENT,
  `fechaProgramacion` date DEFAULT NULL,
  `fechaEvento` date DEFAULT NULL,
  `nombreCompania` varchar(15) DEFAULT NULL,
  `nombreActividad` varchar(15) DEFAULT NULL,
  `disciplina` varchar(15) DEFAULT NULL,
  `lugar` varchar(15) DEFAULT NULL,
  `horario` time DEFAULT NULL,
  `tipoEntrada` int(11) DEFAULT NULL,
  `costo` int(11) DEFAULT NULL,
  `duracion` time DEFAULT NULL,
  PRIMARY KEY (idRequerimientoActividad)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `requerimientoActividad` (`idRequerimientoActividad`,`fechaProgramacion`, `fechaEvento`,
`nombreCompania`, `nombreActividad`, `disciplina`, `lugar`,`horario`, `tipoEntrada`, `duracion`) VALUES
(1,'2019-07-05', '2019-08-05','programacioncca','estreno','informatica','fesAcatlan','12:30:00',3,'01:30:00');

CREATE TABLE `requerimientoDiseno`
(
  `idRequerimientoDiseno` int(11) DEFAULT NULL AUTO_INCREMENT,
  `fechaEntrega` date DEFAULT NULL,
  `fotografia` longblob DEFAULT NULL,
  `logotipo` longblob DEFAULT NULL,
  `semblanzaCompania` varchar(15) DEFAULT NULL,
  `semblanzaActividad` varchar(15) DEFAULT NULL,
  `programaMano` varchar(15) DEFAULT NULL,
  PRIMARY KEY (idRequerimientoDiseno)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `requerimientoDiseno` (`idRequerimientoDiseno`,`fechaEntrega`,
`semblanzaCompania`, `semblanzaActividad`, `programaMano`) VALUES
(1,'2019-10-05', 'semblanzaCompania1','semblanzaActividad1','programaMano1');

CREATE TABLE `requerimientoTecnico`
(
  `idRequerimientoTecnico` int(11) DEFAULT NULL AUTO_INCREMENT,
  `requerimiento` varchar(100) DEFAULT NULL,
  PRIMARY KEY (idRequerimientoTecnico)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `requerimientoTecnico`(`idRequerimientoTecnico`,`requerimiento`) VALUES
(1,'Este es el requerimientoTecnido para la actividad1');

CREATE TABLE `requerimientoPago`
(
  `idRequerimientoPago` int(11) DEFAULT NULL AUTO_INCREMENT,
  `requerimiento` varchar(100) DEFAULT NULL,
  `fechaDocumentacion` date DEFAULT NULL,
  `fechaTentativa` date DEFAULT NULL,
  PRIMARY KEY (idRequerimientoPago)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `requerimientoPago` (`idRequerimientoPago`,`requerimiento`,`fechaDocumentacion`,`fechaTentativa`) VALUES
(1,'Este es el requerimientoPago para la actividad1','2019-07-01','2019-06-06');

CREATE TABLE `Programacion`
(
  `idProgramacion` int(11) DEFAULT NULL AUTO_INCREMENT,
  `idRequerimientoActividad` int(11) DEFAULT NULL,
  `idRequerimientoDiseno` int(11) DEFAULT NULL,
  `idRequerimientoTecnico` int(11) DEFAULT NULL,
  `idRequerimientoPago` int(11) DEFAULT NULL,
  PRIMARY KEY (idProgramacion),
  FOREIGN KEY (idRequerimientoActividad) REFERENCES requerimientoActividad(idRequerimientoActividad),
  FOREIGN KEY (idRequerimientoDiseno) REFERENCES requerimientoDiseno(idRequerimientoDiseno),
  FOREIGN KEY (idRequerimientoTecnico) REFERENCES requerimientoTecnico(idRequerimientoTecnico),
  FOREIGN KEY (idRequerimientoPago) REFERENCES requerimientoPago(idRequerimientoPago)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `Programacion` (`idProgramacion`,`idRequerimientoActividad`,`idRequerimientoDiseno`,
`idRequerimientoTecnico`,`idRequerimientoPago`) VALUES
(1,1,1,1,1);

CREATE TABLE `Actividad`
(
  `idActividad` int(11) DEFAULT NULL AUTO_INCREMENT,
  `idProgramacion` int(11) DEFAULT NULL,
  `idDiseno` int(11) DEFAULT NULL,
  `idDifusion` int(11) DEFAULT NULL,
  PRIMARY KEY (idActividad),
  FOREIGN KEY (idProgramacion) REFERENCES Programacion(idProgramacion)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `actividad` (`idActividad`,`idProgramacion`,`idDiseno`,`idDifusion`) VALUES (1,1,1,1);
