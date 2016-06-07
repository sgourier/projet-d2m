<?php

namespace VimoliaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subscribe
 *
 * @ORM\Table(name="subscribe", indexes={@ORM\Index(name="fk_Subscribe_SubscribeType1_idx", columns={"id_subscribeType"}), @ORM\Index(name="fk_Subscribe_User1_idx", columns={"id_user"})})
 * @ORM\Entity
 */
class Subscribe
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_command", type="string", length=1500, nullable=true)
     */
    private $idCommand;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime", nullable=true)
     */
    private $enddate;

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
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var \VimoliaBundle\Entity\Subscribetype
     *
     * @ORM\ManyToOne(targetEntity="VimoliaBundle\Entity\Subscribetype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_subscribeType", referencedColumnName="id")
     * })
     */
    private $idSubscribetype;



    /**
     * Set idCommand
     *
     * @param string $idCommand
     *
     * @return Subscribe
     */
    public function setIdCommand($idCommand)
    {
        $this->idCommand = $idCommand;

        return $this;
    }

    /**
     * Get idCommand
     *
     * @return string
     */
    public function getIdCommand()
    {
        return $this->idCommand;
    }

    /**
     * Set enddate
     *
     * @param \DateTime $enddate
     *
     * @return Subscribe
     */
    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;

        return $this;
    }

    /**
     * Get enddate
     *
     * @return \DateTime
     */
    public function getEnddate()
    {
        return $this->enddate;
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
     * Set idUser
     *
     * @param \UserBundle\Entity\User $idUser
     *
     * @return Subscribe
     */
    public function setIdUser(\UserBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idSubscribetype
     *
     * @param \VimoliaBundle\Entity\Subscribetype $idSubscribetype
     *
     * @return Subscribe
     */
    public function setIdSubscribetype(\VimoliaBundle\Entity\Subscribetype $idSubscribetype = null)
    {
        $this->idSubscribetype = $idSubscribetype;

        return $this;
    }

    /**
     * Get idSubscribetype
     *
     * @return \VimoliaBundle\Entity\Subscribetype
     */
    public function getIdSubscribetype()
    {
        return $this->idSubscribetype;
    }
}