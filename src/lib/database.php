<?php
include_once '../../config/config.php';
?>

<?php
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db = DB_NAME;

    public $link;
    public $error;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if (!$this->link) {
            $this->error = "Connection fail" . $this->link->connect_error;
            die($this->error);
            return false;
        }
    }

    public function select($query)
    {
        $result = $this->link->query($query);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function insert($query)
    {
        $insert = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($insert) {
            return $insert;
        } else {
            return false;
        }
    }

    public function update($query)
    {
        $update = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($update) {
            return $update;
        } else {
            return false;
        }
    }

    public function delete($query)
    {
        $delete = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($delete) {
            return $delete;
        } else {
            return false;
        }
    }
}
?>