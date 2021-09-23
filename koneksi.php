<?php
ini_set('display_errors', 'On');
require_once('status.php');
class Koneksi extends Status {

	public function conn()
	{
		$conn = new PDO('pgsql:host=localhost;port=5432;dbname=DbWebLife;user=postgres;password=123456');
        return $conn;    

	}
	
	
	public function db_row_count($sql) {
		$conn = $this->conn();
		$stmt = $conn->prepare($sql);
		if (!$stmt->execute()) {
		  $errorInfo = $stmt->errorInfo();
		  if (isset($errorInfo[2])) {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'data'=>array()
			  );
		  } else {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'data'=>array()
			  );
		  }
		} else {
		  $result = $stmt->rowCount();
		  if ($result==false) {
			$result = array();
		  }
		  $ret = array(
			  'success'=>true,
			  'status'=>'202',
			  'data'=>$result
			);
		}
		unset($conn);
		return $ret;
	}
	
 
	public function db_fetch_array_exist($sql) {
		$conn = $this->conn();
		$stmt = $conn->prepare($sql);
		if (!$stmt->execute()) {
		  $errorInfo = $stmt->errorInfo();
		  if (isset($errorInfo[2])) {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'data'=>array()
			  );
		  } else {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'data'=>array()
			  );
		  }
		} else {
		  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		  if ($result==false) {
			$result = array();
		  }
		  $ret = array(
			  'success'=>true,
			  'status'=>'202',
			  'data'=>$result
			);
		}
		unset($conn);
		return $ret;
	}
 
	public function db_fetch_array($sql) {
		$conn = $this->conn();
		$stmt = $conn->prepare($sql);
		if (!$stmt->execute()) {
		  $errorInfo = $stmt->errorInfo();
		  if (isset($errorInfo[2])) {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'data'=>array()
			  );
		  } else {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'data'=>array()
			  );
		  }
		} else {
		  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		  if ($result==false) {
			$result = array();
		  }
		  $ret = array(
			  'success'=>true,
			  'status'=>'200',
			  'data'=>$result
			);
		}
		unset($conn);
		return $ret;
	}

	public function db_fetch_obj_exist($sql) {
		$conn = $this->conn();
		$stmt = $conn->prepare($sql);
		if (!$stmt->execute()) {
		  $errorInfo = $stmt->errorInfo();
		  if (isset($errorInfo[2])) {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'data'=>array(),
				'message'=>$errorInfo[2]
			  );
		  } else {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'data'=>array()
			  );
		  }
		} else {
		  $result = $stmt->fetch(PDO::FETCH_ASSOC);
		  if ($result==false) {
			$result = array();
		  }
		  $ret = array(
			  'success'=>true,
			  'status'=>'202',
			  'data'=>$result
			);
		}
		unset($conn);
		return $ret;
	}
 
	public function db_fetch_obj($sql) {
		$conn = $this->conn();
		$stmt = $conn->prepare($sql);
		if (!$stmt->execute()) {
		  $errorInfo = $stmt->errorInfo();
		  if (isset($errorInfo[2])) {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'data'=>array(),
				'message'=>$errorInfo[2]
			  );
		  } else {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'data'=>array()
			  );
		  }
		} else {
		  $result = $stmt->fetch(PDO::FETCH_ASSOC);
		  if ($result==false) {
			$result = array();
		  }
		  $ret = array(
			  'success'=>true,
			  'status'=>'200',
			  'data'=>$result
			);
		}
		unset($conn);
		return $ret;
	}

	public function insert($sql) {
		$conn = $this->conn();
		$stmt = $conn->prepare($sql);
		
		if (!$stmt->execute()) {
		  $errorInfo = $stmt->errorInfo();
		  if (isset($errorInfo[2])) {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'message'=>$errorInfo[2]
			  );
		  } else {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'message'=>$this->status_code('100')
			  );
		  }
		} else {
		  $ret = array(
			  'success'=>true,
			  'status'=>'200',
			  'message'=>$this->status_code('200')
			);
		}
		unset($conn);
		return $ret;
	}

	public function update($sql) {
		$conn = $this->conn();
		$stmt = $conn->prepare($sql);
		
		if (!$stmt->execute()) {
		  $errorInfo = $stmt->errorInfo();
		  if (isset($errorInfo[2])) {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'message'=>$errorInfo[2]
			  );
		  } else {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'message'=>$this->status_code('100')
			  );
		  }
		} else {
		  $ret = array(
			  'success'=>true,
			  'status'=>'200',
			  'message'=>$this->status_code('200')
			);
		}
		unset($conn);
		return $ret;
	}

	public function undefined()
	{
		$ret = array(
			  'success'=>false,
			  'status'=>'201',
			  'message'=>$this->status_code('201')
		);
		echo json_encode($ret);
	}
 
	public function insert_with_array($table, $data)
	{
		$query='INSERT INTO '.$table.' (';
		foreach($data as $key => $value)
		{
			$query .= $key.','; 
		}
	
		$query = substr($query, 0, -1);
		$query .= ") VALUES ('";
		$urut = 1;
		foreach($data as $key => $value)
		{
			if( $urut<count($data) ){
				$query .= $value."','";
			}else{
				$query .= $value."'";
			}
			$urut++;
		}
		$query = substr($query, 0, -1);
		$query .= "');";
		
		$conn = $this->conn();
		$stmt = $conn->prepare($query);
		if (!$stmt->execute()) {
		  $errorInfo = $stmt->errorInfo();
		  if (isset($errorInfo[2])) {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'data'=>array(),
				'message'=>$errorInfo[2]
			  );
		  } else {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'data'=>array()
			  );
		  }
		} else {
		  $result = $stmt->fetch(PDO::FETCH_ASSOC);
		  if ($result==false) {
			$result = array();
		  }
		  $ret = array(
			  'success'=>true,
			  'status'=>'200',
			  'data'=>$result
			);
		}
		unset($conn);
		return $ret;
	}
	


	public function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	public function getIP($ip = null, $deep_detect = TRUE){
		if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
			$ip = $_SERVER["REMOTE_ADDR"];
			if ($deep_detect) {
				if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
					$ip = $_SERVER['HTTP_CLIENT_IP'];
			}
		} else {
			$ip = $_SERVER["REMOTE_ADDR"];
		}
		return $ip;
	}
	
	public function db_fetch_all_with_array($sql, $array) {
		$conn = $this->conn();
		$stmt = $conn->prepare($sql);
		if (!$stmt->execute($array)) {
		  $errorInfo = $stmt->errorInfo();
		  if (isset($errorInfo[2])) {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'data'=>array()
			  );
		  } else {
			$ret = array(
				'success'=>false,
				'status'=>'100',
				'data'=>array()
			  );
		  }
		} else {
		  $result = $stmt->fetch(PDO::FETCH_ASSOC);
		  if ($result==false) {
			$result = array();
		  }
		  $ret = array(
			  'success'=>true,
			  'status'=>'200',
			  'data'=>$result
			);
		}
		unset($conn);
		return $ret;
	}
        
        

}

       // $cc = new koneksi();
       // echo "conn= "; print_r($cc->conn());

?>