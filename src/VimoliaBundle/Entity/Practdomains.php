<?php

namespace VimoliaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Practdomains
 *
 * @ORM\Table(name="practdomains")
 * @ORM\Entity
 */
class Practdomains
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=1500, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Practdomains
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
