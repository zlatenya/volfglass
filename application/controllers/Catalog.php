<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog extends CI_Controller {
  function __construct(){
   parent::__construct();
  	$this->load->helper('url');//подгружаем библиотеку url
	}

	public function _remap($segment1 = null){
    if($segment1 != null){
      $products = $this->db->get_where('vg_product',array('page_url' => $segment1))->row_array(); //информация о товаре из базы
      $this->data['img_prod'] = $this->db->get_where('vg_gallery_product', array('id_product'=>$products['id']))->result_array(); //получение картинок товара
      $this->data['prod'] = $products;
      $this->load->view('site/page_product', $this->data);
    }
  }
}
