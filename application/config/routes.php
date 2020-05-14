<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'notes_temp';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;


/// ROUTES START FOR notes_temp
$route['notes_temp'] = 'notes/notes_temp/c_notes_temp';
$route['notes_temp/(:any)'] = 'notes/notes_temp/c_notes_temp/$1';
$route['notes_temp/(:any)/(:any)']               = 'notes/notes_temp/c_notes_temp/$1/$2';
$route['notes_temp/(:any)/(:num)/(:any)']        = 'notes/notes_temp/c_notes_temp/$1/$2/$3';
$route['notes_temp/(:any)/(:any)/(:any)/(:any)'] = 'notes/notes_temp/c_notes_temp/$1/$2/$3/$4';


/// ROUTES START FOR notes_penolakan_resusitasi
$route['notes_penolakan_resusitasi'] = 'notes/notes_penolakan_resusitasi/c_notes_penolakan_resusitasi';
$route['notes_penolakan_resusitasi/(:any)'] = 'notes/notes_penolakan_resusitasi/c_notes_penolakan_resusitasi/$1';
$route['notes_penolakan_resusitasi/(:any)/(:any)']               = 'notes/notes_penolakan_resusitasi/c_notes_penolakan_resusitasi/$1/$2';
$route['notes_penolakan_resusitasi/(:any)/(:num)/(:any)']        = 'notes/notes_penolakan_resusitasi/c_notes_penolakan_resusitasi/$1/$2/$3';
$route['notes_penolakan_resusitasi/(:any)/(:any)/(:any)/(:any)'] = 'notes/notes_penolakan_resusitasi/c_notes_penolakan_resusitasi/$1/$2/$3/$4';


/// ROUTES START FOR notes_laporan_sedasi
$route['notes_laporan_sedasi'] = 'notes/notes_laporan_sedasi/c_notes_laporan_sedasi';
$route['notes_laporan_sedasi/(:any)'] = 'notes/notes_laporan_sedasi/c_notes_laporan_sedasi/$1';
$route['notes_laporan_sedasi/(:any)/(:any)']               = 'notes/notes_laporan_sedasi/c_notes_laporan_sedasi/$1/$2';
$route['notes_laporan_sedasi/(:any)/(:num)/(:any)']        = 'notes/notes_laporan_sedasi/c_notes_laporan_sedasi/$1/$2/$3';
$route['notes_laporan_sedasi/(:any)/(:any)/(:any)/(:any)'] = 'notes/notes_laporan_sedasi/c_notes_laporan_sedasi/$1/$2/$3/$4';


/// ROUTES START FOR notes_laporan_pasien_registrasi
$route['laporan_pasien_registrasi'] = 'laporan/laporan_pasien_registrasi/c_laporan_pasien_registrasi';
$route['laporan_pasien_registrasi/(:any)'] = 'laporan/laporan_pasien_registrasi/c_laporan_pasien_registrasi/$1';
$route['laporan_pasien_registrasi/(:any)/(:any)']               = 'laporan/laporan_pasien_registrasi/c_laporan_pasien_registrasi/$1/$2';
$route['laporan_pasien_registrasi/(:any)/(:num)/(:any)']        = 'laporan/laporan_pasien_registrasi/c_laporan_pasien_registrasi/$1/$2/$3';
$route['laporan_pasien_registrasi/(:any)/(:any)/(:any)/(:any)'] = 'laporan/laporan_pasien_registrasi/c_laporan_pasien_registrasi/$1/$2/$3/$4';

/// ROUTES START FOR notes_laporan_statistik
$route['laporan_statistik'] = 'laporan/laporan_statistik/c_laporan_statistik';
$route['laporan_statistik/(:any)'] = 'laporan/laporan_statistik/c_laporan_statistik/$1';
$route['laporan_statistik/(:any)/(:any)']               = 'laporan/laporan_statistik/c_laporan_statistik/$1/$2';
$route['laporan_statistik/(:any)/(:num)/(:any)']        = 'laporan/laporan_statistik/c_laporan_statistik/$1/$2/$3';
$route['laporan_statistik/(:any)/(:any)/(:any)/(:any)'] = 'laporan/laporan_statistik/c_laporan_statistik/$1/$2/$3/$4';

/// ROUTES START FOR laporan_icd9
$route['laporan_icd9'] = 'laporan/laporan_icd9/c_laporan_icd9';
$route['laporan_icd9/(:any)'] = 'laporan/laporan_icd9/c_laporan_icd9/$1';
$route['laporan_icd9/(:any)/(:any)']               = 'laporan/laporan_icd9/c_laporan_icd9/$1/$2';
$route['laporan_icd9/(:any)/(:num)/(:any)']        = 'laporan/laporan_icd9/c_laporan_icd9/$1/$2/$3';
$route['laporan_icd9/(:any)/(:any)/(:any)/(:any)'] = 'laporan/laporan_icd9/c_laporan_icd9/$1/$2/$3/$4';

/// ROUTES START FOR laporan_icd10
$route['laporan_icd10'] = 'laporan/laporan_icd10/c_laporan_icd10';
$route['laporan_icd10/(:any)'] = 'laporan/laporan_icd10/c_laporan_icd10/$1';
$route['laporan_icd10/(:any)/(:any)']               = 'laporan/laporan_icd10/c_laporan_icd10/$1/$2';
$route['laporan_icd10/(:any)/(:num)/(:any)']        = 'laporan/laporan_icd10/c_laporan_icd10/$1/$2/$3';
$route['laporan_icd10/(:any)/(:any)/(:any)/(:any)'] = 'laporan/laporan_icd10/c_laporan_icd10/$1/$2/$3/$4';

/// ROUTES START FOR laporan_pasien_meninggal
$route['laporan_pasien_meninggal'] = 'laporan/laporan_pasien_meninggal/c_laporan_pasien_meninggal';
$route['laporan_pasien_meninggal/(:any)'] = 'laporan/laporan_pasien_meninggal/c_laporan_pasien_meninggal/$1';
$route['laporan_pasien_meninggal/(:any)/(:any)']               = 'laporan/laporan_pasien_meninggal/c_laporan_pasien_meninggal/$1/$2';
$route['laporan_pasien_meninggal/(:any)/(:num)/(:any)']        = 'laporan/laporan_pasien_meninggal/c_laporan_pasien_meninggal/$1/$2/$3';
$route['laporan_pasien_meninggal/(:any)/(:any)/(:any)/(:any)'] = 'laporan/laporan_pasien_meninggal/c_laporan_pasien_meninggal/$1/$2/$3/$4';

/// ROUTES START FOR notes_laporan_pasien_registrasi
$route['laporan_bpjs_sep'] = 'laporan/laporan_bpjs_sep/c_laporan_bpjs_sep';
$route['laporan_bpjs_sep/(:any)'] = 'laporan/laporan_bpjs_sep/c_laporan_bpjs_sep/$1';
$route['laporan_bpjs_sep/(:any)/(:any)']               = 'laporan/laporan_bpjs_sep/c_laporan_bpjs_sep/$1/$2';
$route['laporan_bpjs_sep/(:any)/(:num)/(:any)']        = 'laporan/laporan_bpjs_sep/c_laporan_bpjs_sep/$1/$2/$3';
$route['laporan_bpjs_sep/(:any)/(:any)/(:any)/(:any)'] = 'laporan/laporan_bpjs_sep/c_laporan_bpjs_sep/$1/$2/$3/$4';