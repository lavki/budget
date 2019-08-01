<?php

/**
 * Class Category_model
 */
class Category_model extends CI_Model
{
    /**
     * Read a single category by Id
     * @param int $id
     * @return mixed
     */
    public function readCategory( int $id )
    {
        $query = $this->db
            ->get_where('category', ['id' => $id], 1);

        return $query->row();
    }

    /**
     * Read all category
     * @return mixed
     */
    public function readCategories()
    {
        $query = $this->db
            ->select("category.id, category.category, status.status")
            ->join('status', 'status.id = category.status_id', 'left')
            ->order_by('category', 'ASC')
            ->get('category');

        return $query->result();
    }

    /**
     * Read all categories by given status
     * @param array $statuses
     * @return mixed
     */
    public function readCategoriesByStatus( array $statuses )
    {
        $query = $this->db
            ->where_in('status_id', $statuses)
            ->order_by('category', 'ASC')
            ->get('category');

        return $query->result();
    }

    /**
     * Create new category
     * @param array $data
     * @return mixed
     */
    public function createCategory( array $data )
    {
        $dataToInsert = [
            'category'  => (string) htmlentities(strip_tags(trim($data['category']))),
            'status_id' => (int) $data['type'],
        ];

        return $this->db->insert('category', $dataToInsert);
    }

    /**
     * Update an existing category by Id
     * @param array $data
     */
    public function updateCategory( array $data )
    {
        $id = (int) $data['id'];
        $dataToUpdate = [
            'category'  => (string) htmlentities(strip_tags(trim($data['category']))),
            'status_id' => (int) $data['type'],
        ];

        return $this->db->update('category', $dataToUpdate, ['id' => $id]);
    }

    /**
     * Delete a category by Id
     * @param int $id
     * @return mixed
     */
    public function deleteCategory( int $id )
    {
        return $this->db->delete('category', ['id' => $id]);
    }
}