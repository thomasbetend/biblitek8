<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\LikePostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LikePostRepository::class)]
#[ApiResource(
    //security: "is_granted('ROLE_USER')",
    denormalizationContext: ['groups' => 'write_likepost'],
    normalizationContext: ['groups' => 'read_likepost']
)]
#[GetCollection()]
#[Get()]
#[Post()]
#[Delete()]
#[Put(denormalizationContext: ['groups' => ['put_write_likepost']])]
#[ApiFilter(SearchFilter::class, properties: [ 'postShare' => 'exact', 'user' => 'exact' ])]
//#[UniqueConstraint(['postShare', 'user'])]
class LikePost
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read_likepost', 'write_likepost', 'put_write_likepost'])]
    private ?int $id = null;

    #[Groups(['read_likepost', 'write_likepost', 'put_write_likepost'])]
    #[ORM\Column(nullable: true)]
    private ?int $total = null;

    #[Groups(['read_likepost', 'write_likepost'])]
    #[ORM\ManyToOne(inversedBy: 'likePosts')]
    private ?PostShare $postShare = null;

    #[Groups(['read_likepost', 'write_likepost'])]
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
