<?php

namespace DiplomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Departament
 *
 * @ORM\Table(name="departament")
 * @ORM\Entity(repositoryClass="DiplomBundle\Repository\DepartamentRepository")
 */
class Departament
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="main", type="integer")
     */
    private $main;

    /**
     * @ORM\OneToMany(targetEntity="DiplomBundle\Entity\Worker", mappedBy="name")
     * @var ArrayCollection
     */
    private $workers;


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
     * @return Departament
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
     * Set description
     *
     * @param string $description
     *
     * @return Departament
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
     * Set main
     *
     * @param integer $main
     *
     * @return Departament
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main
     *
     * @return int
     */
    public function getMain()
    {
        return $this->main;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->workers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add worker
     *
     * @param \DiplomBundle\Entity\Worker $worker
     *
     * @return Departament
     */
    public function addWorker(\DiplomBundle\Entity\Worker $worker)
    {
        $this->workers[] = $worker;

        return $this;
    }

    /**
     * Remove worker
     *
     * @param \DiplomBundle\Entity\Worker $worker
     */
    public function removeWorker(\DiplomBundle\Entity\Worker $worker)
    {
        $this->workers->removeElement($worker);
    }

    /**
     * Get workers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkers()
    {
        return $this->workers;
    }
}
