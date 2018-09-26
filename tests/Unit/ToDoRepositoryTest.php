<?php

namespace Tests\Unit;

use App\Models\ToDo;
use App\Repositories\ToDoRepository;
use Tests\TestCase;

class ToDoRepositoryTest extends TestCase
{
    public function testGetCompletedToDosRequestsCompletedToDos()
    {
        $toDoMock = $this->getMockBuilder(ToDo::class)
            ->disableOriginalConstructor()
            ->getMock();

        $toDoMock->expects($this->once())
            ->method('where')
            ->with('status', ToDo::TODO_STATUS_COMPLETE)
            ->will($this->returnSelf());

        $toDoMock->expects($this->once())
            ->method('get');

        $toDoRepository = new ToDoRepository($toDoMock);

        $toDoRepository->getCompleteToDos();
    }
}