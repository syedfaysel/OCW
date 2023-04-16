<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/OCW/config/dbconnect.php';


// require_once './config/dbconnect.php';

class Insert extends Dbconnect {
    private $conn;

    public function __construct() {
        $this->conn = $this->getConnection();
    }




    public function insertIntoCourses($data) {
        // remove extra item from data array
        unset($data['add_course']);

        $sql = "INSERT INTO courses (course_code, course_title, course_description,price_type, course_price, course_type,difficulty_level, thumbnail, added_by) VALUES (:course_code, :course_title, :course_description, :price_type, :course_price, :course_type, :difficulty_level, :thumbnail, :added_by)";

        $stmt = $this->conn->prepare($sql);

          // $stmt->execute($data);

        if (!$stmt->execute($data)) {
            $error = $stmt->errorInfo();
            return "Error: " . $error[2];
        }
    
        return true;
    }



    public function insertIntoMaterials($data) {
        // remove extra item from data array
        unset($data['submit']);

        if ($data['material_type'] == 'Tutorial') {
            $data['resource_path'] = null;
            $data['uploader'] = null;
        } else {
            $data['tutorial_url'] = null;
            $data['instructor'] = null;
        }

        $sql = "INSERT INTO `materials`(`material_title`, `course_code`, `material_type`, `tutorial_url`, `instructor`, `resource_path`, `uploader`) VALUES (:material_title, :course_code, :material_type, :tutorial_url, :instructor, :resource_path, :uploader)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt->execute($data)) {
            $error = $stmt->errorInfo();
            return "Error: " . $error[2];
        }
    
        return true;
    }



    public function insertIntoUsers($data) {
        $stmt = $this->conn->prepare("INSERT INTO users (username, first_name, last_name, email, password,  authority_level) VALUES (:username, :first_name, :last_name, :email, :password, :authority_level)");

        $stmt->execute($data);

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
        
    }



    public function enrollCourse($data) {
        $stmt = $this->conn->prepare("INSERT INTO paymentInfo (`trx_id`, `username`, `course_code`) VALUES (:trx_id, :username, :course_code)");
        $stmt->bindParam(':trx_id', $data['trx_id']);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':course_code', $data['course_code']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
        
    }
}



?>
