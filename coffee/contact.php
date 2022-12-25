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

            <!-- <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30153.788252261566!2d72.82321484621745!3d19.141690214227783!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b63aceef0c69%3A0x2aa80cf2287dfa3b!2sJogeshwari%20West%2C%20Mumbai%2C%20Maharashtra%20400047!5e0!3m2!1sen!2sin!4v1629452077891!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe> -->

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