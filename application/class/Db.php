<?php

namespace App;



class Db extends \PDO{
	private $login;
	private $password;
	public $connect;

	public function __construct(){
		$this->login = 'root';
		$this->password = '';
		$this->db = 'annonces';
		$this->connection();
	}

	private function connection(){
		try
		{
	         $bdd = new \PDO(
                            'mysql:host=localhost;dbname='.$this->db.';charset=utf8mb4',
                             $this->login,
                             $this->password
             );
			$bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
			$bdd->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
			$this->connect = $bdd;
		}
		catch (\PDOException $e)
		{
			$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
			die($msg);
		}
	}
    //   Fonction d'executer des requettes
	public function q($sql,Array $cond = null){
		$stmt = $this->connect->prepare($sql);
		if($cond){
			foreach ($cond as $v) {
				$stmt->bindParam($v[0],$v[1],$v[2]);
			}
		}
		$stmt->execute();
		return $stmt->fetchAll();
	}


}

   
