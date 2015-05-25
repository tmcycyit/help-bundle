<?php

namespace Yit\HelpBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Route\RouteCollection;


class CategoryAdmin extends Admin
{

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC', // sort direction
        '_sort_by' => 'id' // field name
    );

    /**
     * Row show configuration
     *
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id', null, array('label' => 'ID'))
            ->add('title', null, array('label' => 'Title'))
            ->add('slug', null, array('label' => 'Slug'))
            ->add('position', null, array('label' => 'Position'));
    }

    /**
     * List show configuration
     *
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array('label' => 'Name'))
            ->add('title')
            ->add('slug')
            ->add('position')
            ->add('_action', 'actions', array('actions' => array(
                'show' => array(),
                'edit' => array(),
                'delete' => array()
            )));
    }

    /**
     * Row form edit configuration
     *
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->with('General')
            ->add('name')
            ->add('title')
            ->add('position')
            ->add('slug', null, array('required' => false))
            ->add('article', 'sonata_type_collection', array(
                'required' => false,
                'by_reference' => false,
            ), array(
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
                'admin_code' => 'yit.help.admin.article',
            ));
    }

    /**
     * Fields in list rows search
     *
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('title', null, array('label' => 'Title'))
            ->add('slug');
    }

    /**
     * @param mixed $object
     * @return mixed|void
     */
    public function prePersist($object)
    {
        if($object->getArticle()){
            foreach($object->getArticle() as $article) {
                $article->setCategory($object);
            }
        }
    }

    /**
     * @param mixed $object
     * @return mixed|void
     */
    public function preUpdate($object)
    {
        if($object->getArticle()){
            foreach($object->getArticle() as $article) {
                $article->setCategory($object);
            }
        }
    }
}
