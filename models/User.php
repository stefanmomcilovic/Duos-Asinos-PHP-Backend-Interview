<?php
    // Modal class and functions that will help for inserting the user into database and validate the user //
    class User extends DB{
        public function register_new_user($register_email, $register_name, $register_password){
            $insert = DB::preparedQuery("INSERT INTO users (email, name, password) VALUES (:email, :name, :password)", [':email' => $register_email, ':name' => $register_name, ':password' => password_hash($register_password, PASSWORD_BCRYPT)]);
            return $insert;
        }

        public function check_if_email_exists($register_email){
            $select = DB::preparedQueryFetch("SELECT * FROM users WHERE email = :email", [':email' => $register_email]);
            if($select['rowCount'] > 0){
                return true;
            }
            return false;
        }

        public function login_user($login_email, $login_password){
            $user = DB::preparedQueryFetch("SELECT * FROM users WHERE email = :email", [':email' => $login_email]);
            if($user['rowCount'] > 0){
                $user = $user['fetch'];
                if(password_verify($login_password, $user['password'])){
                    return $user;
                }else{
                    return false;
                }
            }
            return false;
        }
    }