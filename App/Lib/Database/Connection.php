<?php
/*
Essa classe Connection é criada com base no padrão Singleton e ten com o objetivo evitar com que outros objetos PDO* sejam criados, isto é, pra não permitir com que várias instâncias de conexão sejam criadas várias vezes. Desta forma menos objetos são criados e consequentemente, menos memória é utilziada.

PDO-> é uma classe desenvolvida especificamente para trabalhar com procedimentos relacionados a Banco de Dados. 

*/
	abstract class Connection
	{
		private static $conn;

		public static function getConn()
		{
			if (self::$conn == null) {
			self::$conn = new PDO('mysql: host=localhost; dbname=victordata;', 'root', '');
			} 
			return self::$conn;
		}
	}

?>