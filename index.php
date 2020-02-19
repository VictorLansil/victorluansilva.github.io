<?php
require_once 'App/Core/Core.php';

require_once 'App/Controller/AdminController.php';
require_once 'App/Controller/ErroController.php';
require_once 'App/Controller/EstoqueController.php';
require_once 'App/Controller/LoginController.php';
require_once 'App/Controller/TelaInicialController.php';
require_once 'App/Controller/VendaController.php';

require_once 'App/Model/Devolucao.php';
require_once 'App/Model/Estoque.php';
require_once 'App/Model/Usuario.php';
require_once 'App/Model/Dados.php';

require_once 'App/Lib/Database/Connection.php';
require_once 'vendor/autoload.php';
/*Variavel template criada para receber a estrutura do site*/
$template = file_get_contents('App/Template/estrutura.html');

/*Pegar retorno da função e armazenar em uma variável é utlizado a função 'ob'.
Essa função armazenará toda saída do navegador e o código que estiver entre ob_start e ob_end e amarzenará o valor na variável 'Saída'
*/
ob_start();/*Para encerrar o trecho do código com ob*/
	$core = new Core;
	$core->start($_GET);
	$saida = ob_get_contents(); /*Pega o conteúdo e joga pra saída*/
ob_end_clean(); /*Para encerrar o trecho do código*/
	
/*Substitui um determinado conteúdo da minha pagina template pelo valor da variável $saída*/
$tplpronto = str_replace('{{search}}', $saida, $template);
	echo $tplpronto;
?>