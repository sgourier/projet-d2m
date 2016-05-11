<?php

namespace VimoliaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Advancedinfos
 *
 * @ORM\Table(name="advancedinfos")
 * @ORM\Entity
 */
class Advancedinfos
{
    /**
     * @var string
     *
     * @ORM\Column(name="symptoms", type="text", length=65535, nullable=true)
     */
    private $symptoms;

    /**
     * @var string
     *
     * @ORM\Column(name="particularPains", type="text", length=65535, nullable=true)
     */
    private $particularpains;

    /**
     * @var string
     *
     * @ORM\Column(name="antecedents", type="text", length=65535, nullable=true)
     */
    private $antecedents;

    /**
     * @var string
     *
     * @ORM\Column(name="otherInformations", type="text", length=65535, nullable=true)
     */
    private $otherinformations;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set symptoms
     *
     * @param string $symptoms
     *
     * @return Advancedinfos
     */
    public function setSymptoms($symptoms)
    {
        $this->symptoms = $symptoms;

        return $this;
    }

    /**
     * Get symptoms
     *
     * @return string
     */
    public function getSymptoms()
    {
        return $this->symptoms;
    }

    /**
     * Set particularpains
     *
     * @param string $particularpains
     *
     * @return Advancedinfos
     */
    public function setParticularpains($particularpains)
    {
        $this->particularpains = $particularpains;

        return $this;
    }

    /**
     * Get particularpains
     *
     * @return string
     */
    public function getParticularpains()
    {
        return $this->particularpains;
    }

    /**
     * Set antecedents
     *
     * @param string $antecedents
     *
     * @return Advancedinfos
     */
    public function setAntecedents($antecedents)
    {
        $this->antecedents = $antecedents;

        return $this;
    }

    /**
     * Get antecedents
     *
     * @return string
     */
    public function getAntecedents()
    {
        return $this->antecedents;
    }

    /**
     * Set otherinformations
     *
     * @param string $otherinformations
     *
     * @return Advancedinfos
     */
    public function setOtherinformations($otherinformations)
    {
        $this->otherinformations = $otherinformations;

        return $this;
    }

    /**
     * Get otherinformations
     *
     * @return string
     */
    public function getOtherinformations()
    {
        return $this->otherinformations;
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
