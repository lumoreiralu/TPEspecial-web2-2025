<?php
require_once __DIR__ . '/../config/config.php';
class Model
{
    // variable de conexion compartida
    protected static $pdo;

    // variable usada por las instancias
    protected $db;

    public function __construct()
    {
        // si no existe una conexion
        if (!self::$pdo) {
            try {
                // Se conecta al server
                self::$pdo = new PDO(
                    "mysql:host=" . MYSQL_HOST . ";charset=utf8",
                    MYSQL_USER,
                    MYSQL_PASS
                );

                // Si no existe db, inicializa una
                self::$pdo->exec("CREATE DATABASE IF NOT EXISTS `" . MYSQL_DB . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");

                // Se conecta a la nueva db
                self::$pdo = new PDO(
                    "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8mb4",
                    MYSQL_USER,
                    MYSQL_PASS
                );
                $this->deploy();
            } catch (\PDOException $e) {
                die("Error en la conexión o creación de DB: " . $e->getMessage());
            }
        }
        // le asigna a la variable de instancia la conexion existente
        $this->db = self::$pdo;

    }
    // (solucionado) Nota: cada vez que se instancia un controlador se ejecuta una nueva conexion -> revisar mas adelante este comportamiento
    // update: solucionado con la implementacion de static $pdo


    private function deploy()
    {
        $this->db = self::$pdo;

        // Verifica si la base de datos tiene tablas
        $query = $this->db->query("SHOW TABLES");
        $tables = $query->fetchAll();

        // Si ya existen, finalizo 
        if (count($tables) > 0)
            return;

        // Si no hay tablas, las crea
        $this->db->exec(
            "CREATE TABLE IF NOT EXISTS `vendedor` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `nombre` varchar(100) NOT NULL,
                `telefono` varchar(20) NOT NULL,
                `email` varchar(200) NOT NULL,
                `imagen` varchar(50) NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;"
        );
        $this->db->exec(
            "CREATE TABLE IF NOT EXISTS `venta` (
                `id_venta` int(11) NOT NULL AUTO_INCREMENT,
                `producto` varchar(200) NOT NULL,
                `precio` decimal(10,2) NOT NULL,
                `id_vendedor` int(11) NOT NULL,
                `fecha` date NOT NULL,
                PRIMARY KEY (`id_venta`),
                KEY `id_vendedor` (`id_vendedor`),
                CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_vendedor`) REFERENCES `vendedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;"
        );

        $this->db->exec(
            "CREATE TABLE IF NOT EXISTS `usuario` (
                `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
                `user` varchar(300) NOT NULL,
                `password` char(60) NOT NULL,
                `rol` varchar(300) NOT NULL,
                PRIMARY KEY (`id_usuario`),
                KEY `user name` (`user`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;"
        );

        // inserta datos a las tablas
        $this->db->exec(
            "INSERT INTO `vendedor` (`id`, `nombre`, `telefono`, `email`, `imagen`) VALUES
            (1, 'Lucia', 2494001, 'lucia@tienda.com', 'img/default-user-img.jpg'),
            (2, 'Manuel', 2494002, 'manuel@tienda.com', 'img/68f2920fb3b78.png'),
            (3, 'Carlos', 2494678, 'carlos@tienda.com', 'img/default-user-img.jpg'),
            (4, 'Pepito', 1234321, 'pepito@tienda.com', 'img/default-user-img.jpg');"
        );
        $this->db->exec(
            "INSERT INTO `venta` (`id_venta`, `producto`, `precio`, `id_vendedor`, `fecha`) VALUES
            (1, 'Monitor Smart HD Samsung', 310900.00, 1, '2025-10-01'),
            (2, 'Teclado Mecanico Logitech', 3900.00, 2, '2025-10-06'),
            (3, 'Parlante JBL Autotune', 8900.00, 1, '2025-10-02'),
            (4, 'Mouse Inalámbrico Apple', 100900.00, 1, '2025-10-02'),
            (5, 'Impresora Epson Stylus 2000', 189000.00, 2, '2025-08-07'),
            (6, 'Microfono Influencer ', 89000.00, 1, '2025-10-03'),
            (7, 'Luz led para selfie ', 9000.00, 2, '2025-09-12'),
            (8, 'Modem Router Huawei HG8145V5', 84000.06, 3, '2025-09-15'),
            (9, 'Raspberry Pi SBC 8GB', 169000.26, 4, '2025-09-15'),
            (10,'Joystick Playstation 5', 120000.00, 1, '2025-10-15'),
            (11,'Focusrite Scarlett Solo', 299999.99, 1, '2025-10-12');"
        );

        $this->db->exec(
            'INSERT INTO `usuario` (`id_usuario`, `user`, `password`, `rol`) VALUES
                (4, "admin", "$2y$10$4ab1m5wRaAHWYDklGBubxOW3XXEVss4BQjyN2/MQMpy72LiOlwh.6", "administrador"),
                (5, "lucia", "$2y$10$.GU91NnRISEpi02K0FkKEe.r4nGmJ4zRdL9JONimGwe0sbOlUO2IW", "vendedor"),
                (6, "manuel", "$2y$10$wK5d9MPmipOq.C3iWf/Xs.TA0IZabQT4nnJgW9oOi.z2VeouA8/1a", "vendedor");'
        );
    }
}
