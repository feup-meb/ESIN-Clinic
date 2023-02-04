<?php if (isset($_SESSION['message'])){ ?>
    <div class="alert <?=$_SESSION['message']['class']?>">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?=$_SESSION['message']['text']?>
    </div>
<?php unset($_SESSION['message']); } ?>