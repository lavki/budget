<?php

/**
 * Class Currency_model
 */
class Currency_model extends CI_Model
{
    /**
     * Read a single currency by Id
     * @param int $id
     * @return mixed
     */
    public function readCurrency( int $id )
    {
        $query = $this->db
            ->get_where('currency', ['id' => $id], 1);

        return $query->row();
    }

    /**
     * Read all currencies
     * @return mixed
     */
    public function readCurrencies()
    {
        $query = $this->db
            ->order_by('id', 'ASC')
            ->get('currency');

        return $query->result();
    }

    /**
     * Create new currency
     * @param array $data
     * @return mixed
     */
    public function createCurrency( array $data )
    {
        $dataToInsert = [
            'currency' => (string) htmlentities(strip_tags(trim($data['currency']))),
        ];

        return $this->db->insert('currency', $dataToInsert);
    }

    /**
     * Update an existing currency by Id
     * @param array $data
     */
    public function updateCurrency( array $data )
    {
        $id = (int) $data['id'];
        $dataToUpdate = [
            'currency' => (string) htmlentities(strip_tags(trim($data['currency']))),
        ];

        return $this->db->update('currency', $dataToUpdate, ['id' => $id]);
    }

    /**
     * Delete a currency by Id
     * @param int $id
     * @return mixed
     */
    public function deleteCurrency( int $id )
    {
        return $this->db->delete('currency', ['id' => $id]);
    }
}