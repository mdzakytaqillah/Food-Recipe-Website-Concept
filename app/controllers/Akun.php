<?php
class Akun extends Controller {
    public function index(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/akun/login');
            exit;
        }
        $data['id'] = $_SESSION['idAkun'];
        $data['title'] = 'Akun';
        $data['owningName'] = 'Anda';
        $data['resep'] = $this->model('resep_model')->getResepOwning($_SESSION['idAkun']);
        $data['likeResep'] = $this->model('resep_model')->userLike($_SESSION['idAkun']);
        $data['markResep'] = $this->model('resep_model')->userMark($_SESSION['idAkun']);
        $person = $this->model('akun_model')->getAkunbyID($_SESSION['idAkun']);
        $data['name'] = $person['Name'];
        $this->view('frame/header', $data);
        $this->view('akun/index', $data);
        $this->view('frame/footer', $data);
    }

    public function login(){
        if(isset($_SESSION['login'])){
            header('Location: ' . BASEURL . '/');
            exit;
        }
        $data['title'] = 'Login Akun';
        $this->view('akun/login', $data);
    }

    public function signup(){
        if(isset($_SESSION['login'])){
            header('Location: ' . BASEURL . '/');
            exit;
        }
        $data['title'] = 'Registrasi Akun';
        $this->view('akun/daftar', $data);
    }

    public function logout(){
        $_SESSION['login'] = '';
        $_SESSION['idAkun'] = '';
        unset($_SESSION['login']);
        unset($_SESSION['idAkun']);
        header('Location: ' . BASEURL . '/');
        exit;
    }

    public function addAkun(){
        //var_dump($_POST);
        if($this->model('akun_model')->newAkun($_POST) > 0){
            Flasher::setFlash('Akun anda berhasil didaftarkan', 'success');
            header('Location: ' . BASEURL . '/akun/login');
            exit;
        }else{
            header('Location: ' . BASEURL . '/akun/signup');
            exit;
        }
    }

    public function checkAkun(){
        //var_dump($_POST);
        if($this->model('akun_model')->loginAkun($_POST) > 0){
            header('Location: ' . BASEURL . '/');
            exit;
        }else{
            header('Location: ' . BASEURL . '/akun/login');
            exit;
        }
    }
}