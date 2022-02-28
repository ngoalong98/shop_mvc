<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');

?>

<?php
    class category
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this -> db = new Database();
            $this -> fm = new Format();
        }
        public function insert_category($catName){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
          
            if(empty($catName)){
                $alert = "<span class='error'>Category must be not empty</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tb_category (catName) VALUES ('$catName')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Insert category successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Insert category not success</span>";
                    return $alert;
                }
            }
        }

        public function show_category(){
            $query = "SELECT * FROM tb_category ORDER BY catId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function getcatbyid($id){
            $query = "SELECT * FROM tb_category WHERE catId ='$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_category($catName,$id){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $id = mysqli_real_escape_string($this->db->link, $id);
          
            if(empty($catName)){
                $alert = "<span class='error'>Category must be not empty</span>";
                return $alert;
            }else{
                $query = "UPDATE tb_category SET catName = '$catName' WHERE catId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Update category successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Update category not success</span>";
                    return $alert;
                }
            }
        }

        public function delete_category($id){
            $query = "DELETE  FROM tb_category WHERE catId ='$id'";
            $result = $this->db->delete($query);
            
            return $result;
        }

        public function show_category_fontend(){
            $query = "SELECT * FROM tb_category ORDER BY catId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_by_cat($id){
            $query = "SELECT * FROM tb_product WHERE catId = '$id' ORDER BY catId DESC LIMIT 8";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_name_by_cat($id){
            $query = "SELECT tb_product.*,tb_category.catName,tb_category.catId 
            FROM tb_product,tb_category WHERE tb_product.catId = tb_category.catId AND tb_product.catId = '$id' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
    }
    
?>
