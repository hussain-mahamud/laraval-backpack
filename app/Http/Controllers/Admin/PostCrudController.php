<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PostCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Post::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/post');
        CRUD::setEntityNameStrings('post', 'posts');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // set columns from db columns.
        CRUD::column('title')->type('text')->label('Title');
        CRUD::column('category')->type('select')->label('Category');
        CRUD::column('content')->type('summernote')->label('Content');
        CRUD::column('image')->type('image');
        //CRUD::column('image')->type('image')->height('10%')->width('10%');

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PostRequest::class);
        CRUD::field([
            'name'  => 'title',
            'type'  => 'text',
            'label' => 'Title',
        ]);
        CRUD::field([
            'name'  => 'category_id',
            'type'  => 'select',
            'label' => 'Category',
        ]);
        CRUD::field([
            'name'  => 'content',
            'type'  => 'summernote',
            'label' => 'Content',
        ]);
        CRUD::field([
            'name'  => 'image',
            'type'  => 'upload',
            'label' => 'Image',
            'withFiles' => true
        ]);

        //CRUD::setFromDb(); // set fields from db columns.

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::field([
            'name'  => 'title',
            'type'  => 'text',
            'label' => 'Title',
        ]);
        CRUD::field([
            'name'  => 'category_id',
            'type'  => 'select',
            'label' => 'Category',
        ]);
        CRUD::field([
            'name'  => 'content',
            'type'  => 'summernote',
            'label' => 'Content',
        ]);
        CRUD::field([
            'name'  => 'image',
            'type'  => 'upload',
            'label' => 'Image',
        ]);

        $this->setupCreateOperation();
    }
}
