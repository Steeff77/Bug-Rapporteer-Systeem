<?php
   $servername = "localhost";
   $username = "";
   $password = "";
   $database = "";
   
   // Create connection
   $conn = new mysqli($servername, $username, $password, $database);
   
   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   } 
   ?>
<!DOCTYPE html>
<html lang="nl">
   <head>
      <meta charset="utf-8">
      <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
      <title>Rapporteer een bug</title>
      <link href="global.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div id="heading">
         <div class="inlinePadding">
            <h1>Bug melden</h1>
         </div>
      </div>
      <div id="left">
         <div class="inlinePadding">
            <?php
               if(isset($_POST['submit'])){
                   $bugname = $conn->real_escape_string($_POST['bugname']);
                   $naam = $conn->real_escape_string($_POST['name']);
                   $email = $conn->real_escape_string($_POST['email']);
                   $type = $conn->real_escape_string($_POST['type']);
                   $screen = $conn->real_escape_string($_POST['screen']);
                   $info = $conn->real_escape_string($_POST['info']); 
               
                   if(!empty($bugname) && !empty($naam) && !empty($email) && !empty($type) && !empty($screen) && !empty($info)){
               
                       // Als de tabellen niet leeg zijn
               
                       $conn->query("INSERT INTO bug (bugname,name,email,type,screen,info) VALUES ('$bugname', '$naam','$email','$type','$screen','$info') ")or die(mysqli_error($conn));
                       
                       echo '<div class="succes">Bug succesvol verzonden</div>';
               
                       header('Refresh: 2');
               
               
               
                   }else{
               
                       // Error als niet alle velden zijn ingevuld
               
                       echo 'Je moet alle velden in vullen';
               
                   }
               
               } 
               ?>
            <div class="succes">
               Geef hieronder jouw bug op
            </div>
            <div class="boxContent">
               <form action method="post">
                  <div class="placehold">Naam</div>
                  <input type="text" name="name" required="required" placeholder="Vul hier jouw naam in"><br>
                  <div class="placehold">E-mail</div>
                  <input type="text" name="email" required="required" placeholder="Vul hier jouw E-mailadres in"><br>
                  <div class="placehold">Bug naam</div>
                  <input type="text" name="bugname" required="required" placeholder="Vul hier een naam van de bug in"><br>
                  <div class="placehold">Type bug</div>
                  <input type="text" name="type" required="required" placeholder="Vul hier jouw type bug in"><br>
                  <div class="placehold">Screen</div>
                  <input type="text" required="required" name="screen" placeholder="Vul hier jouw link van de screen in"><br>
                  <textarea rows="4" required="required" cols="50" name="info" placeholder="Geef hier jouw extra informatie op"></textarea>
                  <input type="submit" name="submit">
               </form>
            </div>
         </div>
      </div>
      <div id="right">
         <div class="inlinePadding">
            <?php
               $d = $conn->query("select * from bug order by id desc limit 1");
               $r = $d->fetch_object();
               ?>
            <div class="succes">
               Op dit moment zijn er <strong><?php echo $r->id; ?></strong> bugs gemeld.
            </div>
            <?php
               $data = $conn->query("SELECT * FROM bug ORDER BY id DESC");
                   if(mysqli_num_rows($data) > 0){
                       while($row = $data->fetch_object()){
               ?>
            <div class="boxBugShow">
               <div class="leftSide">
                  <div class="inlineShow">
                     <strong>Ingediend door:</strong> <br/><?= $row->name; ?><br/><br/>
                     <strong>Type bug:</strong><br/><?= $row->type; ?><br/><br/>
                     <strong>Screen:</strong><br/><a href="<?= $row->screen; ?>">Klik hier voor de screen</a><br/><br/>
                     <strong>Status:</strong><br/>
                     <?= $row->status; ?>
                  </div>
               </div>
               <div class="rightSide">
                  <div class="inlineShow">
                     <strong>Naam bug:</strong><br/><?= $row->bugname; ?><br/><br/>
                     <strong>Extra informatie:</strong><br/>
                     <?= $row->info; ?>
                  </div>
               </div>
            </div>
            <?php
               }
               }
               ?>
         </div>
      </div>
   </body>
</html>
