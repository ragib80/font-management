<?php
$content = isset($content) ? $content : '';
$title = isset($title) ? $title : '';
$external_js = isset($external_js) ? $external_js : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> <?php echo $title; ?> </title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ColorlibHQ">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?= BASE_URL; ?>/dist/css/adminlte.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <style>
        .dropzone {
            border: 2px dashed #ccc;
            /* Light gray border */
            border-radius: 10px;
            background: #f4f8fb;
            /* Light blue-gray background */
            height: 250px;
            /* Increase the height to match the example */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dropzone .dz-message {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }

        .dropzone .dz-message .icon {
            font-size: 3rem;
            color: #6c757d;
            /* Gray color for the icon */
        }

        .dropzone .dz-message .icon::before {
            content: "\f093";
            /* Font Awesome icon for upload */
            font-family: "FontAwesome";
        }

        .dropzone .dz-message div {
            margin-top: 10px;
        }

        .dropzone .dz-message .text-muted {
            font-size: 0.9rem;
        }

        #success-message {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <?php include('includes/header.php'); ?>
        <?php include('includes/sidebar.php'); ?>
        <script>
            var baseUrl = "<?php echo BASE_URL; ?>";
        </script>
        <main class="app-main">
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->
            <div class="app-content">
                <div class="container-fluid">
                    <div id="dashboard-section" class="content-section" style="display: none;">
                        <h1>dashboard-section</h1>

                        <!-- Content for Font Upload Form -->
                    </div>
                    <div id="font-upload-section" class="content-section mx-5" style="display: none;">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <!-- Dropzone Upload Form -->
                                <form action="<?= BASE_URL; ?>/fonts/upload" class="dropzone" id="file-dropzone" method="POST" enctype="multipart/form-data">
                                    <div class="dz-message" data-dz-message>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383" />
                                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708z" />
                                        </svg>
                                        <div>Click to upload or drag and drop</div>
                                        <div class="text-muted">Only TTF File Allowed</div>
                                    </div>
                                </form>

                                <!-- Success Message -->
                                <div class="alert alert-success" id="success-message">
                                    File uploaded successfully!
                                </div>
                            </div>
                        </div>
                        <!-- Content for Font Upload Form -->
                    </div>

                    <div id="font-list-section" class="content-section" style="display: none;">

                        <div class="row justify-content-center m-5">
                            <div class="card mb-4 py-4 px-4">
                                <div class="card-header ">
                                    <p class="card-title "> <b class="fs-3">Our Fonts</b>
                                        <br> Browse a list of Zipto font to build your font group
                                    </p>



                                </div> <!-- /.card-header -->

                                <div class="card-body p-0" id="table_card">

                                </div> <!-- /.card-body -->
                            </div>
                        </div>
                    </div>

                    <div id="font-group-create-section" class="content-section" style="display: none;">
                        <!-- <h1>font-group-create-section</h1> -->
                        <div class="container mt-5">
                            <h3>Create Font Group</h3>
                            <p>You have to select at least two fonts</p>



                            <form id="fontGroupForm" class="mb-3">
                                <div class="mb-3">
                                    <label for="groupTitle" class="form-label">Group Title</label>
                                    <input type="text" class="form-control" id="groupTitle" placeholder="Group Title">
                                </div>

                                <div class="row mx-1 pt-4 pb-3 px-3 mb-1 font-row border border-1 rounded">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control font-name" placeholder="Font Name">
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-select font-select" name="font">
                                            <option selected disable>Select a Font</option>
                                            <!-- <option value="1">Font 1</option>
                                            <option value="2">Font 2</option>
                                            <option value="3">Font 3</option> -->
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control specific-size" value="1.00" min="0" step="0.01" placeholder="Specific Size">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-2">
                                            <input type="number" class="form-control price-change" value="0" min="0" step="0.01" placeholder="Price Change">
                                            <button type="button" class="btn btn-outline-danger remove-row ms-2">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <button type="button" id="addRow" class="btn btn-outline-success">+ Add Row</button>

                            <button type="submit" class="btn btn-success" id="create-font-group">Create</button>
                        </div>
                    </div>

                    <div id="font-group-list-section" class="content-section" style="display: none;">
                        <div class="row justify-content-center m-5">
                            <div class="card mb-4 py-4 px-4">
                                <div class="card-header ">
                                    <p class="card-title "> <b class="fs-3">Our Font Groups</b>
                                        <br> List of all available font groups
                                    </p>

                                </div> <!-- /.card-header -->

                                <div class="card-body p-0" id="font-group-table-card">

                                </div> <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="font-group-edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Font Group</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editFontGroupForm" class="mb-3">
                                        <div class="mb-3">
                                            <label for="groupTitle" class="form-label">Group Title</label>
                                            <input type="text" class="form-control" id="editGroupTitle" placeholder="Group Title">
                                        </div>
                                        <div id="font-group-ajax-div">

                                        </div>


                                    </form>

                                    <button type="button" id="modal_addRow" class="btn btn-outline-success">+ Add Row</button>

                                    <button type="submit" class="btn btn-success" id="update-font-group">Update</button>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="app-footer"> <!--begin::To the end-->
            <!-- <div class="float-end d-none d-sm-inline">Anything you want</div> -->
            <strong>
                Copyright &copy;2024&nbsp;
                <a href="https://ragib-shahriar.my.id/" class="text-decoration-none">Ragib Shahriar</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer>
    </div>
    <!-- Include JavaScript files -->
    <?php if (!empty($external_js)) : ?>
        <script src="<?= BASE_URL . '/' . $external_js; ?>"></script>
    <?php endif; ?>


    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="<?= BASE_URL; ?>/dist/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script src="<?= BASE_URL; ?>/js/app.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        Dropzone.autoDiscover = false; // Ensure Dropzone doesn't auto-discover

        var myDropzone = new Dropzone("#file-dropzone", {
            url: "<?= BASE_URL; ?>/fonts/upload", // PHP endpoint to handle file uploads
            paramName: "font", // This will change the field name to 'font'
            acceptedFiles: ".ttf",
            maxFilesize: 5, // 5 MB limit
            maxFiles: 1,
            //forceFallback: true, // Force using regular form submit
            init: function() {
                var dz = this;

                dz.on("maxfilesexceeded", function(file) {
                    dz.removeAllFiles();
                    dz.addFile(file);
                });

                dz.on("sending", function(file, xhr, formData) {
                    console.log('Sending file:', file);
                    // Here you can add more form data if needed
                });

                dz.on("success", function(file, response) {
                    $("#success-message").fadeIn().delay(3000).fadeOut();

                });

                dz.on("error", function(file, response) {
                    console.error("Error: ", response);
                });
            }
        });
    </script>

    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script> <!--end::OverlayScrollbars Configure--> <!--end::Script-->

</body>

</html>