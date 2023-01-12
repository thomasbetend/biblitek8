<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\LikePostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: LikePostRepository::class)]
#[ApiResource(
    //security: "is_granted('ROLE_USER')",
)]
#[ApiFilter(SearchFilter::class, properties: [ 'postShare' => 'exact', 'user' => 'exact' ])]
//#[UniqueConstraint(['postShare', 'user'])]
class LikePost
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $total = null;

    #[ORM\ManyToOne(inversedBy: 'likePosts')]
    private ?PostShare $postShare = null;

    #[ORM\ManyToOne(inversedBy: 'likePosts')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLikesPerPostShare(): void
    {
    }
}
