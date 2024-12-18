<?php
include_once(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/Quiz.php');

class QuizController
{
    private $db;

    public function __construct() {
        $this->db = config::getConnexion(); // Use the existing connection method
    }
    public function getLastQuizId() {
        $query = "SELECT QuizID FROM quizzes ORDER BY QuizID DESC LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result ? $result['QuizID'] : null; // Return null if no quiz is found
    }
    // Inside your QuizController.php

public function sortQuizzes($sortOrder = 'asc') {
    // Default sort order is ascending; use descending if specified
    $sortOrder = $sortOrder === 'desc' ? 'DESC' : 'ASC';

    // Query to fetch quizzes, sorted by title
    $query = "SELECT * FROM quizzes ORDER BY title $sortOrder";

    // Prepare and execute the query
    $stmt = $this->db->prepare($query);
    $stmt->execute();

    // Fetch all quizzes
    $quizzes = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $quizzes[] = new Quiz($row['QuizID'], $row['Title'], $row['Description'], $row['Author']);
    }

    return $quizzes;
}




    // List all quizzes
    public function listQuizzes()
{
    $sql = "SELECT * FROM quizzes";
    $db = config::getConnexion();
    try {
        $stmt = $db->query($sql);
        $quizzes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $quizzes[] = new Quiz(
                $row['QuizID'],
                $row['Title'],
                $row['Description'],
                $row['Author'],
                new DateTime($row['CreatedAt'])
            );
        }
        return $quizzes;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

    // Delete a quiz
    public function deleteQuiz($id)
    {
        $sql = "DELETE FROM quizzes WHERE QuizID = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Add a quiz
    public function addQuiz($quiz) {
        // Prepare the SQL query with the correct table name 'quizzes'
        $sql = "INSERT INTO quizzes (title, description, author) VALUES (:title, :description, :author)";
        
        // Prepare the statement
        $stmt = $this->db->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':title', $quiz->getTitle());
        $stmt->bindParam(':description', $quiz->getDescription());
        $stmt->bindParam(':author', $quiz->getAuthor());

        // Execute the query and return the result
        if ($stmt->execute()) {
            return $this->db->lastInsertId(); // Return the newly created quiz ID
        }
        return false;
    }

    //public function addQuiz($quiz)
   // {
   //     $sql = "INSERT INTO quizzes (Title, Description, Author) 
   //             VALUES (:title, :description, :author )";
   //     $db = config::getConnexion();
   //     try {
   //         $query = $db->prepare($sql);
   //         $query->execute([
    //            'title' => $quiz->getTitle(),
    //            'description' => $quiz->getDescription(),
   //             'author' => $quiz->getAuthor()
    //        ]);
    //    } catch (Exception $e) {
    //        echo 'Error: ' . $e->getMessage();
    //    }
    //}

    // Update a quiz
    public function updateQuiz($quiz, $id)
    {
        var_dump($quiz);
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE quizzes SET 
                    Title = :title,
                    Description = :description,
                    Author = :author
                WHERE QuizID = :id'
            );

            $query->execute([
                'id' => $id,
                'title' => $quiz->getTitle(),
                'description' => $quiz->getDescription(),
                'author' => $quiz->getAuthor()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Show a specific quiz
    public function showQuiz($id)
    {
        $sql = "SELECT * FROM quizzes WHERE QuizID = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);

            $quiz = $query->fetch();
            return $quiz;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>
