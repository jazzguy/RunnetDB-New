<?php 

	session_start();

	require_once 'configuration/connection.php';
	require_once 'configuration/article.php';
	
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] = true){
		die("Du &auml;r redan inloggad, logga ut f&ouml;r att skapa ett yttligare konto");
	}
?>
<!DOCTYPE html>
<html>

	<head>
		<title>Test</title>
		
		<meta charset="utf-8" type="charset" content="charset"/>
		
		<link rel="stylesheet" type="text/CSS" href="http://localhost/LAN/CSS/flipclock.css">
		<script type="text/javascript" src="http://localhost/LAN/JS/flipclock.js" ></script>
		<script type="text/javascript" src="http://localhost/LAN/JS/flipclock.min.js" ></script>

		<link href="css/main.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
		
		<script type="text/javascript" language="Javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" language="Javascript" src="js/bootstrap.min.js"></script>
		
	</head>
	<body>
	
		<menu>
			<img src="http://localhost/LAN/IMG/logo.png" style="position:relative;top:32px;width:200px;"></img>
      
      <?php
        if(!isset($_POST['submit'])){
		
      ?>
	  
	  <!--- OM MAN INTE ÄR INLOGGAD OCH INTE TRYCKT PÅ LOGGA IN KNAPPEN --->

      <span class="label label-danger" style="background: #428bca;position: relative;top: 35px;left: 93px;width: 296px;height: 14px;">
	  <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { echo "<center>Boka gärna din biljett till nästa #LAN</center>"; } else { ?>
	  <?php echo "<center>Logga in för att få den bästa upplevelsen</center>"; } ?>
	  </span>
      
      <?php } ?>

      <?php 
			
			if(isset($_POST['submit'])){
			
				$username = htmlentities($connection->real_escape_string($_POST['username']));
				$password = htmlentities(sha1($connection->real_escape_string($_POST['password'])));
				
				$query = $connection->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
				
				if($query->num_rows == 1){
					$_SESSION['logged_in'] = true;
					$_SESSION['username'] = $username;
				
				echo '<meta http-equiv="refresh" content="0; url=http://localhost/lan/">';
				
				}
				else{
			
			?>

      <span class="label label-danger" style="background: #d9534f;position: relative;top: 35px;left: 93px;width: 296px;height: 14px;text-align:center;">Användarnamnet och lösenordet matchade inte ihop</span>
      
      <?php } }?>
      
			<a style="position:relative;left:20%;" href="index.php">Hem </a> <a style="position:relative;left:22%;" href="map.php"> Karta</a> <a style="position:relative;left:24%;" href="boka.php"> Boka</a> <a style="position:relative;left:26%;" href="about.php"> Om oss</a> <a style="position:relative;left:28%;" href="information.php"> Information</a>
      <a href="register.php" style="position:relative;left:30%;">Registrera dig</a>
			
			<?php 
				
				if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		
			?>
			
			<p id="username">Välkommen, <?php echo $_SESSION['username']; ?></p> <small style="position: relative;left: 1476px;top: -83px;"><a href="logout.php">Logga ut</a></small>
			
			<?php }else{ ?>
			
			<form method="POST" action="">
			<input type="text" name="username" style="width: 139px;position: relative;left: 134%;top: -25px;" placeholder="Användarnamn">
			<input style="width: 139px;position: relative;left: 134%;top: -25px;" type="password" name="password" placeholder="Lösenord">
        <button type="submit" style="position: relative;left: 135%;top: -30px;" name="submit" class="btn btn-default">Logga in</button>
        <a style="position: relative;top: 0px;left: 106.5%;" href="">Glömt ditt lösenord?</a>
			</form>
			
			<?php } ?>
		
		</menu>
		
		<header>
		<center>
		<img id="next-lan-begins" src="http://localhost/LAN/IMG/next-lan-begins.png"></img>
		
		<div style="color: #FFFFFF;font-weight: bold;font-size: 38px;text-shadow: 1px 1px 1px #000000;position: relative;top: 68px;" id="countbox1"></div></center>
		
		</header>
		
		<footer>
		
			<h3 style="text-align: center;position: relative;top: 50px;"> Registrera dig </h3>
			
			<form method="POST" action="" name="">
<center>	<br > </br > <br > </br >
				<input type="text" style="position:relative;left:0;" name="firstname" placeholder="Förnamn">
				<input type="text" style="position:relative;left:0;" name="lastname" placeholder="Efternamn">
				<input type="text" style="position:relative;left:0;" name="username" placeholder="Username">
				<input type="text" style="position:relative;left:0;"  name="date-of-birth" placeholder="Födelsedatum (DD-MM-YYYY)"><div>
				<input type="password" style="position:relative;left:0;"  name="password" placeholder="Lösenord">
				<input type="password" style="position:relative;left:0;"  name="re-password" placeholder="Repetera lösenordet">
				<input type="text" style="position:relative;left:0;"  name="email" placeholder="Email adress">
				<input type="text" style="position:relative;left:0;" name="gatuadress" placeholder="Gatuadress"><div>
				<input type="text" style="position:relative;left:0;" name="postnummer" placeholder="Postnummer">
				<input type="text" style="position:relative;left:0;" name="phonenumber" placeholder="Telefonnummer">
				<select name="gender" style="position: relative;top: -15px;"> <option value="man">Man</option> <option value="kvinna">Kvinna</option> </select>
				<input type="text" style="position:relative;left:0;" name="personnummer" placeholder="Personnummer (111112233-XXXX)"><div>
				<button type="submit" style="position: relative;top: -10px;width: 56.5%;;" name="register-submit" class="btn btn-default">Registrera dig</button>	</center>
			</form>
			
			<?php 
			
			if(isset($_POST['register-submit'])){
			
			if(empty($_POST === false)){
				$required_fields = array('first_name', 'last_name', 'username', 'date-of-birth','password','re-password','email','gatiadress','postnummer','phonenumber','personnummer');
				foreach($_POST as $key=>$value){
					if(empty($value) && in_array($key, $required_fields) == true);
					$errors[] = 'Du måste fylla i alla fält';
					break 1;
				}
			}
			
			if(empty($errors) === true){
				if(preg_match("/\\s/", $_POST['username']) === true){
					$errors[] = 'Ditt lösenord får inte inkludera några mellanrum';
				}
				if(strlen($_POST['password']) < 6){
					$errors[] = 'Ditt lösenord måste vara minst 6 täcken långt';
				}
				if(strlen($_POST['password']) > 32){
					$errors[] = 'Ditt lösenord får vara högst 32 täcken långt';
				}
				if($_POST['password'] !== $_POST['password_again']){
					$errors[] = 'Ditt lösenord matchade inte';
				}
			}
			
			}
			
			print_r($errors);
			
			?>
		
			<copyright>Copyright &copy; Kristians #LAN 2014</copyright>	
		
		</footer>
		
		
	</body>

</html>

		<script type="text/javascript">
//###################################################################
// Author: ricocheting.com
// Version: v3.0
// Date: 2014-09-05
// Description: displays the amount of time until the "dateFuture" entered below.

var CDown = function() {
	this.state=0;// if initialized
	this.counts=[];// array holding countdown date objects and id to print to {d:new Date(2013,11,18,18,54,36), id:"countbox1"}
	this.interval=null;// setInterval object
}

CDown.prototype = {
	init: function(){
		this.state=1;
		var self=this;
		this.interval=window.setInterval(function(){self.tick();}, 1000);
	},
	add: function(date,id){
		this.counts.push({d:date,id:id});
		this.tick();
		if(this.state==0) this.init();
	},
	expire: function(idxs){
		for(var x in idxs) {
			this.display(this.counts[idxs[x]], "Now!");
			this.counts.splice(idxs[x], 1);
		}
	},
	format: function(r){
		var out="";
		if(r.d != 0){out += r.d +" "+((r.d==1)?"day":"Dagar")+", ";}
		if(r.h != 0){out += r.h +" "+((r.h==1)?"hour":"Timmar")+", ";}
		out += r.m +" "+((r.m==1)?"min":"Minuter")+", ";
		out += r.s +" "+((r.s==1)?"sec":"Sekunder")+", ";

		return out.substr(0,out.length-2);
	},
	math: function(work){
		var	y=w=d=h=m=s=ms=0;

		ms=(""+((work%1000)+1000)).substr(1,3);
		work=Math.floor(work/1000);//kill the "milliseconds" so just secs

		y=Math.floor(work/31536000);//years (no leapyear support)
		w=Math.floor(work/604800);//weeks
		d=Math.floor(work/86400);//days
		work=work%86400;

		h=Math.floor(work/3600);//hours
		work=work%3600;

		m=Math.floor(work/60);//minutes
		work=work%60;

		s=Math.floor(work);//seconds

		return {y:y,w:w,d:d,h:h,m:m,s:s,ms:ms};
	},
	tick: function(){
		var now=(new Date()).getTime(),
			expired=[],cnt=0,amount=0;

		if(this.counts)
		for(var idx=0,n=this.counts.length; idx<n; ++idx){
			cnt=this.counts[idx];
			amount=cnt.d.getTime()-now;//calc milliseconds between dates

			// if time is already past
			if(amount<0){
				expired.push(idx);
			}
			// date is still good
			else{
				this.display(cnt, this.format(this.math(amount)));
			}
		}

		// deal with any expired
		if(expired.length>0) this.expire(expired);

		// if no active counts, stop updating
		if(this.counts.length==0) window.clearTimeout(this.interval);
		
	},
	display: function(cnt,msg){
		document.getElementById(cnt.id).innerHTML=msg;
	}
};

window.onload=function(){
	var cdown = new CDown();

	cdown.add(new Date(2015,1,22,21,27,17), "countbox1");
};
</script>