<?php

	class Usuario{

		public static function validaLogin($user, $key){
		
			$con = Connection::getConn();
			
			$sql = "SELECT * FROM tbusuario WHERE login=:user AND senha=:key";	
			
			$sql = $con->prepare($sql);	
			$sql->bindValue(':user', $user);
			$sql->bindValue(':key', $key);
			$sql->execute();

			$teste = $sql->rowCount();

			if ($teste > 0) {
				
				$dados = $sql->fetchAll(\PDO::FETCH_ASSOC);
	
				$_SESSION["id"] = $dados[0]["id_user"];
				$_SESSION["nome"] = $dados[0]["nome"];
				$_SESSION["cpf"] = $dados[0]["cpf"];
				$_SESSION["usuario"] = $dados[0]["login"];
				$_SESSION["senha"] = $dados[0]["senha"];			
				$_SESSION["tipo"] = $dados[0]["tipo"];

				  	return true;
				}else{
					
					return false;
				}	
		}		

		
		public static function listaUsuario(){
			
			$con = Connection::getConn();

			$sql = "SELECT * FROM tbusuario ORDER BY id_user DESC";
			$sql = $con->prepare($sql);
			$sql->execute();

			$resultado = array();

			while ($row = $sql->fetchObject('Usuario')) {
				$resultado[] = $row;
			}

			if (!$resultado){
				throw new Exception("Não foi encontrado nenhum registro no banco!");
				
			}
			return $resultado;
		}

		public static function selecionaUsuarioPorId($id){

			$con = Connection::getConn();

			$sql = "SELECT * FROM tbusuario WHERE id_user = :id";
			$sql = $con->prepare($sql);	
			$sql->bindValue(':id', $id, PDO::PARAM_INT);
			$sql->execute();

			$resultado = $sql->fetchObject('Usuario');

			if (!$resultado){
				throw new Exception("Não foi encontrado nenhum registro no banco!");
			}

			return $resultado;
		}

		public static function inserir($dadosPost)
		{
			if(empty($dadosPost['nome']) or empty($dadosPost['cpf']) or empty($dadosPost['login']) or empty($dadosPost['senha']) or empty($dadosPost['tipo']))
			{
				throw new Exception("Preencha todos os campos");
				return false;
			}

			$con = Connection::getConn();
			
			$sql = $con->prepare('INSERT INTO tbusuario (nome, cpf, login, senha, tipo) VALUES (:nome, :cpf, :login, :senha, :tipo)');
			$sql->bindValue(':nome', $dadosPost['nome']);
			$sql->bindValue(':cpf', $dadosPost['cpf']);
			$sql->bindValue(':login', $dadosPost['login']);
			$sql->bindValue(':senha', $dadosPost['senha']);
			$sql->bindValue(':tipo', $dadosPost['tipo']);	
			$resultado = $sql->execute();

			if ($resultado == 0) {
				throw new Exception("Falha ao inserir usuario!");
				return false;
			}
			return true;
		}

		public static function atualizar ($params){
			
			$con = Connection::getConn();

			$sql = $con->prepare('UPDATE tbusuario SET nome =:nome, cpf =:cpf, login =:login, senha = :senha, tipo = :tipo WHERE id_user = :id');
			$sql->bindValue(':id', $params['id']);
			$sql->bindValue(':nome', $params['nome']);
			$sql->bindValue(':cpf', $params['cpf']);
			$sql->bindValue(':login', $params['login']);
			$sql->bindValue(':senha', $params['senha']);
			$sql->bindValue(':tipo', $params['tipo']);

			$resultado = $sql->execute();

			if ($resultado == 0) {
				throw new Exception("Falha ao alterar usuario");
				return false;				
			}

			return true;
		}

		public static function deletar($id){
			$con = Connection::getConn();
			
			$sql = $con->prepare('DELETE FROM tbusuario WHERE id_user = :id');
			$sql->bindValue(':id', $id);
			$resultado = $sql->execute();

			if ($resultado == 0) {
				throw new Exception("Falha ao deletar usuario");
				return false;				
			}

			return true;
		}


	}

?>