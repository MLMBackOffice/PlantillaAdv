USE yii2advanced;


/************ Update: Tables ***************/

/******************** Rebuild Table: comisiones ************************
Reasons:
Column: id_compra
	Server column is in a foreign key.
	Server Column: id_compra, DT=Integer, L=, COM=, N=false, AN=false, DF=, SC=, SI=true, EN=, ARR=false.
	Design Column: id_compra, DT=Integer, L=, COM=id compra que genera la comision, N=false, AN=false, DF=, SC=, SI=true, EN=, ARR=false.
*****************************************************************************/

/* Rename: comisiones */
ALTER TABLE comisiones RENAME TO comisiones_old;

/* Build Table Structure */
CREATE TABLE comisiones
(
	id_comision INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
	valor DECIMAL(10, 2) NOT NULL,
	id_compra INTEGER 
		COMMENT 'id compra que genera la comision' NOT NULL,
	status VARCHAR(250) 
		COMMENT 'not generated, pendient, confirmed, canceled' NOT NULL,
	id_usuario_comision INTEGER 
		COMMENT 'usuario que recibe la comision' NULL,
	nivel_pagado INTEGER 
		COMMENT 'nivel que pertenece la comision pagada' NULL,
	fecha_comision TIMESTAMP 
		COMMENT 'fecha en que se realiza la comision.' NOT NULL,
	fecha_registro TIMESTAMP 
		COMMENT 'fecba registro de la comision' NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* Repopulate Table Data */
INSERT INTO comisiones
	 (id_comision, valor, id_compra)
SELECT id_comision, valor, id_compra
FROM comisiones_old
ORDER BY id_comision;

/* Remove Temp Table */
DROP TABLE comisiones_old;


/******************** Update Table: paquetes ************************/

ALTER TABLE paquetes ADD duracion INTEGER DEFAULT 1
		COMMENT 'numero de meses que permanece activo el usuario' NULL after nombre;





/************ Add Foreign Keys ***************/

/* Add Foreign Key: fk_comisiones_users */
ALTER TABLE comisiones ADD CONSTRAINT fk_comisiones_users
	FOREIGN KEY (id_usuario_comision) REFERENCES users (id)
	ON UPDATE NO ACTION ON DELETE NO ACTION;

/* Add Foreign Key: fk_compra_comisiones */
ALTER TABLE compra ADD CONSTRAINT fk_compra_comisiones
	FOREIGN KEY (id_compra) REFERENCES comisiones (id_compra)
	ON UPDATE NO ACTION ON DELETE NO ACTION;