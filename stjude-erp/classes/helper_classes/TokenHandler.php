<?php
class TokenHandler
{

    protected static $REMEMBER_EXPIRY_TIME = "10 minutes";
    const REMEMBER_EXPIRY_TIME_IN_SECONDS = 600;
    protected static $FORGOT_PWD_EXPIRY_TIME = "15 minutes";
    const FORGOT_PWD_EXPIRY_TIME_IN_SECONDS = 900;        

    protected $table = "tokens";
    
    protected $database;
    protected $hash;

    /**
     * TokenHandler constructor.
     * @param $di
     */
    public function __construct(DependencyInjector $di)
    {
        $this->database = $di->get('database');
        $this->hash = $di->get('hash');
    }

    public function build()
    {
        $CREATE_QUERY = "CREATE TABLE IF NOT EXISTS {$this->table} (id INT PRIMARY KEY AUTO_INCREMENT, user_id INT, token VARCHAR(255) UNIQUE, expires_at DATETIME NOT NULL, is_remember TINYINT DEFAULT 0)";
        $this->database->query($CREATE_QUERY);
    }

    public static function getCurrentTimeInMilliSec()
    {
        return round(microtime(true) * 1000);
    }
    public function createForgetPasswordToken(int $user_id)
    {
        return $this->createToken($user_id, 0);
    }
    public function createRememberMeToken(int $user_id)
    {
        return $this->createToken($user_id, 1);
    }
    public function isValid(string $token, int $isRemember)
    {
        $query = "SELECT * FROM {$this->table} WHERE token = '{$token}' AND expires_at >= NOW() AND is_remember = {$isRemember}";
        return !empty($this->database->raw($query));
    
    }
    public function getUserFromValidToken($token)
    {
        $token = $this->database->table($this->table)->where('token', '=', $token)->first();
        return $this->database->table('users')->where('id', '=', $token->user_id)->first();
    }
    public function getValidExistingToken(int $user_id, int $isRemember)
    {
        $query = "SELECT * FROM {$this->table} WHERE user_id = {$user_id} AND expires_at >= NOW() AND is_remember = {$isRemember}"; 
        $retVal = $this->database->raw($query);
        return $retVal[0]->token ?? null;
    }
    public function deleteToken(string $token)
    {
        $sql = "DELETE FROM {$this->table} WHERE token = '{$token}'";
        return $this->database->query($sql);
    }
    private function createToken(int $user_id, int $isRemember)
    {
        $validToken = $this->getValidExistingToken($user_id, $isRemember);
        if($validToken)
        {
            return $validToken;
        }
        $currentTime = date("Y-m-d H:i:s");
        $timeToBeAdded = $isRemember ? TokenHandler::$REMEMBER_EXPIRY_TIME : TokenHandler::$FORGOT_PWD_EXPIRY_TIME;

        $data = [
            'user_id'=>$user_id,
            'token'=>$this->hash->generateRandomToken($user_id),
            'is_remember'=>$isRemember,
            'expires_at'=>date('Y-m-d H:i:s', strtotime($currentTime . "+" . $timeToBeAdded))
        ];

        return $this->database->table($this->table)->insert($data) ? $data['token'] : null;
    }
}

