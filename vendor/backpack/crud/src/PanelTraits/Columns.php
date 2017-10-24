<?php

namespace Backpack\CRUD\PanelTraits;

trait Columns
{
    // ------------
    // COLUMNS
    // ------------

    /**
     * Add a bunch of column names and their details to the CRUD object.
     *
     * @param [array or multi-dimensional array]
     */
    public function setColumns($columns)
    {
        // clear any columns already set
        $this->columns = [];

        // if array, add a column for each of the items
        if (is_array($columns) && count($columns)) {
            foreach ($columns as $key => $column) {
                // if label and other details have been defined in the array
                if (is_array($column)) {
                    $this->addColumn($column);
                } else {
                    $this->addColumn([
                                    'name'  => $column,
                                    'label' => ucfirst($column),
                                    'type'  => 'text',
                                ]);
                }
            }
        }

        if (is_string($columns)) {
            $this->addColumn([
                                'name'  => $columns,
                                'label' => ucfirst($columns),
                                'type'  => 'text',
                                ]);
        }

        // This was the old setColumns() function, and it did not work:
        // $this->columns = array_filter(array_map([$this, 'addDefaultTypeToColumn'], $columns));
    }

    /**
     * Add a column at the end of to the CRUD object's "columns" array.
     *
     * @param [string or array]
     */
    public function addColumn($column)
    {
        // if a string was passed, not an array, change it to an array
        if (! is_array($column)) {
            $column = ['name' => $column];
        }

        // make sure the column has a label
        $column_with_details = $this->addDefaultLabel($column);

        // make sure the column has a name
        if (! array_key_exists('name', $column_with_details)) {
            $column_with_details['name'] = 'anonymous_column_'.str_random(5);
        }

        array_filter($this->columns[$column_with_details['name']] = $column_with_details);

        // if this is a relation type field and no corresponding model was specified, get it from the relation method
        // defined in the main model
        if (isset($column_with_details['entity']) && ! isset($column_with_details['model'])) {
            $column_with_details['model'] = $this->getRelationModel($column_with_details['entity']);
        }

        return $this;
    }

    /**
     * Add multiple columns at the end of the CRUD object's "columns" array.
     *
     * @param [array of columns]
     */
    public function addColumns($columns)
    {
        if (count($columns)) {
            foreach ($columns as $key => $column) {
                $this->addColumn($column);
            }
        }
    }

    /**
     * Moves the recently added column to 'before' the $target_col.
     *
     * @param $target_col
     */
    public function beforeColumn($target_col)
    {
        foreach ($this->columns as $column => $value) {
            if ($value['name'] == $target_col) {
                $offset = array_search($column, array_keys($this->columns));
                array_splice($this->columns, $offset, 0, [array_pop($this->columns)]);
                break;
            }
        }
    }

    /**
     * Moves the recently added column to 'after' the $target_col.
     *
     * @param $target
     */
    public function afterColumn($target_col)
    {
        foreach ($this->columns as $column => $value) {
            if ($value['name'] == $target_col) {
                $offset = array_search($column, array_keys($this->columns));
                array_splice($this->columns, $offset + 1, 0, [array_pop($this->columns)]);
                break;
            }
        }
    }

    /**
     * Add the default column type to the given Column, inferring the type from the database column type.
     *
     * @param [column array]
     */
    public function addDefaultTypeToColumn($column)
    {
        if (array_key_exists('name', (array) $column)) {
            $default_type = $this->getFieldTypeFromDbColumnType($column['name']);

            return array_merge(['type' => $default_type], $column);
        }

        return false;
    }

    /**
     * If a field or column array is missing the "label" attribute, an ugly error would be show.
     * So we add the field Name as a label - it's better than nothing.
     *
     * @param [field or column]
     */
    public function addDefaultLabel($array)
    {
        if (! array_key_exists('label', (array) $array) && array_key_exists('name', (array) $array)) {
            $array = array_merge(['label' => ucfirst($this->makeLabel($array['name']))], $array);

            return $array;
        }

        return $array;
    }

    /**
     * Remove multiple columns from the CRUD object using their names.
     *
     * @param  [column array]
     */
    public function removeColumns($columns)
    {
        $this->columns = $this->remove('columns', $columns);
    }

    /**
     * Remove a column from the CRUD object using its name.
     *
     * @param  [column array]
     */
    public function removeColumn($column)
    {
        return $this->removeColumns([$column]);
    }

    /**
     * @param string $entity
     */
    public function remove($entity, $fields)
    {
        return array_values(array_filter($this->{$entity}, function ($field) use ($fields) {
            return ! in_array($field['name'], (array) $fields);
        }));
    }

    /**
     * Change attributes for multiple columns.
     *
     * @param [columns arrays]
     * @param [attributes and values array]
     */
    public function setColumnsDetails($columns, $attributes)
    {
        $this->sync('columns', $columns, $attributes);
    }

    /**
     * Change attributes for a certain column.
     *
     * @param [string] Column name.
     * @param [attributes and values array]
     */
    public function setColumnDetails($column, $attributes)
    {
        $this->setColumnsDetails([$column], $attributes);
    }

    /**
     * Order the columns in a certain way.
     *
     * @param [string] Column name.
     * @param [attributes and values array]
     */
    public function setColumnOrder($columns)
    {
        // TODO
    }

    // ALIAS of setColumnOrder($columns)
    public function setColumnsOrder($columns)
    {
        $this->setColumnOrder($columns);
    }

    /**
     * Get the relationships used in the CRUD columns.
     * @return [array] Relationship names
     */
    public function getColumnsRelationships()
    {
        $columns = $this->getColumns();

        return collect($columns)->pluck('entity')->reject(function ($value, $key) {
            return $value == null;
        })->toArray();
    }

    // ------------
    // TONE FUNCTIONS - UNDOCUMENTED, UNTESTED, SOME MAY BE USED
    // ------------
    // TODO: check them

    public function getColumns()
    {
        return $this->sort('columns');
    }

    public function orderColumns($order)
    {
        $this->setSort('columns', (array) $order);
    }
}
