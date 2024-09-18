<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> Font Management </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ColorlibHQ">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?= BASE_URL; ?>/dist/css/adminlte.css">

    <script src="<?= BASE_URL; ?>/dist/js/jquery-3.7.1.min.js"></script>
    <script src="<?= BASE_URL; ?>/dist/js/dropzone.min.js"></script>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/dist/css/dropzone.min.css" type="text/css" />

    <style>
        .dropzone {
            border: 2px dashed #ccc;
            border-radius: 10px;
            background: #f4f8fb;
            height: 250px;
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
        }

        .dropzone .dz-message .icon::before {
            content: "\f093";
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

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include('includes/header.php'); ?>
        <?php include('includes/sidebar.php'); ?>
        <script>
            var baseUrl = "<?php echo BASE_URL; ?>";
        </script>
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <div id="dashboard-section" class="content-section" style="display: none;">
                        <?php include(__DIR__ . '/../dashboard/dashboard.php'); ?>
                    </div>
                    <div id="font-upload-section" class="content-section mx-5" style="display: none;">
                        <?php include(__DIR__ . '/../font/upload.php'); ?>
                    </div>

                    <div id="font-list-section" class="content-section" style="display: none;">
                        <?php include(__DIR__ . '/../font/list.php'); ?>
                    </div>

                    <div id="font-group-create-section" class="content-section" style="display: none;">
                        <?php include(__DIR__ . '/../font_group/create.php'); ?>
                    </div>

                    <div id="font-group-list-section" class="content-section" style="display: none;">
                        <?php include(__DIR__ . '/../font_group/list.php'); ?>
                    </div>
                    <!-- Modal -->
                    <?php include(__DIR__ . '/../font_group/edit_modal.php'); ?>
                </div>
            </div>
        </main>
        <footer class="app-footer"> <!--begin::To the end-->
            Copyright &copy;2024&nbsp;
            <a href="https://ragib-shahriar.my.id/" class="text-decoration-none">Ragib Shahriar</a>.
            </strong>
            All rights reserved.
        </footer>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="<?= BASE_URL; ?>/dist/js/adminlte.js"></script>
    <script src="<?= BASE_URL; ?>/js/app.js"></script>


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
    </script>

</body>

</html>