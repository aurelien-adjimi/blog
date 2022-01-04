<?php

class Connexion
{
    private $_email;
    private $_mdp;
    private $_Malert;
    private $_Talert;


    function __construct(string $email, string $mdp)
    {
        $this->_email = $email;
        $this->_mdp = $mdp;
    }


    private function verif_exist_util()
    {
        $req = "SELECT email FROM utilisateurs WHERE email='$this->_email'";
        $var = $GLOBALS['PDO'] -> query($req);
        $liste_util = $var -> fetchAll(PDO::FETCH_ASSOC);
        if (isset($liste_util[0]['email']) && $liste_util[0]['email'] != "") {
            $verifexist = TRUE;
            return $verifexist;
        } else {
            $verifexist = FALSE;
            return $verifexist;
        }
    }

    private function verif_mdp()
    {
        $req = "SELECT email, password FROM utilisateurs WHERE email='$this->_email'";
        $var = $GLOBALS['PDO'] -> query($req);
        $list_util_mdp = $var -> fetchAll(PDO::FETCH_ASSOC);
        if (password_verify($this -> _mdp, $list_util_mdp[0]['password'])) {
            $verif = TRUE;
            return $verif;
        } else {
            $verif = FALSE;
            return $verif;
        }
    }


    public function alerts()
    {
        if ($this -> _Talert == 1) {
            echo "<div class='succes'>" . $this -> _Malert . "</div>";
        } else {
            echo "<div class='error'>" . $this -> _Malert . "</div>";
        }
    }

    public function connexion()
    {
        if ($this -> _email != "") {
            if ($this -> verif_exist_util()) {
                if ($this -> verif_mdp()) {
                    $this -> _Malert = 'Connexion réussie';
                    $this -> _Talert = 1;

                    $req = "SELECT * FROM utilisateurs WHERE email='$this->_email'";
                    $res = $GLOBALS['PDO'] -> query($req);
                    $info_user = $res->fetchAll(PDO::FETCH_ASSOC);

                    $_SESSION['email'] = $info_user[0]['email'];
                    $_SESSION['id'] = $info_user[0]['id'];
                    $_SESSION['login'] = $info_user[0]['login'];
                    $_SESSION['perm'] = $info_user[0]['id_droits'];

                    header('refresh:1;url=/blog/index.php');
                } else {
                    $this -> _Malert = 'Mauvais mot de passe';
                    $this -> _Talert = 0;
                }
            } else {
                $this -> _Malert = "L'utilisateur " . $this->_email . " n'existe pas";
                $this -> _Talert = 0;
            }
        } else {
            $this -> _Malert = 'Veuillez remplir les champs';
            $this -> _Talert = 0;
        }
    }
}
class Inscription
{

    private $_login;
    private $_password;
    private $_password_verif;
    private $_email;
    private $_Malert;
    private $_Talert;


    function __construct(string $login, string $password, string $password_verif, string $email, int $droit = 1)
    {

        $this -> _login = $login;
        $this -> _password = $password;
        $this -> _password_verif = $password_verif;
        $this -> _email = $email;
        $this -> _droit = $droit;
    }

    private function verif_mdp_verif()
    {
        if ($this -> _password === $this -> _password_verif && $this -> _password != "") {
            return TRUE;
        }
    }

    private function verif_util()
    {

        $req = "SELECT login FROM utilisateurs WHERE login='$this->_login'";
        $var = $GLOBALS['PDO']->query($req);
        $list_util = $var -> fetchAll(PDO::FETCH_ASSOC);
        if (isset($list_util[0]['login'])) {
            $verifexist = TRUE;
            return $verifexist;
        } else {
            $verifexist = FALSE;
            return $verifexist;
        }
    }

    private function verif_mail()
    {

        $req = "SELECT email FROM utilisateurs WHERE email='$this -> _email'";
        $var = $GLOBALS['PDO'] -> query($req);
        $list_mail = $var->fetchAll(PDO::FETCH_ASSOC);
        if (isset($list_mail[0]['email'])) {
            $verifexist = TRUE;
            return $verifexist;
        } else {
            $verifexist = FALSE;
            return $verifexist;
        }
    }
    public function alerts()
    {
        if ($this -> _Talert == 1) {
            echo "<div class='succes'>" . $this -> _Malert . "</div>";
        } else {
            echo "<div class='error'>" . $this -> _Malert . "</div>";
        }
    }

    public function ins_util()
    {
        if ($this -> _email == "") {
            $this -> _Malert = 'Veuillez entrer votre email';
        } else {
            if ($this -> _password == "" && $this -> _password_verif == "") {
                $this -> _Malert = 'Veuillez entrer le mot de passe';
            } else {
                if ($this -> verif_mdp_verif()) {
                    if ($this -> verif_util() == FALSE) {
                        if (filter_var($this -> _email, FILTER_VALIDATE_EMAIL)) {
                            if ($this -> verif_mail() == FALSE) {

                                $req = 'INSERT INTO utilisateurs (login, password, email, id_droits) VALUES (:login, :password, :email, :id)';
                                $var = $GLOBALS['PDO']->prepare($req);
                                $var -> execute([
                                    ':login' => $this -> _login,
                                    ':password' => password_hash($this -> _password, PASSWORD_DEFAULT),
                                    ':email' => $this -> _email,
                                    ':id' => $this -> _id = 1,
                                ]);
                                $this -> _Malert = 'Utilisateur crée';
                                $this -> _Talert = 1;
                                header('Refresh:1 ; URL=/blog/index.php');
                            } else {
                                $this -> _Malert = $this -> _email . " Déjà utilisé";
                            }
                        } else {
                            $this -> _Malert = $this -> _email . " n'est pas valide";
                        }
                    } else {
                        $this -> _Malert = "L'utilisateur " . $this -> _login . "existe déjà";
                    }
                } else {
                    $this -> _Malert = 'Les mots de passes sont différents';
                }
            }
        }
    }
}