<?php

function cek_login()
{
    //panggil library ci untuk helper
    $ci = get_instance();

    //cek session dan role
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    } else {
        //role pada session
        $id_role = $ci->session->userdata('id_role');

        //ambil segment uri
        $menu = $ci->uri->segment(1);

        //query nama menu = segment uri 1
        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();

        //mengambil id menu
        $id_menu = $queryMenu['id'];

        //ambil role dan id menu berdasarkan role pada session dan id menu
        $userAccess = $ci->db->get_where(
            'user_access_menu',
            [
                'id_role' => $id_role,
                'id_menu' => $id_menu
            ]
        );

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function cek_akses($id_role, $id_menu)
{
    $ci = get_instance();

    // $ci->db->where('id_role', $id_role);
    // $ci->db->where('id_menu', $id_menu);
    // $result = $ci->db->get('user_access_menu');

    $result = $ci->db->query("SELECT *
                            FROM user_access_menu
                            WHERE id_role = '" . $id_role . "'
                            AND id_menu = '" . $id_menu . "'");

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function rupiah($angka)
{

    $hasil_rupiah = number_format($angka, 0, '.', '.');
    return "Rp. " . $hasil_rupiah;
}
