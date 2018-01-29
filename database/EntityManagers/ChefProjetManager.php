<?php

require(dirname(__DIR__)."/Entities/ChefProjet.php");

class ChefProjetManager extends EntityManager
{
	// Properties
	

	// Functions

	// Default Builder
	function __construct($con)
	{
		$this->connection = $con;
	}

	// Adding an activity object to the database
	function add(ChefProjet $chefProjet)
	{
		$queryString = "insert into ChefProjet values(NULL, '".$this->connection->real_escape_string($chefProjet->getNom())."','".$this->connection->real_escape_string($chefProjet->getPrenoms())."', '".$this->connection->real_escape_string($chefProjet->getCode())."')";
		$result = $this->connection->query($queryString);
		if (!$result)
		{
			echo "ChefProjet insertion failed!";
		}
	}

	function update(ChefProjet $chefProjet)
	{
		//echo "ok";
		$queryString = "update ChefProjet set nom = '".$this->connection->real_escape_string($chefProjet->getNom())."', prenoms = '".$this->connection->real_escape_string($chefProjet->getPrenoms())."', code = '".$this->connection->real_escape_string($chefProjet->getCode())."' where id = '".$chefProjet->getId()."'";
		$result = $this->connection->query($queryString);
		if (!$result)
		{
			echo "ChefProjet update failed!";
		}
	}

	function delete(ChefProjet $chefProjet)
	{
		$queryString = "delete from ChefProjet where id='".$chefProjet->getId()."'";
		$result = $this->connection->query($queryString);
		if (!$result)
		{
			echo "ChefProjet deletion failed!";
		}
	}

	function getById($id)
	{
		$chefProjet = NULL;

		$queryString = "select id, nom, prenoms, code from ChefProjet where id = '".$id."'";
		$result = $this->connection->query($queryString);

		if (!$result)
			echo "Reading failed!";
		else
		{
			if ($result->num_rows < 1)
				return NULL;
			else
			{
				$i = 0;
				while ($row = $result->fetch_array(MYSQLI_NUM)){

					if ($i == 1)
						break;

					$chefProjet = new ChefProjet($row[0], $row[1], $row[2], $row[3]);
					$i++;
				}
			}
		}
		return $chefProjet;
	}

	function getOneBy($nom, $prenoms){

		$chefProjet = NULL;

		$queryString = "select id, nom, prenoms, code from ChefProjet where nom = '".$nom."' and prenoms = '".$prenoms."'";
		//echo $queryString;
		$result = $this->connection->query($queryString);

		if (!$result)
			echo "Reading failed!";
		else
		{
			if ($result->num_rows < 1)
				return NULL;
			else
			{
				$i = 0;
				while ($row = $result->fetch_array(MYSQLI_NUM)){

					if ($i == 1)
						break;

					$chefProjet = new ChefProjet($row[0], $row[1], $row[2], $row[3]);
					$i++;
				}
			}
		}
		return $chefProjet;
		
	}

	function getAll(){

		$chefsProjet = NULL;

		$queryString = "select id, nom, prenoms, code from ChefProjet";
		$result = $this->connection->query($queryString);

		if (!$result)
			echo "Reading failed!";
		else
		{
			if ($result->num_rows < 1)
				return NULL;
			else
			{
				while ($row = $result->fetch_array(MYSQLI_NUM)){

					$chefsProjet[] = new ChefProjet($row[0], $row[1], $row[2], $row[3]);
				}
			}
		}
		return $chefsProjet;	
	}

	function deleteAll()
	{
		$queryString = "delete from ChefProjet";
		$result = $this->connection->query($queryString);
		if (!$result)
		{
			echo "Error when deleting all project leaders!";
			return false;
		}
		return true;
	}
}