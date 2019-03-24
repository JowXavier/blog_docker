<?php

namespace Blog\Services;
use Blog\Repositories\TagRepository;

class TagService
{
    private $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Busca todos os registros de tags.
     *
     */
    public function list()
    {
        return $this->repository->list();
    }

    /**
     * Busca um registro específico no banco.
     *
     * @param mixed $id
     */
    public function get($id)
    {
        return $this->repository->get($id);
    }

    /**
     * Cria um um registro no banco de dados.
     *
     * @param mixed $data
     */
    public function create($data)
    {
        $this->repository->create($data);
    }

    /**
     * Edita o registro no banco de dados.
     *
     * @param mixed $data
     * @param mixed $id
     */
    public function update($data, $id)
    {
        $this->repository->update($data, $id);
    }

     /**
     * Desativa um registro no banco de dados.
     *
     * @param mixed $id
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);
    }
}