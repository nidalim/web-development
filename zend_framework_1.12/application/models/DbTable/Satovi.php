<?php

class Application_Model_DbTable_Satovi extends Zend_Db_Table_Abstract {

    protected $_name = 'satovi';

    public function getSatovi($id) {
        $id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addSatovi($model, $brend, $slika, $cena, $opis) {
        $data = array(
            'model' => $model,
            'brend' => $brend,
            'slika' => $slika,
            'cena' => $cena,
            'opis' => $opis,
        );
        $this->insert($data);
    }

    public function updateSatovi($id, $model, $brend, $slika, $cena, $opis) {
        $data = array(
            'model' => $model,
            'brend' => $brend,
            'slika' => $slika,
            'cena' => $cena,
            'opis' => $opis,
        );
        $this->update($data, 'id = ' . (int) $id);
    }

    public function deleteSatovi($id) {
        $this->delete('id =' . (int) $id);
    }

}
