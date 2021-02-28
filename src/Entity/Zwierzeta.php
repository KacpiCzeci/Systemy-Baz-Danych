<?php

namespace App\Entity;

use App\Repository\ZwierzetaRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ZwierzetaRepository::class)
 * @UniqueEntity(fields={"Gatunek", "Id_umowy"}, message="Istnieją już takie zwierzeta przypisane do konkretnej umowy")
 */
class Zwierzeta
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $Gatunek;

    /**
     * @ORM\Column(type="decimal", precision=2, nullable=false)
     */
    private $Ilosc;

    /**
     * @ORM\ManyToOne(targetEntity="Umowy")
     * @ORM\JoinColumn(name="Id_umowy", referencedColumnName="id")
     */
    private $Id_umowy;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('Gatunek', new Assert\NotNull(['message' => 'Nieprawidłowy gatunek']));
        $metadata->addPropertyConstraint('Gatunek', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długa nazwa gatunku']));
        $metadata->addPropertyConstraint('Gatunek', new Assert\Regex(['pattern' => '/^[a-zA-Z ]+$/', 'message' => 'Nieprawidłowy gatunek']));

        $metadata->addPropertyConstraint('Ilosc', new Assert\NotNull(['message' => 'Nieprawidłowa ilość']));
        $metadata->addPropertyConstraint('Ilosc', new Assert\Type(['type' => 'numeric', 'message' => 'Nieprawidłowa ilość']));
        $metadata->addPropertyConstraint('Ilosc', new Assert\Type(['type' => 'integer', 'message' => 'Nieprawidłowa ilość']));
        $metadata->addPropertyConstraint('Ilosc', new Assert\GreaterThanOrEqual(['value' => 1, 'message' => 'Nieprawidłowa ilość']));
        $metadata->addPropertyConstraint('Ilosc', new Assert\LessThanOrEqual(['value' => 99, 'message' => 'Nieprawidłowa ilość']));

        $metadata->addPropertyConstraint('Mieszkanie', new Assert\NotNull(['message' => 'Nieprawidłowe id umowy']));
    }

    public function getId()
    {
        return $this->id;
    }

    public function getGatunek()
    {
        return $this->Gatunek;
    }

    public function setGatunek($Gatunek)
    {
        $this->Gatunek = $Gatunek;
    }

    public function getIlosc()
    {
        return $this->Ilosc;
    }

    public function setIlosc($Ilosc)
    {
        $this->Ilosc = $Ilosc;
    }

    public function getIdUmowy()
    {
        return $this->Id_umowy;
    }

    public function setIdUmowy($Id_umowy)
    {
        $this->Id_umowy = $Id_umowy;
    }
}
