<?php

$this->load->view('template/header_view', $title);
$this->load->view($path, $data);
$this->load->view('template/footer_view');