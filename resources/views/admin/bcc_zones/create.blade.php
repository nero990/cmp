@extends('admin.layout.main')

@section('title') BCC Zones @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>BCC Zones</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget-container fluid-height clearfix">
                    <div class="heading">
                        <i class="fa fa-bars"></i>Basic Components
                    </div>
                    <div class="widget-content padded">
                        <form action="#" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-2">Input</label>
                                <div class="col-md-7">
                                    <input class="form-control" placeholder="Text" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Dropdown</label>
                                <div class="col-md-7">
                                    <select class="form-control">
                                        <option value="Category 1">Option 1</option>
                                        <option value="Category 2">Option 2</option>
                                        <option value="Category 3">Option 3</option>
                                        <option value="Category 4">Option 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Multi-Select</label>
                                <div class="col-md-7">
                                    <select class="form-control" multiple="">
                                        <option value="Category 1">Option 1</option>
                                        <option value="Category 2">Option 2</option>
                                        <option value="Category 3">Option 3</option>
                                        <option value="Category 4">Option 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Username Input</label>
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span><input class="form-control"
                                                                                       placeholder="Username"
                                                                                       type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Currency Input</label>
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span><input class="form-control" type="text"><span
                                                class="input-group-addon">.00</span></input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Button Add-on</label>
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <input class="form-control" type="text"><span class="input-group-btn"><button
                                                    class="btn btn-default" type="button">Go</button></span></input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Dropdown Add-on</label>
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <input class="form-control" type="text">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                                    type="button">Actions<span class="caret"></span></button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="#">Action 1</a>
                                                </li>
                                                <li>
                                                    <a href="#">Action 2</a>
                                                </li>
                                                <li>
                                                    <a href="#">Action 3</a>
                                                </li>
                                            </ul>
                                        </div>
                                        </input>
                                    </div>
                                </div>
                            </div>
                            <fieldset disabled="">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="disabledInput">Disabled Input</label>
                                    <div class="col-md-7">
                                        <input class="form-control" id="disabledInput" placeholder="Disabled input"
                                               type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="disabledInput">Disabled Select</label>
                                    <div class="col-md-7">
                                        <select class="form-control" id="disabledSelect">
                                            <option>Disabled select</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group">
                                <label class="control-label col-md-2">Radio Buttons</label>
                                <div class="col-md-7">
                                    <label class="radio" for="option1"><input id="option1" name="optionsRadios1"
                                                                              type="radio" value="option1"><span>Option 1</span></label><label
                                            class="radio"><input checked="" name="optionsRadios1" type="radio"
                                                                 value="option2"><span>Option 2</span></label><label
                                            class="radio"><input name="optionsRadios1" type="radio"
                                                                 value="option3"><span>Option 3</span></label><label
                                            class="radio"><input name="optionsRadios1" type="radio"
                                                                 value="option4"><span>Option 4</span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Radio Buttons</label>
                                <div class="col-md-7">
                                    <label class="radio-inline"><input name="optionsRadios2" type="radio"
                                                                       value="option1"><span>Option 1</span></label><label
                                            class="radio-inline"><input checked="" name="optionsRadios2" type="radio"
                                                                        value="option2"><span>Option 2</span></label><label
                                            class="radio-inline"><input name="optionsRadios2" type="radio"
                                                                        value="option3"><span>Option 3</span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Checkbox</label>
                                <div class="col-md-7">
                                    <label class="checkbox"><input type="checkbox"><span>Checkbox 1</span></label><label
                                            class="checkbox"><input
                                                type="checkbox"><span>Checkbox 2</span></label><label
                                            class="checkbox"><input
                                                type="checkbox"><span>Checkbox 3</span></label><label
                                            class="checkbox"><input type="checkbox"><span>Checkbox 4</span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Checkbox</label>
                                <div class="col-md-7">
                                    <label class="checkbox-inline"><input
                                                type="checkbox"><span>Checkbox 1</span></label><label
                                            class="checkbox-inline"><input
                                                type="checkbox"><span>Checkbox 2</span></label><label
                                            class="checkbox-inline"><input
                                                type="checkbox"><span>Checkbox 3</span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Textarea</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Form Actions</label>
                                <div class="col-md-7">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <button class="btn btn-default-outline">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget-container fluid-height clearfix">
                    <div class="heading">
                        <i class="fa fa-toggle-down"></i>Select2 Dropdowns
                    </div>
                    <div class="widget-content padded">
                        <form action="#" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-2">Select2 Dropdown</label>
                                <div class="col-md-7">
                                    <select class="select2able">
                                        <option value="Category 1">Option 1</option>
                                        <option value="Category 2">Option 2</option>
                                        <option value="Category 3">Option 3</option>
                                        <option value="Category 4">Option 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Multi-Select2</label>
                                <div class="col-md-7">
                                    <select class="select2able" multiple="">
                                        <option value="Category 1">Option 1</option>
                                        <option value="Category 2">Option 2</option>
                                        <option value="Category 3">Option 3</option>
                                        <option value="Category 4">Option 4</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget-container fluid-height clearfix">
                    <div class="heading">
                        <i class="fa fa-comment"></i>Autocomplete
                    </div>
                    <div class="widget-content padded">
                        <form action="#" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-2">U.S. States</label>
                                <div class="col-md-7">
                                    <input autocomplete="off" class="form-control states typeahead tt-query" dir="auto"
                                           placeholder="Search for a U.S. state" spellcheck="false" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Countries</label>
                                <div class="col-md-7">
                                    <input autocomplete="off" class="form-control countries typeahead tt-query"
                                           dir="auto" placeholder="Search for a country" spellcheck="false" type="text">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget-container fluid-height clearfix">
                    <div class="heading">
                        <i class="fa fa-check"></i>Toggle Switches
                    </div>
                    <div class="widget-content padded">
                        <form action="#" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-2">Switch Sizes</label>
                                <div class="col-md-7">
                                    <div class="toggle-switch switch-large">
                                        <input checked="" type="checkbox">
                                    </div>
                                    <div class="toggle-switch">
                                        <input checked="" type="checkbox">
                                    </div>
                                    <div class="toggle-switch switch-small">
                                        <input checked="" type="checkbox">
                                    </div>
                                    <div class="toggle-switch switch-mini">
                                        <input checked="" type="checkbox">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Switch Colors</label>
                                <div class="col-md-7">
                                    <div class="toggle-switch" data-off="info" data-on="primary">
                                        <input checked="" type="checkbox">
                                    </div>
                                    <div class="toggle-switch" data-off="success" data-on="info">
                                        <input checked="" type="checkbox">
                                    </div>
                                    <div class="toggle-switch" data-off="warning" data-on="success">
                                        <input checked="" type="checkbox">
                                    </div>
                                    <div class="toggle-switch" data-off="danger" data-on="warning">
                                        <input checked="" type="checkbox">
                                    </div>
                                    <div class="toggle-switch" data-off="default" data-on="danger">
                                        <input checked="" type="checkbox">
                                    </div>
                                    <div class="toggle-switch" data-off="primary" data-on="default">
                                        <input checked="" type="checkbox">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Different Labels</label>
                                <div class="col-md-7">
                                    <div class="toggle-switch text-toggle-switch" data-off-label="GOODBYE"
                                         data-on="primary" data-on-label="HELLO" style="width:200px;">
                                        <input checked="" type="checkbox">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Authentic Toggle Switch</label>
                                <div class="col-md-7 clearfix">
                                    <div class="holder">
                                        <input checked="checked" class="check-ios" id="check" name="check"
                                               type="checkbox" value="None"><label for="check"></label><span></span>
                                    </div>
                                    <em>(works only in modern browsers)</em>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>Form Validation
                    </div>
                    <div class="widget-content padded">
                        <form action="" id="validate-form" method="get">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">First Name</label><input class="form-control"
                                                                                            id="firstname"
                                                                                            name="firstname"
                                                                                            type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label><input class="form-control"
                                                                                         id="username" name="username"
                                                                                         type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label><input class="form-control"
                                                                                         id="password" name="password"
                                                                                         type="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname">Last Name</label><input class="form-control"
                                                                                          id="lastname" name="lastname"
                                                                                          type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label><input class="form-control" id="email"
                                                                                   name="email" type="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label><input
                                                    class="form-control" id="confirm_password" name="confirm_password"
                                                    type="password">
                                        </div>
                                    </div>
                                </div>
                                <input class="btn btn-primary" type="submit" value="Validate form">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>Validation States
                    </div>
                    <div class="widget-content padded">
                        <div class="row">
                            <form class="col-md-6">
                                <div class="form-group has-warning">
                                    <label class="control-label" for="inputWarning">Warning</label><input
                                            class="form-control" id="inputWarning" type="text">
                                </div>
                                <div class="form-group has-error">
                                    <label class="control-label" for="inputError">Error</label><input
                                            class="form-control" id="inputError" type="text">
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label" for="inputSuccess">Success</label><input
                                            class="form-control" id="inputSuccess" type="text">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget-container fluid-height clearfix">
                    <div class="heading">
                        <i class="fa fa-calendar"></i>Date Pickers
                    </div>
                    <div class="widget-content padded">
                        <form action="#" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-2">Default</label>
                                <div class="col-md-3">
                                    <input class="form-control datepicker" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">As a Component</label>
                                <div class="col-md-3">
                                    <div class="input-group date datepicker">
                                        <input class="form-control" type="text"><span class="input-group-addon"><i
                                                    class="fa fa-calendar"></i></span></input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Autoclose</label>
                                <div class="col-md-3">
                                    <div class="input-group date datepicker" data-date-autoclose="true"
                                         data-date-format="dd-mm-yyyy">
                                        <input class="form-control" type="text"><span class="input-group-addon"><i
                                                    class="fa fa-calendar"></i></span></input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Start With the Year</label>
                                <div class="col-md-3">
                                    <div class="input-group date datepicker" data-date-autoclose="true"
                                         data-date-format="dd.mm.yyyy" data-date-start-view="2">
                                        <input class="form-control" type="text"><span class="input-group-addon"><i
                                                    class="fa fa-calendar"></i></span></input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Date Range 1</label>
                                <div class="col-sm-2">
                                    <input class="form-control" data-date-autoclose="true" data-date-format="dd-mm-yyyy"
                                           id="dpd1" placeholder="Start date" type="text">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" data-date-autoclose="true" data-date-format="dd-mm-yyyy"
                                           id="dpd2" placeholder="End date" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Date Range 2</label>
                                <div class="col-md-3">
                                    <div class="input-group date">
                                        <input class="form-control date-range" type="text"><span
                                                class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget-container fluid-height clearfix">
                    <div class="heading">
                        <i class="fa fa-clock-o"></i>Time Pickers
                    </div>
                    <div class="widget-content padded">
                        <form action="#" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-2">Default</label>
                                <div class="col-md-3">
                                    <div class="input-group bootstrap-timepicker">
                                        <input class="form-control" id="timepicker-default" type="text"><span
                                                class="input-group-addon"><i class="fa fa-clock-o"></i></span></input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">24 Hour</label>
                                <div class="col-md-3">
                                    <div class="input-group bootstrap-timepicker">
                                        <input class="form-control" id="timepicker-24h" type="text"><span
                                                class="input-group-addon"><i class="fa fa-clock-o"></i></span></input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">No Dropdown</label>
                                <div class="col-md-3">
                                    <div class="bootstrap-timepicker">
                                        <input class="form-control" id="timepicker-noTemplate" type="text"><i
                                                class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget-container fluid-height clearfix">
                    <div class="heading">
                        <i class="fa fa-tint"></i>Color Pickers
                    </div>
                    <div class="widget-content padded">
                        <form action="#" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-2">Default</label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="cp1" type="text" value="#8fff00">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">RGBA</label>
                                <div class="col-sm-4">
                                    <input class="form-control" data-color-format="rgba" id="cp2" type="text"
                                           value="rgb(0,194,255,0.78)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">As a Component</label>
                                <div class="col-sm-4">
                                    <div class="input-group color" data-color="rgb(200, 0, 0)" data-color-format="rgb"
                                         id="cp3">
                                        <input class="form-control" readonly="" type="text" value="rgb(200, 0, 0)"><span
                                                class="input-group-addon"><i
                                                    style="background-color: rgb(200, 0, 0)"></i></span></input>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget-container fluid-height clearfix">
                    <div class="heading">
                        <i class="fa fa-reorder"></i>Input Masks
                    </div>
                    <div class="widget-content padded">
                        <form action="#" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-2">Date 1</label>
                                <div class="col-md-3">
                                    <input class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Date 2</label>
                                <div class="col-md-3">
                                    <input class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Phone Number</label>
                                <div class="col-md-3">
                                    <input class="form-control" data-inputmask="'mask': ['(999) 999-9999']" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Social Security #</label>
                                <div class="col-md-3">
                                    <input class="form-control" data-inputmask="'mask': ['999-99-9999']" type="text">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-cloud-upload"></i>File Upload
                    </div>
                    <div class="widget-content padded">
                        <form action="#" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-2">Custom File Upload</label>
                                <div class="col-md-4">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-group">
                                            <div class="form-control">
                                                <i class="fa fa-file fileupload-exists"></i><span
                                                        class="fileupload-preview"></span>
                                            </div>
                                            <div class="input-group-btn">
                                                <a class="btn btn-default fileupload-exists" data-dismiss="fileupload"
                                                   href="#">Remove</a><span class="btn btn-default btn-file"><span
                                                            class="fileupload-new">Select file</span><span
                                                            class="fileupload-exists">Change</span><input
                                                            type="file"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Without Input</label>
                                <div class="col-md-4">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <span class="btn btn-default btn-file"><span
                                                class="fileupload-new">Select file</span><span
                                                class="fileupload-exists">Change</span><input
                                                type="file"></span><span class="fileupload-preview"></span>
                                        <button class="close fileupload-exists" data-dismiss="fileupload"
                                                style="float:none" type="button">&times;
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">With Preview</label>
                                <div class="col-md-4">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image">
                                        </div>
                                        <div class="fileupload-preview fileupload-exists img-thumbnail"
                                             style="width: 200px; max-height: 150px"></div>
                                        <div>
                                        <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span
                                                    class="fileupload-exists">Change</span><input
                                                    type="file"></span><a class="btn btn-default fileupload-exists"
                                                                          data-dismiss="fileupload"
                                                                          href="#">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container fluid-height">
                    <div class="heading">
                        <i class="fa fa-move"></i>Drag and Drop Upload
                    </div>
                    <div class="widget-content padded">
                        <div class="single-file-drop">
                            <h4>
                                Drag and drop files here
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection