<?php

namespace App\Entity;

use App\Repository\EquipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipoRepository::class)]
class Equipo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $nombreEquipo = null;

    #[ORM\Column]
    private ?float $presupuesto = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaFunda = null;

    #[ORM\ManyToOne(inversedBy: 'listaEquipos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Zona $zona = null;

    #[ORM\OneToMany(mappedBy: 'equipo', targetEntity: Jugador::class)]
    private Collection $listaJugadores;

    public function __construct()
    {
        $this->listaJugadores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreEquipo(): ?string
    {
        return $this->nombreEquipo;
    }

    public function setNombreEquipo(string $nombreEquipo): static
    {
        $this->nombreEquipo = $nombreEquipo;

        return $this;
    }

    public function getPresupuesto(): ?float
    {
        return $this->presupuesto;
    }

    public function setPresupuesto(float $presupuesto): static
    {
        $this->presupuesto = $presupuesto;

        return $this;
    }

    public function getFechaFunda(): ?\DateTimeInterface
    {
        return $this->fechaFunda;
    }

    public function setFechaFunda(\DateTimeInterface $fechaFunda): static
    {
        $this->fechaFunda = $fechaFunda;

        return $this;
    }

    public function getZona(): ?Zona
    {
        return $this->zona;
    }

    public function setZona(?Zona $zona): static
    {
        $this->zona = $zona;

        return $this;
    }

    /**
     * @return Collection<int, Jugador>
     */
    public function getListaJugadores(): Collection
    {
        return $this->listaJugadores;
    }

    public function addListaJugadore(Jugador $listaJugadore): static
    {
        if (!$this->listaJugadores->contains($listaJugadore)) {
            $this->listaJugadores->add($listaJugadore);
            $listaJugadore->setEquipo($this);
        }

        return $this;
    }

    public function removeListaJugadore(Jugador $listaJugadore): static
    {
        if ($this->listaJugadores->removeElement($listaJugadore)) {
            // set the owning side to null (unless already changed)
            if ($listaJugadore->getEquipo() === $this) {
                $listaJugadore->setEquipo(null);
            }
        }

        return $this;
    }
}
