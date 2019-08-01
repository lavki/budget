<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class CategoryController
 */
class CategoryController extends CI_Controller
{
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('category_model');
        $this->load->model('status_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span id="helpBlock" class="help-block">', '</span>');
    }

    /**
     * List all avalaible categories
     */
    public function index()
    {
        $data = [
            'title' => 'Category list',
            'path'  => 'category/list_category_view',
            'data'  => [
                'categories' => $this->category_model->readCategories(),
            ]
        ];

        $this->load->view('template/template_view', $data);
    }

    /**
     * Create new category
     */
    public function create()
    {
        $data = [
            'title' => 'Create category',
            'path'  => 'category/create_category_view',
            'data'  => [
                'types' => $this->status_model->readStatuses(),
            ]
        ];

        $this->formValidation();

        if( $this->form_validation->run() == FALSE ) {
            $this->load->view('template/template_view', $data);
        } else {
            $categroy = $this->category_model->createCategory($this->input->post());

            if( $categroy ) {
                redirect('/category');
            } else {
                $data['data']['error']    = 'An unexpected error occurred while creating a new category.';
                $data['data']['category'] = $this->input->post('category');
                $this->load->view('template/template_view', $data);
            }
        }
    }

    /**
     * Update existing category by given Id
     * @param int $id
     */
    public function update( int $id )
    {
        $data = [
            'title' => 'Update category',
            'path'  => 'category/update_category_view',
            'data'  => [
                'category' => $this->category_model->readCategory($id),
                'types'    => $this->status_model->readStatuses(),
            ]
        ];

        $this->formValidation(false );

        if( $this->form_validation->run() == FALSE ) {
            $this->load->view('template/template_view', $data);
        } else {
            $categroy = $this->category_model->updateCategory($this->input->post());

            if( $categroy ) {
                redirect('/category');
            } else {
                $data['data']['error']    = 'There was an error while editing the category.';
                $data['data']['category'] = $this->input->post('category');
                $this->load->view('template/template_view', $data);
            }
        }
    }

    /**
     * Delete existing category by given Id
     * @param int $id
     */
    public function delete( int $id )
    {
        $result = $this->category_model->deleteCategory( $id );

        echo json_decode($result);
    }

    /**
     * Form validation and check need validate uniq value or not
     * @param bool $is_uniq
     */
    private function formValidation( bool $is_uniq = true )
    {
        // check category for uniq value or not
        $check_uniq = $is_uniq ? '|is_unique[category.category]' : null;

        $config = [
            [
                'field'  => 'category',
                'label'  => 'Назва категорії',
                'rules'  => 'required|min_length[3]|max_length[50]' . $check_uniq,
            ],
            [
                'field'  => 'type',
                'label'  => 'Тип категорії',
                'rules'  => 'required',
            ],
        ];

        $this->form_validation->set_rules($config);
    }
}