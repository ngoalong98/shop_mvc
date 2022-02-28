<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');

?>

<?php
    class user
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this -> db = new Database();
            $this -> fm = new Format();
        }
        public function insert_product($data,$files){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);

            //kiem tra hinh anh vaf cho vao file uploads
            $permited   = array('jpg','jpeg','png','gif');
            $file_name  = $_FILES['image']['name'];
            $file_size  = $_FILES['image']['size'];
            $file_temp  = $_FILES['image']['tmp_name'];

            $div            = explode('.',$file_name);
            $file_ext       = strtolower(end($div));
            $unique_image   = substr(md5(time()),0,10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
           
            if($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $type == "" || $file_name == "" ){
                $alert = "<span class='error'>Files must be not empty</span>";
                return $alert;
            }else{
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "INSERT INTO tb_product (
                    productName,
                    catId,
                    brandId,
                    product_desc,
                    price,
                    type,
                    image) VALUES (
                    '$productName',
                    '$category',
                    '$brand',
                    '$product_desc',
                    '$price',
                    '$type',
                    '$unique_image')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Insert Product successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Insert Product not success</span>";
                    return $alert;
                }
            }
        }

       
    }
    
?>
