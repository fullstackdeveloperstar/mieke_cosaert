<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('category_model');
        $this->load->model('project_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : Dashboard';
        $data["count_category"] = $this->category_model->count_category();
        $data["count_project"] = $this->project_model->count_project();
        $this->loadViews("admin/dashboard", $this->global, $data);
    }

    function categoryListing() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else {
            $searchText = $this->security->xss_clean($this->input->post('searchText')); 
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->category_model->count_category($searchText);
            $returns = $this->paginationCompress ( "categoryListing/", $count, 10 );
            $data['categoryRecords'] = $this->category_model->categoryListing($searchText, $returns["page"], $returns["segment"]);    
            $this->global['pageTitle'] = 'CodeInsect : Category Listing';            
            $this->loadViews("admin/categories", $this->global, $data, NULL);
        }
    }

    function addCategory()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {            
            $this->global['pageTitle'] = 'CodeInsect : Add New Category';

            $this->loadViews("admin/addCategory", $this->global, NULL);
        }
    }

    function addNewCategory()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('cat_id','Cat Id','trim|unique|required|max_length[128]');
            $this->form_validation->set_rules('name','Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('order','Order','trim|required|max_length[128]');
            $this->form_validation->set_rules('pict_url','Picture Url','trim|required|max_length[128]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addCategory();
            }
            else
            {
                $catId = $this->security->xss_clean($this->input->post('cat_id'));
                $name = $this->security->xss_clean($this->input->post('name'));
                $order = $this->security->xss_clean($this->input->post('order'));
                $online = $this->security->xss_clean($this->input->post('online'));
                $pict_url = $this->security->xss_clean($this->input->post('pict_url'));                
                $categoryInfo = array('cat_id'=>$catId, 'cat_name'=>$name, 'cat_order'=>$order, 'online'=>$online, 'picture_url'=>$pict_url);
                $result = $this->category_model->addNewCategory($categoryInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Category created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Category creation failed');
                }
                
                redirect('admin/addCategory');
            }
        }
    }

    function editCategory($id = NULL)
    {
        if($id == null)
        {
            redirect('admin/categoryListing');
        } else {
            $data['catInfo'] = $this->category_model->getCatInfo($id);
            $this->global['pageTitle'] = 'CodeInsect : Edit Category';            
            $this->loadViews("admin/editCategory", $this->global, $data, NULL);
        }
    }

    function updateCategory()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $id = $this->input->post('id');
            
            $this->form_validation->set_rules('catId','Cat Id','trim|required|max_length[128]');
            $this->form_validation->set_rules('name','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('order','Order','trim|required|max_length[128]');
            $this->form_validation->set_rules('pict_url','Picture Url','trim|required|max_length[128]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editCategory($id);
            }
            else
            {
                $catId = $this->security->xss_clean($this->input->post('catId'));
                $name = $this->security->xss_clean($this->input->post('name'));
                $order = $this->security->xss_clean($this->input->post('order'));
                $online = $this->security->xss_clean($this->input->post('online'));
                $pict_url = $this->security->xss_clean($this->input->post('pict_url'));                
                $categoryInfo = array('cat_id'=>$catId, 'cat_name'=>$name, 'cat_order'=>$order, 'online'=>$online, 'picture_url'=>$pict_url);
                $result = $this->category_model->updateCategory($categoryInfo, $id);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Category updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Category update failed');
                }
                
                redirect('admin/categoryListing');
            }
        }
    }

    function deleteCategory()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $id = $this->input->post('id');
            
            $result = $this->category_model->deleteCategory($id);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }

    function projectListing() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else {
            $searchText = $this->security->xss_clean($this->input->post('searchText')); 
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->project_model->count_project($searchText);
            $returns = $this->paginationCompress ( "projectListing/", $count, 10 );
            $data['projectRecords'] = $this->project_model->projectListing($searchText, $returns["page"], $returns["segment"]);
            // $data['picture_url'] = $this->project_model->pictureListing($data['projectRecords']);    
            $this->global['pageTitle'] = 'CodeInsect : Project Listing';            
            $this->loadViews("admin/projects", $this->global, $data, NULL);
        }
    }

    function addProject()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {            
            $this->global['pageTitle'] = 'CodeInsect : Add New Project';
            $data['categories'] = $this->category_model->getCategories();

            $this->loadViews("admin/addProject", $this->global, $data, NULL);
        }
    }

    function addNewProject()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('cat_name','Category','trim|required|max_length[128]');
            $this->form_validation->set_rules('proj_name','Project Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('proj_order','Project Order','trim|required|max_length[128]');
            $this->form_validation->set_rules('pict_id','Picture Url','trim|required|max_length[128]');
            $this->form_validation->set_rules('pict_name','Picture Url','trim|required|max_length[128]');
            $this->form_validation->set_rules('pict_order','Picture Url','trim|required|max_length[128]');
            $this->form_validation->set_rules('pict_url','Picture Url','trim|required|max_length[128]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addProject();
            }
            else
            {
                $cat = $this->security->xss_clean($this->input->post('cat_name'));                
                $cat_id = explode(' ', $cat);
                $cat_id = (int)$cat_id[0];
                $proj_id = (int)$this->security->xss_clean($this->input->post('proj_id'));                
                $proj_name = $this->security->xss_clean($this->input->post('proj_name'));
                $proj_order = (int)$this->security->xss_clean($this->input->post('proj_order'));
                $online = (int)$this->security->xss_clean($this->input->post('online'));
                $pict_id = (int)$this->security->xss_clean($this->input->post('pict_id'));
                $pict_name = $this->security->xss_clean($this->input->post('pict_name'));
                $pict_order = (int)$this->security->xss_clean($this->input->post('pict_order'));
                $pict_online = (int)$this->security->xss_clean($this->input->post('pict_online'));
                $pict_url = $this->security->xss_clean($this->input->post('pict_url'));            
                $projectInfo = array('cat_id'=>$cat_id, 'proj_id'=>$proj_id, 'proj_name'=>$proj_name, 'proj_order'=>$proj_order, 'online'=>$online);
                $pictureInfo = array('cat_id'=>$cat_id, 'proj_id'=>$proj_id, 'pict_id'=>$pict_id, 'pict_name'=>$pict_name, 'pict_order'=>$pict_order, 'online'=>$pict_online, 'picture_url'=>$pict_url);
                $result = $this->project_model->addNewProject($projectInfo, $pictureInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Project created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Project creation failed');
                }
                
                redirect('admin/addProject');
            }
        }
    }

    function editProject($id = NULL)
    {
        if($id == null)
        {
            redirect('admin/projectListing');
        } else {
            $data['proInfo'] = $this->project_model->getProInfo($id);
            $data['categories'] = $this->category_model->getCategories();
            $this->global['pageTitle'] = 'CodeInsect : Edit Project';            
            $this->loadViews("admin/editProject", $this->global, $data, NULL);
        }
    }

    function updateProject()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $id = $this->input->post('id');
            
            $this->form_validation->set_rules('cat_name','Category','trim|required|max_length[128]');
            $this->form_validation->set_rules('proj_name','Project Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('proj_order','Project Order','trim|required|max_length[128]');
            $this->form_validation->set_rules('pict_id','Picture Url','trim|required|max_length[128]');
            $this->form_validation->set_rules('pict_name','Picture Url','trim|required|max_length[128]');
            $this->form_validation->set_rules('pict_order','Picture Url','trim|required|max_length[128]');
            $this->form_validation->set_rules('pict_url','Picture Url','trim|required|max_length[128]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editProject($id);
            }
            else
            {
                $cat = $this->security->xss_clean($this->input->post('cat_name'));                
                $cat_id = explode(' ', $cat);
                $cat_id = (int)$cat_id[0];
                $proj_id = (int)$this->security->xss_clean($this->input->post('proj_id'));                
                $proj_name = $this->security->xss_clean($this->input->post('proj_name'));
                $proj_order = (int)$this->security->xss_clean($this->input->post('proj_order'));
                $online = (int)$this->security->xss_clean($this->input->post('online'));
                $pict_id = (int)$this->security->xss_clean($this->input->post('pict_id'));
                $pict_name = $this->security->xss_clean($this->input->post('pict_name'));
                $pict_order = (int)$this->security->xss_clean($this->input->post('pict_order'));
                $pict_online = (int)$this->security->xss_clean($this->input->post('pict_online'));
                $pict_url = $this->security->xss_clean($this->input->post('pict_url'));            
                $projectInfo = array('cat_id'=>$cat_id, 'proj_id'=>$proj_id, 'proj_name'=>$proj_name, 'proj_order'=>$proj_order, 'online'=>$online);
                $pictureInfo = array('cat_id'=>$cat_id, 'proj_id'=>$proj_id, 'pict_id'=>$pict_id, 'pict_name'=>$pict_name, 'pict_order'=>$pict_order, 'online'=>$pict_online, 'picture_url'=>$pict_url);
                $result = $this->project_model->updateProject($projectInfo, $pictureInfo, $id);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Project updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Project update failed');
                }
                
                redirect('admin/projectListing');
            }
        }
    }




    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                
                $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId, 'name'=> $name,
                                    'mobile'=>$mobile, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $this->load->model('user_model');
                $result = $this->user_model->addNewUser($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New User created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('addNew');
            }
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
        if($this->isAdmin() == TRUE || $userId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('userListing');
            }
            
            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            
            $this->global['pageTitle'] = 'CodeInsect : Edit User';
            
            $this->loadViews("editOld", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                
                $userInfo = array();
                
                if(empty($password))
                {
                    $userInfo = array('email'=>$email, 'roleId'=>$roleId, 'name'=>$name,
                                    'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                else
                {
                    $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId,
                        'name'=>ucwords($name), 'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 
                        'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                
                $result = $this->user_model->editUser($userInfo, $userId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                
                redirect('userListing');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->user_model->deleteUser($userId, $userInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    /**
     * This function used to show login history
     * @param number $userId : This is user id
     */
    function loginHistoy($userId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $userId = ($userId == NULL ? 0 : $userId);

            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');

            $data["userInfo"] = $this->user_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress ( "login-history/".$userId."/", $count, 10, 3);

            $data['userRecords'] = $this->user_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'CodeInsect : User Login History';
            
            $this->loadViews("loginHistory", $this->global, $data, NULL);
        }        
    }

    /**
     * This function is used to show users profile
     */
    function profile($active = "details")
    {
        $data["userInfo"] = $this->user_model->getUserInfoWithRole($this->vendorId);
        $data["active"] = $active;
        
        $this->global['pageTitle'] = $active == "details" ? 'CodeInsect : My Profile' : 'CodeInsect : Change Password';
        $this->loadViews("profile", $this->global, $data, NULL);
    }

    /**
     * This function is used to update the user details
     * @param text $active : This is flag to set the active tab
     */
    function profileUpdate($active = "details")
    {
        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]|callback_emailExists');        
        
        if($this->form_validation->run() == FALSE)
        {
            $this->profile($active);
        }
        else
        {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            
            $userInfo = array('name'=>$name, 'email'=>$email, 'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->user_model->editUser($userInfo, $this->vendorId);
            
            if($result == true)
            {
                $this->session->set_userdata('name', $name);
                $this->session->set_flashdata('success', 'Profile updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Profile updation failed');
            }

            redirect('profile/'.$active);
        }
    }

    /**
     * This function is used to change the password of the user
     * @param text $active : This is flag to set the active tab
     */
    function changePassword($active = "changepass")
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->profile($active);
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password is not correct');
                redirect('profile/'.$active);
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }
                
                redirect('profile/'.$active);
            }
        }
    }

    /**
     * This function is used to check whether email already exist or not
     * @param {string} $email : This is users email
     */
    function emailExists($email)
    {
        $userId = $this->vendorId;
        $return = false;

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ $return = true; }
        else {
            $this->form_validation->set_message('emailExists', 'The {field} already taken');
            $return = false;
        }

        return $return;
    }
}

?>