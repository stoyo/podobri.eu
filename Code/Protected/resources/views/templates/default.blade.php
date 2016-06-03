<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <base href="https://podobri.eu/">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0">
        <title>{{ $title }}</title>     
        <!-- Meta tags describing the website -->
        <meta name="title" content="{{ $title }}">
        <meta name="description" content="{{ clean($description, array('HTML.Allowed'=>'')) }}">
        <meta name="Keywords" content="Подобри, По-добри, Решени проблеми, Нерешени проблеми, Чакащи потвърждение проблеми, Проблеми, Общност, Решение">
        <meta name="author" content="Stoyan Genchev">
        <!-- SEO -->
        <meta name="robots" content="all">
        <meta name="robots" content="index, follow">
        <meta name="rating" content="general">
        <meta name="revisit-after" content="1 days">
        <meta name="googlebot" content="index, follow, archive">
        <meta name="robots" content="index,follow">
        <!-- Open graph facebook -->
        <meta property="fb:app_id" content="155088004860439">
        <meta property="og:url" content="{{ Request::url() }}">
        <meta property="og:type" content="article" />
        <meta property="og:site_name" content="podobri.eu">        
        <meta property="og:title" content="{{ $title }}">
        <meta property="og:description" content="{{ clean($description, array('HTML.Allowed'=>'')) }}">
        @if(isset($img))
        <meta property="og:image" content="{{ $img }}">
        @else
        <meta property="og:image" content="https://podobri.eu/images/podobri.png">
        @endif
        <!-- Scripts and styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> 
        <link rel="shortcut icon" href="https://podobri.eu/images/favicon.ico?" type="image/x-icon"> 
        <script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="./styles/style.css"> 
        <!-- Begin Cookie Consent plugin -->
        <script type="text/javascript">
window.cookieconsent_options = {"message": "Този сайт използва бисквитки, за да осигури най-приятното преживяване за потребители.", "dismiss": "Разбрах!", "learnMore": " Прочетете още", "link": "https://www.podobri.eu/cookies", "theme": "dark-bottom"};
        </script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>
        <!-- End Cookie Consent plugin -->
        <script src="//cdn.ckeditor.com/4.5.7/basic/ckeditor.js"></script>
    </head>
    <body>
        @include('info.helpers')
        @include('templates.partials.header')
        @yield('content')
        @include('templates.partials.footer')
        <!-- Scripts and styles -->
        <script type="text/javascript" src="./scripts/map-form.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjFICLXEUIxrEB9V3nTuuIx-vRT1tMPX8&signed_in=true&libraries=places&callback=initMap&signed_in=false" async defer></script>
        <script type="text/javascript" src="./source/jquery.fancybox.js?v=2.1.5"></script>	
        <script type="text/javascript" src="./scripts/gallery.js"></script>    
        <link rel="stylesheet" type="text/css" href="./source/jquery.fancybox.css?v=2.1.5" media="screen" /> 
        <script type="text/javascript" src="./scripts/jquery.are-you-sure.js"></script>
        <script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
        <script type="text/javascript" src="./scripts/autosize.min.js"></script>
        <script type="text/javascript" src="./scripts/readmore.js"></script>
        <script type="text/javascript" src="./scripts/highlight.js"></script>
        <script type="text/javascript" src="./scripts/my_scripts.js"></script>
    </body>
</html>