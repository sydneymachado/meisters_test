<?php
namespace TodosApp\Controller;
use Laminas\View\Model\ViewModel;
use TodosApp\Model\TaskTable;
use TodosApp\Form\TaskForm;
use TodosApp\Model\Task;

class ToDoController extends \Laminas\Mvc\Controller\AbstractActionController
{
   
	private $table;
	public function __construct(TaskTable $table){
		$this->table=$table;
	}
	
	
	public function indexAction(): ViewModel
   {
    //    $message = 'Indexação...';
	   $task=$this->table->fetchAll();
       return new ViewModel(['tasks' => $task]);
   }

   public function createAction()
   {
	  $form = new TaskForm();
	  $form->get('submit')->setValue('New Task');
   
	  $request = $this->getRequest();
   
	  if (! $request->isPost()) {
		  return ['form' => $form];
	  }
   
	  $task = new Task();
	  $form->setInputFilter($task->getInputFilter());
	  $form->setData($request->getPost());
   
	  if (! $form->isValid()) {
		  return ['form' => $form];
	  }
   
	  $task->exchangeArray($form->getData());
	  $this->table->saveTask($task);
	  return $this->redirect()->toRoute('todo-app', ['action' => 'index']);
   }

   public function editAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);

		if (0 === $id) {
			return $this->redirect()->toRoute('todo-app-create', ['action' => 'create']);
		}

		try {
			$task = $this->table->getTask($id);
		} catch (\Exception $e) {
			return $this->redirect()->toRoute('todo-app', ['action' => 'index']);
		}

		$form = new TaskForm();
		$form->bind($task);
		$form->get('submit')->setAttribute('value', 'Edit');

		$request = $this->getRequest();
		$viewData = ['id' => $id, 'form' => $form];

		if (!$request->isPost()) {
			return $viewData;
		}

		$form->setInputFilter($task->getInputFilter());
		$form->setData($request->getPost());

		if (!$form->isValid()) {
			return $viewData;
		}

		try {
			$this->table->saveTask($task);
		} catch (Exception $e){
			\error_log("error updating", $e->getMessage());
		}

		return $this->redirect()->toRoute('todo-app', ['action' => 'index']);
	}

	public function finishedAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);
  
		try {
			$task = $this->table->getTask($id);
		} catch (\Exception $e) {
			return $this->redirect()->toRoute('todo-app', ['action' => 'index']);
		}
  
		$task->finished = 1;
		$task->finishDate = new \DateTime();
		try {
			$this->table->saveTask($task);
		} catch (\Exception $e){
			\error_log("error updating", $e->getMessage());
		}
  
		return $this->redirect()->toRoute('todo-app', ['action' => 'show', 'id' => $id]);
	}

	public function deleteAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);

		try {
			$task = $this->table->getTask($id);
		} catch (\Exception $e) {
			return $this->redirect()->toRoute('todo-app', ['action' => 'index']);
		}

		try {
			$this->table->deleteTask($task->id);
		} catch (\Exception $e){
			\error_log("error updating", $e->getMessage());
		}

		return $this->redirect()->toRoute('todo-app', ['action' => 'index']);
	}

	public function showAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);
  
		try {
			$task = $this->table->getTask($id);
		} catch (\Exception $e) {
			return $this->redirect()->toRoute('todo-app', ['action' => 'index']);
		}
		
		//var_dump($task);

		return ['task'=>$task];
	}



}