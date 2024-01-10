<?php
class User
{
    // dbection
    private $db;
    // Table
    private $db_table = "users";
    // Columns
    public $id;
    public $name;
    public $user;
    public $verify;
    public $email;
    public $facebook;
    public $instagram;
    public $twitch;
    public $website;
    public $description;

    public $result;

    // Db dbection
    public function __construct($db)
    {
        $this->db = $db;
    }

    // GET ALL
    public function getUsers()
    {
        $sqlQuery = "SELECT id, name, user, verify, email, facebook, instagram, twitch, website, description FROM " . $this->db_table . "";
        $this->result = $this->db->query($sqlQuery);
        return $this->result;
    }

    // CREATE
    public function createUser()
    {
        // Sanitize input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->user = htmlspecialchars(strip_tags($this->user));
        $this->verify = htmlspecialchars(strip_tags($this->verify));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->facebook = htmlspecialchars(strip_tags($this->facebook));
        $this->instagram = htmlspecialchars(strip_tags($this->instagram));
        $this->twitch = htmlspecialchars(strip_tags($this->twitch));
        $this->website = htmlspecialchars(strip_tags($this->website));
        $this->description = htmlspecialchars(strip_tags($this->description));
    
        // Build SQL query
        $sqlQuery = "INSERT INTO " . $this->db_table . " SET 
            name = '$this->name',
            user = '$this->user',
            verify = '$this->verify',
            email = '$this->email',
            facebook = '$this->facebook',
            instagram = '$this->instagram',
            twitch = '$this->twitch',
            website = '$this->website',
            description = '$this->description'";
    
        // Execute query
        $this->db->query($sqlQuery);
    
        // Check for success
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    // SINGLE USER

    public function getSingleUser()
    {
        $sqlQuery = "SELECT id, name, user, verify, email, facebook, instagram, twitch, website, description FROM " . $this->db_table . " WHERE id = " . $this->id;
        $record = $this->db->query($sqlQuery);
        $dataRow = $record->fetch_assoc();
        $this->name = $dataRow['name'];
        $this->user = $dataRow['user'];
        $this->verify = $dataRow['verify'];
        $this->email = $dataRow['email'];
        $this->facebook = $dataRow['facebook'];
        $this->instagram = $dataRow['instagram'];
        $this->twitch = $dataRow['twitch'];
        $this->website = $dataRow['website'];
        $this->description = $dataRow['description'];
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
    function deleteUser()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = " . $this->id;
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }
}
