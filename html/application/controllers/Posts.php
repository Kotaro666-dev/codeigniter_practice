<?php

    /**
     * @property  Post_model 			$post_model
     * @property  Comment_model 		$comment_model
     * @property  Category_model 		$category_model
     * @property  CI_Form_validation 	$form_validation
     * @property  CI_Pagination 		$pagination
     * @property  CI_Input 				$input
     * @property  CI_Session			$session
     * @property  CI_Upload				$upload
     * @property  CI_DB_query_builder	$db
     */
    class Posts extends CI_Controller
    {
        public function index($offset = 0)
        {
            // Pagination config
            $config['base_url'] = base_url() . 'posts/index/';
            $config['total_rows'] = $this->db->count_all('posts');
            $config['per_page'] = 3;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-links');

            // Init Pagination
            $this->pagination->initialize($config);

            $data['title'] = 'Latest Posts';

            $data['posts'] = $this->post_model->get_posts(false, $config['per_page'], $offset);

            $this->load->view('templates/header');
            $this->load->view('posts/index', $data);
            $this->load->view('templates/footer');
        }

        public function view($slug = null)
        {
            $data['post'] = $this->post_model->get_posts($slug);
            $post_id = $data['post']['id'];
            $data['comments'] = $this->comment_model->get_comments($post_id);

            if (empty($data['post'])) {
                show_404();
            }
            // views をインクリメント
            $this->increment_views($slug, $post_id);


            $data['title'] = $data['post']['title'];
            $this->load->view('templates/header');
            $this->load->view('posts/view', $data);
            $this->load->view('templates/footer');
        }

        // REFERENCE: https://webeasystep.com/blog/view_article/how_to_build_unique_visitors_counter_with_codeigniter
        private function increment_views($slug, $post_id)
        {
            // load cookie helper
            $this->load->helper('cookie');
            // this line will return the cookie which has slug name
            $check_visitor = $this->input->cookie(urldecode($slug), false);
            // this line will return the visitor ip address
            $ip = $this->input->ip_address();
            // if the visitor visit this article for first time then //
            //set new cookie and update article_views column  ..
            //you might be notice we used slug for cookie name and ip
            //address for value to distinguish between articles  views
            if ($check_visitor) {
                return;
            }
            $cookie = array(
                "name"   => urldecode($slug),
                "value"  => "$ip",
                "expire" =>  time() + 7200,
                "secure" => false
            );
            $this->input->set_cookie($cookie);
            $this->post_model->update_views($post_id);
        }

        public function create()
        {
            // Check login
            if (!$this->session->userdata('logged_in')) {
                redirect('users/login');
            }

            $data['title'] = 'Create Post';

            $data['categories'] = $this->category_model->get_categories();

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('body', 'Body', 'required');
            $this->form_validation->set_error_delimiters('<div class="error_message">', '</div>');

            if ($this->form_validation->run() === false) {
                $this->load->view('templates/header');
                $this->load->view('posts/create', $data);
                $this->load->view('templates/footer');
            } else {
                // Upload Image
                $config['upload_path'] = './assets/images/posts';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '4096';
                $config['max_width'] = '2048';
                $config['max_height'] = '2048';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload()) {
                    $errors = array(
                        'error' => $this->upload->display_errors());
                    $post_image = 'no_image.png';
                } else {
                    $data = array(
                        'upload_data' => $this->upload->data());
                    $post_image = $_FILES['userfile']['name'];
                }

                // Set message
                $this->session->set_flashdata('post_created', 'Your post has been created');

                $this->post_model->create_post($post_image);
                redirect('posts');
            }
        }

        public function delete($id)
        {
            // Check login
            if (!$this->session->userdata('logged_in')) {
                redirect('users/login');
            }

            $this->post_model->delete_post($id);

            // Set message
            $this->session->set_flashdata('post_deleted', 'Your post has been deleted');
            redirect('posts');
        }

        public function edit($slug)
        {
            // Check login
            if (!$this->session->userdata('logged_in')) {
                redirect('users/login');
            }

            $data['post'] = $this->post_model->get_posts($slug);

            // Check user
            if ($this->session->userdata('user_id') != $this->post_model->get_posts($slug)['user_id']) {
                redirect('posts');
            }

            $data['categories'] = $this->category_model->get_categories();
            if (empty($data['post'])) {
                show_404();
            }

            $data['title'] = 'Edit Post';
            $this->load->view('templates/header');
            $this->load->view('posts/edit', $data);
            $this->load->view('templates/footer');
        }

        public function update()
        {
            // Check login
            if (!$this->session->userdata('logged_in')) {
                redirect('users/login');
            }

            // Set message
            $this->session->set_flashdata('post_updated', 'Your post has been updated');

            $this->post_model->update_post();
            redirect('posts');
        }
    }
