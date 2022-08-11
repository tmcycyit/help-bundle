<?php

namespace Tmcycyit\HelpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Table(name="yit_help_photo")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class HelpPhoto
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(name="original_name", type="string", length=50)
     */
    protected $originalName;

    /**
     * @ORM\Column(name="extension", type="string", length=10)
     */
    protected $extension;

    /**
     * @ORM\Column(name="originalPath", type="string", length=100)
     */
    protected $originalPath;

    /**
     * @ORM\Column(name="size", type="integer")
     */
    protected $size;
    /**
     * @Assert\Valid()
     * @Assert\File(
     *     maxSize = "6000000",
     *     mimeTypes = {"application/pdf", "image/jpeg", "image/png" , "application/msword","application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-excel","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" },
     *     mimeTypesMessage = "Կցվող ֆայլը կարող է լինել WORD, EXCEL ,JPG, JPEG, PNG և PDF ֆորմատների",
     *     maxSizeMessage = "Կցվող ֆայլը կարող է ունենալ մինչև 6 MB ծավալ"
     * )
     */
    protected $file;

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
     * @return string
     */
    public function makeFileName()
    {
        return md5(microtime());
    }

    /**
     * Set name
     *
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set originalName
     *
     * @param $originalName
     * @return $this
     */
    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * Set extension
     *
     * @param $extension
     * @return $this
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set size
     *
     * @param $size
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @ORM\PreRemove
     */
    public function preRemove()
    {
        if (is_file($this->getPath() . '/' . $this->name . '.' . $this->extension)) {
            unlink($this->getPath() . '/' . $this->name . '.' . $this->extension);
        }
    }

    /**
     * @return string
     */
    public function getUploadRootDir()
    {
        return __DIR__.'/../../../../../../web' . $this->getPath();
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return '/uploads/help_photos';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            $this->size--;
            return;
        }

        //Delete last file
        if (is_file($path = $this->getUploadRootDir() . '/' .
            $this->getName() . '.' . $this->getExtension())) {
            unlink($path);
        }

        $this->setName($this->makeFileName());
        $this->setOriginalName($this->getFile()->getClientOriginalName());
        $this->setExtension($this->getFile()->getClientOriginalExtension());

        $this->setOriginalPath($this->getPath().'/'. $this->getName(). '.' . $this->getFile()->getClientOriginalExtension());

        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getName() . '.' . $this->getExtension()
        );

        $this->setSize($this->getFile()->getClientSize());

        $this->file = null;
    }

    /**
     * @ORM\PostLoad
     */
    public function postLoad()
    {
        $this->size++;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getOriginalPath();
    }


    /**
     * Set originalPath
     *
     * @param string $originalPath
     * @return HelpPhoto
     */
    public function setOriginalPath($originalPath)
    {
        $this->originalPath = $originalPath;

        return $this;
    }

    /**
     * Get originalPath
     *
     * @return string 
     */
    public function getOriginalPath()
    {
        return $this->originalPath;
    }
}
