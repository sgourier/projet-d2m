<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use VimoliaBundle\Entity\Practdomains;

/**
 * Practinfos
 *
 * @ORM\Table(name="practinfos")
 * @ORM\Entity
 */
class Practinfos
{
    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=50, nullable=true)
     */
    private $siret;

    /**
     * @var string
     *
     * @ORM\Column(name="proAddress", type="string", length=1000, nullable=true)
     */
    private $proaddress;

    /**
     * @var string
     *
     * @ORM\Column(name="proAddressPlus", type="string", length=1000, nullable=true)
     */
    private $proaddressplus;

    /**
     * @var string
     *
     * @ORM\Column(name="proCity", type="string", length=500, nullable=true)
     */
    private $procity;

    /**
     * @var integer
     *
     * @ORM\Column(name="proZipCode", type="integer", nullable=true)
     */
    private $prozipcode;

    /**
     * @var integer
     *
     * @ORM\Column(name="proPhone", type="integer", nullable=true)
     */
    private $prophone;

    /**
     * @var integer
     *
     * @ORM\Column(name="proCellPhone", type="integer", nullable=true)
     */
    private $procellphone;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=1500, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="degrees", type="text", length=65535, nullable=true)
     */
    private $degrees;

    /**
     * @ORM\Column(name="imgPro", type="string", length=500, nullable=true)
     * @Assert\File(mimeTypes={ "image/jpeg","image/jpeg", "image/png" })
     * @Assert\Image(minWidth = 1000)
     */
    private $imgPro;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="VimoliaBundle\Entity\Practdomains")
     * @ORM\JoinTable(
     *     name="practDomains_practInfos",
     *     joinColumns={@ORM\JoinColumn(name="practDomainsId", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="practInfosId", referencedColumnName="id", onDelete="CASCADE")}
     * )
     */
    private $practDomains;

    /**
     * Practinfos constructor.
     */
    public function __construct()
    {
        $this->practDomains = new ArrayCollection();
    }


    /**
     * Set siret
     *
     * @param string $siret
     *
     * @return Practinfos
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set proaddress
     *
     * @param string $proaddress
     *
     * @return Practinfos
     */
    public function setProaddress($proaddress)
    {
        $this->proaddress = $proaddress;

        return $this;
    }

    /**
     * Get proaddress
     *
     * @return string
     */
    public function getProaddress()
    {
        return $this->proaddress;
    }

    /**
     * Set proaddressplus
     *
     * @param string $proaddressplus
     *
     * @return Practinfos
     */
    public function setProaddressplus($proaddressplus)
    {
        $this->proaddressplus = $proaddressplus;

        return $this;
    }

    /**
     * Get proaddressplus
     *
     * @return string
     */
    public function getProaddressplus()
    {
        return $this->proaddressplus;
    }

    /**
     * Set procity
     *
     * @param string $procity
     *
     * @return Practinfos
     */
    public function setProcity($procity)
    {
        $this->procity = $procity;

        return $this;
    }

    /**
     * Get procity
     *
     * @return string
     */
    public function getProcity()
    {
        return $this->procity;
    }

    /**
     * Set prozipcode
     *
     * @param integer $prozipcode
     *
     * @return Practinfos
     */
    public function setProzipcode($prozipcode)
    {
        $this->prozipcode = $prozipcode;

        return $this;
    }

    /**
     * Get prozipcode
     *
     * @return integer
     */
    public function getProzipcode()
    {
        return $this->prozipcode;
    }

    /**
     * Set prophone
     *
     * @param integer $prophone
     *
     * @return Practinfos
     */
    public function setProphone($prophone)
    {
        $this->prophone = $prophone;

        return $this;
    }

    /**
     * Get prophone
     *
     * @return integer
     */
    public function getProphone()
    {
        return $this->prophone;
    }

    /**
     * Set procellphone
     *
     * @param integer $procellphone
     *
     * @return Practinfos
     */
    public function setProcellphone($procellphone)
    {
        $this->procellphone = $procellphone;

        return $this;
    }

    /**
     * Get procellphone
     *
     * @return integer
     */
    public function getProcellphone()
    {
        return $this->procellphone;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Practinfos
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Practinfos
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
     * Set degrees
     *
     * @param string $degrees
     *
     * @return Practinfos
     */
    public function setDegrees($degrees)
    {
        $this->degrees = $degrees;

        return $this;
    }

    /**
     * Get degrees
     *
     * @return string
     */
    public function getDegrees()
    {
        return $this->degrees;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function addPractDomains(Practdomains $domain)
    {
        $this->practDomains[] = $domain;

        return $this;
    }

    public function removePractDomains(Practdomains $domain)
    {
        $this->practDomains->removeElement($domain);
    }

    public function getPractDomains()
    {
        return $this->practDomains;
    }

    /**
     * Set imgPro
     *
     * @param string $imgPro
     *
     * @return Practinfos
     */
    public function setImgPro($imgPro)
    {
        $this->imgPro = $imgPro;

        return $this;
    }

    /**
     * Get imgPro
     *
     * @return string
     */
    public function getImgPro()
    {
        return $this->imgPro;
    }

    /**
     * Add practDomain
     *
     * @param Practdomains $practDomain
     *
     * @return Practinfos
     */
    public function addPractDomain(Practdomains $practDomain)
    {
        $this->practDomains[] = $practDomain;

        return $this;
    }

    /**
     * Remove practDomain
     *
     * @param Practdomains $practDomain
     */
    public function removePractDomain(Practdomains $practDomain)
    {
        $this->practDomains->removeElement($practDomain);
    }
}
