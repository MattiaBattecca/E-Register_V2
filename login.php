<?php
include('template/template_header.php');
include('dal.php');

?>


<div class="container centered" id="Cerca">
    <h2>Log-in</h2>
<form method="post" action="login_act.php">
<p> 
    <label>Username</label><br>
    <input name="username" id="username" placeholder="Inserisci il tuo username..."><br>
</p> 
    <p> 
    <label>Password</label><br>
    <input name="password" id="password" placeholder="Inserisci la tua password..." type="password"><br></p> 
    <p><p><input type="submit" class="btn" value="Entra con le credenziali"></p> </p> 
</form>
</div>


<?php
include('template/template_footer.php');

?>