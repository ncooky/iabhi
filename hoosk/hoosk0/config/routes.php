<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['attachments'] = "admin/admin/upload";
$route['admin'] = "admin/admin";
$route['admin/login'] = "admin/admin/login";
$route['admin/login/check'] = "admin/admin/loginCheck";
$route['admin/logout'] = "admin/admin/logout";
$route['admin/users/activate/(:any)'] = "admin/admin/activate";
$route['admin/partners'] = "admin/partners";
$route['admin/partners/submit'] = "admin/partners/uploadLogo";
$route['admin/partners/new'] = "admin/partners/addPartner";
$route['admin/partners/new/add'] = "admin/partners/confirm";
$route['admin/partners/edit/(:any)'] = "admin/partners/editPartner";
$route['admin/partners/edited/(:any)'] = "admin/partners/edited";
$route['admin/partners/delete/(:any)'] = "admin/partners/delete";
$route['admin/users'] = "admin/users";
$route['admin/users/new'] = "admin/users/addUser";
$route['admin/users/new/add'] = "admin/users/confirm";
$route['admin/users/delete/(:any)'] = "admin/users/delete";
$route['admin/users/edit/(:any)'] = "admin/users/editUser";
$route['admin/users/edited/(:any)'] = "admin/users/edited";
$route['admin/user/forgot'] = 'admin/users/forgot'; //
$route['admin/users/(:any)'] = "admin/users";
$route['admin/pages'] = "admin/pages";
$route['admin/pages/new'] = "admin/pages/addPage";
$route['admin/pages/new/add'] = "admin/pages/confirm";
$route['admin/pages/delete/(:any)'] = "admin/pages/delete";
$route['admin/pages/edit/(:any)'] = "admin/pages/editPage";
$route['admin/pages/edited/(:any)'] = "admin/pages/edited";
$route['admin/pages/jumbo/(:any)'] = "admin/pages/jumbo";
$route['admin/pages/jumbotron/(:any)'] = "admin/pages/jumboAdd";
$route['admin/pages/(:any)'] = "admin/pages";
$route['admin/navigation'] = "admin/navigation";
$route['admin/navigation/new'] = "admin/navigation/newNav";
$route['admin/navigation/edit/(:any)'] = "admin/navigation/editNav";
$route['admin/navigation/delete/(:any)'] = "admin/navigation/deleteNav";
$route['admin/navadd/(:any)'] = "admin/navigation/navAdd";
$route['admin/navigation/insert'] = "admin/navigation/insert";
$route['admin/navigation/update/(:any)'] = "admin/navigation/update";
$route['admin/navigation/(:any)'] = "admin/navigation";
$route['admin/settings'] = "admin/admin/settings";
$route['admin/settings/submit'] = "admin/admin/uploadLogo";
$route['admin/settings/update'] = "admin/admin/updateSettings";
$route['admin/social'] = "admin/admin/social";
$route['admin/social/update'] = "admin/admin/updateSocial";
$route['admin/posts'] = "admin/posts";
$route['admin/posts/new'] = "admin/posts/addPost";
$route['admin/posts/new/add'] = "admin/posts/confirm";
$route['admin/posts/delete/(:any)'] = "admin/posts/delete";
$route['admin/posts/edit/(:any)'] = "admin/posts/editPost";
$route['admin/posts/edited/(:any)'] = "admin/posts/edited";
$route['admin/posts/categories'] = "admin/categories";
$route['admin/posts/categories/new'] = "admin/categories/addCategory";
$route['admin/posts/categories/new/add'] = "admin/categories/confirm";
$route['admin/posts/categories/delete/(:any)'] = "admin/categories/delete";
$route['admin/posts/categories/edit/(:any)'] = "admin/categories/editCategory";
$route['admin/posts/categories/edited/(:any)'] = "admin/categories/edited";
$route['admin/posts/categories/(:any)'] = "admin/categories";
$route['admin/posts/(:any)'] = "admin/posts";

$route['resetpassword/(:any)'] = 'admin/users/getPassword'; //

$route['login'] = "hoosk_default/login"; 
$route['logout'] = "hoosk_default/logout"; 
$route['login/check'] = "hoosk_default/loginCheck";
$route['daftar'] = "hoosk_default/daftar";
$route['category/(:any)'] = "hoosk_default/category";
$route['article/(:any)'] = "hoosk_default/article";

$route['home'] = "hoosk_default";
$route['(.+)'] = "hoosk_default";
$route['default_controller'] = "hoosk_default";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
