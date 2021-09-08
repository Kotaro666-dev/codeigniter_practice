<?php

    class Post_model extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
        }

        public function get_posts($slug = false, $limit = false, $offset = false)
        {
            if ($limit) {
                $this->db->limit($limit, $offset);
            }
            if ($slug === false) {
                $this->db->order_by('posts.id', 'DESC');
                $this->db->join('categories', 'categories.id = posts.category_id');
                $query = $this->db->get('posts');
                return $query->result_array();
            }
            $query = $this->db->get_where('posts', array('slug' => $slug));
            return $query->row_array();
        }

        public function update_views($post_id)
        {
            // return current article views
            $this->db->where('id', $post_id);
            $this->db->select('views');
            $post = $this->db->get('posts')->row();

            // then increase by one
            $this->db->where('id', $post_id);
            $this->db->set('views', ($post->views + 1));
            $this->db->update('posts');
        }

        public function create_post($post_image)
        {
            $slug = url_title($this->input->post('title'));

            $data =array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'body' => $this->input->post('body'),
                'category_id' => $this->input->post('category_id'),
                'user_id' => $this->session->userdata('user_id'),
                'post_image' => $post_image,
            );

            return $this->db->insert('posts', $data);
        }

        public function delete_post($id)
        {
            $this->db->where('id', $id);
            $this->db->delete('posts');
            return true;
        }

        public function update_post()
        {
            $slug = url_title($this->input->post('title'));

            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'body' => $this->input->post('body'),
                'category_id' => $this->input->post('category_id'),
                'updated_at' => date("Y-m-d H:i:s"),
            );
            $this->db->where('id', $this->input->post('id'));
            return $this->db->update('posts', $data);
        }

        public function get_posts_by_category($category_id)
        {
            $this->db->order_by('posts.id', 'DESC');
            $this->db->join('categories', 'categories.id = posts.category_id');
            $query = $this->db->get_where('posts', array('category_id' => $category_id));
            return $query->result_array();
        }
    }
