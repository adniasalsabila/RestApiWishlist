<?php
    require_once "koneksi.php";

    if (function_exists($_GET['function'])) {
        $_GET['function']();
    }

    function get_wishlist()
    {
       global $connect;      
       $query = $connect->query("SELECT * FROM item_list");            
       while($row=mysqli_fetch_object($query))
       {
          $data[] =$row;
       }
       $response=array(
                      'status' => 1,
                      'message' =>'Success',
                      'data' => $data
                   );
       header('Content-Type: application/json');
       echo json_encode($response);
    }  

    function get_wishlist_id(){
        global $connect;
        if (!empty($_GET["id"])) {
            $id = $_GET["id"];
        }
        $query = "SELECT * FROM item_list WHERE id=$id";
        $result = $connect->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        if ($data) {
            $response = array(
                'status' => 1,
                'message' => 'Success',
                'data' => $data
            );
        }else{
            $response=array(
                'status' => 0,
                'message' => 'Data Not Found'
            );
        }
        header('Contect-Type: application/json');
        echo json_encode($response);
    }

    function insert_wishlist()
      {
         global $connect;   
         $check = array('id' => '', 'nameItem' => '', 'cost' => '');
         $check_match = count(array_intersect_key($_POST, $check));
         if($check_match == count($check)){
         
               $result = mysqli_query($connect, "INSERT INTO item_list SET
               id = '$_POST[id]',
               nameItem = '$_POST[nameItem]',
               cost = '$_POST[cost]'");
               
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Success'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Failed.'
                  );
               }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Wrong Parameter'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }

      function update_wishlist()
      {
         global $connect;
         if (!empty($_GET["id"])) {
         $id = $_GET["id"];      
      }   
         $check = array('nameItem' => '', 'cost' => '');
         $check_match = count(array_intersect_key($_POST, $check));         
         if($check_match == count($check)){
         
              $result = mysqli_query($connect, "UPDATE item_list SET               
               nameItem = '$_POST[nameItem]',
               cost = '$_POST[cost]' WHERE id = $id");
         
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Success'                  
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'=Failed'                  
               );
            }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Wrong Parameter',
                     'data'=> $id
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }

      function delete_wishlist()
      {
         global $connect;
         $id = $_GET['id'];
         $query = "DELETE FROM item_list WHERE id=".$id;
         if(mysqli_query($connect, $query))
         {
            $response=array(
               'status' => 1,
               'message' =>'Success'
            );
         }
         else
         {
            $response=array(
               'status' => 0,
               'message' =>'Fail.'
            );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }

      // CRUD user
      function get_user()
      {
         global $connect;      
         $query = $connect->query("SELECT * FROM user");            
         while($row=mysqli_fetch_object($query))
         {
            $data[] =$row;
         }
         $response=array(
                        'status' => 1,
                        'message' =>'Success',
                        'data' => $data
                     );
         header('Content-Type: application/json');
         echo json_encode($response);
      }  

      function get_user_id(){
         global $connect;
         if (!empty($_GET["id_user"])) {
             $id = $_GET["id_user"];
         }
         $query = "SELECT * FROM user WHERE id_user=$id_user";
         $result = $connect->query($query);
         while ($row = mysqli_fetch_object($result)) {
             $data[] = $row;
         }
         if ($data) {
             $response = array(
                 'status' => 1,
                 'message' => 'Success',
                 'data' => $data
             );
         }else{
             $response=array(
                 'status' => 0,
                 'message' => 'Data Not Found'
             );
         }
         header('Contect-Type: application/json');
         echo json_encode($response);
     }

     function insert_user()
      {
         global $connect;   
         $check = array('id_user' => '', 'nama_user' => '', 'email_user' => '', 'password_user' => '');
         $check_match = count(array_intersect_key($_POST, $check));
         if($check_match == count($check)){
         
               $result = mysqli_query($connect, "INSERT INTO user SET
               id_user = '$_POST[id_user]',
               nama_user = '$_POST[nama_user]',
               email_user = '$_POST[email_user]',
               password_user = '$_POST[password_user]'
               ");
               
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Success'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Failed.'
                  );
               }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Wrong Parameter'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }

      function update_user()
      {
         global $connect;
         if (!empty($_GET["id_user"])) {
         $id_user = $_GET["id_user"];      
      }   
         $check = array('nama_user' => '', 'email_user' => '', 'password_user' => '');
         $check_match = count(array_intersect_key($_POST, $check));         
         if($check_match == count($check)){
         
              $result = mysqli_query($connect, "UPDATE user SET               
               nama_user = '$_POST[nama_user]',
               email_user = '$_POST[email_user]',
               password_user = '$_POST[password_user]' WHERE id_user = $id_user");
         
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Success'                  
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'=Failed'                  
               );
            }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Wrong Parameter',
                     'data'=> $id
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }

      function delete_user()
      {
         global $connect;
         $id_user = $_GET['id_user'];
         $query = "DELETE FROM user WHERE id_user=".$id_user;
         if(mysqli_query($connect, $query))
         {
            $response=array(
               'status' => 1,
               'message' =>'Success'
            );
         }
         else
         {
            $response=array(
               'status' => 0,
               'message' =>'Fail.'
            );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }

      function insert_gambar()
      {
         global $connect;   
         $check = array('id_gambar' => '', 'gambar' => '');
         $check_match = count(array_intersect_key($_POST, $check));
         if($check_match == count($check)){
         
               $result = mysqli_query($connect, "INSERT INTO user SET
               id_gambar = '$_POST[id_gambar]',
               gambar = '$_POST[gambar]'
               ");
               
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Success'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Failed.'
                  );
               }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Wrong Parameter'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }

      $gambar = $_FILES['file']['gambar'];
      $namaGambar = $_FILES['file']['name'];
 
      $file_path = $_SERVER['DOCUMENT_ROOT'] . '/api-kompikaleng';
 
      $data = "";
 
      if (!file_exists($file_path)) {
         mkdir($file_path, 0777, true);
      }
 
      if(!$gambar){
        $data['message'] = "Gambar tidak ditemukan";
      }
      else{
         if(move_uploaded_file($gambar, $file_path.'/'.$namaGambar)){
         $data['message'] = "Sukses Upload Gambar";
      }
   }
      print_r(json_encode($data));
 

?>