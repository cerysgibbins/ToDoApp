<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Validator;
use Illuminate\Http\Request;
use App\Validators\ToDoValidator;
use App\Repositories\ToDoRepository;

class ToDosController extends Controller
{
    /** @var ToDoValidator */
    private $validator;

    /** @var ToDoRepository */
    private $repository;

   /**
    * @param ToDoValidator $validator
    * @param ToDoRepository $repository
    */
    public function __construct(ToDoValidator $validator, ToDoRepository $repository) 
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    /**
     * @return Response
     */
    public function index()
    {
        $todos = $this->repository->getUnCompleteToDos();
        $completed = $this->repository->getCompleteToDos();

        return response()->view('index', ['todos' => $todos, 'completed' => $completed]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $validated = $this->validator->validate($request->all());

        if (!$validated) {
            return redirect('/')
                ->withErrors($this->validator->getValidator())
                ->withInput();
        }

        $this->repository->create($request->all());

        return redirect('/');
    }

    /**
     * @param Integer $id
     * @return Response
     */
    public function delete($id)
    {
        $this->repository->deleteByID($id);

        return redirect('/');
    }

    /**
     * @param Integer $id
     * @return Response
     */
    public function edit($id)
    {
        $todo = $this->repository->findByID($id);

        if ($todo === null) {
            return response()->view('error');
        }

        return response()->view('edit', ['todo'=>$todo]);
    }

    /**
     * @param Request $request
     * @param Integer $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $todo = $this->repository->findByID($id);

        if ($todo === null) {
            return response()->view('error');
        }

        $validated = $this->validator->validate($request->all());

        if (!$validated) {
            return redirect('/' . $id)
                ->withErrors($this->validator->getValidator())
                ->withInput();
        }

        $todo->update($request->all());

        return redirect('/');
    }

    /**
     * @param Integer $id
     * @return Response
     */
    public function complete($id)
    {
        $setToComplete = $this->repository->setToComplete($id);

        if (!$setToComplete) {
            return response()->view('error');
        }

        return redirect('/');
    }

    /**
     * @param Integer $id
     * @return Response
     */
    public function uncomplete($id)
    {
        $setToUnComplete = $this->repository->setToUnComplete($id);

        if (!$setToUnComplete) {
            return response()->view('error');
        }

        return redirect('/');
    }
}
