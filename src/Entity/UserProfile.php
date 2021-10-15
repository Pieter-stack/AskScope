<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    * @ORM\Column(type="integer", length=255, name="rep", nullable=false,options={"default" : 1000})
    */
    private $rep = 1000;

    /**
    * @ORM\Column(type="integer" , length=255, name="access", nullable=false, options={"default" : 0})
    */
    private $access = 0;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="user_id")
     */
    private $questions;


    public function __construct()
    {
        $this->question = new ArrayCollection();
        $this->questions = new ArrayCollection();
    }


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
        return $this->name;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setUserId($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getUserId() === $this) {
                $question->setUserId(null);
            }
        }

        return $this;
    }







}


?>