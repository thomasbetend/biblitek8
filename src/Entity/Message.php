<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter as FilterOrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['read_message']],
    denormalizationContext: ['groups' => ['write_message']]
)]
#[ApiFilter(SearchFilter::class, properties: [ 'conversation' => 'exact', 'user' => 'exact' ])]
#[ApiFilter(FilterOrderFilter::class, properties: [ 'date' => 'ASC'])]
#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{    
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read_message', 'write_message'])]
    private ?int $id = null;

    #[Groups(['read_message', 'write_message'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[Groups(['read_message', 'write_message'])]
    #[ORM\ManyToOne(inversedBy: 'messages', cascade: ['persist'])]
    private ?User $user = null;

    #[Groups(['read_message', 'write_message'])]
    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?Conversation $conversation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getConversation(): ?Conversation
    {
        return $this->conversation;
    }

    public function setConversation(?Conversation $conversation): self
    {
        $this->conversation = $conversation;

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
}
