<?php
namespace Tests\Unit;

use App\Models\ToDo;
use App\Validators\ToDoValidator;
use Illuminate\Validation\Validator;
use Tests\TestCase;

class ToDoValidatorTest extends TestCase
{
    public function testValidationFailsIfDataIsIncorrect()
    {
        $validator = new ToDoValidator();

        $data = [
            'note' => '',
            'due_date' => null
        ];

        $this->assertFalse($validator->validate($data));
    }

    public function testValidationPassesIfDataIsCorrect()
    {
        $validator = new ToDoValidator();

        $data = [
            'note' => 'Cerys',
            'due_date' => null
        ];

        $this->assertTrue($validator->validate($data));
    }

    public function testGetValidatorReturnsAValidatorObject()
    {
        $validator = new ToDoValidator();

        $data = [
            'note' => 'Cerys',
            'due_date' => null
        ];

        $validator->validate($data);

        $this->assertInstanceOf(Validator::class, $validator->getValidator());
    }
}
