<?php

class Devolucao{

//CRUD DEVOLUÇÃO


	public static function listaDevolucao(){
		
		$con = Connection::getConn();

		$sql = "SELECT * FROM tbdevolucao ORDER BY data";
		$sql = $con->prepare($sql);
		$sql->execute();

		$resultado = array();

		while ($row = $sql->fetchObject('Devolucao')) {
			$resultado[] = $row;
		}
		
		return $resultado;

	}

	public static function selecionaDevolucaoPorId($id){

		$con = Connection::getConn();

		$sql = "SELECT * FROM tbdevolucao WHERE id_pedido = :id";
		$sql = $con->prepare($sql);	
		$sql->bindValue(':id', $id, PDO::PARAM_INT);
		$sql->execute();

		$resultado = $sql->fetchObject('Devolucao');


		return $resultado;
	}

	public static function inserir($dadosPost)
	{
		if(empty($dadosPost['data']) or empty($dadosPost['cliente']) or empty($dadosPost['produto']) or empty($dadosPost['motivo']) or empty($dadosPost['valor']) or empty($dadosPost['fornecedor']) ){
			throw new Exception("Preencha todos os campos");
			return false;
		}

		$con = Connection::getConn();

		$sql = $con->prepare('INSERT INTO tbdevolucao (data, cliente, produto, motivo, valor, fornecedor) VALUES (:data, :cliente, :produto, :motivo, :valor, :fornecedor)');

		$sql->bindValue(':data', $dadosPost['data']);
		$sql->bindValue(':cliente', $dadosPost['cliente']);
		$sql->bindValue(':produto', $dadosPost['produto']);
		$sql->bindValue(':motivo', $dadosPost['motivo']);
		$sql->bindValue(':valor', $dadosPost['valor']);
		$sql->bindValue(':fornecedor', $dadosPost['fornecedor']);

		$resultado = $sql->execute();

		if ($resultado == 0) {
			throw new Exception("Falha ao inserir devolução!");
			return false;
		}

		return true;
	}

	public static function atualizar ($params){

		$con = Connection::getConn();

		$sql = $con->prepare('UPDATE tbdevolucao SET data = :data, cliente = :cliente, produto =:produto, motivo =:motivo, valor =:valor, fornecedor = :fornecedor WHERE id_pedido = :id');

		$sql->bindValue(':id', $params['id']);
		$sql->bindValue(':data', $params['data']);
		$sql->bindValue(':cliente', $params['cliente']);
		$sql->bindValue(':produto', $params['produto']);
		$sql->bindValue(':motivo', $params['motivo']);
		$sql->bindValue(':valor', $params['valor']);
		$sql->bindValue(':fornecedor', $params['fornecedor']);

		$resultado = $sql->execute();

		if ($resultado == 0) {
			throw new Exception("Falha ao alterar devolução");
			return false;				
		}

		return true;
	}

	public static function deletar($id){
		$con = Connection::getConn();

		$sql = $con->prepare('DELETE FROM tbdevolucao WHERE id_pedido = :id');
		$sql->bindValue(':id', $id);
		$resultado = $sql->execute();

		if ($resultado == 0) {
			throw new Exception("Falha ao deletar devolução");
			return false;				
		}

		return true;
	}

	public static function getCountByDateEntries(){
		$con = Connection::getConn();

		$segunda=0; $terca=0; $quarta=0; $quinta=0; $sexta=0;
		$seg=0;$ter=0;$qua=0;$qui=0;$sex=0;

		$dados = self::listaDevolucao();
		$datas = array();
		$totalItens = count($dados);

		for ($i=0; $i < $totalItens; $i++) { 
			$datas[$i] = $dados[$i]->data;
		}
		
		$totalDatas = count($datas);
		$diadasemana = getdate();
		$hoje = new DateTime();

				
		for ($i=0; $i < $totalDatas; $i++) { 

			$diaencontrado = new DateTime($datas[$i]);

			$intervalo = $diaencontrado->diff($hoje);
			switch ($diadasemana['weekday']) {
				case "Monday":
				if ($intervalo->d == 7) {
					$segunda = $diaencontrado;
					$seg++;
				}elseif ($intervalo->d == 6) {
					$terca = $diaencontrado;
					$ter++;
				}
				elseif ($intervalo->d == 5) {
					$quarta = $diaencontrado;
					$qua++;
				}
				elseif ($intervalo->d == 4) {
					$quinta = $diaencontrado;
					$qui++;
				}
				elseif ($intervalo->d == 3) {
					$sexta = $diaencontrado;
					$sex++;
				}
				break;
				case "Tuesday":
				if ($intervalo->d == 8) {
					$segunda = $diaencontrado;
					$seg++;
				}elseif ($intervalo->d == 7) {
					$terca = $diaencontrado;
					$ter++;
				}
				elseif ($intervalo->d == 6) {
					$quarta = $diaencontrado;
					$qua++;
				}
				elseif ($intervalo->d == 5) {
					$quinta = $diaencontrado;
					$qui++;
				}
				elseif ($intervalo->d == 4) {
					$sexta = $diaencontrado;
					$sex++;
				}
				break;
				case "Wednesday":
				if ($intervalo->d == 9) {
					$segunda = $diaencontrado;
					$seg++;
				}elseif ($intervalo->d == 8) {
					$terca = $diaencontrado;
					$ter++;
				}
				elseif ($intervalo->d == 7) {
					$quarta = $diaencontrado;
					$qua++;
				}
				elseif ($intervalo->d == 6) {
					$quinta = $diaencontrado;
					$qui++;
				}
				elseif ($intervalo->d == 5) {
					$sexta = $diaencontrado;
					$sex++;
				}
				break;
				case "Thursday":
				if ($intervalo->d == 10) {
					$segunda = $diaencontrado;
					$seg++;
				}elseif ($intervalo->d == 9) {
					$terca = $diaencontrado;
					$ter++;
				}
				elseif ($intervalo->d == 8) {
					$quarta = $diaencontrado;
					$qua++;
				}
				elseif ($intervalo->d == 7) {
					$quinta = $diaencontrado;
					$qui++;
				}
				elseif ($intervalo->d == 6) {
					$sexta = $diaencontrado;
					$sex++;
				}
				break;
				case "Friday":
				if ($intervalo->d == 11) {
					$segunda = $diaencontrado;
					$seg++;
				}elseif ($intervalo->d == 10) {
					$terca = $diaencontrado;
					$ter++;
				}
				elseif ($intervalo->d == 9) {
					$quarta = $diaencontrado;
					$qua++;
				}
				elseif ($intervalo->d == 8) {
					$quinta = $diaencontrado;
					$qui++;
				}
				elseif ($intervalo->d == 7) {
					$sexta = $diaencontrado;
					$sex++;
				}
				break;
				case "Saturday":
				if ($intervalo->d == 12) {
					$segunda = $diaencontrado;
					$seg++;
				}elseif ($intervalo->d == 11) {
					$terca = $diaencontrado;
					$ter++;
				}
				elseif ($intervalo->d == 10) {
					$quarta = $diaencontrado;
					$qua++;
				}
				elseif ($intervalo->d == 9) {
					$quinta = $diaencontrado;
					$qui++;
				}
				elseif ($intervalo->d == 8) {
					$sexta = $diaencontrado;
					$sex++;
				}
				break;
				case "Sunday":
				if ($intervalo->d == 13) {
					$segunda = $diaencontrado;
					$seg++;
				}elseif ($intervalo->d == 12) {
					$terca = $diaencontrado;
					$ter++;
				}
				elseif ($intervalo->d == 11) {
					$quarta = $diaencontrado;
					$qua++;
				}
				elseif ($intervalo->d == 10) {
					$quinta = $diaencontrado;
					$qui++;
				}
				elseif ($intervalo->d == 9) {
					$sexta = $diaencontrado;
					$sex++;
				}
				break;	
				default:
				break;
			}		  

		}

		$sum = $seg+$ter+$qua+$qui+$sex;


		$firsearch = "SELECT SUM(valor) as totalvalor FROM tbdevolucao;";
		$firsearch = $con->prepare($firsearch);	
		$firsearch->execute();
		$ttvalor = array();
		$ttvalor = $firsearch->fetchAll(\PDO::FETCH_ASSOC);
		//Defeito
		$searchdefeito = "SELECT SUM(valor) as valoresdefeito, COUNT(motivo) as totaldefeito FROM tbdevolucao WHERE motivo ='defeito';";
		$searchdefeito = $con->prepare($searchdefeito);	
		$searchdefeito->execute();
		$mtvdefeito = array();
		$mtvdefeito = $searchdefeito->fetchAll(\PDO::FETCH_ASSOC);
		//Insatisfeito
		$searchinsat = "SELECT SUM(valor) as valoresinsat, COUNT(motivo) as totalinsat FROM tbdevolucao WHERE motivo ='insatisfeito';";
		$searchinsat = $con->prepare($searchinsat);	
		$searchinsat->execute();
		$mtvinsat = array();
		$mtvinsat = $searchinsat->fetchAll(\PDO::FETCH_ASSOC);
		//Troca
		$searchtroca = "SELECT SUM(valor) as valorestroca, COUNT(motivo) as totaltroca FROM tbdevolucao WHERE motivo ='troca';";
		$searchtroca = $con->prepare($searchtroca);	
		$searchtroca->execute();
		$mtvtroca = array();
		$mtvtroca = $searchtroca->fetchAll(\PDO::FETCH_ASSOC);

		$resultado = [
		    "seg" => $seg,
		    "ter" => $ter,
		    "qua" => $qua,
		    "qui" => $qui,
		    "sex" => $sex,
		    "entradatotal" => $sum,
		    "valortotal" => $ttvalor[0]["totalvalor"],
		    "totaldefeito" => $mtvdefeito[0]["totaldefeito"],
		    "valoresdefeito" => $mtvdefeito[0]["valoresdefeito"],
		    "totalinsat" => $mtvinsat[0]["totalinsat"],
		    "valoresinsat" => $mtvinsat[0]["valoresinsat"],
		    "totaltroca" => $mtvtroca[0]["totaltroca"],
		    "totaltroca" => $mtvtroca[0]["totaltroca"],
		];	

		return $resultado;		
	}

}
?>