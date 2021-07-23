<?php
require 'class/DB.php';
require 'class/Contact.php';
$db = new DB;
$contact = new Contact;
$contacts = $contact->getContact();
$output = "";
if(!empty($contacts)){ 
    foreach ($contacts as $key => $value) {  
        $resut = formatPhoneNumber($value->phone);
        $output .= "<p class='name'> {$value->full_name}
         <button type='button' class='delete' value='{$value->id}' >x</button>
         </p>
         <p class='phone'>$resut</p>
         <hr>";
    } 
}
function formatPhoneNumber($phoneNumber) {
    $phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);
    if(strlen($phoneNumber) > 10) {
        $countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
        $areaCode = substr($phoneNumber, -10, 3);
        $nextThree = substr($phoneNumber, -7, 3);
        $lastFour = substr($phoneNumber, -4, 4);

        $phoneNumber = $countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($phoneNumber) == 10) {
        $areaCode = substr($phoneNumber, 0, 3);
        $nextThree = substr($phoneNumber, 3, 3);
        $lastFour = substr($phoneNumber, 6, 4);

        $phoneNumber = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($phoneNumber) == 7) {
        $nextThree = substr($phoneNumber, 0, 3);
        $lastFour = substr($phoneNumber, 3, 4);
        $phoneNumber = $nextThree.'-'.$lastFour;
    }
    return $phoneNumber;
}
echo $output;