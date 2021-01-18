<?php

  // file upload function

  function fileUpload($file, $location = '', $file_type = ['jpg', 'png', 'gif', 'jpeg'], $size = 1024){
    // file information
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'] / 1024;

    // file extension
    $file_array = explode('.', $file_name);
    $file_extension = strtolower(end($file_array));

    // unique name
    $unique = md5(time().rand()).'.'.$file_extension;

    $mess = null;
    //file type check
    if(in_array($file_extension, $file_type) == false){
      $mess = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			 				  <strong>Warning!</strong> Invalid file format.
			 				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			 				    <span aria-hidden="true">&times;</span>
			 				  </button>
			 				</div>';
    }elseif($file_size >= $size){
      $mess = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			 				  <strong>Warning!</strong> File size too large.
			 				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			 				    <span aria-hidden="true">&times;</span>
			 				  </button>
			 				</div>';
    }else{
      // upload image
      move_uploaded_file($file_tmp_name, $location.$unique);
    }

    // return value
    return [
        'file_name' => $unique,
        'mess' => $mess,
    ];



  }

  function dataCheck($connection, $table, $col, $data){
    //Email checked
    $sql = "SELECT $col FROM $table WHERE $col = '$data'";
    $email_data = $connection -> query($sql);
    $num_email =  $email_data -> num_rows;
    if($num_email > 0){
      return false;
    }else{
      return true;
    }
  }

 ?>
