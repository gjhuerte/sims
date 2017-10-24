# Changelog

All Notable changes to `Backpack CRUD` will be documented in this file

## NEXT - YYYY-MM-DD

### Added
- Nothing

### Deprecated
- Nothing

### Fixed
- Nothing

### Removed
- Nothing

### Security
- Nothing


## [3.2.19] - 2017-09-05

## Added
- text filter type;

## Fixed
- date_range field start_name value always falled back to default - #450;
- hidden field types now have no height - fixes #555;
- image field type can now be modified in size - fixes #572;
- we were unable to save model with optional fake fields - fixes #616;

## [3.2.18] - 2017-08-30

## Added
- Package autodiscovery for Laravel 5.5;


## [3.2.17] - 2017-08-22

## Fixed
- SluggableScopeHelpers::scopeWhereSlug() signature, thanks to [Pascal VINEY](https://github.com/shaoshiva);


## [3.2.16] - 2017-08-21

## Added
- translation strings for CRUD export buttons, thanks to [Alashow](https://github.com/alashow);

## Fixed
- you can now skip mentioning the model for relation fields and columns (select, select2, select2multiple, etc) - it will be picked up from the relation automatically;


## [3.2.15] - 2017-08-11

## Added
- Danish (da_DK) language files, thanks to [Frederik Rabøl](https://github.com/Xayer);


## [3.2.14] - 2017-08-04

## Added
- Brasilian Portugese translation, thanks to [Guilherme Augusto Henschel](https://github.com/cenoura);
- $crud parameter to the model function that adds a button;

## Fixed
- setFromDb() now uses the column name as array index - so $this->crud->columns[id] instead of $this->crud->columns[arbitrary_number]; this makes afterColumn() and beforeColumn() work with setFromDb() too - #759;
- radio field type now has customizable attributes - fixes #718;
- model_function column breaking when not naming it - fixes #784;
- video column type uses HTTPs and no longer triggers console error - fixes #735;


## [3.2.13] - 2017-07-07

## Added
- German translation, thanks to [Oliver Ziegler](https://github.com/OliverZiegler);
- PHP 7.1 to TravisCI;

### Fixed
- resources loaded twice on tabbed forms - fixes #509;
- beforeColumn and afterColumn not working after setFromDb();
- afterField() always placing the field on the second position;
- date_range filter - clear button now works;
- select2 variants load the JS and CSS from CDN now to fix styling issues;
- show_fields error when no tabs on CRUD entity;

## [3.2.12] - 2017-05-31

### Added
- Latvian translation files (thanks to [Erik Bonder](https://github.com/erik-ropez));
- Russian translation files (thanks to [Aleksei Budaev](https://a-budaev.ru/));
- Dutch translation files (thanks to [Jelmer Visser](https://github.com/jelmervisser))

### Fixed
- allow for revisions by non-logged-in users; fixes #566;
- upgraded Select2 to the latest version, in all select2 fields;
- fixed select2_from_ajax_multiple;
- translated "edit translations" button;
- localize the filters navbar view;
- inline validation error for array fields;
- moved button initialization to CrudPanel constructor;
- pagelength bug; undoes PR #596;


## [3.2.11] - 2017-04-21

### Removed
- Backpack\CRUD no longer loads translations, as Backpack\Base does it for him.

## [3.2.10] - 2017-04-21

### Added
- prefix feature to the image field;

### Fixed
- select_multiple has allows_null option;
- details_row for AjaxDataTables;


## [3.2.9] - 2017-04-20

### Added
- email column type;

### Fixed
- fewer ajax requests when using detailsRow;
- redirect back to the same entry - fixed by #612;
- use "admin" as default elfinder prefix;
- datepicker error fixed by [Pavol Tanuška](https://github.com/pavoltanuska);
- simplemde field also triggered ckeditor when place before it, because of an extra class;
- details row column can be clicked entirely (thanks to [votintsev](https://github.com/votintsev));
- simpleMDE bug fixes and features #507 (thanks to [MarcosBL](https://github.com/MarcosBL));
- allow for dot notation when specifying the label of a reordered item (thanks to [Adam Kelsven](https://github.com/a2thek26));


## [3.2.8] - 2017-04-03

### Added
- fixed typo in saveAction functionality;
- checklist field had hardcoded primary key names;
- french translation for buttons;

## [3.2.7] - 2017-03-16

### Added
- Simplified Chinese translation - thanks to [Zhongwei Sun](https://github.com/sunzhongwei);
- date and date_range filters - thanks to [adriancaamano](https://github.com/adriancaamano);

### Fixed
- fixed horizontal scrollbar showing on list view;
- fixed edit and create extended CSS and JS files not loading;
- fixed AjaxDataTables + filters bug (encoded URL strings);
- replaced camel_case() with str_slug() in tab ids, to provide multibyte support;


## [3.2.6] - 2017-03-13

### Fixed
- custom created_at and updated_at columns threw errors on PHP 5.6;


## [3.2.5] - 2017-03-12

### Fixed
- SaveActions typo - fixes #504;
- Allow for custom created_at and updated_at db columns - fixes #518;
- base64_image field - preserve the original image format when uploading cropped image;
- fix bug where n-n relationship on CREATE only triggers error - fixes #512;
- reduce the number of queries when using the Tabs feature - fixes #461;


## [3.2.4] - 2017-02-24

### Fixed
- Spanish translation;
- Greek translation;
- select2_from_ajax, thanks to [MarcosBL](https://github.com/MarcosBL);
- Translatable "Add" button in table field view;

## [3.2.3] - 2017-02-14

### Fixed
- Spatie/Translatable fake columns had some slashed added to the json - fixes #442;


## [3.2.2] - 2017-02-13

### Fixed
- CrudTrait::getCastedAttributes();



## [3.2.1] - 2017-02-13

### Fixed
- removed a few PHP7 methods, so that PHP 5.6.x is still supported;


## [3.2.0] - 2017-02-13

### Added
- form save button better UI&UX: they have the options in a dropdown instead of radio buttons and the default behaviour is stored in the session upon change - thanks to [Owen Melbourne](https://github.com/OwenMelbz);
- redirect_after_save button actions;
- filters on list views (deleted the 3.1.41 and 4.1.42 tags because they were breaking changes);
- routes are now abstracted intro CrudRoute, so that new routes can be easily added;
- Greek translation (thanks [Stamatis Katsaounis](https://github.com/skatsaounis));
- tabbed create&update forms - thanks to [Owen Melbourne](https://github.com/OwenMelbz);
- grouped and inline errors - thanks to [Owen Melbourne](https://github.com/OwenMelbz);
- developers can now choose custom views per CRUD panel - thanks to [Owen Melbourne](https://github.com/OwenMelbz);
- select2_ajax and select2_ajax_multiple field types - thanks to [maesklaas](https://github.com/maesklaas);

### Fixed
- excluded _method from massAssignment, so create/update errors will be more useful;

## [3.1.60] - 2017-02-13

### Fixed
- select2_ajax and select2_ajax_multiple field types have been renamed to select2_from_ajax and select2_from_ajax_multiple for field naming consistency;


## [3.1.59] - 2017-02-13

### Added
- date_range field, thanks to [Owen Melbourne](https://github.com/OwenMelbz);
- select2_ajax and select2_ajax_multiple field types - thanks to [maesklaas](https://github.com/maesklaas);

### Fixed
- change the way the CrudPanel class is injected, so it can be overwritten more easily;
- simpleMDE field type - full screen fixed;


## [3.1.58] - 2017-02-10

### Added
- Bulgarian translation, thanks to [Petyo Tsonev](https://github.com/petyots);
- select2_from_array, thanks to [Nick Barrett](https://github.com/njbarrett);

### Fixed
- DateTime Picker error when date deleted after being set - fixes #386;
- Abstracted primary key in select_multiple column - fixes #377 and #412;
- AutoSet methods now using the connection on the model, instead of the default connection; This should allow for CRUDs from multiple databases inside one app; Big thanks to [Hamid Alaei Varnosfaderani](https://github.com/halaei) for this PR;
- Check that the Fake field is included in the request before trying to use it;


## [3.1.57] - 2017-02-03

### Added
- Laravel 5.4 compatibility;

### Fixed
- elfinder redirected to /login instead of /admin, because it used the "auth" middleware instead of "admin";


## [3.1.56] - 2017-02-03

### Fixed
- deleting a CRUD entry showed a warning;


## [3.1.55] - 2017-02-02

### Fixed
- allow custom primary key in field types base64_image and checklist_dependency;
- dropdown filter triggered separator on 0 index;
- make sure model events are triggered when deleting;
- in edit view, use the fields variable passed to the view;
- fix conflict bootstrap-datepicker & jquery-ui;
- fix "undefined index: disk" in upload field type;

## [3.1.54] - 2017-01-19

### Fixed
- revisions;


## [3.1.53] - 2017-01-20

### Fixed
- Revisions: $this->update() removed many to many relations;


## [3.1.52] - 2017-01-18

### Fixed
- revisions are sorted by key, not by date, since they keys are auto-incremented anyway; this should allow for multidimensional arrays;


## [3.1.51] - 2017-01-11

### Fixed
- revisions work when there are hidden (fake) fields present;
- the table in list view is responsive (scrollable horizontally) by default;
- new syntax for details_row URL in javascript;
- new syntax for the current URL in layout.blade.php, for making the current menu items active;

## [3.1.50] - 2017-01-08

### Added
- Chinese (Traditional) translation, thanks to [Isaac Kwan](https://github.com/isaackwan);
- You can now create a CRUD field to overwrite the primary key, thanks to [Isaac Kwan](https://github.com/isaackwan);

### Fixed
- Escaped table name for ENUM column types, so reserved PHP/MySQL names can also be used for table names; Fixes #261;
- CrudTrait's isColumnNullable() should now work for multiple-database systems, by getting the connection type automatically;
- Can use DB prefixed tables in CrudTrait's isColumnNullable(); fixes #300;
- Radio field type could not be used inside Settings; Now it can;


## [3.1.49] - 2017-01-08

### Fixed
- select_from_array field triggered an "Undefined index: value" error; fixes #312 thanks to [Chris Thompson](https://christhompsontldr.com/);


## [3.1.48] - 2016-12-14

### Fixed
- Prevent double-json-encoding on complicated field types, when using attribute casting; Fixes #259;


## [3.1.47] - 2016-12-14

### Fixed
- Don't mutate date/datetime if they are empty. It will default to now;
- select_from_array has a new option: "allows_multiple";
- syncPivot is now done before saving the main entity in Update::edit();
- added beforeColumn(), afterColumn(), beforeField() and afterField() methods to more easily reorder fields and columns - big up to [Ben Sutter](https://github.com/b8ne) for this feature;


## [3.1.46] - 2016-12-13

### Fixed
- a filter will be triggered if the variable exists, wether it's null or not;
- if the elfinder route has not been registered, it will be by the CrudServiceProvider;


## [3.1.45] - 2016-12-02

### Added
- $this->crud->with() method, which allows you to easily eager load relationships;
- auto eager loading relationships that are used in the CRUD columns;

### Fixed
- select and select_multiple columns use a considerably lower number of database queries;


## [3.1.44] - 2016-12-02

### Added
- Better ability to interact with the entity that was just saved, in EntityCrudController::create() and update() [the $this->crud->entry and $this->data['entry'] variables];


## [3.1.43] - 2016-11-29

### Fixed
- Allow mixed simple and complex column definitions (thanks [JamesGuthrie](https://github.com/JamesGuthrie));
- disable default DataTable ordering;


## [3.1.42] - 2016-11-13

### Fixed
- n-n filters prevented CRUD items from being added;


## [3.1.41] - 2016-11-11

### Added
- filters on list view;


## [3.1.40] - 2016-11-06

### Fixed
- fixed video field having an extra input on page;
- fixed hasUploadFields() check for update edit form; fixes #211;


## [3.1.39] - 2016-11-06

### Fixed
- fixed SimpleMDE which was broken by last commit; really fixes #222;


## [3.1.38] - 2016-11-04

### Fixed
- SimpleMDE field type did not allow multiple such field types in one form; fixes #222;


## [3.1.37] - 2016-11-03

### Fixed
- Boolean column type triggered error because of improper use of the trans() helper;


## [3.1.36] - 2016-10-30

### Added
- SimpleMDE field type (simple markdown editor).


## [3.1.35] - 2016-10-30

### Added
- new column type: boolean;
- new field type: color_picker;
- new field type: date_picker;
- new field type: datetime_picker;

### Fixed
- fixed default of 0 for radio field types;
- fixes #187 - can now clear old address entries;
- fixes hiding/showing buttons when the min/max are reached;
- ckeditor field type now has customizable plugins;


## [3.1.34] - 2016-10-22

### Fixed
- Config file is now published in the right folder.


## [3.1.33] - 2016-10-17

### Fixed
- all fields now have hint, default value and customizable wrapper class - thanks to [Owen Melbourne](https://github.com/OwenMelbz); modifications were made in the following fields: base64_image, checklist, checklist_dependecy, image;
- creating/updating elements works with morphable fields too; you need to define "morph" => true on the field for it to work;
- isCollumnNullable is now calculated using Doctrine, so that it works for MySQL, PosgreSQL and SQLite;


## [3.1.32] - 2016-10-17

### Added
- video field type - thanks to [Owen Melbourne](https://github.com/OwenMelbz);


## [3.1.31] - 2016-10-17

### Added
- $this->crud->removeAllButtons() and $this->crud->removeAllButtonsFromStack();


## [3.1.30] - 2016-10-17

### Fixed
- upload_multiple field did not remove the files from disk if no new files were added; solved with a hack - added a hidden input with the same name before it, so it always has a value and the mutator is always triggered;


## [3.1.29] - 2016-10-17

### Fixed
- elFinder height needed a 2px adjustment in javascript; now that's solved using css;


## [3.1.28] - 2016-10-16

### Added
- When elfinder is launched as it's own window, display full-screen;

### Fixed
- Update routes and editor links to follow the route_prefix set in config;
- elFinder iframe now has no white background and uses backpack theme;


## [3.1.27] - 2016-10-7

### Fixed
- 'table' field is properly encapsulated now;


## [3.1.26] - 2016-09-30

### Fixed
- bug fix for 'table' field type - you can now have multiple fields on the same form;


## [3.1.25] - 2016-09-28

### Fixed
- table field JSON bug;


## [3.1.24] - 2016-09-27

### Added
- address field type - thanks to [Owen Melbourne](https://github.com/OwenMelbz);


## [3.1.23] - 2016-09-27

### Added
- autoFocus() and autoFocusOnFirstField() - thanks to [Owen Melbourne](https://github.com/OwenMelbz);


## [3.1.22] - 2016-09-27

### Fixed
- checklist and checklist_dependency fields allow html on labels;


## [3.1.21] - 2016-09-26

### Added
- "table" field type - thanks to [Owen Melbourne](https://github.com/OwenMelbz);
- "multidimensional_array" column type - thanks to [Owen Melbourne](https://github.com/OwenMelbz);


## [3.1.20] - 2016-09-26

### Added
- Non-core CRUD features are now separated into traits;

### Fixed
- The 'password' field is no longer filtered before the create event;
- CrudPanels can now be defined in the new EntityCrudController::setup() method;

## [3.1.19] - 2016-09-26

### Fixed
- AJAX datatables can now have select_multiple columns;


## [3.1.18] - 2016-09-25

### Fixed
- checkbox field has default value;



## [3.1.17] - 2016-09-25

### Fixed
- Raw DB queries did not account for DB prefixes;


## [3.1.16] - 2016-09-22

### Added
- Radio field and column - thanks to [Owen Melbourne](https://github.com/OwenMelbz);


## [3.1.15] - 2016-09-21

### Fixed
- Missing $fillable item in model will now throw correct error, because _token is ignored;
- Correct and complete language files;


## [3.1.14] - 2016-09-19

### Fixed
- Checkbox storing issue in Laravel 5.3 - #115 thanks to [timdiels1](https://github.com/timdiels1);


## [3.1.13] - 2016-09-19

### Added
- Revisions functionality, thanks to [se1exin](https://github.com/se1exin);


## [3.1.12] - 2016-09-19

### Added
- French translation, thanks to [7ute](https://github.com/7ute);


## [3.1.11] - 2016-09-19

### Added
- iconpicker field type;


## [3.1.10] - 2016-09-16

### Fixed
- removeButton and removeButtonFromStack functionality, thanks to [Alexander N](https://github.com/morfin60);


## [3.1.9] - 2016-09-16

### Added
- "prefix" and "suffix" optional attributes on the number and text field types;


## [3.1.8] - 2016-09-15

### Fixed
- upload and upload_multiple can be used for S3 file storage too, by specifying the disk on the field;


## [3.1.7] - 2016-09-15

### Added
- image field type - stores a base64 image from the front-end into a jpg/png file using Intervention/Image;


## [3.1.6] - 2016-09-15

### Added
- upload_multiple field type;


## [3.1.5] - 2016-09-14

### Added
- upload field type;

### Fixed
- setFromDb() no longer creates a field for created_at;


## [3.1.4] - 2016-09-12

### Added
- Export buttons for CRUDs - to PDF, XLS, CSV and Print, thanks to [Nathaniel Kristofer Schweinberg](https://github.com/nathanielks);


## [3.1.3] - 2016-09-12

### Added
- a "view" field type, which loads a custom view from a specified location; thanks to [Nathaniel Kristofer Schweinberg](https://github.com/nathanielks);


## [3.1.2] - 2016-09-12

### Fixed
- save, update and reorder now replace empty inputs with NULL to allow for MySQL strict mode on (a default in Laravel 5.3) (#94)


## [3.1.1] - 2016-09-05

### Added
- Allow HTML in all field labels (#98)


## [3.1.0] - 2016-08-31

### Added
- Laravel 5.3 support;


## [3.0.17] - 2016-08-26

### Fixed
- adding buttons from views did not work; fixes #93;


## [3.0.16] - 2016-08-24

### Fixed
- Removed recurring comment from list view; Fixes #92;
- Added check for permission in the CrudController::search() method for allowing the AJAX table only if list is enabled;


## [3.0.15] - 2016-08-20

### Fixed
- Removed double-token input in Create view; Fixes #89;


## [3.0.14] - 2016-08-20

### Fixed
- Fixed AJAX table view with big data sets - was still selecting all rows from the DB; Fixes #87;


## [3.0.13] - 2016-08-17

### Fixed
- Custom pivot table in select2 and select2_multiple fields; Fixes #75;


## [3.0.12] - 2016-08-17

### Fixed
- Reorder view works with custom primary keys; fixes #85;
- URLs in views now use the backpack.base.route_prefix; fixes #88;


## [3.0.11] - 2016-08-12

### Added
- Spanish translation, thanks to [Rafael Ernesto Ferro González](https://github.com/rafix);


## [3.0.10] - 2016-08-09

### Removed
- PHP dependency, since it's already settled in Backpack\Base, which is a requirement;


## [3.0.9] - 2016-08-06

### Added
- base64_image field type, thanks to [deslittle](https://github.com/deslittle);


## [3.0.8] - 2016-08-05

### Added
- automatic route names for all CRUD::resource() routes;


## [3.0.7] - 2016-08-05

### Added
- PDO Support;

### Removed
- default column values on the setFromDb() function;


## [3.0.6] - 2016-07-31

### Added
- Bogus unit tests. At least we'be able to use travis-ci for requirements errors, until full unit tests are done.


## [3.0.5] - 2016-07-30

### Added
- Auto-registering the Backpack\Base class;
- Improved documentation for those who want to just install Backpack\CRUD;


## [3.0.4] - 2016-07-30

### Added
- Auto-registering the Backpack\Base class;
- Improved documentation for those who want to just install Backpack\CRUD;


## [3.0.3] - 2016-07-25

### Added
- Ctrl+S and Cmd+S submit the form;


## [3.0.2] - 2016-07-24

### Added
- added last parameter to addButton() function which determines wether to add the button to the beginning or end of the stack;


## [3.0.1] - 2016-07-23

### Added
- 'array' column type (stored as JSON in the db); also supports attribute casting;
- support for attribute casting in Date and Datetime field types;


## [3.0.0] - 2016-07-22

### Added
- wrapperAttributes to all field types, for resizing with col-md-6 and such;
- 'default' value for most field types;
- hint to most field types;
- extendable column types (same as field types, each in their own blade file);
- 'date' and 'datetime' column types;
- 'check' column type;
- button stacks;
- custom buttons, as views or model_function;
- registered service providers in order to simplify installation process;
- configurable number of rows in the table view, by giving a custom value in the config file or in the CRUD panel's constructor;

### Removed
- "required" functionality with just added asterisks to the fields;

### Fixed
- renamed the $field_types property to $db_column_types to more accurately describe what it is;
- issue #58 where select_from_array automatically selected an item with value zero;
- custom html attributes are now given to the field in a separate array, 'attributes';


## ----------------------------------------------------------------------------


## [2.0.24] - 2016-07-13

### Added
- model_function_attribute column type (kudos to [rgreer4](https://github.com/rgreer4))


## [2.0.23] - 2016-07-13

### Added
- Support for $primaryKey variable on the model (no longer dependant on ID as primary key).


## [2.0.22] - 2016-06-27

### Fixed
- Fix removeField method
- Improve autoSetFromDB method


## [2.0.21] - 2016-06-21

### Fixed
- Old input value on text fields in the create form;
- "Please fix" lang text.


## [2.0.20] - 2016-06-19

### Fixed
- Translate browse and page_or_link fields


## [2.0.19] - 2016-06-16

### Fixed
- Split the Crud.php class into multiple traits, for legibility;
- Renamed the Crud.php class to CrudPanel;


## [2.0.18] - 2016-06-16

### Removed
- Tone's old field types (were only here for reference);
- Tone's old layouts (were only here for reference);


## [2.0.17] - 2016-06-16

### Added
- $crud->hasAccessToAny($array) method;
- $crud->hasAccessToAll($array) method;


## [2.0.16] - 2016-06-15

### Fixed
- CrudController - use passed request before fallback to global one;


## [2.0.15] - 2016-06-14

### Fixed
- select_multiple worked, select2_multiple did not; #26


## [2.0.14] - 2016-06-13

### Fixed
- Allow HTML in fields help block;


## [2.0.13] - 2016-06-09

### Added
- Italian translation;
- Browse field parameter to disable readonly state;


## [2.0.12] - 2016-06-06

### Fixed
- multiple browse fields on one form did not work;


## [2.0.11] - 2016-06-06

### Fixed
- multiple browse fields on one form did not work;


## [2.0.10] - 2016-06-06

### Fixed
- browse field did not work if Laravel was installed in a subfolder;
- browse field Clear button did not clear the input;
- select_from_array field did not work;
- Crud::setFromDb() now defaults to NULL instead of empty string;


## [2.0.9] - 2016-05-27

### Deprecated
- Route::controller() - it's been deprecated in Laravel 5.2, so we can't use it anymore;


## [2.0.8] - 2016-05-26

### Added
- page_or_link field type now has a 'page_model' attribute in its definition;


## [2.0.7] - 2016-05-25

### Added
- Text columns can now be added with a string $this->crud->addColumn('title');
- Added hint to the 'text' field type;
- Added the 'custom_html' field type;


## [2.0.6] - 2016-05-25

### Fixed
- Elfinder triggered an error on file upload, though uploads were being done fine.


## [2.0.5] - 2016-05-20

### Fixed
- Removing columns was fixed.


## [2.0.4] - 2016-05-20

### Fixed
- Fields with subfields did not work any more (mainly checklist_dependency);


## [2.0.3] - 2016-05-20

### Fixed
- Easier CRUD Field definition - complex fields no longer need a separate .js and .css files; the extra css and js for a field will be defined in the same file, and then pushed to a stack in the form_content.blade.php view, which will put in the proper after_styles or after_scripts section. By default, the styles and scripts will be pushed to the page only once per field type (no need to have select2.js five times onpage if we have 5 select2 inputs)
- Changed existing complex fields (with JS and CSS) to this new definition.


## [2.0.2] - 2016-05-20

### Added
- Working CRUD API functions for adding fields and removing fields.
- Removed deprecated file: ToneCrud.php


## [2.0.1] - 2016-05-19

### Fixed
- Crud.php fixes found out during Backpack\PermissionManager development.
- Added developers to readme file.


## [2.0.0] - 2016-05-18

### Added
- Call-based API.


## ----------------------------------------------------------------------------


## [0.9.10] - 2016-03-17

### Fixed
- Fixed some scrutinizer bugs.


## [0.9.9] - 2016-03-16

### Added
- Added page title.


## [0.9.8] - 2016-03-14

### Added
- Added a custom theme for elfinder, called elfinder.backpack.theme, that gets published with the CRUD public files.


## [0.9.7] - 2016-03-12

### Fixed
- Using LangFileManager for translatable models instead of Dick's old package.


## [0.9.6] - 2016-03-12

### Fixed
- Lang files are pushed in the correct folder now. For realsies.


## [0.9.5] - 2016-03-12

### Fixed
- language files are published in the correct folder, no /vendor/ subfolder


## [0.9.4] - 2016-03-11

### Added
- CRUD::resource() now also acts as an implicit controller too.

### Removed
- firstViewThatExists() method in CrudController - its functionality is already solved by the view() helper, since we now load the views in the correct order in CrudServiceProvider



## [0.9.3] - 2016-03-11

### Fixed
- elFinder erro "Undefined variable: file" is fixed with a composer update. Just make sure you have studio-42/elfinder version 2.1.9 or higher.
- Added authentication middleware to elFinder config.


## [0.9.2] - 2016-03-10

### Fixed
- Fixed ckeditor field type.
- Added menu item instructions in readme.


## [0.9.1] - 2016-03-10

### Fixed
- Changed folder structure (Http is in app folder now).


## [0.9.0] - 2016-03-10

### Fixed
- Changed name from Dick/CRUD to Backpack/CRUD.

### Removed
- Entrust permissions.


## [0.8.17] - 2016-02-23

### Fixed
- two or more select2 or select2_multiple fields in the same form loads the appropriate .js file two times, so error. this fixes it.


## [0.8.13] - 2015-10-07

### Fixed
- CRUD list view bug fixed thanks to Bradis García Labaceno. The DELETE button didn't work for subsequent results pages, now it does.


## [0.8.12] - 2015-10-02

### Fixed
- CrudRequest used classes from the 'App' namespace, which rendered errors when the application namespace had been renamed by the developer;


## [0.8.11] - 2015-10-02

### Fixed
- CrudController used classes from the 'App' namespace, which rendered errors when the application namespace had been renamed by the developer;


## [0.8.9] - 2015-09-22

### Added
- added new column type: "model_function", that runs a certain function on the CRUD model;


## [0.8.8] - 2015-09-17

### Fixed
- bumped version;


## [0.8.7] - 2015-09-17

### Fixed
- update_fields and create_fields were being ignored because of the fake fields; now they're taken into consideration again, to allow different fields on the add/edit forms;

## [0.8.6] - 2015-09-11

### Fixed
- DateTime field type needed some magic to properly use the default value as stored in MySQL.

## [0.8.5] - 2015-09-11

### Fixed
- Fixed bug where reordering multi-language items didn't work through AJAX (route wasn't defined);


## [0.8.4] - 2015-09-10

### Added
- allTranslations() method on CrudTrait, to easily get all connected entities;


## [0.8.3] - 2015-09-10

### Added
- withFakes() method on CrudTrait, to easily get entities with fakes fields;

## [0.8.1] - 2015-09-09

### Added
- CRUD Alias for handling the routes. Now instead of defining a Route::resource() and a bunch of other routes if you need reorder/translations etc, you only define CRUD:resource() instead (same syntax) and the CrudServiceProvider will define all the routes you need. That, of course, if you define 'CRUD' => 'Dick\CRUD\CrudServiceProvider' in your config/app.php file, under 'aliases'.


## [0.8.0] - 2015-09-09

### Added
- CRUD Multi-language editing. If the EntityCrudController's "details_row" is set to true, by default the CRUD will output the translations for that entity's row. Tested and working add, edit, delete and reordering both for original rows and for translation rows.


## [0.7.9] - 2015-09-09

### Added
- CRUD Details Row functionality: if enabled, it will show a + sign for each row. When clicked, an AJAX call will return the showDetailsRow() method on the controller and place it in a row right below the current one; Currently that method just dumps the entry; But hey, it works.


## [0.7.8] - 2015-09-08

### Fixed
- In CRUD reordering, the leaf ID was outputted for debuging.


## [0.7.7] - 2015-09-08

### Added
- New field type: page_or_link; It's used in the MenuManager package, but can be used in any other model;


## [0.7.4] - 2015-09-08

### Added
- Actually started using CHANGELOG.md to track modifications.

### Fixed
- Reordering echo algorithm. It now takes account of leaf order.

