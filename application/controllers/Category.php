<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Category extends CI_Controller
{
	/**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
    	$data['categories'] = $this->category_model->getCategories();
        $this->load->view('contents/header_view', $data);
        $this->load->view('Home', $data);
        $this->load->view('contents/footer_view');
    }
}



?>