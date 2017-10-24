<?php

namespace Backpack\CRUD\PanelTraits;

trait Tabs
{
    public $tabsEnabled = false;
    public $tabsType = 'horizontal';

    public function enableTabs()
    {
        $this->tabsEnabled = true;
        $this->setTabsType(config('backpack.crud.tabs_type', 'horizontal'));

        return $this->tabsEnabled;
    }

    public function disableTabs()
    {
        $this->tabsEnabled = false;

        return $this->tabsEnabled;
    }

    public function tabsEnabled()
    {
        return $this->tabsEnabled;
    }

    public function tabsDisabled()
    {
        return ! $this->tabsEnabled;
    }

    public function setTabsType($type)
    {
        $this->tabsType = $type;

        return $this->tabsType;
    }

    public function getTabsType()
    {
        return $this->tabsType;
    }

    public function enableVerticalTabs()
    {
        return $this->setTabsType('vertical');
    }

    public function disableVerticalTabs()
    {
        return $this->setTabsType('horizontal');
    }

    public function enableHorizontalTabs()
    {
        return $this->setTabsType('horizontal');
    }

    public function disableHorizontalTabs()
    {
        return $this->setTabsType('vertical');
    }

    public function tabExists($label)
    {
        $tabs = $this->getTabs();

        return in_array($label, $tabs);
    }

    public function getLastTab()
    {
        $tabs = $this->getTabs();

        if (count($tabs)) {
            return last($tabs);
        }

        return false;
    }

    public function isLastTab($label)
    {
        return $this->getLastTab() == $label;
    }

    public function getTabFields($label)
    {
        if ($this->tabExists($label)) {
            $all_fields = $this->getCurrentFields();

            $fields_for_current_tab = collect($all_fields)->filter(function ($value, $key) use ($label) {
                return isset($value['tab']) && $value['tab'] == $label;
            });

            if ($this->isLastTab($label)) {
                $fields_without_a_tab = collect($all_fields)->filter(function ($value, $key) {
                    return ! isset($value['tab']);
                });

                $fields_for_current_tab = $fields_for_current_tab->merge($fields_without_a_tab);
            }

            return $fields_for_current_tab;
        }

        return [];
    }

    public function getTabs()
    {
        $tabs = [];
        $fields = $this->getCurrentFields();

        $fields_with_tabs = collect($fields)
            ->filter(function ($value, $key) {
                return isset($value['tab']);
            })
            ->each(function ($value, $key) use (&$tabs) {
                if (! in_array($value['tab'], $tabs)) {
                    $tabs[] = $value['tab'];
                }
            });

        return $tabs;
    }
}
