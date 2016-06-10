<?php

namespace DiplomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Worker
 *
 * @ORM\Table(name="worker")
 * @ORM\Entity(repositoryClass="DiplomBundle\Repository\WorkerRepository")
 */
class Worker
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\OneToOne(targetEntity="DiplomBundle\Entity\User")
     * @var User
     */
    private $user;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="birthdate", type="string", length=255)
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="passport", type="string", length=255)
     */
    private $passport;

    /**
     * @var string
     *
     * @ORM\Column(name="idnum", type="string", length=255, unique=true)
     */
    private $idnum;


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
     * @return Worker
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Worker
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Worker
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set birthdate
     *
     * @param string $birthdate
     *
     * @return Worker
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return string
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set passport
     *
     * @param string $passport
     *
     * @return Worker
     */
    public function setPassport($passport)
    {
        $this->passport = $passport;

        return $this;
    }

    /**
     * Get passport
     *
     * @return string
     */
    public function getPassport()
    {
        return $this->passport;
    }

    /**
     * Set idnum
     *
     * @param string $idnum
     *
     * @return Worker
     */
    public function setIdnum($idnum)
    {
        $this->idnum = $idnum;

        return $this;
    }

    /**
     * Get idnum
     *
     * @return string
     */
    public function getIdnum()
    {
        return $this->idnum;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Worker
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Worker
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set user
     *
     * @param \DiplomBundle\Entity\User $user
     *
     * @return Worker
     */
    public function setUser(\DiplomBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \DiplomBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
