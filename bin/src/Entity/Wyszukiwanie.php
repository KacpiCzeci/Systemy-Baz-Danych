<?php

namespace App\Entity;

use App\Repository\ObiektyNajmuRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=WyszukiwanieRepository::class)
 */
class Wyszukiwanie
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
    private $Answer;

    public function getId()
    {
        return $this->id;
    }

    public function getAnswer()
    {
        return $this->Answer;
    }

    public function setAnswer($Answer)
    {
        $this->Answer = $Answer;
    }
}
