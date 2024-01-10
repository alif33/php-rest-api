<?php
class Video
{
    // dbection
    private $db;
    // Table
    private $db_table = "videos";
    // Columns
    public $id;
    public $name;
    public $description;
    public $code;
    public $categories;
    public $date_publication;
    public $duration;
    public $views_number;
    public $score;
    public $subtitle;
    // public $advise;

    public $result;

    // Db dbection
    public function __construct($db)
    {
        $this->db = $db;
    }

    // GET ALL
    public function getVideos()
    {
        $sqlQuery = " SELECT id, name, description, code, categories, date_publication, duration, views_number, score, subtitle FROM " . $this->db_table . "";
        $this->result = $this->db->query($sqlQuery);
        return $this->result;
    }

    // CREATE
    public function createVideo()
    {
        // Sanitize input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->code = htmlspecialchars(strip_tags($this->code));
        $this->categories = json_encode($this->categories);
        $this->date_publication = htmlspecialchars(strip_tags($this->date_publication));
        $this->duration = intval($this->duration);
        $this->views_number = intval($this->views_number);
        $this->score = intval($this->score);
        $this->subtitle = htmlspecialchars(strip_tags($this->subtitle));
    
        // Build SQL query
        $sqlQuery = "INSERT INTO " . $this->db_table . " SET 
            name = '$this->name',
            description = '$this->description',
            code = '$this->code',
            categories = '$this->categories',
            date_publication = '$this->date_publication',
            duration = $this->duration,
            views_number = $this->views_number,
            score = $this->score,
            subtitle = '$this->subtitle'";
    
        // Execute query
        $this->db->query($sqlQuery);
    
        // Check for success
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }


    // Get SINGLE

    public function getSingleVideo()
    {
        $sqlQuery = " SELECT id, name, description, code, categories, date_publication, duration, views_number, score, subtitle  FROM " . $this->db_table . " WHERE id = " . $this->id;
        $record = $this->db->query($sqlQuery);
        $dataRow = $record->fetch_assoc();
        $this->name = $dataRow['name'];
        $this->description = $dataRow['description'];
        $this->code = $dataRow['code'];
        $this->categories = $dataRow['categories'];
        $this->date_publication = $dataRow['date_publication'];
        $this->duration = $dataRow['duration'];
        $this->views_number = $dataRow['views_number'];
        $this->score = $dataRow['score'];
        $this->subtitle = $dataRow['subtitle'];
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
    function deleteVideo()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = " . $this->id;
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }
}
