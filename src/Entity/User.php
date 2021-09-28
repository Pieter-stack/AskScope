<?php

namespace App\Entity;


class User{

    private $id;
    private $name;
    private $surname;


    public function getId() {return $this->id;}
    public function setId($id) {return $this->id = $id;}
    public function getName() {return $this->name;}
    public function setName($name) {return $this->name = $name;}
    public function getSurname() {return $this->surname;}
    public function setSurname($surname) {return $this->surname = $surname;}
    public function getEmail() {return $this->email;}
    public function setEmail($email) {return $this->email = $email;}



}


?>