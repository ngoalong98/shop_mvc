<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');

?>

<?php
    class product
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this -> db = new Database();
            $this -> fm = new Format();
        }

        public function search_product($tukhoa){
            $tukhoa = $this->fm->validation($tukhoa);
            $query = "SELECT * FROM tb_product WHERE productName LIKE '%$tukhoa%'";
            $result = $this->db->select($query);
            return $result;
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
           
            if($productName == "" || $brand == "" || $category == "" || $file_name == "" ){
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

        public function insert_slider($data,$files){
            $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
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
          
            if($sliderName == "" || $type == "" ){
                $alert = "<span class='error'>Fields must be not empty</span>";
                return $alert;
            }else{
                if(!empty($file_name)){
                    //neu nguoi dung chon anh
                    if($file_size > 2048000){
                        $alert = "<span class='success'>Image Size should be less then 2MB!</span>";
                        return $alert;
                    }elseif(in_array($file_ext, $permited) === false){
                        $alert = "<span class='success'>You can upload only:".implode(',', $permited)."</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp,$uploaded_image);
                    $query = "INSERT INTO tb_slider (
                        sliderName,                  
                        type,
                        slider_image) VALUES (
                        '$sliderName',
                        '$type',
                        '$unique_image')";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = "<span class='success'>Insert slider successfully</span>";
                        return $alert;
                    }else{
                        $alert = "<span class='error'>Insert slider not success</span>";
                        return $alert;
                    }
                }
               
            }
        }

        public function show_slider(){
            $query = "SELECT * FROM tb_slider WHERE type='1' ORDER BY sliderId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_slider_list(){
            $query = "SELECT * FROM tb_slider  ORDER BY sliderId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_product(){
            // $query = "SELECT * FROM tb_product ORDER BY catId DESC";
            $query = "SELECT tb_product.*, tb_category.catName, tb_brand.brandName
            FROM tb_product INNER JOIN tb_category ON tb_product.catId = tb_category.catId
            INNER JOIN tb_brand ON tb_product.brandId = tb_brand.brandId
            ORDER BY tb_product.productId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproductbyid($id){
            $query = "SELECT * FROM tb_product WHERE productId ='$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_type_slider($id,$type){
            $type = mysqli_real_escape_string($this->db->link, $type);
            $query = "UPDATE tb_slider SET  type = '$type'  WHERE sliderId = '$id'";
            $result = $this->db->update($query);
            return $result;
        }

        public function delete_slider($id){
            $query = "DELETE  FROM tb_slider WHERE sliderId ='$id'";
            $result = $this->db->delete($query);
            // header("Location:addlist.php");
            return $result;
        }

        public function update_product($data,$files,$id){
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
          
            if($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $type == "" ){
                $alert = "<span class='error'>Fields must be not empty</span>";
                return $alert;
            }else{
                if(!empty($file_name)){
                    //neu nguoi dung chon anh
                    if($file_size > 20480){
                        $alert = "<span class='success'>Image Size should be less then 2MB!</span>";
                        return $alert;
                    }elseif(in_array($file_ext, $permited) === false){
                        $alert = "<span class='success'>You can upload only:".implode(',', $permited)."</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp,$uploaded_image);
                    $query = "UPDATE tb_product SET 
                        productName = '$productName',
                        catId = '$category',
                        brandId = '$brand',
                        type = '$type',
                        price = '$price',
                        image = '$unique_image',
                        product_desc = '$product_desc'
                        WHERE productId = '$id'";
                }else{
                    //neu nguoi dung ko thay doi anh
                    $query = "UPDATE tb_product SET 
                    productName = '$productName',
                    catId = '$category',
                    brandId = '$brand',
                    type = '$type',
                    price = '$price',
                    product_desc = '$product_desc'
                    WHERE productId = '$id'";
                }
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Update product successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Update product not success</span>";
                    return $alert;
                }
            }
        }

        public function delete_product($id){
            $query = "DELETE  FROM tb_product WHERE productId ='$id'";
            $result = $this->db->delete($query);
            // header("Location:addlist.php");
            return $result;
        }

        /* --------trang chu-----------*/
        public function getproduct_feathered(){
            $query = "SELECT * FROM tb_product WHERE type ='1'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_new(){
            $query = "SELECT * FROM tb_product ORDER BY productId DESC ";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_all_product(){
            $query = "SELECT * FROM tb_product ";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_details($id){
            $query = "SELECT tb_product.*, tb_category.catName, tb_brand.brandName
            FROM tb_product INNER JOIN tb_category ON tb_product.catId = tb_category.catId
            INNER JOIN tb_brand ON tb_product.brandId = tb_brand.brandId WHERE tb_product.productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getLastesDell(){
            $query = "SELECT * FROM tb_product WHERE brandId = '1' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastesApple(){
            $query = "SELECT * FROM tb_product WHERE brandId = '3' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastesSamsung(){
            $query = "SELECT * FROM tb_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastesCanon(){
            $query = "SELECT * FROM tb_product WHERE brandId = '5' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function insertCompare($productid,$customer_id){
            $productid = mysqli_real_escape_string($this->db->link, $productid);
            $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

            $query = "SELECT * FROM tb_product WHERE productId ='$productid'";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];

            $check_compare = "SELECT * FROM tb_compare WHERE productId = '$productid' AND customer_id = '$customer_id'";
            $result_check_compare  = $this->db->select($check_compare);
            if($result_check_compare){
                $msg = "<span class='error' style='color:red;'>Product Already Added to Compare</span>";
                return $msg;
            }else{
                $query_insert = "INSERT INTO tb_compare (
                    productId,
                    customer_id,
                    productName,
                    price,
                    image) VALUES (
                    '$productid',
                    '$customer_id',
                    '$productName',
                    '$price',
                    '$image')";
                $insert_compare = $this->db->insert($query_insert);
                if($insert_compare){
                    $alert = "<span class='success' style='color:green;'>Added Compare successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error' style='color:red;'>Added Compare not success</span>";
                    return $alert;
                }
            }
        }

        public function insertWishlish($productid,$customer_id){
            $productid = mysqli_real_escape_string($this->db->link, $productid);
            $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

            $query = "SELECT * FROM tb_product WHERE productId ='$productid'";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];

            $check_wishlish = "SELECT * FROM tb_wishlish WHERE productId = '$productid' AND customer_id = '$customer_id'";
            $result_check_wishlish  = $this->db->select($check_wishlish);
            if($result_check_wishlish){
                $msg = "<span class='error' style='color:red;'>Product Already Added to Wishlish</span>";
                return $msg;
            }else{
                $query_insert = "INSERT INTO tb_wishlish (
                    productId,
                    customer_id,
                    productName,
                    price,
                    image) VALUES (
                    '$productid',
                    '$customer_id',
                    '$productName',
                    '$price',
                    '$image')";
                $insert_wlish = $this->db->insert($query_insert);
                if($insert_wlish){
                    $alert = "<span class='success' style='color:green;'>Added Wishlish successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error' style='color:red;'>Added Wishlish not success</span>";
                    return $alert;
                }
            }
        }


        public function get_compare($customer_id){
            $query = "SELECT * FROM tb_compare WHERE customer_id = '$customer_id' ORDER BY id DESC ";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_wishlish($customer_id){
            $query = "SELECT * FROM tb_wishlish WHERE customer_id = '$customer_id' ORDER BY id DESC ";
            $result = $this->db->select($query);
            return $result;
        }

        public function delwlish($proid,$customer_id){
            $query = "DELETE  FROM tb_wishlish WHERE productId ='$proid' AND customer_id = '$customer_id'";
            $result = $this->db->delete($query);
            // header("Location:addlist.php");
            return $result;
        }

    }
    
?>
