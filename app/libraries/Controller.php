<?php
//Load the model and the view
use Spatie\DataTransferObject\DataTransferObject;
use Symfony\Component\HttpFoundation\Request;

class Controller
{
    public Request $request;
    public PageId $pageId;
    public DataTransferObject $dto;

    public function __construct()
    {
        $this->request = getRequest();
    }

    public function model($model)
    {
        //Require model file
        require_once '../app/models/' . $model . '.php';
        //Instantiate model
        return new $model();
    }

    //Load the view (checks for the file)
    public function view(string $view, PageDTO $dto): void
    {
        setGlobalPageDTO($dto);
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die("View does not exists.");
        }
    }
}
