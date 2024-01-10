<?php
class Short
{
    // dbection
    private $db;
    // Table
    private $db_table = "shorts";
    // Columns
    public $id;
    public $name;
    public $duration; 
    public $views_number; 
    public $date_publication; 
    public $image; 
    
    public $result;

    // Db dbection
    public function __construct($db)
    {
        $this->db = $db;
    }

    // GET ALL
    public function getShorts()
    {
        $sqlQuery = "SELECT id, name, duration, views_number, date_publication, image FROM " . $this->db_table . "";
        $this->result = $this->db->query($sqlQuery);
        return $this->result;
    }

    // CREATE
    public function createShort()
    {
        // Sanitize input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->duration = intval($this->duration);
        $this->views_number = intval($this->views_number);
        $this->date_publication = htmlspecialchars(strip_tags($this->date_publication));
        $this->image = htmlspecialchars(strip_tags($this->image));

        // Build SQL query
        $sqlQuery = "INSERT INTO " . $this->db_table . " SET 
            name = '$this->name',
            duration = $this->duration,
            views_number = $this->views_number,
            date_publication = '$this->date_publication',
            image = '$this->image'";
    
        // Execute query
        $this->db->query($sqlQuery);
    
        // Check for success
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    // SINGLE SHORT
    public function getSingleShort()
    {
        $sqlQuery = "SELECT id, name, duration, views_number, date_publication, image FROM " . $this->db_table . " WHERE id = " . $this->id;
        $record = $this->db->query($sqlQuery);
        $dataRow = $record->fetch_assoc();
        $this->name = $dataRow['name'];
        $this->duration = $dataRow['duration'];
        $this->views_number = $dataRow['views_number'];
        $this->date_publication = $dataRow['date_publication'];
        $this->image = $dataRow['image'];
    }

    // UPDATE
//     public function updateEmployee()
//     {
//         $this->name = htmlspecialchars(strip_tags($this->name));
//         $this->email = htmlspecialchars(strip_tags($this->email));
//         $this->designation = htmlspecialchars(strip_tags($this->designation));
//         $this->created = htmlspecialchars(strip_tags($this->created));
//         $this->id = htmlspecialchars(strip_tags($this->id));

//         $sqlQuery = "UPDATE " . $this->db_table . " SET name = '" . $this->name . "',
// email = '" . $this->email . "',
// designation = '" . $this->designation . "',created = '" . $this->created . "'
// WHERE id = " . $this->id;

//         $this->db->query($sqlQuery);
//         if ($this->db->affected_rows > 0) {
//             return true;
//         }
//         return false;
//     }

    // DELETE
    function deleteShort()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = " . $this->id;
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }
}

