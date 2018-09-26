<?php

namespace App\Repositories;


use App\Models\ToDo;

class ToDoRepository 
{
    /** @var ToDo  */
    private $toDo;

    /**
     * ToDoRepository constructor.
     * @param ToDo $toDo
     */
    public function __construct(ToDo $toDo)
    {
        $this->toDo = $toDo;
    }

    /**
     * @return array
     */
    public function getCompleteToDos()
    {
        return $this->toDo->where('status', Todo::TODO_STATUS_COMPLETE)->get();
    }

    /**
     * @return array
     */
    public function getUnCompleteToDos()
    {
        return $this->toDo->where('status', Todo::TODO_STATUS_UNCOMPLETE)->get();
    }

    /**
     * @param array $data
     * @return void
     */
    public function create($data)
    {
        $this->toDo->create($data);
    }

    /**
     * @param integer $id
     * @return Todo | null
     */
    public function findByID($id)
    {
        return $this->toDo->find($id);
    }

    /**
     * @param integer $id
     * @return void
     */
    public function deleteByID($id)
    {
        $this->findByID($id)->delete();
    }

    /**
     * @param integer $id
     * @return boolean
     */
    public function setToComplete($id)
    {
        return $this->setStatus($id, Todo::TODO_STATUS_COMPLETE);
    }

    /**
     * @param integer $id
     * @return boolean
     */
    public function setToUnComplete($id)
    {
        return $this->setStatus($id, Todo::TODO_STATUS_UNCOMPLETE);
    }
    
    /**
     * @param integer $id
     * @param integer $statusValue
     * @return boolean
     */
    private function setStatus($id, $statusValue)
    {
        $todo = $this->findByID($id);

        if (!$todo) {
            return false;
        }

        $todo['status'] = $statusValue;
        $todo->save();

        return true;
    }
}
