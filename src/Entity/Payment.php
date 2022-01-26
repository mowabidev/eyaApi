<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Serializer\Groups(['payments'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'payments')]
    #[ORM\JoinColumn(nullable: false)]
    private $payer;

    #[ORM\Column(type: 'integer', nullable: false)]
    #[Serializer\Groups(['payments'])]
    private $amount;

    #[ORM\Column(type: 'datetime')]
    #[Serializer\Groups(['payments'])]
    private $pay_at;

    #[ORM\Column(type: 'datetime')]
    #[Serializer\Groups(['payments'])]
    private $created_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updated_at;

    #[ORM\Column(type: 'string', length: 255)]
    #[Serializer\Groups(['payments'])]
    private $reference_kkia;

    #[ORM\Column(type: 'integer')]
    #[Serializer\Groups(['payments'])]
    private $invoice;

    #[ORM\Column(type: 'string', length: 255)]
    private $payment_method;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPayer(): ?User
    {
        return $this->payer;
    }

    public function setPayer(?User $payer): self
    {
        $this->payer = $payer;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPayAt(): ?\DateTime
    {
        return $this->pay_at;
    }

    public function setPayAt(\DateTime $pay_at): self
    {
        $this->pay_at = $pay_at;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getReferenceKkia(): ?string
    {
        return $this->reference_kkia;
    }

    public function setReferenceKkia(string $reference_kkia): self
    {
        $this->reference_kkia = $reference_kkia;

        return $this;
    }

    public function getInvoice(): ?int
    {
        return $this->invoice;
    }

    public function setInvoice(int $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->payment_method;
    }

    public function setPaymentMethod(string $payment_method): self
    {
        $this->payment_method = $payment_method;

        return $this;
    }
}
