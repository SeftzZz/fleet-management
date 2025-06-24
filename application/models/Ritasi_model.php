<<<<<<< HEAD
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ritasi_model extends CI_Model {

    protected $table = 'ritasi';

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}
=======
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ritasi_model extends CI_Model {

    protected $table = 'ritasi';

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}
>>>>>>> 73efc7e9b82e023a3212b22621cfe8b8eff37ad0
