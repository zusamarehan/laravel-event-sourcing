<?php

namespace App\Http\Controllers;

use App\Domain\Aggregators\Project\ProjectAggregateRoot;
use App\Domain\Command\UpdateCurrentCommand;
use App\Http\Requests\ProjectRequest;
use App\Project;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('project.form');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     */
    public function store(ProjectRequest $request)
    {
        (new UpdateCurrentCommand($request->get('_pudding_command')))('processing', 'OK');

        $aggregate = new ProjectAggregateRoot($request->except(['_token', 'module','_pudding_command']));
        $uuid = $aggregate->store();

        (new UpdateCurrentCommand($request->get('_pudding_command')))('processed', $uuid);

        return redirect()->back()->with('status', 'Project Created');
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return Application|Factory|View
     */
    public function show(Project $project)
    {
        return view('project.show', [
            'project' => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ProjectRequest $request, $id)
    {
        (new UpdateCurrentCommand($request->get('_pudding_command')))('processing', 'OK');

        $aggregate = new ProjectAggregateRoot($request->except(['_token', 'module', '_pudding_command', '_method']));
        $aggregate->update();

        (new UpdateCurrentCommand($request->get('_pudding_command')))('processed', $request->get('uuid'));

        return redirect()->back()->with('status', 'Project Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
