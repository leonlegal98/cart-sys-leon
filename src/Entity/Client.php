<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addresses;

    /**
     * @ORM\Column(type="date")
     */
    private $birthDate;

    /**
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="client")
     */
    private $addresse;

    public function __construct()
    {
        $this->addresse = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
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

    public function getAddresses(): ?string
    {
        return $this->addresses;
    }

    public function setAddresses(string $addresses): self
    {
        $this->addresses = $addresses;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return Collection<int, Address>
     */
    public function getAddresse(): Collection
    {
        return $this->addresse;
    }

    public function addAddresse(Address $addresse): self
    {
        if (!$this->addresse->contains($addresse)) {
            $this->addresse[] = $addresse;
            $addresse->setClient($this);
        }

        return $this;
    }

    public function removeAddresse(Address $addresse): self
    {
        if ($this->addresse->removeElement($addresse)) {
            // set the owning side to null (unless already changed)
            if ($addresse->getClient() === $this) {
                $addresse->setClient(null);
            }
        }

        return $this;
    }
}
