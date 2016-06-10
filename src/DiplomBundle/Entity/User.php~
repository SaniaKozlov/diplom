<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26.05.16
 * Time: 13:03
 */

namespace DiplomBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="DiplomBundle\Entity\WorkerRole", mappedBy="user")
     * @var ArrayCollection
     */
    protected $permissions;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Add premission
     *
     * @param \DiplomBundle\Entity\WorkerRole $premission
     *
     * @return User
     */
    public function addPremission(\DiplomBundle\Entity\WorkerRole $premission)
    {
        $this->premission[] = $premission;

        return $this;
    }

    /**
     * Remove premission
     *
     * @param \DiplomBundle\Entity\WorkerRole $premission
     */
    public function removePremission(\DiplomBundle\Entity\WorkerRole $premission)
    {
        $this->premission->removeElement($premission);
    }

    /**
     * Get premission
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPremission()
    {
        return $this->premission;
    }

    /**
     * Add permission
     *
     * @param \DiplomBundle\Entity\WorkerRole $permission
     *
     * @return User
     */
    public function addPermission(\DiplomBundle\Entity\WorkerRole $permission)
    {
        $this->permissions[] = $permission;

        return $this;
    }

    /**
     * Remove permission
     *
     * @param \DiplomBundle\Entity\WorkerRole $permission
     */
    public function removePermission(\DiplomBundle\Entity\WorkerRole $permission)
    {
        $this->permissions->removeElement($permission);
    }

    /**
     * Get permissions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPermissions()
    {
        return $this->permissions;
    }
}
