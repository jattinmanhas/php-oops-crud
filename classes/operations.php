<?php
    class Operations{
        private $conn;
        private $table_name = "task_second";

        public $id;
        public $name;
        public $age;
        public $country;
        public $gender;
        public $languages;
        public $birthdate;
        public $filename;
        public $comments;

        public function __construct($db)
        {
            $this -> conn = $db;
        }

        public function read(){
            $query = "SELECT * FROM ".$this -> table_name;
            $result = $this -> conn -> prepare($query);
            $result -> execute();

            print_r($result);

            $data = array();
            while($row = $result -> fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            return $data;
        }

        public function insert(){
            $name = $_POST['name'];
            $age = $_POST['age'];
            $country = $_POST['country'];
            $gender = $_POST['gender'];
            $languages = $_POST['languages'];
            $language = "";
            foreach($languages as $row){
                $language .= $row.",";
            }
            $comments = $_POST['comments'];
            $time = $_POST['birthdate'];

            $filename = $_FILES['fileupload']['name'];
            $tempname = $_FILES['fileupload']['tmp_name'];
            $folder = "./uploads/".$filename;
            move_uploaded_file($tempname, $folder);

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(empty($name) || empty($age) || empty($country) || empty($gender)){
                    echo '<script>alert("Some fields are empty. PLease enter details.")</script>';
                }
                else{
                    $sql = "Insert into `task_second` (`name`,`age`,`country`,`gender`,`languages`,`birthdate`,`comments`,`filename`) values ('$name', '$age','$country','$gender','$language','$time','$comments','$filename')";

                    $result = $this -> conn -> prepare($sql);
                    $result -> execute();

                    if($result == TRUE){
                        echo "New record created successfully.";
                        header("Location: view.php");
                    }
                    else{
                        echo "Error: ".$this -> conn -> error;
                    }

                    $this -> conn -> close();
                }
            }
        }

        public function getData(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $sql = "Select * from `task_second` where `id` = '$id'";
                $result = $this -> conn -> prepare($sql);
                $result -> execute();

                $data = array();
                while($row = $result -> fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                }
                // print_r($data);
                return $data;
            }else{
                header("Location: view.php");
            }
        }

        public function update(){
            $name = $_POST['name'];
            $age = $_POST['age'];
            $country = $_POST['country'];
            $gender = $_POST['gender'];
            $languages = $_POST['languages'];
            $language = "";
            foreach($languages as $row){
                $language .= $row.",";
            }
            $comments = $_POST['comments'];
            $time = $_POST['birthdate'];

            $id = $_GET['id'];

            $res = "Select `filename` from `task_second` where `id`='$id'";
            $filename = $this -> conn -> prepare($res);
            $filename -> execute();

            $newFile = $_FILES['fileupdate']['name'];
            $tempname = $_FILES['fileupdate']['tmp_name'];
            $folder = "./uploads/".$newFile;

            while($row = $filename -> fetch(PDO::FETCH_ASSOC)){
                $finalFile = $row['filename'];
            }

            if($newFile != ""){
                move_uploaded_file($tempname, $folder);
            }else{
                $newFile = $finalFile;
            }

            print_r($name);
            print_r($age);
            print_r($country);
            print_r($gender);
            print_r($lanugages);
            print_r($newFile);
            print_r($time);
            print_r($comments);

            $sql ="Update `task_second` SET `name`='$name', `age`='$age', `country`='$country', `gender`='$gender', `languages`='$language', `birthdate`='$time', `filename`='$newFile', `comments`='$comments' where `id`='$id'";

            $result = $this -> conn -> prepare($sql);
            $result -> execute();

            if($result == TRUE){
                echo "Record Updated Successfully.";
                header("Location:view.php");
            }
            else{
                echo "Error: ".$this -> conn -> error;
            }
        }

        public function delete(){
            if(isset($_GET['id'])){
                $user_id = $_GET['id'];
                $sql = "Delete from `task_second` where `id` = '$user_id'";
                $result = $this -> conn -> prepare($sql);
                $result -> execute();

                if($result == TRUE){
                    echo "Result Deleted Successfully";
                    header("Location: view.php");
                }
                else{
                    echo "Error: ".$sql."<br>".$this -> conn ->error;
                }
            }
        }
    }
?>