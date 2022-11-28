<?php 
class Database
{
	// create private variable anybody can't access another class only this class
	private $dbhost;
	private $dbusername;
	private $dbpassword;
	private $dbname;
	// function is created protected other class inherit but cant change in this function by object

	protected function connect()
	{
		$this->host = 'localhost';
		$this->dbusername= 'root';
		$this->dbpassword = '';
		$this->dbname = 'crudop';
		$conn = new mysqli($this->host,$this->dbusername,$this->dbpassword,$this->dbname);
		return $conn;
	}
}
class query extends Database 
{
	//public function getData() simple function
	public function getData($table,$field='*',$condition_arr='', $order_by_field='', $order_by_type='desc',$limit='')
	{
		//$sql = "select * from users"; static table calling only users
		//$sql = "select * from $table"; //dynamic table  calling
		$sql = "select $field from $table";
		if($condition_arr!='')
		{
			$sql.= " where ";
			$c = count($condition_arr);
			//print_r($condition_arr);
			$i =1;
			foreach ($condition_arr as $key => $val) {
				if($i==$c)
				{
					$sql.= "$key ='$val'";
				}
				else
				{
					$sql.= "$key = '$val' and ";
				}
				$i++;
			}
		}
		
		if($order_by_field !='')
		{
			$sql.= " order by $order_by_field $order_by_type ";
		}
		if($limit !='')
		{
			$sql.= " limit $limit";
		}
		//die($sql); //for watch sql query and die the data
		$result = $this->connect()->query($sql);
		if($result->num_rows>0)
		{
			$arr = array();
			while($row =$result->fetch_assoc())
			{
				$arr[] = $row;
			}
			return $arr;
		}
		else
		{
			return 0;
		}
	}

		public function InsertData($table,$condition_arr)
	{
		//$sql = "select * from users"; static table calling only users
		//$sql = "select * from $table"; //dynamic table  calling
		
		if($condition_arr!='')
		{
			foreach ($condition_arr as $key => $val) 
			{
				$fieldArr[]=$key;
				$vallueArr[]=$val;

			}
				$field = implode(",", $fieldArr);
				$value = implode("','",$vallueArr);
				$value = "'".$value."'";
				
				$sql = "insert into  $table($field) values($value)";
				//die($sql);
				$result = $this->connect()->query($sql);
		}
	}

		public function deleteData($table,$condition_arr)
	{
		//$sql = "select * from users"; static table calling only users
		//$sql = "select * from $table"; //dynamic table  calling

		
		if($condition_arr!='')
		{
			$sql = "delete from  $table where ";
			$c = count($condition_arr);
			//print_r($condition_arr);
			$i =1;
			foreach ($condition_arr as $key => $val) {
				if($i==$c)
				{
					$sql.= "$key ='$val'";
				}
				else
				{
					$sql.= "$key = '$val' and ";
				}
				$i++;
			}
				//echo $sql;// for  query see
				$result = $this->connect()->query($sql); //execute the query
		}
	}
		public function updateData($table,$condition_arr,$where_field,$where_value)
	{
		//$sql = "select * from users"; static table calling only users
		//$sql = "select * from $table"; //dynamic table  calling

		
		if($condition_arr!='')
		{
			$sql = "update $table set ";
			$c = count($condition_arr);
			//print_r($condition_arr);
			$i =1;
			foreach ($condition_arr as $key => $val) {
				if($i==$c)
				{
					$sql.= "$key ='$val'";
				}
				else
				{
					$sql.= "$key = '$val',";
				}
				$i++;
			}
				$sql.= " where $where_field =' $where_value '";
				//echo $sql; //print the query
				$result = $this->connect()->query($sql); //execute the query
		}
	}

	public function get_safe_str($str)
	{
		if($str!='')
		{
			return mysqli_real_escape_string($this->connect(),$str);
		}
	}
		
}
/*
select $field from $table $condition like $like order by $order_by_field $order_by_type limit $limit;
$field->*or name, email
$table->user

insert into tablName(column name...) value('field name....')

delete from tableName where id =id number
*/
?>