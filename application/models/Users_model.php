<?php

class Users_model extends CI_Model  
{
    public static $table = "users"; 

    public function insert_entry($data)
    {
        
        $this->name = $data['name'];
        $this->surname = $data['surname'];
        $this->id_number = $data['id_number'];
        $this->email = $data['email'];
        $this->gender = $data['gender'];
        $this->password = password_hash($data['password'], PASSWORD_DEFAULT);

        if(count($this->get_entry($data)))
        {
            return null;
        }
        $this->db->insert("users", $this);
        $this->id = $this->db->insert_id();
        return $this;
    }

    public function get_entry($data)
    {
        $query = $this->db->where('email', $data['email'])->get("users");
        return $query->result();
    }

    public function update_will($id, $will)
    {
        if($id != '')
        {
            $value = array('will' => $will);
            $this->db->where('id', $id);
            $this->db->update('users', $value);
            return true;
        }
        return false;
    }

    public function update_token($id, $token)
    {
        if($id != '')
        {
            $value = array('expo_token' => $token);
            $this->db->where('id', $id)->update('users', $value);
            return true;
        }
        return false;
    }
}