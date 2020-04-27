<?php


namespace Model;


class Territory extends \Model
{
    public function getRegions()
    {
        return $this->db->query("
            SELECT * FROM t_koatuu_tree 
            WHERE ter_type_id = 0
        ")->fetchAll();
    }

    public function getAreasByCityId($cityId)
    {
        return $this->db->query("
            SELECT * FROM t_koatuu_tree 
            WHERE ter_pid = " . (int)$cityId . " 
            AND ter_type_id = 3
        ")->fetchAll();
    }

    public function getCitiesByRegionId($regionId)
    {
        return $this->db->query("
            SELECT * FROM t_koatuu_tree 
            WHERE reg_id = " . (int)$regionId . "
            AND ter_type_id = 1
        ")->fetchAll();
    }
}