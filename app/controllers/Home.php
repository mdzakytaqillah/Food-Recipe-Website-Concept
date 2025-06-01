<?php
class Home extends Controller {
    public function index(){
        $data['title'] = 'Home';
        $data['resep'] = $this->model('resep_model')->getResep();
        $data['mostFav'] = $this->model('resep_model')->mostFav(3);
        $this->view('frame/header', $data);
        $this->view('home/index', $data);
        $this->view('frame/footer', $data);
    }
}