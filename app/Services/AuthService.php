<?php
/**
 * The authentication service file.
 *
 * @category  Service
 * @package   Authentication
 * @author    Huy Nguyen <huy.nv@altplus.com.vn>
 * @license   APV https://altplus.com.vn/
 * @link      https://altplus.com.vn/
 */
namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * This class for implement logic with authentication of user.
 *
 * @category  Service
 * @package   Authentication
 * @author    Huy Nguyen <huy.nv@altplus.com.vn>
 * @license   APV https://altplus.com.vn/
 * @link      https://altplus.com.vn/
 */
class AuthService
{
    /**
     * Create a user.
     *
     * @param string $email     Email.
     * @param string $password  Password.
     * @param string $lastname  Lastname.
     * @param string $firstname Firstname.
     * @return User User created.
     */
    public function createUser($email, $password, $lastname, $firstname)
    {
        return User::create([
            'lastname' => $lastname,
            'firstname' => $firstname,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
    }

    /**
     * Get a user with email and password.
     *
     * @param String $email     Email.
     * @param string $password  Password.
     * @return Array Response array of get user.
     */
    public function getUser($email, $password)
    {
        $success = false;
        $message = '';
        $user = User::where('email', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                $success = true;
            } else {
                $message = "Hmm, that's not the right password. Please try again.";
            }
        } else {
            $message = "Hmm, we don't recognize that email. Please try again.";
        }

        return compact('success', 'user', 'message');
    }
}
