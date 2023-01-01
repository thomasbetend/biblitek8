<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PostLike2Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostLike2Repository::class)]
#[ApiFilter(SearchFilter::class, properties: [ 'post_share' => 'exact' ])]
class PostLike2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $total = null;

    #[ORM\ManyToOne(inversedBy: 'postLike2s')]
    private ?PostShare $postShare = null;

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
}
