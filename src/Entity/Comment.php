<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
#[ApiResource(
    //security: "is_granted('ROLE_USER')",
    normalizationContext: [ 'groups' => ['read_comment'] ],
    denormalizationContext: [ 'groups' => ['write_comment'] ],
)]
#[ApiFilter(SearchFilter::class, properties: [ 'post_share' => 'exact' ])]
class Comment
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read_comment', 'write_comment'])]
    private ?int $id = null;

    #[Groups(['read_comment', 'write_comment'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[Groups(['read_comment', 'write_comment'])]
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[Groups(['read_comment', 'write_comment'])]
    private ?PostShare $post_share = null;

    #[Groups(['read_comment', 'write_comment'])]
    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getPostShare(): ?PostShare
    {
        return $this->post_share;
    }

    public function setPostShare(?PostShare $post_share): self
    {
        $this->post_share = $post_share;

        return $this;
    }
}
