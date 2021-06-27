<?php


namespace App\Models;


class Loan
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laon';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'amount', 'term', 'loan_date'
    ];
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'loan_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


    public function addLoan(array $request)
    {

        try {
            $loanData= ['name' => $request['name'],
                'term' => $request['term'],
                'amount' => $request['amount'],
                'tenure' => $request['tenure'],
                'created_by' => $request['userId'],
                'fk_user_id' => $request['customerId'],
                'created_at' => new \DateTime('now'),
            ];
            Loan::create($loanData);
            $return = ['status' => true, 'message' => 'Successfully added'];
        } catch (\Throwable $e) {
            dd($e);
            $return = ['status' => false, 'message' => 'Unable to add load'];
        }
        return $return;
    }


    public function updateLoan(array $request, $id)
    {

        try {
            $loan = new Loan;
            $loan->name = $request['name'];
            $loan->term = $request['term'];
            $loan->amount = $request['amount'];
            $loan->tenure = $request['tenure'];
            $loan->created_by = $request['userId'];
            $loan->created_at = new \DateTime('now');
            $loan->save();
            $return = ['status' => true, 'message' => 'Successfully added'];
        } catch (\Throwable $e) {
            $return = ['status' => false, 'message' => 'Unable to add load'];
        }
        return $return;
    }
}
