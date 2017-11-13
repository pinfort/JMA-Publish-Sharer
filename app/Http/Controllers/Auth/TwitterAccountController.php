<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;

class TwitterAccountController extends SocialAccountController
{
    protected $provider = 'twitter';
    private $register = true;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function getProvider() {
        return $this->provider;
    }

    /**
     * Redirect the user to the Twitter authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider() {
        if (Auth::check() && $this->register) {
            return redirect('/home');
        }
        return \Socialite::driver($this->getProvider())->redirect();
    }

    /**
     * Link Twitter account for User account.
     *
     * @return \Illuminate\Http\Response
     */
    public function linkToUser() {
        if (Auth::guest()) {
            return redirect('/login');
        }
        $this->register = false;
        return $this->redirectToProvider();
    }
}