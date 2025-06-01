<?php
class Resep extends Controller {
    public function index(){
        $data['title'] = 'Resep';
        if(isset($_POST['recipesearch']) || isset($_POST['ingredientexclude']) || isset($_POST['equipexclude'])){
            if($_POST['recipesearch'] !== "" || $_POST['ingredientexclude'] !== "" || $_POST['equipexclude'] !== ""){
            $data['resep'] = $this->model('resep_model')->searchResep($_POST);
            }else{
                $data['resep'] = $this->model('resep_model')->getResep();
            }
        }else{
            $data['resep'] = $this->model('resep_model')->getResep();
        }
        $this->view('frame/header', $data);
        $this->view('resep/index', $data);
        $this->view('frame/footer', $data);
    }

    public function detail($id){
        $data['resep'] = $this->model('resep_model')->getResepbyID($id);
        $data['title'] = $data['resep']['recipeTitle'];
        $ownerID = $data['resep']['userID'];
        $data['owner'] = $this->model('resep_model')->ownerSearch($ownerID);
        $data['sumlike'] = $this->model('resep_model')->likecounter($id);
        if(isset($_SESSION['login'])){
            $data['isLike'] = $this->model('resep_model')->islike($_SESSION['idAkun'], $id);
            $data['isMark'] = $this->model('resep_model')->ismark($_SESSION['idAkun'], $id);
        }
        $this->view('frame/header', $data);
        $this->view('resep/detail', $data);
        $this->view('frame/footer', $data);
    }

    public function upload(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/akun/login');
            exit;
        }
        if(isset($_SESSION['formtemp'])){
            $data['value'] = $_SESSION['formtemp'];
            $_SESSION['formtemp'] = '';
            unset($_SESSION['formtemp']);
        }
        $data['title'] = 'Upload Resep';
        $this->view('frame/header', $data);
        $this->view('resep/upload', $data);
        $this->view('frame/footer', $data);
    }

    public function add(){
        //var_dump($_POST);
        if($this->model('resep_model')->newResep($_POST, $_FILES) > 0){
            Flasher::setFlash('Resep anda berhasil diunggah', 'success');
            if(isset($_SESSION['formtemp'])){
                $_SESSION['formtemp'] = '';
                unset($_SESSION['formtemp']);
            }
            header('Location: ' . BASEURL . '/resep');
            exit;
        }else{
            $_SESSION['formtemp'] = $_POST;
            header('Location: ' . BASEURL . '/resep/upload');
            exit;
        }
    }

    public function likerecipe($id){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'danger');
            header('Location: ' . BASEURL . '/resep/detail/' . $id);
            return 0;
            exit;
        }else{
            if($this->model('resep_model')->like($_SESSION['idAkun'], $id) > 0){
                Flasher::setFlash('Ucapan terima kasih berhasil disampaikan', 'success');
                header('Location: ' . BASEURL . '/resep/detail/' . $id);
                exit;
            }else{
                Flasher::setFlash('ERROR', 'danger');
                header('Location: ' . BASEURL . '/resep/detail/' . $id);
                return 0;
                exit;
            }
        }
    }

    public function unlikerecipe($id){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'danger');
            header('Location: ' . BASEURL . '/resep/detail/' . $id);
            return 0;
            exit;
        }else{
            if($this->model('resep_model')->unlike($_SESSION['idAkun'], $id) > 0){
                Flasher::setFlash('Ucapan terima kasih berhasil dibatalkan', 'secondary');
                header('Location: ' . BASEURL . '/resep/detail/' . $id);
                exit;
            }else{
                Flasher::setFlash('ERROR', 'danger');
                header('Location: ' . BASEURL . '/resep/detail/' . $id);
                return 0;
                exit;
            }
        }
    }

    public function markrecipe($id){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'danger');
            header('Location: ' . BASEURL . '/resep/detail/' . $id);
            return 0;
            exit;
        }else{
            if($this->model('resep_model')->mark($_SESSION['idAkun'], $id) > 0){
                Flasher::setFlash('Resep berhasil ditandai', 'success');
                header('Location: ' . BASEURL . '/resep/detail/' . $id);
                exit;
            }else{
                Flasher::setFlash('ERROR', 'danger');
                header('Location: ' . BASEURL . '/resep/detail/' . $id);
                return 0;
                exit;
            }
        }
    }

    public function unmarkrecipe($id){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'danger');
            header('Location: ' . BASEURL . '/resep/detail/' . $id);
            return 0;
            exit;
        }else{
            if($this->model('resep_model')->unmark($_SESSION['idAkun'], $id) > 0){
                Flasher::setFlash('Resep batal ditandai', 'secondary');
                header('Location: ' . BASEURL . '/resep/detail/' . $id);
                exit;
            }else{
                Flasher::setFlash('ERROR', 'danger');
                header('Location: ' . BASEURL . '/resep/detail/' . $id);
                return 0;
                exit;
            }
        }
    }

    public function edit($id){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/akun/login');
            exit;
        }
        $data['value'] = $this->model('resep_model')->getResepbyID($id);
        if($data['value']['userID'] !== $_SESSION['idAkun']){
            Flasher::setFlash('Anda tidak dapat mengedit resep ini', 'warning');
            header('Location: ' . BASEURL . '/akun');
            exit;
        }

        $data['duration'] = $data['value']['duration'];
        preg_match('/(\d+)/', $data['duration'], $matches);
        $data['value']['durationNum'] = $matches[0] ?? '';
        $data['value']['durationState'] = preg_replace('/\d+/', '', $data['duration']);

        $data['ingredients'] = $data['value']['ingredients'];
        preg_match_all('/<li>(.*?)<\/li>/', $data['ingredients'], $matchess);
        $data['value']['ingredient'] = $matchess[1];
        
        $data['steps'] = $data['value']['steps'];
        preg_match_all('/<li>(.*?)<\/li>/', $data['steps'], $matchesss);
        $data['value']['step'] = $matchesss[1];

        if(isset($_SESSION['formtemp'])){
            $data['value'] = $_SESSION['formtemp'];
            $_SESSION['formtemp'] = '';
            unset($_SESSION['formtemp']);
        }

        $data['title'] = 'Edit Resep';
        $this->view('frame/header', $data);
        $this->view('resep/edit', $data);
        $this->view('frame/footer', $data);
    }

    public function update(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'danger');
            header('Location: ' . BASEURL . '/akun/login');
            exit;
        }else{
            $resep = $this->model('resep_model')->getResepbyID($_POST['recipeID']);
            if($resep['userID'] === $_SESSION['idAkun']){
                if($this->model('resep_model')->updateResep($_POST, $_FILES) > 0){
                    Flasher::setFlash('Resep anda berhasil diedit', 'success');
                    if(isset($_SESSION['formtemp'])){
                        $_SESSION['formtemp'] = '';
                        unset($_SESSION['formtemp']);
                    }
                    header('Location: ' . BASEURL . '/akun');
                    exit;
                }else{
                    $_SESSION['formtemp'] = $_POST;
                    header('Location: ' . BASEURL . '/resep/edit/' . $_POST['recipeID']);
                    exit;
                }
            }else{
                Flasher::setFlash('Anda tidak dapat mengedit resep ini', 'danger');
                header('Location: ' . BASEURL . '/akun');
                exit;
            }
        }
    }

    public function delete($id){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'danger');
            header('Location: ' . BASEURL . '/akun/login');
            exit;
        }else{
            $resep = $this->model('resep_model')->getResepbyID($id);
            if($resep['userID'] === $_SESSION['idAkun']){
                if($this->model('resep_model')->deleteResep($id) > 0){
                    Flasher::setFlash('Resep anda berhasil dihapus', 'dark');
                    header('Location: ' . BASEURL . '/akun');
                    exit;
                }
            }else{
                Flasher::setFlash('Anda tidak dapat menghapus resep ini', 'danger');
                header('Location: ' . BASEURL . '/akun');
                exit;
            }
        }
    }
}