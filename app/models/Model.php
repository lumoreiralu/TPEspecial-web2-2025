<?php
require_once __DIR__ . '/../config/config.php';
class Model
{
    protected $db;

    public function __construct()
    {
        try {
            // Se conecta al server
            $this->db = new PDO(
                "mysql:host=" . MYSQL_HOST . ";charset=utf8",
                MYSQL_USER,
                MYSQL_PASS
            );
            // Si no existe db, inicializa una
            $this->db->exec("CREATE DATABASE IF NOT EXISTS `" . MYSQL_DB . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
            // Se conecta a la nueva db
            $this->db = new PDO(
                "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8mb4",
                MYSQL_USER,
                MYSQL_PASS
            );
            $this->deploy();
        } catch (\PDOException $e) {
            die("Error en la conexión o creación de DB: " . $e->getMessage());
        }
    } 
    // Nota: cada vez que se instancia un controlador se ejecuta una nueva conexion -> revisar mas adelante este comportamiento


    private function deploy()
    {
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
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;",
        );
        $this->db->exec(
            "INSERT INTO `vendedor` (`id`, `nombre`, `telefono`, `email`) VALUES
            (1, 'lucia', '111511', 'lucia@tienda.com'),
            (2, 'manuel', '24941511', 'manuel@tienda.com'),
            (4, 'webadmin', '2494000001', 'web@admin.com');"
        );
        $this->db->exec(
            "INSERT INTO `venta` (`id_venta`, `producto`, `precio`, `id_vendedor`, `fecha`) VALUES
            (1, 'mouse', 1499.99, 1, '2025-09-02'),
            (2, 'teclado con luces', 2999.99, 2, '2025-08-13'),
            (3, 'Notebook', 599999.99, 1, '2025-10-08'),
            (4, 'Monitor', 357499.00, 2, '2025-10-08'),
            (5, 'Webcam', 80000.00, 1, '2025-10-09'),
            (6, 'CPU', 700000.00, 4, '2025-10-11');"
        );
    }
}
