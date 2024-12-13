<?php
// src/Entity/Reservation.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Reservation
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'datetime')]
    #[Assert\GreaterThan("today + 1 day", message: "La réservation doit être effectuée au moins 24 heures à l'avance.")]
    private \DateTime $date;

    #[ORM\Column(type: 'string', length: 100)]
    private string $timeSlot;

    #[ORM\Column(type: 'string', length: 255)]
    private string $eventName;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    public function getId(): ?int { return $this->id; }

    public function getDate(): ?\DateTime { return $this->date; }
    public function setDate(\DateTime $date): self { $this->date = $date; return $this; }

    public function getTimeSlot(): ?string { return $this->timeSlot; }
    public function setTimeSlot(string $timeSlot): self { $this->timeSlot = $timeSlot; return $this; }

    public function getEventName(): ?string { return $this->eventName; }
    public function setEventName(string $eventName): self { $this->eventName = $eventName; return $this; }

    public function getUser(): ?User { return $this->user; }
    public function setUser(User $user): self { $this->user = $user; return $this; }
}
