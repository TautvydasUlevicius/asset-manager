<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Table(
 *     name="assets",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="assets_uuid_unique_idx", columns={"uuid"})
 *     },
 *     indexes={
 *         @ORM\Index(name="assets_user_id_idx", columns={"user_id"}),
 *     }
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\AssetRepository")
 */
class Asset
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint")
     *
     * @ORM\Id
     *
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="guid", nullable=false, unique=true)
     */
    private string $uuid;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", nullable=false)
     */
    private string $label;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", nullable=false)
     */
    private string $currency;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", nullable=false)
     */
    private float $amount;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     *
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private User $user;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private DateTimeInterface $updatedAt;

    public function __construct(
        string $label,
        string $currency,
        float $amount,
        User $user
    ) {
        $this->label = $label;
        $this->currency = $currency;
        $this->amount = $amount;
        $this->user = $user;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
        $this->uuid = strval(Uuid::v4());
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }
}
