<?php

require_once dirname(dirname(__FILE__)) . '/models/Representers.php';

class RepresentorController {

    public function createRepresentor(int $firm_id, string $name, string $surname, string $email, string $tel) {
        $Representer = new Representers();
        $Representer->setFirmId($firm_id);
        $Representer->setName($name);
        $Representer->setSurname($surname);
        $Representer->setEmail($email);
        $Representer->setTel($tel);
        $represenor_id = $Representer->insertObject();
        return $represenor_id;
    }

}