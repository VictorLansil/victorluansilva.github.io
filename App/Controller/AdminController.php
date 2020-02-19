<?php
/**
 * 
 */
class AdminController{
	
	public function index()	{
		
		$devolucao = Devolucao::listaDevolucao();
		
		$loader = new \Twig\Loader\FilesystemLoader('App/View');
		$twig = new \Twig\Environment($loader);
		$template = $twig->load('dashboard.html');

		$parametros = array();
		$parametros['devolucao'] = $devolucao;
		$parametros['datateste'] = Devolucao::getCountByDateEntries();
		
		$conteudo = $template->render($parametros);
		
		echo $conteudo;	

	}

	function getDuplicates( $array ) {
		return array_unique( array_diff_assoc( $array, array_unique( $array ) ) );
	}
	public function telaDeUsuarios()	{

		$loader = new \Twig\Loader\FilesystemLoader('App/View');
		$twig = new \Twig\Environment($loader);
		$template = $twig->load('usuario.html');

		$usuario = Usuario::listaUsuario();

		$parametros = array();
		$parametros['usuario'] = $usuario;
		
		$conteudo = $template->render($parametros);
		echo $conteudo;	
	}

//CRUD de Produtos

	public function cadastrarProduto(){
		$loader = new \Twig\Loader\FilesystemLoader('App/View');
		$twig = new \Twig\Environment($loader);
		$template = $twig->load('cadProduto.html');
		
		$parametros = array();

		$conteudo = $template->render($parametros);
		
		echo $conteudo;	

	}

	public function inserirProduto(){
		try {
			Estoque::inserir($_POST);
			echo '<script>alert("Produto inserido com sucesso!")</script>';
			echo '<script>location.href="http://localhost/smartstock.com/?pagina=estoque"</script>';
		} catch (Exception $e) {
			echo '<script>alert("'.$e->getMessage().'")</script>';
			echo '<script>location.href="http://localhost/smartstock.com/?pagina=admin&metodo=cadastrarProduto"</script>';
		}
	}

	public function alterarProduto($paramId){
		$loader = new \Twig\Loader\FilesystemLoader('App/View');
		$twig = new \Twig\Environment($loader);
		$template = $twig->load('editProduto.html');
		
		$produto = Estoque::selecionaProdutoPorId($paramId);

		$parametros = array();
		$parametros['id'] = $produto->id_produto;
		$parametros['produto'] = $produto->produto;
		$parametros['fornecedor'] = $produto->fornecedor;
		$parametros['quantidade'] = $produto->quantidade;
		$parametros['valorcusto'] = $produto->valorCusto;
		$parametros['valorvenda'] = $produto->valorVenda;

		$conteudo = $template->render($parametros);
		echo $conteudo;	

	}

	public function atualizarProduto(){

		try {
			
			Estoque::atualizar($_POST);
			echo '<script>alert("Produto alterado com sucesso!")</script>';
			echo '<script>location.href="http://localhost/smartstock.com/?pagina=estoque&metodo=index"</script>';
			
		} catch (Exception $e) {
			echo '<script>alert("'.$e->getMessage().'")</script>';
			echo '<script>location.href="http://localhost/smartstock.com/?pagina=admin&metodo=alterarProduto&id='.$_POST['id'].'"</script>';
		}
	}

	public function deletarProduto($paramId){
		try {
			Estoque::deletar($paramId);
			echo '<script>alert("Produto deletada com sucesso!")</script>';
			echo '<script>location.href="http://localhost/smartstock.com/?pagina=estoque&metodo=index"</script>';
		} catch (Exception $e) {
			echo '<script>alert("'.$e->getMessage().'")</script>';
			echo '<script>location.href="http://localhost/smartstock.com/?pagina=admin&metodo=deletarProduto&id='.$_POST['id'].'"</script>';		
		}

	}


// CRUD de Usuario 


	public function cadastrarUsuario(){
		$loader = new \Twig\Loader\FilesystemLoader('App/View');
		$twig = new \Twig\Environment($loader);
		$template = $twig->load('cadUsuario.html');
		
		$parametros = array();

		$conteudo = $template->render($parametros);
		
		echo $conteudo;	

	}

	public function inserirUsuario(){
		try {
			Usuario::inserir($_POST);
			echo '<script>alert("Usuario inserido com sucesso!")</script>';
			echo '<script>location.href="http://localhost/smartstock.com/?pagina=admin&metodo=telaDeUsuarios"</script>';
		} catch (Exception $e) {
			echo '<script>alert("'.$e->getMessage().'")</script>';
			echo '<script>location.href="http://localhost/smartstock.com/?pagina=admin&metodo=cadastrarUsuario"</script>';
		}
	}

	public function alterarUsuario($paramId){
		$loader = new \Twig\Loader\FilesystemLoader('App/View');
		$twig = new \Twig\Environment($loader);
		$template = $twig->load('editUsuario.html');
		
		$usuario = Usuario::selecionaUsuarioPorId($paramId);

		$parametros = array();
		$parametros['id'] = $usuario->id_user;
		$parametros['nome'] = $usuario->nome;
		$parametros['cpf'] = $usuario->cpf;
		$parametros['login'] = $usuario->login;
		$parametros['senha'] = $usuario->senha;
		$parametros['tipo'] = $usuario->tipo;

		$parametros['moderador'] = $_SESSION["id"];

		$conteudo = $template->render($parametros);
		echo $conteudo;	

	}

	public function atualizarUsuario(){

		try {
			
			Usuario::atualizar($_POST);
			echo '<script>alert("Usuario alterado com sucesso!")</script>';
			echo '<script>location.href="http://localhost/smartstock.com/?pagina=admin&metodo=telaDeUsuarios"</script>';
			
		} catch (Exception $e) {
			echo '<script>alert("'.$e->getMessage().'")</script>';
			echo '<script>location.href="http://localhost/smartstock.com/?pagina=admin&metodo=alterarUsuario&id='.$_POST['id'].'"</script>';
		}
	}

	public function deletarUsuario($paramId){
		try {
			Usuario::deletar($paramId);
			echo '<script>alert("Usuario deletada com sucesso!")</script>';
			echo '<script>location.href="http://localhost/smartstock.com/?pagina=admin&metodo=telaDeUsuarios"</script>';
		} catch (Exception $e) {
			echo '<script>alert("'.$e->getMessage().'")</script>';
			echo '<script>location.href="http://localhost/smartstock.com/?pagina=admin&metodo=deletarUsuario&id='.$_POST['id'].'"</script>';		
		}

	}



}


?>