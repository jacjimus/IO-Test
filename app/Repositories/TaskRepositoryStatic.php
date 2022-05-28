<?php

namespace App\Repositories;

class TaskRepositoryStatic implements TaskRepositoryInterface
{
    protected $_model;

    public function __construct()
    {
        $task = collect([
            [
                'description' => 'The charm of this car. Choose CIMA. It is the pride and pleasure of choosing one vertex.',
                'user_id' => 1,
                'status' => 'New',
                'created_at' => '',
            ],
            [
                'description' => 'The Infiniti brand is highly regarded for its advanced design and powerful performance in each of its markets, including the U.S., Canada, Europe, Russia, the Middle East, China and Korea. With its highly refined style and responsiveness, Infiniti promises a driving experience with unparalleled appeal.',
                'user_id' => 1,
                'status' => 'New',
                'created_at' => '',
            ],
            [
                'description' => 'Datsun will provide an appealing and sustainable motoring experience to optimistic up-and-coming customers in high-growth markets. Datsun combines Nissan Motor\'s 80 years of Japanese car-making expertise with the nearly century-old Datsun Brand DNA. Datsun vehicles will be Local Products ensured by a Global Brand, and starts sales in India, Indonesia, Russia and South Africa from 2014.',
                'user_id' => 1,
                'status' => 'New',
                'created_at' => '',
            ]
        ]);
        $this->_model = $task;
    }

    /**
     * Get All
     *
     * @return array
     */
    public function get()
    {
        return $this->_model->all();
    }

    /**
     * Get one
     *
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->_model->find($id);

        return $result;
    }

    /**
     * Create
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    /**
     * Update
     *
     * @param $id
     * @param array $attributes
     *
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);

            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     *
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    /**
     * Pagination
     *
     * @param $perPage
     *
     * @return mixed
     */
    public function paginate($perPage)
    {
        return $this->_model->paginate($perPage);
    }

    /**
     * Latest
     *
     * @return mixed
     */
    public function latest()
    {
        return $this->_model->sortBy('created_at');
    }
}
