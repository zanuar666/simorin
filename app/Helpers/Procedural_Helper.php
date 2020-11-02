<?php

use App\Guru;
use App\Pembimbing;
use App\PembimbingPerusahaan;
use App\Siswa;
use Illuminate\Http\Request;

function JSONResponse($response = array())
{
    echo json_encode($response);
}

function JSONResponseDefault($result, $message)
{
    return JSONResponse(array(
        'RESULT' => $result,
        'MESSAGE' => $message
    ));
}

function isCurrentPage($page)
{
    if (!is_array($page) && url()->current() == url($page)) {
        return 'active';
    } else if (is_array($page)) {
        foreach ($page as $key => $value) {
            if (url()->current() !== url($value))
                continue;
            else
                return 'active';
        }
    }

    return null;
}

function checkEmail($email)
{
    $checkEmailGuru = Guru::find($email, array('email'));

    if ($checkEmailGuru !== null) {
        return false;
    }

    $checkEmailPembimbing = Pembimbing::find($email, array('email'));

    if ($checkEmailPembimbing !== null) {
        return false;
    }

    $checkEmailPembimbingPerusahaan = PembimbingPerusahaan::find($email, array('email'));

    if ($checkEmailPembimbingPerusahaan !== null) {
        return false;
    }

    $checkEmailSiswa = Siswa::find($email, array('email'));

    if ($checkEmailSiswa !== null) {
        return false;
    }

    return true;
}
