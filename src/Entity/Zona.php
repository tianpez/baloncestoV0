<?php

namespace App\Entity;

use App\Repository\ZonaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ZonaRepository::class)]
class Zona
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nombreZona = null;

    #[ORM\OneToMany(mappedBy: 'zona', targetEntity: Equipo::class)]
    private Collection $listaEquipos;

    public function __construct()
    {
        $this->listaEquipos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreZona(): ?string
    {
        return $this->nombreZona;
    }

    public function setNombreZona(string $nombreZona): static
    {
        $this->nombreZona = $nombreZona;

        return $this;
    }

    /**
     * @return Collection<int, Equipo>
     */
    public function getListaEquipos(): Collection
    {
        return $this->listaEquipos;
    }

    public function addListaEquipo(Equipo $listaEquipo): static
    {
        if (!$this->listaEquipos->contains($listaEquipo)) {
            $this->listaEquipos->add($listaEquipo);
            $listaEquipo->setZona($this);
        }

        return $this;
    }

    public function removeListaEquipo(Equipo $listaEquipo): static
    {
        if ($this->listaEquipos->removeElement($listaEquipo)) {
            // set the owning side to null (unless already changed)
            if ($listaEquipo->getZona() === $this) {
                $listaEquipo->setZona(null);
            }
        }

        return $this;
    }
}
