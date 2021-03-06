<?php
$this->title = "Kalendár";

$this->registerJSFile('@web/assets/node_modules/calendar/jquery-ui.min.js',['depends'=>\backend\assets\RealAsset::className()]);
$this->registerJSFile('@web/assets/node_modules/moment/moment.js',['depends'=>\backend\assets\RealAsset::className()]);
$this->registerJSFile('@web/assets/node_modules/calendar/dist/fullcalendar.min.js',['depends'=>\backend\assets\RealAsset::className()]);
$this->registerJSFile('@web/assets/node_modules/calendar/dist/cal-init.js',['depends'=>\backend\assets\RealAsset::className()]);
$this->registerCSSFile('@web/assets/node_modules/calendar/dist/fullcalendar.css',['depends'=>\backend\assets\RealAsset::className()]);
?>

<div class="container-fluid">
                
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>
                
    <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="card-body">
                                            <h4 class="card-title m-t-10"><?= Yii::t('app', 'Potiahni a Pusti')?></h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="calendar-events" class="">
                                                        <?php 
                                                            foreach ($events as $event){
                                                                echo "<div class='calendar-events' data-class='bg-info'>
                                                                <i class='fa fa-circle text-info'></i> $event->description</div> ";
                                                            }
                                                        ?>
                                                    </div>
                                                    <!-- checkbox -->
                                                    <div class="custom-control custom-checkbox m-l-10 m-t-10">
                                                        <input type="checkbox" class="custom-control-input" id="drop-remove">
                                                        <label class="custom-control-label" for="drop-remove">Remove after drop</label>
                                                    </div>
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#add-new-event" class="btn m-t-10 btn-info btn-block waves-effect waves-light text-white">
                                                        <i class="ti-plus"></i> Add New Event
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="card-body b-l calender-sidebar">
                                            <div id="calendar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    <!-- BEGIN MODAL -->
    <div class="modal none-border" id="my-event">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Add Event</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                    <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
                <!-- Modal Add Category -->
    <div class="modal fade none-border" id="add-new-event">
        <div class="modal-dialog">
            <form method ="post" role="form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Add</strong> a category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Category Name</label>
                                <input type="text" class="form-control form-white" name="category-name" placeholder="Enter name">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Choose Category Color</label>
                                <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                    <option value="success">Success</option>
                                    <option value="danger">Danger</option>
                                    <option value="info">Info</option>
                                    <option value="primary">Primary</option>
                                    <option value="warning">Warning</option>
                                    <option value="inverse">Inverse</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>