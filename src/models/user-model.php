<?php
namespace FKK\models;

class User extends \FKK\models\ModelValidationBase {

// Init variables
    private $userId;
    private $userName;
    private $firstName;
    private $surName;
    private $password;
    private $signature;
    private $passwordHashed = false;
    private static $constraints = [
        'userId' => ['minValue' => 0, 'allowNull' => true],
        'username' => ['maxLength' => 30],
        'firstname' => ['maxLength' => 50, 'minLength' => 0],
        'surname' => ['maxLength' => 50, 'minLength' => 0],
        'password' => ['maxLength' => 30],
    ];

// Constructor
    public function __construct(
        $userId = null,
        $username,
        $firstname = "",
        $surname = "",
        $password = "",
        $doHashPassword = true,
        $doCheckPassword = true
    ) {
        $this->SetUserId($userId);
        $this->SetUserName($username);
        $this->SetFirstName($firstname);
        $this->SetSurName($surname);
        $this->SetPassword($password, $doHashPassword, $doCheckPassword);
    }

// Getters and Setters
    # UserId
    public function SetUserId($value) {
        if($this->IsValidInt("userId", $value, self::$constraints["userId"]))
        {
            // Set user id
            $this->userId = (int) $value;
        }
    }
    public function GetUserId() {
        return $this->userId;
    }
    # Username
    public function SetUserName($value) {
        // Check if username is valid
        if($this->IsValidString("username", $value, self::$constraints["username"])) {
            // Set username
            $this->userName = trim($value);
        }
    }
    public function GetUserName() {
        return $this->userName;
    }
    # FirstName
    public function SetFirstName($value) {
        // Check if value is valid
        if($this->IsValidString("firstname", $value, self::$constraints["firstname"])) {
            // Set value
            $this->firstName = trim($value);
        }
    }
    public function GetFirstName() {
        return $this->firstName;
    }
    # SurName
    public function SetSurName($value) {
        // Check if value is valid
        if($this->IsValidString("surname", $value, self::$constraints["surname"])) {
            // Set value
            $this->surName = trim($value);
        }
    }
    public function GetSurName() {
        return $this->surName;
    }
    # Password
    public function SetPassword($value, $doHashPassword = true, $doCheckPassword = true) {
        // Check if password is valid
        if(!$doCheckPassword || $this->IsValidString("password", $value, self::$constraints["password"])) {
            // Set password
            if($doHashPassword) {
                $this->password = password_hash(trim($value), PASSWORD_DEFAULT);
                $this->passwordHashed = true;
            } else {
                $this->password = trim($value);
            }
        }
    }
    public function GetPassword() {
        return $this->password;
    }
   
// Public Methods
    public function IsPasswordHashed() {
        return $this->passwordHashed;
    }
    public function HashPassword() {
        // Assert that password is not hashed already
        assert(!$this->IsPasswordHashed());
        // Hash password through set method
        $this->SetPassword($this->password);
    }
} 