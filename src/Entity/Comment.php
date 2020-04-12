<?php
declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Conference", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private Conference $conference;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $author = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $text = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $photoFilename = null;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $createdAt;

    public function __construct($id)
    {
        $this->id = $id;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getConference(): Conference
    {
        return $this->conference;
    }

    public function setConference(?Conference $conference): void
    {
        $this->conference = $conference;
    }

}
