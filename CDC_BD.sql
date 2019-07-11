drop database prueba;
create database prueba;
use prueba;

CREATE TABLE `TipoUsuarios`
(
  `idTipoUsuario` int(11) DEFAULT NULL,
  `nombreCargo` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE TipoUsuarios ADD PRIMARY KEY (idTipoUsuario);

INSERT INTO `TipoUsuarios` (`idTipoUsuario`, `nombreCargo`) VALUES
(1, 'Administrador'),
(2, 'Personal');

CREATE TABLE `Usuarios`
(
  `idUsuario` int(11) DEFAULT NULL,
  `nombre` varchar(15) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `idTipoUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE Usuarios ADD PRIMARY KEY (idUsuario);
ALTER TABLE Usuarios ADD FOREIGN KEY (idTipoUsuario) REFERENCES TipoUsuarios(idTipoUsuario) ON DELETE CASCADE;

INSERT INTO `Usuarios` (`idUsuario`, `nombre`, `username`, `password`,`idTipoUsuario`) VALUES
(1, 'Ruben', 'hrvo', '1234',1),
(2, 'Celis', 'notCelis', 'celiss',2);

CREATE TABLE `requerimientoActividad`
(
  `idRequerimientoActividad` int(11) DEFAULT NULL,
  `fechaProgramacion` date DEFAULT NULL,
  `fechaEvento` int(11) DEFAULT NULL,
  `nombreCompania` varchar(15) DEFAULT NULL,
  `nombreActividad` varchar(15) DEFAULT NULL,
  `disciplina` varchar(15) DEFAULT NULL,
  `lugar` varchar(15) DEFAULT NULL,
  `tipoEntrada` int(11) DEFAULT NULL,
  `duracion` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE requerimientoActividad ADD PRIMARY KEY (idRequerimientoActividad);

INSERT INTO `requerimientoActividad` (`idRequerimientoActividad`, `fechaProgramacion`, `fechaEvento`,
`nombreCompania`, `nombreActividad`, `disciplina`, `lugar`, `tipoEntrada`, `duracion`) VALUES
(1, '2019-07-05', '2019-08-05','programacioncca','estreno','informatica','fesAcatlan',3,'02:30:40'),
(5, '2018-04-03', '2016-07-01','finalizacionProgramacion','cierre','cedetec','fesAcatlanUnam',2,'02:02:02');

CREATE TABLE `requerimientoDiseno`
(
  `idRequerimientoDiseno` int(11) DEFAULT NULL,
  `fechaEntrega` date DEFAULT NULL,
  `fotografia` blob DEFAULT NULL,
  `logotipo` blob DEFAULT NULL,
  `semblanzaCompania` varchar(15) DEFAULT NULL,
  `semblanzaActividad` varchar(15) DEFAULT NULL,
  `programaMano` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE requerimientoDiseno ADD PRIMARY KEY (idRequerimientoDiseno);

INSERT INTO `requerimientoDiseno` (`idRequerimientoDiseno`, `fechaEntrega`,
`semblanzaCompania`, `semblanzaActividad`, `programaMano`) VALUES
(1, '2019-10-05', 'semblanzaCompania1','semblanzaActividad1','programaMano1'),
(7, '2017-11-03', 'semblanzaCompania2','semblanzaActividad2','programaMano2');

CREATE TABLE `requerimientoTecnico`
(
  `idRequerimientoTecnico` int(11) DEFAULT NULL,
  `requerimiento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE requerimientoTecnico ADD PRIMARY KEY (idRequerimientoTecnico);

INSERT INTO `requerimientoTecnico` (`idRequerimientoTecnico`, `requerimiento`) VALUES
(1, 'Este es el requerimientoTecnido para la actividad1'),
(2, 'Este es el requerimientoTecnido para la actividad2');

CREATE TABLE `requerimientoPago`
(
  `idRequerimientoPago` int(11) DEFAULT NULL,
  `requerimiento` varchar(100) DEFAULT NULL,
  `fechaDocumentacion` date DEFAULT NULL,
  `fechaTentativa` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE requerimientoPago ADD PRIMARY KEY (idRequerimientoPago);

INSERT INTO `requerimientoPago` (`idRequerimientoPago`, `requerimiento`,`fechaDocumentacion`,`fechaTentativa`) VALUES
(1, 'Este es el requerimientoPago para la actividad1','2019-07-01','2019-06-06'),
(32, 'Este es el requerimientoPago para la actividad2','2018-06-01','2019-03-06');

CREATE TABLE `Programacion`
(
  `idProgramacion` int(11) DEFAULT NULL,
  `idRequerimientoActividad` int(11) DEFAULT NULL,
  `idRequerimientoDiseno` int(11) DEFAULT NULL,
  `idRequerimientoTecnico` int(11) DEFAULT NULL,
  `idRequerimientoPago` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE Programacion ADD PRIMARY KEY (idProgramacion);
ALTER TABLE Programacion ADD FOREIGN KEY (idRequerimientoActividad) REFERENCES requerimientoActividad(idRequerimientoActividad) ON DELETE CASCADE;
ALTER TABLE Programacion ADD FOREIGN KEY (idRequerimientoDiseno) REFERENCES requerimientoDiseno(idRequerimientoDiseno) ON DELETE CASCADE;
ALTER TABLE Programacion ADD FOREIGN KEY (idRequerimientoTecnico) REFERENCES requerimientoTecnico(idRequerimientoTecnico) ON DELETE CASCADE;
ALTER TABLE Programacion ADD FOREIGN KEY (idRequerimientoPago) REFERENCES requerimientoPago(idRequerimientoPago) ON DELETE CASCADE;

INSERT INTO `Programacion` (`idProgramacion`, `idRequerimientoActividad`,`idRequerimientoDiseno`,
`idRequerimientoTecnico`,`idRequerimientoPago`) VALUES
(1,1,1,1,1),
(4,5,7,2,32);

CREATE TABLE `Actividad`
(
  `idActividad` int(11) DEFAULT NULL,
  `idProgramacion` int(11) DEFAULT NULL,
  `idDiseno` int(11) DEFAULT NULL,
  `idDifusion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE Actividad ADD PRIMARY KEY (idActividad);
ALTER TABLE Actividad ADD FOREIGN KEY (idProgramacion) REFERENCES Programacion(idProgramacion) ON DELETE CASCADE;

INSERT INTO `actividad` (`idActividad`, `idProgramacion`,`idDiseno`,`idDifusion`) VALUES
(1,1,1,1),
(5,4,6,6);