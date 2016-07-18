<?php

namespace VimoliaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Videocategory
 *
 * @ORM\Table(name="videocategory", indexes={@ORM\Index(name="fk_VideoCategory_VideoCategory1_idx", columns={"id_videoCategory"})})
 * @ORM\Entity
 */
class Videocategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \VimoliaBundle\Entity\Videocategory
     *
     * @ORM\ManyToOne(targetEntity="VimoliaBundle\Entity\Videocategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_videoCategory", referencedColumnName="id")
     * })
     */
    private $idVideocategory;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=1000, nullable=true)
	 */
	private $name;

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
     * Set idVideocategory
     *
     * @param \VimoliaBundle\Entity\Videocategory $idVideocategory
     *
     * @return Videocategory
     */
    public function setIdVideocategory(\VimoliaBundle\Entity\Videocategory $idVideocategory = null)
    {
        $this->idVideocategory = $idVideocategory;

        return $this;
    }

    /**
     * Get idVideocategory
     *
     * @return \VimoliaBundle\Entity\Videocategory
     */
    public function getIdVideocategory()
    {
        return $this->idVideocategory;
    }

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName( $name )
	{
		$this->name = $name;
	}
}
