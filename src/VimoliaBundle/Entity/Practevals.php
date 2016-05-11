<?php

namespace VimoliaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Practevals
 *
 * @ORM\Table(name="practevals", indexes={@ORM\Index(name="fk_PractEvals_User1_idx", columns={"id_owner"}), @ORM\Index(name="fk_PractEvals_User2_idx", columns={"id_pract"})})
 * @ORM\Entity
 */
class Practevals
{
    /**
     * @var float
     *
     * @ORM\Column(name="note", type="float", precision=10, scale=0, nullable=true)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", length=65535, nullable=true)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAdd", type="datetime", nullable=true)
     */
    private $dateadd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateUpd", type="datetime", nullable=true)
     */
    private $dateupd;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateConsultation", type="datetime", nullable=true)
     */
    private $dateconsultation;

    /**
     * @var string
     *
     * @ORM\Column(name="PractEvalscol", type="string", length=45, nullable=true)
     */
    private $practevalscol;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \VimoliaBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="VimoliaBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pract", referencedColumnName="id")
     * })
     */
    private $idPract;

    /**
     * @var \VimoliaBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="VimoliaBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_owner", referencedColumnName="id")
     * })
     */
    private $idOwner;



    /**
     * Set note
     *
     * @param float $note
     *
     * @return Practevals
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Practevals
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
     * Set dateadd
     *
     * @param \DateTime $dateadd
     *
     * @return Practevals
     */
    public function setDateadd($dateadd)
    {
        $this->dateadd = $dateadd;

        return $this;
    }

    /**
     * Get dateadd
     *
     * @return \DateTime
     */
    public function getDateadd()
    {
        return $this->dateadd;
    }

    /**
     * Set dateupd
     *
     * @param \DateTime $dateupd
     *
     * @return Practevals
     */
    public function setDateupd($dateupd)
    {
        $this->dateupd = $dateupd;

        return $this;
    }

    /**
     * Get dateupd
     *
     * @return \DateTime
     */
    public function getDateupd()
    {
        return $this->dateupd;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Practevals
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set dateconsultation
     *
     * @param \DateTime $dateconsultation
     *
     * @return Practevals
     */
    public function setDateconsultation($dateconsultation)
    {
        $this->dateconsultation = $dateconsultation;

        return $this;
    }

    /**
     * Get dateconsultation
     *
     * @return \DateTime
     */
    public function getDateconsultation()
    {
        return $this->dateconsultation;
    }

    /**
     * Set practevalscol
     *
     * @param string $practevalscol
     *
     * @return Practevals
     */
    public function setPractevalscol($practevalscol)
    {
        $this->practevalscol = $practevalscol;

        return $this;
    }

    /**
     * Get practevalscol
     *
     * @return string
     */
    public function getPractevalscol()
    {
        return $this->practevalscol;
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
     * Set idPract
     *
     * @param \VimoliaBundle\Entity\User $idPract
     *
     * @return Practevals
     */
    public function setIdPract(\VimoliaBundle\Entity\User $idPract = null)
    {
        $this->idPract = $idPract;

        return $this;
    }

    /**
     * Get idPract
     *
     * @return \VimoliaBundle\Entity\User
     */
    public function getIdPract()
    {
        return $this->idPract;
    }

    /**
     * Set idOwner
     *
     * @param \VimoliaBundle\Entity\User $idOwner
     *
     * @return Practevals
     */
    public function setIdOwner(\VimoliaBundle\Entity\User $idOwner = null)
    {
        $this->idOwner = $idOwner;

        return $this;
    }

    /**
     * Get idOwner
     *
     * @return \VimoliaBundle\Entity\User
     */
    public function getIdOwner()
    {
        return $this->idOwner;
    }
}
