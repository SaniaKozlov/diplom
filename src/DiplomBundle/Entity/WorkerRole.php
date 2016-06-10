<?php

namespace DiplomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WorkerRole
 *
 * @ORM\Table(name="worker_role")
 * @ORM\Entity(repositoryClass="DiplomBundle\Repository\WorkerRoleRepository")
 */
class WorkerRole
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
     * @ORM\ManyToOne(targetEntity="DiplomBundle\Entity\User", inversedBy="permissions")
     * @var User
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


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
     * @return WorkerRole
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
     * Set user
     *
     * @param \DiplomBundle\Entity\User $user
     *
     * @return WorkerRole
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
