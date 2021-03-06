<?php

    /**
     * @property CI_Input 				$input
     * @property CI_DB_query_builder 	$db
     */
    class User_model extends CI_Model
    {
        public function register($enc_password)
        {
            // User data array

            $data = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'zipcode' => $this->input->post('zipcode'),
                'password' => $enc_password,
            );
            return $this->db->insert('users', $data);
        }

        public function login($username, $password)
        {
            // Validate
            $this->db->where('username', $username);
            $this->db->where('password', $password);

            $result = $this->db->get('users');

            if ($result->num_rows() == 1) {
                return $result->row(0)->id;
            } else {
                return false;
            }
        }

        public function get_email($user_id)
        {
            // Validate
            $this->db->where('id', $user_id);

            $result = $this->db->get('users');

            if ($result->num_rows() == 1) {
                return $result->row(0)->email;
            } else {
                return false;
            }
        }

        public function check_username_exists($username)
        {
            $query = $this->db->get_where('users', array('username' => $username));
            if (empty($query->row_array())) {
                return true;
            } else {
                return false;
            }
        }

        public function check_email_exists($email)
        {
            $query = $this->db->get_where('users', array('email' => $email));
            if (empty($query->row_array())) {
                return true;
            } else {
                return false;
            }
        }
    }
