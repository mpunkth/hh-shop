<?php

namespace App\Entity;

use App\Repository\BaseDataRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BaseDataRepository::class)
 */
class BaseData
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
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Vorname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Hausnummer;

    /**
     * @ORM\Column(type="integer")
     */
    private $PLZ;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Ort;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Strasse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getVorname(): ?string
    {
        return $this->Vorname;
    }

    public function setVorname(string $Vorname): self
    {
        $this->Vorname = $Vorname;

        return $this;
    }

    public function getHausnummer(): ?string
    {
        return $this->Hausnummer;
    }

    public function setHausnummer(string $Hausnummer): self
    {
        $this->Hausnummer = $Hausnummer;

        return $this;
    }

    public function getPLZ(): ?int
    {
        return $this->PLZ;
    }

    public function setPLZ(int $PLZ): self
    {
        $this->PLZ = $PLZ;

        return $this;
    }

    public function getOrt(): ?string
    {
        return $this->Ort;
    }

    public function setOrt(string $Ort): self
    {
        $this->Ort = $Ort;

        return $this;
    }

    public function getStrasse(): ?string
    {
        return $this->Strasse;
    }

    public function setStrasse(string $Strasse): self
    {
        $this->Strasse = $Strasse;

        return $this;
    }
}
