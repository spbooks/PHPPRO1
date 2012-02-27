<?php
class My_Controller_Foo extends My_Controller_Base
{
  private $fooModel;
  private $view;

  public function setFooModel(My_Model_Foo $fooModel)
  {
    $this->fooModel = $fooModel;
  }

  public function getFooModel()
  {
    if (empty($this->fooModel)) {
      $this->fooModel = new My_Model_Foo();
    }
    return $this->fooModel;
  }

  public function setView(My_View $view)
  {
    $this->view = $view;
  }

  public function getView()
  {
    if (empty($this->view)) {
      $this->view = new My_View();
    }
    return $this->view;
  }

  public function actionGet(array $params)
  {
    $fooModel = $this->getFooModel();
    $fooId = $params['fooId'];
    $fooData = $fooModel->get($fooId);
    $view = $this->getView();
    $view->assign($fooData);
    return $view->render('path/to/template');
  }
}
?>