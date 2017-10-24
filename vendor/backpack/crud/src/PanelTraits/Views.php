<?php

namespace Backpack\CRUD\PanelTraits;

trait Views
{
    protected $createView = 'crud::create';
    protected $editView = 'crud::edit';
    protected $showView = 'crud::show';
    protected $detailsRowView = 'crud::details_row';
    protected $revisionsView = 'crud::revisions';
    protected $revisionsTimelineView = 'crud::inc.revision_timeline';
    protected $reorderView = 'crud::reorder';
    protected $listView = 'crud::list';

    // -------
    // CREATE
    // -------

    /**
     * Sets the list template.
     * @param string $view name of the template file
     * @return string $view name of the template file
     */
    public function setCreateView($view)
    {
        $this->createView = $view;

        return $this->createView;
    }

    /**
     * Gets the create template.
     * @return string name of the template file
     */
    public function getCreateView()
    {
        return $this->createView;
    }

    // -------
    // READ
    // -------

    /**
     * Sets the list template.
     * @param string $view name of the template file
     * @return string $view name of the template file
     */
    public function setListView($view)
    {
        $this->listView = $view;

        return $this->listView;
    }

    /**
     * Gets the list template.
     * @return string name of the template file
     */
    public function getListView()
    {
        return $this->listView;
    }

    /**
     * Sets the details row template.
     * @param string $view name of the template file
     * @return string $view name of the template file
     */
    public function setDetailsRowView($view)
    {
        $this->detailsRowView = $view;

        return $this->detailsRowView;
    }

    /**
     * Gets the details row template.
     * @return string name of the template file
     */
    public function getDetailsRowView()
    {
        return $this->detailsRowView;
    }

    /**
     * Sets the show template.
     * @param string $view name of the template file
     * @return string $view name of the template file
     */
    public function setShowView($view)
    {
        $this->showView = $view;

        return $this->showView;
    }

    /**
     * Gets the show template.
     * @return string name of the template file
     */
    public function getShowView()
    {
        return $this->showView;
    }

    // -------
    // UPDATE
    // -------

    /**
     * Sets the edit template.
     * @param string $view name of the template file
     * @return string $view name of the template file
     */
    public function setEditView($view)
    {
        $this->editView = $view;

        return $this->editView;
    }

    /**
     * Gets the edit template.
     * @return string name of the template file
     */
    public function getEditView()
    {
        return $this->editView;
    }

    /**
     * Sets the reorder template.
     * @param string $view name of the template file
     * @return string $view name of the template file
     */
    public function setReorderView($view)
    {
        $this->reorderView = $view;

        return $this->reorderView;
    }

    /**
     * Gets the reorder template.
     * @return string name of the template file
     */
    public function getReorderView()
    {
        return $this->reorderView;
    }

    /**
     * Sets the revision template.
     * @param string $view name of the template file
     * @return string $view name of the template file
     */
    public function setRevisionsView($view)
    {
        $this->revisionsView = $view;

        return $this->revisionsView;
    }

    /**
     * Sets the revision template.
     * @param string $view name of the template file
     * @return string $view name of the template file
     */
    public function setRevisionsTimelineView($view)
    {
        $this->revisionsTimelineView = $view;

        return $this->revisionsTimelineView;
    }

    /**
     * Gets the revisions template.
     * @return string name of the template file
     */
    public function getRevisionsView()
    {
        return $this->revisionsView;
    }

    /**
     * Gets the revisions template.
     * @return string name of the template file
     */
    public function getRevisionsTimelineView()
    {
        return $this->revisionsTimelineView;
    }

    // -------
    // ALIASES
    // -------

    public function getPreviewView()
    {
        return $this->getShowView();
    }

    public function setPreviewView($view)
    {
        return $this->setShowView($view);
    }

    public function getUpdateView()
    {
        return $this->getEditView();
    }

    public function setUpdateView($view)
    {
        return $this->setEditView($view);
    }
}
