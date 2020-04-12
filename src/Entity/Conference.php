<?php
declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 */
class Conference
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $city = null;

    /**
     * @ORM\Column(type="string", nullable=true, length=4)
     */
    private ?string $year = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isInternational = false;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="conference", orphanRemoval=true)
     */
    private Collection $comments;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
        $this->comments = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->city . ' (' . $this->year . ')';
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): void
    {
        $this->year = $year;
    }

    public function isInternational(): bool
    {
        return $this->isInternational;
    }

    public function setIsInternational(bool $isInternational): void
    {
        $this->isInternational = $isInternational;
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): void
    {
        if(!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setConference($this);
        }
    }

    public function removeComment(Comment $comment): void
    {
        if($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            if($comment->getConference() === $this) {
                $comment->setConference(null);
            }
        }
    }
}

