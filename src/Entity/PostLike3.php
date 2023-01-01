<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PostLike3Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostLike3Repository::class)]
#[ApiFilter(SearchFilter::class, properties: [ 'postShare' => 'exact' ])]
class PostLike3
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $total = null;

    #[ORM\ManyToOne(inversedBy: 'postLike3s')]
    private ?PostShare $postShare = null;

    #[ORM\ManyToOne(inversedBy: 'postLike3s')]
    private ?User $user = null;

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

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getPostShare(): ?PostShare
    {
        return $this->postShare;
    }

    public function setPostShare(?PostShare $postShare): self
    {
        $this->postShare = $postShare;

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
