<?php

/**
 * Class Type_model
 */
class Type_model extends CI_Model
{
    /**
     * Read a single type by Id
     * @param int $id
     * @return mixed
     */
    public function readType( int $id )
    {
        $query = $this->db
            ->get_where('type', ['id' => $id], 1);

        return $query->row();
    }

    /**
     * Read all types
     * @return mixed
     */
    public function readTypes()
    {
        $query = $this->db
            ->select("type.id, type.type, category.category")
            ->from('type')
            ->join('category', 'category.id = type.category_id')
            ->order_by('type', 'ASC')
            ->get();

        return $query->result();
    }

    /**
     * Read all types by given category
     * @param array $categories
     * @return mixed
     */
    public function readTypesByCategory( int $category )
    {
        $query = $this->db
            ->where('category_id', $category)
            ->order_by('type', 'ASC')
            ->get('type');

        return $query->result();
    }

    /**
     * Create new type
     * @param array $data
     * @return mixed
     */
    public function createType( array $data )
    {
        $dataToInsert = [
            'type'        => (string) htmlentities(strip_tags(trim($data['type']))),
            'category_id' => (int) $data['category'],
        ];

        return $this->db->insert('type', $dataToInsert);
    }

    /**
     * Update an existing type by Id
     * @param array $data
     */
    public function updateType( array $data )
    {
        $id = (int) $data['id'];
        $dataToUpdate = [
            'type'        => (string) htmlentities(strip_tags(trim($data['type']))),
            'category_id' => (int) $data['category'],
        ];

        return $this->db->update('type', $dataToUpdate, ['id' => $id]);
    }

    /**
     * Delete a type by Id
     * @param int $id
     * @return mixed
     */
    public function deleteType( int $id )
    {
        return $this->db->delete('type', ['id' => $id]);
    }
}