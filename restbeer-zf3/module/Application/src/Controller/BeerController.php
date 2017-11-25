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

    public function createAction()
    {
        $form = new \Application\Form\Beer;
        $form->setAttribute('action', '/beer/create');
        $request = $this->getRequest();
        /* se a requisição é post os dados foram enviados via formulário*/
        if ($request->isPost()) {
            $beer = new \Application\Model\Beer;
            /* configura a validação do formulário com os filtros e validators da entidade*/
            $form->setInputFilter($beer->getInputFilter());
            /* preenche o formulário com os dados que o usuário digitou na tela*/
            $form->setData($request->getPost());
            /* faz a validação do formulário*/
            if ($form->isValid()) {
                /* pega os dados validados e filtrados */
                $data = $form->getData();
                unset($data['send']);
                /* salva a cerveja*/
                $this->tableGateway->insert($data);
                $this->flashMessenger()->addMessage("Cerveja incluída");
                /* redireciona para a página inicial que mostra todas as cervejas*/
                return $this->redirect()->toUrl('/beer');
            }
        }
        $view = new ViewModel(['form' => $form]);
        $view->setTemplate('application/beer/save.phtml');

        return $view;
    }

}