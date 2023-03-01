<?php 

if (!defined('BASEPATH')) {
    exit("no direct script allowed");
}

class Room extends Admin_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('room_model');
    }

    public function index(){ //ADD ROOM
        if (!$this->rbac->hasPrivilege('room', 'can_view')) {
            access_denied();
        }
        #UNDER MENU
        // $this->session->set_userdata('top_menu', 'Academics');
        // $this->session->set_userdata('sub_menu', 'sections/index');
        $data['title'] = "Room List";

        $room_result = $this->room_model->get();
        $data['roomList'] = $room_result;

        #VALIDATION
        $this->form_validation->set_rules('roomcode', 'Room Code', 'trim|required|xss_clean');
        $this->form_validation->set_rules('roomname', 'Room Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('roomtype', 'Room Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('building', 'Building', 'trim|required|xss_clean');
        $this->form_validation->set_rules('floor', 'Floor', 'trim|required|xss_clean');
        $this->form_validation->set_rules('length', 'Length', 'trim|required|xss_clean');
        $this->form_validation->set_rules('width', 'Width', 'trim|required|xss_clean');
        $this->form_validation->set_rules('spacearea', 'Space Area', 'trim|required|xss_clean');
        $this->form_validation->set_rules('capacity', 'Capacity', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/room/roomList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array (
                'room_code' => $this->input->post('roomcode'),
                'room_name' => $this->input->post('roomname'),
                'room_type' => $this->input->post('roomtype'),
                'building'  => $this->input->post('building'),
                'floor'     => $this->input->post('floor'),
                'length'    => $this->input->post('length'),
                'width'     => $this->input->post('width'),
                'space_area'    => $this->input->post('spacearea'),
                'capacity'      => $this->input->post('capacity'),
            );
            $this->room_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('success_message').'</div>');
            redirect('admin/room');
        }

        
    }

    public function delete($id){
        if (!$this->rbac->hasPrivilege('room', 'can_delete')) {
            access_denied();
        }
        $data['title'] = "Room List";
        $this->room_model->remove($id);

        redirect('admin/room');
    }

    public function edit($id){
        if (!$this->rbac->hasPrivilege('room', 'can_edit')){
            access_denied();
        }

        $data['title']      = 'Room List';
        $room_result        = $this->room_model->get();
        $data['roomlist']   = $room_result;
        $data['title']      = 'Edit Room';
        $data['id']         = $id;
        $room               = $this->room_model->get($id);
        $data['room']       = $room;
        
        #VALIDATION
        $this->form_validation->set_rules('roomcode', 'Room Code', 'trim|required|xss_clean');
        $this->form_validation->set_rules('roomname', 'Room Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('roomtype', 'Room Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('building', 'Building', 'trim|required|xss_clean');
        $this->form_validation->set_rules('floor', 'Floor', 'trim|required|xss_clean');
        $this->form_validation->set_rules('length', 'Length', 'trim|required|xss_clean');
        $this->form_validation->set_rules('width', 'Width', 'trim|required|xss_clean');
        $this->form_validation->set_rules('spacearea', 'Space Area', 'trim|required|xss_clean');
        $this->form_validation->set_rules('capacity', 'Capacity', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/room/roomEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'room_code' => $this->input->post('roomcode'),
                'room_name' => $this->input->post('roomname'),
                'room_type' => $this->input->post('roomtype'),
                'building'  => $this->input->post('building'),
                'floor'     => $this->input->post('floor'),
                'length'    => $this->input->post('length'),
                'width'     => $this->input->post('width'),
                'space_area'    => $this->input->post('spacearea'),
                'capacity'      => $this->input->post('capacity'),
            );
            $this->room_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/room');
        }
    }
}