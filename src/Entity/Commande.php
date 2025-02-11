<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_commande = null;

    #[ORM\Column(length: 255)]
    private ?string $total = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_paiement = null;

    #[ORM\Column(length: 100)]
    private ?string $methode_paiement = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse_livraison = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse_facture = null;

    #[ORM\Column(length: 50)]
    private ?string $statut_paiemet = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private ?string $etat = null;

    #[ORM\Column(length: 255)]
    private ?string $coefficient = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $users = null;

    /**
     * @var Collection<int, BonLivraison>
     */
    #[ORM\OneToMany(targetEntity: BonLivraison::class, mappedBy: 'commande')]
    private Collection $bonLivraisons;

    /**
     * @var Collection<int, Livraison>
     */
    #[ORM\OneToMany(targetEntity: Livraison::class, mappedBy: 'commande')]
    private Collection $livraisons;

    public function __construct()
    {
        $this->bonLivraisons = new ArrayCollection();
        $this->livraisons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(\DateTimeInterface $date_commande): static
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->date_paiement;
    }

    public function setDatePaiement(\DateTimeInterface $date_paiement): static
    {
        $this->date_paiement = $date_paiement;

        return $this;
    }

    public function getMethodePaiement(): ?string
    {
        return $this->methode_paiement;
    }

    public function setMethodePaiement(string $methode_paiement): static
    {
        $this->methode_paiement = $methode_paiement;

        return $this;
    }

    public function getAdresseLivraison(): ?string
    {
        return $this->adresse_livraison;
    }

    public function setAdresseLivraison(string $adresse_livraison): static
    {
        $this->adresse_livraison = $adresse_livraison;

        return $this;
    }

    public function getAdresseFacture(): ?string
    {
        return $this->adresse_facture;
    }

    public function setAdresseFacture(string $adresse_facture): static
    {
        $this->adresse_facture = $adresse_facture;

        return $this;
    }

    public function getStatutPaiemet(): ?string
    {
        return $this->statut_paiemet;
    }

    public function setStatutPaiemet(string $statut_paiemet): static
    {
        $this->statut_paiemet = $statut_paiemet;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCoefficient(): ?string
    {
        return $this->coefficient;
    }

    public function setCoefficient(string $coefficient): static
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection<int, BonLivraison>
     */
    public function getBonLivraisons(): Collection
    {
        return $this->bonLivraisons;
    }

    public function addBonLivraison(BonLivraison $bonLivraison): static
    {
        if (!$this->bonLivraisons->contains($bonLivraison)) {
            $this->bonLivraisons->add($bonLivraison);
            $bonLivraison->setCommande($this);
        }

        return $this;
    }

    public function removeBonLivraison(BonLivraison $bonLivraison): static
    {
        if ($this->bonLivraisons->removeElement($bonLivraison)) {
            // set the owning side to null (unless already changed)
            if ($bonLivraison->getCommande() === $this) {
                $bonLivraison->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Livraison>
     */
    public function getLivraisons(): Collection
    {
        return $this->livraisons;
    }

    public function addLivraison(Livraison $livraison): static
    {
        if (!$this->livraisons->contains($livraison)) {
            $this->livraisons->add($livraison);
            $livraison->setCommande($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): static
    {
        if ($this->livraisons->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getCommande() === $this) {
                $livraison->setCommande(null);
            }
        }

        return $this;
    }
}
