<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo e(asset('assets/images/logo.png')); ?>">
        <link href="<?php echo e(asset('assets/libs/chartist/chartist.min.css')); ?>" rel="stylesheet">
        <!-- Bootstrap Css -->
        <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/css/custom.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo e(asset('assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo e(asset('assets/css/app.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />
         <!-- Plugins css -->
         <!-- <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" /> -->
         <link rel="stylesheet" href="<?php echo e(asset('assets/css/dropify.min.css')); ?>">
         <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" rel="stylesheet" type="text/css" />
         <!-- floating whatsapp -->
        <link rel="stylesheet" href="/floatingwpp/floating-wpp.min.css">
        <!-- Scripts -->
        <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
        <script src=" https://live.autocredit.cc/js/autocredit3.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
        <script src="https://js.paystack.co/v1/inline.js"></script>
        <script src="<?php echo e(mix('js/app.js')); ?>" defer></script>

    </head>
    <body class="font-sans antialiased">
        <div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div>

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="<?php echo e(asset('assets/libs/jquery/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/libs/metismenu/metisMenu.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/libs/simplebar/simplebar.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/libs/node-waves/waves.min.js')); ?>"></script>

        <!-- Peity chart-->
        <script src="<?php echo e(asset('assets/libs/peity/jquery.peity.min.js')); ?>"></script>

        <!-- Plugin Js-->
        <script src="<?php echo e(asset('assets/libs/chartist/chartist.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/pages/dashboard.init.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js')); ?>"></script>

        <!-- Plugins js -->
        <script src="<?php echo e(asset('assets/libs/dropzone/min/dropzone.min.js')); ?>"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script> -->
        <script src="<?php echo e(asset('assets/js/dropify.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/app.js')); ?>"></script>
        <script>
            $(document).ready(function(){
                // Basic
                $('.dropify').dropify();

                // Translated
                $('.dropify-fr').dropify({
                    messages: {
                        default: 'Glissez-déposez un fichier ici ou cliquez',
                        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                        remove:  'Supprimer',
                        error:   'Désolé, le fichier trop volumineux'
                    }
                });

                // Used events
                var drEvent = $('#input-file-events').dropify();

                drEvent.on('dropify.beforeClear', function(event, element){
                    return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
                });

                drEvent.on('dropify.afterClear', function(event, element){
                    alert('File deleted');
                });

                drEvent.on('dropify.errors', function(event, element){
                    console.log('Has Errors');
                });

                var drDestroy = $('#input-file-to-destroy').dropify();
                drDestroy = drDestroy.data('dropify')
                $('#toggleDropify').on('click', function(e){
                    e.preventDefault();
                    if (drDestroy.isDropified()) {
                        drDestroy.destroy();
                    } else {
                        drDestroy.init();
                    }
                })
            });

            </script>
            <!-- //whatsapp -->
            <!-- <script src="<?php echo e(asset('assets/js/vendors.min.js')); ?>"></script> -->
            <script src="<?php echo e(asset('/floatingwpp/floating-wpp.js')); ?>"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    </body>
</html>


<?php /**PATH /Users/macbookair/Desktop/Sites/adept_new/resources/views/app.blade.php ENDPATH**/ ?>