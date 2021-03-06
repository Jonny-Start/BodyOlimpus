<?php
class BodyOlimpusLogin
{
    public static function getLoging($email, $pass)
    {
        require(__DIR__ . './db/DB.php');
        $sql = DB::DBconnect()->prepare("SELECT id_user, email, passwd FROM bo_user where email = :email");
        $sql->bindParam(':email', $email);
        $sql->execute();
        $dataUser = $sql->fetch(PDO::FETCH_ASSOC);
        return $dataUser;
    }

    public static function setUser($first_name, $last_name, $email, $pass, $createAccount_date)
    {
        require(__DIR__ . './db/DB.php');

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $pass = $_POST['passwd'];
        $createAccount_date = date("Y-m-d");

        $sql = DB::DBconnect()->prepare("INSERT INTO bo_user (first_name, last_name, email, passwd, createAccount_date) VALUES (:first_name, :last_name, :email, :passwd, :createAccount_date)");
        $sql->bindParam(':first_name', $first_name);
        $sql->bindParam(':last_name', $last_name);
        $sql->bindParam(':email', $email);
        $passwd = password_hash($pass, PASSWORD_BCRYPT);
        $sql->bindParam(':passwd', $passwd);
        $sql->bindParam(':createAccount_date', $createAccount_date);
        if ($sql->execute()) {
            $message = "Usuario Creado";
        } else {
            $message = "Error para crearlo";
        }
        return $message;
    }

    public static function estaConected()
    {
        $result = DB::DBconnect();
        return $result;
    }
}
