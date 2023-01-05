<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\MeAction;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    security: "is_granted('ROLE_ADMIN')", 
    operations:[
        new Get(),
        new GetCollection(),
        new Post(
            security: "is_granted('IS_AUTHENTICATED_ANONYMOUSLY') or is_granted('ROLE_ADMIN')"
        ),
        new Put(
            security: "is_granted('ROLE_USER')",
        ),
        new Delete(),
        new Get(
            uriTemplate: "/me",
            controller: MeAction::class,
            read: false,
            security: "is_granted('ROLE_USER')",
        )
        ],
    )
]
#[ApiResource(
    denormalizationContext: [ 'groups' => 'write_user' ]
)]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read_postshare', 'read_comment', 'read_ideal_bibliotek'])]
    private ?int $id = null;

    #[Groups(['write_user'])]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Groups(['write_user'])]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: PostShare::class)]
    private Collection $postShares;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read_postshare', 'read_comment', 'write_user'])]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read_postshare', 'read_comment'])]
    private ?string $avatar = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: IdealBibliotheque::class)]
    private Collection $idealBibliotheques;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: LikePost::class)]
    private Collection $likePosts;

    public function __construct()
    {
        $this->postShares = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->idealBibliotheques = new ArrayCollection();
        $this->likePosts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, PostShare>
     */
    public function getPostShares(): Collection
    {
        return $this->postShares;
    }

    public function addPostShare(PostShare $postShare): self
    {
        if (!$this->postShares->contains($postShare)) {
            $this->postShares->add($postShare);
            $postShare->setUser($this);
        }

        return $this;
    }

    public function removePostShare(PostShare $postShare): self
    {
        if ($this->postShares->removeElement($postShare)) {
            // set the owning side to null (unless already changed)
            if ($postShare->getUser() === $this) {
                $postShare->setUser(null);
            }
        }

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
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection<int, IdealBibliotheque>
     */
    public function getIdealBibliotheques(): Collection
    {
        return $this->idealBibliotheques;
    }

    public function addIdealBibliotheque(IdealBibliotheque $idealBibliotheque): self
    {
        if (!$this->idealBibliotheques->contains($idealBibliotheque)) {
            $this->idealBibliotheques->add($idealBibliotheque);
            $idealBibliotheque->setUser($this);
        }

        return $this;
    }

    public function removeIdealBibliotheque(IdealBibliotheque $idealBibliotheque): self
    {
        if ($this->idealBibliotheques->removeElement($idealBibliotheque)) {
            // set the owning side to null (unless already changed)
            if ($idealBibliotheque->getUser() === $this) {
                $idealBibliotheque->setUser(null);
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
            $likePost->setUser($this);
        }

        return $this;
    }

    public function removeLikePost(LikePost $likePost): self
    {
        if ($this->likePosts->removeElement($likePost)) {
            // set the owning side to null (unless already changed)
            if ($likePost->getUser() === $this) {
                $likePost->setUser(null);
            }
        }

        return $this;
    }
}
