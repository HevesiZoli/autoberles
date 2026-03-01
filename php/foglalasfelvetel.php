<h1>Foglalás felvétel</h1>
<?php
       //ha kapok id akkkor frissítem az adatokat így akkor szerkesztés van és nem kell a jelszó
       if (isset($_POST['id']))
       {
              echo('<form action="index.php?menupont=foglalasokfrissit" method="POST">
                       <input type="hidden" name="id" value="'.$_POST['id'].'">');
       }
       else
       {
              echo('<form action="index.php?menupont=foglalasokment" method="POST">');
       }
?>


<label><?php echo($foglalasok->hibauzenet); ?></label><br>
<label>Név:</label><br>
<input type="text" name="nev" value="<?php echo($foglalasok->nev); ?>"><br>
<label>E-mail:</label><br>
<input type="text" name="email" value="<?php echo($foglalasok->email); ?>"><br>
<label>Telefonszám:</label><br>
<input type="text" name="telefonszam" value="<?php echo($foglalasok->telefonszam); ?>"><br>
<label>Jármű:</label><br>
<select name="jarmu">
<?php
$SQLlekerdezes = "SELECT auto_id, marka, modell 
                  FROM autok 
                  WHERE deleted = 0";

$SQLeredmeny = mysqli_query($db_kapcsolat->_kapcsolat(), $SQLlekerdezes);

while ($row = mysqli_fetch_assoc($SQLeredmeny)) {

    echo '<option value="'.$row['auto_id'].'">'
            .$row['marka'].' '.$row['modell'].
         '</option>';
}
?>
</select><br>
<label>Kezdet:</label><br>
<input type="date" name="kezdet" value="<?php echo($foglalasok->kezdet); ?>"><br>
<label>Vége:</label><br>
<input type="date" name="vege" value="<?php echo($foglalasok->vege); ?>"><br>
<label>Létrehozva:</label><br>
<input type="date" name="letrehozva" value="<?php echo($foglalasok->letrehozva); ?>"><br>
<input type="submit" name="ok" value="Mentés"><br>
<a href="index.php?menupont=foglalasok">Mégsem</a> 
</form>