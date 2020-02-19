<?php

class Estoque{


//CRUD PRODUTOS

	public static function listaEstoque(){

		$con = Connection::getConn();

		$sql = "SELECT * FROM tbprodutos ORDER BY id_produto DESC";
		$sql = $con->prepare($sql);
		$sql->execute();

		$resultado = array();

		while ($row = $sql->fetchObject('Estoque')) {
			$resultado[] = $row;
		}

		
		return $resultado;
	}

	public static function selecionaProdutoPorId($id){

			$con = Connection::getConn();

			$sql = "SELECT * FROM tbprodutos WHERE id_produto = :id";
			$sql = $con->prepare($sql);	
			$sql->bindValue(':id', $id, PDO::PARAM_INT);
			$sql->execute();

			$resultado = $sql->fetchObject('Estoque');

			
			return $resultado;
	}

	public static function inserir($dadosPost)
	{
			if(empty($dadosPost['produto']) or empty($dadosPost['fornecedor']) or empty($dadosPost['quantidade']) or empty($dadosPost['valorcusto']) or empty($dadosPost['valorvenda'])){
				throw new Exception("Preencha todos os campos");
				return false;
			}

			$con = Connection::getConn();
			
			$sql = $con->prepare('INSERT INTO tbprodutos (produto, fornecedor,quantidade, valorCusto, valorVenda) VALUES (:produto, :fornecedor, :quantidade, :valorcusto, :valorvenda)');
			$sql->bindValue(':produto', $dadosPost['produto']);
			$sql->bindValue(':fornecedor', $dadosPost['fornecedor']);
			$sql->bindValue(':quantidade', $dadosPost['quantidade']);
			$sql->bindValue(':valorcusto', $dadosPost['valorcusto']);
			$sql->bindValue(':valorvenda', $dadosPost['valorvenda']);
			
			$resultado = $sql->execute();

			if ($resultado == 0) {
				throw new Exception("Falha ao inserir produto!");
				return false;
			}
			return true;
	}

	public static function atualizar ($params){
			
			$con = Connection::getConn();

			$sql = $con->prepare('UPDATE tbprodutos SET produto =:produto, fornecedor =:fornecedor, quantidade =:quantidade, valorCusto = :valorcusto, valorVenda = :valorvenda WHERE id_produto = :id');
			$sql->bindValue(':id', $params['id']);
			$sql->bindValue(':produto', $params['produto']);
			$sql->bindValue(':fornecedor', $params['fornecedor']);
			$sql->bindValue(':quantidade', $params['quantidade']);
			$sql->bindValue(':valorcusto', $params['valorcusto']);
			$sql->bindValue(':valorvenda', $params['valorvenda']);

			$resultado = $sql->execute();

			if ($resultado == 0) {
				throw new Exception("Falha ao alterar produto");
				return false;				
			}

			return true;
	}

	public static function deletar($id){
			$con = Connection::getConn();
			
			$sql = $con->prepare('DELETE FROM tbprodutos WHERE id_produto = :id');
			$sql->bindValue(':id', $id);
			$resultado = $sql->execute();

			if ($resultado == 0) {
				throw new Exception("Falha ao deletar produto");
				return false;				
			}

			return true;
	}

}
?>