<?php
require_once'db.php';
if(isset($_POST["name"]) ){

  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];

  if($name == "" || $email == ""|| $message == ""){

    $data["title"] = "Hata";
    $data["text"] = "Lütfen boş alan bırakmayınız";
    $data["icon"] = "error";
    echo json_encode($data);


  }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

    $data["title"] = "Hata";
    $data["text"] = "Geçersiz Email";
    $data["icon"] = "error";
    echo json_encode($data);

  }else if(strlen($name) > 15 || strlen($name) < 3){

    $data["title"] = "Hata";
    $data["text"] = "Adınız 15 Karakterden Büyük Olamaz veya 3 Karakterden Kısa Olamaz";
    $data["icon"] = "error";
    echo json_encode($data);

  }else if(strlen($message) > 1000 || strlen($message) < 15){

    $data["title"] = "Hata";
    $data["text"] = "Mesajınız 1000 Karakterden Büyük Olamaz veya 15 Karakterden küçük olamaz";
    $data["icon"] = "error";
    echo json_encode($data);

  }else{

     $save = $db->prepare("INSERT INTO contact SET name=?,email=?,message=?");
     $save->execute(array($name,$email,$message));
     //0
     if($save->rowCount()){
       $data["title"] = "Başarılı";
       $data["text"] = "Başarıyla Gönderdiniz";
       $data["icon"] = "success";
       echo json_encode($data);

     }else{

       $data["title"] = "Hata";
       $data["text"] = "Bir Sorun Oluştu";
       $data["icon"] = "error";
       echo json_encode($data);

     }

    }

}


 ?>
