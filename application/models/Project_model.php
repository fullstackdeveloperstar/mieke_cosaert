<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Project_model extends CI_Model
{
    /**
     * This function is used to get the list of category
     * @return array $result : This is result
     */
    function getProjects($cat_id)
    {
    	if ($cat_id == 'all') {
    		$this->db->select('projects.*, pictures.picture_url as pict_url');
	    	$this->db->from('projects');
	    	$this->db->join('pictures', 'projects.proj_id = pictures.proj_id', 'left');
	    	$this->db->order_by('projects.proj_id', 'ASC');
	    	$query = $this->db->get();

	    	$result = $query->result();	
	    	return $result;
    	} else {
    		$this->db->select('projects.*, pictures.picture_url as pict_url');
	    	$this->db->from('projects');
            $this->db->where('projects.cat_id =', $cat_id);
            $this->db->where('projects.online =', '1');
            // $this->db->where('pictures.pict_order =', 1);
            $this->db->group_by('projects.proj_id');
	    	$this->db->join('pictures', 'projects.proj_id = pictures.proj_id', 'left');
	    	$this->db->order_by('projects.proj_order', 'ASC');
	    	$query = $this->db->get();

	    	$result = $query->result();	
	    	return $result;
    	}
    	
    }

    function getProjectDetail($proj_id) {
    	$this->db->select('projects.*, pictures.picture_url as pict_url');
    	$this->db->from('projects');
    	$this->db->where('projects.proj_id =', $proj_id);
    	$this->db->join('pictures', 'projects.proj_id = pictures.proj_id', 'left');
    	$this->db->order_by('pictures.pict_order', 'ASC');
    	$query = $this->db->get();

    	$result = $query->result();	
    	return $result;
    }

    function count_project($searchText = '', $cat = 'all')
    {
        $this->db->select('*');
        $this->db->from('projects');

        if($cat != 'all') {
            $this->db->where('cat_id', $cat);
        }

        if(!empty($searchText)) {
            $likeCriteria = "(proj_name LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function projectListing($searchText = '', $page, $segment, $cat = 'all')
    {
        $this->db->select('projects.*');
        $this->db->from('projects');
        if(!empty($searchText)) {
            $likeCriteria = "(projects.proj_name LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if($cat != 'all') {
            $this->db->where('projects.cat_id', $cat);
        }
        $this->db->order_by('projects.proj_order', 'ASC');
        $this->db->limit(10, $page);
        $query = $this->db->get();

        $result = $query->result();        
        return $result;
    }

    function addNewProject($projectInfo)
    {
        $this->db->trans_start();
        $this->db->insert('projects', $projectInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();               
        
        return $insert_id;
    }

    function addNewPicture($pictureInfo)
    {
        $this->db->trans_start();
        $this->db->insert('pictures', $pictureInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();               
        
        return $insert_id;
    }

    function getProInfo($proj_id)
    {
        $this->db->select('projects.*, categories.cat_name as cat_name');
        $this->db->from('projects');        
        $this->db->where('projects.proj_id =', $proj_id);
        $this->db->join('categories', 'categories.cat_id=projects.cat_id', 'left');
        $query = $this->db->get();

        return $query->row();
    }

    function getPicInfo($proj_id)
    {
        $this->db->select('pictures.*');
        $this->db->from('pictures');
        $this->db->where('proj_id', $proj_id);
        $query = $this->db->get();

        return $query->result();
    }

    function updateProject($projectInfo, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('projects', $projectInfo);
        
        return TRUE;
    }

    function updatePicture($pictureInfo, $pict_id)
    {
        $this->db->where('pict_id', $pict_id);
        $this->db->update('pictures', $pictureInfo);
        
        return 1;
    }

    function deletePicture($pict_id)
    {
        $this->db->where('pict_id', $pict_id);
        $this->db->delete('pictures');
        
        return 1;
    }

    function deleteProject($id)
    {
        // print_r($id);
        // $this->db->where('id', $id);
        // $this->db->delete('pictures');
        // $this->db->affected_rows();

        $this->db->where('id', $id);
        $this->db->delete('projects');
        
        $this->db->affected_rows();

        return TRUE;
    }
}

?>