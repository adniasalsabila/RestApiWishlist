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
         $check = array('id' => '', 'title' => '', 'cost' => '');
         $check_match = count(array_intersect_key($_POST, $check));
         if($check_match == count($check)){
         
               $result = mysqli_query($connect, "INSERT INTO item_list SET
               id = '$_POST[id]',
               title = '$_POST[title]',
               cost = '$_POST[cost]'");
               
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Insert Success'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Insert Failed.'
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
         $check = array('title' => '', 'cost' => '');
         $check_match = count(array_intersect_key($_POST, $check));         
         if($check_match == count($check)){
         
              $result = mysqli_query($connect, "UPDATE item_list SET               
               title = '$_POST[title]',
               cost = '$_POST[cost]' WHERE id = $id");
         
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Update Success'                  
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'Update Failed'                  
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
               'message' =>'Delete Success'
            );
         }
         else
         {
            $response=array(
               'status' => 0,
               'message' =>'Delete Fail.'
            );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }

?>