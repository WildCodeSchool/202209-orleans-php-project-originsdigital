<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use App\Repository\AdvertRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AdvertRepository::class)]
#[Vich\Uploadable]
class Advertisement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    #[Assert\NotBlank(message: 'Veuillez donner un nom à votre publicité')]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(max: 255)]
    private ?string $poster = null;

    #[Vich\UploadableField(mapping: 'advertisements', fileNameProperty: 'poster')]
    #[Assert\File(
        maxSize: '2M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    )]
    private ?File $posterFile = null;

    #[ORM\Column(length: 255)]
    #[Assert\Url(
        protocols: ['http', 'https', 'ftp'],
    )]
    #[Assert\NotBlank(message: 'The url {{ value }} is not a valid url')]
    private ?string $linkTo = null;

    #[ORM\Column(type: types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

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

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getPosterFile(): ?File
    {
        return $this->posterFile;
    }

    public function setPosterFile(?File $posterFile = null): void
    {
        $this->posterFile = $posterFile;

        if (null !== $posterFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new DateTime('now');
        }
    }

    public function getLinkTo(): ?string
    {
        return $this->linkTo;
    }

    public function setLinkTo(string $linkTo): self
    {
        $this->linkTo = $linkTo;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
