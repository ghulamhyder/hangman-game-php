<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Myclass</title>
</head>
<body>
	

	<?php
			include_once 'includes/auto_loader.php';
			try{
				$obj=new Hangman();
				$max_len=7;
				if(isset($_POST['new_word'])){unset($_SESSION['answer']);}
				if(!isset($_SESSION['answer'])){
				$_SESSION['remain']=0;
				$ans=$obj->fetch_word('includes/hangman.txt');
				$_SESSION['answer']=$ans;
				$hide=$obj->hide_word($ans);
				$_SESSION['hidden']=$hide;
				echo 'Attempt Remaining is: <b>'.$max_len."</b>";

			}
			else{
				if(isset($_POST['check'])){
					$input=$_POST['ltr'];
	$_SESSION['hidden']=$obj->checkInput($input,$_SESSION['hidden'],$_SESSION['answer']);
			$max_len=$max_len-$_SESSION['remain'];
			$obj->isGameOver($max_len,$_SESSION['hidden'],$_SESSION['answer']);
			echo 'Attempt Remaining is: <b>'.$max_len."</b>";

				}
			}

			}catch(Exception $e){
				echo "Error".$e->getMessage();
			}

	?>
	<form name="form1" action="" method="post">
		<?php
			$hide=$_SESSION['hidden'];
			foreach ($hide as $val) {
				echo $val;
			}

		?><br><br>
		<label>Enter Letter</label><input type="text" name="ltr" size='1'>
		<input type="submit" name="check" value='check'>
		<input type="submit" name="new_word" value='New Word'>
	</form>

</body>
</html>