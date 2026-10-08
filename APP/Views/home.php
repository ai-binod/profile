<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{ csrf_meta() }}
    <link rel="icon" href="{{ pathto('images/favicon.ico') }}" type="image/x-icon">
    <title>Welcome to {{ FRAMEWORK }}</title>
    <link href="{{ pathto('css/bootstrap5.3.8.min.css') }}" rel="stylesheet">
    <link href="{{ pathto('css/style.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
        }
        a, a:hover, a:link {
            text-decoration: none;
            color: #155afa;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="mt-5 row">
            <div class="mt-4 mb-5 pb-3 text-center">
                {{ image(pathto('images/framework.png'), 'ICT Framework', '75%') }}
                <h1 class="mt-3">Welcome to {{ FRAMEWORK }}</h1>
                <h4><em>The small framework with powerful features</em></h4>
            </div>
            <div class="col-sm-3 offset-1 pe-2 d-flex align-items-center">
                {{ image(pathto('images/logo.png'), 'logo', '100%', 'auto') }}
            </div>
            <div class="col-sm-7 mb-4">
                The <strong>ICTM Framework</strong> proves that <em>small footprints can still deliver powerful features.</em>
                Built with PHP, MySQL, jQuery, JavaScript, and Bootstrap, it strikes the perfect balance between
                simplicity and functionality. Whether you’re a beginner looking for an easy-to-learn framework or a
                professional developer who values flexibility and code control, ICTM provides a solid foundation for
                modern web development.

                For anyone seeking a lightweight, developer-friendly, and efficient PHP MVC framework, ICTM is an
                excellent choice.
                
                <p class="mt-3"><strong>{{ FRAMEWORK }}</strong> is a lightweight yet robust <strong>PHP MVC framework</strong> optimized for <strong>PHP 8.3</strong> and above, ensuring compatibility with the latest language features and performance improvements. By leveraging the advancements in PHP 8.3, such as enhanced Just-In-Time (JIT) compilation, improved type safety, and optimized memory handling, {{ FRAMEWORK }} delivers a more efficient runtime environment. The framework’s minimal footprint reduces overhead, allowing developers to build scalable applications with faster execution speeds while maintaining clean separation of concerns through its MVC architecture.</p>
                <p>Compared to its earlier versions, {{ FRAMEWORK }} significantly improves <strong>execution speed, database query handling, and resource utilization.</strong> With native support for modern PHP features, developers gain increased flexibility, stronger error handling, and simplified debugging during the development phase. This release emphasizes performance-driven design while preserving the framework’s core principle of simplicity—providing a balance between lightweight coding structures and powerful development capabilities suitable for small to mid-scale applications.</p>
                
            
            </div>
        </div>
    </div>

    <script src="{{ pathto('js/jquery3.7.1.min.js') }}"></script>
    <script src="{{ pathto('js/bootstrap5.3.8.bundle.min.js') }}"></script>
</body>
</html>
