<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminClientRequest;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Services\ClientServices;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $repository;
    /**
     * @var ClientServices
     */
    private $clientServices;

    /**
     * ClientRepository constructor.
     * @param ClientRepository $repository
     * @param ClientServices $clientServices
     */
    public function __construct(ClientRepository $repository, ClientServices $clientServices)
    {
        $this->repository = $repository;
        $this->clientServices = $clientServices;
    }

    public function index()
    {
        $clients = $this->repository->paginate();

        return view('admin.clients.index', compact('clients'));
    }
    
    public function create()
    {

        return view('admin.clients.create');
    }

    public function store(AdminClientRequest $request)
    {
        $data = $request->all();
        $this->clientServices->create($data);

        return redirect()->route('admin.clients.index');
    }

    public function edit($id)
    {
        $client=$this->repository->find($id);
        return view('admin.clients.edit', compact('client'));
    }
    
    public function update(AdminClientRequest $request, $id)
    {
        $data = $request->all();
        $this->clientServices->update($data, $id);

        return redirect()->route('admin.clients.index');
    }
}
