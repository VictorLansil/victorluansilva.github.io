<?php

/**
 * 
 */
class TelaInicialController
{
	
	public function index()	{
			
				
				$loader = new \Twig\Loader\FilesystemLoader('App/View'); 
				$twig = new \Twig\Environment($loader);			
				$template = $twig->load('telainicial.html');

				$parametros = array();
				
				$parametros['id'] = $_SESSION["id"];
				$parametros['nome'] = $_SESSION["nome"];
				$parametros['tipo'] = $_SESSION["tipo"];

				$conteudo = $template->render($parametros);
				
				echo $conteudo;
			
	}

}


?>