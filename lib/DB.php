<?php

class DB
{

	public $conn;

	public function __construct()
	{

		$servername = "localhost";
		$username = "root";
		$password = "welcome";
		$dbname = "core_books";

		$this->conn = new mysqli($servername, $username, $password, $dbname);
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}
	}

	public function all()
	{
		$this->conn->set_charset("utf8");
		$result = $this->conn->query("SELECT * FROM {$this->table}");
		$return = [];
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$return[] = $row;
			}
		}

		return $return;
	}

	public function create($data)
	{
		$columns = implode(", ", array_keys($data));
		$values = implode("', '", array_map([$this->conn, 'real_escape_string'], array_values($data)));

		$query = "INSERT INTO {$this->table} ($columns) VALUES ('$values')";

		if ($this->conn->query($query)) {
			return $this->conn->insert_id;
		} else {
			exit($this->conn->error);
		}
	}


	public function find($id)
	{
		$query = "SELECT * FROM {$this->table} WHERE id = ?";
		$stmt = $this->conn->prepare($query);
		if ($stmt === false) {
			return false;
		}

		$stmt->bind_param("i", $id);

		if ($stmt->execute()) {
			$result = $stmt->get_result();
			if ($result->num_rows > 0) {
				return $result->fetch_assoc();
			} else {
				return null;
			}
		} else {
			exit($stmt->error);
		}
	}

	public function update($id, $data)
	{
		$fields = [];
		$values = [];
		foreach ($data as $key => $value) {
			$fields[] = "$key = ?";
			$values[] = $value;
		}
		$values[] = $id;

		$fields_string = implode(", ", $fields);
		$query = "UPDATE {$this->table} SET $fields_string WHERE id = ?";

		$stmt = $this->conn->prepare($query);
		if ($stmt === false) {
			exit($this->conn->error);
		}

		$types = str_repeat('s', count($data)) . 'i';
		$stmt->bind_param($types, ...$values);

		return $stmt->execute();
	}

	public function delete($id)
	{
		$query = "DELETE FROM {$this->table} WHERE id = ?";
		$stmt = $this->conn->prepare($query);
		if ($stmt === false) {
			exit($this->conn->error);
		}

		$stmt->bind_param("i", $id);

		return $stmt->execute();
	}
}
