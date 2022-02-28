<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');


?>

<?php
    class brand
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this -> db = new Database();
            $this -> fm = new Format();
        }
        public function insert_brand($brandName){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
          
            if(empty($brandName)){
                $alert = "<span class='error'>Brand must be not empty</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tb_brand (brandName) VALUES ('$brandName')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Insert Brand successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Insert Brand not success</span>";
                    return $alert;
                }
            }
        }

        public function show_brand(){
            $query = "SELECT * FROM tb_brand ORDER BY brandId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function getbrandbyid($id){
            $query = "SELECT * FROM tb_brand WHERE brandId ='$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_brand($brandName,$id){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            $id = mysqli_real_escape_string($this->db->link, $id);
          
            if(empty($brandName)){
                $alert = "<span class='error'>Brand must be not empty</span>";
                return $alert;
            }else{
                $query = "UPDATE tb_Brand SET brandName = '$brandName' WHERE brandId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Update Brand successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Update Brand not success</span>";
                    return $alert;
                }
            }
        }

        public function delete_brand($id){
            $query = "DELETE  FROM tb_brand WHERE brandId ='$id'";
            $result = $this->db->delete($query);
            // header("Location:addlist.php");
            return $result;
        }
    }
    
?>
