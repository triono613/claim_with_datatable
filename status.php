<?php
class Status {

  public function status_code($code)
  {

    /*
    | BEGIN ERROR CODE
    */
    
    $status['100'] = 'Database Error';
    $status['200'] = 'Success';
    $status['201'] = 'Unknown Request';

    /* Error Code untuk Login */
    $status['110'] = 'Invalid Username or Password!';
	

    /* Error Code Untuk Edit */
    $status['310'] = 'Data Tidak ditemukan';
	
    /*
    | END ERROR CODE
    */

    if (isset($status[$code])) {
      return $status[$code];
    } else {
      return 'Undefined Status Code';
    }

  }

}