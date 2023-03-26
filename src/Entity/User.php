<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Table(
 *     name="users",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="users_email_unique_idx", columns={"email"}),
 *         @ORM\UniqueConstraint(name="users_uuid_unique_idx", columns={"uuid"})
 *     }
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
     * @ORM\Column(name="email", type="string", length=100, nullable=false, unique=true)
     */
    private string $email;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private DateTimeInterface $updatedAt;

    public function __construct(
        string $email
    ) {
        $this->email = $email;
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

    public function getEmail(): string
    {
        return $this->email;
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
