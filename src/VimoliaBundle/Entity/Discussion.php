<?php

namespace VimoliaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Discussion
 *
 * @ORM\Table(name="discussion", indexes={@ORM\Index(name="fk_Discussion_AdvancedInfos1_idx", columns={"id_advancedInfos"}), @ORM\Index(name="fk_Discussion_User1_idx", columns={"id_expert"}), @ORM\Index(name="fk_Discussion_User2_idx", columns={"id_member"}), @ORM\Index(name="fk_Discussion_User3_idx", columns={"id_pract"})})
 * @ORM\Entity
 */
class Discussion
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="public", type="boolean", nullable=true)
     */
    private $public;

    /**
     * @var string
     *
     * @ORM\Column(name="feedback", type="string", length=150, nullable=true)
     */
    private $feedback;

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
     * @var boolean
     *
     * @ORM\Column(name="closed", type="boolean", nullable=true)
     */
    private $closed;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=200, nullable=true)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pract", referencedColumnName="id")
     * })
     */
    private $idPract;

    /**
     * @var \UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_member", referencedColumnName="id")
     * })
     */
    private $idMember;

    /**
     * @var \UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_expert", referencedColumnName="id")
     * })
     */
    private $idExpert;

    /**
     * @var \VimoliaBundle\Entity\Advancedinfos
     *
     * @ORM\ManyToOne(targetEntity="VimoliaBundle\Entity\Advancedinfos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_advancedInfos", referencedColumnName="id")
     * })
     */
    private $idAdvancedinfos;

	/**
	 * @var \VimoliaBundle\Entity\Practdomains
	 *
	 * @ORM\ManyToOne(targetEntity="VimoliaBundle\Entity\Practdomains")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="id_domain", referencedColumnName="id")
	 * })
	 */
	private $domain;

    public $question;
    public $reponse;
    public $advancedInfos;

    /**
     * Message constructor.
     */
    public function __construct()
    {
        $this->status = 'new';
        $this->dateadd = new \DateTime();
        $this->dateupd = new \DateTime();
        $this->public = false;
        $this->active = true;
        $this->closed = false;
    }

    /**
     * Set public
     *
     * @param boolean $public
     *
     * @return Discussion
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return boolean
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set feedback
     *
     * @param string $feedback
     *
     * @return Discussion
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;

        return $this;
    }

    /**
     * Get feedback
     *
     * @return string
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * Set dateadd
     *
     * @param \DateTime $dateadd
     *
     * @return Discussion
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
     * @return Discussion
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
     * @return Discussion
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
     * Set closed
     *
     * @param boolean $closed
     *
     * @return Discussion
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * Get closed
     *
     * @return boolean
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Discussion
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
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
     * @param \UserBundle\Entity\User $idPract
     *
     * @return Discussion
     */
    public function setIdPract(\UserBundle\Entity\User $idPract = null)
    {
        $this->idPract = $idPract;

        return $this;
    }

    /**
     * Get idPract
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdPract()
    {
        return $this->idPract;
    }

    /**
     * Set idMember
     *
     * @param \UserBundle\Entity\User $idMember
     *
     * @return Discussion
     */
    public function setIdMember(\UserBundle\Entity\User $idMember = null)
    {
        $this->idMember = $idMember;

        return $this;
    }

    /**
     * Get idMember
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdMember()
    {
        return $this->idMember;
    }

    /**
     * Set idExpert
     *
     * @param \UserBundle\Entity\User $idExpert
     *
     * @return Discussion
     */
    public function setIdExpert(\UserBundle\Entity\User $idExpert = null)
    {
        $this->idExpert = $idExpert;

        return $this;
    }

    /**
     * Get idExpert
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdExpert()
    {
        return $this->idExpert;
    }

    /**
     * Set idAdvancedinfos
     *
     * @param \VimoliaBundle\Entity\Advancedinfos $idAdvancedinfos
     *
     * @return Discussion
     */
    public function setIdAdvancedinfos(\VimoliaBundle\Entity\Advancedinfos $idAdvancedinfos = null)
    {
        $this->idAdvancedinfos = $idAdvancedinfos;

        return $this;
    }

    /**
     * Get idAdvancedinfos
     *
     * @return \VimoliaBundle\Entity\Advancedinfos
     */
    public function getIdAdvancedinfos()
    {
        return $this->idAdvancedinfos;
    }

    /**
     * Set question
     *
     * @param $question
     *
     * @return Discussion
     */
    public function setQuestion($question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set reponse
     *
     * @param $reponse
     *
     * @return Discussion
     */
    public function setReponse($reponse = null)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return reponse
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set advancedInfos
     *
     * @param $advancedInfos
     *
     * @return Discussion
     */
    public function setAdvancedInfos($advancedInfos = null)
    {
        $this->advancedInfos = $advancedInfos;

        return $this;
    }

    /**
     * Get advancedInfos
     *
     * @return advancedInfos
     */
    public function getAdvancedInfos()
    {
        return $this->advancedInfos;
    }

	/**
	 * Set domain
	 *
	 * @param \VimoliaBundle\Entity\Practdomains $domain
	 *
	 * @return Discussion
	 */
	public function setDomain(\VimoliaBundle\Entity\Practdomains $domain = null)
	{
		$this->domain = $domain;

		return $this;
	}

	/**
	 * Get domain
	 *
	 * @return \VimoliaBundle\Entity\Practdomains
	 */
	public function getDomain()
	{
		return $this->domain;
	}
}
