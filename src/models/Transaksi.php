
<?php

class Transaksi
{

    private $table = 'transactions';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * @param array $data array of filtered data.
     * @return array|null references_id, invoice_id, status | null
     */
    public function getStatus($data = [])
    {
        $this->db->query('SELECT id as references_id, invoice_id, status FROM ' . $this->table . ' WHERE id=:references_id AND merchant_id=:merchant_id');
        foreach ($data as $key => $value) {
            $this->db->bind($key, $value);
        }
        return $this->db->single();
    }

    /**
     * @param array $data array of filtered data.
     * @return number references_id
     */
    public function create($data = [])
    {
        $this->db->query('INSERT INTO ' . $this->table . '(invoice_id, item_name, amount, payment_type, customer_name, merchant_id) VALUES(:invoice_id, :item_name, :amount, :payment_type, :customer_name, :merchant_id)');
        foreach ($data as $key => $value) {
            $this->db->bind($key, $value);
        }

        $this->db->execute();
        $this->db->query("SELECT LAST_INSERT_ID() as id");
        return $this->db->single()['id'];
    }
}
