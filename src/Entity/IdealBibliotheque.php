<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\IdealBibliothequeRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Unique;

#[ORM\Entity(repositoryClass: IdealBibliothequeRepository::class)]
#[ApiResource(
    //security: "is_granted('ROLE_USER')",
    normalizationContext: [ 'groups' => 'read_ideal_biblioteque' ],
    denormalizationContext: [ 'groups' => ['write_ideal_biblioteque']]
)]
#[ApiFilter(SearchFilter::class, properties: [ 'user' => 'exact' ])]
class IdealBibliotheque
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read_ideal_biblioteque', 'write_ideal_biblioteque'])]
    private ?int $id = null;

    #[Groups(['read_ideal_biblioteque', 'write_ideal_biblioteque'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $book1 = null;

    #[Groups(['read_ideal_biblioteque', 'write_ideal_biblioteque'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $book2 = null;

    #[Groups(['read_ideal_biblioteque', 'write_ideal_biblioteque'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $book3 = null;

    #[Groups(['read_ideal_biblioteque', 'write_ideal_biblioteque'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $book4 = null;

    #[Groups(['read_ideal_biblioteque', 'write_ideal_biblioteque'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $book5 = null;

    #[Groups(['read_ideal_biblioteque', 'write_ideal_biblioteque'])]
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $user = null;

/*     #[Groups(['read_ideal_biblioteque'])]
    #[ORM\ManyToOne(inversedBy: 'idealBibliotheques')]
    private ?User $user = null; */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBook1(): ?string
    {
        return $this->book1;
    }

    public function setBook1(?string $book1): self
    {
        $this->book1 = $book1;

        return $this;
    }

    public function getBook2(): ?string
    {
        return $this->book2;
    }

    public function setBook2(?string $book2): self
    {
        $this->book2 = $book2;

        return $this;
    }

    public function getBook3(): ?string
    {
        return $this->book3;
    }

    public function setBook3(?string $book3): self
    {
        $this->book3 = $book3;

        return $this;
    }

    public function getBook4(): ?string
    {
        return $this->book4;
    }

    public function setBook4(?string $book4): self
    {
        $this->book4 = $book4;

        return $this;
    }

    public function getBook5(): ?string
    {
        return $this->book5;
    }

    public function setBook5(?string $book5): self
    {
        $this->book5 = $book5;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
