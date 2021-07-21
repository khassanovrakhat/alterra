<?php
class Contact{
    public function addContact($name, $phone){
        $db = new DB;
        $sql = $db->insert("INSERT INTO contact (`full_name`, `phone`) VALUES('$name','$phone')");
        return $sql;
    }
    public function getContact(){
        $db = new DB;
        $get = $db->select("SELECT id, full_name, phone FROM contact");
        return $get;
    }
    public function deleteContact($id){
        $db = new DB;
        $delete = $db->delete("DELETE FROM contact WHERE id = $id");
        return $delete;
    }
}