<?php

/**
 * Class Status_model
 */
class Status_model extends CI_Model
{
    /**
     * Read all statuses
     * @return mixed
     */
    public function readStatuses()
    {
        $query = $this->db
            ->order_by('status', 'ASC')
            ->get('status');

        return $query->result();
    }
}