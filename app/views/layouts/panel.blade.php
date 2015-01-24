<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{$title}}</title>

    <!-- SweetAlert -->
    {{ HTML::script(URL::to('/packages/resources/sweetalert/sweet-alert.js')) }}
    {{ HTML::style(URL::to('/packages/resources/sweetalert/sweet-alert.css')) }}

    <!-- Bootstrap Core CSS -->
    {{ HTML::style(URL::to('/packages/panel/css/bootstrap.min.css')) }}

    <!-- MetisMenu CSS -->
    {{ HTML::style(URL::to('/packages/panel/css/metisMenu.min.css')) }}

    <!-- Timeline CSS -->
    {{ HTML::style(URL::to('/packages/panel/css/timeline.css')) }}

    <!-- Custom CSS -->
    {{ HTML::style(URL::to('/packages/panel/css/sb-admin-2.css')) }}

    <!-- Custom Fonts -->
    {{ HTML::style(URL::to('/packages/resources/font-awesome-4.2.0/css/font-awesome.min.css')) }}
	
	@yield('head')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{URL::to('/')}}">{{settings::get("shortSiteName")}}</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
				@if(Auth::user()->admin==1)
					<li>
						<a type="button" href="{{URL::to('/admin')}}">Definições <i class="fa fa-cog fa-fw fa-spin"></i></a>
					</li>
				@endif
                <li>
                    <a type="button" href="{{URL::to('/logout')}}">Terminar Sessão <i class="fa fa-sign-out fa-fw"></i></a>
                </li>
            </ul>
            <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <!-- /.row -->
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-pencil-square-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Marcar Exames</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{URL::to('/panel/news')}}">
                            <div class="panel-footer">
                                <span class="pull-left">Ver</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-calendar fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Ver Calendario</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{URL::to('/calendar')}}">
                            <div class="panel-footer">
                                <span class="pull-left">Ver</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bar-chart-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Estatísticas</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{URL::to('/panel/services')}}">
                            <div class="panel-footer">
                                <span class="pull-left">Ver</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.navbar-static-side -->

        </nav>

        <div id="page-wrapper">

                <!-- Infos -->
                <noscript>Para Poder Navegar Livremente Pelo Site, Têm De Ativar O JavaScript<br><br></noscript>
                @if(Session::has('success'))
                    <script>
						window.onload = function showError() {
							return sweetAlert("{{ Session::get('success') }}", "", "success");
						}
                    </script>
                @endif
                @if($errors->any())
                    <script>
						window.onload = function showError() {
							return sweetAlert("Oops...", "{{implode('', $errors->all(':message '))}}", "error");
						}
                    </script>
                @endif
                <!-- /Infos -->

            <br>
            @yield('body')

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    {{ HTML::script(URL::to('/packages/resources/js/jquery.js')) }}

    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script(URL::to('/packages/panel/js/bootstrap.min.js')) }}

    <!-- Metis Menu Plugin JavaScript -->
    {{ HTML::script(URL::to('/packages/panel/js/metisMenu/metisMenu.min.js')) }}

    <!-- Custom Theme JavaScript -->
    {{ HTML::script(URL::to('/packages/panel/js/sb-admin-2.js')) }}

</body>

</html>
