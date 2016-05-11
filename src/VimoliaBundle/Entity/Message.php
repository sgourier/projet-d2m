<?php

namespace VimoliaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="fk_Message_Discussion1_idx", columns={"id_discussion"}), @ORM\Index(name="fk_Message_Video1_idx", columns={"id_video"}), @ORM\Index(name="fk_Message_User1_idx", columns={"id_owner"})})
 * @ORM\Entity
 */
class Message
{
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
     *   @ORM\JoinColumn(name="id_owner", referencedColumnName="id")
     * })
     */
    private $idOwner;

    /**
     * @var \VimoliaBundle\Entity\Video
     *
     * @ORM\ManyToOne(targetEntity="VimoliaBundle\Entity\Video")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_video", referencedColumnName="id")
     * })
     */
    private $idVideo;

    /**
     * @var \VimoliaBundle\Entity\Discussion
     *
     * @ORM\ManyToOne(targetEntity="VimoliaBundle\Entity\Discussion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_discussion", referencedColumnName="id")
     * })
     */
    private $idDiscussion;



    /**
     * Set text
     *
     * @param string $text
     *
     * @return Message
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
     * @return Message
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
     * @return Message
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
     * @return Message
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idOwner
     *
     * @param \UserBundle\Entity\User $idOwner
     *
     * @return Message
     */
    public function setIdOwner(\UserBundle\Entity\User $idOwner = null)
    {
        $this->idOwner = $idOwner;

        return $this;
    }

    /**
     * Get idOwner
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdOwner()
    {
        return $this->idOwner;
    }

    /**
     * Set idVideo
     *
     * @param \VimoliaBundle\Entity\Video $idVideo
     *
     * @return Message
     */
    public function setIdVideo(\VimoliaBundle\Entity\Video $idVideo = null)
    {
        $this->idVideo = $idVideo;

        return $this;
    }

    /**
     * Get idVideo
     *
     * @return \VimoliaBundle\Entity\Video
     */
    public function getIdVideo()
    {
        return $this->idVideo;
    }

    /**
     * Set idDiscussion
     *
     * @param \VimoliaBundle\Entity\Discussion $idDiscussion
     *
     * @return Message
     */
    public function setIdDiscussion(\VimoliaBundle\Entity\Discussion $idDiscussion = null)
    {
        $this->idDiscussion = $idDiscussion;

        return $this;
    }

    /**
     * Get idDiscussion
     *
     * @return \VimoliaBundle\Entity\Discussion
     */
    public function getIdDiscussion()
    {
        return $this->idDiscussion;
    }
}
