<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	public function index()
	{
		$this->db->select('category');
		$this->data['category_products'] = $this->db->get('vg_product')->result_array(); //массив для определения есть ли в категории товары или нет
		$this->data['products']=$this->db->get('vg_product')->result_array();//достаем инфу о продуктах из базы

		$this->data['category']=$this->db->get('vg_category_products')->result_array();//достаем инфу о категориях продуктов из базы
		if(count($_POST)){
			//массив для удаления сессий
			$olddata = array('name'  => '', 'email' => '', 'message' => '', 'error' => '', 'error_name' => '',
			'error_tel' => '', 'error_email' => '', 'error_message' => '', 'error_mes_name' => '', 'error_mes_tel' => '', 'error_mes_email' => '', 'error_mes_message' => '',);
			$this->session->set_userdata($olddata);//обновление(удаление) сессий
			//$this->session->sess_destroy();
			//валидация формы(проверка полей)
			$this->form_validation->set_rules('name', 'Имя пользователя', 'trim|required|max_length[25]|htmlspecialchars',array('required'=>'Пожалуйста заполните данное поле', 'max_length' => 'Длина поля не может превышать 25 символов'));
			$this->form_validation->set_rules('email', 'Электронная почта', 'trim|required|max_length[40]|htmlspecialchars',array('required'=>'Пожалуйста заполните данное поле', 'max_length' => 'Длина поля не может превышать 40 символов'));
			$this->form_validation->set_rules('message', 'Сообщение', 'trim|required|htmlspecialchars',array('required'=>'Пожалуйста заполните данное поле'));
			//достаем данные из формы
			$name = $_POST['name'];
			$email = $_POST['email'];
			$message = $_POST['message'];
			//проверка полей формы
			if ($this->form_validation->run() == FALSE){
				//если в поле есть ошибка, присваиваем ему класс с красным или желтым цветом обводки, и запоминаем ошибку, помещаем все в сессии, чтобы позже вывести на экран
				if(form_error('name')){ $this->session->set_userdata(array('error_name' => 'error', 'error_mes_name' => form_error('name'))); }else{ $this->session->set_userdata('error_name', 'succes'); }
				if(form_error('email')){$this->session->set_userdata(array('error_email' => 'error', 'error_mes_email' => form_error('email'))); }else{ $this->session->set_userdata('error_email', 'succes') ;}
				if(form_error('message')){$this->session->set_userdata(array('error_message' => 'error', 'error_mes_message' => form_error('message'))); }else{ $this->session->set_userdata('error_message', 'succes') ;}
				//формируем массив для сессий
				$newdata = array(
	                   'name'  => $name,
										 'email' => $email,
	                   'message' => $message
	               );
				//записываем в сессию
				$this->session->set_userdata($newdata);
				redirect('#call_back');
			}else{
				//получение данных из формы
				$name = $this->input->post('name');
				$from_email = $this->input->post('email');
				$message = $this->input->post('message');
				//создание заголовка
				$headers = "From: webmaster@volfglass.ru\r\n";
				$headers .= "Reply-To: 12345@gmail.com\r\n";
				$headers .= "Return-Path: webmaster@volfglass.ru\r\n";

				if (mail("12345790@gmail.com", "Сообщения из формы обратной связи с сайта volfglass.ru", "Имя:".$name.".\nПочта:".$from_email.".\nСообщение: ".$message ,$headers)){
					 redirect('#blackout');
				 }else{
					 redirect('#call_back');
			 }
			}
		}else{
			$this->load->view('site/header');
			$this->load->view('site/catalog', $this->data);
			$this->load->view('site/footer');
		}
	}
}
