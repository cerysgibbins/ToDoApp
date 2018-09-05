<?php 

namespace App\Validators;

use Validator;

class ToDoValidator {

    private $validation;

    /**
     * @param array $data
     * @return boolean
     */
    public function validate($data) 
    {
        $this->validation = Validator::make($data, [
            'note' => 'required',
            'due_date' => 'nullable|date'
        ]);

        return $this->validation->passes();
    }

    /**
     * @return Validator
     */
    public function getValidator() 
    {
        return $this->validation;
    }
}
