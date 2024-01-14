<?php
class Comment
{
    // dbection
    private $db;
    // Table
    private $db_table = "comments";
    // Columns
    public $id;
    public $video_id;
    public $user_id; 
    public $comment_text; 
    public $comment_date; 

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
    public function createComment()
    {
        // Sanitize input
        $this->video_id = intval($this->video_id);
        $this->user_id = intval($this->user_id);
        $this->comment_text = htmlspecialchars(strip_tags($this->comment_text));
    
        // Build SQL query
        $sqlQuery = "INSERT INTO " . $this->db_table . " SET 
            video_id = $this->video_id,
            user_id = $this->user_id,
            comment_text = '$this->comment_text'";
        
        // Execute query
        $this->db->query($sqlQuery);
        
        // Check for success
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    // Video comments

    public function getVideoComments()
    {
        $sqlQuery = "
            SELECT
                comments.id,
                comments.comment_text,
                comments.comment_date,
                users.id AS user_id,
                users.name AS name,
                users.user AS username,
                users.email AS email,
                users.facebook AS facebook,
                users.instagram AS instagram,
                users.twitch AS twitch,
                users.website AS website,
                users.description AS description
            FROM
                comments
            JOIN
                users ON comments.user_id = users.id
            WHERE
                comments.video_id = " . $this->id;

        $result = $this->db->query($sqlQuery);

        $comments = [];

        while ($dataRow = $result->fetch_assoc()) {
            $comment = [
                'id' => $dataRow['id'],
                'comment_text' => $dataRow['comment_text'],
                'comment_date' => $dataRow['comment_date'],
                'user_id' => $dataRow['user_id'],
                'user' => [
                    'name' => $dataRow['name'],
                    'username' => $dataRow['username'],
                    'email' => $dataRow['email'],
                    'facebook' => $dataRow['facebook'],
                    'instagram' => $dataRow['instagram'],
                    'twitch' => $dataRow['twitch'],
                    'website' => $dataRow['website'],
                    'description' => $dataRow['description']
                ]
            ];

            $comments[] = $comment;
        }

        return $comments;
    }



    // SINGLE SHORT
    // public function getSingleShort()
    // {
    //     $sqlQuery = "SELECT id, name, duration, views_number, date_publication, image FROM " . $this->db_table . " WHERE id = " . $this->id;
    //     $record = $this->db->query($sqlQuery);
    //     $dataRow = $record->fetch_assoc();
    //     $this->name = $dataRow['name'];
    //     $this->duration = $dataRow['duration'];
    //     $this->views_number = $dataRow['views_number'];
    //     $this->date_publication = $dataRow['date_publication'];
    //     $this->image = $dataRow['image'];
    // }

    // UPDATE
    public function updateComment()
    {
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->designation = htmlspecialchars(strip_tags($this->designation));
        $this->created = htmlspecialchars(strip_tags($this->created));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $sqlQuery = "UPDATE " . $this->db_table . " SET 
            name = '" . $this->name . "',
            email = '" . $this->email . "',
            designation = '" . $this->designation . "',
            created = '" . $this->created . "'
            WHERE id = " . $this->id;

        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

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

