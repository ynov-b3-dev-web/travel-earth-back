<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DestinationRepository::class)]
#[ApiResource]
class Destination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comment;

    #[ORM\Column(type: 'float', nullable: true)]
    private $coord_lat;

    #[ORM\Column(type: 'float', nullable: true)]
    private $coord_lon;

    #[ORM\Column(type: 'string', length: 255)]
    private $cover_link;

    #[ORM\Column(type: 'date')]
    private $creation_date;

    #[ORM\Column(type: 'date', nullable: true)]
    private $start_date;

    #[ORM\Column(type: 'date', nullable: true)]
    private $finish_date;

    #[ORM\ManyToOne(targetEntity: travel::class, inversedBy: 'destinations')]
    #[ORM\JoinColumn(nullable: false)]
    private $travel;

    #[ORM\OneToMany(mappedBy: 'destination', targetEntity: Picture::class, orphanRemoval: true)]
    private $pictures;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCoordLat(): ?float
    {
        return $this->coord_lat;
    }

    public function setCoordLat(?float $coord_lat): self
    {
        $this->coord_lat = $coord_lat;

        return $this;
    }

    public function getCoordLon(): ?float
    {
        return $this->coord_lon;
    }

    public function setCoordLon(?float $coord_lon): self
    {
        $this->coord_lon = $coord_lon;

        return $this;
    }

    public function getCoverLink(): ?string
    {
        return $this->cover_link;
    }

    public function setCoverLink(string $cover_link): self
    {
        $this->cover_link = $cover_link;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(?\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getFinishDate(): ?\DateTimeInterface
    {
        return $this->finish_date;
    }

    public function setFinishDate(?\DateTimeInterface $finish_date): self
    {
        $this->finish_date = $finish_date;

        return $this;
    }

    public function getTravel(): ?travel
    {
        return $this->travel;
    }

    public function setTravel(?travel $travel): self
    {
        $this->travel = $travel;

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setDestination($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getDestination() === $this) {
                $picture->setDestination(null);
            }
        }

        return $this;
    }
}
