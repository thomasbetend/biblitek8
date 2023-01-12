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
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PostShareRepository::class)]
#[ApiResource(
    //security: "is_granted('ROLE_USER')",
    normalizationContext: [ 'groups' => 'read_postshare' ],
    denormalizationContext: [ 'groups' => 'write_postshare' ]
)]
#[ApiFilter(SearchFilter::class, properties: [ 'user' => 'exact' ])]
#[ApiFilter(OrderFilter::class, properties: [ 'date' => 'DESC'])]
class PostShare
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read_postshare', 'read_comment', 'write_postshare'])]
    private ?int $id = null;

    #[Groups(['read_postshare', 'write_postshare'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[Groups(['write_postshare'])]
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[Groups(['read_postshare', 'write_postshare'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'postShares')]
    #[Groups(['read_postshare', 'write_postshare'])]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'post_share', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'postShare', targetEntity: LikePost::class)]
    private Collection $likePosts;

    #[ORM\OneToMany(mappedBy: 'postShare', targetEntity: PostImage::class)]
    private Collection $postImages;


    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->likePosts = new ArrayCollection();
        $this->postImages = new ArrayCollection();
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
     * @return Collection<int, PostImage>
     */
    public function getPostImages(): Collection
    {
        return $this->postImages;
    }

    public function addPostImage(PostImage $postImage): self
    {
        if (!$this->postImages->contains($postImage)) {
            $this->postImages->add($postImage);
            $postImage->setPostShare($this);
        }

        return $this;
    }

    public function removePostImage(PostImage $postImage): self
    {
        if ($this->postImages->removeElement($postImage)) {
            // set the owning side to null (unless already changed)
            if ($postImage->getPostShare() === $this) {
                $postImage->setPostShare(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getDescription();
    }
}
