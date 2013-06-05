<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/*
Paginas que existiran y lo que haran
profile_config = Pagina que editas los datos de tu perfil
user/SERGI = pagina de perfil de sergi
user/SERGI/friends = pagina que muestra los amigos de sergi
user/SERGI/photos = pagina que LISTA las fotos del usuario
photo/64372 = pagina que MUESTRA la foto y posibilidad de comentarla
welcome_config = pagina donde editas la configuracion de: donde estoy, tipo de viaje blablabla
profile_config = pagina donde editas la configuracion del usuario
services/hotels = Muestra hoteles/pisos DEL PAIS DONDE ESTOY 
services/mobility(transports) = Muestra transportes DEL PAIS DONDE ESTOY 
services/restaurants = Restaurantes DONDE ESTOY
services/activities = Excursiones/servicios donde estoy
services/leisure = Ocio donde estoy
services/others = Servicios varios donde estoy
DONDE ESTOY = PAIS
*/

$route['default_controller'] = "home";
$route['remember_password'] = "auth/forgot_password";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */