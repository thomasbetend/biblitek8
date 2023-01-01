<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PostShareRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostShareRepository::class)]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: [ 'user' => 'exact' ])]
#[ApiFilter(OrderFilter::class, properties: [ 'date' => 'DESC'])]
class PostShare
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'postShares')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'post_share', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'postShare', targetEntity: LikePost::class)]
    private Collection $likePosts;

    #[ORM\OneToMany(mappedBy: 'postShare', targetEntity: PostLike2::class)]
    private Collection $postLike2s;

    #[ORM\OneToMany(mappedBy: 'postShare', targetEntity: PostLike3::class)]
    private Collection $postLike3s;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->likePosts = new ArrayCollection();
        $this->postLike2s = new ArrayCollection();
        $this->postLike3s = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setPostShare($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPostShare() === $this) {
                $comment->setPostShare(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LikePost>
     */
    public function getLikePosts(): Collection
    {
        return $this->likePosts;
    }

    public function addLikePost(LikePost $likePost): self
    {
        if (!$this->likePosts->contains($likePost)) {
            $this->likePosts->add($likePost);
            $likePost->setPostShare($this);
        }

        return $this;
    }

    public function removeLikePost(LikePost $likePost): self
    {
        if ($this->likePosts->removeElement($likePost)) {
            // set the owning side to null (unless already changed)
            if ($likePost->getPostShare() === $this) {
                $likePost->setPostShare(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PostLike2>
     */
    public function getPostLike2s(): Collection
    {
        return $this->postLike2s;
    }

    public function addPostLike2(PostLike2 $postLike2): self
    {
        if (!$this->postLike2s->contains($postLike2)) {
            $this->postLike2s->add($postLike2);
            $postLike2->setPostShare($this);
        }

        return $this;
    }

    public function removePostLike2(PostLike2 $postLike2): self
    {
        if ($this->postLike2s->removeElement($postLike2)) {
            // set the owning side to null (unless already changed)
            if ($postLike2->getPostShare() === $this) {
                $postLike2->setPostShare(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PostLike3>
     */
    public function getPostLike3s(): Collection
    {
        return $this->postLike3s;
    }

    public function addPostLike3(PostLike3 $postLike3): self
    {
        if (!$this->postLike3s->contains($postLike3)) {
            $this->postLike3s->add($postLike3);
            $postLike3->setPostShare($this);
        }

        return $this;
    }

    public function removePostLike3(PostLike3 $postLike3): self
    {
        if ($this->postLike3s->removeElement($postLike3)) {
            // set the owning side to null (unless already changed)
            if ($postLike3->getPostShare() === $this) {
                $postLike3->setPostShare(null);
            }
        }

        return $this;
    }
}
