<?php

/**
 *  
 */
class Core {
	
	public function start ($urlGet)	{
		session_start();
		
		if (isset($urlGet['metodo'])) {
			$acao = $urlGet['metodo'];
		} else {
			/*Ação é uma variável que chamará um método específico da classe de um controller*/
			$acao = 'index';
		}	
		/*Funcionamento da Querry string
			Querry string: serve para passar informações via url e capturar informações para o sistema
		*/
		
		
		
		if (isset($urlGet['pagina'])) {

				$controller = ucfirst($urlGet['pagina'].'Controller');					
			
 		}else{	
 				$controller = 'TelaInicialController';
 		}

	 	/*
 		if ($controller == "AdminController") {
			if ($_SESSION['tipo'] == "ADMIN") {
				$controller = 'AdminController';
			}else{
				echo '<script>alert("Você não tem autorização para acessar essa página!")</script>';
				$controller = 'TelaInicialController';
			}
		}
		*/	

	 	if (!class_exists($controller)) {
	 		$controller = 'ErroController';
	 	}
	 	
	 	if(isset($urlGet['id']) && $urlGet['id'] != null){
	 		$id = $urlGet['id'];
	 	} else{
	 		$id = null;
	 	}
	 	/*Chama a home controller e o método. Esta função é interessante porque permite chamar métodos de forma dinâmica.*/
	 	call_user_func_array(array(new $controller, $acao), array('id' => $id));
	 }
}

?>