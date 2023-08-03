<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <base href="{{ \URL::to('/') }}">

    <title>Sash – Bootstrap 5 Admin & Dashboard Template</title>
    <link rel="icon" href="assets1/images/favicon.ico" type="image/x-icon">
    <link href="assets1/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="assets1/plugins/iconfonts/icons.css" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="assets1/css/main.css" rel="stylesheet">
    <!---Internal  Prism css-->
    <link href="assets1/plugins/prism/prism.css" rel="stylesheet">
    <link href="assets1/plugins/treeview-prism/prism.css" rel="stylesheet">
    <link href="assets1/plugins/treeview-prism/prism-treeview.css" rel="stylesheet">
    <link href="assets1/css/themes/all-themes.css" rel="stylesheet" />
</head>
<style>
    .btn-custom {
        background-color: #6777ef;
        /* Remplacez par votre couleur personnalisée */
        color: #ffffff;
        /* Couleur du texte */
        /* Ajoutez d'autres styles personnalisés si nécessaire */
    }
</style>

<body class="theme-blush">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-blush">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Sidebarover lay -->
    <div class="sidebar-overlay" data-toggle="sidebar"></div>

    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="admin-image"> <img src="assets1/images/logo.png" alt=""> </div>
            <!-- Menu -->
            <div class="menu main-sidebar">
                <ul class="list" id="documenter_nav">
                    <li class="nav-item"><a class="nav-link" href="index.html"><i
                                class="fe fe-airplay sidemenu-icon"></i><span
                                class="sidemenu-label">Introduction</span></a></li>

                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content home">

        <div class="col-sm-12">
            <h1>
                hhhhh
            </h1>
            <!-- Footer opened -->
            <div class="main-footer ht-40">
                <div class="pd-t-0-f ht-100p">
                    <span>Copyright © <span id="year"></span> <a href="#">Sash</a>. Designed with <span
                            class="fa fa-heart text-danger"></span> by <a href="#"> Spruko </a> All rights
                        reserved.</span>
                </div>
            </div>
            <!-- Footer closed -->
    </section>

    <div class="color-bg">
        <div class="sidebar__toggle" data-toggle="sidebar">
            <a class="open-toggle" href="javascript:void(0);"><i class="fe fe-menu"></i></a>
        </div>
        <ul class="nav navbar-nav">
            <li class="nav-item mr-8"><a class="btn btn-secondary btn-header " href="https://1.envato.market/MGEaN"
                    target="_blank"><i class="icon-bag3"></i> Portfolio</a></li>
            <li class="nav-item mr-8"><a class="btn btn-success text-white" href=" https://spruko.com/support"
                    target="_blank"><i class="icon-help2"></i>Support</a></li>
            <li class="nav-item"><a class="btn btn-danger text-white mr-3 btn-header" href="https://spruko.com/licenses"
                    target="_blank"><i class="icon-bag3"></i> Licenses</a></li>
        </ul>
    </div>

    @yield('scripts')

    @stack('scripts')
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- Jquery Core Js -->
    <script src="assets1/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
    <script src="assets1/bundles/morphingsearchscripts.bundle.js"></script> <!-- morphing search Js -->
    <script src="assets1/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
    <script src="assets1/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->

    <!-- Internal Prism js-->
    <script src="assets1/plugins/prism/prism.js"></script>


    <!-- Treeview js-->
    <script src="assets1/plugins/treeview-prism/prism.js"></script>
    <script src="assets1/plugins/treeview-prism/prism-treeview.js"></script>

    <!-- Perfectscroll js-->
    <script src="assets1/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets1/plugins/perfect-scrollbar/p-scroll.js"></script>

    <!-- Custom js-->
    <script src="assets1/js/custom.js"></script>
    <script src="assets1/js/menuspy.min.js.js"></script>

    <script>
        var elm = document.querySelector('#main-menu');
        var ms = new MenuSpy(elm);

        (function() {

            if (typeof self === 'undefined' || !self.Prism || !self.document) {
                return;
            }

            /**
             * Class name for <pre> which is activating the plugin
             * @type {String}
             */
            var PLUGIN_CLASS = 'line-numbers';

            /**
             * Resizes line numbers spans according to height of line of code
             * @param  {Element} element <pre> element
             */
            var _resizeElement = function(element) {
                var codeStyles = getStyles(element);
                var whiteSpace = codeStyles['white-space'];

                if (whiteSpace === 'pre-wrap' || whiteSpace === 'pre-line') {
                    var codeElement = element.querySelector('code');
                    var lineNumbersWrapper = element.querySelector('.line-numbers-rows');
                    var lineNumberSizer = element.querySelector('.line-numbers-sizer');
                    var codeLines = element.textContent.split('\n');

                    if (!lineNumberSizer) {
                        lineNumberSizer = document.createElement('span');
                        lineNumberSizer.className = 'line-numbers-sizer';

                        codeElement.appendChild(lineNumberSizer);
                    }

                    lineNumberSizer.style.display = 'block';

                    codeLines.forEach(function(line, lineNumber) {
                        lineNumberSizer.textContent = line || '\n';
                        var lineSize = lineNumberSizer.getBoundingClientRect().height;
                        lineNumbersWrapper.children[lineNumber].style.height = lineSize + 'px';
                    });

                    lineNumberSizer.textContent = '';
                    lineNumberSizer.style.display = 'none';
                }
            };

            /**
             * Returns style declarations for the element
             * @param {Element} element
             */
            var getStyles = function(element) {
                if (!element) {
                    return null;
                }

                return window.getComputedStyle ? getComputedStyle(element) : (element.currentStyle || null);
            };

            window.addEventListener('resize', function() {
                Array.prototype.forEach.call(document.querySelectorAll('pre.' + PLUGIN_CLASS), _resizeElement);
            });

            Prism.hooks.add('complete', function(env) {
                if (!env.code) {
                    return;
                }

                // works only for <code> wrapped inside <pre> (not inline)
                var pre = env.element.parentNode;
                // Original regex check for class, leaving it here
                // for its redundancy check
                var clsReg = /\s*\bline-numbers\b\s*/;
                // New regex check for opt-out class
                var clsRegB = /\s*\bno-line-numbers\b\s*/;

                if (env.element.querySelector(".line-numbers-rows")) {
                    // Abort if line numbers already exists
                    return;
                }

                // Added to facilitate opting out
                if (clsRegB.test(pre.className)) {
                    // Respect the opt-out
                    return;
                }

                if (clsReg.test(env.element.className)) {
                    // Remove the class "line-numbers" from the <code>
                    env.element.className = env.element.className.replace(clsReg, ' ');
                }
                if (!clsReg.test(pre.className)) {
                    // Add the class "line-numbers" to the <pre>
                    pre.className += ' line-numbers';
                }

                var match = env.code.match(/\n(?!$)/g);
                var linesNum = match ? match.length + 1 : 1;
                var lineNumbersWrapper;

                var lines = new Array(linesNum + 1);
                lines = lines.join('<span></span>');

                lineNumbersWrapper = document.createElement('span');
                lineNumbersWrapper.setAttribute('aria-hidden', 'true');
                lineNumbersWrapper.className = 'line-numbers-rows';
                lineNumbersWrapper.innerHTML = lines;

                if (pre.hasAttribute('data-start')) {
                    pre.style.counterReset = 'linenumber ' + (parseInt(pre.getAttribute('data-start'), 10) - 1);
                }

                env.element.appendChild(lineNumbersWrapper);

                _resizeElement(pre);
            });

        }());
    </script>
</body>

</html>
