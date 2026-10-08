<?php

namespace App\Controllers;
use System\Config\Controller;
use App\Libraries\MailSend;

class HomeController extends Controller{
public function __construct() {
 
}

public function index()
{
  
  echo $this->view( 'home');
  
}
}