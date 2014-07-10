<?php

class Model_Events extends Model
{

    private  $_table = "events";
    private $_sub_table = "event_status";

	public function get_all_events($status = true)
	{
        if($status){
            $result = $this->db->sql("SELECT ev.*, evs.estatus_name FROM `{$this->_table}` as ev
                                        LEFT JOIN `event_status` as evs
                                        ON ev.event_status = evs.estatus_id
                                        WHERE `event_status` > -1");

            if(!$result){
                $result['msg'] = 'Событий  не существует';
            }
            return  $result;
        }else{
            $result = $this->db->sql("SELECT * FROM `{$this->_sub_table}`");

            if(!$result){
                $result['msg'] = 'Статусов для событий  не существует';
            }
            return  $result;
        }
    }
    public function get_event_by_id($id){
        $result = $this->db->sql("SELECT * FROM `{$this->_table}` WHERE `event_id` = $id ");
        if(!$result){
            $result['msg'] = 'Событий  не существует';
        }
        return  $result;
    }




}
