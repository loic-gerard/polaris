<?php if (isset($_GET['custompopup'])) { ?>
    <div id="attributModifierMask">
    </div>
    <div id="customWindow">
        <div class="content">
            <?php include ROOT . $_GET['custompopup']; ?>
        </div>
    </div>

<?php } ?>