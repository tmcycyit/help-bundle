<?php

namespace Yit\HelpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\Groups;

/**
 * Article
 *
 * @ORM\Table(name="yit_help_article")
 * @ORM\Entity(repositoryClass="Yit\HelpBundle\Entity\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Article
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"article"})
     */
    private $id;

    /**
     * @var string name
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     * @Groups({"article"})
     */
    private $name = '';

    /**
     * @var string slug
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", length=100, unique=true, nullable=false)
     *
     */
    private $slug;

    /**
     * @var string
     * @ORM\Column(name="content", type="text", nullable=true)
     * @Groups({"content"})
     */
    private $content;

    /**
     * @var int $position
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     */
    protected  $position;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="article", cascade={"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="SET NULL")
     * @Groups({"article_category"})
     */
    private $category;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return ($this->name) ? $this->name : '';
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
     * Set name
     *
     * @param string $name
     * @return Article
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
     * Set slug
     *
     * @param string $slug
     * @return Article
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set category
     *
     * @param \Yit\HelpBundle\Entity\Category $category
     * @return Article
     */
    public function setCategory(\Yit\HelpBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Yit\HelpBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Article
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }
}
