<?php

namespace App\Repositories\AdminPanel;

use App\Models\Rule;
use App\Repositories\BaseRepository;

/**
 * Class RuleRepository
 * @package App\Repositories\AdminPanel
 * @version January 13, 2021, 2:10 pm EET
*/

class RuleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Rule::class;
    }
}
