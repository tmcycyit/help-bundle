<?php

namespace Yit\HelpBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Route\RouteCollection;


class ArticleAdmin extends Admin
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
            ->add('year_bd', null, array('label' => 'year_bd'))
            ->add('description', null, array('label' => 'description'))
            ->add('author', null, array('label' => 'author'))
            ->add('architect', null, array('label' => 'architect'))
            ->add('substance', null, array('label' => 'substance'))
            ->add('insert_data', null, array('label' => 'insert_data'))
            ->add('place', null, array('label' => 'place'))
            ->add('content', null, array('label' => 'content'))
            ->add('slug', null, array('label' => 'Slug'));
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
            ->add('content')
            ->add('slug')
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
            ->add('category')
            ->add('content')
            ->add('slug', null, array('required' => false))
            ->add('image', 'sonata_type_model_list', array('required' => false), array('link_parameters' => array('context' => 'default', 'provider' => 'sonata.media.provider.image')))
            ->end();
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
            ->add('content')
            ->add('slug');
    }

}