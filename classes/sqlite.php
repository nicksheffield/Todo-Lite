<?php

/*
	By Nick Sheffield
	nick@nicksheffield.com
*/

class sqlite {

	private $table;
	private $dbname;
	private $db;
	
	private $where_conditions;

	public function __construct($dbname, $table = 'list'){

		# If the database doesn't exist, we want to create it
		if($this->db = new SQLiteDatabase($dbname.'.sqlite', 0666, $err)){
			
			# set the default table
			if($table) $this->table = $table;
			
			# set the default database
			$this->dbname = $dbname;
			
			# Check if $this->table exists as a table in the database
			$q = $this->db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='$table'");
			
			# If not, then we need to create it
			if(!$q->numRows()){
				
				# Query the database to create the table
				$this->db->queryexec(
					"CREATE TABLE $table(
						id INTEGER PRIMARY KEY,
						content TINYTEXT NOT NULL,
						date DATETIME NOT NULL,
						complete VARCHAR(5) DEFAULT 'false'
					)"
				);
				
				$this->title();
			}
		# If there's an error when creating the database, kill the script and display the error
		}else{
			exit(__LINE__.' | '.$err);
		}
	}
	
	
	public function title(){
		
		$q = $this->db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='title'");
		
		if(!$q->numRows()){
			$this->db->queryexec(
				"CREATE TABLE 'title'(
					id INTEGER PRIMARY KEY,
					name TINYTEXT NOT NULL
				)"
			);
			$this->table('title');
			$this->insert(array('name'=>$this->dbname.' todo'));
			$this->table('list');
		}
	}
	
	
	
	
# Send a query exec to the database and return the success as a boolean
	
	public function query($sql){
		return $this->db->queryexec($sql);
	}
	
	
	
	
# Set the table
	
	public function table($table){
		$this->table = $table;
	}
	
	
# Delete a table, only used for debugging

	public function drop($table){
		$this->db->queryexec("DROP TABLE $table");
	}
	
	
	
	
# Get an associative array from the database. Takes one argument, as a comma separated string
# get('id,content,date')
	
	public function get($arr){
		
		# start writing the select query
		$q = "SELECT ";
		
		# go through each value in $arr, and add it to the select query string
		
		if($arr){
			$arr = explode(',',$arr);
			foreach($arr as $key=>$value){
				$q .= $value.',';
			}
		}
		
		# trim the last comma off the string, and add the FROM tablename to the end
		$q = $this->trim($q).' FROM '.$this->table;
		
		$q .= $this->where_conditions;
		$this->where_conditions = '';
		
		# send the query to the database
		return $this->db->arrayQuery($q,SQLITE_ASSOC);
	}
	
	
	
# Set a where clause inside any future get or insert queries. Needs a bit of work

	public function where($property,$value){
		
		if(!$this->where_conditions)  $this->where_conditions = ' WHERE ';
		$this->where_conditions .= "$property='$value'";
		
	}
	
	
	
# Delete a record where the first argument is equal to the second argument
	
	public function del($key,$value){
	
		# write the delete query 
		$query = "DELETE FROM $this->table WHERE $key='$value'";
		
		# sent the delete query
		return $this->db->unbufferedQuery($query);
	}
	
	
	
	
# Insert a record to the database
	
	public function insert($arr){
		
		$q = "INSERT INTO $this->table( ";
		
		foreach($arr as $key=>$value){
			$key = sqlite_escape_string($key);
			$q .= "$key,";
		}
		
		$q = $this->trim($q).') VALUES(';
		
		foreach($arr as $key=>$value){
			$value = sqlite_escape_string($value);
			$q .= "'$value',";
		}
		
		$q = $this->trim($q).')';
		
		$exec = $this->db->queryexec($q);
		
		$this->last_insert = $this->db->lastInsertRowid();
		
		return $exec;
	}
	
	
	
	
# Update a record in the database
	
	public function update($arr){
		
		$q = "UPDATE $this->table SET ";
		
		foreach($arr as $key=>$value){
			$q .= "$key='$value',";
		}
		
		$q = $this->trim($q,1);
		
		$q .= $this->where_conditions;
		$this->where_conditions = '';
		
		$exec = $this->db->queryexec($q);
		
		return $exec;
	}
	
	
	
	
	
# a simple little function used simply for chopping off the last characters of a string.
# useful for removing trailing commas
	private function trim($string,$characters=1){
		return substr($string,0,strlen($string)-$characters);
	}
	
	
	
	
	
}
