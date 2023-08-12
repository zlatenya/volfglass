<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
  function __construct(){
   parent::__construct();
  	$this->load->helper('url');//подгружаем библиотеку url
  	$this->load->model('users_model');// подгружаем модель авторизации
	}
	public function index()
	{
    if($this->session->userdata('user')){
      redirect('adminsi');
    }else{
    $this->load->view('template/login');
  }
}

  //авторищация
  public function login(){
    //получение данных
    $login = md5($_POST['login']);
    $password = md5(md5($_POST['password']));

    $data = $this->users_model->login($login, $password);

    if($data){//проверка на существование данных в бд
      $this->session->set_userdata('user', $data);//добавление данных в сессию
      redirect('adminsi/catalog');
    }else{
      $this->session->set_flashdata('error','логин:'.$login.'<br>пароль:'.$password);
      header('Location:'. $_SERVER['HTTP_REFERER']);

    }
  }
  //выход
  public function logout(){
		$this->session->unset_userdata('user');
    redirect('auth');
	}
 }
