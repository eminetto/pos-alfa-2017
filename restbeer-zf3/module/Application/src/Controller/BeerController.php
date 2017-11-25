<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BeerController extends AbstractActionController
{
    public $tableGateway;

    public function __construct($tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function indexAction()
    {
        $beers = $this->tableGateway->select()->toArray();

        return new ViewModel(['beers' => $beers]);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id');
        $beer = $this->tableGateway->select(['id' => $id]);
        if (count($beer) == 0) {
            throw new \Exception("Beer not found", 404);

        }
        $this->tableGateway->delete(['id' => $id]);
        $this->flashMessenger()->addMessage("Cerveja excluida");
        return $this->redirect()->toRoute('beer');
    }
}