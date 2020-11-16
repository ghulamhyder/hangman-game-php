<?php

class Hangman{

	public function fetch_word($myfile){
		
		$file=fopen($myfile, 'r');
		if($file){
			$rand_word=null;
			$len=null;
			$count=0;
			while(($len=fgets($file))!=false){
				$count++;
				if(rand() % $count==0){
					$rand_word=trim($len);
				}
			}
			if(!feof($file)){
				fclose($file);
			}else{
				fclose($file);
			}
			$answer=str_split($rand_word);
		}
		return $answer;
	}
	public function hide_word($answer){
		$i=0;
		$hidden=$answer;
		$no_hide_word=floor(sizeof($answer)/2+1);
		while($i<$no_hide_word){
			$elem=rand(0,sizeof($answer)-2);
			$hidden=str_replace($answer[$elem], ' _ ', $hidden);
			$i++;
		}
		return $hidden;
	}
	public function checkInput($input,$hidden,$answer){
		$i=0;
		$myhide=$hidden;
		while ($i<count($answer)) {
			if($input===$answer[$i]){
				$myhide[$i]=$input;
			}
			$i++;
		}
		$_SESSION['remain']++;
		return $myhide;
	}
	public function isGameOver($max_len,$hidden,$answer){
		$output="";
		if($max_len < 1){
			$output.="Sorry You Loose Game Try Again! Word is: ".implode('', $answer);
			$output.="<form name='form1' action='' method='post'><input type='submit' name='new_word' value='New Word'></form>";
			echo $output;
			session_destroy();
			session_unset();
			die();
			exit();
		}
		elseif($hidden===$answer){
			$output.="Congratulation You Won Game Try Next Word! Word is: ".implode('', $answer);
			$output.="<form name='form1' action='' method='post'><input type='submit' name='new_word' value='New Word'></form>";
			echo $output;
			session_destroy();
			session_unset();
			die();
			exit();
		}
		return 0;
	}
}

?>