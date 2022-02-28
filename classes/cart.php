<?php
     $filepath = realpath(dirname(__FILE__));
     include_once ($filepath.'/../lib/database.php');
     include_once ($filepath.'/../helpers/format.php');
 

?>

<?php
    class cart
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this -> db = new Database();
            $this -> fm = new Format();
        }
        public function  add_to_cart($id,$quantity){
            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $id = mysqli_real_escape_string($this->db->link, $id);
            $sId = session_id();

            $query = "SELECT * FROM tb_product WHERE productId = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            $image = $result['image'];
            $productName = $result['productName'];
            $price = $result['price'];

            $check_cart = "SELECT * FROM tb_cart WHERE productId = '$id' AND sID = '$sId'";
            $result_check_cart  = $this->db->select($check_cart);
            if($result_check_cart){
                $msg = "Product Already Added";
                return $msg;
            }else{
                $query_insert = "INSERT INTO tb_cart (
                    productId,
                    productName,
                    quantity,
                    sId,
                    price,
                    image) VALUES (
                    '$id',
                    '$productName',
                    '$quantity',
                    '$sId',
                    '$price',
                    '$image')";
                $insert_cart = $this->db->insert($query_insert);
                if($insert_cart){
                    header('Location:cart.php');
                }else{
                    header('Location:404.php');
                }
            }
           
        }

        public function get_product_cart(){
            $sId = session_id();
            $query = "SELECT * FROM tb_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_quantity_cart($quantity,$cartId){
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);
            $query = "UPDATE tb_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
            $result = $this->db->update($query);
            if($result){
                $msg = "Product quantity update successfully";
                return $msg;
            }else{
                $msg = "Product quantity update not success";
                return $msg;
            }
        }

        public function delete_cart($cartid){
            $sId = session_id();
            $query =  "DELETE  FROM tb_cart WHERE cartId ='$cartid'";
            $result = $this->db->delete($query);
            // if($result){
            //     header('Location:cart.php');
            // }else{
            //     $msg = "Product quantity delete not success";
            //     return $msg;
            // }
        }

        

        public function check_cart(){
            $sId = session_id();
            $query = "SELECT * FROM tb_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function check_order($customer_id){
            $sId = session_id();
            $query = "SELECT * FROM tb_order WHERE customer_id = '$customer_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function del_all_data_cart(){
            $sId = session_id();
            $query = "DELETE FROM tb_cart WHERE sId = '$sId'";
            $result = $this->db->delete($query);
            return $result;
        }

        public function del_compare($customer_id ){
            $sId = session_id();
            $query = "DELETE FROM tb_compare WHERE customer_id = '$customer_id'";
            $result = $this->db->delete($query);
            return $result;
        }

        public function insertOrder($customer_id){
            $sId = session_id();
            $query = "SELECT * FROM tb_cart WHERE sId = '$sId'";
            $get_product = $this->db->select($query);
            if($get_product){
                while($result = $get_product->fetch_assoc()){
                    $productid = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'];
                    $price = $result['price'] * $quantity;
                    $image = $result['image'];
                    $customer_id = $customer_id;
                    $query_order = "INSERT INTO tb_order (
                        productId,
                        productName,
                        quantity,
                        price,
                        image,
                        customer_id) VALUES (
                        '$productid',
                        '$productName',
                        '$quantity',
                        '$price',
                        '$image',
                        '$customer_id')";
                    $insert_order = $this->db->insert($query_order);
                    
                }
            }
        }

        public function getAmountPrice($customer_id){
            
            $query = "SELECT price FROM tb_order WHERE customer_id = '$customer_id'";
            $get_price = $this->db->select($query);
            return $get_price;
        }
       
        public function get_cart_ordered($customer_id){
            $query = "SELECT * FROM tb_order WHERE customer_id = '$customer_id'";
            $get_cart_ordered = $this->db->select($query);
            return $get_cart_ordered;
        }

        public function get_inbox_cart(){
            $query = "SELECT * FROM tb_order ORDER BY date_order";
            $get_inbox_cart = $this->db->select($query);
            return $get_inbox_cart;
        }

        public function shifted($id,$time,$price){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);

            $query = "UPDATE tb_order SET status = '1' 
            WHERE id = '$id' AND date_order = '$time' AND price = '$price'";
            $result = $this->db->update($query);
            if($result){
                $msg = "Order  update successfully";
                return $msg;
            }else{
                $msg = "Order  update not success";
                return $msg;
            }
        }

        public function del_shifted($id,$time,$price){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $query = "DELETE FROM tb_order 
            WHERE id = '$id' AND date_order = '$time' AND price = '$price'";
            $result = $this->db->delete($query);
            if($result){
                $msg = "Order  delete successfully";
                return $msg;
            }else{
                $msg = "Order  delete not success";
                return $msg;
            }
        }

        public function shifted_confirm($id,$time,$price){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);

            $query = "UPDATE tb_order SET status = '2' 
            WHERE customer_id = '$id' AND date_order = '$time' AND price = '$price'";
            $result = $this->db->update($query);
            if($result){
                $msg = "Order  update successfully";
                return $msg;
            }else{
                $msg = "Order  update not success";
                return $msg;
            }
        }
    }
    
?>
