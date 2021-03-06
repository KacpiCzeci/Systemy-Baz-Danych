<?php

namespace App\Entity;

use App\Repository\SpoldzielnieRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=SpoldzielnieRepository::class)
 */
class Spoldzielnie
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=100)
     */
    private $Nazwa;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $Adres;

    /**
     * @ORM\Column(type="decimal", precision=9, nullable=false)
     */
    private $Nr_telefonu;

    public function __toString(){
        return $this->Nazwa;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addConstraint(new UniqueEntity(['fields' => 'Nazwa', 'message' => 'Istnieje już społdzielnia o takiej nazwie.']));

        $metadata->addPropertyConstraint('Nazwa', new Assert\NotNull(['message' => 'Nazwa spółdzielni nie powinna być pusta.']));
        $metadata->addPropertyConstraint('Nazwa', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długa nazwa społdzielni.']));

        $metadata->addPropertyConstraint('Adres', new Assert\NotNull(['message' => 'Adres spółdzielni nie powinien być pusty.']));
        $metadata->addPropertyConstraint('Adres', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długi adres społdzielni.']));

        $metadata->addPropertyConstraint('Nr_telefonu', new Assert\NotNull(['message' => 'Numer telefonu nie powinien być pusty.']));
        $metadata->addPropertyConstraint('Nr_telefonu', new Assert\Regex(['pattern' => '/^[0-9]{9}$/', 'message' => 'Nieprawidłowy format numeru telefonu.']));
    }

    public function getNazwa()
    {
        return $this->Nazwa;
    }

    public function setNazwa($Nazwa)
    {
        $this->Nazwa = $Nazwa;
    }

    public function getAdres()
    {
        return $this->Adres;
    }

    public function setAdres($Adres)
    {
        $this->Adres = $Adres;
    }

    public function getNrtelefonu()
    {
        return $this->Nr_telefonu;
    }

    public function setNrtelefonu($Nr_telefonu)
    {
        $this->Nr_telefonu = $Nr_telefonu;
    }
}
