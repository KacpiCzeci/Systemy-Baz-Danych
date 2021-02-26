<?php

namespace App\Entity;

use App\Repository\WyposazenieRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=WyposazenieRepository::class)
 * @UniqueEntity(fields={"Nazwa", "Mieszkanie"}, message = "Istnieje już takie wyposażenie pod danym adresem")
 */
class Wyposazenie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotNull(message = "Nieprawidłowa nazwa wyposażenia")
     * @Assert\Length(max = 100, maxMessage = "Zbyt długa nazwa wyposażenia")
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $Nazwa;

    /**
     * @Assert\NotNull(message = "Nieprawidłowa ilość wyposażenia")
     * @Assert\Type(type = "numeric", message = "Nieprawidłowa ilość wyposażenia")
     * @Assert\GreaterThanOrEqual(value = 1, message = "Nieprawidłowa ilość wyposażenia")
     * @Assert\LessThanOrEqual(value  = 99, message = "Nieprawidłowa ilość wyposażenia")
     * @ORM\Column(type="decimal", precision=2, nullable=false)
     */
    private $Ilosc;

    /**
     * @Assert\NotNull(message = "Nieprawidłowy adres mieszkania")
     * @Assert\Length(max = 100, maxMessage = "Zbyt długi adres mieszkania")
     * @ORM\ManyToOne(targetEntity="ObiektyNajmu")
     * @ORM\JoinColumn(name="Mieszkanie", referencedColumnName="mieszkanie")
     */
    private $Mieszkanie;

    public function getId()
    {
        return $this->id;
    }

    public function getNazwa()
    {
        return $this->Nazwa;
    }

    public function setNazwa($Nazwa)
    {
        $this->Nazwa = $Nazwa;
    }

    public function getIlosc()
    {
        return $this->Ilosc;
    }

    public function setIlosc($Ilosc)
    {
        $this->Ilosc = $Ilosc;
    }

    public function getMieszkanie()
    {
        return $this->Mieszkanie;
    }

    public function setMieszkanie($Mieszkanie)
    {
        $this->Mieszkanie = $Mieszkanie;
    }
}
