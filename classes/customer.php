<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');

?>

<?php
    class customer
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this -> db = new Database();
            $this -> fm = new Format();
        }
        
        public function insert_customers($data){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $city = mysqli_real_escape_string($this->db->link, $data['city']);
            $country = mysqli_real_escape_string($this->db->link, $data['country']);
            $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $password = mysqli_real_escape_string($this->db->link,md5($data['password']));

            if($name == "" || $city == "" || $country == "" || $zipcode == "" || $address == "" || $email == "" || $phone == "" || $password == "" ){
                $alert = "<span class='error'>Fields must be not empty</span>";
                return $alert;
            }else{
                $check_email = "SELECT * FROM tb_customer WHERE email ='$email'";
                $result_check = $this->db->select($check_email);
                if($result_check){
                    $alert = "<span class='error'>Email already existed</span>";
                    return $alert;
                }else{
                    $query = "INSERT INTO tb_customer (
                        name,
                        city,
                        country,
                        zipcode,
                        address,
                        email,
                        phone,
                        password) VALUES (
                        '$name',
                        '$city',
                        '$country',
                        '$zipcode',
                        '$address',
                        '$email',
                        '$phone',
                        '$password')";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = "<span class='success'> Customer Created Successfully</span>";
                        return $alert;
                    }else{
                        $alert = "<span class='error'> Customer Created Not Success</span>";
                        return $alert;
                    }
                }
            }
        }

        public function login_customers($data){
            $email = mysqli_real_escape_string($this->db->link, $data['email']);     
            $password = mysqli_real_escape_string($this->db->link,md5($data['password']));
            if($email == '' || $password == '' ){
                $alert = "<span class='error'>Email and Password must be not empty</span>";
                return $alert;
            }else{
                $check_login = "SELECT * FROM tb_customer WHERE email ='$email' AND password = '$password'";
                $result_check = $this->db->select($check_login);
                if($result_check){
                    $value = $result_check->fetch_assoc();
                    Session::set('customer_login',true);
                    Session::set('customer_id',$value['id']);
                    Session::set('customer_name',$value['name']);
                    header("Location:order.php");
                }else{
                    $alert = "<span class='error'>Email or Password doesn't match</span>";
                    return $alert;
                }
            }
        }

        public function show_customers($id){
            $query = "SELECT * FROM tb_customer WHERE id ='$id' ";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_customers($data,$id){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

            if($name == "" || $zipcode == "" || $address == "" || $email == "" || $phone == "" ){
                $alert = "<span class='error'>Fields must be not empty</span>";
                return $alert;
            }else{
                $query = "UPDATE tb_customer SET
                    name = '$name',
                    zipcode = '$zipcode',
                    address = '$address',
                    email = '$email',
                    phone = '$phone' WHERE id = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'> Customer Updated Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'> Customer Updated Not Success</span>";
                    return $alert;
                }
            }
        }

      
    }
    
?>
