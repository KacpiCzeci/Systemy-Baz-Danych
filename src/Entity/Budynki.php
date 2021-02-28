<?php

namespace App\Entity;

use App\Repository\BudynkiRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=BudynkiRepository::class)
 * @UniqueEntity("Adres", message = "Istnieje już budynek pod takim adresem")
 */
class Budynki
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=100)
     */
    private $Adres;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $Typ;

    /**
     * @ORM\ManyToOne(targetEntity="Spoldzielnie")
     * @ORM\JoinColumn(name="Nazwa", referencedColumnName="nazwa")
     */
    private $Nazwa;

    public function __toString(){
        return $this->Adres;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('Adres', new Assert\NotNull(['message' => 'Nieprawidłowy adres']));
        $metadata->addPropertyConstraint('Adres', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długi adres budynku']));
        
        $metadata->addPropertyConstraint('Typ', new Assert\NotNull(['message' => 'Nieprawidłowy typ budynku']));
        $metadata->addPropertyConstraint('Typ', new Assert\Regex(['pattern'=> '/^[a-zA-Z]+$/', 'message' => 'Nieprawidłowy typ budynku']));
        $metadata->addPropertyConstraint('Typ', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długa nazwa typu budynku']));
        
        $metadata->addPropertyConstraint('Nazwa', new Assert\NotNull(['message' => 'Nieprawidłowa nazwa społdzielni']));
        $metadata->addPropertyConstraint('Nazwa', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długa nazwa spółdzielni']));
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
