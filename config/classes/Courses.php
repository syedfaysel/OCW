<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/OCW/config/dbconnect.php';

// require_once './config/dbconnect.php';

class Courses extends Dbconnect {
    private $conn;

    public function __construct() {
        $this->conn = $this->getConnection();
    }

    public function getAllCourses() {
        $stmt = $this->conn->prepare("SELECT * FROM courses");

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCoursesBy($course_code) {
        $stmt = $this->conn->prepare("SELECT * FROM courses WHERE course_code = :course_code");

        $stmt->execute(['course_code' => $course_code]);
        return $stmt->fetchAll();
    }

    public function getLatestCourses() {
        $stmt = $this->conn->prepare("SELECT * FROM courses ORDER BY created_at DESC LIMIT 5");

        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getMaterialsBy($course_code, $material_type) {
        $stmt = $this->conn->prepare("SELECT * FROM materials WHERE course_code = :course_code AND material_type = :material_type");

        $stmt->execute(['course_code' => $course_code, 'material_type' => $material_type]);
        return $stmt->fetchAll();
    }



    public function getQuestionsBy($course_code) {
        $stmt = $this->conn->prepare("SELECT * FROM questions WHERE course_code = :course_code");

        $stmt->execute(['course_code' => $course_code]);
        return $stmt->fetchAll();
    }

    public function getAllQuestions() {
        $stmt = $this->conn->prepare("SELECT * FROM questions");

        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getQuestion($question_id){
        $stmt = $this->conn->prepare("SELECT * FROM questions WHERE question_id = :question_id");

        $stmt->execute(['question_id' => $question_id]);
        return $stmt->fetch();
    }


    public function getAnswers($question_id = null) {
        if($question_id == null){
            $stmt = $this->conn->prepare("SELECT * FROM answers");
        }else{
            $stmt = $this->conn->prepare("SELECT * FROM answers WHERE question_id = '$question_id'");
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }




    public function getAllResources() {
        $stmt = $this->conn->prepare("SELECT * FROM materials  WHERE material_type = 'Resource'");

        $stmt->execute();
        return $stmt->fetchAll();
    }
}



?>