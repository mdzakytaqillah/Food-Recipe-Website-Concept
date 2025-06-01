<?php

class resep_model {
    private $table = 'recipe';
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getResep(){
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getResepbyID($id){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE recipeID=:id');
        $this->db->bind('id', $id);
        return $this->db->resultSingle();
    }

    public function getResepOwning($id){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE userID=:id');
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    public function getTitle($id){
        $this->db->query('SELECT recipeTitle FROM ' . $this->table . ' WHERE recipeID=:id');
        $this->db->bind('id', $id);
        return $this->db->resultSingle();
    }

    public function ownerSearch($id){
        $this->db->query('SELECT * FROM users WHERE usersID =:id');
        $this->db->bind('id', $id);
        return $this->db->resultSingle();
    }

    public function searchResep($key){
        if($key['recipesearch'] !== ""){
            $searchtitle = $key['recipesearch'];
        }
        if(isset($key['equipexclude']) && $key['equipexclude'] !== ""){
            $equipban = $key['equipexclude'];
        }
        if(isset($key['ingredientexclude']) && $key['ingredientexclude'] !== ""){
            $ingredientban = $key['ingredientexclude'];
        }
        if(isset($searchtitle) && !isset($ingredientban) && !isset($equipban)){
            $query = "SELECT * FROM " . $this->table . " WHERE recipeTitle LIKE :title";
            $this->db->query($query);
            $this->db->bind('title', "%$searchtitle%");
            Flasher::setFlash('Pencarian resep ' . $searchtitle, 'success');
            return $this->db->resultSet();
            exit;
        }
        if(!isset($searchtitle) && isset($ingredientban) && !isset($equipban)){
            $query = "SELECT * FROM " . $this->table . " WHERE ingredients NOT LIKE :ingredient";
            $this->db->query($query);
            $this->db->bind('ingredient', "%$ingredientban%");
            Flasher::setFlash('Pencarian resep tanpa bahan ' . $ingredientban, 'success');
            return $this->db->resultSet();
            exit;
        }
        if(isset($searchtitle) && isset($ingredientban) && !isset($equipban)){
            $query = "SELECT * FROM " . $this->table . " WHERE recipeTitle LIKE :title and ingredients NOT LIKE :ingredient";
            $this->db->query($query);
            $this->db->bind('title', "%$searchtitle%");
            $this->db->bind('ingredient', "%$ingredientban%");
            Flasher::setFlash('Pencarian resep ' . $searchtitle . ' tanpa bahan ' . $ingredientban, 'success');
            return $this->db->resultSet();
            exit;
        }
        if(!isset($searchtitle) && !isset($ingredientban) && isset($equipban)){
            $query = "SELECT * FROM " . $this->table . " WHERE equipment NOT LIKE :equipment";
            $this->db->query($query);
            $this->db->bind('equipment', "%$equipban%");
            Flasher::setFlash('Pencarian resep tanpa alat ' . $equipban, 'success');
            return $this->db->resultSet();
            exit;
        }
        if(isset($searchtitle) && !isset($ingredientban) && isset($equipban)){
            $query = "SELECT * FROM " . $this->table . " WHERE recipeTitle LIKE :title and equipment NOT LIKE :equipment";
            $this->db->query($query);
            $this->db->bind('title', "%$searchtitle%");
            $this->db->bind('equipment', "%$equipban%");
            Flasher::setFlash('Pencarian resep ' . $searchtitle . ' tanpa alat ' . $equipban, 'success');
            return $this->db->resultSet();
            exit;
        }
        if(!isset($searchtitle) && isset($ingredientban) && isset($equipban)){
            $query = "SELECT * FROM " . $this->table . " WHERE ingredients NOT LIKE :ingredient and equipment NOT LIKE :equipment";
            $this->db->query($query);
            $this->db->bind('ingredient', "%$ingredientban%");
            $this->db->bind('equipment', "%$equipban%");
            Flasher::setFlash('Pencarian resep tanpa bahan ' . $ingredientban . ' dan tanpa alat ' . $equipban, 'success');
            return $this->db->resultSet();
            exit;
        }
        if(isset($searchtitle) && isset($ingredientban) && isset($equipban)){
            $query = "SELECT * FROM " . $this->table . " WHERE recipeTitle LIKE :title and ingredients NOT LIKE :ingredient and equipment NOT LIKE :equipment";
            $this->db->query($query);
            $this->db->bind('title', "%$searchtitle%");
            $this->db->bind('ingredient', "%$ingredientban%");
            $this->db->bind('equipment', "%$equipban%");
            Flasher::setFlash('Pencarian resep ' . $searchtitle . ' tanpa bahan ' . $ingredientban . ' dan tanpa alat ' . $equipban, 'success');
            return $this->db->resultSet();
            exit;
        }
        if(!isset($searchtitle) && !isset($ingredientban) && !isset($equipban)){
            $this->db->query('SELECT * FROM ' . $this->table);
            return $this->db->resultSet();
            exit;
        }
    }

    public function newResep($data, $gambar){
        $namefile = $gambar['imgfood']['name'];
        $sizefile = $gambar['imgfood']['size'];
        $error = $gambar['imgfood']['error'];
        $tmpfile = $gambar['imgfood']['tmp_name'];

        if($error === 4){
            Flasher::setFlash('Gambar tidak ditemukan', 'warning');
            return 0;
            exit;
        }

        $typeallowed = ['jpg', 'jpeg', 'png'];
        $extfile = explode('.', $namefile);
        $extfile = strtolower(end($extfile));
        if(!in_array($extfile, $typeallowed)){
            Flasher::setFlash('File ' . $extfile . ' tidak diizinkan', 'danger');
            return 0;
            exit;
        }

        $sizelimit = 4194304;
        if($sizefile > $sizelimit){
            Flasher::setFlash('Ukuran Gambar Terlalu Besar', 'warning');
            return 0;
            exit;
        }

        $imgname = uniqid();
        $imgname .= '.';
        $imgname .= $extfile;
        move_uploaded_file($tmpfile, '../public/img/resepthumb/' . $imgname);
        
        $query = "INSERT INTO " . $this->table . " VALUES ('', :user, :judul, :img, :durasi, CURRENT_DATE(), :preview, :detail, :alat, :bahan, :langkah)";
        $this->db->query($query);
        $this->db->bind('user', $_SESSION['idAkun']);
        $this->db->bind('judul', $data['title']);
        $this->db->bind('img', $imgname);
        $this->db->bind('durasi', $data['duration'] . ' ' . $data['durationState']);
        $this->db->bind('preview', $data['descPreview']);
        $this->db->bind('detail', $data['descDetail']);
        $this->db->bind('alat', $data['alat']);
        $bahan = '';
        for ($x = 0; $x < count($data['JumlahBahan']); $x++){
            $bahan .= '<li>' . $data['JumlahBahan'][$x] . ' ' . $data['JumlahState'][$x] . ' ' . $data['namabahan'][$x] . '</li>';
        }
        $this->db->bind('bahan', $bahan);
        $langkah = '';
        for ($y = 0; $y < count($data['langkahmasak']); $y++){
            $langkah .= '<li>' . $data['langkahmasak'][$y] . '</li>';
        }
        $this->db->bind('langkah', $langkah);

        $this->db->execute();

        return 1;
        // return $this->db->rowCount();
    }

    public function updateResep($data, $gambar){
        $error = $gambar['imgfood']['error'];
        
        if($error !== 4){
            $namefile = $gambar['imgfood']['name'];
            $sizefile = $gambar['imgfood']['size'];
            $tmpfile = $gambar['imgfood']['tmp_name'];
            $typeallowed = ['jpg', 'jpeg', 'png'];
            $extfile = explode('.', $namefile);
            $extfile = strtolower(end($extfile));
            if(!in_array($extfile, $typeallowed)){
                Flasher::setFlash('File ' . $extfile . ' tidak diizinkan', 'danger');
                return 0;
                exit;
            }

            $sizelimit = 4194304;
            if($sizefile > $sizelimit){
                Flasher::setFlash('Ukuran Gambar Terlalu Besar', 'warning');
                return 0;
                exit;
            }

            $imgname = uniqid();
            $imgname .= '.';
            $imgname .= $extfile;
            move_uploaded_file($tmpfile, '../public/img/resepthumb/' . $imgname);
            $query = "UPDATE " . $this->table . " SET recipeTitle=:judul, imgthumbnail=:img, duration=:durasi, descPreview=:preview, descDetail=:detail, equipment=:alat, ingredients=:bahan, steps=:langkah WHERE recipeID=:id";
            $this->db->query($query);
            $this->db->bind('img', $imgname);
        }else{
            $query = "UPDATE " . $this->table . " SET recipeTitle=:judul, duration=:durasi, descPreview=:preview, descDetail=:detail, equipment=:alat, ingredients=:bahan, steps=:langkah WHERE recipeID=:id";
            $this->db->query($query);
        }
        $this->db->bind('judul', $data['recipeTitle']);
        $this->db->bind('durasi', $data['durationNum'] . ' ' . $data['durationState']);
        $this->db->bind('preview', $data['descPreview']);
        $this->db->bind('detail', $data['descDetail']);
        $this->db->bind('alat', $data['equipment']);
        
        $bahan = '';
        for ($x = 0; $x < count($data['ingredient']); $x++){
            $bahan .= '<li>' . $data['ingredient'][$x] . '</li>';
        }
        $this->db->bind('bahan', $bahan);
        $langkah = '';
        for ($y = 0; $y < count($data['step']); $y++){
            $langkah .= '<li>' . $data['step'][$y] . '</li>';
        }
        $this->db->bind('langkah', $langkah);

        $this->db->bind('id', $data['recipeID']);
        $this->db->execute();

        return 1;
    }

    public function likecounter($id){
        $this->db->query('SELECT COUNT(*) AS count FROM likerecipe WHERE recipeID=:recipe');
        $this->db->bind('recipe', $id);
        return $this->db->resultSingle();
    }

    public function islike($uid, $rid){
        $this->db->query('SELECT COUNT(*) AS count FROM likerecipe WHERE userID=:user AND recipeID=:recipe');
        if(isset($_SESSION['login']) && isset($_SESSION['idAkun'])){
            $this->db->bind('user', $uid);
        }else{
            return 0;
            exit;
        }
        $this->db->bind('recipe', $rid);
        return $this->db->resultSingle();
    }
    

    public function like($uid, $rid){
        $this->db->query('INSERT INTO likerecipe VALUES (:user, :recipe)');
        if(isset($_SESSION['login']) && isset($_SESSION['idAkun'])){
            $this->db->bind('user', $uid);
        }else{
            Flasher::setFlash('Anda harus login terlebih dahulu', 'danger');
            return 0;
            exit;
        }
        $this->db->bind('recipe', $rid);
        $this->db->execute();
        return 1;
    }

    public function unlike($uid, $rid){
        $this->db->query('DELETE FROM likerecipe WHERE userID=:user AND recipeID=:recipe');
        if(isset($_SESSION['login']) && isset($_SESSION['idAkun'])){
            $this->db->bind('user', $uid);
        }else{
            Flasher::setFlash('Anda harus login terlebih dahulu', 'danger');
            return 0;
            exit;
        }
        $this->db->bind('recipe', $rid);
        $this->db->execute();
        return 1;
    }

    public function userLike($id){
        if(!isset($_SESSION['login'])){
            return 0;
            exit;
        }
        $this->db->query('SELECT * FROM recipe JOIN likerecipe ON recipe.recipeID = likerecipe.recipeID WHERE likerecipe.userID=:id');
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    public function userMark($id){
        if(!isset($_SESSION['login'])){
            return 0;
            exit;
        }
        $this->db->query('SELECT * FROM recipe JOIN mark ON recipe.recipeID = mark.recipeID WHERE mark.userID=:id');
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    public function mostFav($limit){
        $this->db->query('SELECT r.*, COALESCE(COUNT(l.userID), 0) AS grateful FROM recipe r LEFT JOIN likerecipe l ON r.recipeID = l.recipeID GROUP BY r.recipeID ORDER BY grateful DESC LIMIT :quantity');
        $this->db->bind('quantity', $limit);
        return $this->db->resultSet();
    }

    public function ismark($uid, $rid){
        $this->db->query('SELECT COUNT(*) AS count FROM mark WHERE userID=:user AND recipeID=:recipe');
        if(isset($_SESSION['login']) && isset($_SESSION['idAkun'])){
            $this->db->bind('user', $uid);
        }else{
            return 0;
            exit;
        }
        $this->db->bind('recipe', $rid);
        return $this->db->resultSingle();
    }

    public function mark($uid, $rid){
        $this->db->query('INSERT INTO mark VALUES (:user, :recipe)');
        if(isset($_SESSION['login']) && isset($_SESSION['idAkun'])){
            $this->db->bind('user', $uid);
        }else{
            Flasher::setFlash('Anda harus login terlebih dahulu', 'danger');
            return 0;
            exit;
        }
        $this->db->bind('recipe', $rid);
        $this->db->execute();
        return 1;
    }

    public function unmark($uid, $rid){
        $this->db->query('DELETE FROM mark WHERE userID=:user AND recipeID=:recipe');
        if(isset($_SESSION['login']) && isset($_SESSION['idAkun'])){
            $this->db->bind('user', $uid);
        }else{
            Flasher::setFlash('Anda harus login terlebih dahulu', 'danger');
            return 0;
            exit;
        }
        $this->db->bind('recipe', $rid);
        $this->db->execute();
        return 1;
    }

    public function deleteResep($id){
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE recipeID=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return 1;
    }
}