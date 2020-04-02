
DROP DATABASE IF EXISTS proyecto_tw;
CREATE DATABASE proyecto_tw;
USE proyecto_tw;


CREATE TABLE asignatura(

	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	nombre VARCHAR(50) NOT NULL,
	codigo VARCHAR(50) NOT NULL

);


CREATE TABLE estudiante(
	matricula INTEGER PRIMARY KEY,
	nombre VARCHAR(40) NOT NULL,
	apellido_materno VARCHAR(40),
	apellido_paterno VARCHAR(40)

);

CREATE TABLE usuario(

	id_usuario INTEGER PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(40) NOT NULL,
	nombres VARCHAR (82) NOT NULL,
	apellido_materno VARCHAR(40) NOT NULL,
	apellido_paterno VARCHAR(40) NOT NULL,
	clave VARCHAR(20) NOT NULL,
	tipo INTEGER NOT NULL


);

CREATE TABLE directorio(

	codigo_directorio INTEGER PRIMARY KEY,
	id_asignatura INTEGER NOT NULL,
	ruta VARCHAR(150) NOT NULL
);

CREATE TABLE instancia_asignatura(

	id INTEGER AUTO_INCREMENT PRIMARY KEY,
	id_asignatura INTEGER NOT NULL,
	semestre INTEGER NOT NULL,
	anho INTEGER NOT NULL,
	estado  TINYINT(1) DEFAULT 1,
	id_usuario INTEGER
);

CREATE TABLE evaluacion (

	id_evaluacion INTEGER PRIMARY KEY AUTO_INCREMENT,
	topico VARCHAR(50) NOT NULL,
	fecha DATE,
	descripcion VARCHAR(120) NOT NULL,
	id_ins_asignatura INTEGER NOT NULL

);

CREATE TABLE nota(

	id_nota INTEGER PRIMARY KEY AUTO_INCREMENT,
	observacion VARCHAR(140) NOT NULL,
	valor DECIMAL NOT NULL,
	matricula_estudiante INTEGER NOT NULL,
	id_evaluacion INTEGER NOT NULL

);

CREATE TABLE asignatura_estudiante (

	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	id_estudiante INTEGER NOT NULL,
	id_instancia_asignatura INTEGER NOT NULL
);


ALTER TABLE instancia_asignatura ADD FOREIGN KEY (id_asignatura) REFERENCES asignatura(id);
ALTER TABLE instancia_asignatura ADD FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario);
ALTER TABLE directorio ADD FOREIGN KEY (id_asignatura) REFERENCES asignatura(id);
ALTER TABLE evaluacion ADD FOREIGN KEY (id_ins_asignatura) REFERENCES instancia_asignatura(id);
ALTER TABLE nota ADD FOREIGN KEY (matricula_estudiante) REFERENCES estudiante(matricula);
ALTER TABLE nota ADD FOREIGN KEY (id_evaluacion) REFERENCES  evaluacion(id_evaluacion);
ALTER TABLE asignatura_estudiante ADD FOREIGN KEY (id_estudiante) REFERENCES estudiante(matricula);
ALTER TABLE asignatura_estudiante ADD FOREIGN KEY (id_instancia_asignatura) REFERENCES instancia_asignatura(id);





