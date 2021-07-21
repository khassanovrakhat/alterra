<?php
require 'class/DB.php';
require 'class/Contact.php';
$db = new DB;
$contact = new Contact;
if(isset($_POST['name'])&& isset($_POST['phone'])) {
    $contact->addContact($_POST['name'], $_POST['phone']);
}
if(isset($_POST['id'])) {
    $contact->deleteContact($_POST['id']);
}
$contacts = $contact->getContact();
include 'assets/header.php';
?>
<body>
    <div class="main">
        <div class="add">
            <form id="formData" action="" class="form">
                <div class="head">
                    <span>Добавить контакт</span>
                </div>
                <hr>
                <div>
                    <input type="text"  name="name" id="name" placeholder="Имя" required="">
                </div>
                <div>
                    <input type="text" name="phone" id="phone" placeholder="Телефон" required="">
                </div>
                <div class="button">
                    <button type="submit" class="" id="submit">Добавить</button>
                </div>  
            </form>
        </div>
        <div class="show">
            <div class="head_show">
                <span>Список контактов</span>
            </div>
            <hr>
            <?php if(!empty($contacts)){ ?>
                <?php foreach ($contacts as $key => $value) {?>            
                <div class="head">
                    <p class="name"><?=$value->full_name;?>
                        <button type="submit" class="delete"  value="<?=$value->id;?>">x</button>
                    </p>
                    <p class="phone"><?=$value->phone;?></p>
                </div>
                <hr>
                <?php } ?>
            <?php } ?>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#submit").click(function(){
                if ($("#formData")[0].checkValidity()) {
                    let name = $("#name").val();
                    let phone = $("#phone").val(); 
                              
                    $.ajax({
                        type: "post",
                        data:  {name:name, phone:phone},
                        success: function(response) {
                            location.reload();
                        }
                    });
                }
            });
            $(".delete").click(function(){
                    let value = $(this).val();
                    console.log(value);             
                    $.ajax({
                        type: "post",
                        data:  {id:value},
                        success: function(response) {
                            location.reload();
                        }
                    });
            });
        }); 
</script>
</body>
</html>
