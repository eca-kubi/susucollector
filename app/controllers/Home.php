<?php

class Home extends Controller
{
    public function index()
    {
        $dto = new HomeDTO();
        $dto->pageId = PageId::HOME;
        $dto->title = 'Home';
        $this->view('home/index', $dto);
    }
}
