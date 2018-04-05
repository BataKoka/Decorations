<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CelebrationRepository")
 * @ORM\Entity
 * @ORM\Table(name="celebrations")
 * @UniqueEntity("name")
 */
class Celebration
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    // add your own fields

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     * @ORM\Column(type="string", unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", options={"default":true})
     */
    private $isActive = true;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="CelebrationType", inversedBy="celebrations")
     */
    private $celebrationType;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Location", inversedBy="celebrations")
     */
    private $location;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true, "default":0})
     */
    private $locationPercentage = 0;

    /**
     * @Assert\NotBlank()
     * @Assert\Date()
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @Assert\Range(min="0")
     * @ORM\Column(type="integer", options={"unsigned":true, "default":0})
     */
    private $revenue = 0;

    /**
     * @Assert\Type("integer")
     * @ORM\Column(type="integer", options={"unsigned":true, "default":0})
     */
    private $workerExpense = 0;

    /**
     * @Assert\Type("integer")
     * @ORM\Column(type="integer", options={"unsigned":true, "default":0})
     */
    private $transportExpense = 0;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getCelebrationType(): ?CelebrationType
    {
        return $this->celebrationType;
    }

    /**
     * @param mixed $celebrationType
     */
    public function setCelebrationType(CelebrationType $celebrationType = null)
    {
        $this->celebrationType = $celebrationType;
    }

    /**
     * @return mixed
     */
    public function getLocation(): ?Location
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation(Location $location = null)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getLocationPercentage()
    {
        return $this->locationPercentage;
    }

    /**
     * @param mixed $locationPercentage
     */
    public function setLocationPercentage($locationPercentage)
    {
        $this->locationPercentage = $locationPercentage;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getRevenue()
    {
        return $this->revenue;
    }

    /**
     * @param mixed $revenue
     */
    public function setRevenue($revenue)
    {
        $this->revenue = $revenue;
    }

    /**
     * @return mixed
     */
    public function getWorkerExpense()
    {
        return $this->workerExpense;
    }

    /**
     * @param mixed $workerExpense
     */
    public function setWorkerExpense($workerExpense)
    {
        $this->workerExpense = $workerExpense;
    }

    /**
     * @return mixed
     */
    public function getTransportExpense()
    {
        return $this->transportExpense;
    }

    /**
     * @param mixed $transportExpense
     */
    public function setTransportExpense($transportExpense)
    {
        $this->transportExpense = $transportExpense;
    }

    public function __toString()
    {
        return (string) $this->getName();
    }
}
