<?php


session_start();
$errors=[];
$connection = mysqli_connect('localhost','root','','coffee_db');

function cleandata($data){
    $data = htmlspecialchars(trim(stripslashes(strip_tags($data))));
    return $data;

}
function minLen($input , $len){
    if(strlen($input)<$len){
        return false;
    }
    return true;
 }
 function maxLen($input , $len){
    if(strlen($input)>$len){
        return false;
    }
    return true;
 }
 function checkEmail($input){
    if(filter_var($input , FILTER_VALIDATE_EMAIL)){
        return false;
    }
    return true ; 
 }

 if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD']=="POST"){
    $name= cleandata($_POST['name']);
    $email= cleandata($_POST['email']);
    $phone= cleandata($_POST['phone']);

 if(empty($name)){
    $errors[]='add name' ;

}elseif(!minLen($name,3)){
     $errors[]='mame must greater than 3';
}elseif(!maxLen($name , 20)){
    $errors[]='mame must less than 20';
}
if(empty($email)){
    $errors[]='add mail' ;

}elseif(checkEmail($email)){
     $errors[]='mail not valid';
}
if(empty($phone)){
    $errors[]=' phone number is required' ;
}

if(empty($errors)){
    $request = " insert into data(name, email, phone) values('$name','$email','$phone') ";
    mysqli_query($connection, $request);
    
    $_SESSION['success']=['successfuly'];
    header('location:home.php'); 

}else{
        $_SESSION['errors']= $errors;
        header('location:contact.php'); 
    
}};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <title>home</title>
</head>

<body>
    <?php include 'layout/header.php'; ?>
    <!-- contact section starts  -->

    <section class="contact" id="contact">

        <h1 class="heading"> <span>contact</span> us </h1>

        <div class="row">
            <?php if(isset($_SESSION['errors'])): foreach($_SESSION['errors'] as $error): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
            <?php endforeach; unset($_SESSION['errors']); endif; ?>
            <?php if(isset($_SESSION['success'])): foreach($_SESSION['success'] as $succes): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $succes; ?>
            </div>
            <?php endforeach; unset($_SESSION['success']); endif; ?>

            <div style="max-width:100%;overflow:hidden;color:red;width:500px;height:500px;">
                <div id="my-map-canvas" style="height:100%; width:100%;max-width:100%;"><iframe
                        style="height:100%;width:100%;border:0;" frameborder="0"
                        src="https://www.google.com/maps/embed/v1/place?q=EraaSoft,+Mossadak,+street,+Dokki,+Egypt&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe>
                </div><a class="google-maps-html" rel="nofollow" href="https://www.bootstrapskins.com/themes"
                    id="enable-map-data">premium bootstrap themes</a>
                <style>
                #my-map-canvas img.text-marker {
                    max-width: none !important;
                    background: none !important;
                }

                img {
                    max-width: none
                }
                </style>
            </div>

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <h3>get in touch</h3>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" name="name" placeholder="name">
                </div>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="email" name="email" placeholder="email">
                </div>
                <div class="inputBox">
                    <span class="fas fa-phone"></span>
                    <input type="number" name="phone" placeholder="number">
                </div>
                <input type="submit" name="submit" value="contact now" class="btn">
            </form>

        </div>

    </section>

    <!-- contact section ends -->
    <!-- footer section starts  -->

    <?php include 'layout/footer.php'; ?>

    <!-- footer section ends -->

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>