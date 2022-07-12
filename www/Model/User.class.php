<?php

namespace App\Model;

use App\Core\Sql;   

class User extends Sql
{
    protected $id = null;
    protected $firstname = null;
    protected $lastname = null;
    protected $email;
    protected $password;
    protected $active = 0;
    protected $activation_code = null;
    protected $role = 0;
    protected $token = null;
    protected $activated_at = null;
    protected $reset_link_token = null;
    protected $activation_expiry = null;

    public function __construct()
    {

        parent::__construct();
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return null|string
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(?string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return null|string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param null|string
     */
    public function setLastname(?string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @param string $password
     * @return bool
     */
    public function decryptPassword(string $password): bool
    {
        return password_verify($password, $this->getPassword());
    }

    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * @param int $active
     */
    public function setActive(int $active = 0): void
    {
        $this->active = $active;
    }

    /**
     * Get the value of activationCode
     */
    public function getActivationCode()
    {
        return $this->activation_code;
    }

    /**
     * Set the value of activationCode
     *
     * @return  void
     */
    public function setActivationCode(): void
    {
        $this->activation_code = substr(bin2hex(random_bytes(128)), 0, 255);
    }

     /**
     * Get the value of activatedAt
     */ 
    public function getActivatedAt()
    {
        return $this->activated_at;
    }

    /**
     * Set the value of activatedAt
     *
     * @return  self
     */ 
    public function setActivatedAt($activatedAt): void
    {
        $this->activated_at = $activatedAt;
    }

    /**
     * Get the value of role
     * @return  bool
     */
    public function getRole(): bool
    {
        return $this->role;
    }

    /**
     * Get the value of reset_link_token
     */ 
    public function getResetLinkToken()
    {
        return $this->reset_link_token;
    }

    /**
     * Set the value of reset_link_token
     *
     * @return  self
     */ 
    public function setResetLinkToken($email, $token)
    {
        $reset_link_token = $email.$token;
        $this->reset_link_token = $reset_link_token;

        return $this;
    }

    /**
     * Get the value of activation_expiry
     */ 
    public function getActivationExpiry()
    {
        return $this->activation_expiry;
    }

    /**
     * Set the value of activation_expiry
     *
     * @return  self
     */ 
    public function setActivationExpiry($activation_expiry)
    {
        $this->activation_expiry = $activation_expiry;

        return $this;
    }

    /**
     * Set the value of role
     *
     * @return  int
     */
    public function setRole(int $role = 0): void
    {
        $this->role = $role;
    }

    /**
     * @return null|string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * length : 255
     */
    public function generateToken(): void
    {
        $this->token = substr(bin2hex(random_bytes(128)), 0, 255);
    }



    public function getRegisterForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "submit" => "S'inscrire"
            ],
            'inputs' => [
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email ...",
                    "required" => true,
                    "class" => "inputForm",
                    "id" => "emailForm",
                    "error" => "Email incorrect",
                    "unicity" => "true",
                    "errorUnicity" => "Email déjà en bdd",
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe ...",
                    "required" => true,
                    "class" => "inputForm",
                    "id" => "pwdForm",
                    "error" => "Votre mot de passe doit faire au min 8 caractères avec majuscule, minuscules et des chiffres",
                ],
                "passwordConfirm" => [
                    "type" => "password",
                    "placeholder" => "Confirmation ...",
                    "required" => true,
                    "class" => "inputForm",
                    "id" => "pwdConfirmForm",
                    "confirm" => "password",
                    "error" => "Votre mot de passe de confirmation ne correspond pas",
                ],
                "firstname" => [
                    "type" => "text",
                    "placeholder" => "Votre prénom ...",
                    "class" => "inputForm",
                    "id" => "firstnameForm",
                    "min" => 2,
                    "max" => 50,
                    "error" => "Prénom incorrect"
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Votre nom ...",
                    "class" => "inputForm",
                    "id" => "lastnameForm",
                    "min" => 2,
                    "max" => 100,
                    "error" => "Nom incorrect"
                ],
            ]
        ];
    }

    public function getLoginForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "submit" => "Se connecter"
            ],
            'inputs' => [
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email ...",
                    "required" => true,
                    "class" => "inputForm",
                    "id" => "emailForm",
                    "error" => "Email incorrect"
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe ...",
                    "required" => true,
                    "class" => "inputForm",
                    "id" => "pwdForm"
                ]
            ]
        ];
    }
}