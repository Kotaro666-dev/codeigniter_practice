<?php

    /**
     * @property CI_Form_validation $form_validation
     * @property CI_Input $input
     * @property User_model $user_model
     * @property CI_Session $session
     */
    class Users extends CI_Controller
    {
        public function register()
        {
            $data['title'] = 'Sign Up';

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_exists');
            $this->form_validation->set_rules('password', 'Password', 'required|callback_check_password_is_strong');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'required|matches[password]');
            $this->form_validation->set_error_delimiters('<div class="error_message">', '</div>');

            if ($this->form_validation->run() === false) {
                $this->load->view('templates/header');
                $this->load->view('users/register', $data);
                $this->load->view('templates/footer');
            } else {
                // Encrypt password
                $enc_password = md5($this->input->post('password'));

                $this->user_model->register($enc_password);

                // Set message
                $this->session->set_flashdata('user_registered', 'You are registered and can log in');

                redirect('posts');
            }
        }

        // Check if username exists
        public function check_username_exists($username)
        {
            $this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');

            if ($this->user_model->check_username_exists($username)) {
                return true;
            } else {
                return false;
            }
        }

        // Check if email exists
        public function check_email_exists($email)
        {
            $this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');

            if ($this->user_model->check_email_exists($email)) {
                return true;
            } else {
                return false;
            }
        }

        // Check if password is strong
        public function check_password_is_strong($password)
        {
            $this->form_validation->set_message('check_password_is_strong', 'This password is weak. At least 1 number, one uppercase character, one lowercase character');

            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);

            if (!$uppercase || !$lowercase || !$number || (strlen($password) < 8)) {
                return false;
            } else {
                return true;
            }
        }

        public function login()
        {
            $data['title'] = 'Sign in';

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_error_delimiters('<div class="error_message">', '</div>');

            if ($this->form_validation->run() === false) {
                $this->load->view('templates/header');
                $this->load->view('users/login', $data);
                $this->load->view('templates/footer');
            } else {
                // Get username
                $username = $this->input->post('username');
                // Get and encrypt the password
                $password = md5($this->input->post('password'));
                // Get email

                // login user
                $user_id = $this->user_model->login($username, $password);

                if ($user_id) {
                    // Create session
                    $user_data = array(
                        'user_id' => $user_id,
                        'username' => $username,
                        'email' => $this->user_model->get_email($user_id),
                        'logged_in' => true,
                    );

                    $this->session->set_userdata($user_data);

                    // Set message
                    $this->session->set_flashdata('user_loggedin', 'Hello '.$username.'. You are now logged in');

                    redirect('posts');
                } else {
                    // Set error message
                    $this->session->set_flashdata('login_failed', 'Login is invalid');

                    redirect('users/login');
                }
            }
        }

        public function logout()
        {
            // Unset user data
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');

            // Set message
            $this->session->set_flashdata('user_loggedout', 'You are now logged out');

            redirect('users/login');
        }
    }
