<?php

namespace TodosApp\Form;

use Laminas\Form\Form;

class TaskForm extends Form
{
   /** TaskForm constructor. */
   public function __construct()
   {
       parent::__construct('task');

       $this->add([
           'name' => 'id',
           'type' => 'hidden'
       ]);
       $this->add([
           'name' => 'title',
           'type' => 'text',
           'options' => [
               'label' => 'Title'
           ]
       ]);
       $this->add([
           'name' => 'description',
           'type' => 'text',
           'options' => [
               'label' => 'Description'
           ]
       ]);
       $this->add([
          'name' => 'submit',
          'type' => 'submit',
          'attributes' => [
              'value' => 'Go',
              'id' => 'submitbutton'
          ]
       ]);
   }
}
