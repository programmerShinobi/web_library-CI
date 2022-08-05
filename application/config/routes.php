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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route["logout"] = "index/logout";

$route["pinjam_buku/(.+)"] = "index/pinjam_buku/$1";
$route["koleksi_buku"] = "index/koleksi_buku";
$route["koleksi_buku/(.+)"] = "index/koleksi_buku/$1";

$route["koleksi_literasi"] = "index/koleksi_literasi";
$route["koleksi_literasi/(.+)"] = "index/koleksi_literasi/$1";

$route["koleksi_film"] = "index/koleksi_film";
$route["koleksi_film/(.+)"] = "index/koleksi_film/$1";

$route["pinjaman_saya"] = "index/pinjaman_saya";
$route["process_cart"] = "index/process_cart";
$route["process_cart_delete/(.+)"] = "index/process_cart_delete/$1";

$route["buku_saya"] = "index/buku_saya";
$route["booking_delete/(.+)"] = "index/booking_delete/$1";

$route["buku_pinjam"] = "index/buku_pinjam";
$route["perpanjang_pinjaman/(.+)"] = "index/perpanjang_pinjaman/$1";

$route["cari_buku"] = "index/search_buku";
$route["saran"] = "index/saran";

$route["myprofile"] = "index/myprofile";
$route["cardAnggota/(.+)"] = "index/cardAnggota/$1";
$route["profilePassword"] = "index/profilePassword";

$route["profile"] = "profile/editProfile";
$route["editProfile"] = "profile/editProfile";
$route["gantiPassword"] = "profile/gantiPassword";

$route['login'] = 'welcome/login';
$route['verifikasiEmail'] = 'welcome/verifikasiEmail';
$route['lupaVerifikasiEmail'] = 'welcome/lupaVerifikasiEmail';
$route['register'] = 'welcome/register';
$route['lupaPassword'] = 'welcome/lupaPassword';
$route['lupaKodeAkses'] = 'welcome/lupaKodeAkses';
$route['verifikasiEmail_lupaKodeAkses'] = 'welcome/verifikasiEmail_lupaKodeAkses';
$route['pertanyaan'] = 'welcome/pertanyaan';
$route['resetPassword'] = 'welcome/resetPassword';
$route['resetPassword_'] = 'welcome/resetPassword_';

$route['usulan'] = 'welcome/usulan';
$route['buku_tamu'] = 'welcome/buku_tamu';

$route['admin'] = 'admin';
$route['menu'] = 'admin/view_menu';
$route["tambah_menu"] = "admin/tambah_menu";
$route['view_menu_edit/(.+)'] = 'admin/view_menu_edit/$1';
$route['process_menu_edit'] = 'admin/process_menu_edit';
$route['process_menu_delete/(.+)'] = 'admin/process_menu_delete/$1';

$route['access_add'] = 'admin/process_access_add';
$route['access_delete/(.+)'] = 'admin/process_access_delete/$1';
$route['access_edit/(.+)'] = 'admin/view_access_edit/$1';
$route['validation_access_edit'] = 'admin/validation_access_edit';

$route['subMenu'] = 'admin/view_sub_menu';
$route['validation_sub_add'] = 'admin/validation_sub_add';
$route['edit_sub/(.+)'] = 'admin/view_sub_edit/$1';
$route['validation_sub_edit'] = 'admin/validation_sub_edit';
$route['delete_sub/(.+)'] = 'admin/process_sub_delete/$1';

$route['dataPetugas'] = "admin/view_petugas";
$route["petugas_edit/(.+)"] = "admin/view_petugas_edit/$1";
$route["validation_petugas_edit"] = "admin/validation_petugas_edit";
$route["validation_petugas_add"] = "admin/validation_petugas_add";
$route["cetakPetugas/(.+)"] = "admin/cetakPetugas/$1";
$route["petugas_delete/(.+)"] = "admin/process_petugas_delete/$1";

$route["dataAnggota"] = "user";
$route["process_anggota_check/(.+)"] = "user/process_anggota_check/$1";
$route["validation_user_add"] = "user/validation_user_add";
$route["user_edit/(.+)"] = "user/view_user_edit/$1";
$route["validation_user_edit"] = "user/validation_user_edit";
$route["user_delete/(.+)"] = "user/process_user_delete/$1";
$route["cetakUser/(.+)"] = "user/cetakUser/$1";
$route["cardUser/(.+)"] = "user/cardUser/$1";
$route["logUser"] = "user/view_log_user";
$route["export_anggota"] = "user/export_anggota";
$route["import_anggota"] = "user/import_anggota";

$route["dataPengunjung"] = "pengunjung";
$route["validation_pengunjung_add"] = "pengunjung/validation_pengunjung_add";
$route["pengunjung_edit/(.+)"] = "pengunjung/view_pengunjung_edit/$1";
$route["validation_pengunjung_edit"] = "pengunjung/validation_pengunjung_edit";
$route["pengunjung_delete/(.+)"] = "pengunjung/process_pengunjung_delete/$1";
$route["cetakpengunjung/(.+)"] = "pengunjung/cetakpengunjung/$1";
$route["logpengunjung"] = "pengunjung/view_log_pengunjung";
$route["export_pengunjung"] = "pengunjung/export_pengunjung";
$route["import_pengunjung"] = "pengunjung/import_pengunjung";

$route["katalogBuku"] = "buku/view_katalog";
$route["validation_katalog_add"] = "buku/validation_katalog_add";
$route["process_katalog_hapus/(.+)"] = "buku/process_katalog_delete/$1";
$route["katalog_edit/(.+)"] = "buku/katalog_edit/$1";
$route["validation_katalog_edit"] = "buku/validation_katalog_edit";

$route["dataBuku"] = "buku/view_buku";
$route["process_buku_check/(.+)"] = "buku/process_buku_check/$1";
$route["export_buku"] = "buku/export_buku";
$route["export_katalog"] = "buku/export_katalog";
$route["import_katalog"] = "buku/import_katalog";

$route["peminjamanBuku"] = "manajemenbuku/view_peminjaman";
$route["validation_peminjaman_add"] = "manajemenbuku/validation_peminjaman_add";
$route["peminjaman_dikembalikan/(.+)"] = "manajemenbuku/peminjaman_dikembalikan/$1";
$route["validation_peminjaman_kembali"] = "manajemenbuku/validation_peminjaman_kembali";
$route["peminjaman_batal/(.+)"] = "manajemenbuku/peminjaman_batal/$1";
$route["peminjaman_hapus/(.+)"] = "manajemenbuku/peminjaman_hapus/$1";
$route["search_buku"] = "manajemenbuku/search_buku";
$route["search_user"] = "manajemenbuku/search_user";
$route["peminjaman_didenda/(.+)"] = "manajemenbuku/peminjaman_didenda/$1";
$route["validation_peminjaman_denda"] = "manajemenbuku/validation_peminjaman_denda";

$route["export_peminjaman"] = "manajemenbuku/export_peminjaman";
$route["import_peminjaman"] = "manajemenbuku/import_peminjaman";

$route["denda"] = "manajemenbuku/view_denda";
$route["denda_edit"] = "manajemenbuku/denda_edit";
$route["validation_denda_edit"] = "manajemenbuku/validation_denda_edit";

$route["dataBooking"] = "manajemenbuku/view_booking";
$route["process_booking_tolak/(.+)"] = "manajemenbuku/process_booking_tolak/$1";
$route["process_booking_terima/(.+)"] = "manajemenbuku/process_booking_terima/$1";
$route["process_booking_delete/(.+)"] = "manajemenbuku/process_booking_delete/$1";

$route["websiteSettings"] = "website";
$route["validation_website_edit"] = "website/validation_website_edit";

$route["dataSekolah"] = "sekolah";
$route["validation_sekolah_add"] = "sekolah/validation_sekolah_add";
$route["sekolah_edit/(.+)"] = "sekolah/view_sekolah_edit/$1";
$route["validation_sekolah_edit"] = "sekolah/validation_sekolah_edit";
$route["sekolah_delete/(.+)"] = "sekolah/process_sekolah_delete/$1";
$route["export_sekolah"] = "sekolah/export_sekolah";
$route["import_sekolah"] = "sekolah/import_sekolah";

$route["perpus_check/(.+)"] = "sekolah/view_perpus_check/$1";
$route["get_perpus"] = "sekolah/get_perpus_listed";
$route["add_perpus"] = "sekolah/validation_perpus_add";
$route["add_sarana"] = "sekolah/validation_sarana_add";
$route["add_koleksi"] = "sekolah/validation_koleksi_add";
$route["add_person"] = "sekolah/validation_person_add";
$route["perpus_edit/(.+)"] = "sekolah/view_perpus_edit/$1";
$route["edit_perpus"] = "sekolah/validation_perpus_edit";
$route["sarana_edit/(.+)"] = "sekolah/view_sarana_edit/$1";
$route["edit_sarana"] = "sekolah/validation_sarana_edit";
$route["koleksi_edit/(.+)"] = "sekolah/view_koleksi_edit/$1";
$route["edit_koleksi"] = "sekolah/validation_koleksi_edit";
$route["person_edit/(.+)"] = "sekolah/view_person_edit/$1";
$route["edit_person"] = "sekolah/validation_person_edit";
$route["perpus_detail"] = "sekolah/view_perpus_detail";
$route["get_perpus_detail"] = "sekolah/get_perpus_detail";
$route["perpus_delete/(.+)"] = "sekolah/process_perpus_delete/$1";
$route["sarana_delete/(.+)"] = "sekolah/process_sarana_delete/$1";
$route["koleksi_delete/(.+)"] = "sekolah/process_koleksi_delete/$1";
$route["person_delete/(.+)"] = "sekolah/process_person_delete/$1";
$route["export_perpus"] = "sekolah/export_perpus";
$route["perpus_lapor/(.+)"] = "sekolah/process_perpus_lapor/$1";

$route["userSekolah"] = "userSekolah";
$route["validation_userSekolah_add"] = "userSekolah/validation_userSekolah_add";
$route["userSekolah_edit/(.+)"] = "userSekolah/view_userSekolah_edit/$1";
$route["validation_userSekolah_edit"] = "userSekolah/validation_userSekolah_edit";
$route["userSekolah_delete/(.+)"] = "userSekolah/process_userSekolah_delete/$1";
$route["export_userSekolah"] = "userSekolah/export_userSekolah";
$route["import_userSekolah"] = "userSekolah/import_userSekolah";
$route["cetakUserSekolah/(.+)"] = "userSekolah/cetakUserSekolah/$1";

$route["laporanDataSekolah"] = "laporanDataSekolah";
$route["validation_laporanDataSekolah_add"] = "laporanDataSekolah/validation_laporanDataSekolah_add";
$route["laporanDataSekolah_edit/(.+)"] = "laporanDataSekolah/view_laporanDataSekolah_edit/$1";
$route["validation_laporanDataSekolah_edit"] = "laporanDataSekolah/validation_laporanDataSekolah_edit";
$route["laporanDataSekolah_delete/(.+)"] = "laporanDataSekolah/process_laporanDataSekolah_delete/$1";
$route["export_laporanDataSekolah"] = "laporanDataSekolah/export_laporanDataSekolah";
$route["import_laporanDataSekolah"] = "laporanDataSekolah/import_laporanDataSekolah";

$route["email"] = "email";

$route["kebutuhanpemustaka"] = "buku/view_kebutuhanpemustaka";
$route["validation_kebutuhanpemustaka_add"] = "buku/validation_kebutuhanpemustaka_add";
$route["process_kebutuhanpemustaka_hapus/(.+)"] = "buku/process_kebutuhanpemustaka_delete/$1";
$route["kebutuhanpemustaka_edit/(.+)"] = "buku/kebutuhanpemustaka_edit/$1";
$route["validation_kebutuhanpemustaka_edit"] = "buku/validation_kebutuhanpemustaka_edit";
$route["export_kebutuhanpemustaka"] = "buku/export_kebutuhanpemustaka";
$route["import_kebutuhanpemustaka"] = "buku/import_kebutuhanpemustaka";

$route["pengadaan"] = "buku/view_pengadaan";
$route["validation_pengadaan_add"] = "buku/validation_pengadaan_add";
$route["process_pengadaan_hapus/(.+)"] = "buku/process_pengadaan_delete/$1";
$route["pengadaan_edit/(.+)"] = "buku/pengadaan_edit/$1";
$route["validation_pengadaan_edit"] = "buku/validation_pengadaan_edit";
$route["export_pengadaan"] = "buku/export_pengadaan";
$route["import_pengadaan"] = "buku/import_pengadaan";
