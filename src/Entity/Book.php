<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $authors = null;

    #[ORM\Column(length: 255)]
    private ?string $genders = null;

    #[ORM\Column(length: 255)]
    private ?string $publisher = null;

    #[ORM\Column]
    private ?bool $national = null;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTime $created_at = null;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTime $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int|string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthors(): ?string
    {
        return $this->authors;
    }

    public function setAuthors(string $authors): static
    {
        $this->authors = $authors;

        return $this;
    }

    public function getGenders(): ?string
    {
        return $this->genders;
    }

    public function setGenders(string $genders): static
    {
        $this->genders = $genders;

        return $this;
    }

    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    public function setPublisher(string $publisher): static
    {
        $this->publisher = $publisher;

        return $this;
    }

    public function isNational(): ?bool
    {
        return $this->national;
    }

    public function setNational(bool $national): static
    {
        $this->national = $national;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
