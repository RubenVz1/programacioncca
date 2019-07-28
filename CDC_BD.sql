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
  `nombreCompania` varchar(15) DEFAULT NULL,
  `nombreActividad` varchar(15) DEFAULT NULL,
  `disciplina` varchar(15) DEFAULT NULL,
  `lugar` varchar(15) DEFAULT NULL,
  `horario` time DEFAULT NULL,
  `tipoEntrada` int(11) DEFAULT NULL,
  `costo` int(11) DEFAULT NULL,
  `duracion` time DEFAULT NULL,
  `observacion` varchar(500) DEFAULT NULL,
  PRIMARY KEY (idRequerimientoActividad)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `requerimientoActividad` (`idRequerimientoActividad`, `fechaProgramacion`, `fechaEvento`,
`nombreCompania`, `nombreActividad`, `disciplina`, `lugar`, `horario`, `tipoEntrada`, `duracion`, `observacion`) VALUES
(1, '2019-07-05', '2019-08-05','programacioncca','estreno','informatica','fesAcatlan','03:20:10',3,'02:30:40','Esta observacion es de la actividad estreno'),
(5, '2018-04-03', '2019-09-01','finalizacionProgramacion','cierre','cedetec','fesAcatlanUnam','02:10:15',2,'02:02:02','Esta observacion es de la actividad cierre');

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

INSERT INTO `requerimientoDiseno` (`idRequerimientoDiseno`, `fechaEntrega`,
`semblanzaCompania`, `semblanzaActividad`, `programaMano`) VALUES
(1, '2019-10-05', 'semblanzaCompania1','semblanzaActividad1','programaMano1'),
(7, '2017-11-03', 'semblanzaCompania2','semblanzaActividad2','programaMano2');

CREATE TABLE `requerimientoTecnico`
(
  `idRequerimientoTecnico` int(11) DEFAULT NULL AUTO_INCREMENT,
  `requerimiento` varchar(100) DEFAULT NULL,
  PRIMARY KEY (idRequerimientoTecnico)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `requerimientoTecnico` (`idRequerimientoTecnico`, `requerimiento`) VALUES
(1, 'Este es el requerimientoTecnido para la actividad1'),
(2, 'Este es el requerimientoTecnido para la actividad2');

CREATE TABLE `requerimientoPago`
(
  `idRequerimientoPago` int(11) DEFAULT NULL AUTO_INCREMENT,
  `requerimiento` varchar(100) DEFAULT NULL,
  `fechaDocumentacion` date DEFAULT NULL,
  `fechaTentativa` date DEFAULT NULL,
  PRIMARY KEY (idRequerimientoPago)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `requerimientoPago` (`idRequerimientoPago`, `requerimiento`,`fechaDocumentacion`,`fechaTentativa`) VALUES
(1, 'Este es el requerimientoPago para la actividad1','2019-07-01','2019-06-06'),
(32, 'Este es el requerimientoPago para la actividad2','2018-06-01','2019-03-06');

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

INSERT INTO `Programacion` (`idProgramacion`, `idRequerimientoActividad`,`idRequerimientoDiseno`,
`idRequerimientoTecnico`,`idRequerimientoPago`) VALUES
(1,1,1,1,1),
(4,5,7,2,32);


create TABLE `fase2`
(
  `idfase2` int(11) DEFAULT NULL AUTO_INCREMENT,
  `nombrediseñador` varchar(15) DEFAULT NULL,
  `fechaentra` date DEFAULT NULL,
  `fotos` int(2) DEFAULT NULL,
  `viñeta` int(2) DEFAULT NULL,
  `logos` int(2) DEFAULT NULL,
  `lugar` varchar(15) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `leyenda` varchar(15) DEFAULT NULL,
  `fechasalida` date DEFAULT NULL,
  `cartel` int(2) DEFAULT NULL,
  `web` int(2) DEFAULT NULL,
  `cortesias` int(2) DEFAULT NULL,
  `programa` int(2) DEFAULT NULL,
  `invitacion` int(2) DEFAULT NULL,
  PRIMARY KEY (idfase2)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

create TABLE `cartelycortesias`
(
  `idcartelycortesias` int(11) DEFAULT NULL AUTO_INCREMENT,
  `digital` date DEFAULT NULL,
  `offset` date DEFAULT NULL,
  `serigrafia` date DEFAULT NULL,
  `fuera` date DEFAULT NULL,
  `entregaprograma` date DEFAULT NULL,
  `invitacion` date DEFAULT NULL,
  `volante` date DEFAULT NULL,
  PRIMARY KEY(idcartelycortesias)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

create TABLE `corrector`
(
  `idcorrector` int(11) DEFAULT NULL AUTO_INCREMENT,
  `fechaentra` date DEFAULT NULL,
  `nombrecorrector` varchar(25) DEFAULT NULL,
  `fechasale` date DEFAULT NULL,
  PRIMARY KEY(idcorrector)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `diseno`
(
  `iddiseno` int(11) DEFAULT NULL AUTO_INCREMENT,
  `idfase2` int(11) DEFAULT NULL,
  `idcartelycortesias` int(11) DEFAULT NULL,
  `idcorrector` int(11) DEFAULT NULL,
  PRIMARY KEY (iddiseno),
  FOREIGN KEY (idfase2) REFERENCES fase2(idfase2) ON DELETE CASCADE,
  FOREIGN KEY (idcartelycortesias) REFERENCES cartelycortesias(idcartelycortesias) ON DELETE CASCADE,
  FOREIGN KEY (idcorrector) REFERENCES corrector(idcorrector) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

create TABLE `difusion`
(
  `idfase3` int(11) DEFAULT NULL AUTO_INCREMENT,
  `fechadifusion` date DEFAULT NULL,
  PRIMARY KEY(idfase3)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `Actividad`
(
  `idActividad` int(11) DEFAULT NULL AUTO_INCREMENT,
  `idProgramacion` int(11) DEFAULT NULL,
  `idDiseno` int(11) DEFAULT NULL,
  `idDifusion` int(11) DEFAULT NULL,
  PRIMARY KEY (idActividad),
  FOREIGN KEY (idProgramacion) REFERENCES Programacion(idProgramacion) ON DELETE CASCADE/*,
  FOREIGN KEY (idDiseno) REFERENCES diseno(iddiseno) ON DELETE CASCADE,
  FOREIGN KEY (idDifusion) REFERENCES difusion(idfase3) ON DELETE CASCADE*/
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `actividad` (`idActividad`, `idProgramacion`,`idDiseno`,`idDifusion`) VALUES
(1,1,1,1),
(5,4,6,6);
