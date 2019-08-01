<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class TypeController
 */
class TypeController extends CI_Controller
{
    /**
     * TypeController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('type_model');
        $this->load->model('category_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span id="helpBlock" class="help-block">', '</span>');
    }

    /**
     * List all avalaible categories
     */
    public function index()
    {
        $data = [
            'title' => 'Type list',
            'path'  => 'type/list_type_view',
            'data'  => [
                'types' => $this->type_model->readTypes(),
            ]
        ];

        $this->load->view('template/template_view', $data);
    }

    /**
     * Create new type
     */
    public function create()
    {
        $data = [
            'title' => 'Create type',
            'path'  => 'type/create_type_view',
            'data'  => [
                'categories' => $this->category_model->readCategories(),
            ]
        ];

        $this->formValidation();

        if( $this->form_validation->run() == FALSE ) {
            $this->load->view('template/template_view', $data);
        } else {
            $type = $this->type_model->createType($this->input->post());

            if( $type ) {
                redirect('/type');
            } else {
                $data['data']['error'] = 'An unexpected error occurred while creating a new type.';
                $data['data']['type']  = $this->input->post('type');
                $this->load->view('template/template_view', $data);
            }
        }
    }

    /**
     * Update existing type by given Id
     * @param int $id
     */
    public function update( int $id )
    {
        $data = [
            'title' => 'Update type',
            'path'  => 'type/update_type_view',
            'data'  => [
                'type'       => $this->type_model->readType( $id ),
                'categories' => $this->category_model->readCategories(),
            ]
        ];

        $this->formValidation(false );

        if( $this->form_validation->run() == FALSE ) {
            $this->load->view('template/template_view', $data);
        } else {
            $type = $this->type_model->updateType($this->input->post());

            if( $type ) {
                redirect('/type');
            } else {
                $data['data']['error'] = 'There was an error while editing the type.';
                $data['data']['type']  = $this->input->post('type');
                $this->load->view('template/template_view', $data);
            }
        }
    }

    /**
     * Delete existing type by given Id
     * @param int $id
     */
    public function delete( int $id )
    {
        $result = $this->type_model->deleteType( $id );

        echo json_decode($result);
    }

    /**
     * Read types by given category
     */
    public function readTypes( int $categoryId = 0 )
    {
        $types = $this->type_model->readTypesByCategory($categoryId);

        echo json_encode($types);
    }

    /**
     * Form validation and check need validate uniq value or not
     * @param bool $is_uniq
     */
    private function formValidation( bool $is_uniq = true )
    {
        // check type for uniq value or not
        $check_uniq = $is_uniq ? '|is_unique[type.type]' : null;

        $config = [
            [
                'field'  => 'type',
                'label'  => 'Назва типу',
                'rules'  => 'required|min_length[3]|max_length[50]' . $check_uniq,
            ],
            [
                'field'  => 'category',
                'label'  => 'Category of type',
                'rules'  => 'required',
            ],
        ];

        $this->form_validation->set_rules($config);
    }
}