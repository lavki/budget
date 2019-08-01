<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class WalletController
 */
class WalletController extends CI_Controller
{
    /**
     * WalletController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('wallet_model');
        $this->load->model('category_model');
        $this->load->model('currency_model');
        $this->load->model('type_model');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span id="helpBlock" class="help-block">', '</span>');
    }

    /**
     * List all wallet information by category
     */
    public function index()
    {
        $data = [
            'title' => 'Budget by category',
            'path'  => 'wallet/category_wallet_view',
            'data'  => []
        ];

        $this->load->view('template/template_view', $data);
    }

    /**
     * The wallet information group by month
     */
    public function monthsInformation()
    {
        $data = [
            'title' => 'Budget by month',
            'path'  => 'wallet/months_wallet_view',
            'data'  => []
        ];

        $this->load->view('template/template_view', $data);
    }

    /**
     * List all wallet information in details
     */
    public function detailsInformation()
    {
        $data = [
            'title' => 'Budget by details',
            'path'  => 'wallet/list_wallet_view',
            'data'  => [
                'datails' => $this->wallet_model->readWalletInformation(),
            ]
        ];

        $this->load->view('template/template_view', $data);
    }

    /**
     * Read wallet by category
     */
    public function categoryInfo()
    {
        $info = $this->wallet_model->readSpentByCategory();

        echo json_encode($info);
    }

    /**
     * Read wallet info by given status
     * @param int $status
     */
    public function readWalletInfo()
    {
        $info = $this->wallet_model->readWalletInfo();

        echo json_encode($info);
    }

    /**
     * Add money to the wallet
     */
    public function addMoney()
    {
        $data = [
            'title' => 'Add money',
            'path'  => 'wallet/add_money_view',
            'data'  => [
                'categories' => $this->category_model->readCategoriesByStatus([1]),
                'currencies' => $this->currency_model->readCurrencies(),
                'types'      => $this->type_model->readTypesByCategory(3),
            ]
        ];

        $this->formValidation();

        if( $this->form_validation->run() == FALSE ) {
            $this->load->view('template/template_view', $data);
        } else {
            $put = $this->wallet_model->addMoney($this->input->post());

            if( $put ) {
                redirect('/');
            } else {
                $data['data']['error'] = 'An unexpected error occurred while transferring funds.';
                $data['data']['money'] = $this->input->post('sum');
                $this->load->view('template/template_view', $data);
            }
        }
    }

    /**
     * Get money from the wallet
     */
    public function addSpent()
    {
        $data = [
            'title' => 'Add Spent',
            'path'  => 'wallet/spent_money_view',
            'data'  => [
                'categories' => $this->category_model->readCategoriesByStatus([2, 3]),
                'currencies' => $this->currency_model->readCurrencies(),
            ]
        ];

        $this->formValidation();

        if( $this->form_validation->run() == FALSE ) {
            $this->load->view('template/template_view', $data);
        } else {
            $get = $this->wallet_model->addSpent($this->input->post());

            if( $get ) {
                redirect('/');
            } else {
                $data['data']['error'] = 'An unexpected error occurred while making a payment.';
                $data['data']['money'] = $this->input->post('sum');
                $this->load->view('template/template_view', $data);
            }
        }
    }

    public function databaseShema()
    {
        $data = [
            'title' => 'Budget Database shema',
            'path'  => 'wallet/database_shema_view',
            'data'  => []
        ];

        $this->load->view('template/template_view', $data);
    }

    /**
     * Form validation settings
     */
    private function formValidation()
    {
        $config = [
            [
                'field'  => 'sum',
                'label'  => 'Sum',
                'rules'  => 'required',
            ],
            [
                'field'  => 'currency',
                'label'  => 'Currency',
                'rules'  => 'required',
            ],
            [
                'field'  => 'category',
                'label'  => 'Category',
                'rules'  => 'required',
            ],
            [
                'field'  => 'type',
                'label'  => 'Type',
                'rules'  => 'required',
            ],
        ];

        $this->form_validation->set_rules($config);
    }
}