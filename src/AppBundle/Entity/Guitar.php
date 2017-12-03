<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 */
class Guitar
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $imgPath;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
    * @var int
    * @ORM\Column(type="integer")
     */
    private $rating;

    /**
     * @ORM\OneToMany(targetEntity="Review", mappedBy="guitar")
     */
    protected $review;

    /**
     * Get Review
     *
     * @return Review
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set Review
     *
     * @param user $review
     *
     * @return Guitar
     */
    public function setReview($review)
    {
        $this->review = $review;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Guitar
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get imgPath
     *
     * @return string
     */
    public function getImgPath()
    {
        return $this->imgPath;
    }

    /**
     * Set imgPath
     *
     * @param string $imgPath
     *
     * @return Guitar
     */
    public function setImgPath($imgPath)
    {
        $this->imgPath = $imgPath;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return UserAccount
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Guitar
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get rating
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set rating
     *
     * @param string $rating
     *
     * @return Guitar
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->name,
            $this->description,
            $this->price,
            $this->rating,
            $this->imgPath,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->name,
            $this->description,
            $this->price,
            $this->rating,
            $this->imgPath,
        ) = unserialize($serialized);
    }
}

