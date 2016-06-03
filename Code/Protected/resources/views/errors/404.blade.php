<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0">
        <link rel="shortcut icon" href="./images/favicon.ico?" type="image/x-icon"> 
        <title>Страницата не беше намерена | Подобри</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> 
        <style>
            body { background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAxMC8yOS8xMiKqq3kAAAAcdEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzVxteM2AAABHklEQVRIib2Vyw6EIAxFW5idr///Qx9sfG3pLEyJ3tAwi5EmBqRo7vHawiEEERHS6x7MTMxMVv6+z3tPMUYSkfTM/R0fEaG2bbMv+Gc4nZzn+dN4HAcREa3r+hi3bcuu68jLskhVIlW073tWaYlQ9+F9IpqmSfq+fwskhdO/AwmUTJXrOuaRQNeRkOd5lq7rXmS5InmERKoER/QMvUAPlZDHcZRhGN4CSeGY+aHMqgcks5RrHv/eeh455x5KrMq2yHQdibDO6ncG/KZWL7M8xDyS1/MIO0NJqdULLS81X6/X6aR0nqBSJcPeZnlZrzN477NKURn2Nus8sjzmEII0TfMiyxUuxphVWjpJkbx0btUnshRihVv70Bv8ItXq6Asoi/ZiCbU6YgAAAABJRU5ErkJggg==);}
            .error-template {padding: 40px 15px;text-align: center;}
            .error-actions {margin-top:15px;margin-bottom:15px;}
            .error-actions .btn { margin-right:10px; }
            h1{
                font-size:80px;
            }
            h2{
                font-size:38px;
            }
            .error-details{
                font-size:20px;
                padding:10px 0px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="error-template">
                        <h1>404</h1>
                        <h2>Оопс! Нищо не беше намерено.</h2>
                        <div class="error-details">
                            Съжаляваме, изникна проблем. Желаната страница не беше намерена!
                        </div>
                        <div class="error-actions">
                            <a href="{{ route('problems.index') }}" title='Начало' class="btn btn-primary btn-lg">
                                <span class="glyphicon glyphicon-home"></span>
                                Начало 
                            </a>
                            <a href="{{ route ('info.maintenance') }}" title='Поддръжка' class="btn btn-default btn-lg">
                                <span class="glyphicon glyphicon-envelope"></span> 
                                Поддръжка 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
