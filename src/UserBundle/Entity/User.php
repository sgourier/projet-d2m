<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="fk_User_PractInfos1_idx", columns={"PractInfos_id"})})
 * @ORM\Entity(repositoryClass="UserBundle\Entity\UserRepository")
 * @ORM\HasLifecycleCallbacks
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
    private $avatarPath;

    /**
     * @var boolean
     *
     * @ORM\Column(name="practValid", type="boolean", nullable=false)
     */
    private $practValid;

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
     * @ORM\OneToMany(targetEntity="VimoliaBundle\Entity\Subscribe", mappedBy="idUser")
     * @ORM\OrderBy({"endDate" = "DESC"})
     */
    private $subscribes;

    /**
     * User constructor.
     *
     */
    public function __construct( )
    {
        parent::__construct();
        $this->birthdate = new \DateTime();
        $this->practValid = false;
        $this->subscribes = new ArrayCollection();
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
     * Set avatarPath
     *
     * @param string $avatarPath
     *
     * @return User
     */
    public function setAvatarPath($avatarPath)
    {
        $this->avatarPath = $avatarPath;

        return $this;
    }

    /**
     * Get avatarPath
     *
     * @return string
     */
    public function getAvatarPath()
    {
        return $this->avatarPath;
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

    /**
     * Set practValid
     *
     * @param boolean $practValid
     *
     * @return User
     */
    public function setPractValid($practValid)
    {
        $this->practValid = $practValid;

        return $this;
    }

    /**
     * Get practValid
     *
     * @return boolean
     */
    public function getPractValid()
    {
        return $this->practValid;
    }

    /**
     * Get subscribes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscribes()
    {
        return $this->subscribes;
    }

    public function getLastSub()
    {
        return $this->getSubscribes()->first();
    }

    public function getFullImagePath()
    {
        return null === $this->avatarPath ? null : $this->getUploadRootDir() . $this->avatarPath;
    }

    public function getWebPath()
    {
        return null === $this->avatarPath ? null : $this->getUploadDir().'/'.$this->avatarPath;
    }

    protected function getUploadDir()
    {
        return 'uploads/users/'.$this->getId();
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir().$this->getId()."/";
    }

    protected function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return realpath('./') . '/uploads/users/';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function uploadImage() {
        // the file property can be empty if the field is not required
        $img = $this->avatarPath;

        if ( null !== $img && $img instanceof UploadedFile && file_exists( $img->getPathname() ) && $img->getPath() != $this->getUploadRootDir())
        {
            if ( ! $this->id )
            {
                $img->move( $this->getTmpUploadRootDir(), $img->getFilename() . "." . $img->getClientOriginalExtension() );
            }
            else
            {
                if ( ! is_dir( $this->getUploadRootDir() ) )
                {
                    mkdir( $this->getUploadRootDir() );
                }
                $img->move( $this->getUploadRootDir(), $img->getFilename() . "." . $img->getClientOriginalExtension() );
            }
            $this->setAvatarPath( $img->getFilename() . "." . $img->getClientOriginalExtension() );
        }

    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function moveImage()
    {
        if ( null !== $this->avatarPath && file_exists( $this->getTmpUploadRootDir() . $this->avatarPath))
        {
            if ( ! is_dir( $this->getUploadRootDir() ) )
            {
                mkdir( $this->getUploadRootDir() );
            }

            copy( $this->getTmpUploadRootDir() . $this->avatarPath, $this->getFullImagePath() );
            unlink( $this->getTmpUploadRootDir() . $this->avatarPath );
        }
    }

    /**
     * @ORM\PreRemove()
     */
    public function removeImage()
    {
        if(file_exists($this->getFullImagePath()))
            unlink($this->getFullImagePath());
        if(is_dir($this->getUploadRootDir()))
        {
            foreach (scandir($this->getUploadRootDir()) as $item) {
                if($item != '.' && $item != '..')
                    unlink($this->getUploadRootDir().$item);
            }

            rmdir($this->getUploadRootDir());
        }
    }

    /**
     * Add subscribe
     *
     * @param \VimoliaBundle\Entity\Subscribe $subscribe
     *
     * @return User
     */
    public function addSubscribe(\VimoliaBundle\Entity\Subscribe $subscribe)
    {
        $this->subscribes[] = $subscribe;

        return $this;
    }

    /**
     * Remove subscribe
     *
     * @param \VimoliaBundle\Entity\Subscribe $subscribe
     */
    public function removeSubscribe(\VimoliaBundle\Entity\Subscribe $subscribe)
    {
        $this->subscribes->removeElement($subscribe);
    }
}
