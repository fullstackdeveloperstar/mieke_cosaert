<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Category_model extends CI_Model
{
    /**
     * This function is used to get the list of category
     * @return array $result : This is result
     */
    function getCategories()
    {
        $this->db->select('categories.*');
        $this->db->from('categories');
        $this->db->order_by('categories.cat_id', 'ASC');
        $query = $this->db->get();

        $result = $query->result(); 
        return $result;      
    }

    /**
     * This function is used to get the list of category
     * @param string $id : Category id
     * @return array $result : This is result
     */
    function getCategory($id)
    {
        $this->db->select('cat_name');
        $this->db->from('categories');
        $this->db->where('cat_id =', $id);
        $query = $this->db->get();

        return $query->row();
    }

    function count_category($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('categories');
        if(!empty($searchText)) {
            $likeCriteria = "(cat_name LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function categoryListing($searchText = '', $page, $segment)
    {
        $this->db->select('categories.*');
        $this->db->from('categories');
        if(!empty($searchText)) {
            $likeCriteria = "(cat_name LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('categories.cat_id', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function addNewCategory($categoryInfo)
    {
        $this->db->trans_start();
        $this->db->insert('categories', $categoryInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function getCatInfo($id)
    {
        $this->db->select('categories.*');
        $this->db->from('categories');
        $this->db->where('categories.id =', $id);
        $this->db->order_by('categories.cat_id', 'ASC');
        $query = $this->db->get();

        return $query->row();
    }

    function updateCategory($categoryInfo, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('categories', $categoryInfo);
        
        return TRUE;
    }

    function deleteCategory($cat_id)
    {
        $this->db->where('cat_id', $cat_id);
        $this->db->delete('pictures');
        $this->db->affected_rows();

        $this->db->where('cat_id', $cat_id);
        $this->db->delete('projects');
        $this->db->affected_rows();

        $this->db->where('cat_id', $cat_id);
        $this->db->delete('categories');
        $this->db->affected_rows();
        
        return TRUE;
    }
}

?>