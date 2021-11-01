<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $questionText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $questionImg;

    /**
     * @ORM\Column(type="integer", nullable=false,options={"default" : 0})
     */
    private $upvotes = 0;

    /**
     * @ORM\Column(type="integer", nullable=false,options={"default" : 0})
     */
    private $downvotes = 0;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=UserProfile::class, inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="question_id")
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionText(): ?string
    {
        return $this->questionText;
    }

    public function setQuestionText(string $questionText): self
    {
        $this->questionText = $questionText;

        return $this;
    }

    public function getQuestionImg(): ?string
    {
        return $this->questionImg;
    }

    public function setQuestionImg(?string $questionImg): self
    {
        $this->questionImg = $questionImg;

        return $this;
    }

    public function getUpvotes(): ?int
    {
        return $this->upvotes;
    }

    public function setUpvotes(int $upvotes): self
    {
        $this->upvotes = $upvotes;

        return $this;
    }

    public function getDownvotes(): ?int
    {
        return $this->downvotes;
    }

    public function setDownvotes(int $downvotes): self
    {
        $this->downvotes = $downvotes;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUserId(): ?UserProfile
    {
        return $this->user_id;
    }



    public function setUserId(?UserProfile $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setQuestionId($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getQuestionId() === $this) {
                $comment->setQuestionId(null);
            }
        }

        return $this;
    }
}
