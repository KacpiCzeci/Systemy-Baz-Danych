<?php

namespace App\Entity;

use App\Repository\BudynkiRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=BudynkiRepository::class)
 * @UniqueEntity("Adres", message = "Istnieje już budynek pod takim adresem")
 */
class Budynki
{
    /**
     * @Assert\NotNull(message = "Nieprawidłowy adres")
     * @Assert\Length(max = 100, maxMessage = "Zbyt długi adres budynku")
     * @ORM\Id
     * @ORM\Column(type="string", length=100)
     */
    private $Adres;

    /**
     * @Assert\NotNull(message = "Nieprawidłowy typ budynku")
     * @Assert\Length(max = 100, maxMessage = "Zbyt długa nazwa typu budynku")
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $Typ;

    /**
     * @Assert\NotNull(message = "Nieprawidłowa nazwa społdzielni")
     * @Assert\Length(max = 100, maxMessage = "Zbyt długa nazwa spółdzielni")
     * @ORM\ManyToOne(targetEntity="Spoldzielnie")
     * @ORM\JoinColumn(name="Nazwa", referencedColumnName="nazwa")
     */
    private $Nazwa;

    public function __toString(){
        return $this->Adres;
    }

    public function getAdres()
    {
        return $this->Adres;
    }

    public function setAdres($Adres)
    {
        $this->Adres = $Adres;
    }

    public function getTyp()
    {
        return $this->Typ;
    }

    public function setTyp($Typ)
    {
        $this->Typ = $Typ;
    }

    public function getNazwa()
    {
        return $this->Nazwa;
    }

    public function setNazwa($Nazwa)
    {
        $this->Nazwa = $Nazwa;
    }

    
}
