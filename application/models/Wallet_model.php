<?php

/**
 * Class Wallet_model
 */
class Wallet_model extends CI_Model
{
    /**
     * Read wallet information in current month and year by default
     * @param int|null $year
     * @param int|null $month
     * @return mixed
     */
    public function readWalletInformation( int $year = null, int $month = null )
    {
        $year  = is_null($year)       ? date('Y' ) : $year;
        $month = is_null($month)      ? date('m' ) : $year;
        $query = $this->db
            ->select("
            status.status,
            category.category,
            type.type,
            currency.currency,
            wallet.sum AS spent,
            DATE_FORMAT(wallet.date, '%Y/%m/%d') AS day,
            DATE_FORMAT(wallet.date, '%H:%i:%s') AS time,
            wallet.status_id,
            wallet.type_id,
            type.category_id")
            ->from('wallet')
            ->join('status',    'status.id   = wallet.status_id', 'left')
            ->join('type',      'type.id     = wallet.type_id',   'left')
            ->join('category',  'category.id = type.category_id', 'left')
            ->join('currency',  'currency.id = wallet.currency_id', 'left')
            ->where("DATE_FORMAT(date, '%Y-%m') = '{$year}-{$month}'")
            ->order_by('wallet.id', 'DESC')
            ->get();

        return $query->result();
    }

    /**
     * Read all avalaible months in current year
     * @param int $year
     * @return mixed
     */
    public function readMonths( int $year = 2019 )
    {
        $query = $this->db
            ->select("DISTINCT DATE_FORMAT(Sdate, '%M') AS month")
            ->from('wallet')
            ->where("YEAR(date) = {$year}")
            ->get();

        return $query->result();
    }

    /**
     * Read info by category
     * @param int $year
     * @param int $month
     */
    public function readSpentByCategory( int $year = 2019, string $month = null )
    {
        $month = is_null($month) ? date('m' ) : $month;

        $query = "
        SELECT status, GROUP_CONCAT(type) AS types, SUM(sum) AS sum, currency
        FROM wallet
        LEFT JOIN type     ON type.id     = wallet.type_id
        LEFT JOIN category ON category.id = type.category_id
        LEFT JOIN status   ON status.id   = category.status_id
        LEFT JOIN currency ON currency.id = wallet.currency_id
        WHERE YEAR(date) = '{$year}' AND MONTH(date) = '{$month}' AND wallet.status_id = 1
        GROUP BY wallet.status_id
        
        UNION 
        
        SELECT status, GROUP_CONCAT(type) AS types, SUM(sum) AS sum, currency
        FROM wallet
        LEFT JOIN type     ON type.id     = wallet.type_id
        LEFT JOIN category ON category.id = type.category_id
        LEFT JOIN status   ON status.id   = category.status_id
        LEFT JOIN currency ON currency.id = wallet.currency_id
        WHERE YEAR(date) = '{$year}' AND MONTH(date) = '{$month}' AND wallet.status_id = 2
        GROUP BY wallet.type_id
        
        UNION
                
        SELECT status, GROUP_CONCAT(type) AS types, SUM(sum) AS sum, currency
        FROM wallet
        LEFT JOIN type     ON type.id     = wallet.type_id
        LEFT JOIN category ON category.id = type.category_id
        LEFT JOIN status   ON status.id   = category.status_id
        LEFT JOIN currency ON currency.id = wallet.currency_id
        WHERE YEAR(date) = '{$year}' AND MONTH(date) = '{$month}' AND wallet.status_id NOT IN (1, 2)
        GROUP BY wallet.type_id
        ";

        return $this->db->query($query)->result();
    }

    /**
     * Read all profits
     * @param int $year
     * @param string|null $month
     * @return mixed
     */
    public function readWalletInfo( int $year = 2019, string $month = null )
    {
        $month = is_null($month) ? null : "AND MONTH(date) = {$month}";

        $query = $this->db
            ->select("
            DATE_FORMAT(date, '%Y/%m') AS date,
            SUM(CASE WHEN status_id = 1 THEN sum ELSE 0 END) AS profit,
            SUM(CASE WHEN status_id NOT IN(1, 2) THEN sum ELSE 0 END) AS spent,
            SUM(CASE WHEN status_id = 2 THEN sum ELSE 0 END) AS saved,
            (SUM(CASE WHEN status_id = 1 THEN sum ELSE 0 END) - SUM(CASE WHEN status_id != 1 THEN sum ELSE 0 END)) AS rest")
            ->from('wallet')
            ->where("YEAR(date) = {$year} {$month}")
            ->group_by("DATE_FORMAT(date, '%Y-%m')")
            ->order_by('date', 'DESC')
            ->get();

        return $query->result();
    }

    /**
     * Read detail information from wallet
     * @param string|null $from
     * @param string|null $to
     * @return mixed
     */
    public function readDetailWalletInfo( string $from = null, string $to = null )
    {
        $from = is_null($from) ? date('Y-m-d', strtotime('first day of this month')) : $from;
        $to   = is_null($to)   ? date('Y-m-d', strtotime('last day of this month'))  : $to;

        $query = $this->db
            ->select('
            category.category,
            wallet.sum,
            wallet.date')
            ->from('wallet')
            ->join('category', 'category.id = wallet.category_id', 'left')
            ->where("date BETWEEN '{$from}' AND '{$to}'")
            ->order_by('date', 'DESC')
            ->get();

        return $query->result();
    }

    /**
     * Put money to the wallet
     * @param array $data
     * @return mixed
     */
    public function addMoney( array $data )
    {
        $status_id = (int) $this->category_model->readCategory( (int) $data['category'])->status_id;

        $dataToInsert = [
            'sum'         => (float) $data['sum'],
            'status_id'   => $status_id,
            'type_id'     => (int)   $data['type'],
            'currency_id' => (int)   $data['currency'],
        ];

        return $this->db->insert('wallet', $dataToInsert);
    }

    /**
     * Get money from the wallet
     * @param array $data
     * @return mixed
     */
    public function addSpent( array $data )
    {
        $status_id = (int) $this->category_model->readCategory( (int) $data['category'])->status_id;

        $dataToInsert = [
            'sum'         => (float) $data['sum'],
            'status_id'   => $status_id,
            'type_id'     => (int)   $data['type'],
            'currency_id' => (int)   $data['currency'],
        ];

        return $this->db->insert('wallet', $dataToInsert);
    }
}