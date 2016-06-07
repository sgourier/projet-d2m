<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="fk_User_PractInfos1_idx", columns={"PractInfos_id"})})
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=250, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=1, nullable=true)
     */
    private $sex;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime", nullable=true)
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=1000, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="addressPlus", type="string", length=1000, nullable=true)
     */
    private $addressplus;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=250, nullable=true)
     */
    private $city;

    /**
     * @var integer
     *
     * @ORM\Column(name="zipCode", type="integer", nullable=true)
     */
    private $zipcode;

    /**
     * @var integer
     *
     * @ORM\Column(name="phone", type="integer", nullable=true)
     */
    private $phone;

    /**
     * @var integer
     *
     * @ORM\Column(name="cellPhone", type="integer", nullable=true)
     */
    private $cellphone;

    /**
     * @var string
     *
     * @ORM\Column(name="avatarPath", type="string", length=500, nullable=true)
     */
    private $avatarpath;

    /**
     * @var string
     *
     * @ORM\Column(name="discoveryType", type="text", length=65535, nullable=true)
     */
    private $discoverytype;

    /**
     * @var \UserBundle\Entity\Practinfos
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Practinfos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="PractInfos_id", referencedColumnName="id")
     * })
     */
    private $practinfos;

    /**
     * User constructor.
     *
     * @param \DateTime $birthdate
     */
    public function __construct( )
    {
        $this->birthdate = new \DateTime();
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set sex
     *
     * @param string $sex
     *
     * @return User
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
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
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set addressplus
     *
     * @param string $addressplus
     *
     * @return User
     */
    public function setAddressplus($addressplus)
    {
        $this->addressplus = $addressplus;

        return $this;
    }

    /**
     * Get addressplus
     *
     * @return string
     */
    public function getAddressplus()
    {
        return $this->addressplus;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zipcode
     *
     * @param integer $zipcode
     *
     * @return User
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return integer
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set phone
     *
     * @param integer $phone
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
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set cellphone
     *
     * @param integer $cellphone
     *
     * @return User
     */
    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;

        return $this;
    }

    /**
     * Get cellphone
     *
     * @return integer
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * Set avatarpath
     *
     * @param string $avatarpath
     *
     * @return User
     */
    public function setAvatarpath($avatarpath)
    {
        $this->avatarpath = $avatarpath;

        return $this;
    }

    /**
     * Get avatarpath
     *
     * @return string
     */
    public function getAvatarpath()
    {
        return $this->avatarpath;
    }

    /**
     * Set discoverytype
     *
     * @param string $discoverytype
     *
     * @return User
     */
    public function setDiscoverytype($discoverytype)
    {
        $this->discoverytype = $discoverytype;

        return $this;
    }

    /**
     * Get discoverytype
     *
     * @return string
     */
    public function getDiscoverytype()
    {
        return $this->discoverytype;
    }

    /**
     * Set practinfos
     *
     * @param \UserBundle\Entity\Practinfos $practinfos
     *
     * @return User
     */
    public function setPractinfos(\UserBundle\Entity\Practinfos $practinfos = null)
    {
        $this->practinfos = $practinfos;

        return $this;
    }

    /**
     * Get practinfos
     *
     * @return \UserBundle\Entity\Practinfos
     */
    public function getPractinfos()
    {
        return $this->practinfos;
    }
}