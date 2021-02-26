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
     * @Assert\NotNull(message = "Nieprawidłowy gatunek")
     * @Assert\Length(max = 100, maxMessage = "Zbyt długa nazwa gatunku")
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $Gatunek;

    /**
     * @Assert\NotNull(message = "Nieprawidłowa ilość")
     * @Assert\Type(type = "numeric", message = "Nieprawidłowa ilość")
     * @Assert\GreaterThanOrEqual(value = 1, message = "Nieprawidłowa ilość")
     * @Assert\LessThanOrEqual(value = 99, message = "Nieprawidłowa ilość")
     * @ORM\Column(type="decimal", precision=2, nullable=false)
     */
    private $Ilosc;

    /**
     * @Assert\NotNull(message = "Nieprawidłowe id umowy")
     * @ORM\ManyToOne(targetEntity="Umowy")
     * @ORM\JoinColumn(name="Id_umowy", referencedColumnName="id")
     */
    private $Id_umowy;

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
