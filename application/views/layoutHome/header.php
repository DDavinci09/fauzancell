<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Commerce : Home</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/adminlte.min.css">
    <!-- Snap Midtrans -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-sSLFW1iemQhQdAA1"></script>
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
    /* Hover effect untuk card */
    .hover-effect {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Efek saat card di-hover */
    .hover-effect:hover {
        transform: scale(1.05);
        /* Membuat card sedikit membesar */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        /* Menambahkan bayangan */
    }

    /* Mengatur efek transisi */
    .card-body {
        transition: background-color 0.3s ease;
    }

    /* Mengubah warna latar belakang card saat hover */
    .hover-effect:hover .card-body {
        background-color: #f8f9fa;
    }

    /* Tombol navigasi carousel */
    .custom-carousel-control .carousel-control-prev-icon,
    .custom-carousel-control .carousel-control-next-icon {
        background-color: #007bff;
        /* Warna tombol */
        border-radius: 50%;
        /* Membuat tombol bulat */
        width: 35px;
        /* Lebar tombol */
        height: 35px;
        /* Tinggi tombol */
    }

    /* Ikon navigasi di dalam tombol */
    .custom-carousel-control .carousel-control-prev-icon::after,
    .custom-carousel-control .carousel-control-next-icon::after {
        font-size: 1rem;
        /* Ukuran ikon lebih kecil */
        color: white;
        /* Warna ikon */
    }

    /* Posisikan tombol navigasi di bawah carousel */
    #carouselKategori {
        position: relative;
    }

    .carousel-control-prev,
    .carousel-control-next {
        position: absolute;
        bottom: -10px;
        /* Jarak tombol dari bawah carousel */
        top: auto;
        /* Hilangkan posisi vertikal default */
        transform: translateY(0);
        /* Reset transformasi vertikal */
    }

    .carousel-control-prev {
        left: 10%;
        /* Posisi tombol Prev di kiri */
    }

    .carousel-control-next {
        right: 10%;
        /* Posisi tombol Next di kanan */
    }
    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">