<?php

namespace Yit\HelpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\Groups;


/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="Yit\HelpBundle\Entity\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"category"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     * @Groups({"category"})
     */
    private $name;

    /**
     * @var text $title
     *
     * @ORM\Column(length=255, nullable=true)
     *
     */
    private $title;

    /**
     * @var string slug
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", length=100, unique=true, nullable=false)
     *
     */
    private $slug;

    /**
     * @var \$article
     * @ORM\OneToMany(targetEntity="Article", mappedBy="category", cascade={"persist"})
     * @ORM\OrderBy({"position" = "ASC"})
     * @Groups({"category_article"})
     */
    protected $article;

    /**
     * @var int $position
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     */
    protected  $position;

    /**
     * @return string
     */
    public function __toString()
    {
        return ($this->name) ? $this->name : '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Category
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
     * Set title
     *
     * @param string $title
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Category
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
     * Add article
     *
     * @param \Yit\HelpBundle\Entity\Article $article
     * @return Category
     */
    public function addArticle(\Yit\HelpBundle\Entity\Article $article)
    {
        $this->article[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \Yit\HelpBundle\Entity\Article $article
     */
    public function removeArticle(\Yit\HelpBundle\Entity\Article $article)
    {
        $this->article->removeElement($article);
    }

    /**
     * Get article
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Category
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
