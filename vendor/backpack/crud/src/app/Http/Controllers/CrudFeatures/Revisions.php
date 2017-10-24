<?php

namespace Backpack\CRUD\app\Http\Controllers\CrudFeatures;

trait Revisions
{
    /**
     * Display the revisions for specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function listRevisions($id)
    {
        $this->crud->hasAccessOrFail('revisions');

        // get the info for that entry
        $this->data['entry'] = $this->crud->getEntry($id);
        $this->data['crud'] = $this->crud;
        $this->data['title'] = ucfirst($this->crud->entity_name).' '.trans('backpack::crud.revisions');
        $this->data['id'] = $id;
        $this->data['revisions'] = $this->crud->listRevisions($id);

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getRevisionsView(), $this->data);
    }

    /**
     * Restore a specific revision for the specified resource.
     *
     * Used via AJAX in the revisions view
     *
     * @param int $id
     *
     * @return JSON Response containing the new revision that was created from the update
     * @return HTTP 500 if the request did not contain the revision ID
     */
    public function restoreRevision($id)
    {
        $this->crud->hasAccessOrFail('revisions');

        $revisionId = \Request::input('revision_id', false);
        if (! $revisionId) {
            abort(500, 'Can\'t restore revision without revision_id');
        } else {
            $this->crud->restoreRevision($id, $revisionId); // do the update

            $this->data['entry'] = $this->crud->getEntry($id);
            $this->data['crud'] = $this->crud;
            $this->data['revisions'] = $this->crud->listRevisions($id); // Reload revisions as they have changed

            // Rebuild the revision timeline HTML and return it to the AJAX call
            // @TODO: Return only the latest revision to save bandwidth - 15/9/16 @se1exin
            return view($this->crud->getRevisionsTimelineView(), $this->data);
        }
    }
}
