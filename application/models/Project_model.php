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
	    	$this->db->where('pictures.pict_order =', 1);
	    	$this->db->join('pictures', 'projects.proj_id = pictures.proj_id', 'left');
	    	$this->db->order_by('projects.id', 'ASC');
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

    function count_project($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('projects');
        if(!empty($searchText)) {
            $likeCriteria = "(proj_name LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function projectListing($searchText = '', $page, $segment)
    {
        $this->db->select('projects.*, pictures.pict_id as pict_id, pictures.picture_url as pict_url');
        $this->db->from('projects');
        $this->db->join('pictures', 'projects.cat_id = pictures.cat_id', 'left');
        if(!empty($searchText)) {
            $likeCriteria = "(projects.proj_name LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('projects.proj_id', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();        
        return $result;
    }

    function pictureListing($projIds)
    {
        $query = array();
        foreach ($projIds as $projId) {
            $this->db->select('pictures.picture_url');
            $this->db->from('pictures');
            $this->db->where('pictures.proj_id=', $projId);
            $query = $query.array_push($this->db->get());
        }

        return $query;
    }

    function addNewProject($projectInfo, $pictureInfo)
    {
        $this->db->trans_start();
        $this->db->insert('projects', $projectInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete(); 

        $this->db->trans_start();
        $this->db->insert('pictures', $pictureInfo);
        
        $this->db->trans_complete();               
        
        return $insert_id;
    }

    function getProInfo($id)
    {
        $this->db->select('projects.*, categories.cat_name, pictures.pict_id as pict_id, pictures.pict_name as pict_name, pictures.pict_order as pict_order, pictures.online as pict_online, pictures.picture_url as pict_url');
        $this->db->from('projects');
        $this->db->where('projects.id =', $id);
        $this->db->join('pictures', 'projects.proj_id = pictures.proj_id', 'left');
        $this->db->join('categories', 'projects.cat_id = categories.cat_id', 'left');
        $query = $this->db->get();

        return $query->row();
    }

    function updateProject($projectInfo, $pictureInfo, $catId)
    {
        $this->db->where('cat_id', $catId);
        $this->db->update('categories', $categoryInfo);

        $this->db->where('pict_id', $pictId);
        $this->db->update('pictures', $pictureInfo);
        
        return TRUE;
    }
}

?>