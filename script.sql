CREATE DATABASE IF NOT EXISTS gestion_residuos;
USE gestion_residuos;

-- 1. SEGURIDAD Y USUARIOS
CREATE TABLE roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE -- Administrador, Coordinador, Operador, Ciudadano, Auditor
);

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    telefono VARCHAR(20),
    id_rol INT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_rol) REFERENCES roles(id_rol)
);

-- 2. GESTIÓN DE RUTAS Y RECOLECCIÓN
CREATE TABLE zonas (
    id_zona INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL, -- Ej: Zona 1, Colonia El Maestro
    densidad_poblacional ENUM('Residencial', 'Comercial', 'Industrial') DEFAULT 'Residencial'
);

CREATE TABLE tipos_residuo (
    id_tipo_residuo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL -- Orgánico, Inorgánico, Mixto
);

CREATE TABLE rutas (
    id_ruta INT AUTO_INCREMENT PRIMARY KEY,
    nombre_identificador VARCHAR(100) NOT NULL,
    id_zona INT,
    lat_inicio DECIMAL(10, 8) NOT NULL,
    lng_inicio DECIMAL(11, 8) NOT NULL,
    lat_fin DECIMAL(10, 8) NOT NULL,
    lng_fin DECIMAL(11, 8) NOT NULL,
    puntos_intermedios JSON, -- Array de coordenadas para el trazado
    distancia_km DECIMAL(10, 2),
    horario_inicio TIME,
    horario_fin TIME,
    id_tipo_residuo INT,
    FOREIGN KEY (id_zona) REFERENCES zonas(id_zona),
    FOREIGN KEY (id_tipo_residuo) REFERENCES tipos_residuo(id_tipo_residuo)
);

CREATE TABLE dias (
    id_dia INT AUTO_INCREMENT PRIMARY KEY,
    nombre_dia VARCHAR(15) NOT NULL UNIQUE -- Lunes, Martes, etc.
);

CREATE TABLE ruta_dias (
    id_ruta INT,
    id_dia INT,
    PRIMARY KEY (id_ruta, id_dia),
    FOREIGN KEY (id_ruta) REFERENCES rutas(id_ruta),
    FOREIGN KEY (id_dia) REFERENCES dias(id_dia)
);

CREATE TABLE camiones (
    id_camion INT AUTO_INCREMENT PRIMARY KEY,
    placa VARCHAR(15) UNIQUE NOT NULL,
    capacidad_toneladas DECIMAL(10, 2) NOT NULL,
    estado ENUM('Operativo', 'Mantenimiento', 'Fuera de servicio') DEFAULT 'Operativo',
    conductor_asignado INT,
    FOREIGN KEY (conductor_asignado) REFERENCES usuarios(id_usuario)
);

CREATE TABLE recolecciones (
    id_recoleccion INT AUTO_INCREMENT PRIMARY KEY,
    id_ruta INT,
    id_camion INT,
    fecha_programada DATE NOT NULL,
    hora_inicio_real DATETIME,
    hora_fin_real DATETIME,
    basura_total_estimada_kg DECIMAL(10, 2),
    basura_recolectada_ton DECIMAL(10, 2),
    estado ENUM('Programada', 'En proceso', 'Completada', 'Incompleta') DEFAULT 'Programada',
    observaciones TEXT,
    FOREIGN KEY (id_ruta) REFERENCES rutas(id_ruta),
    FOREIGN KEY (id_camion) REFERENCES camiones(id_camion)
);

CREATE TABLE puntos_recoleccion (
    id_punto_rec INT AUTO_INCREMENT PRIMARY KEY,
    id_recoleccion INT,
    latitud DECIMAL(10, 8) NOT NULL,
    longitud DECIMAL(11, 8) NOT NULL,
    volumen_estimado_kg DECIMAL(10, 2),
    recolectado BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_recoleccion) REFERENCES recolecciones(id_recoleccion)
);

-- 3. MÓDULO DE PUNTOS VERDES (RECICLAJE)
CREATE TABLE puntos_verdes (
    id_punto_verde INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    direccion TEXT NOT NULL,
    latitud DECIMAL(10, 8) NOT NULL,
    longitud DECIMAL(11, 8) NOT NULL,
    capacidad_total_m3 DECIMAL(10, 2),
    horario_atencion VARCHAR(100),
    encargado_id INT,
    FOREIGN KEY (encargado_id) REFERENCES usuarios(id_usuario)
);

CREATE TABLE tipos_material (
    id_tipo_material INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL -- Papel, Plástico, Vidrio, etc.
);

CREATE TABLE contenedores (
    id_contenedor INT AUTO_INCREMENT PRIMARY KEY,
    id_punto_verde INT,
    id_tipo_material INT,
    capacidad_kg DECIMAL(10,2) NOT NULL,
    cantidad_actual_kg DECIMAL(10,2) DEFAULT 0,
    ultima_limpieza DATETIME,
    FOREIGN KEY (id_punto_verde) REFERENCES puntos_verdes(id_punto_verde),
    FOREIGN KEY (id_tipo_material) REFERENCES tipos_material(id_tipo_material)
);

CREATE TABLE entregas_reciclaje (
    id_entrega INT AUTO_INCREMENT PRIMARY KEY,
    id_punto_verde INT,
    id_usuario INT, -- Ciudadano (opcional)
    id_tipo_material INT,
    cantidad_kg DECIMAL(10, 2) NOT NULL,
    fecha_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_punto_verde) REFERENCES puntos_verdes(id_punto_verde),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_tipo_material) REFERENCES tipos_material(id_tipo_material)
);
CREATE TABLE programacion_vaciado (
    id_programacion INT AUTO_INCREMENT PRIMARY KEY,
    id_contenedor INT,
    id_recolector INT, -- Referencia a un usuario con rol de id 7 (Empleado)
    fecha_programada DATETIME NOT NULL,
    estado ENUM('pendiente', 'completado') DEFAULT 'pendiente',
    fecha_realizacion DATETIME, -- Cuándo se vació realmente
    observaciones TEXT,
    FOREIGN KEY (id_contenedor) REFERENCES contenedores(id_contenedor),
    FOREIGN KEY (id_recolector) REFERENCES usuarios(id_usuario)
);
CREATE TABLE notificaciones_contenedor (
    id_notificacion INT AUTO_INCREMENT PRIMARY KEY,
    id_contenedor INT,
    nivel ENUM('temprana','urgente','lleno'),
    mensaje TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    leida BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_contenedor) REFERENCES contenedores(id_contenedor)
);

-- 4. MÓDULO DE DENUNCIAS
CREATE TABLE estados_denuncia (
    id_estado_denuncia INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL -- Recibida, En revisión, Asignada, etc.
);

CREATE TABLE cuadrillas (
    id_cuadrilla INT AUTO_INCREMENT PRIMARY KEY,
    nombre_equipo VARCHAR(100) NOT NULL,
    numero_integrantes INT,
    disponibilidad BOOLEAN DEFAULT TRUE
);

CREATE TABLE denuncias (
    id_denuncia INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT, -- ciudadano id_usuario 4
    descripcion TEXT NOT NULL,
    latitud DECIMAL(10, 8) NOT NULL,
    longitud DECIMAL(11, 8) NOT NULL,
    foto_url VARCHAR(255),
    tamano ENUM('Pequeño', 'Mediano', 'Grande'),
    id_estado INT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_estado) REFERENCES estados_denuncia(id_estado_denuncia)
);

CREATE TABLE asignaciones_denuncia (
    id_asignacion INT AUTO_INCREMENT PRIMARY KEY,
    id_denuncia INT,
    id_cuadrilla INT,
    fecha_intervencion DATE,
    recursos_estimados TEXT,
    foto_despues_url VARCHAR(255),
    FOREIGN KEY (id_denuncia) REFERENCES denuncias(id_denuncia),
    FOREIGN KEY (id_cuadrilla) REFERENCES cuadrillas(id_cuadrilla)
);

-- INSERCIÓN DE DATOS MAESTROS BÁSICOS
INSERT INTO roles (nombre) VALUES ('Administrador'), ('Coordinador'), ('Operador'), ('Ciudadano'), ('Auditor');
INSERT INTO dias (nombre_dia) VALUES ('Lunes'), ('Martes'), ('Miércoles'), ('Jueves'), ('Viernes'), ('Sábado'), ('Domingo');
INSERT INTO estados_denuncia (nombre) VALUES ('Recibida'), ('En revisión'), ('Asignada'), ('En atención'), ('Atendida'), ('Cerrada');
INSERT INTO tipos_material (nombre) VALUES ('Papel y Cartón'), ('Plástico'), ('Vidrio'), ('Metal'), ('Orgánico'), ('Electrónicos');
INSERT INTO tipos_residuo (nombre) VALUES ('Orgánico'), ('Inorgánico'), ('Mixto');

