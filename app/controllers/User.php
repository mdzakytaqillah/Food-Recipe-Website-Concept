<?php
class User extends Controller {
    public function index($id){
        if(isset($_SESSION['login'])){
            if($_SESSION['idAkun'] === $id){
                header('Location: ' . BASEURL . '/akun');
                exit;
            }
        }
        $owning = $this->model('akun_model')->getAkunbyID($id);
        $data['id'] = $id;
        $data['owningName'] = $owning['Name'];
        $data['title'] = 'Pengguna' . ' ' . $data['owningName'];
        $data['resep'] = $this->model('resep_model')->getResepOwning($id);
        $this->view('frame/header', $data);
        $this->view('akun/index', $data);
        $this->view('frame/footer', $data);
    }

    public function search(){
        $data['title'] = 'Pencarian Pengguna';
        if(isset($_POST['usersearch'])){
            if($_POST['usersearch'] !== ""){
            $data['user'] = $this->model('akun_model')->searchUser($_POST['usersearch']);
            }else{
                header('Location: ' . BASEURL . '/');
                exit;
            }
        }else{
            header('Location: ' . BASEURL . '/');
            exit;
        }
        $this->view('frame/header', $data);
        $this->view('akun/search', $data);
        $this->view('frame/footer', $data);
    }
}