<?php

class Login extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login page'
        ];

        $this->view('login/index', $data);
    }

    public function agent()
    {
        $loginService = new UserProfileService();
        $success = $loginService->authenticate($this->request->get('email'), $this->request->get('password'));
        if ($success){
            Helpers::redirect('Agents', 'index', [] );
        }

    }

    public function admin()
    {

    }

}
