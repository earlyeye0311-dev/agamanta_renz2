<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: User
 * 
 * Automatically generated via CLI.
 */
class Crud_Controller extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('crud_Model');
        $this->call->library('form_validation');

        // $this->call->helper('message');
    }

     public function read() 
    {
        
        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 3;

        $all = $this->crud_Model->page($q, $records_per_page, $page);
        $data['all'] = $all['records'];
        $total_rows = $all['total_rows'];
        $this->pagination->set_options([
            'first_link'     => '⏮️ First',
            'last_link'      => 'Last ⏭️',
            'next_link'      => 'Next ⏩',
            'prev_link'      => '⏪Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); // or 'tailwind', or 'custom'
        $this->pagination->initialize($total_rows, $records_per_page, $page, '/?q='.$q);
        $data['page'] = $this->pagination->paginate();
        $this->call->view('index', $data);
    }


  public function createUser()
    {
        $this->form_validation
            ->name('first_name')
                ->required()
                ->max_length(50)
                 ->name('last_name')
                ->required()
                ->max_length(50)
            ->name('Age')
                ->required()
                ->max_length(200)
                 ->name('email')
                ->required()
                ->max_length(200);
           

        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->get_errors();
            setErrors($errors);
            redirect('/');
        } else {
            $this->crud_Model->insert([
                'first_name' => $_POST['first_name'],
                 'last_name' => $_POST['last_name'],
                      'Age'  => $_POST['Age'],
                      'email'  => $_POST['email'],
                'created_at' => date('y-m-d H:i:s'),
               
            ]);

            setMessage('success', 'Student registered successfully!');
            redirect('/');
        }
    }

     public function updateUser($id){
        $this->crud_Model->update($id, [
            'first_name' => $_POST['first_name'],
              'last_name' => $_POST['last_name'],
            'Age'  => $_POST['Age'],
            'email'  => $_POST['email']
        ]);

        setMessage('success', ' updated successfully!');
        redirect('/');
    }


     public function deleteUser($id){
        $this->crud_Model->delete($id);
        setMessage('danger', ' deleted successfully!');
        redirect('/');
    }
}

