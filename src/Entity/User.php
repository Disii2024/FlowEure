<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use Symfony\Component\Serializer\Serializer;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[Vich\Uploadable]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface, \Serializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $avatar = null;

    #[Vich\UploadableField(mapping: 'avatars', fileNameProperty: 'avatar')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Commande::class)]
    private Collection $commandes;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: DetailCommande::class)]
    private Collection $detailCommandes;

    #[ORM\Column]
    private ?bool $isActif = null;

    #[ORM\OneToMany(mappedBy: 'auteur', targetEntity: Commentaire::class)]
    private Collection $commentaires;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->detailCommandes = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
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

    public function setRoles(array $roles): static
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

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }


    public function serialize() {

        return serialize(array(
        $this->id,
        $this->email,
        $this->password,
        ));

}

public function unserialize($serialized) {

    list (
    $this->id,
    $this->email,
    $this->password,
    ) = unserialize($serialized);
    }

/**
 * @return Collection<int, Commande>
 */
public function getCommandes(): Collection
{
    return $this->commandes;
}

public function addCommande(Commande $commande): static
{
    if (!$this->commandes->contains($commande)) {
        $this->commandes->add($commande);
        $commande->setUtilisateur($this);
    }

    return $this;
}

public function removeCommande(Commande $commande): static
{
    if ($this->commandes->removeElement($commande)) {
        // set the owning side to null (unless already changed)
        if ($commande->getUtilisateur() === $this) {
            $commande->setUtilisateur(null);
        }
    }

    return $this;
}

/**
 * @return Collection<int, DetailCommande>
 */
public function getDetailCommandes(): Collection
{
    return $this->detailCommandes;
}

public function addDetailCommande(DetailCommande $detailCommande): static
{
    if (!$this->detailCommandes->contains($detailCommande)) {
        $this->detailCommandes->add($detailCommande);
        $detailCommande->setUser($this);
    }

    return $this;
}

public function removeDetailCommande(DetailCommande $detailCommande): static
{
    if ($this->detailCommandes->removeElement($detailCommande)) {
        // set the owning side to null (unless already changed)
        if ($detailCommande->getUser() === $this) {
            $detailCommande->setUser(null);
        }
    }

    return $this;
}
public function isIsActif(): ?bool
{
    return $this->isActif;
}

public function setIsActif(bool $isActif): static
{
    $this->isActif = $isActif;

    return $this;
}


public function __toString()  {
    return $this->pseudo;
}

/**
 * @return Collection<int, Commentaire>
 */
public function getCommentaires(): Collection
{
    return $this->commentaires;
}

public function addCommentaire(Commentaire $commentaire): static
{
    if (!$this->commentaires->contains($commentaire)) {
        $this->commentaires->add($commentaire);
        $commentaire->setAuteur($this);
    }

    return $this;
}

public function removeCommentaire(Commentaire $commentaire): static
{
    if ($this->commentaires->removeElement($commentaire)) {
        // set the owning side to null (unless already changed)
        if ($commentaire->getAuteur() === $this) {
            $commentaire->setAuteur(null);
        }
    }

    return $this;
}


}