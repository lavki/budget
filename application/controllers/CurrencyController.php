<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class CurrencyController
 */
class CurrencyController extends CI_Controller
{
    /**
     * CurrencyController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('currency_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span id="helpBlock" class="help-block">', '</span>');
    }

    /**
     * List all avalaible currencies
     */
    public function index()
    {
        $data = [
            'title' => 'Currency list',
            'path'  => 'currency/list_currency_view',
            'data'  => [
                'currencies' => $this->currency_model->readCurrencies(),
            ]
        ];

        $this->load->view('template/template_view', $data);
    }

    /**
     * Create new currency
     */
    public function create()
    {
        $data = [
            'title' => 'Add currency',
            'path'  => 'currency/create_currency_view',
            'data'  => []
        ];

        $this->formValidation();

        if( $this->form_validation->run() == FALSE ) {
            $this->load->view('template/template_view', $data);
        } else {
            $currency = $this->currency_model->createCurrency($this->input->post());

            if( $currency ) {
                redirect('/currency');
            } else {
                $data['data']['error']    = 'An unexpected error occurred while adding a new currency.';
                $data['data']['currency'] = $this->input->post('currency');
                $this->load->view('template/template_view', $data);
            }
        }
    }

    /**
     * Update existing currency by given Id
     * @param int $id
     */
    public function update( int $id )
    {
        $data = [
            'title' => 'Update currency',
            'path'  => 'currency/update_currency_view',
            'data'  => [
                'currency' => $this->currency_model->readCurrency($id),
            ]
        ];

        $this->formValidation(false );

        if( $this->form_validation->run() == FALSE ) {
            $this->load->view('template/template_view', $data);
        } else {
            $currency = $this->currency_model->updateCurrency($this->input->post());

            if( $currency ) {
                redirect('/currency');
            } else {
                $data['data']['error']    = 'There was an error while editing the currency.';
                $data['data']['currency'] = $this->input->post('currency');
                $this->load->view('template/template_view', $data);
            }
        }
    }

    /**
     * Delete existing currency by given Id
     * @param int $id
     */
    public function delete( int $id )
    {
        $result = $this->currency_model->deleteCurrency( $id );

        echo json_decode($result);
    }

    /**
     * Form validation and check need validate uniq value or not
     * @param bool $is_uniq
     */
    private function formValidation( bool $is_uniq = true )
    {
        // check currency for uniq value or not
        $check_uniq = $is_uniq ? '|is_unique[currency.currency]' : null;

        $config = [
            [
                'field'  => 'currency',
                'label'  => 'Назва валюти',
                'rules'  => 'required|min_length[3]|max_length[3]' . $check_uniq,
            ],
        ];

        $this->form_validation->set_rules($config);
    }
}