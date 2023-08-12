<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminsi extends CI_Controller {

	public function index(){
		if($this->session->userdata('user')){
			$this->load->view('template/header_v');
			$this->load->view('template/footer_v');
		}else{
			redirect('auth');
		}
	}
	public function catalog($segment_1 = null,$id = 0){
		if($this->session->userdata('user')){
		$this->data['category'] = $this->db->get('vg_category_products')->result_array();//достаем из базы категории каталога товаров
		if($segment_1 == null){
			$this->data['products'] = $this -> db -> get('vg_product')->result_array();
			$this->data['title'] = "Каталог";
			$this->load->view('template/header_v');
			$this->load->view('template/catalog_v', $this->data);
			$this->load->view('template/footer_v');
		}

		if(isset($_GET['del_cat'])){//удаление категории из базы
			$this->db->delete('vg_category_products', array('id'=>intval($_GET['del_cat'])));
			redirect('/adminsi/catalog');
		}

		if(isset($_GET['delete'])){//удаление продукта
			$this->db->delete('vg_product', array('id'=>intval($_GET['delete'])));
			redirect('/adminsi/catalog');
		}

		if(isset($_GET['del_pic'])){ //удаление превью
				$arr_pic =$this->db->get_where('vg_product',array('id'=>intval($_GET['del_pic'])))->row_array();
				//print_r($arr_pic);
				//die();
				unlink('upload/'.$arr_pic['img']);//удаление картинки с сервера
				//удаление картинки из базы
				$this->db->set('img', null);
				$this->db->where('id', intval($_GET['del_pic']));
				$this-> db-> update('vg_product', array());
				redirect('/adminsi/catalog/edit/'.$id);
			}

			if(isset($_GET['del_gal_img'])){//удаление картинки из галереи
					$arr_pic =$this->db->get_where('vg_gallery_product',array('id'=>intval($_GET['del_gal_img'])))->row_array();
					unlink('gl-img/'.$arr_pic['name']);//удаление картинки с сервера
					//удаление картинки из базы
					$this->db->delete('vg_gallery_product', array('id'=>intval($_GET['del_gal_img'])));
					redirect('/adminsi/catalog/edit/'.$id);
				}

		if(isset($_POST['category'])){//добавление новой категории в базу
			$seta=array();
			$seta['category'] = $_POST['name_category'];
			$this->db->insert('vg_category_products', $seta);
		}


		if(isset($_POST['catalog_product'])){//создание карточки продукта
			$seta = array();
			$seta['name'] = htmlspecialchars($_POST['name_product']);
			$seta['category'] = $_POST['category_product'];
			$url_array=$this->db->get_where('vg_product', array('page_url'=> $_POST['page_url']))->row_array();
			if($url_array){
				$this->session->set_flashdata('url','Такой url уже существует, введите другой');
				header('Location:'. $_SERVER['HTTP_REFERER']);
			}else{
				$seta['page_url'] = $_POST['page_url'];
			}
			$seta['full_text'] = $_POST['full_text_product'];
			$seta['price'] = $_POST['price'];
			$check = $this->can_upload($_FILES['img_product']);//проверка картинок
				if($check === true){
        // загружаем изображение на сервер
					$upload_dir = 'upload/';
					$name = "";
					$name = $id.'_img_product_'.$_FILES['img_product']['name'];
					$mov = move_uploaded_file($_FILES['img_product']['tmp_name'],$upload_dir.$name);
					$seta['img'] = $name;
        //echo "<strong>Файл успешно загружен!</strong>";
      	}else{
        // выводим сообщение об ошибке
        	echo "<strong>$check</strong>";
      	}


			if($segment_1 == 'edit' and $id==0){//добавление нового элемента
				$this->db->insert('vg_product', $seta);
				$id = $this->db->insert_id();
			}else{//обновление данных, если редактирование
				$this->db->where('id', $id);
				$this->db->update('vg_product', $seta);
			}

			$seta_gallery=array();

			$target_dir = 'gl-img/';

			if(isset($_FILES['gallery_product']['name'])) {

				$total_files = count($_FILES['gallery_product']['name']);

				for($key = 0; $key < $total_files; $key++) {

					// Проверка существования файла
					if(isset($_FILES['gallery_product']['name'][$key])
														&& $_FILES['gallery_product']['size'][$key] > 0) {

						$original_filename = $id.'_'.$_FILES['gallery_product']['name'][$key];
						$target = $target_dir . basename($original_filename);
						$tmp  = $_FILES['gallery_product']['tmp_name'][$key];
						move_uploaded_file($tmp, $target);
						$seta_gallery['name']=$original_filename;
						$seta_gallery['id_product']=$id;
						$this->db->insert('vg_gallery_product', $seta_gallery);
					}

				}

			}

			redirect('https://volfglass.ru/adminsi/catalog/edit/'.$id);

		}else{

			//вывод вида для создания нового товара
			if($segment_1 == 'edit' and $id == 0){
				$this->data['element']['title'] = "Новый товар";
				$this->load->view('template/header_v');
				$this->load->view('template/product_v', $this->data);
				$this->load->view('template/footer_v');
			}

			//вывод вида для редактированя товара
			if($segment_1 == 'edit' and $id != 0){
				$this->data['element'] = $this->db->get_where('vg_product', array('id'=>$id))->row_array();
				$this->data['img'] = $this->db->get_where('vg_gallery_product', array('id_product'=>$id))->result_array();
				$this->data['element']['title'] = "Редактирование товара";
				$this->load->view('template/header_v');
				$this->load->view('template/product_v', $this->data);
				$this->load->view('template/footer_v');
			}
		}
	}else{
		redirect('auth');
	}
	}
	private function can_upload($file){
		// если имя пустое, значит файл не выбран
			if($file['name'] == '')
			return 'Вы не выбрали файл.';

		/* если размер файла 0, значит его не пропустили настройки
		сервера из-за того, что он слишком большой */
		if($file['size'] == 0)
			return 'Файл слишком большой.';

		// разбиваем имя файла по точке и получаем массив
		$getMime = explode('.', $file['name']);
		// нас интересует последний элемент массива - расширение
		$mime = strtolower(end($getMime));
		// объявим массив допустимых расширений
		$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');

		// если расширение не входит в список допустимых - return
		if(!in_array($mime, $types))
			return 'Недопустимый тип файла.';

		return true;
		}
}
