<?php

use polarisapi\data\Entite;

?>


<?php 
if($confirm){
?>



<?php
}else{
?>

<input type="hidden" name="valid" value="1">

<div class="editItem">
    <div class="label">Date</div>
    <div class="form">
        <input type="text" name="date">
    </div>
</div>
<div class="editItem">
    <div class="label">Entrée du journal</div>
    <div class="form">
        <textarea name="journal"></textarea>
    </div>
</div>



<?php } ?>
