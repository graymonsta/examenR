CREATE TABLE carros (
    carro_id INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(50),
    modelo VARCHAR(50),
    anio INT,
    color VARCHAR(30)
);

INSERT INTO carros (marca, modelo, anio, color) VALUES
('Toyota', 'Corolla', 2018, 'Blanco'),
('Toyota', 'Hilux', 2020, 'Gris'),
('Honda', 'Civic', 2019, 'Negro'),
('Honda', 'CR-V', 2021, 'Azul'),
('Nissan', 'Sentra', 2017, 'Rojo'),
('Nissan', 'Frontier', 2022, 'Blanco'),
('Hyundai', 'Elantra', 2018, 'Plata'),
('Hyundai', 'Tucson', 2020, 'Gris'),
('Kia', 'Rio', 2019, 'Rojo'),
('Kia', 'Sportage', 2021, 'Negro'),
('Mazda', 'Mazda 3', 2018, 'Azul'),
('Mazda', 'CX-5', 2020, 'Blanco'),
('Ford', 'Focus', 2017, 'Gris'),
('Ford', 'Ranger', 2022, 'Negro'),
('Chevrolet', 'Aveo', 2016, 'Blanco'),
('Chevrolet', 'Colorado', 2021, 'Rojo'),
('Volkswagen', 'Jetta', 2019, 'Plata'),
('Volkswagen', 'Tiguan', 2020, 'Azul'),
('Suzuki', 'Swift', 2018, 'Amarillo'),
('Mitsubishi', 'L200', 2022, 'Gris');