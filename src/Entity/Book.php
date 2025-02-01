<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ ORM\Entity( repositoryClass: BookRepository::class ) ]

class Book {
    #[ ORM\Id ]
    #[ ORM\GeneratedValue ]
    #[ ORM\Column ]
    private ?int $id = null;

    #[ ORM\Column( length: 255 ) ]
    #[ Assert\NotBlank ]
    private ?string $title = null;

    #[ ORM\Column( length: 255 ) ]
    #[ Assert\NotBlank ]
    private ?string $author = null;

    #[ ORM\Column( type: 'text', nullable: true ) ]
    private ?string $description = null;

    #[ ORM\Column ]
    #[ Assert\NotNull ]
    private ?int $year = null;

    // Getters e Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle( string $title ): self {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string {
        return $this->author;
    }

    public function setAuthor( string $author ): self {
        $this->author = $author;

        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription( ?string $description ): self {
        $this->description = $description;

        return $this;
    }

    public function getYear(): ?int {
        return $this->year;
    }

    public function setYear( int $year ): self {
        $this->year = $year;

        return $this;
    }
}
