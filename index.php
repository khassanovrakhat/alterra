<?php
include 'assets/header.php';
require 'class/DB.php';
require 'class/Contact.php';
$db = new DB;
$contact = new Contact;

function validate_phone_number($phone)
{
    $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    $phone_to_check = str_replace("-", "", $filtered_phone_number);
    if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
    return false;
    } else {
    return true;
    }
}

if(isset($_POST['name'])&& isset($_POST['phone']) && validate_phone_number($_POST['phone'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $contact->addContact($name, $phone);
}
if(isset($_POST['id'])) {
    $id = htmlspecialchars(trim($_POST['id']));
    $contact->deleteContact($id);
}

?>
<body>
    <div class="main">
        <div class="add">
            <form id="formData" class="form" onsubmit="addContact()">
                <div class="head">
                    <span>Добавить контакт</span>
                </div>
                <hr>
                <div>
                    <input type="text"  name="name" id="name" placeholder="Имя" required="">
                </div>
                <div>
                    <input type="text" name="phone" id="phone" placeholder=" 8 --- --- ----" required="">
                </div>
                <div class="button">
                    <button class="" id="submit">Добавить</button>
                </div>  
            </form>
        </div>
        <div class="show">
            <div class="head_show">
                <span>Список контактов</span>
            </div>
            <hr>     
            <div class="head" id="show_contact"></div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/assets/mask/jquery.maskedinput.js"></script>
    <script type="text/javascript">
        function addContact(){
            if($("#formData")[0].checkValidity()){
                event.preventDefault();
                let name = $("#name").val();
                let phone = $("#phone").val();                 
                $.ajax({
                    type: "post",
                    data:  {name:name, phone:phone},
                    success: function(response) {
                        $("#show_contact").load('init.php');
                    }
                });
            }
        }
        $("body").on("click", ".delete",function(){
            let value = $(this).val();
            console.log(value);             
            $.ajax({
                type: "post",
                data:  {id:value},
                success: function(response) {
                    $("#show_contact").load('init.php');
                }
            });
        });
        $.get("init.php", function(data, status){
            $("#show_contact").html(data);
        });
        $("#phone").mask("8(999) 999-9999");
</script>
</body>
</html>
