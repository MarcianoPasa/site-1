<?php 
	class ControllerConexaoMySQL {
		
		private const USERNAME = "root";
        private const PASSWORD = "";
        private const HOST = "localhost";
        private const DB = "site-1";

		public function getConnection() {
            $username = self::USERNAME;
            $password = self::PASSWORD;
            $host = self::HOST;
            $db = self::DB;
            
            try {
                $connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                /*
                    para saber mais sobre a função setAttribute visite
                    http://php.net/manual/pt_BR/pdo.setattribute.php
                    e ainda sobre o segundo parametro desta função acesse
                    http://php.net/manual/pt_BR/pdo.error-handling.php
                */
            } 
            catch(PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }

            return $connection;
        }
	}
 ?>
 