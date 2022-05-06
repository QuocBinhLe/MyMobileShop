<?php
// Include thư viện database và format
include_once('../../lib/database.php');
include_once('../../helper/format.php');

class PageClass {
    private $db;
    private $fm;
    private $content_intro_tbl = DB_CONTENT_INTRO;
    private $member_tbl = DB_MEMBER_TABLE;
    private $social_tbl = DB_SOCIAL_TABLE;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();   
    }

    public function getContentInro() {
        $query = "SELECT * FROM $this->content_intro_tbl";
        $result = $this->db->select($query);
        if ($result) {
            $response = $result->fetch_assoc();
            return $response;
        } else {
            return false;
        }
    }

    public function getAllMember() {
        $query = "SELECT* FROM $this->member_tbl";
        $result = $this->db->select($query);
        if ($result) {
            $response = $result->fetch_assoc();
            return $response;
        } else {
            return false;
        }
    }

    public function getSocialNetwork() {
        $query = "SELECT * FROM $this->social_tbl";
        $result = $this->db->select($query);
        if ($result) {
            $response = $result->fetch_assoc();
            return $response;
        } else {
            return false;
        }
    }

    public function updateContentIntro($slogan, $content_1, $content_2) {
        $slogan = $this->fm->filter($slogan);
        $content_1 = $this->fm->filter($content_1);
        $content_2 = $this->fm->filter($content_2);

        if (empty($slogan) or empty($content_1) or empty($content_2)) {
            $response['status'] = 0;
            $response['message'] = 'Vui lòng điền đầy đủ các trường content';
        } else {
            $query = "UPDATE $this->content_intro_tbl SET slogan='$slogan', content_1='$content_1', content_2='$content_2'";
            $result = $this->db->update($query);
            if ($result) {
                $response['status'] = 1;
                $response['message'] = 'Cập nhập thành công';
            } else {
                $response['status'] = 0;
                $response['message'] = 'Cập nhập thất bại';
            }
        }
        return $response;
    }

    public function updateMember($member1, $member2) {
        $member1 = $this->fm->filter($member1);
        $member2 = $this->fm->filter($member2);
        $query = "UPDATE $this->member_tbl SET member_1='$member1', member_2='$member2'";
        $result = $this->db->update($query);
        if ($result) {
            $response['status'] = 1;
            $response['message'] = 'Cập nhập thành viên thành công';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Cập nhập thành viên thất bại';
        }
         return $response;
    }

    public function updateSocialNetwork($hotline, $email, $facebook, $instagram, $youtube, $twitter) {
        $query = "UPDATE $this->social_tbl SET hotline='$hotline', email='$email', facebook='$facebook', instagram='$instagram', youtube='$youtube', twitter='$twitter'";
        $result = $this->db->update($query);
        if ($result) {
            $response['status'] = 1;
            $response['message'] = 'Cập nhập thành công';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Cập nhập thất bại';
        }
        return $response;
    }
}
?>