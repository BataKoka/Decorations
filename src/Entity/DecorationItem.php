<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DecorationItemRepository")
 * @ORM\Table(name="decoration_items")
 */
class DecorationItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    // add your own fields

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $price;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @Assert\GreaterThanOrEqual(1)
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $quantity;

    /**
     * @ORM\Column(type="boolean", options={"default":true})
     */
    private $isActive = true;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Balloon", inversedBy="decorationItems")
     */
    private $balloon;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Decoration", inversedBy="decorationItems")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $decoration;

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
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
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
    public function getBalloon(): ?Balloon
    {
        return $this->balloon;
    }

    /**
     * @param mixed $balloon
     */
    public function setBalloon(Balloon $balloon = null)
    {
        $this->balloon = $balloon;
    }

    /**
     * @return mixed
     */
    public function getDecoration(): ?Decoration
    {
        return $this->decoration;
    }

    /**
     * @param mixed $decoration
     */
    public function setDecoration(Decoration $decoration = null)
    {
        $this->decoration = $decoration;
    }

    public function __toString()
    {
        return (string) $this->getPrice();
    }

    public function getTotalPrice()
    {
        return $this->getPrice() * $this->getQuantity();
    }
}
