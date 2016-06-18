<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26.05.16
 * Time: 13:03
 */

namespace DiplomBundle\Entity;


use DiplomBundle\Exception\WrongDateException;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

/**
 * @ORM\Entity(repositoryClass="DiplomBundle\Repository\UserRepository")
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

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     * @ORM\Column(name="birthdate", type="datetime", nullable=false)
     */
    private $birthdate;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(name="image", type="string", length=1024)
     */
    private $image;


    public function __construct()  {
        parent::__construct();

        $this->permissions = new ArrayCollection();
        $this->image = __DIR__ . '/../../../web/img/users_pic/user_g1.png';
    }

    /**
     * @param array $data
     * @param PasswordEncoderInterface $passwordEncoder
     * @return User
     * @throws WrongDateException
     */
    public function fillFormData($data, $passwordEncoder) {
        $this->setName($data['name']);
        $this->setSurname($data['surname']);
        $this->setBirthdate($data['birthdate']);
        $this->setPhone($data['phone']);
        $this->setUsername($data['login']);
        $this->setEmail($data['email']);
        $this->setEnabled(true);
        $this->setExpiresAt((new \DateTime())->modify('+5 years'));
        $this->setPassword($passwordEncoder->encodePassword($data['password'], $this->getSalt()));
        $this->setImage($data['image']);

        return $this;
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * Set surname
     *
     * @param string $surname
     *
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
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
     * Set image
     *
     * @param string $image
     *
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
