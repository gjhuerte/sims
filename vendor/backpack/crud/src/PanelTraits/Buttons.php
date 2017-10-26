<?php

namespace Backpack\CRUD\PanelTraits;

trait Buttons
{
    // ------------
    // BUTTONS
    // ------------

    // TODO: $this->crud->reorderButtons('stack_name', ['one', 'two']);

    /**
     * Add a button to the CRUD table view.
     *
     * @param string $stack Where should the button be visible? Options: top, line, bottom.
     * @param string $name The name of the button. Unique.
     * @param string $type Type of button: view or model_function.
     * @param string $content The HTML for the button.
     * @param bool|string $position Position on the stack: beginning or end. If false, the position will be
     *                                 'beginning' for the line stack or 'end' otherwise.
     * @param bool $replaceExisting True if a button with the same name on the given stack should be replaced.
     * @return \Backpack\CRUD\PanelTraits\CrudButton The new CRUD button.
     */
    public function addButton($stack, $name, $type, $content, $position = false, $replaceExisting = true)
    {
        if ($position == false) {
            switch ($stack) {
                case 'line':
                    $position = 'beginning';
                    break;

                default:
                    $position = 'end';
                    break;
            }
        }

        if ($replaceExisting) {
            $this->removeButton($name, $stack);
        }

        $button = new CrudButton($stack, $name, $type, $content);
        switch ($position) {
            case 'beginning':
                $this->buttons->prepend($button);
                break;

            default:
                $this->buttons->push($button);
                break;
        }

        return $button;
    }

    public function addButtonFromModelFunction($stack, $name, $model_function_name, $position = false)
    {
        $this->addButton($stack, $name, 'model_function', $model_function_name, $position);
    }

    public function addButtonFromView($stack, $name, $view, $position = false)
    {
        $view = 'vendor.backpack.crud.buttons.'.$view;

        $this->addButton($stack, $name, 'view', $view, $position);
    }

    public function buttons()
    {
        return $this->buttons;
    }

    public function initButtons()
    {
        $this->buttons = collect();

        // line stack
        $this->addButton('line', 'preview', 'view', 'crud::buttons.preview', 'end');
        $this->addButton('line', 'update', 'view', 'crud::buttons.update', 'end');
        $this->addButton('line', 'revisions', 'view', 'crud::buttons.revisions', 'end');
        $this->addButton('line', 'delete', 'view', 'crud::buttons.delete', 'end');

        // top stack
        $this->addButton('top', 'create', 'view', 'crud::buttons.create');
        $this->addButton('top', 'reorder', 'view', 'crud::buttons.reorder');
    }

    /**
     * Remove a button from the CRUD panel.
     *
     * @param string $name Button name.
     * @param string $stack Optional stack name.
     */
    public function removeButton($name, $stack = null)
    {
        $this->buttons = $this->buttons->reject(function ($button) use ($name, $stack) {
            return $stack == null ? $button->name == $name : ($button->stack == $stack) && ($button->name == $name);
        });
    }

    public function removeAllButtons()
    {
        $this->buttons = collect([]);
    }

    public function removeAllButtonsFromStack($stack)
    {
        $this->buttons = $this->buttons->reject(function ($button) use ($stack) {
            return $button->stack == $stack;
        });
    }

    public function removeButtonFromStack($name, $stack)
    {
        $this->buttons = $this->buttons->reject(function ($button) use ($name, $stack) {
            return $button->name == $name && $button->stack == $stack;
        });
    }
}

class CrudButton
{
    public $stack;
    public $name;
    public $type = 'view';
    public $content;

    public function __construct($stack, $name, $type, $content)
    {
        $this->stack = $stack;
        $this->name = $name;
        $this->type = $type;
        $this->content = $content;
    }
}
