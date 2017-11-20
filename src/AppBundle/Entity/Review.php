<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 */
class Review
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
     */
    private $text;

    /**
    * @var int
    * @ORM\Column(type="integer")
    * @Assert\NotNull()
     */
    private $raiting;

    /**
     * @ORM\ManyToOne(targetEntity="Guitar", inversedBy="review")
     */
    protected $guitar;

    /**
     * @ORM\ManyToOne(targetEntity="UserAccount", inversedBy="review")
     */
    protected $user;

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
     * @param string $text
     *
     * @return Review
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
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

    /**
     * Get User
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set User
     *
     * @param user $user
     *
     * @return Review
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Get Guitar
     *
     * @return Guitar
     */
    public function getGuitar()
    {
        return $this->guitar;
    }

    /**
     * Set Guitar
     *
     * @param user $guitar
     *
     * @return Review
     */
    public function setGuitar($guitar)
    {
        $this->guitar = $guitar;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->text,
            $this->rating,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->text,
            $this->rating,
        ) = unserialize($serialized);
    }
}

