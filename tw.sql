
DROP DATABASE IF EXISTS proyecto_tw;
CREATE DATABASE proyecto_tw;
USE proyecto_tw;


CREATE TABLE asignatura(

codigo INTEGER PRIMARY KEY,
nombre VARCHAR(50)

);


CREATE TABLE instancia_asignatura(

codigo_asignatura INTEGER NOT NULL,
fecha_creacion DATE NOT NULL



);



CREATE TABLE estudiante(

matricula INTEGER PRIMARY KEY,
nombre VARCHAR(40) NOT NULL,
apellido_materno VARCHAR(40),
apellido_paterno VARCHAR(40),
codigo_asignatura INTEGER NOT NULL


);

CREATE TABLE usuario(

id_usuario INTEGER PRIMARY KEY,
email VARCHAR(40) NOT NULL,
nombres VARCHAR (82) NOT NULL,
apellido_materno VARCHAR(40) NOT NULL,
apellido_paterno VARCHAR(40) NOT NULL,
clave VARCHAR(20) NOT NULL,
tipo INTEGER NOT NULL


);


CREATE TABLE asignatura_usuario(

	id_usuario INTEGER NOT NULL,
	codigo_asignatura INTEGER NOT NULL

);


CREATE TABLE directorio(

codigo_directorio INTEGER PRIMARY KEY,
codigo_asignatura INTEGER NOT NULL,
ruta VARCHAR(150) NOT NULL



);

CREATE TABLE evaluacion (

codigo_evaluacion INTEGER PRIMARY KEY,
topixo VARCHAR(50) NOT NULL,
codigo_asignatura INTEGER NOT NULL,
codigo_nota INTEGER NOT NULL


);

CREATE TABLE nota(

codigo_nota INTEGER PRIMARY KEY,
observacion VARCHAR(140) NOT NULL,
valor DECIMAL NOT NULL,
matricula_estudiante INTEGER NOT NULL


);


CREATE TABLE reunion (

codigo INTEGER PRIMARY KEY,
objetivo VARCHAR(100) NOT NULL,
numero_asistentes INTEGER NOT NULL,
id_usuario INTEGER NOT NuLL


);


CREATE TABLE estudiante_reunion(

matricula_estudiante INTEGER NOT NULL,
codigo_reunion INTEGER NOT NULL


);


ALTER TABLE instancia_asignatura ADD FOREIGN KEY (codigo_asignatura) REFERENCES asignatura(codigo);
ALTER TABLE estudiante ADD FOREIGN KEY (codigo_asignatura) REFERENCES asignatura(codigo);
ALTER TABLE asignatura_usuario ADD FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario);
ALTER TABLE asignatura_usuario ADD FOREIGN KEY (codigo_asignatura) REFERENCES asignatura(codigo);
ALTER TABLE directorio ADD FOREIGN KEY (codigo_asignatura) REFERENCES asignatura(codigo);
ALTER TABLE evaluacion ADD FOREIGN KEY (codigo_asignatura) REFERENCES asignatura(codigo);
ALTER TABLE evaluacion ADD FOREIGN KEY (codigo_nota) REFERENCES nota(codigo_nota);
ALTER TABLE nota ADD FOREIGN KEY (matricula_estudiante) REFERENCES estudiante(matricula);
ALTER TABLE reunion ADD FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario);
ALTER TABLE estudiante_reunion ADD FOREIGN KEY (matricula_estudiante) REFERENCES estudiante(matricula);
ALTER TABLE estudiante_reunion ADD FOREIGN KEY (codigo_reunion) REFERENCES reunion(codigo);





