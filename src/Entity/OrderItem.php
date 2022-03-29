<?php

namespace App\Entity;

use Webmozart\Assert\Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrderItemRepository;
use Webmozart\Assert\Assert\Assert\NotBlank;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

/**
 * @ORM\Entity(repositoryClass=OrderItemRepository::class)
 */
class OrderItem
{
   /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
     /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderRef;
    // ...
    public function getOrderRef(): ?Order
    {
        return $this->orderRef;
    }

    public function setOrderRef(?Order $orderRef): self
    {
        $this->orderRef = $orderRef;

        return $this;
    }

    /**
 * Tests if the given item given corresponds to the same order item.
 *
 * @param OrderItem $item
 *
 * @return bool
 */
public function equals(OrderItem $item): bool
{
    return $this->getProduct()->getId() === $item->getProduct()->getId();
}
/**
 * Calculates the item total.
 *
 * @return float|int
 */
public function getTotal(): float
{
    return $this->getProduct()->getPrice() * $this->getQuantity();
}
}
