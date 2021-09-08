<?php

class Pages extends CI_Controller
{
    public function view($page = 'home')
    {
        if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
            show_404();
        }

        // ucfirst — 文字列の最初の文字を大文字にする
        $data['title'] = ucfirst($page);
        $this->load->view('templates/header');
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer');
    }
}
