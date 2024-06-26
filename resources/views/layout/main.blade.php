<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GudangKu</title>
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/css/styles.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layout.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ env('APP_URL') }}/assets/images/profile/user-1.jpg" alt=""
                                        width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">

                                        <a href="{{ route('logout_process') }}"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <div class="container-fluid">
                <!--  Content -->
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ env('APP_URL') }}/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="{{ env('APP_URL') }}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="assets/js/sidebarmenu.js"></script> --}}
    <script src="{{ env('APP_URL') }}/assets/js/app.min.js"></script>
    {{-- <script src="{{ env('APP_URL') }}/assets/libs/apexcharts/dist/apexcharts.min.js"></script> --}}
    <script src="{{ env('APP_URL') }}/assets/libs/simplebar/dist/simplebar.js"></script>
    {{-- <script src="{{ env('APP_URL') }}/assets/js/dashboard.js"></script> --}}
    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#datatable');

        @foreach ($errors->all() as $error)
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ $error }}",
            });
        @endforeach
        @if (session()->has('success'))
            Swal.fire({
                icon: "success",
                title: "Yeay..",
                text: "{{ session('success') }}",
            });
        @endif

        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
        });

        const name = document.querySelector('#name');
        const telp = document.querySelector('#telp');
        const fetchCustomer = (value) => {
            if (value !== '-1') {
                fetch('/getdatacustomer?kode=' + value)
                    .then(response => response.json())
                    .then(data => {
                        name.value = data.name,
                            telp.value = data.telp
                    });
            }
        }


        // const tablex = document.querySelector('#data_barang');

        const tambah_barang = (() => {
            let nomer = 0;
            return (kode) => {
                fetch(`/getdatabarang?kode=${kode}&no=${nomer += 1}`)
                    .then(response => response.json())
                    .then(data => {
                        // tablex.innerHTML += data.data;
                        // tablex.insertAdjacentHTML('beforeend', data.data);
                        $('#data_barang').append(data.data);
                    });
            }
        })();

        const ubah_barang = (no) => {

            const qty = document.querySelector(`#qty${no}`);
            const persen = document.querySelector(`#persen${no}`).value;
            const rupiahpersen = document.querySelector(`#rupiahpersen${no}`);
            const harga_bandrol = document.querySelector(`#harga_bandrol${no}`).value;
            const hargadiskon = document.querySelector(`#hargadiskon${no}`);
            const total = document.querySelector(`#total${no}`);
            const sub_total = document.querySelector('#sub_total_input');

            rupiahpersen.value = (persen / 100) * harga_bandrol;
            hargadiskon.value = harga_bandrol - rupiahpersen.value;
            total.value = hargadiskon.value * qty.value;
            // console.log(rupiahpersen.value);
            if (sub_total.value !== '') {
                sub_total.value = parseFloat(sub_total.value) + parseFloat(total.value);

            } else {
                sub_total.value += parseFloat(total.value);

            }
        }

        


        const hapus_barang = (kode) => {
            document.querySelector(`#${kode}`).remove();
        }

        // const diskon = () => {
        //     let sub_total = document.querySelector('#sub_total_input').value;
        //     let diskon = document.querySelector('#diskon_input').value;

        //     let finalvar = sub_total - diskon;

        //     total_bayar.value = finalvar;
        // }

        const calculateAll = () => {
            // let total_bayar = parseFloat(document.querySelector('#total_bayar').value);
            // let sub_total = parseFloat(document.querySelector('#sub_total_input').value);
            let total_bayar = document.querySelector('#total_bayar');
            let sub_total = document.querySelector('#sub_total_input').value;
            let diskon = document.querySelector('#diskon_input').value;
            let ongkir = document.querySelector('#ongkir_input');

            if(ongkir.value === '')
                return false;

            total_bayar.value = parseFloat(sub_total) - parseFloat(diskon) + parseFloat(ongkir.value);

        }
    </script>
</body>

</html>
