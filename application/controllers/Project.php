<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Project extends CI_Controller
{
	/**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();        
        $this->load->model('category_model');
        $this->load->model('project_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $id = $this->uri->segment(2);
        if ($id == null) {
            $id = 'all';            
            $data['categories'] = $this->category_model->getCategories();
            $data['projects'] = $this->project_model->getProjects($id);

            $this->load->view('contents/header_view', $data);
            $this->load->view('Projects', $data);
            $this->load->view('contents/footer_view'); 
        } else {
            $data['categories'] = $this->category_model->getCategories();
            $data['category'] = $this->category_model->getCategory($id);
            $data['projects'] = $this->project_model->getProjects($id);

            // var_dump($data['projects']);

            $this->load->view('contents/header_view', $data);
            $this->load->view('Projects', $data);
            $this->load->view('contents/footer_view');
        }        
    }

    public function project_detail()
    {
        $id = $this->uri->segment(2);
        $data['categories'] = $this->category_model->getCategories();
        $data["project_details"] = $this->project_model->getProjectDetail($id);

        $this->load->view('contents/header_view', $data);
        $this->load->view('ProjectDetail', $data);
        $this->load->view('contents/footer_view');
    }
}



?>