 <?php 
//if(isset($_GET['submit'])){
	//echo $_GET['email'];
	//echo $_GET['title'];
	//echo $_GET['ingredients'];
include('config/db_connect.php');
//}
 $title = $email = $ingredients = '';
 $errors = array('email'=>'','title'=>'','ingredients'=>'');
 // we made them html entity instead of being javascript links
 //xss is cross site scripting 
 if(isset($_POST['submit'])){
	//echo htmlspecialchars($_POST['email']);
	//echo htmlspecialchars($_POST['title']);
	//echo htmlspecialchars($_POST['ingredients']);
	//check email
	if (empty($_POST['email'])) {
		$errors['email']= 'An email is required';
		}else{

		}
		$email =$_POST['email'];
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$errors['email'] = 'email must be a valid email address ';

		}

		}
	

	

	//check title
	if (empty($_POST['title'])) {
		$errors['title'] =  " A title is required" ;
	
} else{
$title= $_POST['title'];
if(!preg_match('/^[a-zA-Z\s]+$/',$title)){
$errors['title'] = 'Title must be letters and spaces only';
}

}


	//check ingredients
	if (empty($_POST['ingredients'])) {
		$errors['ingredients'] = " and ingredients is required" ;
	
} else{
$ingredients= $_POST['ingredients'];
if(!preg_match('/^([a-zA-Z\s]+)(, \s*[a-zA-Z\s]*)*$/',$ingredients)){
$errors['ingredients'] = ' ingredients must be comma separated';
}

}
if(array_filter($errors)){
	//echo 'erros in the form';
} else {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$ingredients = mysqli_real_escape_string($conn, $_POST['email']);
	// create sql
	$sql ="INSERT INTO pizzas(title,email,ingredients) VALUES ('$title','$email','$ingredients')";
 	if(mysqli_query($conn, $sql)) {
 	header('location:index.php');	

 	}else{
 		echo 'query error: ' . mysqli_error($conn) ;
 	}
		
	
 	}
 	





// end of POST check
 ?>
 <!DOCTYPE html>
 <html>
 <?php include('templates/header.php'); ?>
 <section class="container grey-text">
 	<h4 class="center">Add a Pizza</h4>
 	<form class="white" action="<?php echo $_SERVER['PHP_SELF'] ?>"method="POST">

 	<label> Your Email:</label>
 	<input type="text" name="email" value="<?php echo $email ?>">
 	<div class="red-text"><?php echo $errors['email']; ?>	</div>

 		<label> Pizza title:</label>
	<input type="text" name="title" value="<?php echo htmlspecialchars ($title) ?>">
	<div class="red-text"><?php echo $errors['title']; ?>	</div>

 		<label> ingredients(comma separated):</label>
		<input type="text" name="ingredients" value="<?php echo htmlspecialchars ($ingredients) ?>">
		<div class="red-text"><?php echo  $errors['ingredients']; ?>	</div>
		<div class="center">
			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
		</div>
 	</form>
 </section>
<?php include('templates/footer.php'); ?>
 </html>