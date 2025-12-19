CREATE TABLE clientes (
    codigo VARCHAR(10) NOT NULL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(15),
    correo VARCHAR(100),
    estado CHAR(3) DEFAULT 'ACT',
    evaluacion INT CHECK (evaluacion >= 0 AND evaluacion <= 100)
);

INSERT INTO `clientes` (`codigo`, `nombre`, `direccion`, `telefono`, `correo`, `estado`, `evaluacion`) VALUES ('123456', 'Orlando Betancourth', 'En algun lugar de la galaxia', '0000-0000', 'obetancourthunicah@gmail.com', 'ACT', 70);
INSERT INTO `clientes` (`codigo`, `nombre`, `direccion`, `telefono`, `correo`, `estado`, `evaluacion`) VALUES ('123457', 'Mengano Betancourth', 'En algun lugar de la galaxia 2', '0000-0002', 'uncorreo@gmail.com', 'ACT', 90);
INSERT INTO `clientes` (`codigo`, `nombre`, `direccion`, `telefono`, `correo`, `estado`, `evaluacion`) VALUES ('123458', 'Julio del Castillo', 'En algun lugar de la galaxia 3', '0000-0003', 'otrocorreo@gmail.com', 'ACT', 10);
