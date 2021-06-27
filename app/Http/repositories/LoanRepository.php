<?php


namespace App\Http\repositories;


use App\Http\Constants\APIConstants;
use App\Http\Controllers\APIController;
use App\Models\Loan;
use Illuminate\Support\Facades\Validator;

class LoanRepository extends APIController
{
    use APIConstants;
    private $_loanModel;

    public function __construct()
    {
        $this->_loanModel = new Loan();
    }

    public function addLoan(array $request)
    {
        $validator = Validator::make($request, [
            'name' => ['required', 'string', 'max:50'],
            'term' => ['required', 'string', 'max:50'],
            'amount' => ['required', 'numeric', 'gt:1', 'lte:99999999'],
            'tenure' => ['required', 'string', 'max:2000'],
            'customerId'=>[],
        ]);
        if ($validator->fails()) {
            $response = $this->respondWithValidationError($validator->getMessageBag());
        } else {
            $response = $this->_loanModel->addLoan($request);
            if ($response[$this->status]) {
                $response = $this->respondWithSuccess("Success fully added loan");
            } else {
                $response = $this->respondWithError("Unable to add loan");
            }
        }
        return $response;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}
