<?php


namespace Controller;

use Model\Person;
use Model\Territory;

class SignUpController extends \Controller
{
    public function indexAction()
    {
        $person = [
            'name' => '',
            'email' => '',
            'region' => '',
            'city' => '',
            'area' => '',
        ];

        $this->view->data['person'] = $person;
        $this->view->data['regions'] = (new Territory())->getRegions();

        $this->view->assets['css'][] = '/assets/css/signUp/index.css';
        $this->view->assets['js'][] = '/assets/js/signUp/index.js';

        $this->view->render('signUp/index');
    }

    public function saveAction()
    {
        $model = new Person();

        if (!$errors = $model->validate($_POST)) {
            $model->add($_POST);

            $json['success'] = 'Person has been registered!';
        } else {
            $json['errors'] = $errors;
        }

        echo json_encode($json);
    }

    public function getAreasByCityIdAction()
    {
        $model = new Territory();
        $this->view->data['areas'] = $model->getAreasByCityId($_GET['city_id']);
        $this->view->render('signUp/areas_list', true);
    }

    public function getCitiesByRegionIdAction()
    {
        $model = new Territory();
        $this->view->data['cities'] = $model->getCitiesByRegionId($_GET['region_id']);
        $this->view->render('signUp/cities_list', true);
    }
}