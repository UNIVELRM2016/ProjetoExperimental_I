<?php
header('Content-Type: text/html; charset=utf-8');

session_start();

//Dados de acesso ao DB
$local = "";
$login = "";
$senha = "";
$banco = "";


//Declaração da Classe Conexao
class Conexao{

	private static $host;
	private static $user;
	private static $pass;
	private static $DB;
	private static $mysqli;
	private static $sql;
	public  static $instance;
	public  static $variavel;

	public function __construct(){
		// Item para ocultar os erros...
		//    MOTIVO: O xampp é bem sentimental em questões de variáveis...
		//    Ele dá erro se não for declarada uma variável ou um campo de
		//    um array mesmo se utilizado em IF para verificar se a mesma é
		//    nula...
		// Se quiser mostrar os erros, é só alterar para 1...
		ini_set('display_errors', '1');
		//Item para definir o fuso horário que estamos...
		date_default_timezone_set("America/Sao_Paulo");
	}

	public function setHost($host){
		self::$host = $host;
	}

	public function setLogin($user){
		self::$user = $user;
	}

	public function setSenha($pass){
		self::$pass = $pass;
	}

	public function setDB($DB){
		self::$DB = $DB;
	}

	public function getInstance(){
		$host = "mysql:host=".self::$host.";dbname=".self::$DB;
		if (!isset(self::$instance)) {
		    self::$instance = new PDO($host, self::$user, self::$pass,
		    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

		    self::$instance->setAttribute(PDO::ATTR_ERRMODE,
		      	PDO::ERRMODE_EXCEPTION);
	    }
	    return self::$instance;
	}

}

// Instanciando a Classe Conexão
$connection = new Conexao();
$connection->setHost($local);
$connection->setLogin($login);
$connection->setSenha($senha);
$connection->setDB($banco);
$conexao = $connection->getInstance();

date_default_timezone_set("America/Sao_Paulo");

?>
