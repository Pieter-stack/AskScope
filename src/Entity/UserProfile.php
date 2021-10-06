<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity(repositoryClass="App\Repository\DefaultRepository")
 */


class UserProfile implements UserInterface{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */
    private $name;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */
    private $surname;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */
    private $email;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */
    private $password;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */
    private $profileUrl;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */
    private $rep;

    /**
    * @ORM\Column(type="integer", length=255, nullable=true)
    */
    private $access;


    public function getId(): ?int
{
    return $this->id;
}

public function getName(): ?string
{
    return $this->name;
}

public function setName(?string $name): self
{
    $this->name = $name;

    return $this;
}

public function getSurname(): ?string
{
    return $this->surname;
}

public function setSurname(?string $surname): self
{
    $this->surname = $surname;

    return $this;
}

public function getEmail(): ?string
{
    return $this->email;
}

public function setEmail(?string $email): self
{
    $this->email = $email;

    return $this;
}

public function getPassword(): ?string
{
    return $this->password;
}

public function setPassword(?string $password): self
{
    $this->password = $password;

    return $this;
}

public function getProfileUrl(): ?string
{
    return $this->profileUrl;
}

public function setProfileUrl(?string $profileUrl): self
{
    $this->profileUrl = $profileUrl;

    return $this;
}


public function getRep(): ?string
{
    return $this->rep;
}

public function setRep(?string $rep): self
{
    $this->rep = $rep;

    return $this;
}

public function getAccess(): ?string
{
    return $this->access;
}

public function setAccess(?string $access): self
{
    $this->access = $access;

    return $this;
}

public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }


    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    public function getUsername()
    {
    }









}


?>