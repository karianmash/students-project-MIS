<?php
include_once 'head.php';
include_once '../api/classes/Project.php';
include_once '../api/classes/ProjectCategory.php';

$pc = new ProjectCategory($conn);

$project = new Project($conn);
$projectArray = $project->viewAllProjects();
$lecArray = $lec->getAllUsers();
?>

<link rel="stylesheet" type="text/css" href="../assets/libs/bootstrap-validator/css/bootstrapValidator.css">
<link rel="stylesheet" type="text/css" href="../assets/libs/slimselect/slimselect.min.css"/>

<body data-sidebar="dark">
<!-- Begin page -->
<div id="layout-wrapper">
    <?php include_once 'header.php'; ?>
    <!-- ========== Left Sidebar Start ========== -->
    <?php include_once 'sidebar.php'; ?>
    <!-- Left Sidebar End -->
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row align-items-center">
                    <div class="col-sm-12 p-t-15">
                        <ul class=" breadcrumb breadcrumb-title float-right bg-transparent">
                            <li class="breadcrumb-item">
                                <a href="index.php"><i class="mdi mdi-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Projects</a> </li>
                            <li class="breadcrumb-item"><a href="#!">View Projects</a> </li>
                        </ul>
                    </div>
                </div>
                <!-- end page title -->
                <!-- start row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Projects</h4>
                                <div class="dropdown-divider"></div>

                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsives nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th># Pid</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>No of Uploads</th>
                                        <th>Reg No</th>
                                        <th>Name</th>
                                        <th>Supervisor</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($projectArray as $proj){
                                        if ($_SESSION['level'] !== 1 && $proj['emp_id'] !== $_SESSION['username']){
                                            continue;
                                        }
                                        ?>
                                        <tr data-description="<?= $proj['description'] ?>">
                                            <td><?= $proj['id'] ?></td>
                                            <td><?= $proj['title'] ?></td>
                                            <td data-category="<?= $proj['category_id'] ?>"><?= $proj['category'] ?></td>
                                            <td><?= $proj['no_of_uploads'] ?>
                                                <a href="#" class="text-underline p-l-3 btn-view-p-uploads" data-toggle="modal" data-target="#viewModal"> view</a>
                                            </td>
                                            <td><?= $proj['reg_no'] ?></td>
                                            <td><?= $proj['full_name'] ?></td>
                                            <td>
                                                <?= empty($proj['supervisor']) ? '<button class="btn btn-sm btn-primary btn-assign" data-toggle="modal" data-target="#assign-modal">Assign</button>': ucwords($proj['supervisor']) ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($proj['status'] == 'in progress'){ ?>
                                                    <button class="btn btn-sm btn-warning"><?= $proj['status'] ?></button>
                                                <?php }elseif ($proj['status'] == 'complete'){ ?>
                                                    <button class="btn btn-sm btn-success"><?= $proj['status'] ?></button>
                                                <?php }else{ ?>
                                                    <button class="btn btn-sm btn-danger"><?= $proj['status'] ?></button>
                                                <?php }
                                                ?>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <button class="btn btn-sm btn-success btn-edit" data-toggle="modal" data-target="#editModal">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger btn-delete" data-toggle="modal" data-target="#deleteModal">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <?php include_once 'footer.php'; ?>
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!--    view modal-->
<div id="viewModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">
                    <span class="project_name"></span> uploads
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" style="overflow-x: auto;">
                <table class="table table-striped table-bordered dt-responsives mb-0 view-table">
                    <thead>
                    <tr>
                        <th scope="col">File Name</th>
                        <th scope="col">Upload Time</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Status</th>
                        <!--                        <th scope="col">Action</th>-->
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end view modal-->

<!--edit modal-->
<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">
                    Edit Project Details
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit-project-form">
                    <div class="form-group form-row">
                        <div class="col-sm-12">
                            <label for="pid">Project Id: </label>
                            <input type="text" class="form-control" id="pid" placeholder="" readonly name="pid">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-sm-12">
                            <label for="project_title">Title: </label>
                            <input type="text" class="form-control" id="project_title" placeholder="e.g. Church management system " name="project_title">
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <div class="col-sm-6">
                            <label for="pstatus">Status:</label>
                            <select id="pstatus" name="status" class="form-control">
                                <option value="0">in progress</option>
                                <option value="1">complete</option>
                                <option value="2">rejected</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="pcat">Project Category:</label>
                            <select id="pcat" name="category" class="form-control">
                                <?php
                                $categories = $pc->viewAllCategories();
                                foreach ($categories as $category) { ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-sm-12">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success waves-effect waves-light btn-save" form="edit-project-form">Edit</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- delete modal -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">
                    Delete Project
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h5 class="text-danger">Are you sure you want to delete <span class="project_name"></span>?
                    <br><br><span class="fs-14">P.S. This action is irreversible.</span>
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger waves-effect waves-light btn-del"><i class="fa fa-trash"></i> Yes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /. deletemodal -->

<!-- assign modal -->
<div id="assign-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">
                    Assign Project
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="assign-lec-form">
                    <select id="lecturers" name="emp_id">
                        <option value="" disabled selected>--Select Supervisor--</option>
                        <?php
                        foreach ($lecArray as $lecturer){ ?>
                            <option value="<?= $lecturer['emp_id'] ?>"><?= $lecturer['emp_id'].' - '.ucwords($lecturer['full_name']) ?></option>
                        <?php }
                        ?>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success waves-effect waves-light" form="assign-lec-form">Assign</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- JAVASCRIPT -->
<?php
include_once 'js.php';
?>

<!-- Required datatable js -->
<script type="text/javascript" src="../assets/libs/DataTables/datatables.min.js"></script>

<!-- Datatable init js -->
<script src="../assets/js/pages/datatables.init.js"></script>

<!-- Sweet Alerts js -->
<script src="../assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- slimselect -->
<script type="text/javascript" src="../assets/libs/slimselect/slimselect.min.js"></script>
<script type="text/javascript" src="../assets/libs/bootstrap-validator/js/bootstrapValidator.min.js"></script>

<script type="text/javascript" src="assets/js/app.js"></script>
</body>
</html>
<script>
    //    delete modal
    let deleteProject = '';
    $('.btn-delete').on('click', function (event) {
        let tr = $(this).closest('tr'),
            project_name = tr.find('td:nth-child(2)').text();
        deleteProject = tr.find('td:nth-child(1)').text();
        $('span.project_name').text(project_name);
    });

    $('.btn-del').on('click', function (event) {
        $.ajax({
            url: '../api/project.php',
            data: JSON.stringify({project: deleteProject}),
            method: 'DELETE',
            dataType: 'json',
            processData: false,
            contentType: 'application/json',
            success: function (data) {
                //havent removed conn->rollback()
                toastr.success(`${data.success.message} doesn't delete though`, "Bravoo!", {
                    showMethod: "slideDown",
                    hideMethod: "fadeOut",
                    onHidden: function () {
                        location.reload();
                    }
                });
            },
            error: function (data) {
                let message = 'Some unexpected error occurred';
                try{
                    message = data['responseJSON']['error']['message'];
                }catch (e) {
                    console.error(message)
                }
                toastr.error(message, "Ooops!", {
                    showMethod: "slideDown",
                    hideMethod: "fadeOut"
                });

            }

        });
    })

    //    edit modal
    $('.btn-edit').on('click', function (event) {
        let tr = $(this).closest('tr'),
            title = tr.find('td:nth-child(2)').text(),
            pid = tr.find('td:nth-child(1)').text(),
            category = tr.find('td:nth-child(3)').data('category'),
            status = tr.find('td:nth-child(8)').text().toLowerCase().trim(),
            description = tr.data('description').trim();

        console.log(category)

        if (status == 'in progress'){
            status = 0;
        }else if (status == 'complete'){
            status = 1;
        }
        else if (status == 'rejected'){
            status = 2;
        }

        $('input#pid').val(pid)
        $('input#project_title').val(title)
        $('textarea#description').val(description)
        $(`select#pcat option[value='${category}']`).prop('selected', true);
        $(`select#pstatus option[value='${status}']`).prop('selected', true);
    });

    $('#edit-project-form').on('submit', function (event) {
        event.preventDefault();
    });
    $('#edit-project-form').bootstrapValidator({
        message: 'This value is not valid',
        excluded:':disabled',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        fields:{
            'project_title' : {
                message: 'The title is not valid',
                validators: {
                    notEmpty: {
                        message: 'The title of the project is required and cannot be empty. '
                    },
                    stringLength: {
                        min: 5,
                        max: 40,
                        message: 'The title must be more than 5 and less than 40 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9'\s]+$/,
                        message: 'The title can only consist of alphabetical, numbers, underscores and hyphen'
                    }
                }
            },
            'description' : {
                message: 'The description is not valid',
                validators: {
                    notEmpty: {
                        message: 'The description is required and cannot be empty'
                    }
                }
            },
            'student':{
                message: 'The description is not valid',
                validators: {
                    notEmpty: {
                        message: 'Please select a student'
                    }
                }
            },
            'category':{
                message: 'The description is not valid',
                validators: {
                    notEmpty: {
                        message: 'Please select a project category'
                    }
                }
            }
        },
        onSuccess: function (e) {
            $form = $(e.target);
            let formData = {}
            $form.serializeArray().map((v)=> formData[v.name] = v.value)

            $.ajax({
                url: '../api/project.php',
                data: JSON.stringify({...formData}),
                method: 'PATCH',
                dataType: 'json',
                processData: false,
                contentType: 'application/merge-patch+json',
                success: function (data) {
                    toastr.success(data.success.message, "Bravoo!", {
                        showMethod: "slideDown",
                        hideMethod: "fadeOut",
                        onHidden: function () {
                            location.reload();
                        }
                    });
                },
                error: function (data) {
                    console.log(data)
                    let message = 'Some unexpected error occurred';
                    try{
                        message = data['responseJSON']['error']['message'];
                    }catch (e) {
                        console.error(message)
                    }
                    toastr.error(message, "Ooops!", {
                        showMethod: "slideDown",
                        hideMethod: "fadeOut"
                    });

                }

            });


            $form
                .bootstrapValidator('disableSubmitButtons', false)
                .bootstrapValidator('resetForm', true);
        }
    })
        .on('status.field.bv', function(e, data) {
            data.bv.disableSubmitButtons(false);
        });


    //    assign modal
    let select = new SlimSelect({
        select: '#lecturers',
        allowDeselect: true,
        hideSelectedOption: true
    });
    let pid = '';
    $('.btn-assign').on('click', function(event) {
        // clear select
        select.set([]);
        //
        let tr = $(this).closest('tr');
        pid = $.trim(tr.find('td:nth-child(1)').text())
    });

    $('form#assign-lec-form').on('submit', function (event) {
        event.preventDefault();
        if (!select.selected()) {
            toastr.error("Please select at least one Supervisor", "Sorry", {
                showMethod: "slideDown",
                hideMethod: "fadeOut"
            });
        }else{
            let formData = {}
            $(event.target).serializeArray().map(item => formData[item.name] = item.value)
            formData['projects'] = [pid]

            $.ajax({
                url: '../api/project.php',
                data: JSON.stringify({assign : formData}),
                method: 'PATCH',
                dataType: 'json',
                processData: false,
                contentType: 'application/merge-patch+json',
                success: function (data) {
                    toastr.success(data.success.message, "Bravoo!", {
                        showMethod: "slideDown",
                        hideMethod: "fadeOut",
                        onHidden: function () {
                            location.reload();
                        }
                    });
                    // clear select
                    select.set([])
                    //close modal
                    $('#myModal').modal('hide');
                },
                error: function (data) {
                    let message = 'Some unexpected error occurred';
                    try{
                        message = data['responseJSON']['error']['message'];
                    }catch (e) {
                        console.error(message)
                    }
                    toastr.error(message, "Ooops!", {
                        showMethod: "slideDown",
                        hideMethod: "fadeOut"
                    });

                    // clear select
                    select.set([])
                    //close modal
                    $('#myModal').modal('hide');
                }

            });
        }
    })
</script>