<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Practinfos
 *
 * @ORM\Table(name="practinfos", indexes={@ORM\Index(name="fk_PractInfos_PractDomains1_idx", columns={"id_practDomains"})})
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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \VimoliaBundle\Entity\Practdomains
     *
     * @ORM\ManyToOne(targetEntity="VimoliaBundle\Entity\Practdomains")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_practDomains", referencedColumnName="id")
     * })
     */
    private $idPractdomains;



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

    /**
     * Set idPractdomains
     *
     * @param \VimoliaBundle\Entity\Practdomains $idPractdomains
     *
     * @return Practinfos
     */
    public function setIdPractdomains(\VimoliaBundle\Entity\Practdomains $idPractdomains = null)
    {
        $this->idPractdomains = $idPractdomains;

        return $this;
    }

    /**
     * Get idPractdomains
     *
     * @return \VimoliaBundle\Entity\Practdomains
     */
    public function getIdPractdomains()
    {
        return $this->idPractdomains;
    }
}
